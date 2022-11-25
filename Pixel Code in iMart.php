<?php
/*Extra field on the seller settings and show the value on the store banner -Dokan*/

// Add extra field in seller settings

add_filter( 'dokan_settings_form_bottom', 'extra_fields', 10, 2);

function extra_fields( $current_user, $profile_info ){
$seller_url= isset( $profile_info['seller_url'] ) ? $profile_info['seller_url'] : '';
?>
 <div class="gregcustom dokan-form-group">
        <label class="dokan-w3 dokan-control-label" for="setting_address">
            <?php _e( 'Pixel Code', 'dokan' ); ?>
        </label>
        <div class="dokan-w5">
            <input type="text" class="dokan-form-control input-md valid" name="seller_url" id="reg_seller_url" value="<?php echo $seller_url; ?>"/>
        </div>
    </div>
    <?php
}

    //save the field value

add_action( 'dokan_store_profile_saved', 'save_extra_fields', 15 );
function save_extra_fields( $store_id ) {
    $dokan_settings = dokan_get_store_info($store_id);
    if ( isset( $_POST['seller_url'] ) ) {
        $dokan_settings['seller_url'] = $_POST['seller_url'];
    }
 update_user_meta( $store_id, 'dokan_profile_settings', $dokan_settings );
}

    // show on the store page

add_action( 'dokan_store_header_info_fields', 'save_seller_url', 10);

function save_seller_url($store_user){

    $store_info    = dokan_get_store_info( $store_user);

   ?>
        <?php if ( isset( $store_info['seller_url'] ) && !empty( $store_info['seller_url'] ) ) { ?>
            <i class="fa fa-globe"></i>
            <a href="<?php echo esc_html( $store_info['seller_url'] ); ?>"><?php echo esc_html( $store_info['seller_url'] ); ?></a>
    
    <?php } ?>
       
  <?php

}
?>