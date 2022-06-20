<?php
/**
* @package myown
*
*
*/

if (! defined('ABSPATH')) {
die;
}

class Recipe_Loader
{
/**
*Constructor
*/
  public function __construct()
  {
//here calling includes files
    $this->includes();
    //enque scrips call function
    add_action('wp_enqueue_scripts',array($this,'mytheme_enqueue_styles'));
    //admin enque script of custom.js file
    add_action('admin_enqueue_scripts',array($this,'enqueue_script_admin'));  
    //
    add_action('wp_ajax_searchbox_ajax_datafeth',array($this ,'searchbox_ajax_datafeth'));
    add_action('wp_ajax_nopriv_searchbox_ajax_datafeth',array($this,'searchbox_ajax_datafeth'));

    add_action('wp_ajax_sortingpost_ajax',array($this, 'sortingpost_ajax'));
    add_action('wp_ajax_nopriv_sortingpost_ajax',array($this,'sortingpost_ajax'));

  }
/*files depends on platforms like all file containing
*/
  public function includes()
  {

      include_once 'class-Recipe-cpt.php';
      include_once 'class-Recipe-metabox.php';
      include_once 'class-Recipe-shortcode.php';
      include_once 'class-Recipe-product.php';
       //include_once 'class-Recipe-productpage.php';

  }
/*
Enque script files */


  public function mytheme_enqueue_styles()
  {

     //here recipe_js is handle name of script and jquery is dependency and wp_rand() generates random number
     wp_enqueue_script( 'recipe_js',  plugin_dir_url( __DIR__ ). '/assets/js/recipe.js',   array('jquery') , wp_rand() );
   
     wp_localize_script('recipe_js',  'front_ajax_object',array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));
     wp_enqueue_style( 'child-style', plugin_dir_url( __DIR__ ). '/assets/css/style.css');
  }
    //admin side enque script
  public function enqueue_script_admin()
  {
       
     wp_enqueue_script( 'checkbox_js',  plugin_dir_url( __DIR__ ). '/assets/js/checkbox.js',   array('jquery') , wp_rand() );
   
  }
//serching post ajax here php function
  public function searchbox_ajax_datafeth()
  {

    $the_query = new WP_Query( array( 'posts_per_page' => 2, 's' => esc_attr( $_POST['keyword'] ), 'post_type' => array('recipe') ) );


    if( $the_query->have_posts() ) :

    //echo '<ul>';
         ?>

      <div class="wrapper">
        <div class="row">
         <div id="primarys" class="container">

      <?php
        ob_start();
        while( $the_query->have_posts() ):

         $the_query->the_post();
         ?>
        <b> <h1><?php the_title(); ?></h1></b>
        <p style="text-align:center;"><?php the_content(); ?></p>
        <a href="<?php the_permalink() ?>"><?php the_post_thumbnail('thumbnail');?></a>
        <li><a href="<?php echo esc_url( post_permalink() ); ?>"><?php the_title();?></a>
        </li>

       <?php endwhile;
        $output_string = ob_get_contents();
        ob_end_clean();
        wp_die($output_string);

         ?>

        </div>
      </div>
     </div>
      <?php

      // echo '<ul>';
        wp_reset_postdata();  
    endif;

    die();
  }

   //sorting post in ajax here php funtion
  public function sortingpost_ajax()


  {        
  global $post, $wp_query;

   $args = array(
      'post_status' => 'publish',
      'orderby' => 'title',
      'order' => 'DESC',
      'posts_per_page' => '3',
      'post_type' => array('recipe') );

      if($_POST["keyword"] == "null")
      {
          $args['orderby'] = 'date';
          $args['order'] = 'ASC';
      }
      if($_POST["keyword"] == "asc")
      {
          $args['order'] = 'ASC';
      }
      if($_POST["keyword"] == "desc")
      {
          $args['order'] = 'DESC';
      }  
      if($_POST["keyword"] == "old")
      {
          $args['orderby'] = 'date';
          $args['order'] = 'ASC';
      }
      if($_POST["keyword"] == "new")
      {
          $args['orderby'] = 'date';
          $args['order'] = 'DESC';
      }
     
  $the_query = new WP_Query( $args );
  if( $the_query->have_posts() ) :
      ob_start();
    while( $the_query->have_posts() ): $the_query->the_post();  ?>


      <b> <h1><?php the_title(); ?></h1></b>
        <p style="text-align:center;"><?php the_content(); ?></p>
      <a href="<?php the_permalink() ?>"><?php the_post_thumbnail('thumbnail');?></a>



      <p> <?php  $name = get_post_meta($post->ID,"wpl_actore_name",true) ?>
      <?php echo $name ?>
      </p>


      <p> <?php  $email = get_post_meta($post->ID,"wpl_actore_email",true) ?>
      <?php echo $email ?>
      </p>

      <p> <?php  $number = get_post_meta($post->ID,"wpl_actore_number",true) ?>
      <?php echo $number ?>
      </p>
    <?php  
    endwhile;

      $output_string = ob_get_contents();
      ob_end_clean();
      wp_die($output_string);
      wp_reset_postdata();

  endif;
  die();



  }
}

new Recipe_Loader();
