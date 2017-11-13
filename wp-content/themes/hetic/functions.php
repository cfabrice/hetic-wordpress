<?php
/**
 * Created by PhpStorm.
 * User: etienne
 * Date: 06/10/2017
 * Time: 14:08
 */

define('THEME_PATH', get_template_directory());
//define( 'TEMPLATE_PATH' ,       THEME_PATH .    '/templates'        );

define('THEME_URL', get_template_directory_uri());
define('CSS_URL', THEME_URL . '/assets/css');
define('IMAGES_URL', THEME_URL . '/assets/img');
define('VIDEOS_URL', THEME_URL . '/assets/video');
define('JS_URL', THEME_URL . '/assets/js');
//define( 'FAVICONS_URL' ,        THEME_URL .    '/dist/favicon'      );
//define( 'ADMIN_IMAGES_URL' ,    IMAGES_URL .   '/admin'             );


foreach (glob(THEME_PATH . "/inc/*.php") as $file) {
    include_once $file;
}


// SECURITY
function wpb_remove_version()
{
    return '';
}

add_filter('the_generator', 'wpb_remove_version');

function remove_footer_admin()
{
    echo '<p>Made by P2020 at HETIC</p>';
}

add_filter('admin_footer_text', 'remove_footer_admin');

function no_wordpress_errors()
{
    return 'Something is wrong!';
}

add_filter('login_errors', 'no_wordpress_errors');

remove_filter('authenticate', 'wp_authenticate_email_password', 20);

function fb_filter_query($query, $error = true)
{
    if (is_search()) {
        $query->is_search     = false;
        $query->query_vars[s] = false;
        $query->query[s]      = false;

        // to error
        if ($error == true) {
            $query->is_404 = true;
        }
    }
}

function my_myme_types($mime_types)
{
    $mime_types['svg'] = 'image/svg+xml'; //Adding svg extension

    return $mime_types;
}

add_filter('upload_mimes', 'my_myme_types', 1, 1);

function wpb_imagelink_setup()
{
    $image_set = get_option('image_default_link_type');

    if ($image_set !== 'none') {
        update_option('image_default_link_type', 'none');
    }
}

add_action('admin_init', 'wpb_imagelink_setup', 10);

add_filter('xmlrpc_enabled', '__return_false');

add_action('parse_query', 'fb_filter_query');
add_filter('get_search_form', create_function('$a', "return null;"));
remove_action('welcome_panel', 'wp_welcome_panel');


add_action('wp_ajax_get_exhibitions', 'get_exhibitions');
add_action('wp_ajax_nopriv_get_exhibitions', 'get_exhibitions');


function get_exhibitions()
{
    $year = $_POST['year'];

    $posts = get_posts([
      'posts_per_page' => -1,
      'post_type'      => 'exhibitions',
      'tax_query'      => [
        [
          'taxonomy' => 'years',
          'field'    => 'name',
          'terms'    => $year,
        ]
      ]
    ]);
    foreach ($posts as $post) {
        $post->city = get_the_terms($post->ID, 'city')[0]->name;
    }
    if ($posts) {
        $posts[0]->content = get_field('content', $posts[0]->ID, false);
    }
    echo json_encode($posts);
    wp_die();
}

add_action('wp_ajax_get_exhibition', 'get_exhibition');
add_action('wp_ajax_nopriv_get_exhibition', 'get_exhibition');

function get_exhibition()
{
    $postId        = $_POST['id'];
    $post          = get_post($postId);
    $post->content = get_field('content', $postId, false);
    echo json_encode($post);

    wp_die();
}

add_action('wp_ajax_get_years', 'get_years');
add_action('wp_ajax_nopriv_get_years', 'get_years');
function get_years()
{
    $years = get_terms('years', [
      'hide_empty' => false,
      'orderby'    => 'name',
      'order'      => 'DESC'
    ]);
    echo json_encode($years);
    wp_die();
}

add_action('wp_ajax_get_news_categories', 'get_news_categories');
add_action('wp_ajax_nopriv_get_news_categories', 'get_news_categories');
function get_news_categories()
{
    $categories = get_terms('categories', [
      'hide_empty' => false,
      'orderby'    => 'name',
      'order'      => 'DESC'
    ]);
    echo json_encode($categories);
    wp_die();
}


add_action('wp_ajax_get_news', 'get_news');
add_action('wp_ajax_nopriv_get_news', 'get_news');


function get_news()
{
    $category = $_POST['category'];
    $offset   = $_POST['offset'];
    if ($category !== 'all') {
        $posts      = get_posts([
          'posts_per_page' => 8,
          'post_type'      => 'news',
          'offset'         => $offset,
          'tax_query'      => [
            [
              'taxonomy' => 'categories',
              'field'    => 'name',
              'terms'    => $category,
            ]
          ]
        ]);
        $countPosts = count($posts);
    } else {
        $countPosts = wp_count_posts('news')->publish;
        $posts      = get_posts([
          'posts_per_page' => 8,
          'post_type'      => 'news',
          'offset'         => $offset
        ]);
    }
    foreach ($posts as $key => $post) {
        $post->img         = get_field('image_main', $posts[$key]->ID)['url'];
        $post->projectDate = get_field('project_date', $posts[$key]->ID);
        $post->categories  = get_the_terms($post->ID, 'categories');
        $post->slug        = get_post_permalink($post->ID);
    }
    $posts = [$posts, $countPosts];
    echo json_encode($posts);
    wp_die();
}