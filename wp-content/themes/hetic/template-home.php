<?php /* Template Name: Template Home */ ?>

<?php get_header(); ?>
<main class="main">
    <section class="section section-social">
        <div class="section-social-photo" style="background-image:url('<?php echo IMAGES_URL ?>/JR-insta.jpg')"></div>
        <div class="section-social-content">
            <h2 class="section-social-content--title">
                <?php the_field('section_1_title') ?>
            </h2>
            <div class="section-social-content-about">
                <div class="section-social-content-about--img" style="background-image:url('<?php echo IMAGES_URL ?>/JR-profile.jpg')" ></div>
                <span class="section-social-content-about--name">
              <?php the_field('section_1_user_name') ?>
            </span>
            </div>
            <div class="section-social-content--text">
	            <?php the_field('section_1_text') ?>
            </div>
            <div class="section-social-content--date">
                3 hours ago
            </div>
        </div>
        <div class="section-social-links">
            <a href="<?php the_field('section_1_instagram_link') ?>" target="_blank" class="section-social-links-link section-social-links-link--insta">
	            <?php the_field('section_1_instagram_text') ?>
            </a>
            <a href="<?php the_field('section_1_twitter_link') ?>" target="_blank" class="section-social-links-link section-social-links-link--twitter">
	            <?php the_field('section_1_twitter_text') ?>
            </a>
        </div>
    </section>
	<?php
	$lastposts = get_posts( array(
		'posts_per_page' => 4,
		'post_type' => 'news',
		'orderby' => 'date',
		'order' => 'DESC'
	) );

	if ( $lastposts ) { ?>
        <section class="section section-news">
            <h2 class="section-news--title section--title">
                news
            </h2>
            <div class="section-news-wrapper">
				<?php
				foreach ( $lastposts as $post ) :
					setup_postdata( $post ); ?>
                    <a class="section-news-wrapper-item" href="<?php the_permalink() ?>">
	                    <?php $image = get_field( 'photo' ); ?>
                        <div class="section-news-wrapper-item--img"
                             style="background-image:url('<?php echo $image['url']; ?>')"></div>
                        <div class="section-news-wrapper-item--date">
                            <?php the_date() ?>
                        </div>
                        <div class="section-news-wrapper-item--title">
							<?php the_title(); ?>
                        </div>
                        <div class="section-news-wrapper-item--text">
							<?php the_content(); ?>
                        </div>
                    </a>
					<?php
				endforeach;
				wp_reset_postdata();
				?>
            </div>
            <a href="<?php echo get_page_link( get_page_by_title( 'news' )->ID ); ?>" class="section-news--link section--link">
                Read more articles
            </a>
        </section>
		<?php
	}
	$lastposts = get_posts( array(
		'posts_per_page' => 4,
		'post_type' => 'last_projects',
		'orderby' => 'date',
		'order' => 'DESC'
	) );

	if ( $lastposts ) { ?>
    <section class="section section-projects">
        <h2 class="section-projects--title section--title">
            Latest Projects
        </h2>
        <div class="section-projects-wrapper">
            <?php
		        foreach ( $lastposts as $post ) :
			        setup_postdata( $post ); ?>
                    <a class="section-projects-wrapper-item" href="<?php the_permalink() ?>">
                        <div class="section-projects-wrapper-item--date">
	                        <?php the_field('year'); ?>
                        </div>
	                    <?php $image = get_field( 'photo' ); ?>
                        <div class="section-projects-wrapper-item--img" style="background-image:url('<?php echo $image['url']; ?>')"></div>
                        <div class="section-projects-wrapper-item--title">
	                        <?php the_field('title'); ?>
                        </div>
                        <div class="section-projects-wrapper-item--tags">
	                        <?php the_field('tags'); ?>
                        </div>
                    </a>
			        <?php
		        endforeach;
		        wp_reset_postdata();
	        ?>
        </div>
        <a href="<?php echo get_page_link( get_page_by_title( 'projects' )->ID ); ?>" class="section-projects--link section--link">
            Discover more projects
        </a>
    </section>
    <?php } ?>
    <section class="section-exhibitions">
        <div class="section-exhibitions--title section--title">
            exhibitions
        </div>
    </section>
</main>
<?php get_footer(); ?>
