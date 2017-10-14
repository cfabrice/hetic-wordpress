<?php /* Template Name: Template Home */ ?>

<?php get_header(); ?>
<main class="main">
    <section class="section section-social">
        <div class="section-social-photo" style="background-image:url('<?php echo THEME_URL ?>/instagram/photo.jpg')"></div>
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
                <p>
                    <?php 
                    $str = file_get_contents(THEME_URL . '/instagram/instagram.json');
                    $json = json_decode($str);
                    echo $json->desc
                    // the_field('section_1_text') 
                    ?>
                </p>
            </div>
            <div class="section-social-content--date">
                <?php echo $json->date ?>
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
		'post_type' => 'projects',
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
    <section class="section section-exhibitions">
    <div class="section-exhibitions--title section--title">
      exhibitions
    </div>
    <div class="section-exhibitions-container">
      <div class="section-exhibitions-container-slider">
        <div class="section-exhibitions-container-slider-wrapper">
          <div class="section-exhibitions-container-slider-wrapper-list">
            <div class="section-exhibitions-container-slider-wrapper-list--item" style="background-image: url('<?php echo IMAGES_URL ?>/exhibitions-1.jpg')"></div>
            <div class="section-exhibitions-container-slider-wrapper-list--item" style="background-image: url('<?php echo IMAGES_URL ?>/exhibitions-1.jpg')"></div>
            <div class="section-exhibitions-container-slider-wrapper-list--item" style="background-image: url('<?php echo IMAGES_URL ?>/exhibitions-1.jpg')"></div>
            <div class="section-exhibitions-container-slider-wrapper-list--item" style="background-image: url('<?php echo IMAGES_URL ?>/exhibitions-1.jpg')"></div>
            <div class="section-exhibitions-container-slider-wrapper-list--item" style="background-image: url('<?php echo IMAGES_URL ?>/exhibitions-1.jpg')"></div>
            <div class="section-exhibitions-container-slider-wrapper-list--item" style="background-image: url('<?php echo IMAGES_URL ?>/exhibitions-1.jpg')"></div>
          </div>
        </div>
        <div class="section-exhibitions-container-slider-nav">
          <div class="section-exhibitions-container-slider-nav-list">
            <button class="section-exhibitions-container-slider-nav-list--item active">Paris</button>
            <button class="section-exhibitions-container-slider-nav-list--item">London</button>
            <button class="section-exhibitions-container-slider-nav-list--item">Berlin</button>
            <button class="section-exhibitions-container-slider-nav-list--item">Tokyo</button>
            <button class="section-exhibitions-container-slider-nav-list--item">Honk-Kong</button>
            <button class="section-exhibitions-container-slider-nav-list--item">Shangai</button>
          </div>
        </div>
      </div>
      <div class="section-exhibitions-container-content">
        <div class="section-exhibitions-container-content-wrapper">
          <div class="section-exhibitions-container-content-wrapper-list">
            <div class="section-exhibitions-container-content-wrapper-list--item">
              <div class="section-exhibitions-container-content-wrapper-list--item--date">
                From March 1st to June 29th, 2014
              </div>
              <div class="section-exhibitions-container-content-wrapper-list--item--title">
                baden baden, germany - frieder burda museum
              </div>
              <div class="section-exhibitions-container-content-wrapper-list--item--text">
                In February 2014, JR presents a solo exhibition at the Museum Frieder Burda, in Baden Baden, Germany - a retrospective of his career, with a special Inside Out Photobooth installation. The museum reveals for the first time the images from the Wrinkles of the City project organized in Berlin in April 2013.
                <br/>
                <br/>
                Besides, his Unframed project also comes to Baden-Baden. As a large-scale project in the city’s urban space. Unframed Baden Baden addresses German-French history and the friendship between the two countries.                    
              </div>
            </div>
            <div class="section-exhibitions-container-content-wrapper-list--item">
              <div class="section-exhibitions-container-content-wrapper-list--item--date">
                From March 1st to June 29th, 2014
              </div>
              <div class="section-exhibitions-container-content-wrapper-list--item--title">
                baden baden, germany - frieder burda museum
              </div>
              <div class="section-exhibitions-container-content-wrapper-list--item--text">
                In February 2014, JR presents a solo exhibition at the Museum Frieder Burda, in Baden Baden, Germany - a retrospective of his career, with a special Inside Out Photobooth installation. The museum reveals for the first time the images from the Wrinkles of the City project organized in Berlin in April 2013.
                <br/>
                <br/>
                Besides, his Unframed project also comes to Baden-Baden. As a large-scale project in the city’s urban space. Unframed Baden Baden addresses German-French history and the friendship between the two countries.                    
              </div>
            </div>
            <div class="section-exhibitions-container-content-wrapper-list--item">
              <div class="section-exhibitions-container-content-wrapper-list--item--date">
                From March 1st to June 29th, 2014
              </div>
              <div class="section-exhibitions-container-content-wrapper-list--item--title">
                baden baden, germany - frieder burda museum
              </div>
              <div class="section-exhibitions-container-content-wrapper-list--item--text">
                In February 2014, JR presents a solo exhibition at the Museum Frieder Burda, in Baden Baden, Germany - a retrospective of his career, with a special Inside Out Photobooth installation. The museum reveals for the first time the images from the Wrinkles of the City project organized in Berlin in April 2013.
                <br/>
                <br/>
                Besides, his Unframed project also comes to Baden-Baden. As a large-scale project in the city’s urban space. Unframed Baden Baden addresses German-French history and the friendship between the two countries.                    
              </div>
            </div>
            <div class="section-exhibitions-container-content-wrapper-list--item">
              <div class="section-exhibitions-container-content-wrapper-list--item--date">
                From March 1st to June 29th, 2014
              </div>
              <div class="section-exhibitions-container-content-wrapper-list--item--title">
                baden baden, germany - frieder burda museum
              </div>
              <div class="section-exhibitions-container-content-wrapper-list--item--text">
                In February 2014, JR presents a solo exhibition at the Museum Frieder Burda, in Baden Baden, Germany - a retrospective of his career, with a special Inside Out Photobooth installation. The museum reveals for the first time the images from the Wrinkles of the City project organized in Berlin in April 2013.
                <br/>
                <br/>
                Besides, his Unframed project also comes to Baden-Baden. As a large-scale project in the city’s urban space. Unframed Baden Baden addresses German-French history and the friendship between the two countries.                    
              </div>
            </div>
            <div class="section-exhibitions-container-content-wrapper-list--item">
              <div class="section-exhibitions-container-content-wrapper-list--item--date">
                From March 1st to June 29th, 2014
              </div>
              <div class="section-exhibitions-container-content-wrapper-list--item--title">
                baden baden, germany - frieder burda museum
              </div>
              <div class="section-exhibitions-container-content-wrapper-list--item--text">
                In February 2014, JR presents a solo exhibition at the Museum Frieder Burda, in Baden Baden, Germany - a retrospective of his career, with a special Inside Out Photobooth installation. The museum reveals for the first time the images from the Wrinkles of the City project organized in Berlin in April 2013.
                <br/>
                <br/>
                Besides, his Unframed project also comes to Baden-Baden. As a large-scale project in the city’s urban space. Unframed Baden Baden addresses German-French history and the friendship between the two countries.                    
              </div>
            </div>
            <div class="section-exhibitions-container-content-wrapper-list--item">
              <div class="section-exhibitions-container-content-wrapper-list--item--date">
                From March 1st to June 29th, 2014
              </div>
              <div class="section-exhibitions-container-content-wrapper-list--item--title">
                baden baden, germany - frieder burda museum
              </div>
              <div class="section-exhibitions-container-content-wrapper-list--item--text">
                In February 2014, JR presents a solo exhibition at the Museum Frieder Burda, in Baden Baden, Germany - a retrospective of his career, with a special Inside Out Photobooth installation. The museum reveals for the first time the images from the Wrinkles of the City project organized in Berlin in April 2013.
                <br/>
                <br/>
                Besides, his Unframed project also comes to Baden-Baden. As a large-scale project in the city’s urban space. Unframed Baden Baden addresses German-French history and the friendship between the two countries.              
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <a href="<?php echo get_page_link( get_page_by_title( 'exhibitions' )->ID ); ?>" class="section-projects--link section--link">
      See all exhibitions
    </a>
  </section>
</main>
<?php get_footer(); ?>
