jQuery(document).ready(function($){ 
    
    $('#woocom_text_field_title').parent().hide();
        if( $('#checkbox_discount').prop("checked") == true){
            $('#woocom_text_field_title').parent().show();   
        }
    $('#checkbox_discount').click(function(){
        
        $('#woocom_text_field_title').parent().hide();
        if( $(this).prop("checked") == true){
            $('#woocom_text_field_title').parent().show();   
        }

    });
});