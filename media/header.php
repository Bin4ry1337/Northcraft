<?php
session_start();

include('inc/config.php');
include('../inc/functions.php');

IPCheck();

?>
<html>
<head>
	<title>Northcraft</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<!-- CSS Stylesheets -->
	<link rel="stylesheet" type="text/css" href="../css/foundation.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="../css/normalize.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="../css/main.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="../css/header.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="../css/content.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="../css/footer.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="../css/fonts.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="../css/colors.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="../css/armory.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="../css/database.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="../css/fancybox.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="../css/mobile.css" media="screen" />

	<!-- Javascript Stylesheets -->
	<script type="text/javascript" src="../js/jquery.js"></script>
	<script type="text/javascript" src="../js/jquery-ui.min.js"></script>
	<script type="text/javascript" src="../js/foundation.js"></script>
	<script type="text/javascript" src="../js/main.js"></script>
	<script type="text/javascript" src="../js/foundation/foundation.dropdown.js"></script>
	<script type="text/javascript" src="../js/foundation/foundation.topbar.js"></script>
	<script type="text/javascript" src="../js/foundation/foundation.reveal.js"></script>
	<script type="text/javascript" src="../js/foundation/modernizr.js"></script>
	<script type="text/javascript" src="../js/fancybox/jquery.fancybox.js"></script>
	
	<!-- Google ReCaptcha -->
	<script src="https://www.google.com/recaptcha/api.js?onload=myCallBack&render=explicit" async defer></script>
	<script>

	/* This is basic - uses default settings */		
	$("a#single_image").fancybox();
			
	/* Using custom settings */		
	$("a#inline").fancybox({
		'hideOnContentClick': true
	});

	/* Apply fancybox to multiple items */		
	$("a.group").fancybox({
		'transitionIn'	:	'elastic',
		'transitionOut'	:	'elastic',
		'speedIn'		:	600, 
		'speedOut'		:	200, 
		'overlayShow'	:	false,
		'titleShow'     :   true
	});
	
	var recaptcha1;
	var recaptcha2;
	var myCallBack = function() {

	  //Login Captcha
	  recaptcha1 = grecaptcha.render('g-recaptcha', {
	    'sitekey' : '6Ld8gigTAAAAAAEF6MiiuKw0H0DybEVe4PDi0AaV', //Replace this with your Site key
	    'theme' : 'light'
	  });
	  
	  //Register Captcha
	  recaptcha2 = grecaptcha.render('g-recaptcha2', {
	    'sitekey' : '6Ld9gigTAAAAALSt-Um1KsdQpquhmaO7ROAvvSLE', //Replace this with your Site key
	    'theme' : 'light'
	  });
	};
	</script>
