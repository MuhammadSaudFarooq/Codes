<?php
// Cloth Customize
add_action( 'admin_menu', 'cloth_customize_menu' );
 
function cloth_customize_menu(){
 
	add_menu_page(
		'Cloth Customize', // page <title>Title</title>
		'Cloth Customize', // link text
		'manage_options', // user capabilities
		'cloth_customize', // page slug
		'cloth_customize_page_callback', // this function prints the page content
		'dashicons-admin-customizer', // icon (from Dashicons for example)
		4 // menu position
	);
}
 
function cloth_customize_page_callback(){
	echo 'What is up?';
}