<?php
/**
 * Template Name: Recipe Book
 */
get_header();  

?>
<!--******************************************************************************************************************************************************************************************************************************************************************************************search bar*********************************************************-->
<div class="search_bar">
    <form action="" method="get" autocomplete="off" style="width: 300px;">
        <input type="text" name="s" placeholder="Search here" id="keyword" class="input_search">

     
                
    <select id="selection">
    <option value="null">SORT</option>
    <option value="asc">Ascending Order</option>
    <option value="desc">Decending Order</option>
    <option value="old">Oldest</option>
    <option value="new" >Newest</option>
    </select>

    </form>
<div class="search_result"  >

    </div>
</div>
<!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------search box ends here--------------------------------------------
-->

<?php
//#1 url se get karega ye query or agr url se nhi milta to aap 1 set krdo
$paged=get_query_var('paged')?get_query_var('paged'):1;

?>

<div class="wrap">
    <div id="primary" class="content_area" >
        <main id="main" class="site-main" role="main" >
            <?php
               $args = array
            (
                'post_type' => 'recipe',//post type name
                'posts_per_page' => '2',//how much posts you want
              //'publish_status' => 'published',
                'paged'=>$paged,//data is checking in in paged varaible #2
               
            );


            $query = new WP_Query($args);//in this #3
           
                
                if($query->have_posts()) :

                ?>
            <div class="wrapper">
              <div class="coloumn" id="datafetch">
               <?php
                while($query->have_posts()) :


                    $query->the_post();?>
                    <div class="row">
                    <div class="coloumn"> 
                    <b> <h1><?php the_title(); ?></h1></b>
                      <p style="text-align:center;"><?php the_content(); ?></p>
                    <a href="<?php the_permalink() ?>"><?php the_post_thumbnail('thumbnail');?></a>
                    </div>
                    </div>
                   

                    <div class="row">
                    <div class="coloumn">
                    <p> <?php  $name = get_post_meta($post->ID,"wpl_actore_name",true) ?>
                    <?php echo $name ?>
                    </p>
                    </div>
                    </div>

               
                    <div class="row">
                    <div class="coloumn">
                    <p> <?php  $email = get_post_meta($post->ID,"wpl_actore_email",true) ?>
                    <?php echo $email ?>
                    </p>
                    </div>
                    </div>
                    

                    <div class="row">
                    <div class="coloumn">
                    <p> <?php  $number = get_post_meta($post->ID,"wpl_actore_number",true) ?>
                    <?php echo $number ?>
                    </p>
                    </div>
                    </div>
                
           </div>
               </div>
            <?php
                endwhile;    
                    //#4  Retrieves paginated links for archive post pages.    
                    echo paginate_links(array(
                    'total' => $query->max_num_pages
                   ));
            endif;    
            ?>
        </main>
    </div>
</div>


<?php

get_footer();

?>
