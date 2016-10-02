<?php

function ItemDatabase()
{
	if(isset($_GET['item']))
	{
		if(!empty($_GET['item']))
		{
			global $con_world;

			$item = ucfirst(strtolower($_GET['item']));

			$data = $con_world->prepare('SELECT COUNT(*) FROM item_template WHERE entry = :item');
			$data->execute(array(
				':item' => $item
			));

			if($data->fetchColumn() == 1)
			{
				$data = $con_world->prepare('SELECT * FROM item_template WHERE entry = :item');
				$data->execute(array(
					':item' => $item
				));

				$result = $data->fetchAll(PDO::FETCH_ASSOC);

				foreach($result as $item)
				{
					$item_entry = $_GET['item'];

					$data = $con_world->prepare('SELECT * FROM item_template WHERE entry = :entry');
					$data->execute(array(
						':entry' => $item_entry
					));

					while($result = $data->fetchAll(PDO::FETCH_ASSOC))
					{
						foreach($result as $item)
						{
							$quality = array(
								0 => '<span class="poor">' . $item['name'] . '</span>',
								1 => '<span class="common">' . $item['name'] . '</span>',
								2 => '<span class="uncommon">' . $item['name'] . '</span>',
								3 => '<span class="rare">' . $item['name'] . '</span>',
								4 => '<span class="epic">' . $item['name'] . '</span>',
								5 => '<span class="legendary">' . $item['name'] . '</span>',
								6 => '<span class="artifact">' . $item['name'] . '</span>',
								7 => '<span class="heirloom">' . $item['name'] . '</span>'
							);

							echo '<div class="database-item">
									<a href="http://wotlk.openwow.com/?item=' . $item['entry'] . '"></a>
								</div>';
						}
					}
				}
			}
			else
			{
				echo '<span class="red">Item not found in our database!</span>';
			}
		}
		else
		{
			echo '<span class="red">Search is empty!</span>';
		}
	}
}



