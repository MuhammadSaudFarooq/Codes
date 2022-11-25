<?php
// Image Upload
add_action("wp_ajax_coordinates_img_upload", "coordinates_img_upload_fn");
add_action("wp_ajax_nopriv_coordinates_img_upload", "coordinates_img_upload_fn");

function coordinates_img_upload_fn() {
	$img_pos = $_POST['img_pos'];
	$img_meta_key_name = 'user_coordinate_'.$img_pos;
	$img_url = '';
	if(isset($_FILES)) {
		$userId = get_current_user_id();
		$img_file = $_FILES['img_data'];
		if ($img_file) {
			$wordpress_upload_dir = wp_upload_dir();
			$new_file_path = $wordpress_upload_dir['path'] . '/' . $i . '_' . $img_file['name'];
			$new_file_mime = mime_content_type( $img_file['tmp_name'] );
			if( move_uploaded_file( $img_file['tmp_name'], $new_file_path ) ) {
				$upload_id = wp_insert_attachment( array(
					'guid'           => $new_file_path, 
					'post_mime_type' => $new_file_mime,
					'post_title'     => preg_replace( '/\.[^.]+$/', '', $img_file['name'] ),
					'post_content'   => '',
					'post_author'   => $userId,
					'post_status'    => 'inherit'
				), $new_file_path );
				require_once( ABSPATH . 'wp-admin/includes/image.php' );
				wp_update_attachment_metadata( $upload_id, wp_generate_attachment_metadata( $upload_id, $new_file_path ) );
				$haveMeta=metadata_exists('user', $userId, $img_meta_key_name);

				if (!$haveMeta) {
					add_user_meta( $userId, $img_meta_key_name, $upload_id);
					$img_url = wp_get_attachment_url($upload_id);
				}else{
					update_user_meta($userId, $img_meta_key_name, $upload_id);
					$img_url = wp_get_attachment_url($upload_id);
				}
			}
		}
	}
	print_r(json_encode($img_url));
    exit;
}
?>
<script>
// Image selection
$("input#upload-image").on("input", function() {
    if ($(".shirt-img .customize-area-active").length) {
        let fd = new FormData();
        let img_pos = $(".customize-area-active").data("coordinatenum");
        let files = $(this)[0].files;
        if (files.length > 0) {
            fd.append("img_data", files[0]);
            fd.append("img_pos", img_pos);
            fd.append("action", "coordinates_img_upload");
            $.ajax({
                url: ajax_url,
                type: "post",
                data: fd,
                cache: false,
                contentType: false,
                processData: false,
                enctype: "multipart/form-data",
                success: function(response) {
                    let img_url = JSON.parse(response);
                    $("input#upload-image").val("");
                    if (!$(".customize-area-active>span>img").length) {
                        $(".customize-area-active>span")[0].childNodes[0].textContent =
                            "";
                        $(".customize-area-active>span").append(
                            `<img src='${img_url}' id='selected_img' />`
                        );
                    } else {
                        $(".customize-area-active>span")[0].childNodes[0].textContent =
                            "";
                        $(".customize-area-active>span>img").attr("src", img_url);
                    }
                },
                error: function(error) {
                    console.log(error);
                },
            });
        }
    }
});
</script>