jQuery(document).ready(function($){
    //alert('hi');
    $('input[type="checkbox"]').click(function(){
    if($(this).prop("checked") == true){
        $('#woocom_text_field_title').show();  
    }
    else if($(this).prop("checked") == false){
        $('#woocom_text_field_title').hide();
    }
    });
})