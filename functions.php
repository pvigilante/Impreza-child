<?php
add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles');

function my_theme_enqueue_styles() {

    // Import the parent Style sheet to include it with the child
    // ( tag, location)
    // get_template_directory_uri = get the parent theme directory
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css' );
    
    // Load the Child Style Sheet
    // (tag, location, dependant)
    // get_stylesheet_directory_uri = get the directory of the current (child) theme
    wp_enqueue_style('child-style', get_stylesheet_directory_uri() . '/style.css', array('parent-style', 'bootstrap'));


    //wp_enqueue_style( 'bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css', array(), '4.4.1');
    
    // Add custom Javascript file
    // Dependant on jQuery
    wp_enqueue_script('peters-script', get_stylesheet_directory_uri() . '/scripts.js', array('jquery'), '1.0.0', true);
}


/* Custom functions code goes here. */

function add_svg_mime_type($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'add_svg_mime_type');

function add_copyright_text() {
    echo '<div class="default-copyright-text">';
    echo 'Copyright ' . date('Y') . ' &copy; ' . get_bloginfo('name');
    echo '</div>';
}
add_action('wp_footer', 'add_copyright_text');





/*
Add Portfolio Category Widget 
*/
class US_Portfolio_Category_Widget extends WP_Widget {

    function __construct() {
        parent::__construct('us_porfolio_categories', 'Portfolio Categories');

        add_action('widgets_init', function(){
            register_widget( 'US_Portfolio_Category_Widget' );
        });
    }

    public function widget($args, $instance){

        echo $args['before_widget'];

        if( !empty( $instance['title'] ) ){
            echo $args['before_title'] .
                 $instance['title'] .
                 $args['after_title'];
        }

        echo do_shortcode( '[us_portfolio_categories]' );

        echo $args['after_widget'];

    }
    public function form($instance){
        $title = (!empty( $instance['title'] )) ? $instance['title'] : '';  
        ?>
        <p>
            <label for="<?= $this->get_field_id('title'); ?>">Title</label>
            <input class="widefat" type="text" 
                id="<?= $this->get_field_id('title'); ?>" 
                name="<?= $this->get_field_name('title'); ?>" 
                value="<?=$title?>">
        </p>
        <?php
    }
    public function update($new_instance, $old_instance){

        $instance = array();

        $instance['title'] = (!empty($new_instance)) ? strip_tags( $new_instance['title'] ) : '';

        return $instance;
    }

}
$us_porfolio_categories = new US_Portfolio_Category_Widget();



/* 

Portfolio Categories Shortcode

*/

add_shortcode( 'us_portfolio_categories', 'us_portfolio_categories_shortcode' );

function us_portfolio_categories_shortcode($atts) {
    extract(
        shortcode_atts(array(
            'title' => '',
            'hide_empty' => false,
            'css'   => ''
        ), $atts)
    );

    $portfolio_cats = get_terms( array(
        'taxonomy' => 'us_portfolio_category',
        'hide_empty' => false,
    ) );
   
    $output = '<div>';
    
    if(!empty($title)){
        $output .=  '<h3>' . $title . '</h3>';
    }
    
    $output .= '<select class="mz-location-selector">';
    foreach($portfolio_cats as $category){
        $output .= '<option value="' . get_term_link( $category ) . '">' . 
             $category->name . 
             '</option>';
    }
    $output .= '</select>';
    $output .= '</div>';

    return $output;
}



/*

Add to Visual Composer

*/

add_action('vc_before_init', 'add_us_portfolio_categories_to_VC');

function add_us_portfolio_categories_to_VC(){
    if( class_exists('Vc_Manager')){

        vc_map( array(
            'name' => 'Portfolio Categories',
            'base' => 'us_portfolio_categories',
            'params' => array(
                array(
                    'heading' => 'Title',
                    'param_name' => 'title',
                    'type' => 'textfield'
                ),
                array(
                    'param_name' => 'css',
                    'type' => 'us_design_options',
                    'heading' => '',
                    'params' => us_config( 'elements_design_options.css.params', array() ),
                    'group' => __( 'Design', 'us' ),
                )
            )
        ) );

    }
}