<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Kemet Addons
 */

get_header();

while ( have_posts() ) :
	the_post();
	do_action( 'kemet_addons_custom_layout_hook' );
	endwhile;

get_footer();
