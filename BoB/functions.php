<?php

function BoB_resources() {
	wp_enqueue_style('bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css');
	wp_enqueue_style('style', get_stylesheet_uri());
	wp_enqueue_style('normalize', get_stylesheet_directory_uri().'/css/normalize.css');

	wp_enqueue_script( 'jquery');

	wp_enqueue_script('bootstrap','https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js',array('jquery'),'4.1.3',true);

	
	
}

add_theme_support( 'post-thumbnails' );

/**
 * On laisse WordPress s'occuper comme un grand des balises <title>
 */
add_theme_support( 'title-tag' );

/*
 * On laisse aussi WordPress gérer les liens des flux RSS dans l'entête.
 */
add_theme_support( 'automatic-feed-links' );

/*
 * On dit à WordPress d'utiliser de l'HTML5 valide pour les formulaires et les galleries
 */
add_theme_support( 'html5', array(
	'search-form',
	'comment-form',
	'comment-list',
	'gallery',
	'caption',
) );

	register_sidebar();
	
register_nav_menus( array(
	'menu-principal' => 'Menu principal'
	) );
add_action('wp_enqueue_scripts', 'BoB_resources');