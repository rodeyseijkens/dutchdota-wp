<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Dutch Dota WB
 * @since Dutch Dota WP 1.0
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<meta name="author" content="Dutch Dota">

	<!-- Icons -->
	<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/assets/img/favicon.png">
    <link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/assets/img/favicon.png">
    <meta name="msapplication-square70x70logo" content="<?php echo get_template_directory_uri(); ?>/assets/img/mstile-70x70.png">
    <meta name="msapplication-square150x150logo" content="<?php echo get_template_directory_uri(); ?>/assets/img/mstile-150x150.png">

	<!-- Dutch Dota core CSS --><!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

	<!-- Custom styles for this template -->
	<link href="<?php echo get_template_directory_uri(); ?>/assets/css/style.css" rel="stylesheet">
	<?php if(is_bbpress()) {
		echo '<link href="'.get_template_directory_uri().'/assets/css/bbpress.css" rel="stylesheet">';
	}?>

	<!-- Appear on Google as Snippet -->
	<link rel="publisher" href="https://plus.google.com/110649499544651664500/">

	<!-- Start WP Head -->
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<!-- Start Account Modal -->
<div class="modal fade account-login-modal" tabindex="-1" role="dialog" aria-labelledby="Account Login"
	 aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
						aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">
					<?php if (is_user_logged_in()) { ?>
						<span class="text">Account</span>
					<?php } else { ?>
						<span class="text">Login</span>
					<?php } ?>
				</h4>
			</div>
			<div class="modal-body">
				<?php
				global $current_user;

				if (is_user_logged_in()) {
					echo get_avatar($current_user->ID, $size = '120');
					?>

					<div class="account-info">
						<?php $current_user = wp_get_current_user(); ?>
						<div class="text"><?php _e('Logged in as:', 'dutchdotawp'); ?></div>
						<div class="account-name"><?php echo $current_user->display_name; ?></div>
						<a href="<?php echo bbp_user_profile_edit_url($current_user->ID); ?>"><?php _e("Edit your profile", 'dutchdotawp'); ?> </a>
					</div>

					<a href="<?php echo wp_logout_url( home_url() ); ?>" class="logout btn btn-special black"><?php _e("Logout", 'dutchdotawp'); ?></a>

					<?php
				} else {
					// NO LOGIN
					wp_login_form();
					do_action('login_form');
				}
				?>
			</div>
		</div>
	</div>
</div>
<!-- End Account Modal -->

<div class="container">

	<!-- Start Main Header -->
	<header class="main-header">
		<div class="row">
			<div class="col-xs-12 col-sm-7 col-md-8 col-lg-9">
				<a href="<?php echo site_url(); ?>" class="header-logo"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/header-logo.png" width="176" height="61" alt="Dutch Dota Logo"></a>
			</div>
			<div class="col-xs-12 col-sm-5 col-md-4 col-lg-3 social-container">
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
		</div>
	</header>
	<!-- End Main Header -->

	<!-- Start Main Navbar -->
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
						aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>
			<div id="navbar" class="navbar-collapse collapse">
				<?php if (has_nav_menu('header-menu')) { ?>

					<?php

					$defaults = array(
						'theme_location'  => 'header-menu',
						'menu'            => '',
						'container'       => false,
						'container_class' => '',
						'container_id'    => '',
						'menu_class'      => 'menu',
						'menu_id'         => '',
						'echo'            => true,
						'fallback_cb'     => 'wp_page_menu',
						'before'          => '',
						'after'           => '',
						'link_before'     => '',
						'link_after'      => '',
						'items_wrap'      => '<ul class="nav navbar-nav">%3$s</ul>',
						'depth'           => 0,
						'walker'          => ''
					);

					wp_nav_menu( $defaults );

					?>

				<?php } else { ?>
					<ul class="nav navbar-nav">
						<li>
							<a href=""><?php _e('No menu assigned!', 'dutchdotawp'); ?></a>
						</li>
					</ul>
				<?php } ?>
				<form id="search-toggle" class="navbar-form navbar-right collapsed" role="search" method="get" action="<?php echo esc_url(site_url('/')); ?>">
					<i class="fa fa-search fa-fw"></i>

					<div class="form-group">
						<input type="text" class="form-control" name="s" autocomplete="off" value="">
						<input type="hidden" name="post_type[]" value="post"/>
						<input type="hidden" name="post_type[]" value="page"/>
					</div>
				</form>
				<ul class="nav navbar-nav navbar-right">
					<li>
						<a href="" data-toggle="modal" data-target=".account-login-modal">
							<i class="fa fa-user fa-fw"></i>
							<?php if (is_user_logged_in()) { ?>
								<span class="text">Account</span>
							<?php } else { ?>
								<span class="text">Login</span>
							<?php } ?>
						</a>
					</li>
				</ul>
			</div>
			<!--/.nav-collapse -->
		</div>
		<!--/.container-fluid -->
	</nav>
	<!-- End Main Navbar -->