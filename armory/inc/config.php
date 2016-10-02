<?php

/*
####################################
#	  Armory Database Settings     #
####################################
*/

$DBConfig = array(
	//Website Database
	'WEB_HOST'    => 'localhost',
	'WEB_USER'    => 'root',
	'WEB_PASS'    => '',
	'WEB_DB'      => 'northcraft',

	//Realmd Database
	'REALMD_HOST' => 'localhost',
	'REALMD_USER' => 'root',
	'REALMD_PASS' => '',
	'REALMD_DB'   => 'ptr_realmd',

	//Character Database
	'CHAR_HOST'   => 'localhost',
	'CHAR_USER'   => 'root',
	'CHAR_PASS'   => '',
	'CHAR_DB'     => 'ptr_characters',

	//World Database
	'WORLD_HOST'  => 'localhost',
	'WORLD_USER'  => 'root',
	'WORLD_PASS'  => '',
	'WORLD_DB'    => 'ptr_world'
);

$GeneralConfig = array(
	'REALMLIST' => 'set realmlist logon.worldofnorthcraft.com'
);

$config = array(
	'DEBUG_MODE' => true
);

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