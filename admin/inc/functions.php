<?php

function GrabNews()
{
	global $con_web;

	$data = $con_web->prepare('SELECT COUNT(*) FROM news');
	$data->execute();

	if($data->fetchColumn() > 0)
	{
		$data = $con_web->prepare('SELECT * FROM news ORDER BY id desc LIMIT 5');
		$data->execute();

		while($result = $data->fetchAll(PDO::FETCH_ASSOC))
		{
			foreach($result as $row)
			{
				echo '<tr>
						<td>' . $row['title'] . '</td>
						<td><span class="green">' . ucfirst($row['author']) . '</span></td>
						<td><a href="?edit=' . $row['id'] . '"><img src="img/icons/edit.png" title="Edit" width="20"></a></td>
						<td><a href="?delete=' . $row['id'] . '" onclick="return confirm(\'Are you sure?\')"><img src="img/icons/delete.png" title="Delete" width="20"></a></td>
					</tr>';
			}
		}
	}
	else
	{
		echo '<span class="red">No news found!</span>';
	}
}



function PostNews()
{
	if(isset($_POST['post']))
	{
		if(!empty($_POST['title']) && !empty($_POST['content']))
		{
			global $con_web;

			$author  = $_SESSION['username'];
			$title   = $_POST['title'];
			$content = $_POST['content'];
			$time    = time();

			$data = $con_web->prepare('SELECT COUNT(*) FROM news WHERE title = :title OR content = :content');
			$data->execute(array(
				':title'   => $title,
				':content' => $content
			));

			if(!$data->fetchColumn() > 0)
			{
				$data = $con_web->prepare('SELECT * FROM avatar WHERE username = :username');
				$data->execute(array(
					':username' => $author
				));

				$result = $data->fetchAll(PDO::FETCH_ASSOC);

				foreach($result as $row)
				{
					$data = $con_web->prepare('INSERT INTO news (title, content, author, author_avatar, time) VALUES(:title, :content, :author, :avatar, :time)');
					$data->execute(array(
						':title'   => $title,
						':content' => $content,
						':author'  => $author,
						':avatar'  => $row['url'],
						':time'    => $time
					));

					echo '<div data-alert class="alert-box success radius">
							<center>Successfully posted new news article!</center>
						  	<a href="#" class="close">&times;</a>
						</div>';
				}
			}
			else
			{
				echo '<div data-alert class="alert-box alert radius">
					  	<center>Duplicate post detected!</center>
						<a href="#" class="close">&times;</a>
					</div>';
			}
		}
		else
		{
			echo '<div data-alert class="alert-box alert radius">
				  	<center>Form cant be empty!</center>
					<a href="#" class="close">&times;</a>
				</div>';
		}
	}
}



function UpdateNews()
{
	if(isset($_GET['edit']))
	{
		if(isset($_POST['edit']))
		{
			if(!empty($_POST['title-edit']) && !empty($_POST['content-edit']))
			{
				global $con_web;

				$id      = (int)$_GET['edit'];
				$title   = $_POST['title-edit'];
				$content = $_POST['content-edit'];

				$data = $con_web->prepare('SELECT COUNT(*) FROM news WHERE id = :id');
				$data->execute(array(
					':id' => $id
				));

				if($data->fetchColumn() == 1)
				{
					$data = $con_web->prepare('UPDATE news SET title = :title, content = :content WHERE id = :id');
					$data->execute(array(
						':title'   => $title,
						':content' => $content,
						':id'      => $id
					));

					echo '<div data-alert class="alert-box success radius">
						  	<center>Successfully edited news article!</center>
						  	<a href="#" class="close">&times;</a>
						</div>';
				}
				else
				{
					echo '<div data-alert class="alert-box alert radius">
						  	<center>Couldn\'t find the news article requested!</center>
						  	<a href="#" class="close">&times;</a>
						</div>';
				}
			}
			else
			{
				echo '<div data-alert class="alert-box alert radius">
					  	<center>Form cant be empty!</center>
					  	<a href="#" class="close">&times;</a>
					</div>';
			}
		}
	}
}



