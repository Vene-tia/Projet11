<!doctype html>
<html <?php language_attributes(); ?> <?php twentytwentyone_the_html_classes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<header class="header">
    <?php wp_nav_menu(array('theme_location' => 'header-menu', 'menu_class' => 'header-menu', )); ?>
    <button class="header-menu modale">Contact</button>
</header>
<?php wp_body_open(); ?>