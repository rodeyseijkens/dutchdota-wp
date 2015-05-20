<?php

get_header(); ?>

<!-- Main Title -->
<div class="main-title col-xs-12">
	<div class="row">
		<div class="col-xs-12">
			<h1 class="page-title">
				<?php echo wp_title('', false, 'left'); ?>
			</h1>
		</div>
	</div>
</div>
<!-- End Main Title -->

<!-- Main Breadcrumbs -->
<div class="main-breadcrumbs col-xs-12">
	<div class="row">
		<div class="col-xs-12">
			<?php if ( function_exists('yoast_breadcrumb') ) {
				yoast_breadcrumb('<div id="breadcrumbs">','</div>');
			} ?>
		</div>
	</div>
</div>
<!-- End Main Breadcrumbs -->

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

		<?php if (is_active_sidebar('right-sidebar-page')) : ?>
			<?php dynamic_sidebar('right-sidebar-page'); ?>
		<?php endif; ?>

	</div>
	<!-- End Seconday -->


</div>
<!-- End Main Content -->

<?php get_footer(); ?>
