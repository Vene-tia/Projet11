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

	<div class="filtre">
		<?php 
		$per_page = 8;
		$offset = $_GET['page'] ?? 0; // On récupère le paramètre GET dans l'URL
		// 1. On définit les arguments pour définir ce que l'on souhaite récupérer
		$args = array(
			'post_type' => 'photo',
			'meta_key' => 'categorie', // nom du champ personnalisé → add Format
			'meta_value' => 'mariage',
			/* 'category' => 'jeux-video',
			'order' => 'DESC', // ASC ou DESC 
    		'orderby' => 'date', // title, date, comment_count…
			'posts_per_page' => get_option( 'posts_per_page'), // Valeur par défaut
			'posts_per_page' => -1, // tous les articles */
			'posts_per_page' => $per_page, // 8 articles
			'offset' => $offset,
		);
		// 2. On exécute la WP Query
		$my_query = new WP_Query( $args );
		// 3. On lance la boucle !
		if( $my_query->have_posts() ) : while( $my_query->have_posts() ) : $my_query->the_post();
			/* the_title();
			the_content(); */ ?>
			<a href="<?php the_permalink(); ?>"> 
			<?php the_post_thumbnail(); ?> </a>
<?php 	endwhile;
		endif;
		// 4. On réinitialise à la requête principale (important)
		wp_reset_postdata();
		?>
		<a href="<?php echo home_url( '?page=' . $offset + $per_page ); ?>"><br>Charger plus</a>
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
