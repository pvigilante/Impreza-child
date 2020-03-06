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


    wp_enqueue_style( 
        'bootstrap', 
        'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css', 
        array(), 
        '4.4.1'
    );
    
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