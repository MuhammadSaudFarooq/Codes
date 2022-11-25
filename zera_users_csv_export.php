<?php
/********* Export to csv ***********/
add_action('admin_footer', 'msf_export_users');

function msf_export_users() {
    $screen = get_current_screen();
    if ( $screen->id != "users" )   // Only add to users.php page
        return;
    ?>
    <script type="text/javascript">
        jQuery(document).ready( function($){
            $('.tablenav.top .clear, .tablenav.bottom .clear').before('<form action="#" method="POST"><input type="hidden" id="msf_export_csv" name="msf_export_csv" value="1" /><input class="button button-primary user_export_button" type="submit" value="<?php esc_attr_e('Export CSV', 'mytheme');?>" /></form>');
        });
    </script>
    <?php
}

add_action('admin_init', 'msf_export_csv'); //you can use admin_init as well

function msf_export_csv() {
    if (!empty($_POST['msf_export_csv'])) {

        if (current_user_can('manage_options')) {
            header("Content-type: application/force-download");
            header('Content-Disposition: inline; filename="ZERA Users ('.date('Y-M-d H:i:s').').csv"');

            // WP_User_Query arguments
            $args = array (
                'order'          => 'ASC',
                'orderby'        => 'display_name',
                'fields'         => 'all',
            );

            // The User Query
            $blogusers = get_users( $args );
            // $msf_array_header = array('Username');
            // Array of WP_User objects.
            echo "Username , Name , Email , Are you a first time mother? , Are you currently pregnant? , Pregnancy Date , Number of Children , Child 1 Age , Child 2 Age , Child 3 Age , Child 4 Age , Child 5 Age , Child 6 Age , Child 7 Age , Child 8 Age , Child 9 Age , Child 10 Age , How did you deliver your last baby? , Are you currently breastfeeding? "."\n";
            foreach ( $blogusers as $user ) {
                $msf_meta = get_user_meta($user->ID);
                $msf_u_postmeta = get_post_meta($msf_meta['msf_user_ques_id'][0]);
                // echo "<pre>";
                // print_r($msf_u_postmeta);
                // echo "</pre>";
                $msf_role = $user->roles;
                $email = $user->user_email;

                $msf_username = ( isset($msf_meta['nickname'][0]) && $msf_meta['nickname'][0] != '' ) ? $msf_meta['nickname'][0] : '';

                $msf_first_name = ( isset($msf_meta['first_name'][0]) && $msf_meta['first_name'][0] != '' ) ? $msf_meta['first_name'][0] : '' ;
                
                $msf_last_name  = ( isset($msf_meta['last_name'][0]) && $msf_meta['last_name'][0] != '' ) ? $msf_meta['last_name'][0] : '' ;
                
                $msf_are_you_a_first_time_mother = ( isset($msf_u_postmeta['are_you_a_first_time_mother'][0]) && $msf_u_postmeta['are_you_a_first_time_mother'][0] != '' ) ? $msf_u_postmeta['are_you_a_first_time_mother'][0] : '';
                
                $msf_are_you_currently_pregnant = ( isset($msf_u_postmeta['are_you_currently_pregnant'][0]) && $msf_u_postmeta['are_you_currently_pregnant'][0] != '' ) ? $msf_u_postmeta['are_you_currently_pregnant'][0] : '';
                
                $msf_pregnancy_date = ( isset($msf_u_postmeta['pregnancy_date'][0]) && $msf_u_postmeta['pregnancy_date'][0] != '' ) ? $msf_u_postmeta['pregnancy_date'][0] : '';
                
                $msf_number_of_children = ( isset($msf_u_postmeta['number_of_children'][0]) && $msf_u_postmeta['number_of_children'][0] != '' ) ? $msf_u_postmeta['number_of_children'][0] : '';
                
                $msf_how_old_are_your_children_1 = ( isset($msf_u_postmeta['how_old_are_your_children_1'][0]) && $msf_u_postmeta['how_old_are_your_children_1'][0] != '' ) ? $msf_u_postmeta['how_old_are_your_children_1'][0] : '';
                
                $msf_how_old_are_your_children_2 = ( isset($msf_u_postmeta['how_old_are_your_children_2'][0]) && $msf_u_postmeta['how_old_are_your_children_2'][0] != '' ) ? $msf_u_postmeta['how_old_are_your_children_2'][0] : '';
                
                $msf_how_old_are_your_children_3 = ( isset($msf_u_postmeta['how_old_are_your_children_3'][0]) && $msf_u_postmeta['how_old_are_your_children_3'][0] != '' ) ? $msf_u_postmeta['how_old_are_your_children_3'][0] : '';
                
                $msf_how_old_are_your_children_4 = ( isset($msf_u_postmeta['how_old_are_your_children_4'][0]) && $msf_u_postmeta['how_old_are_your_children_4'][0] != '' ) ? $msf_u_postmeta['how_old_are_your_children_4'][0] : '';
                
                $msf_how_old_are_your_children_5 = ( isset($msf_u_postmeta['how_old_are_your_children_5'][0]) && $msf_u_postmeta['how_old_are_your_children_5'][0] != '' ) ? $msf_u_postmeta['how_old_are_your_children_5'][0] : '';
                
                $msf_how_old_are_your_children_6 = ( isset($msf_u_postmeta['how_old_are_your_children_6'][0]) && $msf_u_postmeta['how_old_are_your_children_6'][0] != '' ) ? $msf_u_postmeta['how_old_are_your_children_6'][0] : '';
                
                $msf_how_old_are_your_children_7 = ( isset($msf_u_postmeta['how_old_are_your_children_7'][0]) && $msf_u_postmeta['how_old_are_your_children_7'][0] != '' ) ? $msf_u_postmeta['how_old_are_your_children_7'][0] : '';
                
                $msf_how_old_are_your_children_8 = ( isset($msf_u_postmeta['how_old_are_your_children_8'][0]) && $msf_u_postmeta['how_old_are_your_children_8'][0] != '' ) ? $msf_u_postmeta['how_old_are_your_children_8'][0] : '';
                
                $msf_how_old_are_your_children_9 = ( isset($msf_u_postmeta['how_old_are_your_children_9'][0]) && $msf_u_postmeta['how_old_are_your_children_9'][0] != '' ) ? $msf_u_postmeta['how_old_are_your_children_9'][0] : '';
                
                $msf_how_old_are_your_children_10 = ( isset($msf_u_postmeta['how_old_are_your_children_10'][0]) && $msf_u_postmeta['how_old_are_your_children_10'][0] != '' ) ? $msf_u_postmeta['how_old_are_your_children_10'][0] : '';
                
                $msf_how_did_you_deliver_your_last_baby = ( isset($msf_u_postmeta['how_did_you_deliver_your_last_baby'][0]) && $msf_u_postmeta['how_did_you_deliver_your_last_baby'][0] != '' ) ? $msf_u_postmeta['how_did_you_deliver_your_last_baby'][0] : '';
                
                $msf_currently_breastfeeding = ( isset($msf_u_postmeta['currently_breastfeeding'][0]) && $msf_u_postmeta['currently_breastfeeding'][0] != '' ) ? $msf_u_postmeta['currently_breastfeeding'][0] : '';
                
                // echo '"' . $msf_first_name . '","' . $msf_last_name . '","' . $email . '","' . ucfirst($msf_role[0]) . '"' . "\r\n";
                echo $msf_username . "," . $msf_first_name . " " . $msf_last_name . "," . $email . "," . $msf_are_you_a_first_time_mother . "," . $msf_are_you_currently_pregnant . "," . $msf_pregnancy_date . "," . $msf_number_of_children . "," . $msf_how_old_are_your_children_1 . "," . $msf_how_old_are_your_children_2 . "," . $msf_how_old_are_your_children_3 . "," . $msf_how_old_are_your_children_4 . "," . $msf_how_old_are_your_children_5 . "," . $msf_how_old_are_your_children_6 . "," . $msf_how_old_are_your_children_7 . "," . $msf_how_old_are_your_children_8 . "," . $msf_how_old_are_your_children_9 . "," . $msf_how_old_are_your_children_10 .  "," . $msf_how_did_you_deliver_your_last_baby .  "," . $msf_currently_breastfeeding . "\r\n";
            }

            exit();
        }
    }
}