</head>
<body>
<div class="row2">
	<div class="header-top columns small-12 medium-12">
		<div class="row">
			<div class="header-top column small-12 medium-12">
				<a href="index.php">
					<div class="header-logo column small-12 medium-6">
						<img src="../img/logo.png" width="380">
					</div>

					<div class="header-content column small-12 medium-6">
						
					</div>
				</a>
			</div>
		</div>
	</div>

	<div class="header-bottom columns small-12 medium-12">
		<div class="row">
			<div class="header-bottom column hide-for-small medium-12 large-12">
				<div class="header-content-left column medium-9 large-9">
					<ul class="main-menu">
						<li><a href="../index.php" <?php echo (basename($_SERVER["PHP_SELF"]) == "index.php" || "")?"class=\"current-nav\"":""; ?>>HOME</a></li>

						<li><a href="../client/connect.php" <?php echo (basename($_SERVER["PHP_SELF"]) == "connect.php" || basename($_SERVER["PHP_SELF"]) == "downloads.php")?"class=\"current-nav dropdown\"":"class=\"dropdown\""; ?> data-dropdown="client-dropdown" aria-controls="client-dropdown" aria-expanded="false" data-options="is_hover:true; hover_timeout:200">CLIENT</a></li>
							<ul id="client-dropdown" data-dropdown-content class="f-dropdown sub-dropdown" aria-hidden="true">
								<li><a href="../client/connect.php">Connect</a></li>
								<li><a href="../client/downloads.php">Downloads</a></li>
							</ul>

						<li><a href="gallery.php" <?php echo (basename($_SERVER["PHP_SELF"]) == "gallery.php")?"class=\"current-nav dropdown\"":"class=\"dropdown\""; ?> data-dropdown="media-dropdown" aria-controls="media-dropdown" aria-expanded="false" data-options="is_hover:true; hover_timeout:200">MEDIA</a></li>
							<ul id="media-dropdown" data-dropdown-content class="f-dropdown sub-dropdown" aria-hidden="true">
								<li><a href="gallery.php" <?php echo (basename($_SERVER["PHP_SELF"]) == "gallery.php")?"class=\"current-nav\"":""; ?>>Gallery</a></li>
							</ul>

						<li><a href="../community/changelog.php" <?php echo (basename($_SERVER["PHP_SELF"]) == "changelog.php" || basename($_SERVER["PHP_SELF"]) == "timeline.php" || basename($_SERVER["PHP_SELF"]) == "faq.php" || basename($_SERVER["PHP_SELF"]) == "support.php")?"class=\"current-nav dropdown\"":"class=\"dropdown\""; ?> data-dropdown="community-dropdown" aria-controls="community-dropdown" aria-expanded="false" data-options="is_hover:true; hover_timeout:200">COMMUNITY</a></li>
							<ul id="community-dropdown" data-dropdown-content class="f-dropdown sub-dropdown" aria-hidden="true">
								<li><a href="../community/changelog.php">Changelog</a></li>
								<li><a href="../community/timeline.php">Timeline</a></li>
								<li><a href="../forums/">Forums</a></li>
								<li><a href="../community/faq.php">FAQ</a></li>
								<li><a href="../community/support.php">Support</a></li>
							</ul>

				        <li><a href="../bugtracker/">BUGTRACKER</a></li>

						<li><a href="../armory/armory.php" <?php echo (basename($_SERVER["PHP_SELF"]) == "armory.php" || basename($_SERVER["PHP_SELF"]) == "database.php")?"class=\"current-nav dropdown\"":"class=\"dropdown\""; ?> data-dropdown="armory-dropdown" aria-controls="armory-dropdown" aria-expanded="false" class="dropdown" data-options="is_hover:true; hover_timeout:200">ARMORY</a></li>
							<ul id="armory-dropdown" data-dropdown-content class="f-dropdown sub-dropdown" aria-hidden="true">
								<li><a href="../armory/armory.php">Character Database</a></li>
								<li><a href="../armory/database.php">Item Database</a></li>
							</ul>
					</ul>
				</div>

				<div class="header-content-right column medium-3 large-3">
					<ul class="account-menu">
						<?php AccountMenu2(); ?>
					</ul>
				</div>
			</div>

			<div class="header-bottom column show-for-small-only small-12">
				<nav>
					<div class="top-bar" data-topbar>
						<ul class="title-area">
				            <li class="name">
				            <h1><a href="#">Northcraft</a></h1>
				            </li>
				            <li class="toggle-topbar menu-icon"><a href="#"><span></span></a></li>
				        </ul>

				        <section class="top-bar-section">
				            <!-- Right Nav Section -->
				            <ul class="right">
          		  			    <li><a href="../index.php" <?php echo (basename($_SERVER["PHP_SELF"]) == "index.php" || basename($_SERVER["PHP_SELF"]) == "")?"class=\"current-nav\"":""; ?>>Home</a></li>
				                <li class="has-dropdown">
					                <a href="#" <?php echo (basename($_SERVER["PHP_SELF"]) == "client.php" || basename($_SERVER["PHP_SELF"]) == "connect.php" || basename($_SERVER["PHP_SELF"]) == "downloads.php")?"class=\"current-nav\"":""; ?>>Client</a>
						            <ul class="dropdown">
						           		<li><a href="../client/connect.php" <?php echo (basename($_SERVER["PHP_SELF"]) == "connect.php")?"class=\"current-nav\"":""; ?>>Connect</a></li>
						               	<li><a href="../client/downloads.php" <?php echo (basename($_SERVER["PHP_SELF"]) == "downloads.php")?"class=\"current-nav\"":""; ?>>Downloads</a></li>
					                </ul>
				                </li>

				                <li class="has-dropdown">
				                <a href="#" <?php echo (basename($_SERVER["PHP_SELF"]) == "gallery.php")?"class=\"current-nav\"":""; ?>>Media</a>
					               <ul class="dropdown">
					               		<li><a href="gallery.php" <?php echo (basename($_SERVER["PHP_SELF"]) == "gallery.php")?"class=\"current-nav\"":""; ?>>Gallery</a></li>
				                    </ul>
				                </li>

				                <li class="has-dropdown">
				                <a href="#" <?php echo (basename($_SERVER["PHP_SELF"]) == "changelog.php" || basename($_SERVER["PHP_SELF"]) == "timeline.php" || basename($_SERVER["PHP_SELF"]) == "faq.php" || basename($_SERVER["PHP_SELF"]) == "support.php")?"class=\"current-nav\"":""; ?>>Community</a>
					               <ul class="dropdown">
					               		<li><a href="../community/changelog.php" <?php echo (basename($_SERVER["PHP_SELF"]) == "changelog.php")?"class=\"current-nav\"":""; ?>>Changelog</a></li>
					               		<li><a href="../community/timeline.php" <?php echo (basename($_SERVER["PHP_SELF"]) == "timeline.php")?"class=\"current-nav\"":""; ?>>Timeline</a></li>
					               		<li><a href="../forums">Forums</a></li>
					               		<li><a href="../community/faq.php" <?php echo (basename($_SERVER["PHP_SELF"]) == "faq.php")?"class=\"current-nav\"":""; ?>>FAQ</a></li>
					               		<li><a href="../community/support.php" <?php echo (basename($_SERVER["PHP_SELF"]) == "support.php")?"class=\"current-nav\"":""; ?>>Support</a></li>
				                    </ul>
				                </li>

				        		<li><a href="../bugtracker/">Bugtracker</a></li>

				                <li class="has-dropdown">
				                <a href="#" <?php echo (basename($_SERVER["PHP_SELF"]) == "armory.php" || basename($_SERVER["PHP_SELF"]) == "database.php")?"class=\"current-nav\"":""; ?>>Armory</a>
					               <ul class="dropdown">
					               		<li><a href="../armory/armory.php" <?php echo (basename($_SERVER["PHP_SELF"]) == "armory.php")?"class=\"current-nav\"":""; ?>>Character Database</a></li>
					               		<li><a href="../armory/database.php" <?php echo (basename($_SERVER["PHP_SELF"]) == "database.php")?"class=\"current-nav\"":""; ?>>Item Database</a></li>
				                    </ul>
				                </li>

				                <li class="divider"></li>

				                <?php MobileMenu2(); ?>
				            </ul>
				        </section>
					</div>
				</nav>
			</div>
		</div>
	</div>
</div>