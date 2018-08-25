<?php

// Register Custom Post Types
require_once('includes/register-custom-post-type.php');


// Register Custom Taxonomy
require_once('includes/register-custom-taxonomy.php');

// Register Custom Navigation Walker
require_once('includes/wp_bootstrap_navwalker.php');


//Add Roles 
add_role('cliente', 'Cliente', array('read' => true));




// USER REGISTER
function fc_register_user($data){
    $user_id = username_exists( $data['correo'] );

    if ( !$user_id and email_exists($data['correo']) == false ) {

        $random_password = wp_generate_password( $length=12, $include_standard_special_chars=false );
        $user_id = wp_create_user( $data['username'] , $random_password, $data['correo']  );

        if (is_numeric($user_id)) {
            $user = new WP_User( $user_id );
            $user->set_role( 'cliente' );
            $message = "Se ha registrado con éxito.";

            $nickname = $data['nombre']." ".$data['apellido'];

            wp_update_user(
              array(
                'ID'       => $user_id,
                'first_name' => $data['nombre'],
                'last_name' => $data['apellido'],
                'display_name' => $nickname
              )
            );

            //Save all the form input as User Metadata
            foreach ($data as $key => $value) {
                add_user_meta( $user_id, $key, $value);   
            }


            //Send Email
            $to = 'fg@calderon.it, '.$data['correo'];
            $message_email = "
                            <p>¡Tu registro ha sido exitoso, bienvenido al WP Guadalajara!  </p>

                            <hr/>
                            
                            <h3>Información Personal</h3>

                            <p>Nombres: $data[nombre]</p>
                            <p>Apellidos: $data[apellido]</p>
                            <p>Institución: $data[institucion]</p>   
                            <p>Teléfono celular: $data[telefono]</p>
                            <p>Correo electrónico: $data[correo]</p>";
                            
            
            //Send email and SMS
            fc_send_email($data['evento'],$to,$message_email);

            $message = '<div class="alert alert-info margin-top-md">
                            <p>¡Gracias! </p>
                            <p>Su registro se ha guardado satisfactoriamente. </p>
                            <p><a href="http://wordcamp.demo.gt/">Regresar</a></p>
                        </div>';
        }
    } else {        
        $message = "<div id='fc-register' class='alert alert-danger margin-top-md'>
                    Ya se ha registrado un usuario con el correo $data[correo]<br/> 
                    <a href='".HOMELINK."registro'>Por favor intente nuevamente con otro correo electrónico </a>.</div>";
    }
    
    return $message;
}



//Define constants
define('HOMELINK', site_url('/'));
define('PATH', get_template_directory_uri());
define('IMAGES', get_template_directory_uri()."/img" );
define('SITENAME', get_bloginfo('name') );

//Register menus
register_nav_menus( array(
	'main_menu' => 'Main Menu'
) );

//Post Thumbnails
if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 150, 150 ); // default Post Thumbnail dimensions   
} 

// Custom Image Size
if ( function_exists( 'add_image_size' ) ) { 
	add_image_size( 'carousel-image', 870, 540, true ); //(cropped)
}

function GravatarAsFavicon($size) {
	 //We need to establish the hashed value of your email address
   $GetTheHash = md5(strtolower(trim('fg@calderon.it')));
   echo 'http://www.gravatar.com/avatar/' . $GetTheHash . '?s='.$size;
}

