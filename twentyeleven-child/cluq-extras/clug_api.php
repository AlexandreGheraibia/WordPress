<?php

 /***********************************/
 /* checks user role by the user id */
/***********************************/
function is_user_in_role( $user_id, $role  ) {
    $user = new WP_User( $user_id );
	return ( ! empty( $user->roles ) && is_array( $user->roles ) && in_array( $role, $user->roles ) );
}

function log_message($message){
	if (WP_DEBUG === true) {
		if (is_array($message) || is_object($message)) {
			error_log(print_r($message, true));
		} 
		else {
			error_log($message);
		}
	}
}
?>