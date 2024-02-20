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

<?php
	echo get_field( 'reference' );
	echo get_field( 'categorie' );
	echo get_field( 'format' );
	echo get_field( 'type' );
	echo get_field( 'annee' );
?>     

<?php the_field( 'reference' ); // Afficher une valeur ?> 
<?php echo get_field( 'reference' ); // Récupérer la valeur ?> 

<?php the_field( 'categorie' ); ?>
<?php $note = get_field( 'categorie' ); ?>

<?php the_field( 'format' ); ?>
<?php $note = get_field( 'format' ); ?>

<?php the_field( 'type' ); ?>
<?php $note = get_field( 'type' ); ?>

<?php the_field( 'annee' ); ?>
<?php $note = get_field( 'annee' ); ?>

<?php get_footer(); ?>