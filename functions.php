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
  wp_enqueue_script('filter_script', get_stylesheet_directory_uri() . '/js/filter.js', array('jquery'));
}
add_action('wp_enqueue_scripts', 'custom_script');


// HOOK AJAX 

function charger_plus() {
  $categorie_array = [];
  $per_page = 1;
  $args = array(
		'post_type' => 'photo',
		'meta_key' => 'categorie',
		'posts_per_page' => $per_page,
	);
  $my_query = new WP_Query( $args );
  if( $my_query->have_posts() ) : while( $my_query->have_posts() ) : $my_query->the_post(); 
	$image_url = get_the_post_thumbnail_url();
  $image_alt = get_post_meta(get_the_ID(), '_wp_attachment_image_alt', true);
	$post_id = get_post_meta(get_the_ID(), 'reference', true);
	$postcat = get_the_category( $wp_query->post->ID );
	$fields = get_the_category();
  endwhile;
  endif;
  wp_reset_postdata();
  echo $_POST["test_name"];
}
add_action('wp_ajax_charger_plus', 'charger_plus')
?>