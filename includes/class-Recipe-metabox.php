
<?php
/*
*@ package myown-plugin
*    
*/
if ( ! defined( 'ABSPATH' ) ) {
exit;
}
/**
* This is the class for mataboxes adding ,saving values and getting from database .
*/
class Recipe_metabox
{
    /**
    *  Constructor.
    */
    public function __construct()
       
    {    //adding meta box
        add_action("add_meta_boxes", array($this, "Adding_cpt"));
        //saving values of meta
        add_action("save_post", array($this, "metabox_value_saving"),10,2);
        //adding coloumn fields to page
        add_action( "manage_recipe_posts_columns",array($this,"adding_coloumns"));
        //adding data to coloumn
        add_action( "manage_recipe_posts _column",array($this,"adding_coloumns_data"),10,2);
    }
    /**
    *  adding meta box for cpt
    */
    public function Adding_cpt()
    {
        add_meta_box( "cpt-id", "Actores Details", array($this,"wpl_actor_call"),"recipe","side","high");
    }

    /**
    *  displaying cpt
    */
    public function wpl_actor_call($post)
    {
        ob_start();    
        ?>
       
        <p> <label> Name </label>
        <?php  $name = get_post_meta($post->ID,"wpl_actore_name",true) ?>
        <input type="text" value="<?php echo $name ?>" name="TxtActoreName" placeholder="name"/>
        </p>

         <p>
         <label> Number </label>
        <?php  $email = get_post_meta($post->ID,"wpl_actore_number",true) ?>
        <input type="number" value="<?php echo $number ?>" name="TxtActorenumber" placeholder="number"/>
        </p>

        <p>
        <label> Email </label>
        <?php  $email = get_post_meta($post->ID,"wpl_actore_email",true) ?>
        <input type="email" value="<?php echo $email ?>" name="TxtActoreEmail" placeholder="email"/>
        </p> <?php
        $output_string = ob_get_contents();
        ob_end_clean();
        wp_die($output_string);    
    }
    /**
    *  Getting data from  field
    */
    public function metabox_value_saving($post_id, $post)
    {
        $TxtActoreName = isset($_POST['TxtActoreName'])?$_POST['TxtActoreName']:"";
        $TxtActoreEmail = isset($_POST['TxtActoreEmail'])?$_POST['TxtActoreEmail']:"";
        $TxtActorenumber = isset($_POST['TxtActorenumber'])?$_POST['TxtActorenumber']:"";

        update_post_meta( $post_id,"wpl_actore_name",$TxtActoreName);
        update_post_meta( $post_id,"wpl_actore_email",$TxtActoreEmail);
        update_post_meta( $post_id,"wpl_actore_number",$TxtActorenumber);
    }


    //Adding field on post page

    function adding_coloumns($columns)
    {


        $columns = array(

        "cb"=>"<input type='checkbox'/>",
        "title" => "recipe title",
        "pub_email" => "Publisher email",
        "pub_name" => "Publisher name",
        "pub_number"=>"Publisher number ",
        //"oldest" => "oldest"

        );

        return $columns;
    }

    //getting data from db on post field

    function adding_coloumns_data($column,$post_id)
    {


        switch($column)
        {

        case 'pub_email':
        $publisher_email = get_post_meta($post_id,"wpl_actore_email",true);
        echo $publisher_email;
        break;

        case 'pub_name':
        $publisher_name = get_post_meta($post_id,"wpl_actore_name",true);
        echo $publisher_name;
        break;

        case 'pub_number':
        $publisher_number = get_post_meta($post_id,"wpl_actore_number",true);
        echo $publisher_number;
        break;

        }
    }

}


new Recipe_metabox();
