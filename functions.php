<?php
// =========================================================================
// REMOVE JUNK FROM HEAD
// =========================================================================
remove_action('wp_head', 'rsd_link'); // remove really simple discovery link
remove_action('wp_head', 'wp_generator'); // remove wordpress version

remove_action('wp_head', 'feed_links', 2); // remove rss feed links (make sure you add them in yourself if youre using feedblitz or an rss service)
remove_action('wp_head', 'feed_links_extra', 3); // removes all extra rss feed links

remove_action('wp_head', 'index_rel_link'); // remove link to index page
remove_action('wp_head', 'wlwmanifest_link'); // remove wlwmanifest.xml (needed to support windows live writer)

remove_action('wp_head', 'start_post_rel_link', 10, 0); // remove random post link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // remove parent post link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // remove the next and previous post links
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );

remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0 );

// =========================================================================
// REGISTER THEME LOCATION MENU
// =========================================================================
add_action( 'init', 'register_my_menus' );
function register_my_menus() {
	register_nav_menus(
		array(
			'header-menu' => __( 'Header Menu' , 'dutchdotawp'),
		)
	);
}

// =========================================================================
// THEME CONTENT FIXES
// =========================================================================
function wrap_embed_with_div($html, $url, $attr) {

	return '<div class="embed-container">' . $html . '</div>';

}
add_filter('embed_oembed_html', 'wrap_embed_with_div', 10, 3); // ADD DIV AROUND EMBEDED STUFF

function filter_ptags_on_images($content){
	return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}
add_filter('the_content', 'filter_ptags_on_images'); // REMOVE P AROUND IMAGES

function Oembed_youtube_no_title($html,$url,$args){
	$url_string = parse_url($url, PHP_URL_QUERY);
	parse_str($url_string, $id);
	if (isset($id['v'])) {
		return '<iframe width="500" height="281" src="http://www.youtube.com/embed/'.$id['v'].'?rel=0&?wmode=transparent&iv_load_policy=3&showinfo=0&vq=hd1080" frameborder="0" allowfullscreen></iframe>';
	}
	return $html;
}
add_filter('oembed_result','Oembed_youtube_no_title',10,3);

// =========================================================================
// REGISTER THEME POST THUMBNAILS
// =========================================================================
add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 850, 350, array( 'center', 'center')  ); // 50 pixels wide by 50 pixels tall, crop from the center

