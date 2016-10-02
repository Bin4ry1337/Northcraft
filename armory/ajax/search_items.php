<?php

include('../inc/config.php');

if(!empty($_POST['searchVal']))
{
	global $con_world;

	$name = ucfirst(strtolower($_POST['searchVal']));

	$data = $con_world->prepare('SELECT * FROM item_template WHERE name LIKE ? LIMIT 15');
	$data->execute(array(
		"%$name%"
	));

	echo '<table>
			<th>Name</th>
			<th>ItemID</th>';

	while($result = $data->fetchAll(PDO::FETCH_ASSOC))
	{
		foreach($result as $search)
		{	
			$quality = array(
				0 => '<span class="poor">' . $search['name'] . '</span>',
				1 => '<span class="common">' . $search['name'] . '</span>',
				2 => '<span class="uncommon">' . $search['name'] . '</span>',
				3 => '<span class="rare">' . $search['name'] . '</span>',
				4 => '<span class="epic">' . $search['name'] . '</span>',
				5 => '<span class="legendary">' . $search['name'] . '</span>',
				6 => '<span class="artifact">' . $search['name'] . '</span>',
				7 => '<span class="heirloom">' . $search['name'] . '</span>'
			);

			echo '<tr>
				<td><a href="database.php?item=' . $search['entry'] . '" rel="item=' . $search['entry'] . '">' . $quality[$search['Quality']] . '</a></td>
				<td>' . $search['entry'] . '</td>
			</tr>';
		}
	}

	echo '</table>';

}

?>