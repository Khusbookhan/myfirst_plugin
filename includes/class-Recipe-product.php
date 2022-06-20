<?php

if (! defined('ABSPATH')) {
    die;
}


class Recipe_productpage
{

     /*
     *
     *contructor
     *
     */

    public function __construct()

    {
       
            //adding field

            //saving value at backend
        add_action( 'woocommerce_process_product_meta',array($this,'woofiled_save_woocom_field' ));
       
          //showing value to add to cart
        add_filter( 'woocommerce_get_price_html', array($this, 'showing_discount_singleproduct' ));
           
            //checbox add
        add_action('woocommerce_product_options_general_product_data',array($this, 'woocommerce_product_discount'));
           //for price changing
        //add_filter( 'woocommerce_get_price_html',array($this, 'simple_product_price_html' ));
       
        //showing secure money
        add_action( 'woocommerce_cart_totals_after_order_total',array($this,'showing_discount_cart'));
        add_action( 'woocommerce_review_order_after_order_total',array($this, 'showing_discount_cart'));
         
  
        //showing regular and sale price
        add_action( 'woocommerce_before_calculate_totals', array( $this, 'cart_price_update' ) );
       

       

    }
       
       
        //adding checkox

    public function woocommerce_product_discount ()
        {
            global $woocommerce;
            echo '<div class=" product_added_field "> <p><input type="checkbox"> Add discount value  .</p>';
            woocommerce_wp_text_input(
                array(
                    'id'            => 'woocom_text_field_title',
                    'placeholder'   => 'Insert Discount value',
                    'label' => __( '', 'woofiled' ),
                    'desc_tip'      => 'true',
                     'type' => 'number',
                     'required'  => true,
                     'woocom_attributes' => array(
                     'step' => 'any',
                     'min' => '0'
                          )
                    )
                );
            echo '</div>';
        }
   

         //saving valus
    public function woofiled_save_woocom_field( $post_id )
        {
            $product = wc_get_product( $post_id );
            $title = isset( $_POST['woocom_text_field_title'] ) ? $_POST['woocom_text_field_title'] : '';
             //Sanitizes a string from user input or from the database
            $product->update_meta_data( 'woocom_text_field_title', sanitize_text_field( $title ) );
            $product->save();
        }
         
       
 
       
        //showing disocunt in cart and checkout
    public function showing_discount_cart() 
        {
              global $woocommerce;
           foreach ( $woocommerce->cart->get_cart() as $cw_cart_key => $values) {
               $_product = $values['data'];
               if ( $_product->is_on_sale() ) {
                    $regular_price = $_product->get_regular_price();
                    $sale_price = $_product->get_sale_price();
                    $discount =  $regular_price * ((100 - $sale_price)/ 100) ;
                 
                }
           }
           if ( $discount > 0 ) {
                echo '<tr class="cart-discount">
            <th>'. __( 'save', 'woocommerce' ) .'</th>
            <td data-title=" '. __( 'save', 'woocommerce' ) .' ">'
                    . wc_price( $discount + $woocommerce->cart->discount_cart ) .'</td>
            </tr>';
            }
            
        }
   
       
        //showing discount on single page
    public function showing_discount_singleproduct($price)
        {
 
          global $product;
                 
            //$product = wc_get_product( $post->ID );
              $regular_price  = get_post_meta( $product->get_id(), '_regular_price', true );
              // $sale_price     = get_post_meta( $product->get_id(), '_sale_price', true );
              $discount_price = get_post_meta( $product->get_id(), 'woocom_text_field_title',true);//this is my 

                 //if( !empty($sale_price) ) {
               $new_price = $regular_price * ((100 - $discount_price)/ 100) ;

               $price= $new_price;
               ?>

              <p style="font-size:24px;color:red;"><b>You Save: <?php echo number_format($price,0, '', ''); ?></b></p>  
              <?php  

                      

                           
                
         }
       
     //changing cart price
     public function cart_price_update( $cart_object )
        {

            global $product;
            $cart_items = $cart_object->cart_contents;
             //$product = wc_get_product( $post_id );

            if ( ! empty( $cart_items ) ) 
            {
              $price = 105;
            foreach ( $cart_items as $key => $value )
            {
                $value['data']->set_price( $price );
              }
            }
        }
    

                   
                 

}


new Recipe_productpage();