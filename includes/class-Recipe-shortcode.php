<?php 
/*
*@ package myown-plugin
*    
*/
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
    /**
	* Class for shorcode of post type recipe .
	*/
class Recipe_shortcode 
{
    /**
    *  Constructor.
    */
    public function __construct()
    {
        
    add_shortcode( 'recipe-list', array($this,'shortcode_recipe_post_type') );  
        
        
    }

    /**
    * this is the function for shortcode post type
    */
        
    function shortcode_recipe_post_type()
    {
        
    $curentpage = get_query_var('paged');
    
    $args = array(
    'post_type'      => 'recipe',
    'posts_per_page' => '-1',
    'publish_status' => 'published',
    'paged' => $curentpage

     );

    $query = new WP_Query($args);

    $result = '';
    if($query->have_posts()) :

        while($query->have_posts()) :

            $query->the_post();

            $result = $result . "<h2>" . get_the_title() . "</h2>";
            $result = $result . get_the_post_thumbnail();
            $result = $result . "<p>" . get_the_content() . "</p>";

        endwhile;
        wp_reset_postdata();

        echo paginate_links(array(
            'total' => $query->max_num_pages
        )); 
    endif;   
    return $result;
            
   }
}

new Recipe_shortcode();

    
