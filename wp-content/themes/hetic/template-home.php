<?php /* Template Name: Template Home */ ?>

<?php get_header(); ?>
<main class="main">
    <section class="section section-social">
        <div class="section-social-photo"
             style="background-image:url('<?php echo THEME_URL ?>/instagram/photo.jpg')"></div>
        <div class="section-social-content">
            <h2 class="section-social-content--title">
                <?php the_field('section_1_title') ?>
            </h2>
            <div class="section-social-content-about">
                <div class="section-social-content-about--img"
                     style="background-image:url('<?php echo IMAGES_URL ?>/JR-profile.jpg')"></div>
                <span class="section-social-content-about--name">
                <?php the_field('section_1_user_name') ?>
            </span>
            </div>
            <div class="section-social-content--text">
                <p>
                    <?php
                    $str  = file_get_contents(THEME_URL . '/instagram/instagram.json');
                    $json = json_decode($str);
                    echo $json->desc
                    ?>
                </p>
            </div>
            <div class="section-social-content--date">
                <time id="instagramDate" datetime="<?php echo $json->photoTime ?>"></time>
            </div>
        </div>
        <div class="section-social-links">
            <a href="<?php the_field('section_1_instagram_link') ?>" target="_blank"
               class="section-social-links-link section-social-links-link--insta">
                <?php the_field('section_1_instagram_text') ?>
            </a>
            <a href="<?php the_field('section_1_twitter_link') ?>" target="_blank"
               class="section-social-links-link section-social-links-link--twitter">
                <?php the_field('section_1_twitter_text') ?>
            </a>
        </div>
    </section>
    <?php
    $lastposts = get_posts([
      'posts_per_page' => 3,
      'post_type'      => 'news',
      'order'          => 'DESC',
      'orderby'        => 'project_date',
      'meta_key'       => 'project_date'
    ]);

    if ($lastposts) { ?>
        <section class="section section-news">
            <h2 class="section-news--title section--title">
                <?php the_field('section_news_title') ?>
            </h2>
            <div class="section-news-wrapper">
                <?php
                foreach ($lastposts as $post) :
                    setup_postdata($post); ?>
                    <a class="section-news-wrapper-item" href="<?php the_permalink() ?>">
                        <?php $image = get_field('image_main'); ?>
                        <div class="section-news-wrapper-item--img"
                             style="background-image:url('<?php echo $image['url']; ?>')"></div>
                        <div class="section-news-wrapper-item--date">
                            <?php $date = get_field('project_date', false, false);
                            $date       = new DateTime($date); ?>
                            <?php echo $date->format('j M Y'); ?>
                        </div>
                        <div class="section-news-wrapper-item--title">
                            <?php the_title(); ?>
                        </div>
                        <div class="section-news-wrapper-item--text">
                            <?php
                            $givchars = 100;
                            $postgiv  = get_field('content');
                            $modgiv   = substr($postgiv, 0, $givchars);
                            echo ' ' . $modgiv . '...';
                            ?>
                        </div>
                    </a>
                    <?php
                endforeach;
                wp_reset_postdata();
                ?>
            </div>
            <a href=" <?php the_field('section_news_button_link') ?>"
               class="section-projects--link section--link">
                <?php the_field('section_news_button_text') ?>
            </a>
        </section>
        <?php
    }
    $lastposts = get_posts([
      'posts_per_page' => 3,
      'post_type'      => 'projects',
      'orderby'        => 'year',
      'meta_key'       => 'year',
      'order'          => 'DESC'
    ]);

    if ($lastposts) { ?>
        <section class="section section-projects">
            <h2 class="section-projects--title section--title">
                <?php the_field('section_projects') ?>
            </h2>
            <div class="section-projects-wrapper">
                <?php
                foreach ($lastposts as $post) : ?>
                    <div class="section-projects-wrapper-item">
                        <div class="section-projects-wrapper-item--date">
                            <?php the_field('year'); ?>
                        </div>
                        <?php
                        $i = 0;
                        if (have_rows('photos')) {
                            while ($i < 1) {
                                the_row();
                                $img = get_sub_field('image');
                                $img = $img['url'];
                                $i++;
                            }
                        }
                        ?>
                        <div class="section-projects-wrapper-item--img"
                             style="background-image:url('<?php echo $img; ?>')"></div>
                        <div class="section-projects-wrapper-item--title">
                            <?php
                            the_field('title');
                            ?>
                        </div>
                        <div class="section-projects-wrapper-item--tags">
                            <?php the_field('tags'); ?>
                        </div>
                    </div>
                    <?php
                endforeach;
                wp_reset_postdata();
                ?>
            </div>
            <a href=" <?php the_field('section_projects_button_link') ?>"
               class="section-projects--link section--link">
                <?php the_field('section_projects_button_text') ?>
            </a>
        </section>
    <?php } ?>

    <?php
    $terms = get_terms('city', [
      'orderby' => 'name',
      'order'   => 'ASC'
    ]);
    if ( ! empty($terms) && ! is_wp_error($terms)) { ?>
        <section class="section section-exhibitions">
            <div class="section-exhibitions--title section--title">
                <?php the_field('section_exhibition') ?>
            </div>
            <div class="section-exhibitions-container">
                <div class="section-exhibitions-container-slider">
                    <div class="section-exhibitions-container-slider-wrapper">
                        <div class="section-exhibitions-container-slider-wrapper-list">
                            <?php
                            foreach ($terms as $key => $term) :
                                $posts = get_posts([
                                  'posts_per_page' => -1,
                                  'post_type'      => 'exhibitions',
                                  'tax_query'      => [
                                    [
                                      'taxonomy' => 'city',
                                      'field'    => 'slug',
                                      'terms'    => $term->slug,
                                    ]
                                  ]
                                ]);
                                ?>
                                <div class="section-exhibitions-container-slider-wrapper-list--item"
                                     style="background-image: url('<?php echo get_field('photos',
                                       $posts[0]->ID)[0]['photo']['url'] ?> ')"></div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="section-exhibitions-container-slider-nav">
                        <div class="section-exhibitions-container-slider-nav-list">
                            <?php
                            foreach ($terms as $key => $term) {
                                echo '<button class="section-exhibitions-container-slider-nav-list--item ' . ($key === 0 ? "active" : "") . '">' . $term->name . '</button>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="section-exhibitions-container-content">
                    <div class="section-exhibitions-container-content-wrapper">
                        <div class="section-exhibitions-container-content-wrapper-list">
                            <?php
                            foreach ($terms as $key => $term) :
                                ?>
                                <div class="section-exhibitions-container-content-wrapper-list--item">
                                    <div class="section-exhibitions-container-content-wrapper-list--item--title">
                                        <?php echo get_field('titre', $posts[0]->ID) ?>
                                    </div>
                                    <div class="section-exhibitions-container-content-wrapper-list--item--text">
                                        <?php echo get_field('content', $posts[0]->ID) ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
            <a href=" <?php the_field('section_exhibition_button_link') ?>"
               class="section-projects--link section--link">
                <?php the_field('section_exhibition_button_text') ?>
            </a>
        </section>
    <?php } ?>
    <section class="section section-videos">
        <h2 class="section-videos--title section--title">
            <?php the_field('section_video_title') ?>
        </h2>
        <div class="section-videos-wrapper" id="video-home">
            <div class="section-videos-wrapper-effect section-videos-wrapper-effect-play">
                <svg fill="#000000" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 0h24v24H0z" fill="none"/>
                    <path d="M8 5v14l11-7z" class="icon"/>
                </svg>
            </div>
            <div class="section-videos-wrapper-effect section-videos-wrapper-effect-pause">
                <svg fill="#000000" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 0h24v24H0z" fill="none"/>
                    <path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z" class="icon"/>
                </svg>
            </div>
            <video class="section-videos-wrapper-video" src="<?php echo get_field('videos')[0]['video']['url']; ?>"
                   controlsList="nodownload"></video>
            <button class="section-videos-wrapper-controls--fullscreen">
                <svg fill="#000000" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 0h24v24H0z" fill="none"/>
                    <path d="M7 14H5v5h5v-2H7v-3zm-2-4h2V7h3V5H5v5zm12 7h-3v2h5v-5h-2v3zM14 5v2h3v3h2V5h-5z"
                          class="icon"/>
                </svg>
            </button>
            <div class="section-videos-wrapper-controls">
                <button class="section-videos-wrapper-controls--skip section-videos-wrapper-controls--skip-prev hide">
                    <svg fill="#000000" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M6 6h2v12H6zm3.5 6l8.5 6V6z" class="icon"/>
                        <path d="M0 0h24v24H0z" fill="none"/>
                    </svg>
                </button>
                <button class="section-videos-wrapper-controls--toggle">
                    <svg fill="#000000" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M8 5v14l11-7z" class="icon"/>
                        <path d="M0 0h24v24H0z" fill="none"/>
                    </svg>
                </button>
                <button class="section-videos-wrapper-controls--skip section-videos-wrapper-controls--skip-next">
                    <svg fill="#000000" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M6 18l8.5-6L6 6v12zM16 6v12h2V6h-2z" class="icon"/>
                        <path d="M0 0h24v24H0z" fill="none"/>
                    </svg>
                </button>
                <div class="section-videos-wrapper-controls--time section-videos-wrapper-controls--time-current">00:00
                </div>
                <span class="section-videos-wrapper-controls--time section-videos-wrapper-controls--time-separation">/</span>
                <div class="section-videos-wrapper-controls--time section-videos-wrapper-controls--time-duration">
                    00:00
                </div>
                <div class="section-videos-wrapper-controls-seek-bar">
                    <div class="section-videos-wrapper-controls-seek-bar--fill"></div>
                </div>
                <div class="section-videos-wrapper-controls-volume">
                    <button class="section-videos-wrapper-controls-volume--icon volume-2">
                        <svg fill="#000000" height="24" viewBox="0 0 24 24" width="24"
                             xmlns="http://www.w3.org/2000/svg">
                            <path d="M18.5 12c0-1.77-1.02-3.29-2.5-4.03v8.05c1.48-.73 2.5-2.25 2.5-4.02zM5 9v6h4l5 5V4L9 9H5z"
                                  class="icon"/>
                            <path d="M0 0h24v24H0z" fill="none"/>
                        </svg>
                    </button>
                    <div class="section-videos-wrapper-controls-volume--bar">
                        <div class="section-videos-wrapper-controls-volume--bar-fill">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section-videos-nav">
            <button class="section-videos-nav-controls section-videos-nav-controls--prev hide">
                <svg fill="#000000" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M15.41 7.41L14 6l-6 6 6 6 1.41-1.41L10.83 12z" class="icon"/>
                    <path d="M0 0h24v24H0z" fill="none"/>
                </svg>
            </button>
            <div class="section-videos-nav-wrapper">
                <div class="section-videos-nav-wrapper-list">
                    <?php
                    if (have_rows('videos')) :
                        while (have_rows('videos')) :
                            the_row();
                            $image = get_sub_field('image')['url'];
                            $video = get_sub_field('video');
                            ?>
                            <button data-target="<?php echo $video['url']; ?>"
                                    style="background-image:url('<?php echo $image; ?>')"
                                    class="section-videos-nav-wrapper-list-item">
                                <span><?php echo $video['title']; ?></span>
                            </button>
                            <?php
                        endwhile;
                    endif;

                    ?>
                </div>
            </div>
            <button class="section-videos-nav-controls section-videos-nav-controls--next">
                <svg fill="#000000" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z" class="icon"/>
                    <path d="M0 0h24v24H0z" fill="none"/>
                </svg>
            </button>
        </div>
    </section>
    <section class="section section-about">
        <h2 class="section-about--title section--title">
            <?php the_field('section_about_title') ?>
        </h2>
        <div class="section-about-wrapper">
            <div class="section-about-wrapper-content">
                <?php the_field('section_about_content') ?>
                <a href=" <?php the_field('section_about_link') ?>"
                   class="section-about-wrapper--link">
                    <?php the_field('section_about_link_text') ?>
                </a>
            </div>
            <?php $image = get_field('section_about_photo'); ?>
            <div class="section-about-wrapper-img" style="background-image:url('<?php echo $image['url']; ?>"></div>
        </div>
        <div class="section-about-social">
            <a href="<?php the_field('section_1_instagram_link') ?>" target="_blank" class="section-about-social--link">
                <?php the_field('section_1_instagram_text') ?>
            </a>
            <a href="<?php the_field('section_1_twitter_link') ?>" target="_blank" class="section-about-social--link">
                <?php the_field('section_1_twitter_text') ?>
            </a>
        </div>
    </section>
</main>
<?php get_footer(); ?>
