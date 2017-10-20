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
		'public' => true,
		'label'  => 'News'
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

function add_video_type_init() {
	$args = array(
		'public' => true,
		'label'  => 'Vidéos'
	);
	register_post_type( 'videos', $args );
}
add_action( 'init', 'add_video_type_init' );