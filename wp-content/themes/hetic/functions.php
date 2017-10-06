<?php
/**
 * Created by PhpStorm.
 * User: etienne
 * Date: 06/10/2017
 * Time: 14:08
 */
function ajout_scripts() {

// enregistrement d'un nouveau script
	wp_register_script('main_script', get_template_directory_uri() . '/scripts/main.js', array('jquery'),'1.1', true);

// appel du script dans la page
	wp_enqueue_script('main_script');

// enregistrement d'un nouveau style
	wp_register_style( 'main_style', get_template_directory_uri() . '/styles/main.css' );

// appel du style dans la page
	wp_enqueue_style( 'main_style' );

}
function thumbnails_theme_support(){
	add_theme_support( 'post-thumbnails' );
}

add_action( 'wp_enqueue_scripts', 'ajout_scripts' );
add_action( 'after_setup_theme', 'thumbnails_theme_support' );
