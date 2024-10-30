<?php
/**
 * Header 5 Layout
 *
 * @package Kemet Addons
 */

?>
<?php do_action( 'kemet_before_main_header' ); ?>
<div class="main-header-bar-wrap ss-wrapper">
	<div class="main-header-bar ss-content">
		<?php kemet_main_header_bar_top(); ?>
		<div id="header-layout-5" class="header">
				<div class="kmt-flex main-header-container">
					<?php kemet_sitehead_content(); ?>
				</div>
		</div>
		<?php kemet_main_header_bar_bottom(); ?>
	</div> 
</div>
<?php do_action( 'kemet_after_main_header' ); ?>
