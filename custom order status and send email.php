<?php
/**
     * Add custom status to order list
*/

// Delivered
    add_action( 'init', 'msf_register_delivered_order_status', 10 );
    function msf_register_delivered_order_status() {
        register_post_status( 'wc-delivered', array(
            'label'                     => _x( 'Delivered', 'Order status', 'woocommerce' ),
            'public'                    => true,
            'exclude_from_search'       => false,
            'show_in_admin_all_list'    => true,
            'show_in_admin_status_list' => true,
            'label_count'               => _n_noop( 'Delivered <span class="count">(%s)</span>', 'Delivered <span class="count">(%s)</span>', 'woocommerce' )
        ) );

}

/**
 * Add custom status to order page drop down
 */
add_filter( 'wc_order_statuses', 'add_awaiting_delivered_to_order_statuses' );
function add_awaiting_delivered_to_order_statuses( $order_statuses ) {
    $order_statuses['wc-delivered'] = _x( 'Delivered', 'Order status', 'woocommerce' );
    return $order_statuses;
}

// Send email
add_filter( 'woocommerce_email_actions', 'filter_woocommerce_email_actions_delivered' );
function filter_woocommerce_email_actions_delivered( $actions ){
    $actions[] = 'woocommerce_order_status_wc-delivered';
    return $actions;
}

// Send Customer Processing Order email notification when order status get changed from "tree" to "processing"
add_action('woocommerce_order_status_changed', 'msf_status_custom_notification', 10, 4);
function msf_status_custom_notification( $order_id, $from_status, $to_status, $order ) {
    if(  'delivered' === $to_status ) {
        // The email notification type
        $email_key   = 'WC_Email_Customer_Processing_Order';
        // Get specific WC_emails object
        $email_obj = WC()->mailer()->get_emails()[$email_key];
        // Sending the customized email
        $email_obj->trigger( $order_id );
    }
}
// Customize email heading for this custom status email notification
add_filter( 'woocommerce_email_heading_customer_processing_order', 'email_heading_customer_order', 10, 2 );
function email_heading_customer_order( $heading, $order ){
    if( $order->has_status( 'delivered' ) ) {
        $email_key   = 'WC_Email_Customer_Processing_Order'; // The email notification type
        $email_obj   = WC()->mailer()->get_emails()[$email_key]; // Get specific WC_emails object
        $heading_txt = sprintf( __('Order #%s has been Delivered', 'woocommerce'), '{order_number}' ); // New subject text
        return $email_obj->format_string( $heading_txt );
    }
    return $heading;
}
// Customize email subject for this custom status email notification
add_filter( 'woocommerce_email_subject_customer_processing_order', 'email_subject_customer_order', 10, 2 );
function email_subject_customer_order( $subject, $order ){
    if( $order->has_status( 'delivered' ) ) {
        $email_key   = 'WC_Email_Customer_Processing_Order'; // The email notification type
        $email_obj   = WC()->mailer()->get_emails()[$email_key]; // Get specific WC_emails object
        $subject_txt = sprintf( __('Your %s Order #%s has been Delivered', 'woocommerce'), '{site_title}', '{order_number}' ); // New subject text
        return $email_obj->format_string( $subject_txt );
    }
    return $subject;
}