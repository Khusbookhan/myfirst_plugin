<?php
/**
  * This is the for preventing direct access 
  */
if (! defined('ABSPATH')) {
die;
}
   
   /**
  * This is the recipe cpt class
  */
class Recipe_cpt
{
    /*
    *Constructor
    */

    public function __construct()
    {
       
        //register postype call
      add_action( 'init',array($this,'registerPostType'));
        //calling archive function
      add_filter( 'archive_template',  array( $this, 'recipe_archive_template') ) ;
        //calling single template function
      add_filter( 'single_template',  array( $this, 'recipe_single_template') ) ;


    }

    /**
    * This is the function for register post types  
    */
    public  function registerPostType()
    {
        $labels = array(
        'name'               => _x( 'recipes', 'post type general name' ),
        'singular_name'      => _x( 'recipe', 'post type singular name' ),
        'add_new'            => _x( 'Add New', 'recipe' ),
        'add_new_item'       => __( 'Add New recipe' ),
        'edit_item'          => __( 'Edit recipe' ),
        'new_item'           => __( 'New recipe' ),
        'all_items'          => __( 'All recipes' ),
        'view_item'          => __( 'View recipe' ),
        'search_items'       => __( 'Search recipes' ),
        'not_found'          => __( 'No recipes found' ),
        'featured_image'     => __( 'recipe Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'recipe' ), 'set_featured_image'  => __( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'recipe' ),
        'remove_featured_image' => __( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'recipe' ),
        'use_featured_image'   => __( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'recipe' ),
        'archives'              => __( 'recipe archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'recipe' ),
        'insert_into_item'      => __( 'Insert into recipe', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'recipe' ),
        'uploaded_to_this_item' => __( 'Uploaded to this recipe', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'recipe' ),
        'not_found_in_trash' => __( 'No recipes found in the Trash' ),
        'parent_item_colon' => '',
        'menu_name' => 'recipes'
        );

    /**
    * This is the $arg array  
    */

        $args = array(
        'labels'        => $labels,
        'description'   => 'Displays city recipes and their ratings',
        'public'        => true,
        'rewrite'       => true,
        'rewrite'       => array('slug' => 'recipe'),//slug name recipe
        'menu_position' => 4,
        'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments','author' ),
        'has_archive'   => true,
        'taxonomies'    => array('spice-book')
        );

        register_post_type( 'recipe', $args );

    }
       
    /**
    * This is the function for archive template
    */
    public function recipe_archive_template( $archive_template )
    {
        if ( is_post_type_archive ( 'recipe' ) ) {
            $archive_template = wordpress_tasks_ABSPATH . '/template/archive-recipe.php';
            }
            return $archive_template;
    } 

    /**
    * This is the function for single template 
    */
    function recipe_single_template($single)
    {
         global $post;
        /* Checks for single template by post type */
        if ( $post->post_type == 'recipe' ) {
        if ( file_exists( wordpress_tasks_ABSPATH . '/template/single-recipe.php' ) ) {
            return wordpress_tasks_ABSPATH . '/template/single-recipe.php';
        }
        }
        return $single;
    }    

}

new  Recipe_cpt();