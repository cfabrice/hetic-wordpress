<?php /* Template Name: Template Projects */ ?>

<?php get_header(); ?>
    <main class="main">
        <h1>Nos news</h1>
		<?php
		$lastposts = get_posts( array(
			'posts_per_page' => 6,
			'post_type'      => 'news',
			'orderby'        => 'date',
			'order'          => 'DESC'
		) );

		if ( $lastposts ) { ?>
            <section class="section section-projects">
                <div class="section-projects-wrapper">
					<?php
					foreach ( $lastposts as $post ) :
						setup_postdata( $post ); ?>
                        <a class="section-news-wrapper-item" href="<?php the_permalink() ?>">
							<?php $image = get_field( 'image_main' ); ?>
                            <div class="section-news-wrapper-item--img"
                                 style="background-image:url('<?php echo $image['url']; ?>')"></div>
                            <div class="section-news-wrapper-item--date">
								<?php the_date() ?>
                            </div>
                            <div class="section-news-wrapper-item--title">
								<?php the_title(); ?>
                            </div>
                            <div class="section-news-wrapper-item--text">
								<?php
								$givchars = 100;
								$postgiv  = get_field( 'content' );
								$modgiv   = substr( $postgiv, 0, $givchars );
								echo ' ' . $modgiv . '...';
								?>
                            </div>
                        </a>
						<?php
					endforeach;
					wp_reset_postdata();
					?>
                </div>
            </section>
		<?php } ?>
    </main>
<?php get_footer(); ?>