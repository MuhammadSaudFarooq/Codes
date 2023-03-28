<?php
// Include CSS file
wp_enqueue_style("style.css", get_stylesheet_directory_uri() . "/template-parts/calculator/css/style.css");
// Include JS file
wp_enqueue_script("script", get_stylesheet_directory_uri() . "/template-parts/calculator/js/script.js");
wp_localize_script('script', 'url', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ), 'siteurl' => site_url() ) );