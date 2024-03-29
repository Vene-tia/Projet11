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
	</header>.entry-header

	<div class="entry-content">
		<div class="info_photo">
			<p>RÉFÉRENCE : <?php echo get_field( 'reference' ); ?></p>
			<input id="ref_contact" type="text" value="<?php echo get_field( 'reference' ); ?>" hidden>
			<p>CATÉGORIE : <?php echo get_field( 'categorie' ); ?></p>
			<p>FORMAT : <?php echo get_field( 'format' ); ?></p>
			<p>TYPE : <?php echo get_field( 'type' ); ?></p>
			<p>ANNÉE : <?php echo get_field( 'annee' ); ?></p>
		</div>
		<button class="button_contact">Contact</button>
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
		if( $my_query->have_posts() ) : while( $my_query->have_posts() ) : $my_query->the_post();
			
			$image_url = get_the_post_thumbnail_url();
			$image_alt = get_post_meta(get_the_ID(), '_wp_attachment_image_alt', true);
			$post_id = get_post_meta(get_the_ID(), 'reference', true);
			$postcat = get_the_category( $wp_query->post->ID );
			$fields = get_the_category();
			?>
			<div class="card">
				<img class="post_img" src="<?php echo $image_url ?>" alt="<?php echo $image_alt?>" data-imgId="<?php echo $post_id ?>">
				<img class="fullscreen" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/Icon_fullscreen.png" alt="Open Lightbox" role="button" aria-pressed="false" onclick="openModal()">
				<a href="<?php the_permalink();?>"><img class="info-eye" alt="Open Info" role="button" aria-pressed="false" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/Icon_eye.png" ></a>
				<span class="title"> <?php  echo the_title() ?> </span>
				<span class="categorie"><?php echo get_field( 'categorie' ) ?></span>
			</div>
    <?php endwhile;
		endif;
		wp_reset_postdata();
		?>
</div>
