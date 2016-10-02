<?php

/*
####################################
#	Database Connection Settings   #
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



/*
####################################
#	      General Settings         #
####################################
*/

$GeneralConfig = array(
	'REALMLIST' => 'set realmlist logon.worldofnorthcraft.com',
	'FACEBOOK'  => '',
	'YOUTUBE'   => '',
	'REDDIT'    => 'https://www.reddit.com/r/worldofnorthcraft/',
	'DISCORD'   => '<div class="content-box column small-12 medium-4">
						<iframe src="https://discordapp.com/widget?id=231834266382761987&theme=dark" width="100%" height="500" allowtransparency="true" frameborder="0"></iframe>
					</div>'
);



/*
####################################
#	       Debug Settings          #
####################################
*/

$config = array(
	'DEBUG_MODE' => true
);

?>