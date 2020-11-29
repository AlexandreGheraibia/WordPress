<?php 
if(is_admin()){
	
/*remove menu for subscriber*/
add_action( 'admin_menu', 'remove_menus' );
/*redirect the scontributor*/
add_action('load-index.php','dashboard_redirect');
/*suppress version alert*/
add_filter( 'pre_site_transient_update_core', 'suppress_version_alert');
}

 
   /***************************************************/
  /* hide the dashbord sub menu for the scontributor */
 /*        remove the editor for all the user       */
/***************************************************/

function remove_menus() {
	if(is_user_in_role(get_current_user_id(),"contributor")){
		remove_menu_page( 'index.php' );                  //Dashboard	
		remove_menu_page( 'tools.php' );                  //Dashboard	
		
	}
}


  /****************************************************************/
 /* redirect the scontributor  when they switch to the dashboard */
/****************************************************************/
function dashboard_redirect(){
	if(is_user_in_role(get_current_user_id(),"contributor")){
		// wp_redirect(admin_url('edit.php?post_type=page'));
	}
}


 /***********************************************************************/
 /* suppress the version warning from all the user except for the admin */
/***********************************************************************/
function suppress_version_alert($param){
	if(!is_user_in_role(get_current_user_id(),"administrator")){
		return null;
	}
	return $param;
}

?>