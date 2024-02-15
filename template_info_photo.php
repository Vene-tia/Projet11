<?php 
 /*
 * Template Name: Template Test
 */ 
?>

<?php get_header(); ?>

<?php if (have_posts()):
  while (have_posts()):
    the_post(); ?>
<article> contenu dynamique </article>
<?php endwhile; ?>
<?php endif; ?>
          

<?php the_field( 'reference' ); // Afficher une valeur ?> 
<?php $note = get_field( 'reference' ); // Récupérer la valeur ?> 

<?php the_field( 'categorie' ); ?>
<?php $note = get_field( 'categorie' ); ?>

<?php the_field( 'format' ); ?>
<?php $note = get_field( 'format' ); ?>

<?php the_field( 'type' ); ?>
<?php $note = get_field( 'type' ); ?>

<?php the_field( 'annee' ); ?>
<?php $note = get_field( 'annee' ); ?>

<div class="photos_apparentées">
<article> Vous aimerez AUSSI </article>
		<?php 
		$args = array(
			'post_type' => 'photo',
			'meta_key' => 'categorie',
			'meta_value' => 'mariage', // Attention récup info de la catégorie de la page
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

  <?php get_footer(); ?>