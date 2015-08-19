<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the "site-content" div and all content after.
 *
 * @package WordPress
 * @subpackage Dutch Dota WB
 * @since Dutch Dota WP 1.0
 */
?>

<!-- Start Pre Footer -->
<div class="pre-footer col-xs-12">
    <!-- Start Bottom Blocks -->
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">

            <!-- Start Twitch List -->
            <div class="default-box">
                <div class="header">
                    <h2><i class="fa fa-twitch fa-fw"></i> Leden op Twitch</h2>
                </div>
                <!-- Start Inner -->
                <div class="body">

                    <!-- Start Player List -->
                    <div class="twitch-list">
                        <a href="http://www.twitch.tv/dutchdota" target="_blank" class="animated firstload">
                            <i class="fa fa-play-circle"></i>
                            <img class="stream-image"
                                 src="<?php echo get_template_directory_uri() . '/assets/img/dd-no-twitch.jpg'; ?>">
                            <img class="profile-image"
                                 src="<?php echo get_template_directory_uri() . '/assets/img/dd-profile.jpg'; ?>">
                            <h5 class="profile-name"><?php _e('No streams...', 'dutchdotawp'); ?></h5>

                            <p class="stream-text"><?php _e('Zero live streams', 'dutchdotawp'); ?></p>
                        </a>
                    </div>

                </div>
            </div>
            <!-- End Twitch List -->

        </div>
        <div class="hidden-xs col-sm-6 col-md-4 col-lg-3">

            <!-- Start Forum Activity -->
            <div class="default-box">
                <div class="header">
                    <h2><i class="fa fa fa-comments fa-fw"></i> Forum Activiteit</h2>
                </div>
                <!-- Start Inner -->
                <div class="body">

                    <!-- Start List -->
                    <ul class="forum-activiteit">
                        <?php
                        print_bbpress_activity_data();
                        ?>
                    </ul>

                </div>
            </div>
            <!-- End Forum Activity -->

        </div>
        <div class="hidden-xs hidden-sm col-md-4 col-lg-3">

            <!-- Start Twitter -->
            <div class="default-box">
                <div class="header">
                    <h2><i class="fa fa-twitter fa-fw"></i> Twitter Feed</h2>
                    <a href="<?php echo get_twitter_profile_link(); ?>" target="_blank" class="more-link"><i
                            class="fa fa-external-link"></i></a>
                </div>
                <!-- Start Inner -->
                <div class="body">

                    <!-- Start Tweet List -->
                    <div class="tweet-list">
                        <?php print_twitter_data(); ?>
                    </div>

                </div>
            </div>
            <!-- End Twitter -->

        </div>
        <div class="hidden-xs hidden-sm hidden-md col-lg-3">

            <!-- Start Facebook -->
            <div class="fb-page" data-href="https://www.facebook.com/dutchdota" data-small-header="false"
                 data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"
                 data-show-posts="false">
                <div class="fb-xfbml-parse-ignore">
                    <blockquote cite="https://www.facebook.com/dutchdota"><a href="https://www.facebook.com/dutchdota">Dutch
                            Dota</a></blockquote>
                </div>
            </div>
            <!-- End Facebook -->

        </div>

    </div>
    <!-- End Bottom Blocks -->
</div>
<!-- End Pre Footer -->

<!-- Start Main Footer -->
<footer class="main-footer col-xs-12">
    <div class="col-xs-12 col-sm-5 col-md-4 col-lg-3 copyright"><span>&copy; Dutch Dota Community</span></div>
    <div class="col-xs-12 col-sm-7 col-md-8 col-lg-9 social-container">
        <a class="social-link" target="_blank" href="http://www.youtube.com/dutchdota" data-toggle="tooltip"
           data-placement="top"
           title="Youtube"><i class="fa fa-youtube-play fa-fw"></i></a>
        <a class="social-link" target="_blank" href="http://www.twitter.com/dutchdota" data-toggle="tooltip"
           data-placement="top"
           title="Twitter"><i class="fa fa-twitter fa-fw"></i></a>
        <a class="social-link" target="_blank" href="http://www.facebook.com/dutchdota" data-toggle="tooltip"
           data-placement="top"
           title="Facebook"><i class="fa fa-facebook fa-fw"></i></a>
        <a class="social-link" target="_blank" href="http://www.twitch.com/dutchdota" data-toggle="tooltip"
           data-placement="top"
           title="Twitch"><i class="fa fa-twitch fa-fw"></i></a>
        <a class="social-link" target="_blank" href="http://steamcommunity.com/groups/dutchdotaoffical"
           data-toggle="tooltip" data-placement="top"
           title="Steam"><i class="fa fa-steam fa-fw"></i></a>
    </div>
</footer>
<!-- End Main Footer -->

</div>
<!-- /container -->


<!-- Dutch Dota core JavaScript
================================================== -->

<!-- Placed at the end of the document so the pages load faster -->
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

<!-- Core Javascript -->
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/main.js"></script>

<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/ie10-viewport-bug-workaround.js"></script>

<!-- Facebook JS -->
<div id="fb-root"></div>
<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/nl_NL/sdk.js#xfbml=1&version=v2.4&appId=438723776334468";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

<?php wp_footer(); ?>

</body>
</html>
