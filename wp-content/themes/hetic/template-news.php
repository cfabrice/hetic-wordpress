<?php /* Template Name: Template News */ ?>

<?php get_header(); ?>
    <main class="main news">
        <header class="news-header">
            <ul>
                <li><button class="active">All</button></li>
                <li><button>Projects</button></li>
                <li><button>Exhibitions</button></li>
                <li><button>Litographs</button></li>
            </ul>
        </header>
        <div class="news-container">
            <a href="#" title="article name" class="news-container-item item">
                <div class="item-img" style="background-image: url('./assets/img/article-full.jpg');"></div>
                <div class="item-content">
                    <div class="item-content-category">
                        #projects
                    </div>
                    <div class="item-content-date">
                        on 24 September, 2017
                    </div>
                    <h4 class="item-content-title">
                        faces places, the film
                    </h4>
                    <p class="item-content-text">
                        JR inaugurated last week a huge scaffolding installation on the Mexican side of the border between the United States and Mexico…
                    </p>
                </div>
            </a>
            <a href="#" title="article name" class="news-container-item item">
                <div class="item-img" style="background-image: url('./assets/img/article-full.jpg');"></div>
                <div class="item-content">
                    <div class="item-content-category">
                        #projects
                    </div>
                    <div class="item-content-date">
                        on 24 September, 2017
                    </div>
                    <h4 class="item-content-title">
                        faces places, the film
                    </h4>
                    <p class="item-content-text">
                        JR inaugurated last week a huge scaffolding installation on the Mexican side of the border between the United States and Mexico…
                    </p>
                </div>
            </a>
            <a href="#" title="article name" class="news-container-item item">
                <div class="item-img" style="background-image: url('./assets/img/article-full.jpg');"></div>
                <div class="item-content">
                    <div class="item-content-category">
                        #projects
                    </div>
                    <div class="item-content-date">
                        on 24 September, 2017
                    </div>
                    <h4 class="item-content-title">
                        faces places, the film
                    </h4>
                    <p class="item-content-text">
                        JR inaugurated last week a huge scaffolding installation on the Mexican side of the border between the United States and Mexico…
                    </p>
                </div>
            </a>
            <a href="#" title="article name" class="news-container-item item">
                <div class="item-img" style="background-image: url('./assets/img/article-full.jpg');"></div>
                <div class="item-content">
                    <div class="item-content-category">
                        #projects
                    </div>
                    <div class="item-content-date">
                        on 24 September, 2017
                    </div>
                    <h4 class="item-content-title">
                        faces places, the film
                    </h4>
                    <p class="item-content-text">
                        JR inaugurated last week a huge scaffolding installation on the Mexican side of the border between the United States and Mexico…
                    </p>
                </div>
            </a>
            <div class="row">
                <button class="news-more">Load more</button>
            </div>
        </div>
    </main>
   <!-- <main class="main">
        <h1>Nos news</h1>
		<?php
/*		$lastposts = get_posts( array(
			'posts_per_page' => 6,
			'post_type'      => 'news',
			'orderby'        => 'date',
			'order'          => 'DESC'
		) );

		if ( $lastposts ) { */?>
            <section class="section section-projects">
                <div class="section-projects-wrapper">
					<?php
/*					foreach ( $lastposts as $post ) :
						setup_postdata( $post ); */?>
                        <a class="section-news-wrapper-item" href="<?php /*the_permalink() */?>">
							<?php /*$image = get_field( 'image_main' ); */?>
                            <div class="section-news-wrapper-item--img"
                                 style="background-image:url('<?php /*echo $image['url']; */?>')"></div>
                            <div class="section-news-wrapper-item--date">
								<?php /*the_date() */?>
                            </div>
                            <div class="section-news-wrapper-item--title">
								<?php /*the_title(); */?>
                            </div>
                            <div class="section-news-wrapper-item--text">
								<?php
/*								$givchars = 100;
								$postgiv  = get_field( 'content' );
								$modgiv   = substr( $postgiv, 0, $givchars );
								echo ' ' . $modgiv . '...';
								*/?>
                            </div>
                        </a>
						<?php
/*					endforeach;
					wp_reset_postdata();
					*/?>
                </div>
            </section>
		<?php /*} */?>
    </main>-->
<?php get_footer(); ?>