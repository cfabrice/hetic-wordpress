<?php /* Template Name: Template Contact */ ?>

<?php get_header(); ?>
    <main class="contact">
        <div class="full-image"
             style="background-image: url('<?php echo get_field('image')['url']; ?>');background-repeat: no-repeat;
                     background-size: cover; background-position: center;"></div>
        <div class="section--title">
            <?php the_field('title') ?>
        </div>
        <?php echo do_shortcode('[contact-form-7 id="8" title="Form contact" html_class="contact-form"]'); ?>
    </main>
<?php get_footer(); ?>