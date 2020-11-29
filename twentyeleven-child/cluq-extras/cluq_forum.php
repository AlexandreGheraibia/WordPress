<?php 
/* bbpress sidebar */
add_action( 'widgets_init', 'rkk_widgets_init' );
/*customisation forum*/
add_filter('bbp_before_get_breadcrumb_parse_args', 'mycustom_breadcrumb_options');
/*add descrition to the forum*/
add_filter('user_contactmethods', 'add_extra_contactmethod');
/*add custom avatar in the description page*/
add_action( 'bbp_user_edit_after_name', 'casiepa_mention_gravatar' );
  /*******************************************************************/
 /* Add one slot in the widget menu for contain the bbpress widget.*/
/*******************************************************************/
function rkk_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Colonne bbPress', 'rkk' ),
		'id' => 'bbp-sidebar',
		'description' => __( 'A sidebar that only appears on bbPress pages', 'rkk' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}

  /*******************************************/
 /* remove accueil link from the forum page */
/******************************************/
function mycustom_breadcrumb_options() {
    // Home - default = true
    $args['include_home']    = false;
    // Forum root - default = true
    $args['include_root']    = true;
    // Current - default = true
    $args['include_current'] = true;
 
    return $args;
}


  /******************************************/
 /* add social media to the forum profile  */
/******************************************/
function add_extra_contactmethod( $contactmethods ) {
// Add new ones
$contactmethods['twitter'] = 'Twitter';
$contactmethods['facebook'] = 'Facebook';
$contactmethods['googleplus'] = 'Google Plus';
$contactmethods['youtube'] = 'Youtube';
  
// remove unwanted
unset($contactmethods['aim']);
unset($contactmethods['jabber']);
unset($contactmethods['yim']);
  
return $contactmethods;
}

 /**************************************/
 /* add avatar link in the user profile*/
/**************************************/
function casiepa_mention_gravatar() {
?>

<div>
	<label for="bbp-gravatar-notice">Avatar</label>
	<span name="bbp-gravatar-notice" class="description">Vous pouvez changer votre image de profil sur <a href="https://gravatar.com" title="Gravatar">Gravatar</a>.</span>
</div>

<?php
}

 
?>