<?php
session_start();

include('inc/config.php');
include('inc/functions.php');

CheckUser();

?>
<html>
<head>
	<title>Northcraft | AdminCP</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<!-- CSS Stylesheets -->
	<link rel="stylesheet" type="text/css" href="css/foundation.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="css/normalize.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="css/main.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="css/header.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="css/content.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="css/footer.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="css/fonts.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="css/colors.css" media="screen" />

	<!-- Javascript Stylesheets -->
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/jquery-ui.min.js"></script>
	<script type="text/javascript" src="js/foundation.js"></script>
	<script type="text/javascript" src="js/main.js"></script>
	<script type="text/javascript" src="js/foundation/foundation.dropdown.js"></script>
	<script type="text/javascript" src="js/foundation/foundation.topbar.js"></script>
	<script type="text/javascript" src="js/foundation/foundation.reveal.js"></script>
	<script type="text/javascript" src="js/foundation/foundation.alert.js"></script>
	<script type="text/javascript" src="js/foundation/modernizr.js"></script>
	<script type="text/javascript" src='js/tinymce/tinymce.min.js'></script>
	<script>
		tinymce.init({
			selector: "#news-textarea",
			plugins: "textcolor colorpicker code",
			toolbar: "forecolor backcolor undo redo | styleselect bold italic | alignleft aligncenter alignright bullist numlist | outdent indent code"
		});


		tinymce.init({
			selector: "#news-textarea2",
			plugins: "textcolor colorpicker code",
			toolbar: "forecolor backcolor undo redo | styleselect bold italic | alignleft aligncenter alignright bullist numlist | outdent indent code"
		});
	</script>
</head>
<body>
<div class="row">
	<div class="header column small-12">
		<div class="header-top column small-12">
			<div class="header-top-left column small-6">
				Northcraft | <span class="green">AdminCP</span>
			</div>

			<div class="header-top-right column small-6">
				<div class="header-account">
					Logged in as <span class="green"><?php echo ucfirst($_SESSION['username']); ?></span>
				</div>
			</div>
		</div>

		<div class="header-menu">
			<div class="header-menu-item">
				<ul class="main-menu">
					<li><a href="index.php" <?php echo (basename($_SERVER["PHP_SELF"]) == "index.php" || "")?"class=\"current-nav\"":""; ?>>Dashboard</a></li>
					<li><a href="news.php" <?php echo (basename($_SERVER["PHP_SELF"]) == "news.php")?"class=\"current-nav\"":""; ?>>News</a></li>
					<li><a href="changelog.php" <?php echo (basename($_SERVER["PHP_SELF"]) == "changelog.php")?"class=\"current-nav\"":""; ?>>Changelog</a></li>
					<li><a href="tickets.php" <?php echo (basename($_SERVER["PHP_SELF"]) == "tickets.php")?"class=\"current-nav\"":""; ?>>Tickets</a></li>
				</ul>
			</div>
		</div>
	</div>
</div>
