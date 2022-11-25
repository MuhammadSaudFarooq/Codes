<?php
add_action( 'dokan_store_profile_saved', 'msf_save_extra_policy_fields', 10, 2 );
function msf_save_extra_policy_fields( $store_id, $dokan_settings ) {

    if ( isset( $_POST['msf_shipping_policy'] ) ) {
        $dokan_settings['msf_shipping_policy'] = $_POST['msf_shipping_policy'];
    }

    if ( isset( $_POST['msf_refund_policy'] ) ) {
        $dokan_settings['msf_refund_policy'] = $_POST['msf_refund_policy'];
    }
    update_user_meta( $store_id, 'dokan_profile_settings', $dokan_settings );
}

/*
* Showing field data on product edit page
*/

// add_action('dokan_product_edit_after_product_tags','show_on_edit_page',99,8);
add_filter( 'dokan_settings_after_banner', 'show_on_edit_page', 10, 2);
function show_on_edit_page($current_user, $profile_info){
$msf_policy = get_user_meta( $current_user, 'dokan_profile_settings', true );
$msf_shipping_policy = $msf_policy['msf_shipping_policy'];
$msf_refund_policy = $msf_policy['msf_refund_policy'];
?>
<div class="dokan-form-group">
    <label class="dokan-w3 dokan-control-label" for="dokan_gravatar">Shipping Policy</label>
    <div class="dokan-w5 dokan-gravatar">
        <div class="dokan-feat-image-upload" style="text-align: left;">
            <?php
            $wrap_class        = ' dokan-hide';
            $instruction_class = '';
            $feat_image_id     = 0;
            $view_shipping_policy = wp_get_attachment_url($msf_shipping_policy);

            if (!empty($msf_shipping_policy) ) {
                $wrap_class        = '';
                $instruction_class = ' dokan-hide';
                // $imaid =attachment_url_to_postid($msf_shipping_policy);
            }
            ?>

            <div class="instruction-inside<?php echo esc_attr( $instruction_class ); ?>" style="width:50%; display: inline;">
                <input type="hidden" name="msf_shipping_policy" class="dokan-feat-image-id" value="<?php echo esc_attr($msf_shipping_policy ); ?>">

                <i class="fa fa-cloud-upload"></i>
                <a href="#" class="dokan-feat-image-btn btn btn-sm" style="background-color:#EA1D2C; color: #ffffff;"><?php esc_html_e( 'Upload file', 'dokan-lite' ); ?></a>
            </div>
            <?php
                if(!empty($msf_shipping_policy)){
            ?>
            <div class="instruction-inside" style="width:50%; display: inline;">
                <i class="fa fa-cloud-upload"></i>
                <a href='<?php echo $view_shipping_policy ?>' target="_blank" class="btn btn-sm" style="background-color:#EA1D2C; color: #ffffff;"><?php esc_html_e( 'View file', 'dokan-lite' ); ?></a>
            </div>
        <?php } ?>
        </div><!-- .dokan-feat-image-upload -->
    </div>
</div><!-- .dokan-form-group -->



<div class="dokan-form-group">
    <label class="dokan-w3 dokan-control-label" for="dokan_gravatar">Refund Policy</label>
    <div class="dokan-w5 dokan-gravatar">
        <div class="dokan-feat-image-upload" style="text-align: left;">
            <?php
            $wrap_class        = ' dokan-hide';
            $instruction_class = '';
            $feat_image_id     = 0;
            $view_refund_policy = wp_get_attachment_url($msf_refund_policy);

            if (!empty($msf_refund_policy) ) {
                $wrap_class        = '';
                $instruction_class = ' dokan-hide';
                // $imaid =attachment_url_to_postid($msf_refund_policy);
            }
            ?>

            <div class="instruction-inside<?php echo esc_attr( $instruction_class ); ?>" style="width:50%; display: inline;">
                <input type="hidden" name="msf_refund_policy" class="dokan-feat-image-id" value="<?php echo esc_attr($msf_refund_policy ); ?>">

                <i class="fa fa-cloud-upload"></i>
                <a href="#" class="dokan-feat-image-btn btn btn-sm" style="background-color:#EA1D2C; color: #ffffff;"><?php esc_html_e( 'Upload file', 'dokan-lite' ); ?></a>
            </div>

            <?php
                if(!empty($msf_refund_policy)){
            ?>
            <div class="instruction-inside" style="width:50%; display: inline;">
                <i class="fa fa-cloud-upload"></i>
                <a href='<?php echo $view_refund_policy ?>' target="_blank" class="btn btn-sm" style="background-color:#EA1D2C; color: #ffffff;"><?php esc_html_e( 'View file', 'dokan-lite' ); ?></a>
            </div>
        <?php } ?>
        </div><!-- .dokan-feat-image-upload -->
    </div>
</div><!-- .dokan-form-group -->


<?php
}