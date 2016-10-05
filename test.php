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

</style>

<span class="white">
<?php

$time    = '1472215118';
$start   = date('Y-m-d H:i:s', $time);
$current = date('Y-m-d H:i:s', time());

$datetime1 = new DateTime($start);
$datetime2 = new DateTime($current);
$interval  = $datetime1->diff($datetime2);
echo $interval->format('%dd %hh %im %ss');

?>
</span>

<?php
/*
$username = 'remotebaby';
$password = 'remote1337';
$host     = '91.121.76.202';
$port     = '48754';

try{
	$client = new SoapClient(NULL, array(
		"location"      => "http://91.121.76.202:48754/",
		"uri"           => "urn:TC",
		"style"         => SOAP_RPC,
		"login"         => $username,
		"password"      => $password,
		'trace'         => 1,
		'keep_alive'    => false
	));
	$command = "server info";

	//execute

	$result = $client->executeCommand(new SoapParam($command, 'command'));
	var_dump($client->__getLastRequest());
	var_dump($client->__getLastResponse());
	echo "Connected!<br/>";
}
catch ( Exception $e )
{
	echo "Connection Failed!<br/>";
	echo $e->getMessage();
}
*/


?>

