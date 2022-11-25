jQuery('.reviews_shortcode').on('click', function(){
    // Select the text field
    jQuery(this).select();
    // Copy the text inside the text field
    navigator.clipboard.writeText(jQuery(this).text());
})