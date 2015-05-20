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
    <div class="row">
    <div class="col-xs-12">

        <?php while (have_posts()) : the_post(); ?>
            <?php the_content(); ?>
        <?php endwhile; // end of the loop. ?>
    </div>
    </div>
    <!-- End Primary -->


</div>
<!-- End Main Content -->

<?php get_footer(); ?>
