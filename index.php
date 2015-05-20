<?php

get_header(); ?>

<!-- Main Content -->
<div class="main-content col-xs-12">

	<!-- Start Primary -->
	<div class="col-xs-12 col-sm-7 col-md-8 col-lg-9">

		<?php while (have_posts()) : the_post(); ?>
			<?php the_content(); ?>
		<?php endwhile; // end of the loop. ?>

	</div>
	<!-- End Primary -->

	<!-- Start Seconday -->
	<div class="col-xs-12 col-sm-5 col-md-4 col-lg-3">

		<?php if (is_active_sidebar('right-sidebar')) : ?>
			<?php dynamic_sidebar('right-sidebar'); ?>
		<?php endif; ?>

	</div>
	<!-- End Seconday -->

</div>
<!-- End Main Content -->

<?php get_footer(); ?>