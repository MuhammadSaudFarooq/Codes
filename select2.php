<?php
// Country and City Ajax
add_action("wp_ajax_state_data", "msf_state_data", 1);
add_action("wp_ajax_nopriv_state_data", "msf_state_data");

function msf_state_data(){
    global $wpdb;
    $table_name = strtolower($wpdb->prefix) . 'datebook_countries';
    $sql = "SELECT * FROM " . $table_name . " WHERE parent_id = ".$_POST['msf_country_id']." AND active = 1 ORDER BY slug ASC";
    $msf_result2 = $wpdb->get_results($sql);
    echo "<option></option>";
    foreach ($msf_result2 as $key2) {
        $msf_statename = maybe_unserialize($key2->name);
        echo "<option value=".$key2->id.">".$msf_statename['en_US']."</option>";
    }
    return 'success';
    exit;
}


add_action("wp_ajax_city_data", "msf_city_data");
add_action("wp_ajax_nopriv_city_data", "msf_city_data");

function msf_city_data(){
    global $wpdb;
    $table_name = strtolower($wpdb->prefix) . 'datebook_countries';
    $sql = "SELECT * FROM " . $table_name . " WHERE parent_id = ".$_POST['msf_state_id']." AND active = 1 ORDER BY slug ASC";
    $msf_result3 = $wpdb->get_results($sql);
    echo "<option></option>";
    foreach ($msf_result3 as $key3) {
        $msf_cityname = maybe_unserialize($key3->name);
        echo "<option value=".$key3->id.">".$msf_cityname['en_US']."</option>";
    }
    return 'success';
    exit;
}
?>
<script>
// Country and City
  		
// Placeholders
jQuery(".js-example-placeholder-single.msf_country").select2({
    placeholder: "País",
    allowClear: true
});
jQuery(".js-example-placeholder-single.msf_state").select2({
    placeholder: "Estado",
    allowClear: true
});
jQuery(".js-example-placeholder-single.msf_city").select2({
    placeholder: "Ciudad",
    allowClear: true
});

jQuery(document).on('change', function(){
    var msf_selectedCountry = jQuery(".msf_country option:selected").val();
    jQuery("input:hidden#datebook-locationcountry").val(msf_selectedCountry);
});
// jQuery(document).on('change','.msf_country', function(){
//     var msf_selectedCountry = this.val();
//     this.parent().find("input:hidden#datebook-locationcountry").val(msf_selectedCountry);
// });
jQuery(document).on('change', function(){
    var msf_selectedState = jQuery(".msf_state option:selected").val();
    jQuery("input:hidden#datebook-locationregion").val(msf_selectedState);
});
jQuery(document).on('change', function(){
    var msf_selectedCity = jQuery(".msf_city option:selected").val();
    jQuery("input:hidden#datebook-locationcity").val(msf_selectedCity);
});

jQuery('.msf_country').on('change',function(){
    var msf_this_country = jQuery(this);
    // var msf_country_id = jQuery(".msf_country option:selected").val();
    var msf_country_id = msf_this_country.val();
    jQuery.ajax({
        type : 'post',
        cache : false,
        url : '<?php echo admin_url("admin-ajax.php"); ?>',
        data : {
        action: "state_data",
        msf_country_id: msf_country_id,
        },
        success: function(response) {
        // jQuery("select.msf_state").html(response);
        msf_this_country.parent().find('select.msf_state').html(response);
        }
    })
})

jQuery('.msf_state').on('change',function(){
    var msf_this_state = jQuery(this);
    // var msf_state_id = jQuery(".msf_state option:selected").val();
    var msf_state_id = msf_this_state.val();
    jQuery.ajax({
        type : 'post',
        cache : false,
        url : '<?php echo admin_url("admin-ajax.php"); ?>',
        data : {
        action: "city_data",
        msf_state_id: msf_state_id,
        },
        success: function(response) {
        // jQuery("select.msf_city").html(response);
        msf_this_state.parent().find('select.msf_city').html(response);
        }
    })
})
</script>

<!-- Country and City Dropdown -->
<select class="js-example-placeholder-single js-states form-control msf_country" name="msf_country">
<?php
    $table_name = strtolower($wpdb->prefix) . 'datebook_countries';
    $sql = "SELECT * FROM " . $table_name . " WHERE parent_id = 0 AND active = 1 ORDER BY slug ASC";
    $msf_result1 = $wpdb->get_results($sql);
    echo "<option></option>";
    foreach ($msf_result1 as $key1) {
        $msf_countryname = maybe_unserialize($key1->name);
        echo "<option value=".$key1->id.">".$msf_countryname['en_US']."</option>";
    }
?>
</select>
<select class="js-example-placeholder-single js-states form-control msf_state" name="msf_state">
</select>
<select class="js-example-placeholder-single js-states form-control msf_city" name="msf_city">
</select>