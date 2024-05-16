<?php

function schedule_name($schedules)
{
    $schedules['once_every_2m'] = array('interval' => 120, 'display' => 'Once every 2 minutes');
    return $schedules;
}
add_filter('cron_schedules', 'schedule_name');

if (!wp_next_scheduled('name_of_your_job')) {
    wp_schedule_event(1481799444, 'once_every_2m', 'name_of_your_job');
}
add_action('name_of_your_job', 'name_of_your_function');
