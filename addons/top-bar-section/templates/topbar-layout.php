<?php
/**
 * Template for Top Bar Layouout
 *
 * @package     Kemet
 * @author      Kemet
 * @copyright   Copyright (c) 2019, Kemet
 * @link        https://kemet.io/
 * @since       Kemet 1.0.0
 */

if ( ! function_exists( 'kemet_get_top_section' ) ) {

	/**
	 * Function to get top section
	 *
	 * @param string $option top bar option.
	 * @return mixed
	 */
	function kemet_get_top_section( $option ) {
		$output  = '';
		$section = kemet_get_option( $option );
		if ( is_array( $section ) ) {

			foreach ( $section as $sectionnn ) {

				switch ( $sectionnn ) {

					case 'search':
							$output .= kemet_get_search();
						break;

					case 'menu':
							$output .= kemet_get_top_menu();
						break;

					case 'widget':
							$output .= kemet_get_custom_widget( $option );
						break;

					case 'text-html':
							$output .= kemet_get_custom_html( $option . '-html' );
						break;
				}
			}
			return $output;
		}
	}
}
$section_1            = kemet_get_top_section( 'top-section-1' );
$section_2            = kemet_get_top_section( 'top-section-2' );
$section1_class       = 'kmt-col-md-6';
$section2_class       = 'kmt-col-md-6';
$sections             = 0;
$enable_top_section_1 = apply_filters( 'enable_kemet_top_bar_section_1', false );
$enable_top_section_2 = apply_filters( 'enable_kemet_top_bar_section_2', false );
if ( ( '' != $section_1 || $enable_top_section_1 ) && ( '' == $section_2 && false == $enable_top_section_2 ) ) {
	$section1_class = 'kmt-col-md-12';
	$section2_class = 'kmt-col-md-6';
} elseif ( ( '' != $section_2 || $enable_top_section_2 ) && ( '' == $section_1 && false == $enable_top_section_1 ) ) {
	$section1_class = 'kmt-col-md-6';
	$section2_class = 'kmt-col-md-12';
} else {
	$section1_class = 'kmt-col-md-6';
	$section2_class = 'kmt-col-md-6';
}
if ( '' != $section_1 ) {
	$sections++;
}
if ( '' != $section_2 ) {
	$sections++;
}

if ( ( empty( $section_1 ) && false == $enable_top_section_1 ) && ( empty( $section_2 ) && false == $enable_top_section_2 ) ) {
	return;
}

$classes = kemet_get_option( 'topbar-responsive' );
if ( in_array( 'search', (array) kemet_get_option( 'top-section-1' ) ) || in_array( 'search', (array) kemet_get_option( 'top-section-2' ) ) ) {
	$search_style = kemet_get_option( 'top-bar-search-style' );
	$classes     .= ' top-bar-' . $search_style;
}
?>
<?php do_action( 'kemet_before_top_bar' ); ?>
<div class="kemet-top-header-wrap" >
	<div class="kemet-top-header  <?php echo esc_attr( $classes ); ?>" >
		<div class="kmt-container">
			<div class="kmt-row kmt-flex kemet-top-header-section-wrap">
				<?php if ( ! empty( $section_1 ) || $enable_top_section_1 ) { ?>
					<div class="kemet-top-header-section kemet-top-header-section-1 kmt-flex kmt-justify-content-flex-start mt-topbar-section-equally <?php echo esc_attr( $section1_class ); ?> kmt-col-xs-12 kmt-flex-1" >
							<?php echo $section_1; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							<?php do_action( 'kemet_top_bar_section_1' ); ?>
					</div>
				<?php } ?>
				<?php if ( ! empty( $section_2 ) || $enable_top_section_2 ) { ?>
					<div class="kemet-top-header-section kemet-top-header-section-2 kmt-flex kmt-justify-content-flex-end mt-topbar-section-equally <?php echo esc_attr( $section2_class ); ?> kmt-col-xs-12 kmt-flex-1" >
							<?php echo $section_2; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							<?php do_action( 'kemet_top_bar_section_2' ); ?>
					</div>
				<?php } ?>
			</div>
		</div><!-- .kmt-container -->
	</div><!-- .kemet-top-header -->
</div><!-- .kemet-top-header-wrap -->
<?php do_action( 'kemet_after_top_bar' ); ?>