function EditNews()
{
	if(isset($_GET['edit']))
	{
		if(!empty($_GET['edit']))
		{
			global $con_web;

			$edit = (int)$_GET['edit'];

			$data = $con_web->prepare('SELECT COUNT(*) FROM news WHERE id = :id');
			$data->execute(array(
				':id' => $edit
			));

			if($data->fetchColumn() == 1)
			{
				$data = $con_web->prepare('SELECT * FROM news WHERE id = :id');
				$data->execute(array(
					':id' => $edit
				));

				$result = $data->fetchAll(PDO::FETCH_ASSOC);

				foreach($result as $row)
				{
					echo '<div class="content-content column small-12 medium-6 large-5">
							<div class="content-box column small-12 medium-12 large-12">
								<div class="content-box-header column small-12 medium-12 large-12">
									Edit post
								</div>

								<div class="content-box-content column small-12">
									<form method="POST">
										<div class="box-strip column small-12">
											<label>News Title</label>
											<input type="text" name="title-edit" value="' . $row['title'] . '" />
										</div>

										<div class="box-strip column small-12">
											<textarea name="content-edit" id="news-textarea2">' . $row['content'] . '</textarea>
										</div>

										<div class="box-strip-button column small-12">
											<input type="submit" class="button small" name="edit" value="Edit" />
										</div>
									</form>
								</div>
							</div>
						</div>';
				}
			}
		}
	}
}



function DeleteNews()
{
	if(isset($_GET['delete']))
	{
		if(!empty($_GET['delete']))
		{
			global $con_web;

			$delete = (int)$_GET['delete'];
			
			$data = $con_web->prepare('SELECT COUNT(*) FROM news WHERE id = :id');
			$data->execute(array(
				':id' => $delete
			));

			if($data->fetchColumn() == 1)
			{
				$data = $con_web->prepare('DELETE FROM news WHERE id = :id');
				$data->execute(array(
					':id' => $delete
				));

				echo '<div data-alert class="alert-box success radius">
					    <center>Successfully deleted news article!</center>
						<a href="#" class="close">&times;</a>
					</div>';
			}
		}
	}
}



function CheckUser()
{
	if(isset($_SESSION['username']))
	{
		global $con_realmd;

		$username = $_SESSION['username'];
		$gmlevel  = 5; //Level to access the admin panel

		$data = $con_realmd->prepare('SELECT COUNT(*) FROM account WHERE username = :username');
		$data->execute(array(
			':username' => $username
		));

		if($data->fetchColumn() == 1)
		{
			$data = $con_realmd->prepare('SELECT * FROM account WHERE username = :username');
			$data->execute(array(
				':username' => $username
			));

			$result = $data->fetchAll(PDO::FETCH_ASSOC);

			foreach($result as $row)
			{
				$data = $con_realmd->prepare('SELECT COUNT(*) FROM account_access WHERE id = :id AND gmlevel = :gmlevel');
				$data->execute(array(
					':id'      => $row['id'],
					':gmlevel' => $gmlevel
				));

				if($data->fetchColumn() == 1)
				{

				}
				else
				{
					die('Access Denied!');
				}
			}
		}
		else
		{
			die('Account was not found!');
		}
	}
	else
	{
		die('Access Denied!');
	}
}



