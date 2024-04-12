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
  wp_enqueue_script('filter_script', get_stylesheet_directory_uri() . '/js/filter.js', array('jquery'));
}
add_action('wp_enqueue_scripts', 'custom_script');

// FORMAT SELECT

function select_script() {
    
  wp_enqueue_script('select_script', get_stylesheet_directory_uri() . '/js/format-select.js', array(),'1.0',array("in_footer"=>true));
  wp_enqueue_script('lighbox_script', get_stylesheet_directory_uri() . '/js/lightbox.js', array(),'1.0',array("in_footer"=>true));
}

add_action('wp_enqueue_scripts', 'select_script');
add_action('wp_enqueue_scripts', 'select_script');


// HOOK AJAX 

function charger_plus() {
  $categorie_array = [];
  $per_page = 8;
  // Prend les données sur POST
  $page = $_POST["page"];
  $category = $_POST["category"];
  $format = $_POST["format"];
  $byDate = $_POST["byDate"];

    $args = array(
      'post_type' => 'photo',
      'posts_per_page' => $per_page,
      'paged' => $page,
    );

    if( $category != "Catégories"){
      /// add new arguments
       $args['tax_query'] = array(
         array(
           'taxonomy' => 'category',
           'field'    => 'slug',
           'terms'    => $category,
           'operator' => 'IN'
        )
      );
   }

   if( $format != "Formats"){
      // add new arguments
      $args['tax_query'][] = array(
         array(
           'taxonomy' => 'format',
           'field'    => 'slug',
           'terms'    => $format,
           'operator' => 'IN'
         )
       );
   }

   if( $byDate != "Trier par"){
     // Configure l'ordre des résultats en fonction de l'option de tri.
       if ($byDate == 'Plus récentes') {
          $args['orderby'] = 'date';
          $args['order'] = 'DESC';
       } elseif ($byDate == 'Plus anciennes') {
          $args['orderby'] = 'date';
          $args['order'] = 'ASC';
        }
   }

  $my_query = new WP_Query( $args );
  if( $my_query->have_posts() ) : while( $my_query->have_posts() ) : $my_query->the_post(); 

  $image_url = get_the_post_thumbnail_url();
  $image_alt = get_post_meta(get_the_ID(), '_wp_attachment_image_alt', true);
	$post_id = get_post_meta(get_the_ID(), 'reference', true);
	$postcat = get_the_category( $wp_query->post->ID );
	$fields = get_the_category();
  ?>

  <div class="card">
			<img class="post_img" src="<?php echo $image_url ?>" alt="<?php echo $image_alt?>" data-imgId="<?php echo $post_id ?>">

			<img class="fullscreen" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/Icon_fullscreen.png" alt="Open Lightbox" role="button" aria-pressed="false">
			<a href="<?php the_permalink();?>"><img class="info-eye" alt="Open Info" role="button" aria-pressed="false" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/Icon_eye.png" ></a>
			<span class="title"> <?php  echo the_title() ?> </span>
			<span class="categorie"><?php echo get_field( 'categorie' ) ?></span>	
  </div>

<?php  
  endwhile;
  // sends no "0" to the enaswer
  wp_die();
  endif;
  wp_reset_postdata();
}
add_action('wp_ajax_charger_plus', 'charger_plus');
add_action('wp_ajax_nopriv_charger_plus', 'charger_plus');
?>