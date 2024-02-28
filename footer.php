<footer id="colophon" class="site-footer">

    <?php if ( has_nav_menu( 'footer' ) ) : ?>
        <nav aria-label="<?php esc_attr_e( 'Secondary menu', 'twentytwentyone' ); ?>" class="footer-navigation">
            <ul class="footer-navigation-wrapper">
                <?php
                wp_nav_menu(
                    array(
                        'theme_location' => 'footer',
                        'items_wrap'     => '%3$s',
                        'container'      => false,
                        'depth'          => 1,
                        'link_before'    => '<span>',
                        'link_after'     => '</span>',
                        'fallback_cb'    => false,
                    )
                );
                ?>
            </ul><!-- .footer-navigation-wrapper -->
        </nav><!-- .footer-navigation -->
    <?php endif; ?>
</footer><!-- #colophon -->

<?php get_template_part('templates_part/modale'); ?>

<div class="lightbox" id="mylightbox">
    <button class="close_lightbox"></button>
    <button class="next_lightbox"></button>
    <button class="before_lightbox"></button>
    <div class="lightbox__container"></div>
    <?php echo get_field( 'reference' );
	echo get_field( 'categorie' ); ?>
</div>

<?php wp_footer(); ?>

</body>
</html>