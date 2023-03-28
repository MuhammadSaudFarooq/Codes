<?php
// Airtable posts edit by admin dashboard
add_action('admin_menu', 'optionPageName_menu');
function optionPageName_menu() {
	add_menu_page(
		'Option Page Title',
		'Option Page Title',
		'manage_options',
		'optionPageName',
		'optionPageName_page_callback',
		'dashicons-edit',
		50
	);

	add_submenu_page(
		'optionPageName',
		'Add New',
		'Add New',
		'manage_options',
		'optionPageNewPostName',
		'optionPageNewPostName_page_callback',
	);
}

// Main option page file
function optionPageName_page_callback() {
	get_template_part('template-parts/file', 'name');
}

// Sub menu file name
function optionPageNewPostName_page_callback() {
	get_template_part('template-parts/file', 'name');
}