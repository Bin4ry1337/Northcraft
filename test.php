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

	<script type="text/javascript" src="https://www.wow-mania.com/armory/static/widgets/power.js"></script><script>var aowow_tooltips = { "colorlinks": true, "iconizelinks": true, "renamelinks": true }</script>

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


.page-nav ul
{
	list-style: none;
	list-style-type: none;
	padding: 0px;
	margin: 0px;
}

.page-nav li a
{
	float: left;
	padding: 5px;
	color: #FFF;
	font-size: 0.9rem;
}

.page-nav li .current-nav
{
	color: orange;
	font-weight: 700;
}


</style>

<span class="white">
<?php
/*
$time    = '1472215118';
$start   = date('Y-m-d H:i:s', $time);
$current = date('Y-m-d H:i:s', time());

$datetime1 = new DateTime($start);
$datetime2 = new DateTime($current);
$interval  = $datetime1->diff($datetime2);
echo $interval->format('%dd %hh %im %ss');
*/
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

	global $con_web;

	$page    = isset($_GET['page']) ? (int)$_GET['page'] : 1;
	$perPage = 1;

	$start = ($page > 1) ? ($page * $perPage) - $perPage : 0;

	$total = $con_web->query('SELECT COUNT(*) FROM changelog')->fetchColumn();
	$pages = ceil($total / $perPage);

	$data = $con_web->prepare('SELECT * FROM changelog LIMIT ' . $start . ', ' . $perPage);
	$data->execute();

	while($result = $data->fetchAll(PDO::FETCH_ASSOC))
	{
		echo '<table>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>';

		foreach($result as $row)
		{
			echo '<tr>
					<td>' . $row['id'] . '</td>
					<td>' . $row['type'] . '</td>
					<td>' . $row['typeID'] . '</td>
					<td>' . $row['note'] . '</td>
					<td>' . date('d. F, Y', $row['time']) . '</td>
				</tr>';
		}
		echo '</table>';
	}

	echo '<div class="page-nav"><ul>';

	for($x = 1; $x <= $pages; $x++)
	{
		echo '<li><a href="?page=' . $x . '">' . $x . '</a></li>';
	}

	echo '</ul></div>';

