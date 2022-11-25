<?php
add_filter( 'woocommerce_gateway_icon', 'custom_payment_gateway_icons', 10, 2 );
function custom_payment_gateway_icons( $icon, $gateway_id ){

    foreach( WC()->payment_gateways->get_available_payment_gateways() as $gateway )
        if( $gateway->id == $gateway_id ){
            $title = $gateway->get_title();
            break;
        }

    // The path (subfolder name(s) in the active theme)
    $path = get_stylesheet_directory_uri(). '/assets';

    // Setting (or not) a custom icon to the payment IDs
    if($gateway_id == 'cod')
        $icon = '<img src="' . site_url( "/wp-content/uploads/2022/06/AdobeStock_313020880-Converted-ai-1.png" ) . '" alt="' . esc_attr( $title ) . '" class="cod_payment_logo" />';
    elseif( $gateway_id == 'wctelr' )
        $icon = '<img src="' . site_url( "/wp-content/uploads/2022/06/Telr_cmyk-2.jpg" ) . '" alt="' . esc_attr( $title ) . '" class="telr_payment_logo" />';
        return $icon;

    return $icon;
}