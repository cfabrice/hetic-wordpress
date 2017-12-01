<?php /* Template Name: Template Single News */ ?>
<?php get_header(); //appel du template header.php  ?>
    <main class="main article">
        <header class="article-header">
            <h2 class="article-title">
                <?php the_title() ?>
            </h2>
            <p class="article-about">
                <?php $categories = get_the_terms(get_the_ID(), 'categories');
                ?>
                Publié dans
                <?php foreach ($categories as $key => $category) : ?>
                    <?php echo $key !== count($categories) - 1 ? $category->name.',' : $category->name; ?>
                <?php endforeach; ?>
                le <?php the_time('l j F Y'); ?>
            </p>
            <div class="article-full-image">
                <?php $image = get_field('image_main'); ?>
                <img src="<?php echo $image['url']; ?>" alt="image name">
            </div>
        </header>
        <div class="article-content">
            <h3 class="article-content-title">
                <?php the_title() ?>
            </h3>
            <p>
                <?php the_field('content'); ?>
            </p>
            <ul class="article-share">
                <li class="facebook">
                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']; ?>"
                       title="facebook share" target="_blank">
                        <svg viewBox="0 0 24 24">
                            <path fill="#000000"
                                  d="M5,3H19A2,2 0 0,1 21,5V19A2,2 0 0,1 19,21H5A2,2 0 0,1 3,19V5A2,2 0 0,1 5,3M18,5H15.5A3.5,3.5 0 0,0 12,8.5V11H10V14H12V21H15V14H18V11H15V9A1,1 0 0,1 16,8H18V5Z"/>
                        </svg>
                        <span>Share on Facebook</span>
                    </a>
                </li>
                <li class="twitter">
                    <a href="https://twitter.com/intent/tweet?url=<?php echo $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']; ?>&text=<?php the_title() ?>&hashtags=JR"
                       title="twitter share" target="_blank">
                        <svg viewBox="0 0 24 24">
                            <path fill="#000000"
                                  d="M22.46,6C21.69,6.35 20.86,6.58 20,6.69C20.88,6.16 21.56,5.32 21.88,4.31C21.05,4.81 20.13,5.16 19.16,5.36C18.37,4.5 17.26,4 16,4C13.65,4 11.73,5.92 11.73,8.29C11.73,8.63 11.77,8.96 11.84,9.27C8.28,9.09 5.11,7.38 3,4.79C2.63,5.42 2.42,6.16 2.42,6.94C2.42,8.43 3.17,9.75 4.33,10.5C3.62,10.5 2.96,10.3 2.38,10C2.38,10 2.38,10 2.38,10.03C2.38,12.11 3.86,13.85 5.82,14.24C5.46,14.34 5.08,14.39 4.69,14.39C4.42,14.39 4.15,14.36 3.89,14.31C4.43,16 6,17.26 7.89,17.29C6.43,18.45 4.58,19.13 2.56,19.13C2.22,19.13 1.88,19.11 1.54,19.07C3.44,20.29 5.7,21 8.12,21C16,21 20.33,14.46 20.33,8.79C20.33,8.6 20.33,8.42 20.32,8.23C21.16,7.63 21.88,6.87 22.46,6Z"/>
                        </svg>
                        <span>Share on Twitter</span>
                    </a>
                </li>
                <li class="linkedin">
                    <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']; ?>&title=<?php the_title() ?>&summary=<?php the_title() ?>&source=jr-art"
                       title="linkedin share" target="_blank">
                        <svg viewBox="0 0 24 24">
                            <path fill="#000000"
                                  d="M19,3A2,2 0 0,1 21,5V19A2,2 0 0,1 19,21H5A2,2 0 0,1 3,19V5A2,2 0 0,1 5,3H19M18.5,18.5V13.2A3.26,3.26 0 0,0 15.24,9.94C14.39,9.94 13.4,10.46 12.92,11.24V10.13H10.13V18.5H12.92V13.57C12.92,12.8 13.54,12.17 14.31,12.17A1.4,1.4 0 0,1 15.71,13.57V18.5H18.5M6.88,8.56A1.68,1.68 0 0,0 8.56,6.88C8.56,5.95 7.81,5.19 6.88,5.19A1.69,1.69 0 0,0 5.19,6.88C5.19,7.81 5.95,8.56 6.88,8.56M8.27,18.5V10.13H5.5V18.5H8.27Z"/>
                        </svg>
                        <span>Share on Linkedin</span>
                    </a>
                </li>
            </ul>
            <div class="item-container article-related">
                <h4 class="item-title article-related-title">related articles</h4>
                <ul>
                    <?php
                    $lastposts = get_posts([
                      'posts_per_page' => 4,
                      'post_type'      => 'news',
                      'orderby'        => 'date',
                      'order'          => 'DESC'
                    ]);

                    if ($lastposts) { ?>
                        <?php
                        foreach ($lastposts as $post) :
                            setup_postdata($post); ?>
                            <li><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></li>
                            <?php
                        endforeach;
                        wp_reset_postdata();
                        ?>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </main>

<?php get_footer(); //appel du template footer.php ?>