<?php

add_action( 'wp_enqueue_scripts', 'cluq_theme_scripts' );

function cluq_theme_scripts() {
	wp_enqueue_script( 'cluq_common',get_stylesheet_directory_uri() . '/cluq-scripts/common.js', array( 'jquery' ), '1.0.0', true );
	wp_enqueue_script( 'cluq_category', get_stylesheet_directory_uri() . '/cluq-scripts/category.js', array( 'jquery' ), '1.0.0', true );
	wp_enqueue_script( 'cluq_slicebox_modernizr.custom.46884', get_stylesheet_directory_uri() . '/cluq-scripts/slicebox/modernizr.custom.46884.js', array( 'jquery' ), '1.0.0', true );
	wp_enqueue_script( 'cluq_slicebox_jquery.slicebox', get_stylesheet_directory_uri() . '/cluq-scripts/slicebox/jquery.slicebox.js', array( 'jquery' ), '1.0.0', true );
	wp_enqueue_script( 'cluq_custom.slicebox', get_stylesheet_directory_uri() . '/cluq-scripts/slicebox/custom.slicebox.js', array( 'jquery' ), '1.0.0', true );
	wp_enqueue_script( 'cluq_menu_uq', get_stylesheet_directory_uri() . '/cluq-scripts/menu_uq.js', array( 'jquery' ), '1.0.0', true );
	
}



?>