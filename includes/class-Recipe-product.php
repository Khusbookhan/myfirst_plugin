<?php

if (! defined('ABSPATH')) {
    die;
}

  /**
  * this is the class for adding discount field in product page,showing discount on the single page and replacing cart prices of each item with the discount price 
  */
class Recipe_productpage
{

     /*
     *
     *contructor
     *
     */

  public function __construct()

  {
    //saving texfield and checkbox values 
    add_action( 'woocommerce_process_product_meta',  array($this, 'textfield_value_saving')); 
   
      //showing value to add to cart
    add_filter( 'woocommerce_get_price_html', array($this, 'showing_discount_singleproduct' ));
       
        //checbox add
    add_action('woocommerce_product_options_general_product_data',array($this, 'Adding_checkbox_and_field'));
       
    //showing regular and sale price
    add_action( 'woocommerce_before_calculate_totals', array( $this, 'cart_price_update' ) );
    //validation 
    //add_filter( 'woocommerce_add_to_cart_validation', array( $this,  'cfwc_validate_custom_field', 10, 3 ));
     

     

  }
    
    /**
  * Saving value of discount field in database 
  */
  public function textfield_value_saving( $post_id )
  {
    $discount = isset( $_POST['woocom_text_field_title'] ) ? $_POST['woocom_text_field_title'] : '';
    $checkbox = isset( $_POST['checkbox_discount'] ) ? $_POST['checkbox_discount'] : '';
    if ($_POST['checkbox_discount'] == true){
     
        update_post_meta( $post_id, "woocom_text_field_title", $discount );
        update_post_meta( $post_id, "checkbox_discount", $checkbox  );
      }

      if($_POST['checkbox_discount'] ==false){
     
        update_post_meta( $post_id, "", $discount );
        update_post_meta( $post_id, "", $checkbox );
      }
  }
        
    
  /**
  * Adding checkbox and field
  */

  public function Adding_checkbox_and_field ()
  {

    global $post;
    woocommerce_wp_checkbox(array(
        'id'            => 'checkbox_discount',
        'label'         => __('Add discount value', 'woocommerce' ),
        'description'   => __( '', 'woocommerce' ),
        
        
    ));

    global $woocommerce;
   
    woocommerce_wp_text_input
    (
        array(
            'id'            => 'woocom_text_field_title',
            'placeholder'   => 'Insert Discount value',
            'label'         => __( '', 'woofiled' ),
            'desc_tip'      => 'true',
             'type'         => 'number',
             'custom_attributes' => array(
             'step'         => 'any',
             'min'          => '0',
             'max'          =>'100',
             

                  )
            )
    );

    
  
  }
 

      /**
  * Showing discount on single page
  */
  public function showing_discount_singleproduct($price)
  {

    global $post;
    $product_id = $post->ID;
    $checbox_value = get_post_meta( $product_id, 'checkbox_discount', true );
    if($checbox_value=="yes"){  
      $product = wc_get_product( $product_id );
      $discount_price = get_post_meta( $product_id, 'woocom_text_field_title', true );
      $regular_price = $product->get_regular_price();
      $price = $regular_price * ((100 - $discount_price)/ 100) ;
      $price = $this->Apply_discount($product_id);
    
    }
       $new=$price;
    ?>
    <p style="font-size:18px;color:red;"><b>You Save: <?php echo ($price); ?></b></p>  
              
    <?php           
  }
     
  /**
  * Showing discount on cart page price coloumn
  */
  public function cart_price_update( $cart_object )
  {

    if($cart_object){
      foreach ( $cart_object->get_cart() as $hash => $value ) {
        $product_id = $value['product_id']; 
        $discount_checkbox = get_post_meta( $product_id, 'checkbox_discount', true );
        if(!$discount_checkbox == null){  
          $new_price = $this->Apply_discount($product_id);
          $value[ 'data' ]->set_price( $new_price);
        }
      }
    }
  }

    /**
  * This is the function for getting discount  
  */
  public function Apply_discount($product_id)
  {
      $product = wc_get_product( $product_id );
      $discount_price = get_post_meta( $product_id, 'woocom_text_field_title', true );
      $regular_price = $product->get_regular_price();
      $new_price = $regular_price * ((100 - $discount_price)/ 100) ;
      return $new_price;
  } 

  // /**
  // *validating fields
  // */
  // public function cfwc_validate_custom_field( $passed, $product_id, $quantity )
  //  {
  //  if( empty( $_POST['woocom_text_field_titl'] ) ) {
  //  // Fails validation
  //  $passed = false;
  //  wc_add_notice( __( 'Please enter a value into the text field' ), 'error' );
  //  }
  //  return $passed; 
  //  }

}
new Recipe_productpage();