<?php
/**
 * Created by PhpStorm.
 * User: etienne
 * Date: 01/12/2017
 * Time: 11:04
 */
add_action('wp_head', 'myplugin_ajaxurl');

function myplugin_ajaxurl()
{
    echo '<script type="text/javascript">
           var ajaxurl = "' . admin_url('admin-ajax.php') . '";
         </script>';
}

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
        $posts[0]->photos  = get_field('photos', $posts[0]->ID);
        $posts[0]->video   = get_field('video', $posts[0]->ID);
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
    $post->photos  = get_field('photos', $post->ID);
    $post->video   = get_field('video', $post->ID);
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
      'order'      => 'DESC',
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
          'offset'         => $offset,
          'order'          => 'DESC',
          'orderby'        => 'project_date',
          'meta_key'       => 'project_date'
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

add_action('wp_ajax_get_projects_categories', 'get_projects_categories');
add_action('wp_ajax_nopriv_get_projects_categories', 'get_projects_categories');
function get_projects_categories()
{
    $categories = get_terms('project_category', [
      'hide_empty' => false,
      'orderby'    => 'name',
      'order'      => 'ASC'
    ]);
    echo json_encode($categories);
    wp_die();
}

add_action('wp_ajax_get_projects_details', 'get_projects_details');
add_action('wp_ajax_nopriv_get_projects_details', 'get_projects_details');
function get_projects_details()
{
    $project_category = $_POST['project_category'];

    $posts = get_posts([
      'posts_per_page' => -1,
      'post_type'      => 'projects',
      'tax_query'      => [
        [
          'taxonomy' => 'project_category',
          'field'    => 'slug',
          'terms'    => $project_category,
        ]
      ]
    ]);
    if ($posts) {
        $posts[0]->content = get_field('content', $posts[0]->ID, false);
        $posts[0]->photos  = get_field('photos', $posts[0]->ID);
        $posts[0]->videos  = get_field('videos', $posts[0]->ID);
        $posts[0]->year    = get_field('year', $posts[0]->ID);
    }
    echo json_encode($posts);
    wp_die();
}

add_action('wp_ajax_get_project_detail', 'get_project_detail');
add_action('wp_ajax_nopriv_get_project_detail', 'get_project_detail');
function get_project_detail()
{
    $postId        = $_POST['id'];
    $post          = get_post($postId);
    $post->photos  = get_field('photos', $post->ID);
    $post->videos  = get_field('videos', $post->ID);
    $post->content = get_field('content', $postId, false);
    echo json_encode($post);

    wp_die();
}