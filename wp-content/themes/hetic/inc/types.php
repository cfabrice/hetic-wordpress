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