<?php

function add_project_type_init() {
	$args = array(
		'public' => true,
		'label'  => 'Projects'
	);
	register_post_type( 'projects', $args );
}

add_action( 'init', 'add_project_type_init' );

function add_news_type_init() {
	$args = array(
		'public'      => true,
		'label'       => 'News',
		'has_archive' => false,
	);
	register_post_type( 'news', $args );
}

add_action( 'init', 'add_news_type_init' );

function add_exhibitions_type_init() {
	$args = array(
		'public' => true,
		'label'  => 'Exhibitions'
	);
	register_post_type( 'exhibitions', $args );
}
add_action( 'init', 'add_exhibitions_type_init' );

register_taxonomy( 'years', ['exhibitions'], [
	'label'        => __( 'Année' ),
	'rewrite'      => [ 'slug' => 'years' ],
	'hierarchical' => true,
] );

register_taxonomy( 'city', ['exhibitions'], [
	'label'        => __( 'Ville' ),
	'rewrite'      => [ 'slug' => 'city' ],
	'hierarchical' => true,
] );
register_taxonomy( 'categories', ['news'], [
	'label'        => __( 'Catégories' ),
	'rewrite'      => [ 'slug' => 'categories' ],
	'hierarchical' => true,
] );
register_taxonomy( 'project_category', ['projects'], [
	'label'        => __( 'Projet Catégorie' ),
	'rewrite'      => [ 'slug' => 'project_category' ],
	'hierarchical' => true,
] );
