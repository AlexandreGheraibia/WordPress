<?php 
/*newsletter widget*/
add_action( 'widgets_init', 'newsletters_widgets_init' );

  /*******************************************************************/
 /* Add one slot in the widget menu for contain the newsletter widget.*/
/*******************************************************************/
function newsletters_widgets_init() {
 register_sidebar( array(
 'name' => 'Colonne newsletter', // c'est le nom de la sidebar qui apparaitra dans le backoffice
 'id' => 'newsletter-widget-area', // ceci est l'identifiant de la sidebar
 'before_widget' => '<div class="newsletter-sidebar">', // ouverture d'une div avant le widget avec une class pour agir dessus en CSS
 'after_widget' => '</div>', // fermeture de la div après le widget
 'before_title' => '<h3 class="newsletter-sidebar-title">', // action sur le titre de chaque widget avec un tag H3 et une class pour le CSS
 'after_title' => '</h3>',
 ) );
 
}
?>