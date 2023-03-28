<?php
function functionName($params) {
	ob_start();
    // template-parts/file-name
	get_template_part('template-parts/file', 'name', $params);
	return ob_get_clean();
}
add_shortcode('shortcode_name', 'functionName');