//Custom Sidebar with Widgets
function theme_widgets_init() {
	//Register Sidebar
	register_sidebar( array(
        'name' => __( 'New Sidebar' ),
        'id' => 'new-sidebar',
        'description' => __( 'New Sidebar' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="subtitle">',
        'after_title' => '</h3>',
    ) );
}
add_action( 'widgets_init', 'theme_widgets_init' );
add_filter('widget_text', 'do_shortcode');


//Add styles and scripts
function fc_scripts() {
    //STYLES

    // Add Open Sans font, used in the main stylesheet.
    //$font_url = add_query_arg( 'family', urlencode( 'Open+Sans:400,700' ), "//fonts.googleapis.com/css" );
    wp_register_style( 'opens-sans', 'http://fonts.googleapis.com/css?family=Open+Sans:400,700', array(), null);   
    wp_enqueue_style( 'opens-sans');

    wp_register_style( 'bootstrap', PATH.'/css/bootstrap.min.css',array(), null  );   
    wp_enqueue_style( 'bootstrap' );


    wp_register_style( 'styles', get_stylesheet_uri(),array(), null  );   
    wp_enqueue_style( 'styles' );    

    //JAVASCRIPT
    wp_register_script( 'bootstrap', PATH.'/js/bootstrap.min.js', array('jquery'),null,true);
    wp_enqueue_script('bootstrap');

    wp_register_script( 'app', PATH.'/js/app.js', array('jquery'),null,true);
    wp_enqueue_script('app');
}
add_action( 'wp_enqueue_scripts', 'fc_scripts',1 );



// Header Title
function fc_the_title(){
    if(is_home()){
        $title = SITENAME;    
    }elseif (is_single()){
        $title = get_the_title();
        $title .= " | ".SITENAME;
    }elseif (is_category()){
        $title = single_cat_title("", false);        
    }else{            
        $title = SITENAME;
    }
    echo $title;
}


//Add class to body
function fc_body_class(){
    if(is_home()) 
        $class ="home";  
    else 
        $class= "single";     
    echo $class;
}


//Customize Login screen
function fc_login_logo() { 
    wp_register_style( 'admin-styles', PATH.'/css/admin.css', array(), null);   
    wp_enqueue_style( 'admin-styles');
}

add_action( 'login_enqueue_scripts', 'fc_login_logo' );

//Carousel
function fc_sc_carousel($atts){
    /*Add Carousel to Template
            $atts = array('value' => 'news', 'cant' => 2);
            fc_sc_carousel($atts); 
        OR
            do_shortcode("[fc_carousel type='category_name' value='casos-de-exito']");
    */

    // $type  (post_type or  category_name)     
    // $value (post type slug or category name slug)
            
    $atts = shortcode_atts( array(
          'type'    => 'category_name',
          'value'   => 'carousel',
          'size'    => 'full', //Post Thumbnail Size
          'margins' => 'margin-top-md margin-bottom-md', //Margins for carosuel wrap
          'cant'    => 5 // How many posts to show
     ), $atts );

    

    $args = array(
        $atts['type'] => $atts['value'],
        'posts_per_page' => $atts['cant']
    );

    $html = '';
    $cont = 0;
    
    $query = new WP_Query( $args );
    if ( $query->have_posts() ) {

        $html = "<div id='$atts[value]' class='carousel slide $atts[margins]' data-ride='carousel'>
                    <div class='carousel-inner'>";
                        while ( $query->have_posts() ) :

                            $cont++;        
                                if($cont==1)
                                    $active = 'active';
                                else
                                    $active = '';

                            
                            $query->the_post();
                            
                            $html .=  "<div class='item $active '> ";
                                    if ( has_post_thumbnail() ) { 
                                        $html.="<a href='".get_the_permalink()."'>".get_the_post_thumbnail($query->post->ID,$atts['size'],array('class'=>'img-responsive'))."</a>";
                                    } 
                                        $html.="<div class='carousel-caption'>";
                                            $html .= "<h3>".get_the_title()."</h3>";
                                            $html .= "<div class='excerpt'>".get_the_excerpt()."</div>";
                                        $html .="</div>";
                            $html .= "</div>";
                        endwhile; 
        $html .=    "</div>";
        $html .=    "<a class='left carousel-control' href='#$atts[value]' data-slide='prev'>
                        <span class='glyphicon glyphicon-chevron-left'></span>
                    </a>
                    <a class='right carousel-control' href='#$atts[value]' data-slide='next'>
                        <span class='glyphicon glyphicon-chevron-right'></span>
                    </a>
                </div>";
    }else{
        $html .= "<div class='alert alert-danger'>No hay información para mostrar</div>";
    }
    wp_reset_postdata();
    echo $html;
}

add_shortcode( 'fc_carousel', 'fc_sc_carousel' );


// Add Opengraph metadata
function fc_add_opengraph_metas() {   
    global $post;
    setup_postdata( $post );
    $output =  "\n".'<!-- OPENGRAPH -->'. "\n";

    if ( is_singular() ) {                     
        $output .= '<meta property="og:title" content="' . esc_attr( get_the_title() ) . '" />' . "\n";
        $output .= '<meta property="og:type" content="article" />' . "\n";
        $output .= '<meta property="og:url" content="' . get_permalink() . '" />' . "\n";
        $output .= '<meta property="og:description" content="' . esc_attr( get_the_excerpt() ) . '" />' . "\n";
        if ( has_post_thumbnail() ) {
            $imgsrc = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' );
            $output .= '<meta property="og:image" content="' . $imgsrc[0] . '" />' . "\n\n";
        }else{
            $output .= '<meta property="og:image" content="' . IMAGES . '/logo.png" />' . "\n\n";
        }
    }else{                
        $output .= '<meta property="og:title" content="' . SITENAME . '" />' . "\n";
        $output .= '<meta property="og:type" content="website" />' . "\n";
        $output .= '<meta property="og:url" content="' . HOMELINK . '" />' . "\n";
        $output .= '<meta property="og:description" content="' . get_bloginfo('description') . '" />' . "\n";
        $output .= '<meta property="og:image" content="' . IMAGES . '/logo.png" />' . "\n\n";
    }
    echo $output;
}
add_action( 'wp_head', 'fc_add_opengraph_metas' );

//Remove Meta Tags
remove_action( 'wp_head', 'feed_links_extra', 3 ); // Display the links to the extra feeds such as category feeds
remove_action( 'wp_head', 'feed_links', 2 ); // Display the links to the general feeds: Post and Comment Feed
remove_action( 'wp_head', 'rsd_link' ); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action( 'wp_head', 'wlwmanifest_link' ); // Display the link to the Windows Live Writer manifest file.
remove_action( 'wp_head', 'index_rel_link' ); // index link
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 ); // prev link
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 ); // start link
remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 ); // Display relational links for the posts adjacent to the current post.
remove_action( 'wp_head', 'wp_generator' ); // Display the XHTML generator that is generated on the wp_head hook, WP version