function Dashboard($value)
{
	global $con_web;
	global $con_realmd;
	global $con_character;
	global $GeneralConfig;

	switch($value)
	{
		case 'USERS_TODAY':
			$data = $con_realmd->prepare('SELECT COUNT(*) FROM account WHERE date(joindate) = DATE_SUB(CURRENT_DATE(), INTERVAL 0 DAY)');
			$data->execute();
			$rows = $data->fetchColumn();
			echo '<span class="green">' . $rows . '</span>';
			break;
			
		case 'USERS_YESTERDAY':
			$data = $con_realmd->prepare('SELECT COUNT(*) FROM account WHERE date(joindate) = DATE_SUB(CURRENT_DATE(), INTERVAL 1 DAY)');
			$data->execute();
			$rows = $data->fetchColumn();
			echo '<span class="green">' . $rows . '</span>';
			break;
			
		case 'USERS_TOTAL':
			$data = $con_realmd->prepare('SELECT COUNT(*) FROM account');
			$data->execute();
			$rows = $data->fetchColumn();
			echo '<span class="green">' . $rows . '</span>';
			break;
			
		case 'NEWS_ARTICLES':
			$data = $con_web->prepare('SELECT COUNT(*) FROM news');
			$data->execute();
			$rows = $data->fetchColumn();
			echo '<span class="green">' . $rows . '</span>';
			break;
			
		case 'LOGON_SERVER':
			if(@fsockopen('logon.worldofnorthcraft.com', 3724, $errno, $errstr, 2))
			{
				echo '<span class="green">Online</span>';
			}
			else
			{
				echo '<span class="red">Offline</span>';
			}
			break;
			
		case 'WORLD_SERVER':
			if(@fsockopen('logon.worldofnorthcraft.com', 8085, $errno, $errstr, 2))
			{
				echo '<span class="green">Online</span>';
			}
			else
			{
				echo '<span class="red">Offline</span>';
			}
			break;
			
		case 'PLAYERS_ONLINE':
			$data = $con_character->prepare('SELECT COUNT(*) FROM characters WHERE online = 1');
			$data->execute();
			$rows = $data->fetchColumn();
			echo '<span class="green">' . $rows . '</span>';
			break;
			
		case 'UPTIME':
			$data = $con_character->prepare('SELECT * FROM uptime WHERE realmid = 1');
			$data->execute();

			$result = $data->fetchAll(PDO::FETCH_ASSOC);

			foreach($result as $info)
			{
				// Echo Uptime
			}
			$time    = '1472215118';
			$start   = date('Y-m-d H:i:s', $time);
			$current = date('Y-m-d H:i:s', time());

			$datetime1 = new DateTime($start);
			$datetime2 = new DateTime($current);
			$interval = $datetime1->diff($datetime2);
			echo '<span class="green">' . $interval->format('%dd %hh %im %ss') . '</span>';
			break;
			
		case 'ERRORS':
			echo '<span class="green">0</span>';
			break;
			
		case 'PHP_VERSION':
			echo '<span class="blue">' . phpversion() . '</span>';
			break;
			
		case 'CMS_VERSION':
			echo '<span class="yellow">' . $GeneralConfig['CMS_VERSION'] . '</span>';
			break;
			
		case 'EXPLOITS':
			echo '<span class="green">0</span>';
			break;

	}
}



function GrabTickets()
{
	global $con_web;

	$data = $con_web->prepare('SELECT COUNT(*) FROM support');
	$data->execute();

	if($data->fetchColumn() > 0)
	{
		$data = $con_web->prepare('SELECT * FROM support ORDER BY id desc LIMIT 10');
		$data->execute();

		echo '<table>
				<th>Email</th>
				<th>Subject</th>
				<th>Message</th>
				<th></th>';

		while($result = $data->fetchAll(PDO::FETCH_ASSOC))
		{
			foreach($result as $row)
			{
				echo '<tr>
						<td>' . $row['email'] . '</td>
						<td>' . $row['subject'] . '</td>
						<td>' . $row['message'] . '</td>
						<td><a href="?delete=' . $row['id'] . '" onclick="return confirm(\'Are you sure?\')"><img src="img/icons/delete.png" title="Delete" width="20"></a></td>
					</tr>';
			}
		}

		echo '</table>';
	}
	else
	{
		echo '<span class="red">No tickets found!</span>';
	}
}



function DeleteTicket()
{
	if(isset($_GET['delete']))
	{
		if(!empty($_GET['delete']))
		{
			global $con_web;

			$delete = (int)$_GET['delete'];
			
			$data = $con_web->prepare('SELECT COUNT(*) FROM support WHERE id = :id');
			$data->execute(array(
				':id' => $delete
			));

			if($data->fetchColumn() == 1)
			{
				$data = $con_web->prepare('DELETE FROM support WHERE id = :id');
				$data->execute(array(
					':id' => $delete
				));

				echo '<div data-alert class="alert-box success radius">
					    <center>Successfully deleted ticket!</center>
						<a href="#" class="close">&times;</a>
					</div>';
			}
		}
	}
}



