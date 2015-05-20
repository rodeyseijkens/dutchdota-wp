<?php
/*
Template Name: Contact Page
*/
?>

<?php
if(isset($_POST['submitted'])) {
    if(trim($_POST['contactName']) === '') {
        $nameError = __('Please enter your name.', 'dutchdotawp');
        $hasError = true;
    } else {
        $name = trim($_POST['contactName']);
    }

    if(trim($_POST['email']) === '')  {
        $emailError = __('Please enter your email address.', 'dutchdotawp');
        $hasError = true;
    } else if (!preg_match("/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i", trim($_POST['email']))) {
        $emailError = __('You entered an invalid email address.', 'dutchdotawp');
        $hasError = true;
    } else {
        $email = trim($_POST['email']);
    }

    if(trim($_POST['comments']) === '') {
        $commentError = __('Please enter a message.', 'dutchdotawp');
        $hasError = true;
    } else {
        if(function_exists('stripslashes')) {
            $comments = stripslashes(trim($_POST['comments']));
        } else {
            $comments = trim($_POST['comments']);
        }
    }

    if(!isset($hasError)) {
        $emailTo = 'info@dutchdota.com';
        if (!isset($emailTo) || ($emailTo == '') ){
            $emailTo = get_option('admin_email');
        }
        $subject = '[Contactformulier] '.$name;
        $body = $comments;
        $headers = 'From: '.$name.' <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;

        wp_mail($emailTo, $subject, $body, $headers);
        $emailSent = true;
    }

} ?>

<?php
get_header();
?>

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
            <?php if (function_exists('yoast_breadcrumb')) {
                yoast_breadcrumb('<div id="breadcrumbs">', '</div>');
            } ?>
        </div>
    </div>
</div>
<!-- End Main Breadcrumbs -->

<!-- Main Content -->
<div class="main-content col-xs-12">

    <!-- Start Primary -->
    <div class="col-xs-12 col-sm-7 col-md-8 col-lg-9">

        <div class="default-box">
            <div class="header">
                <h2><?php _e("Work With Us", 'dutchdotawp'); ?></h2>
            </div>
            <div class="body">
                <?php the_content(); ?>
            </div>
        </div>

        <div class="contactform">
            <div class="header">
                <h2><i class="fa fa-envelope fa-fw"></i><?php _e("Contact", 'dutchdotawp'); ?></h2>
            </div>
            <div class="body">

            <?php if(isset($emailSent) && $emailSent == true) { ?>
                <div class="col-xs-12">
                    <div class="alert alert-success" role="success">
                        <span class="fa fa-check" aria-hidden="true"></span>
                        <span class="sr-only">Success:</span>
                        <?php _e("Thanks, your email was sent successfully.", 'dutchdotawp'); ?>
                    </div>
                </div>
                <div class="clearfix"></div>
            <?php } else { ?>
            <?php if(isset($hasError) || isset($captchaError)) { ?>
                <div class="col-xs-12">
                <div class="alert alert-danger" role="alert">
                    <span class="fa fa-exclamation-triangle" aria-hidden="true"></span>
                    <span class="sr-only">Error:</span>
                    <?php _e("Sorry, an error occured.", 'dutchdotawp'); ?>
                </div>
                </div>
            <?php } ?>
                <form class="form-horizontal" role="form" method="post" action="<?php the_permalink(); ?>">
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label"><?php _e("Name", 'dutchdotawp'); ?></label>

                        <div class="col-sm-10">
                            <input type="text" name="contactName" id="contactName" value="<?php if(isset($_POST['contactName'])) echo $_POST['contactName'];?>" placeholder="<?php _e("First & Last Name", 'dutchdotawp'); ?>" class="required requiredField form-control" />
                            <?php if($nameError != '') { ?>
                                <p class="text-danger"><?=$nameError;?></p>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-sm-2 control-label"><?php _e("Email", 'dutchdotawp'); ?></label>

                        <div class="col-sm-10">
                            <input type="text" name="email" id="email" value="<?php if(isset($_POST['email'])) echo $_POST['email'];?>" placeholder="<?php _e("email@example.com", 'dutchdotawp'); ?>" class="required requiredField email form-control" />
                            <?php if($emailError != '') { ?>
                                <p class="text-danger"><?=$emailError;?></p>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="message"
                               class="col-sm-2 control-label"><?php _e("Message", 'dutchdotawp'); ?></label>

                        <div class="col-sm-10">
                            <textarea name="comments" id="commentsText" rows="4" class="required requiredField form-control" placeholder="<?php _e("Your Message", 'dutchdotawp'); ?>"><?php if(isset($_POST['comments'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['comments']); } else { echo $_POST['comments']; } } ?></textarea>
                            <?php if($commentError != '') { ?>
                                <p class="text-danger"><?=$commentError;?></p>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-10 col-sm-offset-2 text-right">
                            <input id="submit" name="submit" type="submit"
                                   value="<?php _e("Send Email", 'dutchdotawp'); ?>" class="btn btn-special">
                        </div>
                    </div>
                    <input type="hidden" name="submitted" id="submitted" value="true" />
                </form>
                <div class="clearfix"></div>
            <?php } ?>
            </div>
        </div>

    </div>
    <!-- End Primary -->

    <!-- Start Seconday -->
    <div class="col-xs-12 col-sm-5 col-md-4 col-lg-3">

        <?php if (is_active_sidebar('right-sidebar-contact')) : ?>
            <?php dynamic_sidebar('right-sidebar-contact'); ?>
        <?php endif; ?>

    </div>
    <!-- End Seconday -->


</div>
<!-- End Main Content -->

<?php get_footer(); ?>
