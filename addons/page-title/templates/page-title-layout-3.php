<?php
/**
 * Page Title
 *
 * @package Kemet Addon
 */

$post_title        = kemet_get_the_title();
$page_title_layout = apply_filters( 'kemet_the_page_title_layout', kemet_get_option( 'page-title-layouts' ) );
if ( 'post' == get_post_type() ) {
	$header_title = kemet_get_option( 'page-header-title' );
	if ( 'blog' == $header_title ) {
		$post_title = esc_html__( 'Blog', 'kemet-addons' );
	}
}
$description        = get_the_archive_description();
$classes []         = $page_title_layout;
$classes_responsive = kemet_get_option( 'page-title-responsive' );
if ( 'disable' != $page_title_layout && apply_filters( 'kemet_disable_breadcrumbs', true ) ) {
	$classes [] = 'has-breadcrumb';
}
$sub_title = '';
$sub_title = apply_filters( 'kemet_sub_title_addon', $sub_title );
$classes   = implode( ' ', $classes );
?>

<div class = "kmt-page-title-addon-content  <?php echo esc_attr( $classes_responsive ); ?>">
	<div class = "kmt-page-title <?php echo esc_attr( $classes ); ?>" >
		<div class = 'kmt-container'>
			<div class = 'kmt-row kmt-flex kemet-top-header-section-wrap'>
				<div class = 'kmt-page-title-wrap kmt-flex kmt-justify-content-flex-end kmt-col-md-6 kmt-col-xs-12'>
					<?php if ( $post_title ) { ?>
						<h1 class = 'kemet-page-title'>
						<?php
						if ( is_singular() ) {
							echo wp_kses_post( apply_filters( 'kemet_page_title_addon_title', $post_title ) );
						} else {
							echo wp_kses_post( apply_filters( 'kemet_page_title_addon_title', Kemet_Addon_Page_Title_Partials::get_instance()->kemet_get_current_page_title() ) );
						}
						?>
						</h1>
					<?php } ?>
					<?php if ( $description ) { ?>
					<div class = 'taxonomy-description'>
						<?php echo wp_kses_post( apply_filters( 'kemet_page_title_addon_description', $description ) ); ?>
					</div>
					<?php } ?>
				</div>
				<div class = 'kmt-flex kmt-justify-content-flex-start subtitle-breadcrumbs kmt-col-md-6 kmt-col-xs-12'>
				<?php if ( $sub_title ) { ?>
					<h5 class="kemet-page-sub-title">
						<?php echo esc_html( $sub_title ); ?>
					</h5>
				<?php } ?>    
				<?php if ( 'disable' != $page_title_layout && apply_filters( 'kemet_disable_breadcrumbs', true ) ) { ?>
					<?php kemet_breadcrumb_trail(); ?>
				<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>