function Armory()
{
	if(isset($_GET['character']))
	{
		if(!empty($_GET['character']))
		{
			global $con_character;
			global $con_world;

			$character = ucfirst(strtolower($_GET['character']));

			$data = $con_character->prepare('SELECT COUNT(*) FROM characters WHERE name = :character');
			$data->execute(array(
				':character' => $character
			));

			if($data->fetchColumn() == 1)
			{
				$data = $con_character->prepare('SELECT * FROM characters WHERE name = :character');
				$data->execute(array(
					':character' => $character
				));

				while($result = $data->fetchAll(PDO::FETCH_ASSOC))
				{
					foreach($result as $item)
					{
						$race = array(
							1  => 'Human',
							2  => 'Orc',
							3  => 'Dwarf',
							4  => 'Night Elf',
							5  => 'Undead',
							6  => 'Tauren',
						    7  => 'Gnome',
						    8  => 'Troll',
						    10 => 'Blood Elf',
						    11 => 'Draenei'
						);

						$class = array(
							1  => '<span class="warrior">Warrior</span>',
							2  => '<span class="paladin">Paladin</span>',
							3  => '<span class="hunter">Hunter</span>',
							4  => '<span class="darkyellow">Rogue</span>',
							5  => '<span class="priest">Priest</span>',
							6  => '<span class="dk">Deathknight</span>',
							7  => '<span class="shaman">Shaman</span>',
							8  => '<span class="mage">Mage</span>',
							9  => '<span class="warlock">Warlock</span>',
							11 => '<span class="druid">Druid</span>'
						);

						switch ($item['online'])
						{
							case 0:
								$status = '<span class="red">Offline</span>';
								break;

							case 1:
								$status = '<span class="green">Online</span>';
								break;
						}

						switch ($item['class'])
						{
							case 1:
								$type  = 'Rage';
								$power = '<div class="char-power bg-red white">
											100 / 100 ' . $type . '
										</div>';
								break;

							case 2:
								$type  = 'Mana';
								$power = '<div class="char-power bg-blue white">
											' . $item['power1'] . ' / '  . $item['power1'] . ' ' . $type . '
										</div>';
								break;

							case 3:
								$type  = 'Mana';
								$power = '<div class="char-power bg-blue white">
											' . $item['power1'] . ' / '  . $item['power1'] . ' ' . $type . '
										</div>';
								break;

							case 4:
								$type  = 'Energy';
								$power = '<div class="char-power bg-darkyellow white">
											100 / 100 ' . $type . '
										</div>';
								break;

							case 5:
								$type  = 'Mana';
								$power = '<div class="char-power bg-blue white">
											' . $item['power1'] . ' / '  . $item['power1'] . ' ' . $type . '
										</div>';
								break;

							case 6:
								$type  = 'Runic Power';
								$power = '<div class="char-power bg-lightblue white">
											100 / 100 ' . $type . '
										</div>';
								break;

							case 7:
								$type  = 'Mana';
								$power = '<div class="char-power bg-blue white">
											' . $item['power1'] . ' / '  . $item['power1'] . ' ' . $type . '
										</div>';
								break;

							case 8:
								$type  = 'Mana';
								$power = '<div class="char-power bg-blue white">
											' . $item['power1'] . ' / '  . $item['power1'] . ' ' . $type . '
										</div>';
								break;

							case 9:
								$type  = 'Mana';
								$power = '<div class="char-power bg-blue white">
											' . $item['power1'] . ' / '  . $item['power1'] . ' ' . $type . '
										</div>';
								break;

							case 11:
								$type  = 'Mana';
								$power = '<div class="char-power bg-blue white">
											' . $item['power1'] . ' / '  . $item['power1'] . ' ' . $type . '
										</div>';
								break;
						}

						// Grabs and seperates character item ids
						$items = explode(' ', $item['equipmentCache']);

						// Defines Character Stats / Information
						$char = array(
							'ID'              => $item['guid'],
							'NAME'            => $item['name'],
							'RACE'            => $race[$item['race']],
							'CLASS'           => $class[$item['class']],
							'LEVEL'           => $item['level'],
							'HEALTH'          => $item['health'],
							'POWER'           => $power,
							'STATUS'          => $status,
							'HONOR_TODAY'     => $item['todayHonorPoints'],
							'HONOR_YESTERDAY' => $item['yesterdayHonorPoints'],
							'HONOR_TOTAL'     => $item['totalHonorPoints'],
							'KILLS_TODAY'     => $item['todayKills'],
							'KILLS_YESTERDAY' => $item['yesterdayKills'],
							'KILLS_TOTAL'     => $item['totalKills']
						);

						// Defines Character Equipments
						$equipment = array(
							'HEAD'     => $items[0],
							'NECK'     => $items[2],
							'SHOULDER' => $items[4],
							'SHIRT'    => $items[6],
							'CHEST'    => $items[8],
							'WAIST'    => $items[10],
							'LEGS'     => $items[12],
							'FEET'     => $items[14],
							'WRIST'    => $items[16],
							'HANDS'    => $items[18],
							'RING1'    => $items[20],
							'RING2'    => $items[22],
							'TRINKET1' => $items[24],
							'TRINKET2' => $items[26],
							'CLOAK'    => $items[28],
							'MAINHAND' => $items[30],
							'OFFHAND'  => $items[32],
							'RANGED'   => $items[34],
							'TABARD'   => $items[36]
						);

						
						function Enchantments($guid, $slot)
						{
							global $con_character;

							$ench = $con_character->prepare('SELECT * FROM item_instance WHERE owner_guid = :guid AND itemEntry = :item');
							$ench->execute(array(
								':guid' => $guid,
								':item' => $slot
							));

							$result = $ench->fetchAll(PDO::FETCH_ASSOC);

							foreach($result as $enchant)
							{
								$attachment = explode(" ", $enchant['enchantments']);

								$attach = array(
									'ENCHANT'    => $attachment[0],
									'GEM1'       => $attachment[6],
									'GEM2'       => $attachment[9],
									'GEM3'       => $attachment[12],
									'ENCHANT2'   => $attachment[18]
								);

								if($attach['ENCHANT'] == 1)
								{
									$enchant = $attach['ENCHANT'];
								}
								elseif($attach['ENCHANT'] == 0)
								{
									$enchant = $attach['ENCHANT2'];
								}
								else
								{
									$enchant = $attach['ENCHANT'];
								}

								return 'ench=' . $enchant . ';gems=' . $attach['GEM1'] . ':' . $attach['GEM2'] . ':' . $attach['GEM3'];
							}
						}

						if($equipment['HEAD'] == 0)
						{
							$head = '<img src="img/icons/slots/head.png" width="35" class="icon" title="Head">';
						}
						else
						{
							$head = '<a href="http://wotlk.openwow.com/item=' . $equipment['HEAD'] . '" rel="' . Enchantments($char['ID'], $equipment['HEAD']) . '"></a>';
						}

						if($equipment['NECK'] == 0)
						{
							$neck = '<img src="img/icons/slots/neck.png" width="35" class="icon" title="Neck">';
						}
						else
						{
							$neck = '<a href="http://wotlk.openwow.com/item=' . $equipment['NECK'] . '" rel="' . Enchantments($char['ID'], $equipment['NECK']) . '"></a>';
						}

						if($equipment['SHOULDER'] == 0)
						{
							$shoulder = '<img src="img/icons/slots/shoulder.png" width="35" class="icon" title="Shoulder">';
						}
						else
						{
							$shoulder = '<a href="http://wotlk.openwow.com/item=' . $equipment['SHOULDER'] . '" rel="' . Enchantments($char['ID'], $equipment['SHOULDER']) . '"></a>';
						}

						if($equipment['CLOAK'] == 0)
						{
							$cloak = '<img src="img/icons/slots/cloak.png" width="35" class="icon" title="Cloak">';
						}
						else
						{
							$cloak = '<a href="http://wotlk.openwow.com/item=' . $equipment['CLOAK'] . '" rel="' . Enchantments($char['ID'], $equipment['CLOAK']) . '"></a>';
						}

						if($equipment['CHEST'] == 0)
						{
							$chest = '<img src="img/icons/slots/chest.png" width="35" class="icon" title="Chest">';
						}
						else
						{
							$chest = '<a href="http://wotlk.openwow.com/item=' . $equipment['CHEST'] . '" rel="' . Enchantments($char['ID'], $equipment['CHEST']) . '"></a>';
						}

						if($equipment['SHIRT'] == 0)
						{
							$shirt = '<img src="img/icons/slots/shirt.png" width="35" class="icon" title="Shirt">';
						}
						else
						{
							$shirt = '<a href="http://wotlk.openwow.com/item=' . $equipment['SHIRT'] . '" rel="' . Enchantments($char['ID'], $equipment['SHIRT']) . '"></a>';
						}

						if($equipment['TABARD'] == 0)
						{
							$tabard = '<img src="img/icons/slots/tabard.png" width="35" class="icon" title="Tabard">';
						}
						else
						{
							$tabard = '<a href="http://wotlk.openwow.com/item=' . $equipment['TABARD'] . '" rel="' . Enchantments($char['ID'], $equipment['TABARD']) . '"></a>';
						}

						if($equipment['WRIST'] == 0)
						{
							$wrist = '<img src="img/icons/slots/wrist.png" width="35" class="icon" title="Wrist">';
						}
						else
						{
							$wrist = '<a href="http://wotlk.openwow.com/item=' . $equipment['WRIST'] . '" rel="' . Enchantments($char['ID'], $equipment['WRIST']) . '"></a>';
						}

						if($equipment['HANDS'] == 0)
						{
							$hands = '<img src="img/icons/slots/hands.png" width="35" class="icon" title="Hands">';
						}
						else
						{
							$hands = '<a href="http://wotlk.openwow.com/item=' . $equipment['HANDS'] . '" rel="' . Enchantments($char['ID'], $equipment['HANDS']) . '"></a>';
						}

						if($equipment['WAIST'] == 0)
						{
							$waist = '<img src="img/icons/slots/waist.png" width="35" class="icon" title="Waist">';
						}
						else
						{
							$waist = '<a href="http://wotlk.openwow.com/item=' . $equipment['WAIST'] . '" rel="' . Enchantments($char['ID'], $equipment['WAIST']) . '"></a>';
						}

						if($equipment['LEGS'] == 0)
						{
							$legs = '<img src="img/icons/slots/legs.png" width="35" class="icon" title="Legs">';
						}
						else
						{
							$legs = '<a href="http://wotlk.openwow.com/item=' . $equipment['LEGS'] . '" rel="' . Enchantments($char['ID'], $equipment['LEGS']) . '"></a>';
						}

						if($equipment['FEET'] == 0)
						{
							$feet = '<img src="img/icons/slots/feet.png" width="35" class="icon" title="Feet">';
						}
						else
						{
							$feet = '<a href="http://wotlk.openwow.com/item=' . $equipment['FEET'] . '" rel="' . Enchantments($char['ID'], $equipment['FEET']) . '"></a>';
						}

						if($equipment['RING1'] == 0)
						{
							$ring = '<img src="img/icons/slots/ring.png" width="35" class="icon" title="Ring 1">';
						}
						else
						{
							$ring = '<a href="http://wotlk.openwow.com/item=' . $equipment['RING1'] . '" rel="' . Enchantments($char['ID'], $equipment['RING1']) . '"></a>';
						}

						if($equipment['RING2'] == 0)
						{
							$ring2 = '<img src="img/icons/slots/ring.png" width="35" class="icon" title="Ring 2">';
						}
						else
						{
							$ring2 = '<a href="http://wotlk.openwow.com/item=' . $equipment['RING2'] . '" rel="' . Enchantments($char['ID'], $equipment['RING2']) . '"></a>';
						}

						if($equipment['TRINKET1'] == 0)
						{
							$trinket = '<img src="img/icons/slots/trinket.png" width="35" class="icon" title="Trinket 1">';
						}
						else
						{
							$trinket = '<a href="http://wotlk.openwow.com/item=' . $equipment['TRINKET1'] . '" rel="' . Enchantments($char['ID'], $equipment['TRINKET1']) . '"></a>';
						}

						if($equipment['TRINKET2'] == 0)
						{
							$trinket2 = '<img src="img/icons/slots/trinket.png" width="35" class="icon" title="Trinket 2">';
						}
						else
						{
							$trinket2 = '<a href="http://wotlk.openwow.com/item=' . $equipment['TRINKET2'] . '" rel="' . Enchantments($char['ID'], $equipment['TRINKET2']) . '"></a>';
						}

						if($equipment['MAINHAND'] == 0)
						{
							$mainhand = '<img src="img/icons/slots/mainhand.png" width="35" class="icon" title="Main Hand">';
						}
						else
						{
							$mainhand = '<a href="http://wotlk.openwow.com/item=' . $equipment['MAINHAND'] . '" rel="' . Enchantments($char['ID'], $equipment['MAINHAND']) . '"></a>';
						}

						if($equipment['OFFHAND'] == 0)
						{
							$offhand = '<img src="img/icons/slots/offhand.png" width="35" class="icon" title="Off Hand">';
						}
						else
						{
							$offhand = '<a href="http://wotlk.openwow.com/item=' . $equipment['OFFHAND'] . '" rel="' . Enchantments($char['ID'], $equipment['OFFHAND']) . '"></a>';
						}

						if($equipment['RANGED'] == 0)
						{
							$ranged = '<img src="img/icons/slots/ranged.png" width="35" class="icon" title="Ranged">';
						}
						else
						{
							$ranged = '<a href="http://wotlk.openwow.com/item=' . $equipment['RANGED'] . '" rel="' . Enchantments($char['ID'], $equipment['RANGED']) . '"></a>';
						}



						$guild = $con_character->prepare('SELECT COUNT(*) FROM guild_member WHERE guid = :guid');
						$guild->execute(array(
							':guid' => $char['ID']
						));

						if($guild->fetchColumn() == 1)
						{
							$guild = $con_character->prepare('SELECT * FROM guild_member WHERE guid = :guid');
							$guild->execute(array(
								':guid' => $char['ID']
							));

							$result = $guild->fetchAll(PDO::FETCH_ASSOC);
							
							foreach($result as $gid)
							{
								$guild = $con_character->prepare('SELECT * FROM guild WHERE guildid = :gid');
								$guild->execute(array(
									':gid' => $gid['guildid']
								));

								$result = $guild->fetchAll(PDO::FETCH_ASSOC);

								foreach($result as $guild)
								{
									$guild = '< <span class="green">' . $guild['name'] . '</span> >';
								}
							}
						}
						else
						{
							$guild = '<span class="red">< NO GUILD ></span>';
						}



						$stats = $con_character->prepare('SELECT COUNT(*) FROM character_stats WHERE guid = :guid');
						$stats->execute(array(
							':guid' => $char['ID']
						));

						if($stats->fetchColumn() == 1)
						{
							$stats = $con_character->prepare('SELECT * FROM character_stats WHERE guid = :guid');
							$stats->execute(array(
								':guid' => $char['ID']
							));

							$result = $stats->fetchAll(PDO::FETCH_ASSOC);

							foreach($result as $stat)
							{
								$strength  = $stat['strength'];
								$agility   = $stat['agility'];
								$stamina   = $stat['stamina'];
								$intellect = $stat['intellect'];
								$spirit    = $stat['spirit'];
								$armor     = $stat['armor'];
							}
						}
						else
						{
							$strength  = 0;
							$agility   = 0;
							$stamina   = 0;
							$intellect = 0;
							$spirit    = 0;
							$armor     = 0;
						}

						$glyph_id = array(
							82  => 40923,
							161 => 40896,
							162 => 40897,
							163 => 40899,
							164 => 40900,
							165 => 40901,
							166 => 40902,
							167 => 40903,
							168 => 40906,
							169 => 40908,
							170 => 40909,
							171 => 40912,
							172 => 40913,
							173 => 40914,
							174 => 40915,
							175 => 40916,
							176 => 40919,
							177 => 40920,
							178 => 40921,
							179 => 40922,
							180 => 40923,
							181 => 40924,
							183 => 41092,
							184 => 41094,
							185 => 41095,
							186 => 41096,
							187 => 41097,
							188 => 41098,
							189 => 41099,
							190 => 41100,
							191 => 41101,
							192 => 41102,
							193 => 41103,
							194 => 41104,
							195 => 41105,
							196 => 41106,
							197 => 41107,
							198 => 41108,
							199 => 41109,
							200 => 41110,
							211 => 41541,
							212 => 41517,
							213 => 41518,
							214 => 41524,
							215 => 41526,
							216 => 41527,
							217 => 41529,
							218 => 41530,
							219 => 41531,
							220 => 41532,
							221 => 41547,
							222 => 41533,
							223 => 41534,
							224 => 41535,
							225 => 41537,
							226 => 41536,
							227 => 41538,
							228 => 41539,
							229 => 41540,
							230 => 41552,
							231 => 41542,
							251 => 42396,
							252 => 42397,
							253 => 42398,
							254 => 42399,
							255 => 42400,
							256 => 42401,
							257 => 42402,
							258 => 42403,
							259 => 42404,
							260 => 42405,
							261 => 42406,
							262 => 42407,
							263 => 42408,
							264 => 42409,
							265 => 42410,
							266 => 42411,
							267 => 42412,
							268 => 42414,
							269 => 42415,
							270 => 42416,
							271 => 42417,
							272 => 42453,
							273 => 42454,
							274 => 42455,
							275 => 42456,
							276 => 42457,
							277 => 42458,
							278 => 42459,
							279 => 42460,
							280 => 42461,
							281 => 42462,
							282 => 42463,
							283 => 42464,
							284 => 42465,
							285 => 42466,
							286 => 42467,
							287 => 42468,
							288 => 42469,
							289 => 42470,
							290 => 42471,
							291 => 42472,
							292 => 42473,
							311 => 42734,
							312 => 42735,
							313 => 42736,
							314 => 42737,
							315 => 42738,
							316 => 42739,
							317 => 42740,
							318 => 42741,
							319 => 42742,
							320 => 42743,
							321 => 42744,
							322 => 42745,
							323 => 42746,
							324 => 42747,
							325 => 42748,
							326 => 42749,
							327 => 42750,
							328 => 42751,
							329 => 42752,
							330 => 42753,
							331 => 42754,
							351 => 42897,
							352 => 42898,
							353 => 42899,
							354 => 42900,
							355 => 42901,
							356 => 42902,
							357 => 42903,
							358 => 42904,
							359 => 42905,
							360 => 42906,
							361 => 42907,
							362 => 42908,
							363 => 42909,
							364 => 42910,
							365 => 42911,
							366 => 42912,
							367 => 42913,
							368 => 42914,
							369 => 42915,
							370 => 42916,
							371 => 42917,
							391 => 42954,
							392 => 42955,
							393 => 42956,
							394 => 42957,
							395 => 42958,
							396 => 42959,
							397 => 42960,
							398 => 42961,
							399 => 42962,
							400 => 42963,
							401 => 42964,
							402 => 42965,
							403 => 42966,
							404 => 42967,
							405 => 42968,
							406 => 42969,
							407 => 42970,
							408 => 42971,
							409 => 42972,
							410 => 42973,
							411 => 42974,
							431 => 43316,
							432 => 43334,
							433 => 43335,
							434 => 43331,
							435 => 43332,
							439 => 43338,
							440 => 43350,
							441 => 43351,
							442 => 43356,
							443 => 43355,
							444 => 43354,
							445 => 43339,
							446 => 43357,
							447 => 43360,
							448 => 43359,
							449 => 43362,
							450 => 43361,
							451 => 43364,
							452 => 43365,
							453 => 43340,
							454 => 43366,
							455 => 43367,
							456 => 43368,
							457 => 43369,
							458 => 43342,
							459 => 43370,
							460 => 43371,
							461 => 43373,
							462 => 43372,
							463 => 43374,
							464 => 43376,
							465 => 43377,
							466 => 43343,
							467 => 43378,
							468 => 43379,
							469 => 43380,
							470 => 43381,
							473 => 43385,
							474 => 43344,
							475 => 43386,
							476 => 43388,
							477 => 43389,
							478 => 43390,
							479 => 43391,
							480 => 43392,
							481 => 43393,
							482 => 43394,
							483 => 43395,
							484 => 43396,
							485 => 43397,
							486 => 43398,
							487 => 43399,
							488 => 43400,
							489 => 43421,
							490 => 43412,
							491 => 43413,
							492 => 43414,
							493 => 43415,
							494 => 43416,
							495 => 43417,
							496 => 43418,
							497 => 43419,
							498 => 43420,
							499 => 43422,
							500 => 43423,
							501 => 43424,
							502 => 43425,
							503 => 43426,
							504 => 43427,
							505 => 43428,
							506 => 43429,
							507 => 43430,
							508 => 43431,
							509 => 43432,
							511 => 43538,
							512 => 43533,
							513 => 43534,
							514 => 43535,
							515 => 43536,
							516 => 43537,
							518 => 43539,
							519 => 43541,
							520 => 43542,
							521 => 43543,
							522 => 43544,
							523 => 43545,
							524 => 43546,
							525 => 43547,
							526 => 43548,
							527 => 43549,
							528 => 43550,
							529 => 43551,
							530 => 43552,
							531 => 43553,
							532 => 43554,
							551 => 43674,
							552 => 43725,
							553 => 43672,
							554 => 43671,
							555 => 44432,
							556 => 43825,
							557 => 43826,
							558 => 43827,
							559 => 43867,
							560 => 43868,
							561 => 43869,
							571 => 43673,
							591 => 44684,
							611 => 44920,
							612 => 44923,
							613 => 44922,
							631 => 44928,
							651 => 44955,
							671 => 45601,
							672 => 45602,
							673 => 45603,
							674 => 45604,
							675 => 45622,
							676 => 45623,
							677 => 45625,
							691 => 45731,
							692 => 45732,
							693 => 45733,
							694 => 45734,
							695 => 45735,
							696 => 45736,
							697 => 45737,
							698 => 45738,
							699 => 45739,
							700 => 45740,
							701 => 45741,
							702 => 45742,
							703 => 45743,
							704 => 45744,
							705 => 45745,
							706 => 45746,
							707 => 45747,
							708 => 45753,
							709 => 45755,
							710 => 45756,
							711 => 45757,
							712 => 45758,
							713 => 45760,
							714 => 45761,
							715 => 45762,
							716 => 45764,
							731 => 45766,
							732 => 45767,
							733 => 45768,
							734 => 45769,
							736 => 45771,
							737 => 45772,
							751 => 45775,
							752 => 45776,
							753 => 45777,
							754 => 45778,
							755 => 45779,
							756 => 45780,
							757 => 45781,
							758 => 45782,
							759 => 45783,
							760 => 45785,
							761 => 45789,
							762 => 45790,
							763 => 45792,
							764 => 45793,
							765 => 45794,
							766 => 45795,
							767 => 45797,
							768 => 45799,
							769 => 45800,
							770 => 45803,
							771 => 45804,
							772 => 45805,
							773 => 45806,
							791 => 45908,
							811 => 46372,
							831 => 48720,
							851 => 49084,
							871 => 50045,
							891 => 50125,
							911 => 50077,
							0   => 0
						);

						
	
						// FIX THE GLYPHS

						$spec = $con_character->prepare('SELECT COUNT(*) FROM characters WHERE guid = :guid');
						$spec->execute(array(
							':guid' => $char['ID']
						));

						if($spec->fetchColumn() == 1)
						{
							$spec = $con_character->prepare('SELECT * FROM characters WHERE guid = :guid');
							$spec->execute(array(
								':guid' => $char['ID']
							));

							$result = $spec->fetchAll(PDO::FETCH_ASSOC);

							foreach($result as $cid)
							{
								$glyph = $con_character->prepare('SELECT * FROM character_glyphs WHERE guid = :guid AND spec = :spec');
								$glyph->execute(array(
									':guid' => $cid['guid'],
									':spec' => $cid['activespec']
								));

								$result = $glyph->fetchAll(PDO::FETCH_ASSOC);

								foreach($result as $glyph)
								{
									$glyphname = $con_world->prepare('SELECT entry, name FROM item_template WHERE entry in (:glyphid1, :glyphid2, :glyphid3, :glyphid4, :glyphid5, :glyphid6)');
									$glyphname->execute(array(
										':glyphid1' => $glyph_id[$glyph['glyph1']],
										':glyphid2' => $glyph_id[$glyph['glyph2']],
										':glyphid3' => $glyph_id[$glyph['glyph3']],
										':glyphid4' => $glyph_id[$glyph['glyph4']],
										':glyphid5' => $glyph_id[$glyph['glyph5']],
										':glyphid6' => $glyph_id[$glyph['glyph6']]
									));

									$result = $glyphname->fetchAll(PDO::FETCH_ASSOC);

									foreach($result as $name => $val)
									{
										if($name == 5)
										{
											// Minor
											$glyph6 = '<tr><td><a href="http://wotlk.openwow.com/?item=' . $val['entry'] . '"></a></td><td>' . $val['name'] . '</td></tr>';
										}
										elseif($name == 4)
										{
											// Major
											$glyph5 = '<tr><td><a href="http://wotlk.openwow.com/?item=' . $val['entry'] . '"></a></td><td>' . $val['name'] . '</td></tr>';
										}
										elseif($name == 3)
										{
											// Minor
											$glyph4 = '<tr><td><a href="http://wotlk.openwow.com/?item=' . $val['entry'] . '"></a></td><td>' . $val['name'] . '</td></tr>';
										}
										elseif($name == 2)
										{
											// Major
											$glyph3 = '<tr><td><a href="http://wotlk.openwow.com/?item=' . $val['entry'] . '"></a></td><td>' . $val['name'] . '</td></tr>';
										}
										elseif($name == 1)
										{
											// Minor
											$glyph2 = '<tr><td><a href="http://wotlk.openwow.com/?item=' . $val['entry'] . '"></a></td><td>' . $val['name'] . '</td></tr>';
										}
										elseif($name == 0)
										{
											// Major
											$glyph1 = '<tr><td><a href="http://wotlk.openwow.com/?item=' . $val['entry'] . '"></a></td><td>' . $val['name'] . '</td></tr>';
										}
									}
								}
							}
						}

						


							

						echo '
							<div class="char-result column small-12 medium-12 large-6">	
								<!-- Char Information -->	
								<div class="char-info">
									<div class="char-name">
										' . $char['NAME'] . '
									</div>

									<div class="char-guild">
										' . $guild . '
									</div>

									<div class="char-level">
										<span class="blue">Level ' . $char['LEVEL'] . '</span> ' . $char['RACE'] . ' ' . $char['CLASS'] . '
									</div>

									<div class="char-hp">
										' . $char['HEALTH'] . ' / ' . $char['HEALTH'] . ' HP
									</div>

									' . $power . '

									<div class="base-stats">
										<div class="base-header">
											Base Stats
											<div class="base-option">
												<img src="img/icons/menu-icon.png" width="20">
											</div>
										</div>

										<div class="base-content">
											<div class="stat">
												<div class="stat-left">
													Strength
												</div>

												<div class="stat-right">
													' . $strength . '
												</div>
											</div>

											<div class="stat">
												<div class="stat-left">
													Agility
												</div>

												<div class="stat-right">
													' . $agility . '
												</div>
											</div>

											<div class="stat">
												<div class="stat-left">
													Stamina
												</div>

												<div class="stat-right">
													' . $stamina . '
												</div>
											</div>

											<div class="stat">
												<div class="stat-left">
													Intellect
												</div>

												<div class="stat-right">
													' . $intellect . '
												</div>
											</div>

											<div class="stat">
												<div class="stat-left">
													Spirit
												</div>

												<div class="stat-right">
													' . $spirit . '
												</div>
											</div>

											<div class="stat">
												<div class="stat-left">
													Armor
												</div>

												<div class="stat-right">
													' . $armor . '
												</div>
											</div>
										</div>
									</div>
								</div>

								<!-- Char Slots Left -->
								<div class="char-slot-left1">
									' . $head . '
								</div>

								<div class="char-slot-left2">
									' . $neck . '
								</div>

								<div class="char-slot-left3">
									' . $shoulder . '
								</div>

								<div class="char-slot-left4">
									' . $cloak . '
								</div>

								<div class="char-slot-left5">
									' . $chest . '
								</div>

								<div class="char-slot-left6">
									' . $shirt . '
								</div>

								<div class="char-slot-left7">
									' . $tabard . '
								</div>

								<div class="char-slot-left8">
									' . $wrist . '
								</div>

								<!-- Char Slots Right -->
								<div class="char-slot-right1">
									' . $hands . '
								</div>

								<div class="char-slot-right2">
									' . $waist . '
								</div>

								<div class="char-slot-right3">
									' . $legs . '
								</div>

								<div class="char-slot-right4">
									' . $feet . '
								</div>

								<div class="char-slot-right5">
									' . $ring . '
								</div>

								<div class="char-slot-right6">
									' . $ring2 . '
								</div>

								<div class="char-slot-right7">
									' . $trinket . '
								</div>

								<div class="char-slot-right8">
									' . $trinket2 . '
								</div>

								<!-- Char Slots Bottom -->
								<div class="char-slot-bottom1">
									' . $mainhand . '
								</div>

								<div class="char-slot-bottom2">
									' . $offhand . '
								</div>

								<div class="char-slot-bottom3">
									 ' . $ranged . '
								</div>
							</div>

							<div class="char-stats column small-12 medium-12 large-6">
								<div class="char-stats-header">
									PvP Information
								</div>

								<div class="char-stats-content">
									<div class="stat">
										<div class="stat-left">
											Honor Kills Today
										</div>

										<div class="stat-right">
											' . $char['KILLS_TODAY'] . '
										</div>
									</div>

									<div class="stat">
										<div class="stat-left">
											Honor Kills Yesterday
										</div>

										<div class="stat-right">
											' . $char['KILLS_YESTERDAY'] . '
										</div>
									</div>

									<div class="stat">
										<div class="stat-left">
											Honor Kills Total
										</div>

										<div class="stat-right">
											' . $char['KILLS_TOTAL'] . '
										</div>
									</div>
									<hr>
									<div class="stat">
										<div class="stat-left">
											Honor Points Today
										</div>

										<div class="stat-right">
											' . $char['HONOR_TODAY'] . '
										</div>
									</div>

									<div class="stat">
										<div class="stat-left">
											Honor Points Yesterday
										</div>

										<div class="stat-right">
											' . $char['HONOR_YESTERDAY'] . '
										</div>
									</div>

									<div class="stat">
										<div class="stat-left">
											Honor Points Total
										</div>

										<div class="stat-right">
											' . $char['HONOR_TOTAL'] . '
										</div>
									</div>
								</div>
							</div>

							<div class="char-glyphs column small-12 medium-12 large-12">
								<div class="char-glyphs-header">
									Glyphs
								</div>

								<div class="char-glyphs-content">
									<table>
										' . @$glyph4 . '
										' . @$glyph3 . '
										' . @$glyph5 . '
									</table>
									<table>
										' . @$glyph2 . '
										' . @$glyph1 . '
										' . @$glyph6 . '
									</table>									
								</div>
							</div>';
					}
				}
			}
			else
			{
				echo '<span class="red">Character not found in our database!</span>';
			}
		}
		else
		{
			echo '<span class="red">Please insert a character name!</span>';
		}
	}
}

?>