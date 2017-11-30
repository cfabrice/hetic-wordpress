<?php /* Template Name: Template Contents */ ?>

<?php get_header(); ?>
    <main class="main container" id="content">
        <h2 class="title"><?php the_field('title') ?></h2>
        <p><?php the_field('content') ?></p>
    </main>
<?php get_footer(); ?>