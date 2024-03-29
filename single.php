<?php get_header(); ?>
<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
<article class="post">
   	<div class="post-info-image">
		<div class="post-image">
			<?php the_post_thumbnail(); ?>
			<div class="post-lightbox">
				<div class="post-lightbox-single"></div>
			</div>
		</div>
   		<div class="post-info">			 
            <div class="post-texte">
                <h1><?php the_title(); ?></h1>
				<div class="REF">
                	<p> RÉFERENCE : </p>
					<p id="BF"><?php echo get_post_meta(get_the_ID(), 'reference', true); ?></p>
				</div>
                <p> CATÉGORIE : <?php echo get_field( 'categorie' ) ?></p> 
                <p> FORMAT : <?php echo get_field( 'format' ) ?></p>
                <p> TYPE : <?php echo get_post_meta(get_the_ID(), 'type', true); ?></p>
                <p> ANNÉE : <?php the_date('Y'); ?></p>
            </div>
		</div>
	</div>
    <div class="post-commande">
		<div class="post-commande-texte">
			<p>Cette photo vous intéresse ?</p>
			<button class="button_contact" >Contact</button>
			<!-- <ul id="commande-contact" class="commande-contact">
                <li><a href="#" class="button contactBtn" data-reference=" ---- php  ---- ">CONTACT</a></li>
            </ul> -->
		</div>
		<div class="post-commande-navigation">	
			<div class="post-commande-arrow">
				<div class="commande_left">
					<a href="<?php echo get_permalink(get_previous_post()); ?>"><span class="img1"><?php echo get_the_post_thumbnail(get_previous_post(),'medium'); ?></a>
					<a href="<?php echo get_permalink(get_previous_post()); ?>"><img class="arrow_left" alt="arrow left" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/arrow_left.png"></a>
				</div>
				<div class="commande_right">
					<a href="<?php echo get_permalink(get_next_post()); ?>"><span class="img2"><?php echo get_the_post_thumbnail(get_next_post(),'medium'); ?></a>
					<a href="<?php echo get_permalink(get_next_post()); ?>"><img class="arrow_right" alt="arrow right" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/arrow_right.png"></a>
				</div>
			</div>	
		</div>
	</div>
	<div class="post-apparente">
		<h2>VOUS AIMEREZ AUSSI</h2>
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
</article>
	
<?php endwhile; endif; ?>
<?php get_footer(); ?>