$Zones = array(

		//Kalimdor
		772 => "Ahn'Qiraj: The Fallen Kingdom",
		894 => "Ammen Vale",
		43  => "Ashenvale",
		181 => "Azshara",
		464 => "Azuremyst Isle",
		476 => "Bloodmyst Isle",
		42  => "Darkshore",
		381 => "Darnassus",
		101 => "Desolace",
		4   => "Durotar",
		141 => "Dustwallow Marsh",
		891 => "Echo Isles",
		182 => "Felwood",
		121 => "Feralas",
		241 => "Moonglade",
		606 => "Mount Hyjal",
		9   => "Mulgore",
		11  => "Northern Barrens",
		321 => "Orgrimmar",
		888 => "Shadowglen",
		261 => "Silithus",
		607 => "Southern Barrens",
		81  => "Stonetalon Mountains",
		161 => "Tanaris",
		41  => "Teldrassil",
		471 => "The Exodar",
		61  => "Thousand Needles",
		362 => "Thunder Bluff",
		201 => "Un'Goro Crater",
		889 => "Valley of Trials",
		281 => "Winterspring",

		//Eastern Kingdoms
		16  => "Arathi Highlands",
		17  => "Badlands",
		19  => "Blasted Lands",
		29  => "Burning Steppes",
		866 => "Coldridge Valley",
		32  => "Deadwind Pass",
		27  => "Dun Morogh",
		34  => "Duskwood",
		23  => "Eastern Plaguelands",
		30  => "Elwynn Forest",
		462 => "Eversong Woods",
		463 => "Ghostlands",
		24  => "Hillsbrad Foothills",
		341 => "Ironforge",
		499 => "Isle of Quel'Danas",
		35  => "Loch Modan",
		36  => "Redridge Mountains",
		28  => "Searing Gorge",
		480 => "Silvermoon City",
		21  => "Silverpine Forest",
		301 => "Stormwind City",
		33  => "Stranglethorn Vale",
		893 => "Sunstrider Isle",
		38  => "Swamp of Sorrows",
		26  => "The Hinterlands",
		20  => "Tirisfal Glades",
		382 => "Undercity",
		22  => "Western Plaguelands",
		39  => "Westfall",
		40  => "Wetlands",

		//Outland
		475 => "Blade's Edge Mountains",
		465 => "Hellfire Peninsula",
		477 => "Nagrand",
		479 => "Netherstorm",
		473 => "Shadowmoon Valley",
		481 => "Shattrath City",
		478 => "Terokkar Forest",
		467 => "Zangarmarsh",

		//Northrend
		486 => "Borean Tundra",
		510 => "Crystalsong Forest",
		504 => "Dalaran",
		488 => "Dragonblight",
		490 => "Grizzly Hills",
		491 => "Howling Fjord",
		541 => "Hrothgar's Landing",
		492 => "Icecrown",
		493 => "Sholazar Basin",
		495 => "The Storm Peaks",
		501 => "Wintergrasp",
		496 => "Zul'Drak",

		//Classic Dungeons
		688 => "Blackfathom Deeps",
		704 => "Blackrock Depths",
		721 => "Blackrock Spire",
		699 => "Dire Maul",
		691 => "Gnomeregan",
		750 => "Maraudon",
		680 => "Ragefire Chasm",
		760 => "Razorfen Downs",
		761 => "Razorfen Kraul",
		764 => "Shadowfang Keep",
		765 => "Stratholme",
		756 => "The Deadmines",
		690 => "The Stockade",
		687 => "The Temple of Atal'Hakkar",
		692 => "Uldaman",
		749 => "Wailing Caverns",
		686 => "Zul'Farrak",

		//TBC Dungeons
		722 => "Auchenai Crypts",
		797 => "Hellfire Ramparts",
		798 => "Magisters' Terrace",
		732 => "Mana-Tombs",
		734 => "Old Hillsbrad Foothills",
		723 => "Sethekk Halls",
		724 => "Shadow Labyrinth",
		731 => "The Arcatraz",
		733 => "The Black Morass",
		725 => "The Blood Furnace",
		729 => "The Botanica",
		730 => "The Mechanar",
		710 => "The Shattered Halls",
		728 => "The Slave Pens",
		727 => "The Steamvault",
		726 => "The Underbog",

		//WOTLK Dungeons
		522 => "Ahn'kahet: The Old Kingdom",
		533 => "Azjol-Nerub",
		534 => "Drak'Tharon Keep",
		530 => "Gundrak",
		525 => "Halls of Lightning",
		603 => "Halls of Reflection",
		526 => "Halls of Stone",
		602 => "Pit of Saron",
		521 => "The Culling of Stratholme",
		601 => "The Forge of Souls",
		520 => "The Nexus",
		528 => "The Oculus",
		536 => "The Violet Hold",
		542 => "Trial of the Champion",
		523 => "Utgarde Keep",
		524 => "Utgarde Pinnacle",

		//Classic Raids
		755 => "Blackwing Lair",
		696 => "Molten Core",
		717 => "Ruins of Ahn'Qiraj",
		766 => "Temple of Ahn'Qiraj",

		//TBC Raids
		796 => "Black Temple",
		776 => "Gruul's Lair",
		775 => "Hyjal Summit",
		799 => "Karazhan",
		779 => "Magtheridon's Lair",
		780 => "Serpentshrine Cavern",
		789 => "Sunwell Plateau",
		782 => "Tempest Keep",

		//WOTLK Raids
		604 => "Icecrown Citadel",
		535 => "Naxxramas",
		718 => "Onyxia's Lair",
		527 => "The Eye of Eternity",
		531 => "The Obsidian Sanctum",
		609 => "The Ruby Sanctum",
		543 => "Trial of the Crusader",
		529 => "Ulduar",
		532 => "Vault of Archavon",

		//Battlegrounds
		401 => "Alterac Valley",
		461 => "Arathi Basin",
		482 => "Eye of the Storm",
		512 => "Strand of the Ancients",
		443 => "Warsong Gulch"
	);

	foreach($Zones as $Zone => $value)
	{
		echo '<option value="' . $Zone . '">' . $value . '</option>';
	}
?>



<a href="https://www.wow-mania.com/armory/?zone=4196">dsada</a>