function AddChangelog()
{
	if(isset($_POST['submit-changes']))
	{
		global $con_web;

		$Types = array(
			0 => 'Quest',
			1 => 'Item',
			2 => 'Spell',
			3 => 'Creature',
			4 => 'Talent',
			5 => 'Zone'
		);

		$ZoneToName = array(

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

		$author = ucfirst($_SESSION['username']);
		$rev    = substr(str_shuffle('01234567890ABCDEF'), 10);

		$type1  = $_POST['type1'];
		$id1    = $_POST['id1'];
		$note1  = $_POST['note1'];
		$zone1  = $_POST['zone1'];
		@$ins1  = $_POST['instance1'];

		if($type1 !== 4)
		{
			$db1 = '<a href="http://wotlk.openwow.com/' . strtolower($Types[$type1]) . '=' . $id1 . '" target="_BLANK"></a>';
		}
		if($type1 == 3)
		{
			$db1 = '<a href="http://wotlk.openwow.com/npc=' . $id1 . '" target="_BLANK"></a>';
		}
		elseif($type1 == 5)
		{
			$db1 = $ZoneToName[$zone1];
		}
		else
		{
			$db1 = '<a href="http://wotlk.openwow.com/spell=' . $id1 . '" target="_BLANK"></a>';
		}

		$type2  = $_POST['type2'];
		$id2    = $_POST['id2'];
		$note2  = $_POST['note2'];
		@$ins2   = $_POST['instance2'];
		
		if($type2 !== 4)
		{
			$db2 = '<a href="http://wotlk.openwow.com/' . strtolower($Types[$type2]) . '=' . $id2 . '" target="_BLANK"></a>';
		}
		if($type2 == 3)
		{
			$db2 = '<a href="http://wotlk.openwow.com/npc=' . $id2 . '" target="_BLANK"></a>';
		}
		else
		{
			$db2 = '<a href="http://wotlk.openwow.com/spell=' . $id2 . '" target="_BLANK"></a>';
		}

		$type3  = $_POST['type3'];
		$id3    = $_POST['id3'];
		$note3  = $_POST['note3'];
		@$ins3   = $_POST['instance3'];

		if($type3 !== 4)
		{
			$db3 = '<a href="http://wotlk.openwow.com/' . strtolower($Types[$type3]) . '=' . $id3 . '" target="_BLANK"></a>';
		}
		if($type3 == 3)
		{
			$db3 = '<a href="http://wotlk.openwow.com/npc=' . $id3 . '" target="_BLANK"></a>';
		}
		else
		{
			$db3 = '<a href="http://wotlk.openwow.com/spell=' . $id3 . '" target="_BLANK"></a>';
		}

		$type4  = $_POST['type4'];
		$id4    = $_POST['id4'];
		$note4  = $_POST['note4'];
		@$ins4   = $_POST['instance4'];
		
		if($type4 !== 4)
		{
			$db4 = '<a href="http://wotlk.openwow.com/' . strtolower($Types[$type4]) . '=' . $id4 . '" target="_BLANK"></a>';
		}
		if($type4 == 3)
		{
			$db4 = '<a href="http://wotlk.openwow.com/npc=' . $id4 . '" target="_BLANK"></a>';
		}
		else
		{
			$db4 = '<a href="http://wotlk.openwow.com/spell=' . $id4 . '" target="_BLANK"></a>';
		}

		$type5  = $_POST['type5'];
		$id5    = $_POST['id5'];
		$note5  = $_POST['note5'];
		@$ins5   = $_POST['instance5'];
		
		if($type5 !== 4)
		{
			$db5 = '<a href="http://wotlk.openwow.com/' . strtolower($Types[$type5]) . '=' . $id5 . '" target="_BLANK"></a>';
		}
		if($type5 == 3)
		{
			$db5 = '<a href="http://wotlk.openwow.com/npc=' . $id5 . '" target="_BLANK"></a>';
		}
		else
		{
			$db5 = '<a href="http://wotlk.openwow.com/spell=' . $id5 . '" target="_BLANK"></a>';
		}

		@$data = $con_web->prepare('INSERT INTO changelog (author, type, typeID, db, note, instance, time, revision) VALUES(:author, :type, :id, :db, :note, :ins,:time, :rev)');
		@$data->execute(array(
			':author' => $author,
			':type'   => $Types[$type1],
			':id'     => $id1,
			':db'     => $db1,
			':note'   => $note1,
			':ins'    => $ins1,
			':time'   => time(),
			':rev'    => $rev
		));

		@$data = $con_web->prepare('INSERT INTO changelog (author, type, typeID, db, note, instance, time, revision) VALUES(:author, :type, :id, :db, :note, :ins,:time, :rev)');
		@$data->execute(array(
			':author' => $author,
			':type'   => $Types[$type2],
			':id'     => $id2,
			':db'     => $db2,
			':note'   => $note2,
			':ins'    => $ins2,
			':time'   => time(),
			':rev'    => $rev
		));

		@$data = $con_web->prepare('INSERT INTO changelog (author, type, typeID, db, note, instance, time, revision) VALUES(:author, :type, :id, :db, :note, :ins,:time, :rev)');
		@$data->execute(array(
			':author' => $author,
			':type'   => $Types[$type3],
			':id'     => $id3,
			':db'     => $db3,
			':note'   => $note3,
			':ins'    => $ins3,
			':time'   => time(),
			':rev'    => $rev
		));

		@$data = $con_web->prepare('INSERT INTO changelog (author, type, typeID, db, note, instance, time, revision) VALUES(:author, :type, :id, :db, :note, :ins,:time, :rev)');
		@$data->execute(array(
			':author' => $author,
			':type'   => $Types[$type4],
			':id'     => $id4,
			':db'     => $db4,
			':note'   => $note4,
			':ins'    => $ins4,
			':time'   => time(),
			':rev'    => $rev
		));

		@$data = $con_web->prepare('INSERT INTO changelog (author, type, typeID, db, note, instance, time, revision) VALUES(:author, :type, :id, :db, :note, :ins,:time, :rev)');
		@$data->execute(array(
			':author' => $author,
			':type'   => $Types[$type5],
			':id'     => $id5,
			':db'     => $db5,
			':note'   => $note5,
			':ins'    => $ins5,
			':time'   => time(),
			':rev'    => $rev
		));

		echo '<div data-alert class="alert-box success radius">
			    <center>Added changelog with revision: ' . $rev . '</center>
				<a href="#" class="close">&times;</a>
			</div>';
	}
}



function Zones()
{
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
}



function GrabChangelogs()
{
	global $con_web;

	$data = $con_web->prepare('SELECT COUNT(*) FROM changelog');
	$data->execute();

	if($data->fetchColumn() > 0)
	{

		$instance = array(
			0 => 'Normal',
			1 => 'Dungeon',
			2 => 'Raid'
		);

		$data = $con_web->prepare('SELECT * FROM changelog ORDER BY id desc LIMIT 10');
		$data->execute();

		echo '<table class="changelog-table">
				<th>Rev</th>
				<th>Author</th>
				<th>Type</th>
				<th>ID</th>
				<th>Note</th>
				<th>Instance</th>
				<th>Date</th>
				<th></th>';

		while($result = $data->fetchAll(PDO::FETCH_ASSOC))
		{
			foreach($result as $row)
			{
				echo '<tr>
						<td>' . $row['revision'] . '</td>
						<td><span class="green">' . $row['author'] . '</span></td>
						<td>' . $row['type'] . '</td>
						<td>' . $row['db'] . '</td>
						<td>' . $row['note'] . '</td>
						<td>' . $instance[$row['instance']] . '</td>
						<td>' . date('H:i - d. M, Y', $row['time']) . '</td>
						<td><a href="?del=' . $row['id'] . '" onclick="return confirm(\'Are you sure?\')"><img src="img/icons/delete.png" title="Delete" width="20"></a></td>
					</tr>';
			}
		}

		echo '</table>';
	}
	else
	{
		echo '<span class="red">No changelogs has been found in the database!</span>';
	}
}



function DeleteChangelog()
{
	if(isset($_GET['del']))
	{
		if(!empty($_GET['del']))
		{
			global $con_web;

			$delete = (int)$_GET['del'];
			
			$data = $con_web->prepare('SELECT COUNT(*) FROM changelog WHERE id = :id');
			$data->execute(array(
				':id' => $delete
			));

			if($data->fetchColumn() == 1)
			{
				$data = $con_web->prepare('DELETE FROM changelog WHERE id = :id');
				$data->execute(array(
					':id' => $delete
				));

				echo '<div data-alert class="alert-box success radius">
					    <center>Successfully deleted changelog id: ' . $delete . '!</center>
						<a href="#" class="close">&times;</a>
					</div>';
			}
		}
	}
}

?>