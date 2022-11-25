<?php
// Create account functionality
$msf_create_user_id = wp_create_user( $msf_username, $msf_password, $msf_email );
update_user_meta( $msf_create_user_id, 'msf_user_ques_id', $msf_ques_id);

// Login functionality
$msf__user = get_user_by( 'id', $msf_create_user_id ); 
if( $msf__user ) {
    wp_set_current_user( $msf_create_user_id, $msf__user->user_login );
    wp_set_auth_cookie( $msf_create_user_id );
    // do_action( 'wp_login', $msf__user->user_login );
}