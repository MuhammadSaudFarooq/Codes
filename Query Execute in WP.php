<?php
global $wpdb;
$query = "SELECT * FROM `table_name` WHERE `original` = '_wp_attached_file'";
$result = $wpdb->get_results($query);