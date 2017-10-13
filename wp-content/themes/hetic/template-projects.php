<?php /* Template Name: Template Projects */ ?>

<?php get_header(); ?>
<main class="main">
	<?php
	$lastposts = get_posts( array(
	'posts_per_page' => 12,
	'post_type' => 'last_projects',
	'orderby' => 'date',
	'order' => 'DESC'
	) );

	if ( $lastposts ) { ?>
	<section class="section section-projects">
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
	</section>
	<?php } ?>
</main>
<?php get_footer(); ?>