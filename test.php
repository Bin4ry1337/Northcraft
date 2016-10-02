<?php

include('inc/config.php');
include('inc/functions.php');

?>
<head>
<link rel="stylesheet" type="text/css" href="css/main.css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/foundation.css" media="screen" />
<style>
body
{
	background-color: #111;
	color: #FFF;
}
</style>
</head>
<script type="text/javascript" src="js/openwow.js"></script>
	<script>
	var openwowTooltips = {
	        /* Enable or disable the rename of URLs into item, spell and other names automatically */
	        rename: true,
	        /* Enable or disable icons appearing on the left of the tooltip links. */
	        icons: true,
	        /* Overrides the default icon size of 15x15, 13x13 as an example, icons must be true */
	        iconsize: 20,
	        /* Enable or disable link rename quality colors, an epic item will be purple for example. */
	        qualitycolor: true,
	        /* TBA */
	        forcexpac: { },
	        /* Override link colors, qualitycolor must be true. Example: spells: '#000' will color all renamed spell links black. */
	        overridecolor: {
	            spells: '',
	            items: '',
	            npcs: '',
	            objects: '',
	            quests: '',
	            achievements: ''
	        } 
	};
	</script>

<style>

.red
{
	color: #e74c3c;
}

body
{
	color: #FFF;
	padding: 10px;
}

.column
{
	padding: 0px;
}

.discordapp
{
	width: 300px;
	background-color: #111;
	border: 1px #333 solid;
	border-radius: 3px;

}

.discord-header
{
	height: 50px;
	background-color: #7289DA;
	padding: 8px;
	border-top-left-radius: 3px;
	border-top-right-radius: 3px;
}

.discord-logo
{
	display: block;
}

.discord-online
{
	text-align: right;
	font-family: 'Lato', sans-serif; /* Default Font Family */
	font-weight: 400;
	font-size: 0.8rem;
}

.discord-content
{
	width: 100%;
	min-height: 400px;
	background-image: url('https://discordapp.com/assets/db9fd9dac08621e31b06609781c8851c.png');
}

</style>

<span class="white">
<?php

$time    = '1472215118';
$start   = date('Y-m-d H:i:s', $time);
$current = date('Y-m-d H:i:s', time());

$datetime1 = new DateTime($start);
$datetime2 = new DateTime($current);
$interval = $datetime1->diff($datetime2);
//echo $interval->format('%dd %hh %im %ss');

?>
</span>

<div class="discordapp">
	<div class="discord-header column small-12">
		<div class="discord-logo column small-6">
			<img src="https://discordapp.com/assets/4f004ac9be168ac6ee18fc442a52ab53.svg">
		</div>

		<div class="discord-online column small-6">
			<span class="bold">33</span> Members<br>Online
		</div>
	</div>

	<div class="discord-content">

	</div>
</div>

