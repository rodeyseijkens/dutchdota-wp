<?php
/*
Template Name: Blog Page
*/

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
	<div class="row">

		<!-- Start Primary -->
		<div class="col-xs-12 col-sm-7 col-md-8 col-lg-9">

			<div class="row">
				<div class="col-xs-12 blog-content">

					<?php if( have_posts() ): ?>

						<?php while( have_posts() ): the_post(); ?>

							<div id="post-<?php echo get_the_ID(); ?>" <?php post_class(); ?>>

								<a class="post-thumbnail" href="<?php the_permalink(); ?>"><?php the_post_thumbnail(array(850, 350)); ?></a>

								<?php the_date('j F', '<span class="date">', '</span>'); ?>

								<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

								<div class="hidden-xs hidden-sm">
									<?php the_excerpt(); ?>
								</div>

								<div class="meta">
									<i class="fa fa-user"></i> <a data-original-title="<?php _e("View all posts by", 'dutchdotawp'); ?> <?php echo get_the_author(); ?>" data-toggle="tooltip" href="#"><?php echo get_the_author(); ?></a> &nbsp;
									<i class="fa fa-comment"></i> <a data-original-title="<?php comments_number(__('No comments in this post', 'dutchdotawp'), __('One comment in this post', 'dutchdotawp'), __('% comments in this post', 'dutchdotawp')); ?>" href="<?php echo the_permalink(); ?>#comments" data-toggle="tooltip"><?php comments_number(__('No comments', 'dutchdotawp'), __('One comment', 'dutchdotawp'), __('% comments', 'dutchdotawp')); ?></a> &nbsp;
									<i class="fa category-icon"></i> <?php the_category(', '); ?>  &nbsp;
									<?php the_tags('<span class="fa fa-tags"></span> ', ', ', ''); ?>
								</div>

							</div><!-- /#post-<?php echo get_the_ID(); ?> -->

						<?php endwhile; ?>

						<div class="navigation">
							<span class="newer"><?php previous_posts_link('<i class="fa fa-angle-double-left"></i> '.__('Newer','dutchdotawp')) ?></span> <span class="older"><?php next_posts_link(__('Older','dutchdotawp').' <i class="fa fa-angle-double-right"></i>') ?></span>
						</div><!-- /.navigation -->

					<?php else: ?>

						<div id="post-404" class="noposts">

							<p><?php _e('None found.','dutchdotawp'); ?></p>

						</div><!-- /#post-404 -->

					<?php endif; wp_reset_query(); ?>

				</div><!-- /#content -->
			</div>

		</div>
		<!-- End Primary -->



		<!-- Start Seconday -->
		<div class="col-xs-12 col-sm-5 col-md-4 col-lg-3">

			<?php if (is_active_sidebar('right-sidebar-news')) : ?>
				<?php dynamic_sidebar('right-sidebar-news'); ?>
			<?php endif; ?>

		</div>
		<!-- End Seconday -->


	</div>
</div>
<!-- End Main Content -->

<?php get_footer(); ?>
