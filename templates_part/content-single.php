<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header alignwide">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<?php twenty_twenty_one_post_thumbnail(); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<div class="info_photo">
			<?php echo get_field( 'reference' ); ?>
			<?php echo get_field( 'categorie' ); ?>
			<?php echo get_field( 'format' ); ?>
			<?php echo get_field( 'type' ); ?>
			<?php echo get_field( 'annee' ); ?>
		</div>
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

	<footer class="entry-footer default-max-width">
		<?php twenty_twenty_one_entry_meta_footer(); ?>
	</footer><!-- .entry-footer -->

	<?php if ( ! is_singular( 'attachment' ) ) : ?>
		<?php get_template_part( 'template-parts/post/author-bio' ); ?>
	<?php endif; ?>

</article><!-- #post-<?php the_ID(); ?> -->

<div class="photos_apparentées">
<!-- <div> Vous aimerez AUSSI </div> -->
		<?php 
		$args = array(
			'post_type' => 'photo',
			'meta_value' => get_field( 'categorie' ), // Attention récup info de la catégorie de la page
			'posts_per_page' => 2,
		);
		$my_query = new WP_Query( $args );
		if( $my_query->have_posts() ) : while( $my_query->have_posts() ) : $my_query->the_post();?>
			<a href="<?php the_permalink(); ?>"> 
			<?php the_post_thumbnail(); ?> </a>
    <?php endwhile;
		endif;
		wp_reset_postdata();
		?>
</div>
