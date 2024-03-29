<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-content">
		<?php
		the_content();

		wp_link_pages(
			array(
				'before'   => '<nav class="page-links" aria-label="' . esc_attr__( 'Page', 'twentytwentyone' ) . '">',
				'after'    => '</nav>',
				/* translators: %: Page number. */
				'pagelink' => esc_html__( 'Page %', 'twentytwentyone' ),
			)
		);
		?>
    </div><!-- .entry-content -->

	<form class="form-filter">
		<div class="filtre_gauche">
		<?php 
			// Get all taxonomies for the custom post type
			$taxonomies = get_object_taxonomies('photo', 'objects');

			// Check if there are any taxonomies
			if ($taxonomies) {
				foreach ($taxonomies as $taxonomy) {
					// Output dropdown for each taxonomy
					wp_dropdown_categories(array(
						'taxonomy'         => $taxonomy->name,
						'name'             => $taxonomy->name,
						'orderby'          => 'name',
						'show_option_all'  =>  $taxonomy->label,
						'hide_empty'       => 1,
						'hierarchical'     => true,
					));
				}
			} else {
				echo 'No taxonomies found for the specified post type.';
			}
		?>
		</div>

		<select name="select" id="date">
			<option selected value="">TRIER PAR</option>
			<option value="valor1">Plus récentes</option> 
			<option value="valor2">Plus anciennes</option>
		</select>
	</form>

<div class="filtre">
	<?php 
	$categorie_array = [];
	// 1. On définit les arguments pour définir ce que l'on souhaite récupérer
	$args = array(
		'orderby' => 'date',
		'post_type' => 'photo',
		'meta_key' => 'categorie', // nom du champ personnalisé
		// 'meta_value' => 'mariage',
		'posts_per_page' => 8, // 8 articles
	);
	// 2. On exécute la WP Query
	$my_query = new WP_Query( $args );
	
	// 3. On lance la boucle !
	if( $my_query->have_posts() ) : while( $my_query->have_posts() ) : $my_query->the_post(); 

	$image_url = get_the_post_thumbnail_url();

	// Récupère le texte alternatif de l'image.
	$image_alt = get_post_meta(get_the_ID(), '_wp_attachment_image_alt', true);
	$post_id = get_post_meta(get_the_ID(), 'reference', true);
	$postcat = get_the_category( $wp_query->post->ID );
	$fields = get_the_category();

	 // LIEN  <a href="<?php the_permalink();  "> 
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
	endif;
	// 4. On réinitialise à la requête principale (important)
	wp_reset_postdata();
	?>
</div>

<div class="btn_chargement">
		<button class="plus_btn">Charger plus</button>	
</div>
	
<?php if ( get_edit_post_link() ) : ?>
	<footer class="entry-footer default-max-width">
		<?php
		edit_post_link(
			sprintf(
				/* translators: %s: Post title. Only visible to screen readers. */
				esc_html__( 'Edit %s', 'twentytwentyone' ),
				'<span class="screen-reader-text">' . get_the_title() . '</span>'
			),
			'<span class="edit-link">',
			'</span>'
		);
		?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
