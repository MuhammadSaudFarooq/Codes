<?php
if($_GET['file1'] == 'file1'){
    $file = fopen('https://property247.co.ug/wp-content/uploads/2022/05/1-districts-uganda.csv', 'r');
    $msf_arr = [];
    while (($line = fgetcsv($file)) !== FALSE) {
        $msf_arr[] = $line;
    }
    foreach ($msf_arr as $val) {
        if(!post_exists($val[0])){
            $grand_p_id = wp_insert_post( array(
                'post_status'   => 'publish',
                'post_type'     => 'custom-destination',
                'post_title'    => $val[0],
                'post_category' => array(44),
            ) );
        } else {
            if(!post_exists($val[1])){
                $grand_p_id = get_page_by_title($val[0], null,'custom-destination');
                $parent_id = wp_insert_post( array(
                    'post_status'   => 'publish',
                    'post_type'     => 'custom-destination',
                    'post_title'    => $val[1],
                    'post_category' => array(45),
                    'post_parent'   => $grand_p_id->ID,
                ) );
            }
            else{
                if(!post_exists($val[2])){
                    $parent_id = get_page_by_title($val[1], null,'custom-destination');
                    $child_id = wp_insert_post( array(
                        'post_status'   => 'publish',
                        'post_type'     => 'custom-destination',
                        'post_title'    => $val[2],
                        'post_category' => array(46),
                        'post_parent'   => $parent_id->ID,
                    ) );
                }
            }
        }
    }
    fclose($file);
}