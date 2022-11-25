<?php
    $certificate = $_FILES['file'];
    if ($certificate) {
            $wordpress_upload_dir = wp_upload_dir();
            $new_file_path = $wordpress_upload_dir['path'] . '/' . $i . '_' . $certificate['name'];
            $new_file_mime = mime_content_type( $certificate['tmp_name'] );
            if( move_uploaded_file( $certificate['tmp_name'], $new_file_path ) ) {
                $upload_id = wp_insert_attachment( array(
                    'guid'           => $new_file_path, 
                    'post_mime_type' => $new_file_mime,
                    'post_title'     => preg_replace( '/\.[^.]+$/', '', $certificate['name'] ),
                    'post_content'   => '',
                    'post_status'    => 'inherit'
                ), $new_file_path );
                require_once( ABSPATH . 'wp-admin/includes/image.php' );
                wp_update_attachment_metadata( $upload_id, wp_generate_attachment_metadata( $upload_id, $new_file_path ) );
                $haveMeta=metadata_exists('user', $userId, 'user_certificate');

                if (!$haveMeta) {
                    add_user_meta( $userId, 'user_certificate', $upload_id);
                }else{
                    update_user_meta($userId, 'user_certificate', $upload_id);
                }
            }
    }










    add_shortcode('upload_user_document', 'upload_user_document_function');
?>


























<?php
	/* Template Name: Documents */
    function upload_user_document_function(){

        if(!is_user_logged_in()){
            $login_redirection = site_url('/login');
            wp_redirect($login_redirection);
        }

        $userId = get_current_user_id();
        if($_POST['submit_document']){
            $document = $_FILES['fileToUpload'];
            if ($document) {
                $wordpress_upload_dir = wp_upload_dir();
                $new_file_path = $wordpress_upload_dir['path'] . '/' . $i . '_' . $document['name'];
                $new_file_mime = mime_content_type( $document['tmp_name'] );
                if( move_uploaded_file( $document['tmp_name'], $new_file_path ) ) {
                    $upload_id = wp_insert_attachment( array(
                        'guid'           => $new_file_path, 
                        'post_mime_type' => $new_file_mime,
                        'post_title'     => preg_replace( '/\.[^.]+$/', '', $document['name'] ),
                        'post_content'   => '',
                        'post_status'    => 'inherit'
                    ), $new_file_path );
                    require_once( ABSPATH . 'wp-admin/includes/image.php' );
                    wp_update_attachment_metadata( $upload_id, wp_generate_attachment_metadata( $upload_id, $new_file_path ) );
                    $haveMeta=metadata_exists('user', $userId, 'user_document');

                    if (!$haveMeta) {
                        $upload_id_arr[] = $upload_id;
                        add_user_meta( $userId, 'user_document', $upload_id_arr);
                    }else{
                        $upload_id_arr = get_user_meta($userId, 'user_document', true);
                        $upload_id_arr[] = $upload_id;
                        update_user_meta($userId, 'user_document', $upload_id_arr);
                    }
                }
            }
        }

}
?>

<?php get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main document-custom-page" role="main">
		<form action="" method="post" enctype="multipart/form-data">
			<input type="file" name="fileToUpload" id="fileToUpload">
			<input type="submit" value="Upload" name="submit_document">
		</form>
        <div>
            <table>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                </tr>
                <?php
                    $user_docs = get_user_meta($userId, 'user_document', true);
                    if($user_docs !== ''){
                        $count = 1;
                        foreach ($user_docs as $docs_key) { ?>
                            <tr>
                                <td><?php echo $count++; ?></td>
                                <td>
                                    <a href="<?php echo wp_get_attachment_url($docs_key); ?>"><?php echo get_the_title($docs_key); ?></a>
                                </td>
                            </tr>
                        <?php }
                    } else { ?>
                        <tr>
                            <td colspan="2">
                                <h3>No document available</h3>
                            </td>
                        </tr>
                    <?php }
                ?>
            </table>
        </div>
	</main>
</div>

<?php get_footer(); ?>









<?php
/* add new tab called "docTab" */
add_filter('um_account_page_default_tabs_hook', 'account_document_tab', 100 );
function account_document_tab( $tabs ) {
	$tabs[800]['docTab']['icon'] = 'um-faicon-pencil';
	$tabs[800]['docTab']['title'] = 'Documents';
	$tabs[800]['docTab']['custom'] = true;
	return $tabs;
}

/* make our new tab hookable */
add_action('um_account_tab__docTab', 'um_account_tab__docTab');
function um_account_tab__docTab( $info ) {
	global $ultimatemember;
	extract( $info );

	$output = $ultimatemember->account->get_tab_output('docTab');
	if ( $output ) { echo $output; }
}

/* Finally we add some content in the tab */
add_filter('um_account_content_hook_docTab', 'um_account_content_hook_docTab');
function um_account_content_hook_docTab( $output ){
	ob_start();
	?>
		
	<div class="um-field">
		
		<!-- Here goes your custom content -->
		
	</div>		
		
	<?php
		
	$output .= ob_get_contents();
	ob_end_clean();
	return $output;
}










<a href="https://demowebs.1stopwebsitesolution.com/diplomatic_property/documents/">
	<span class="um-account-icon uimob800-hide">
	    <i class="um-faicon-user"></i>
    </span>
    <span class="um-document-title">Documents</span>
</a>