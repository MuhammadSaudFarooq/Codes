<?php
// https://wordpress.org/plugins/wp-pagenavi/


$paged = (get_query_var( 'paged' )) ? get_query_var( 'paged' ) : 1;


$args = array(
'post_type' => 'affiliate_networks',
'hide_empty'     => 'false',
'posts_per_page' => 9,
'paged' => $paged,
'orderby' => 'date',
'order'   => 'DESC',
'tax_query' => array(
    'relation' => 'AND',
    array(
        'taxonomy' => 'tracking_software',
        'field'    => 'term_id',
        'terms'    => $ts_id,
    ),
    array(
        'taxonomy' => 'payment_frequency',
        'field'    => 'term_id',
        'terms'    => $ps_id,
    ),
  )
);


$posts = new WP_Query( $args );