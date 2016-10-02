<?php

include('../inc/settings.php');

/*
	Connect to Web Database
*/

try
{
	$con_web = new PDO('mysql:host=' . $DBConfig['WEB_HOST'] . ';dbname=' . $DBConfig['WEB_DB'] . ';charset=UTF8', $DBConfig['WEB_USER'], $DBConfig['WEB_PASS']);
	
	if($config['DEBUG_MODE'] == true)
	{
		$con_web->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
	}
}
catch(PDOException $e)
{
	die($e->getMessage());
}



/*
	Connect to Realmd Database
*/

try
{
	$con_realmd = new PDO('mysql:host=' . $DBConfig['REALMD_HOST'] . ';dbname=' . $DBConfig['REALMD_DB'] . ';charset=UTF8', $DBConfig['REALMD_USER'], $DBConfig['REALMD_PASS']);
	
	if($config['DEBUG_MODE'] == true)
	{
		$con_realmd->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
	}
}
catch(PDOException $e)
{
	die($e->getMessage());
}



/*
	Connect to Character Database
*/

try
{
	$con_character = new PDO('mysql:host=' . $DBConfig['CHAR_HOST'] . ';dbname=' . $DBConfig['CHAR_DB'] . ';charset=UTF8', $DBConfig['CHAR_USER'], $DBConfig['CHAR_PASS']);
	
	if($config['DEBUG_MODE'] == true)
	{
		$con_character->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
	}
}
catch(PDOException $e)
{
	die($e->getMessage());
}



/*
	Connect to World Database
*/

try
{
	$con_world = new PDO('mysql:host=' . $DBConfig['WORLD_HOST'] . ';dbname=' . $DBConfig['WORLD_DB'] . ';charset=UTF8', $DBConfig['WORLD_USER'], $DBConfig['WORLD_PASS']);
	
	if($config['DEBUG_MODE'] == true)
	{
		$con_world->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
	}
}
catch(PDOException $e)
{
	die($e->getMessage());
}

?>