function dd_paging_nav() {
	global $wp_query;

	// Don't print empty markup if there's only one page.
	if ( $wp_query->max_num_pages < 2 )
		return;
	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'dutchdotawp' ); ?></h1>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
				<div class="nav-previous"><?php next_posts_link( '<span class="meta-nav">&larr;</span> '.__( 'Older posts', 'dutchdotawp' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
				<div class="nav-next"><?php previous_posts_link( __( 'Newer posts', 'dutchdotawp' ).' <span class="meta-nav">&rarr;</span>' ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}

// =========================================================================
// TWITTER DATA
// =========================================================================
function get_twitter_profile_link() {
	$account_name = 'dutchdota';

	return 'http://twitter.com/' . $account_name;
}
function print_twitter_data() {
	$query_arg['count']				= 3;
	$query_arg['exclude_replies']	= true;
	$query_arg['include_rts']		= false;
	$query_arg['screen_name']		= 'dutchdota';

	require_once( get_template_directory() . '/functions/twitter/codebird.php' );

	$instance['api'] = "RdZVPKeBrGJBUvWucapdHfBCy";
	$instance['apisecret'] = "xhFx5mFPl6CDBocI1lMop7n1XHhVXmXFbreWy11pjrRYwdaQ5S";
	$instance['token'] = "2860353382-bG3N5dXOzU4ICb9LRUdAyc7oq54aSiuna3eFXKY";
	$instance['tokensecret'] = "0D0QJEZmmOrhA1cbyJWvqqnFYG3xpuUcQwcQIfEeuze2i";

	Codebird::setConsumerKey( $instance["api"], $instance["apisecret"] );

	$codebird_instance = Codebird::getInstance();


	$codebird_instance->setToken( $instance["token"], $instance["tokensecret"] );

	$codebird_instance->setReturnFormat( CODEBIRD_RETURNFORMAT_ARRAY );

	try {
		$latest_tweet = $codebird_instance->statuses_userTimeline( $query_arg );
	}
	catch( Exception $e ) {
		echo  'Error retrieving tweets';
	}

	if (isset($latest_tweet['errors'][0])) {
		//error handling here plz
		echo "Error code ".$latest_tweet['errors'][0]['code'].": ".$latest_tweet['errors'][0]['message'];
	} else {
		foreach( $latest_tweet as $single_tweet ) {
			$tweet_text = $single_tweet['text'];
			$tweet_text      = preg_replace( "/[^^](http:\/\/+[\S]*)/", '<a href="$0">$0</a>', $tweet_text );

			$screen_name     = $single_tweet['user']['screen_name'];
			$user_permalink  = 'http://twitter.com/' . $screen_name;
			$tweet_permalink = 'http://twitter.com/' . $screen_name . '/status/' . $single_tweet['id_str'];

			if( $tweet_text ) {
				echo '<div class="latest-twitter-tweet"><i class="fa fa-twitter"></i> &quot;' . $tweet_text . '&quot;</div>';
			}
		}
	}
}

// =========================================================================
// BBPRESS ACTIVITY
// =========================================================================
function print_bbpress_activity_data() {
	$topics_query = array(
		'post_type'           => bbp_get_topic_post_type(),
		'post_parent'         => 'any',
		'posts_per_page'      => 5,
		'post_status'         => array( bbp_get_public_status_id(), bbp_get_closed_status_id() ),
		'ignore_sticky_posts' => true,
		'no_found_rows'       => true,
		'order'               => 'DESC'
	);

	$widget_query = new WP_Query( $topics_query );

	// Bail if no topics are found
	if ( ! $widget_query->have_posts() ) {
		return;
	}

	while ( $widget_query->have_posts() ) {
		$widget_query->the_post();
		$topic_id = bbp_get_topic_id($widget_query->post->ID);

		?>
		<li><a class="bbp-forum-title" href="<?php bbp_topic_permalink($topic_id) ?>"><i class="fa fa fa-comments fa-fw"></i><?php bbp_topic_title($topic_id) ?></a></li>
		<?php
	}
}

add_action( 'widgets_init', 'dutchdotawp_widgets_init' );
function dutchdotawp_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Sidebar Main', 'dutchdotawp' ),
		'id' => 'right-sidebar',
		'description' => __( 'Widgets in this area will be shown on the main page.', 'dutchdotawp' ),
		'before_widget' => '<div id="%1$s" class="widget col-xs-12 %2$s">',
		'after_widget'  => '</div></div></div>',
		'before_title'  => '<div class="header row"><h2>',
		'after_title'   => '</div><div class="body row"><div class=" col-xs-12">',
	) );
	register_sidebar( array(
		'name' => __( 'Sidebar News', 'dutchdotawp' ),
		'id' => 'right-sidebar-news',
		'description' => __( 'Widgets in this area will be shown on news pages.', 'dutchdotawp' ),
		'before_widget' => '<div id="%1$s" class="widget col-xs-12 %2$s">',
		'after_widget'  => '</div></div></div>',
		'before_title'  => '<div class="header row"><h2>',
		'after_title'   => '</div><div class="body row"><div class=" col-xs-12">',
	) );
	register_sidebar( array(
		'name' => __( 'Sidebar Page', 'dutchdotawp' ),
		'id' => 'right-sidebar-page',
		'description' => __( 'Widgets in this area will be shown on pages.', 'dutchdotawp' ),
		'before_widget' => '<div id="%1$s" class="widget col-xs-12 %2$s">',
		'after_widget'  => '</div></div></div>',
		'before_title'  => '<div class="header row"><h2>',
		'after_title'   => '</div><div class="body row"><div class=" col-xs-12">',
	) );
	register_sidebar( array(
		'name' => __( 'Sidebar Single', 'dutchdotawp' ),
		'id' => 'right-sidebar-single',
		'description' => __( 'Widgets in this area will be shown on single pages.', 'dutchdotawp' ),
		'before_widget' => '<div id="%1$s" class="widget col-xs-12 %2$s">',
		'after_widget'  => '</div></div></div>',
		'before_title'  => '<div class="header row"><h2>',
		'after_title'   => '</div><div class="body row"><div class=" col-xs-12">',
	) );
	register_sidebar( array(
		'name' => __( 'Sidebar Contact', 'dutchdotawp' ),
		'id' => 'right-sidebar-contact',
		'description' => __( 'Widgets in this area will be shown on contact pages.', 'dutchdotawp' ),
		'before_widget' => '<div id="%1$s" class="widget col-xs-12 %2$s">',
		'after_widget'  => '</div></div></div>',
		'before_title'  => '<div class="header row"><h2>',
		'after_title'   => '</div><div class="body row"><div class=" col-xs-12">',
	) );
	register_sidebar( array(
		'name' => __( 'Sidebar Sportspress', 'dutchdotawp' ),
		'id' => 'right-sidebar-sportspress',
		'description' => __( 'Widgets in this area will be shown on sportspress pages.', 'dutchdotawp' ),
		'before_widget' => '<div id="%1$s" class="widget col-xs-12 %2$s">',
		'after_widget'  => '</div></div></div>',
		'before_title'  => '<div class="header row"><h2>',
		'after_title'   => '</div><div class="body row"><div class=" col-xs-12">',
	) );
}


