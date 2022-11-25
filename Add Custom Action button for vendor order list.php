<?php
    add_action('wcfm_orders_module_actions',function( $actions, $order_id, $the_order ) {
        if( $the_order->get_user_id() ) {
            $user_id = $the_order->get_user_id();
            $telefono_numero = get_user_meta( $user_id, 'xoo_ml_phone_no', true );
            $telefono_code = get_user_meta( $user_id, 'xoo_ml_phone_code', true );
            $telefono_code1 = substr($telefono_code,1);
            $tel = $telefono_code1.$telefono_numero;
            $telefono_completo= 'https://wa.me/'.$tel;
            
            $actions .= '<a class="wcfm-action-icon" target="_blank" href="'.$telefono_completo.'"><span class="fa fa-whatsapp text_tip" data-tip="' . esc_attr__( 'Mandar WhatsApp', 'wc-frontend-manager' ) . '"></span></a>';
        }
        return $actions;
    }, 50, 3 );
?>