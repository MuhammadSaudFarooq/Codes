<?php


// require_once(dirname(__FILE__) . '/assets/multibyte_supplicant.php');

// $nonce = wp_create_nonce("handle_form_data_nonce");




add_action("wp_ajax_handle_form_data", "sty_handle_form_data");
add_action("wp_ajax_nopriv_handle_form_data", "sty_handle_form_data");

function sty_handle_form_data() {

    // if ( !wp_verify_nonce( $_REQUEST['_nonce'], "handle_form_data_nonce")) {
    //     exit("No naughty business please");
    //  }

    $_POST['attr_value'];


     return 'success';
}



?>


<script type="text/javascript">

    jQuery('xyz').on('click',function(){

        var attr_value = jQuery('select').attr('name');

        jQuery.ajax({

          type : 'post',
          cache : false,
          url : '<?php echo admin_url("admin-ajax.php"); ?>',
          data : {

            action: "handle_form_data",
            attr_value: attr_value,

          },
          success: function(response) {

            if(response == 'success'){
                alert('Value has been added');
            }
            
          }

        })


    })
    
    



// For loading 

$.ajax({
   url: 'fetch_deta.php',
   type: 'post',
   data: {search:search},
   beforeSend: function(){
    // Show image container
    $("#loader").show();
   },
   success: function(response){
    $('.response').empty();
    $('.response').append(response);
   },
   complete:function(data){
    // Hide image container
    $("#loader").hide();
   }
  });





</script>