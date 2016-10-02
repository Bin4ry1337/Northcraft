<?php

include('../inc/config.php');

if(!empty($_POST['searchVal']))
{
	global $con_character;

	$name = ucfirst($_POST['searchVal']);

	$data = $con_character->prepare('SELECT * FROM characters WHERE name LIKE ? LIMIT 15');
	$data->execute(array(
		"%$name%"
	));

	$race = array(
		1  => '<img src="img/icons/race/human-male.png" width="23" title="Human">',
		2  => '<img src="img/icons/race/orc-male.png" width="23" title="Orc">',
		3  => '<img src="img/icons/race/dwarf-male.png" width="23" title="Dwarf">',
		4  => '<img src="img/icons/race/nightelf-male.png" width="23" title="Night Elf">',
		5  => '<img src="img/icons/race/undead-male.png" width="23" title="Undead">',
		6  => '<img src="img/icons/race/tauren-male.png" width="23" title="Tauren">',
	    7  => '<img src="img/icons/race/gnome-male.png" width="23" title="Gnome">',
	    8  => '<img src="img/icons/race/troll-male.png" width="23" title="Troll">',
	    10 => '<img src="img/icons/race/bloodelf-male.png" width="23" title="Blood Elf">',
	    11 => '<img src="img/icons/race/draenei-male.png" width="23" title="Draenei">'
	);

	$class = array(
		1  => '<img src="img/icons/class/warrior.png" width="23" title="Warrior">',
		2  => '<img src="img/icons/class/paladin.png" width="23" title="Paladin">',
		3  => '<img src="img/icons/class/hunter.png" width="23" title="Hunter">',
		4  => '<img src="img/icons/class/rogue.png" width="23" title="Rogue">',
		5  => '<img src="img/icons/class/priest.png" width="23" title="Priest">',
		6  => '<img src="img/icons/class/deathknight.png" width="23" title="Death Knight">',
		7  => '<img src="img/icons/class/shaman.png" width="23" title="Shaman">',
		8  => '<img src="img/icons/class/mage.png" width="23" title="Mage">',
		9  => '<img src="img/icons/class/warlock.png" width="23" title="Warlock">',
		11 => '<img src="img/icons/class/druid.png" width="23" title="Druid">'
	);

	$faction = array(
		1  => '<img src="img/icons/faction/alliance.png" width="23" title="Alliance">',
		2  => '<img src="img/icons/faction/horde.png" width="23" title="Horde">',
		3  => '<img src="img/icons/faction/alliance.png" width="23" title="Alliance">',
		4  => '<img src="img/icons/faction/alliance.png" width="23" title="Alliance">',
		5  => '<img src="img/icons/faction/horde.png" width="23" title="Horde">',
		6  => '<img src="img/icons/faction/horde.png" width="23" title="Horde">',
		7  => '<img src="img/icons/faction/alliance.png" width="23" title="Alliance">',
		8  => '<img src="img/icons/faction/horde.png" width="23" title="Horde">',
		10 => '<img src="img/icons/faction/horde.png" width="23" title="Horde">',
		11 => '<img src="img/icons/faction/alliance.png" width="23" title="Alliance">'
	);

	echo '<table>
			<th>Character</th>
			<th>Faction</th>
			<th>Race</th>
			<th>Class</th>
			<th>Level</th>';

	while($result = $data->fetchAll(PDO::FETCH_ASSOC))
	{
		foreach($result as $search)
		{
			echo '<tr>
				<td><a href="?character=' . $search['name'] . '">' . $search['name'] . '</a></td>
				<td>' . $faction[$search['race']] . '</td>
				<td>' . $race[$search['race']] . '</td>
				<td>' . $class[$search['class']] . '</td>
				<td><span class="yellow">' . $search['level'] . '</span></td>
			</tr>';
		}
	}

	echo '</table>';

}

?>