<?php
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
function my_theme_enqueue_styles() {
    $parenthandle = 'parent-style'; // This is 'twentytwentyone-style' for the Twenty Twenty-One theme.
    $theme        = wp_get_theme();
    wp_enqueue_style( $parenthandle,
        get_template_directory_uri() . '/style.css',
        array(),  // If the parent theme code has a dependency, copy it to here.
        $theme->parent()->get( 'Version' )
    );
    wp_enqueue_style( 'child-style',
        get_stylesheet_uri(),
        array( $parenthandle ),
        $theme->get( 'Version' ) // This only works if you have Version defined in the style header.
    );
}

function register_my_menus()
{
  register_nav_menus(
    array(
      'header-menu' => __('Menu Header'),
      'footer-menu' => __('Menu Footer'),
    )
  );
}
add_action('init', 'register_my_menus');

function custom_script()
{
  wp_enqueue_script('modal', get_stylesheet_directory_uri() . '/js/scripts.js', array('jquery'), '1.0', true);
  wp_enqueue_script('lightbox', get_stylesheet_directory_uri() . '/js/lightbox.js', array('jquery'), '1.0', true);
}
add_action('wp_enqueue_scripts', 'custom_script');
?>