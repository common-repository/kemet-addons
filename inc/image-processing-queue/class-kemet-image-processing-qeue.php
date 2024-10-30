<?php
/**
 * Kemet Image Processing Queue
 *
 * @package Kemet Addons
 */

if ( ! class_exists( 'Kemet_Image_Processing_Queue' ) ) {

	/**
	 * Kemet Image Processing Queue
	 */
	class Kemet_Image_Processing_Queue {

		/**
		 * Member Variable
		 *
		 * @var object instance
		 */
		private static $instance;

		/**
		 * Instance
		 *
		 * @return void
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self();
			}
		}

		/**
		 *  Constructor
		 */
		public function __construct() {
			require_once KEMET_ADDONS_DIR . 'inc/image-processing-queue/background-process/class-wp-async-request.php';
			require_once KEMET_ADDONS_DIR . 'inc/image-processing-queue/background-process/class-wp-background-process.php';
			require_once KEMET_ADDONS_DIR . 'inc/image-processing-queue/class-image-processing-queue.php';
			require_once KEMET_ADDONS_DIR . 'inc/image-processing-queue/class-ipq-exception.php';
			require_once KEMET_ADDONS_DIR . 'inc/image-processing-queue/class-resize-process.php';
			require_once KEMET_ADDONS_DIR . 'inc/image-processing-queue/functions.php';
		}
	}
}

Kemet_Image_Processing_Queue::get_instance();
