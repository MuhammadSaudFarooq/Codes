// Add Input field in dokan store
<?php
function msf_policy( $current_user, $profile_info ) {
    $pv_local_pickup_enabled = isset( $profile_info['pv_local_pickup_enabled'] ) ? esc_attr($profile_info['pv_local_pickup_enabled']) : 'no';
    $msf_shipping_policy = isset( $profile_info['msf_shipping_policy'] ) ? $profile_info['msf_shipping_policy'] : '';
    $msf_refund_policy = isset( $profile_info['msf_refund_policy'] ) ? $profile_info['msf_refund_policy'] : '';
    ?>       
                
    <div class="gregcustom dokan-form-group"> 
        <label class="dokan-w3 dokan-control-label" for="policy"><?php _e( 'Shipping Policy', 'dokan' ); ?></label>
        <div class="dokan-w5">
            <input type="file" class="dokan-form-control input-md valid" name="msf_shipping_policy" id="msf_reg_shipping_policy" value="<?php echo $billing_postcode; ?>" />
        </div>
    </div>    
    <div class="gregcustom dokan-form-group">
        <label class="dokan-w3 dokan-control-label" for="policy"><?php _e( 'Refund Policy', 'dokan' ); ?></label>
        <div class="dokan-w5">
            <input type="file" class="dokan-form-control input-md valid" name="msf_refund_policy" id="msf_reg_refund_policy" value="<?php echo $msf_refund_policy; ?>" />
        </div>
    </div>
                
    <?php
}
add_filter( 'dokan_settings_after_banner', 'msf_policy', 10, 2);

/**
 * Save the extra fields.
 *
 * @param  int  $customer_id Current customer ID.
 *
 * @return void
 */
function msf_save_extra_policy_fields( $store_id, $dokan_settings ) {

    if ( isset( $_POST['msf_shipping_policy'] ) ) {
        $dokan_settings['msf_shipping_policy'] = $_POST['msf_shipping_policy'];
    }

    if ( isset( $_POST['msf_refund_policy'] ) ) {
        $dokan_settings['msf_refund_policy'] = $_POST['msf_refund_policy'];
    }
    update_user_meta( $store_id, 'dokan_profile_settings', $dokan_settings );
}

add_action( 'dokan_store_profile_saved', 'msf_save_extra_policy_fields', 10, 2 );