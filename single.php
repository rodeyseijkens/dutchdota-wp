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
	<div class="col-xs-12 col-sm-7 col-md-8 col-lg-9 blog-post">
		<?php while (have_posts()) : the_post(); ?>

			<div id="post-<?php echo get_the_ID(); ?>" <?php post_class(); ?>>

				<a class="post-thumbnail" href="<?php the_permalink(); ?>"><?php the_post_thumbnail(array(850, 478)); ?></a>

				<?php the_date('j F', '<span class="date">', '</span>'); ?>

				<h2><?php the_title(); ?></h2>

				<div class="meta">
					<i class="fa fa-user"></i> <a data-original-title="<?php _e("View all posts by", 'dutchdotawp'); ?> <?php echo get_the_author(); ?>" data-toggle="tooltip" href="#"><?php echo get_the_author(); ?></a> &nbsp;
					<i class="fa fa-comment"></i> <a data-original-title="<?php comments_number(__('No comments in this post', 'dutchdotawp'), __('One comment in this post', 'dutchdotawp'), __('% comments in this post', 'dutchdotawp')); ?>" href="<?php echo the_permalink(); ?>#comments" data-toggle="tooltip"><?php comments_number(__('No comments', 'dutchdotawp'), __('One comment', 'dutchdotawp'), __('% comments', 'dutchdotawp')); ?></a> &nbsp;
					<i class="fa category-icon"></i> <?php the_category(', '); ?>  &nbsp;
					<?php the_tags('<span class="fa fa-tags"></span> ', ', ', ''); ?>
				</div>

				<?php the_content(); ?>

			</div><!-- /#post-<?php echo get_the_ID(); ?> -->

			<div class="author-block col-xs-12 ">
				<?php echo get_avatar( get_the_author_meta('ID'), 120 ); ?>
				<div class="author-content">
					<h3><?php _e("About ", 'dutchdotawp'); ?> <?php echo get_the_author(); ?></h3>
					<?php the_author_meta('description'); ?>
				</div>
				<div class="clear"></div>
			</div>

			<?php
				if ( comments_open() || get_comments_number() ) {
					comments_template();
				}
			?>
		<?php endwhile; // end of the loop. ?>
	</div>
	<!-- End Primary -->

	<!-- Start Seconday -->
	<div class="col-xs-12 col-sm-5 col-md-4 col-lg-3">

		<?php if (is_active_sidebar('right-sidebar-single')) : ?>
			<?php dynamic_sidebar('right-sidebar-single'); ?>
		<?php endif; ?>

	</div>
	<!-- End Seconday -->


</div>
<!-- End Main Content -->

<?php get_footer(); ?>
