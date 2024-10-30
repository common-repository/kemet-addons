<?php
/**
 * Resize Process
 *
 * @package Image-Processing-Queue
 */

if ( ! class_exists( 'Resize_Process' ) ) {

	/**
	 * Resize Process
	 */
	class Resize_Process extends WP_Background_Process {

		/**
		 * Action
		 *
		 * @var string
		 */
		protected $action = 'image_processing_queue';

		/**
		 * Background task to resizes images
		 *
		 * @param mixed $item Image data.
		 * @return bool
		 * @throws IPQ_Exception On error.
		 */
		protected function task( $item ) {
			$item = wp_parse_args(
				$item,
				array(
					'post_id' => 0,
					'width'   => 0,
					'height'  => 0,
					'crop'    => false,
				)
			);

			$post_id = $item['post_id'];
			$width   = $item['width'];
			$height  = $item['height'];
			$crop    = $item['crop'];

			if ( ! $width && ! $height ) {
				throw new IPQ_Exception( "Invalid dimensions '{$width}x{$height}'" );
			}

			if ( Image_Processing_Queue::does_size_already_exist_for_image( $post_id, array( $width, $height, $crop ) ) ) {
				return false;
			}

			$image_meta = Image_Processing_Queue::get_image_meta( $post_id );

			if ( ! $image_meta ) {
				return false;
			}

			add_filter( 'as3cf_get_attached_file_copy_back_to_local', '__return_true' );
			$img_path = Image_Processing_Queue::get_image_path( $post_id );

			if ( ! $img_path ) {
				return false;
			}

			$editor = wp_get_image_editor( $img_path );

			if ( is_wp_error( $editor ) ) {
				throw new IPQ_Exception( 'Unable to get WP_Image_Editor for file "' . $img_path . '": ' . $editor->get_error_message() . ' (is GD or ImageMagick installed?)' );
			}

			$resize = $editor->resize( $width, $height, $crop );

			if ( is_wp_error( $resize ) ) {
				throw new IPQ_Exception( 'Error resizing image: ' . $resize->get_error_message() );
			}

			$resized_file = $editor->save();

			if ( is_wp_error( $resized_file ) ) {
				throw new IPQ_Exception( 'Unable to save resized image file: ' . $editor->get_error_message() );
			}

			$size_name                         = Image_Processing_Queue::get_size_name( array( $width, $height, $crop ) );
			$image_meta['sizes'][ $size_name ] = array(
				'file'      => $resized_file['file'],
				'width'     => $resized_file['width'],
				'height'    => $resized_file['height'],
				'mime-type' => $resized_file['mime-type'],
			);

			unset( $image_meta['ipq_locked'] );
			wp_update_attachment_metadata( $post_id, $image_meta );
		}

	}
}
