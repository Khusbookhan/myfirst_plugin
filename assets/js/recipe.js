
/**
* this is the function that on serchbox getting all search post
*/
jQuery(document).ready(function($){

    $("#keyword").on("keyup",function(){
   // console.log( frontend_ajax_object.ajaxurl)
        var fetch = $(this).val();
       
        jQuery.ajax({
            url:   front_ajax_object.ajaxurl,
            type: 'post',
            data:  { 
            action: 'data_fetch',  
            keyword: fetch
            },
            success:function(data) {
                console.log(data)
                 jQuery('#primary').html( data );
    
            }
        });
    
    
      
    });

    /**
    * function for drop down on option selected to sort posts
    */
    
    $("#selection").change(function(){
        var keyword = $(this).find("option:selected").text();
        var keyword = $(this).val();
        console.log(keyword)
        jQuery.ajax({
            url:   front_ajax_object.ajaxurl,
            type: 'POST',
            data: { 
                action: 'filter',  
                keyword: keyword 
            },
            success: function(data) {
                jQuery('#primary').html( data );
            }
        });
    });
       
});