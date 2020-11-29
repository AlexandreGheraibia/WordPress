<?php 

//include dirname( __FILE__ ).'/cluq-extras/cluq_smtp.php';
include dirname( __FILE__ ).'/cluq-extras/clug_api.php';
include dirname( __FILE__ ).'/cluq-extras/cluq_load_style.php';
//include dirname( __FILE__ ).'/cluq-extras/cluq_newsletter.php';
//include dirname( __FILE__ ).'/cluq-extras/cluq_forum.php';
include dirname( __FILE__ ).'/cluq-extras/cluq_menus.php';
include dirname( __FILE__ ).'/cluq-extras/cluq_scripts.php';
include dirname( __FILE__ ).'/cluq-extras/cluq_admin.php';



  /*********************************************************/
 /* add to a query to retrieve all the scontributor posts */
/*********************************************************/
/*filter *
add_filter('wp_page_menu_args','my_nav_exclude_pages');
function authors_where_filter($where) {
	global $wpdb;
	$ids = get_users(array('role' => 'scontributor' ,'fields' => 'ID'));
	if(isset($ids)&&!empty($ids)){
	$ids=implode(', ', $ids);
		$where .= " AND post_author IN (".$ids.")";
	}
	return $where;
}

  /********************************************************/
 /* hide the page publish by scontributor from the menu  */
/********************************************************
function my_nav_exclude_pages( $args = array() ) {
	
  $my_array=array();
  if( isset($args['exclude'])){
   array_push($my_array,$args['exclude']);
  }
  $args2=array(
		"post_type"=> "page",
		"post_status"=>"publish"
  );
  add_filter('posts_where','authors_where_filter');
  $the_query = new WP_Query($args2);
  remove_filter('posts_where',1,1);
  // The Loop
	if ( $the_query->have_posts() ) {
		while ( $the_query->have_posts() ) {
			$post=$the_query->the_post();
			if(isset($the_query->post)){
			 array_push($my_array,$the_query->post->ID);
			}
		}
	}
  wp_reset_query();
  if(isset($my_array)){
		$args['exclude'] = join( ',',$my_array );
	}

  return $args;
}
*/
  /*******************************************/
 /* remove the admin bar for the subscriber */
/*******************************************/
/*remove the admin bar*/
add_action('after_setup_theme', 'remove_admin_bar');
function remove_admin_bar() {
	if (!is_admin()&&is_user_in_role(get_current_user_id(),"subscriber" )) {
	  show_admin_bar(false);
	}
}
/*remove the wp-logo*/
add_action( 'wp_before_admin_bar_render', 'admin_bar_remove_logo', 0 );
  /****************************************/
 /* Remove WordPress Logo from Admin Bar */
/****************************************/
function admin_bar_remove_logo() {
	if(!is_user_in_role(get_current_user_id(),"administrator")) {
		global $wp_admin_bar;
		$wp_admin_bar->remove_menu( 'wp-logo');
		if(is_user_in_role(get_current_user_id(),"scontributor")){
			$wp_admin_bar->remove_menu('new-content');
			
		}
	}
}
?>