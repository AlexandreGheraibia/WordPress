<?php

/*------------------------------------------------menu-------------------------------------------*/
//navigation information des unions de quartiers
//référencement du menu dans l'onget menu du menu apparence du back-office

//add_action( 'init', 'register_my_menu' );

/*definition du contenu du menu*/
/*function your_custom_menu_item ( $items, $args ) {
		if ($args->theme_location == 'cluq-menu') {
			$items .= '<li><a href="?param=1">Show whatever</a></li>';
		}
		return $items;
}*/

/*ajout du menu dans le back end de wordpress*/
function register_my_menu() {
 
  //register_nav_menu('cluq-menu', __( 'Menu Cluq' ));
  //add_filter( 'wp_nav_menu_items', 'your_custom_menu_item', 10, 2 );
}


/*---------------------------------------------------widget---------------------------------------*/

add_action( 'widgets_init', 'new_widgets_zoné_init' );

//add the widget zone to the back end
function new_widgets_zoné_init() {

    register_sidebar( array(
        'name'          => 'Nouvelle zone à Widgets',
        'id'            => 'nouvelle_zone',
        'before_widget' => '<div>',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="rounded">',
        'after_title'   => '</h2>',
        'class'         => 'nom_de_la_classe',
    ) );
}
//define the widget and its class
include dirname( __FILE__ ).'/cluq_widget.php';

?>