// =========================================================================
// COMMENTS FUNCTION
// =========================================================================
function dutchdotawp_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);

	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
	?>
	<<?php echo $tag ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) : ?>
		<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
	<?php endif; ?>

    <div class="media">

        <div class="media-left">
            <?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
        </div>

        <div class="media-body">

            <?php printf( __( '<h6>%s</h6>' ), get_comment_author_link() ); ?>


            <?php if ( $comment->comment_approved == '0' ) : ?>
                <em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'dutchdotawp' ); ?></em>
                <br />
            <?php endif; ?>


            <div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>">
                    <?php
                    /* translators: 1: date, 2: time */
                    printf( __('%1$s @ %2$s', 'dutchdotawp'), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)', 'dutchdotawp' ), '  ', '' );
                ?>
            </div>

            <?php comment_text(); ?>



            <div class="reply">
                <?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
            </div>
        </div>

    </div>

	<?php if ( 'div' != $args['style'] ) : ?>
		</div>
	<?php endif; ?>
	<?php
}

// =========================================================================
// REMOVE STYLESHEETS OF BBPRESS
// =========================================================================
function isa_dequeue_bbp_style() {
	if ( class_exists('bbPress') ) {
		if ( ! is_bbpress() ) {
		}
		wp_dequeue_style('bbp-default');
		wp_dequeue_style( 'bbp_private_replies_style');
		wp_dequeue_script('bbpress-editor');
	}
}
add_action( 'wp_enqueue_scripts', 'isa_dequeue_bbp_style', 99 );

// =========================================================================
// ADD TWITCH CONTACT FIELD
// =========================================================================
function modify_contact_methods($profile_fields) {

	// Add new fields
	$profile_fields['twitch'] = __('www.twitch.tv/', 'dutchdotawp');

	return $profile_fields;
}
add_filter('user_contactmethods', 'modify_contact_methods');

// =========================================================================
// TRANSLATION TEXT
// =========================================================================
load_theme_textdomain( 'dutchdotawp', get_template_directory() . '/languages' );
