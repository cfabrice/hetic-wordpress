<?php /* Template Name: Template News */ ?>

<?php get_header(); ?>
<main class="main">
	<?php
	$lastposts = get_posts( array(
		'posts_per_page' => 4,
		'post_type' => 'news',
		'orderby' => 'date',
		'order' => 'DESC'
	) );

	if ( $lastposts ) { ?>
        <section class="section section-news">
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
        </section>
		<?php
	}?>
</main>
<?php get_footer(); ?>