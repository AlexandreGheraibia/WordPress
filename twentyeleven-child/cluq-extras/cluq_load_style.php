<?php
/*style*/
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
add_action('login_head', 'custom_login_css');
 /*************************************************/
 /* Import de la feuille de style du thème enfant */
/*************************************************/
function my_theme_enqueue_styles() {
    $parent_style = 'parent-style'; // This is 'twentyeleven-style' for the Twenty Eleven theme.
	$child_style = 'child-style';
    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( $child_style,
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
	wp_enqueue_style( 'cluq-common-style',
        get_stylesheet_directory_uri() . '/cluq-styles/common-style.css',
        array( $child_style,'cluq-newsletter-style', 'cluq-forum-style'),
        wp_get_theme()->get('Version')
    );
	
	wp_enqueue_style( 'cluq-newsletter-style',
        get_stylesheet_directory_uri() . '/cluq-styles/newsletter-style.css',
        array( $child_style ),
        wp_get_theme()->get('Version')
    );
	
	wp_enqueue_style( 'cluq-forum-style',
        get_stylesheet_directory_uri() . '/cluq-styles/forum-style.css',
        array( $child_style),
        wp_get_theme()->get('Version')
    );
	wp_enqueue_style( 'cluq-category-style',
        get_stylesheet_directory_uri() . '/cluq-styles/category-style.css',
        array( $child_style),
        wp_get_theme()->get('Version')
    );
	wp_enqueue_style( 'cluq-uq-menu-style',
        get_stylesheet_directory_uri() . '/cluq-styles/uq-menu.css',
        array( $child_style),
        wp_get_theme()->get('Version')
    );
	/*slicebox*/
	
	wp_enqueue_style( 'cluq-uq-gallery-slicebox',
        get_stylesheet_directory_uri() . '/cluq-styles/slicebox/slicebox.css',
        array( $child_style),
        wp_get_theme()->get('Version')
    );
	wp_enqueue_style( 'cluq-uq-gallery-custom',
        get_stylesheet_directory_uri() . '/cluq-styles/slicebox/custom.css',
        array( $child_style),
        wp_get_theme()->get('Version')
    );

	
	wp_enqueue_style( 'cluq-uq-union-info',
        get_stylesheet_directory_uri() . '/cluq-styles/uq-union-info.css',
        array( $child_style),
        wp_get_theme()->get('Version')
    );
	wp_enqueue_style( 'cluq-uq-gallery-style',
        get_stylesheet_directory_uri() . '/cluq-styles/uq-gallery.css',
        array( $child_style),
        wp_get_theme()->get('Version')
    );
}
// Fonction qui insere le lien vers le css qui surchargera celui d'origine
function custom_login_css()  {
    echo '<link rel="stylesheet" type="text/css" href="' .  get_stylesheet_directory_uri() . '/cluq-styles/login-style.css" />';
}
 ?>