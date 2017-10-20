<?php /* Template Name: Template JR */ ?>

<?php get_header(); ?>

<main class="main">
    <?php $image = get_field( 'cover_photo' ); ?>
    <img src="<?php echo $image['url']; ?>" alt="">
    <?php the_field('title') ?>
    <?php the_field('content') ?>
    <?php the_field('title_2') ?>
    <?php
    if (have_rows( 'gallerie' )) :
        while (have_rows( 'gallerie' )) :
            the_row();
                $img = get_sub_field( 'image' );
                echo $img['url'];
        endwhile;
    endif;

    ?>
</main>
<?php get_footer(); ?>