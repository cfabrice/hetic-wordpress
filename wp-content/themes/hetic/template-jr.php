<?php /* Template Name: Template JR */ ?>

<?php get_header(); ?>
    <main class="main about">
        <div class="full-image">
            <img src="<?php echo get_field('cover_photo')['url']; ?>" alt="JR exhibition">
        </div>
        <div class="about-content">
            <h3 class="about-content-title section--title"><?php the_field('title') ?></h3>
            <p><?php the_field('content') ?></p>
            <h3 class="about-content-title section--title"><?php the_field('title_2') ?></h3>
            <div class="slider row-slider">
                <?php if (have_rows('gallerie')) { ?>
                    <div class="slider-container">
                        <?php while (have_rows('gallerie')) :
                            the_row();
                            $img = get_sub_field('image') ?>
                            <div class="slider-item">
                                <div class="slider-img" style="background-image: url('<?php echo $img['url'] ?>')"></div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php } ?>
                <div class="slider-nav">
                    <div class="slider-index">
                        <span class="slider-index-current">01</span>
                        /
                        <span class="slider-index-total">01</span>
                    </div>
                    <div class="slider-timer">
                        <div class="slider-timer-fill"></div>
                    </div>
                    <div class="slider-controls">
                        <button class="slider-prev">
                            <svg fill="#000000" height="24" viewBox="0 0 24 24" width="24"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M15.41 7.41L14 6l-6 6 6 6 1.41-1.41L10.83 12z" class="icon"/>
                                <path d="M0 0h24v24H0z" fill="none"/>
                            </svg>
                        </button>
                        <button class="slider-next">
                            <svg fill="#000000" height="24" viewBox="0 0 24 24" width="24"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z" class="icon"/>
                                <path d="M0 0h24v24H0z" fill="none"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php get_footer(); ?>