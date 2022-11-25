<?php
// order placed
function msf_register_order_palced_order_status() {
    register_post_status( 'wc-order-placed', array(
        'label'                     => 'Order Placed',
        'public'                    => true,
        'show_in_admin_status_list' => true,
        'show_in_admin_all_list'    => true,
        'exclude_from_search'       => false,
        'label_count'               => _n_noop( 'Order Placed <span class="count">(%s)</span>', 'Order Placed <span class="count">(%s)</span>' )
    ) );
}
add_action( 'init', 'msf_register_order_palced_order_status' );

function add_awaiting_order_placed_to_order_statuses( $order_statuses ) {

    $new_order_statuses = array();

    foreach ( $order_statuses as $key => $status ) {

        $new_order_statuses[ $key ] = $status;

        if ( 'wc-processing' === $key ) {
            $new_order_statuses['wc-order-placed'] = 'Order Placed';
        }
    }

    return $new_order_statuses;
}
add_filter( 'wc_order_statuses', 'add_awaiting_order_placed_to_order_statuses' );