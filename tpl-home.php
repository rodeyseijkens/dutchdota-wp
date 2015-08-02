<?php
/*
Template Name: Home Page
*/

get_header(); ?>

<!-- Main Content -->
<div class="main-content col-xs-12">
    <div class="row">

        <!-- Start Primary -->
        <div class="col-xs-12 col-sm-7 col-md-8 col-lg-9">

            <!-- Start Carousel -->
            <div class="row">
            <div class="hidden-xs col-xs-12">
                <div id="carousel" class="carousel slide" data-ride="carousel">

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" role="listbox">
                        <?php
                        $count = 0;
                        $numberposts = 8;

                        $args = array(
                            'numberposts' => $numberposts,
                            'offset' => 0,
                            'category' => 0,
                            'orderby' => 'post_date',
                            'order' => 'DESC',
                            'post_type' => 'post',
                            'post_status' => 'publish',
                            'suppress_filters' => true );


                        $recent = wp_get_recent_posts($args);
                        while ($count < $numberposts) {
                            ?>
                            <!-- Start Image Blocks -->
                            <?php
                            $ID = $recent[$count]["ID"];
                            ?>
                            <a href="<?php echo get_permalink($ID); ?>" class="item <?php if ($count == 0) {
                                echo 'active';
                            } ?>">
                                <?php
                                echo get_the_post_thumbnail($ID, array(850, 350));

                                $videoEmbed = get_post_meta($ID, 'main-video', true); // Get the main-video from post field
                                ?>
                                <div class="carousel-caption">
                                    <h3><?php if($videoEmbed != ''){ echo '<i class="fa fa-play-circle"></i>'; } echo $recent[$count]["post_title"]; ?></h3>
                                </div>
                            </a>
                            <!-- End Image Blocks -->
                            <?php
                            $count++;
                        }
                        ?>
                    </div>

                    <!-- Controls -->
                    <a class="left carousel-control" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
            </div>
            <!-- End Carousel -->

            <!-- Start SVDW -->
            <div class="row">
            <div class="col-xs-12">
                <div class="svdw-container">

                    <div class="header">
                        <h2><i class="fa fa-trophy fa-fw"></i> Spelers van de week</h2>
                        <a class="more-link" data-toggle="tooltip" data-placement="top"
                           title="Ingelogd in de laaste 30 dagen">
                            <i class="fa fa-info-circle fa-fw"></i>
                        </a>
                    </div>
                    <!-- Start Inner -->
                    <div class="hidden-xs hidden-sm hidden-md col-lg-12 svdw-buttons"></div>
                    <div class="body">
                        <div class="row">

                            <!-- Start Player Stats -->
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 player-stats">

                                <!-- Start Content -->
                                <div class="stats-container">
                                    <div class="stats-info animated firstload">
                                        <img class="profile"
                                             src="" width="45" height="45">
                                        <dl>
                                            <dt class="player-name"><a href=""></a></dt>
                                            <dd class="main-info"><strong></strong> <span
                                                    class="badge"></span></dd>
                                        </dl>
                                        <div class="general-info">

                                            <img class="hero-image"
                                                 src="">
                                            <dl>
                                                <dt class="game-status"></dt>
                                                <dd class="date"><i class="fa fa-calendar"></i> <span></span></dd>
                                            </dl>
                                            <dl>
                                                <dt>K/D/A</dt>
                                                <dd class="game-kda"></dd>
                                            </dl>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Content -->

                            </div>
                            <!-- End Player Stats -->

                            <!-- Start Player Stats -->
                            <div class="hidden-xs hidden-sm col-md-6 col-lg-4 player-stats">

                                <!-- Start Content -->
                                <div class="stats-container">
                                    <div class="stats-info animated firstload">
                                        <img class="profile"
                                             src="" width="45" height="45">
                                        <dl>
                                            <dt class="player-name"><a href=""></a></dt>
                                            <dd class="main-info"><strong></strong> <span
                                                    class="badge"></span></dd>
                                        </dl>
                                        <div class="general-info">

                                            <img class="hero-image"
                                                 src="">
                                            <dl>
                                                <dt class="game-status"></dt>
                                                <dd class="date"><i class="fa fa-calendar"></i> <span></span></dd>
                                            </dl>
                                            <dl>
                                                <dt>K/D/A</dt>
                                                <dd class="game-kda"></dd>
                                            </dl>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Content -->

                            </div>
                            <!-- End Player Stats -->

                            <!-- Start Player Stats -->
                            <div class="hidden-xs hidden-sm hidden-md col-lg-4 player-stats">

                                <!-- Start Content -->
                                <div class="stats-container">
                                    <div class="stats-info animated firstload">
                                        <img class="profile"
                                             src="" width="45" height="45">
                                        <dl>
                                            <dt class="player-name"><a href=""></a></dt>
                                            <dd class="main-info"><strong></strong> <span
                                                    class="badge"></span></dd>
                                        </dl>
                                        <div class="general-info">

                                            <img class="hero-image"
                                                 src="">
                                            <dl>
                                                <dt class="game-status"></dt>
                                                <dd class="date"><i class="fa fa-calendar"></i> <span></span></dd>
                                            </dl>
                                            <dl>
                                                <dt>K/D/A</dt>
                                                <dd class="game-kda"></dd>
                                            </dl>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Content -->

                            </div>
                            <!-- End Player Stats -->

                        </div>
                    </div>
                    <!-- End Inner -->


                </div>
            </div>
            </div>
            <!-- End SVDW -->


            <!-- Start News -->
            <div class="nieuws-container col-xs-12">
                <div class="header row">
                    <h2><i class="fa  fa-newspaper-o fa-fw"></i> Laatste Nieuws</h2>
                    <a href="/nieuws" class="more-link">Meer nieuws</a>
                </div>
                <div class="body row">
                    <?php
                    $count = 0;
                    $numberposts = 3;

                    $args = array(
                        'numberposts' => $numberposts,
                        'offset' => 0,
                        'category' => 0,
                        'orderby' => 'post_date',
                        'order' => 'DESC',
                        'post_type' => 'post',
                        'post_status' => 'publish',
                        'suppress_filters' => true );


                    $recent = wp_get_recent_posts($args);

                    while ($count < $numberposts) {
                    ?>
                    <!-- Start News Blocks -->
                    <?php
                    if ($count == 0) {
                        echo '<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">';
                    } else if ($count == 1) {
                        echo '<div class="hidden-xs hidden-sm col-md-6 col-lg-4">';
                    } else {
                        echo '<div class="hidden-xs hidden-sm hidden-md col-lg-4">';
                    }

                    $ID = $recent[$count]["ID"];
                    ?>
                        <!-- Content -->
                        <div id="post-<?php echo $ID; ?>" <?php post_class("thumbnail", $ID); ?>>
                            <a href="<?php echo get_permalink($ID); ?>">

                                <?php
                                $videoEmbed = get_post_meta($ID, 'main-video', true); // Get the main-video from post field

                                // Check if it isset
                                if($videoEmbed != '') {
                                 echo '<i class="fa fa-youtube-play"></i>';
                                }
                                ?>

                                <?php echo get_the_post_thumbnail($ID, array(850, 350)); ?>
                            </a>

                            <div class="caption">
                                <h3>
                                    <a href="<?php echo get_permalink($ID); ?>"><?php echo $recent[$count]["post_title"]; ?></a>
                                </h3>

                                <p class="post-info">
                                    <?php $cats = get_the_category($ID); ?>
                                    <a href="<?php echo get_category_link($cats[0]->term_id ); ?>">
                                        <i class="fa category-icon"></i>
                                        <?php echo $cats[0]->name; ?>
                                    </a> -
                                    <span><i class="fa fa-calendar fa-fw"></i><?php echo get_the_date('', $ID); ?></span> -
                                    <a href="<?php echo get_comments_link( $ID ); ?>"><i
                                            class="fa fa-comment fa-fw"></i><?php echo $recent[$count]["comment_count"]; ?>
                                    </a>
                                </p>
                            </div>
                        </div>

                    </div>
                <!-- End News Blocks -->
                <?php
                $count++;
                }
                ?>
                </div>
            </div>
            <!-- End News -->

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
</div>
<!-- End Main Content -->

<?php get_footer(); ?>
