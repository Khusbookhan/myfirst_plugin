
/**
* this is the jquery function for checkbox cheked for discount price field in product page
*/
jQuery(document).ready(function($){ 
    
    $('#woocom_text_field_title').parent().hide();
       $('#woocom_text_field_title').prop('required',false);
        if( $('#checkbox_discount').prop("checked") == true){
            $('#woocom_text_field_title').parent().show();
            $('#woocom_text_field_title').prop('required',true);   
        }
    $('#checkbox_discount').click(function(){
        
        $('#woocom_text_field_title').parent().hide();
        $('#woocom_text_field_title').prop('required',false);
        if( $(this).prop("checked") == true){
            $('#woocom_text_field_title').parent().show();
            $('#woocom_text_field_title').prop('required',true);

        }

     $('#woocom_text_field_title').parent().hide();
       $('#woocom_text_field_title').prop('required',false);
        if( $(this).prop("checked") == true){
            $('#woocom_text_field_title').parent().show();
            $('#woocom_text_field_title').prop('required',true);
               
        }  
           
        

    });
});