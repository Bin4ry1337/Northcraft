<?php

function Register()
{
	if(isset($_POST['register']))
	{
		if(!empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['re-password']))
		{
			global $con_web;
			global $con_realmd;

			$username    = $_POST['username'];
			$email       = $_POST['email'];
			$password    = $_POST['password'];
			$re_password = $_POST['re-password'];
			$lastip      = $_SERVER['REMOTE_ADDR'];
			$time        = time();
			$date        = date('Y-m-d H:i:s', $time);
			$expansion   = 2;
			$captcha     = $_POST['g-recaptcha-response'];
			$secret      = '6Ld9gigTAAAAAHoAk4Kp6LiTTIGj34TwKc3RXPz1';
			$avatar      = 'http://puu.sh/qRNKe/458ccf7bc0.png';
			@$checkbox   = $_POST['agreement'];

			if(strlen($username) && strlen($password) && strlen($re_password) < 33)
			{
				if(strlen($email) < 255)
				{
					if(isset($checkbox))
					{
						if($captcha)
						{
							$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . $secret . "&response=" . $captcha . "&remoteip=" . $lastip);
							$decode   = json_decode($response, true);

							if(intval($decode['success']) == 1)
							{
								if($re_password == $password)
								{
									$data = $con_realmd->prepare('SELECT COUNT(*) FROM account WHERE username = :username OR email = :email');
									$data->execute(array(
										':username' => $username,
										':email'    => $email
									));

									if($data->fetchColumn() == 0)
									{
										if(filter_var($email, FILTER_VALIDATE_EMAIL))
										{
											$data = $con_realmd->prepare('INSERT INTO account (username, sha_pass_hash, email, last_ip, joindate, last_login, expansion) VALUES(:username, :password, :email, :last_ip, :joindate, CURRENT_TIMESTAMP, :expansion)');
											$data->execute(array(
												':username'  => $username,
												':password'  => sha1(strtoupper($username) . ":" . strtoupper($password)),
												':email'     => $email,
												':last_ip'   => $lastip,
												':joindate'  => $date,
												':expansion' => $expansion
											));

											$data = $con_web->prepare('INSERT INTO avatar (username, url) VALUES(:username, :avatar)');
											$data->execute(array(
												':username' => $username,
												':avatar'   => $avatar
											));

											echo '<div data-alert class="alert-box success radius">Successfully registered!<a href="#" class="close">&times;</a></div>';
										}
										else
										{
											echo '<div data-alert class="alert-box alert radius">Email is not a valid email!<a href="#" class="close">&times;</a></div>';
										}
									}
									else
									{
										echo '<div data-alert class="alert-box alert radius">Username or Email already taken!<a href="#" class="close">&times;</a></div>';
									}
								}
								else
								{
									echo '<div data-alert class="alert-box alert radius">Passwords doesn\'t match!<a href="#" class="close">&times;</a></div>';
								}
							}
							else
							{
								echo '<div data-alert class="alert-box alert radius">Captcha is wrong!<a href="#" class="close">&times;</a></div>';
							}
						}
						else
						{
							echo '<div data-alert class="alert-box alert radius">Please fill in the captcha!<a href="#" class="close">&times;</a></div>';
						}
					}
					else
					{
						echo '<div data-alert class="alert-box alert radius">Please accept our Terms of Service and Privacy Policy!<a href="#" class="close">&times;</a></div>';
					}
				}
				else
				{
					echo '<div data-alert class="alert-box alert radius">Email address is too long!<a href="#" class="close">&times;</a></div>';
				}
			}
			else
			{
				echo '<div data-alert class="alert-box alert radius">Username or password is too long!<a href="#" class="close">&times;</a></div>';
			}
		}
		else
		{
			echo '<div data-alert class="alert-box alert radius">All fields are required!<a href="#" class="close">&times;</a></div>';
		}
	}
}



function Login()
{
	if(isset($_POST['login']))
	{
		if(!empty($_POST['username']) && !empty($_POST['password']))
		{
			global $con_web;
			global $con_realmd;

			$username = $_POST['username'];
			$password = $_POST['password'];
			$lastip   = $_SERVER['REMOTE_ADDR'];
			$captcha  = $_POST['g-recaptcha-response'];
			$secret   = '6Ld8gigTAAAAAHstWYGlsW0nzhv6gmdMBGIfpmX-';
			$avatar   = 'http://puu.sh/qRNKe/458ccf7bc0.png';

			if(strlen($username) && strlen($password) < 33)
			{
				if($captcha)
				{
					$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . $secret . "&response=" . $captcha . "&remoteip=" . $lastip);
					$decode   = json_decode($response, true);
					
					if(intval($decode['success']) == 1)
					{
						$data = $con_realmd->prepare('SELECT COUNT(*) FROM account WHERE username = :username AND sha_pass_hash = :password');
						$data->execute(array(
							':username' => $username,
							':password' => sha1(strtoupper($username) . ":" . strtoupper($password))
						));

						if($data->fetchColumn() == 1)
						{
							$data = $con_web->prepare('SELECT COUNT(*) FROM avatar WHERE username = :username');
							$data->execute(array(
								':username' => $username
							));

							if($data->fetchColumn() == 0)
							{
								// Set default avatar if no row is found
								$data = $con_web->prepare('INSERT INTO avatar (username, url) VALUES(:username, :avatar)');
								$data->execute(array(
									':username' => $username,
									':avatar'   => $avatar
								));
							}

							echo '<div data-alert class="alert-box success radius">Success, Logged in!<a href="#" class="close">&times;</a></div>';
							$_SESSION['username'] = $username;
							echo '<meta http-equiv="refresh" content="1">';
						}
						else
						{
							echo '<div data-alert class="alert-box alert radius">Invalid password or username!<a href="#" class="close">&times;</a></div>';
						}
					}
					else
					{
						echo '<div data-alert class="alert-box alert radius">Captcha is wrong!<a href="#" class="close">&times;</a></div>';
					}
				}
				else
				{
					echo '<div data-alert class="alert-box alert radius">Please fill in the captcha!<a href="#" class="close">&times;</a></div>';
				}
			}
			else
			{
				echo '<div data-alert class="alert-box alert radius">Username or password is too long!<a href="#" class="close">&times;</a></div>';
			}

		}
	}
}



function Changelog()
{
	if(isset($_GET['search']))
	{
		if(!empty($_GET['search']))
		{
			global $con_web;

			$input = strtolower((int)$_GET['search']);

			$data = $con_web->prepare('SELECT * FROM changelog WHERE typeID LIKE ? LIMIT 20');
			$data->execute(array(
				"%$input%"
			));

			echo '<div class="changelog-top column small-12">
					<div class="changelog-tab-current">
						<a href="">All</a>
					</div>

					<div class="changelog-tab">
						<a href="?filter=npc">NPCs</a>
					</div>

					<div class="changelog-tab">
						<a href="?filter=items">Items</a>
					</div>

					<div class="changelog-tab">
						<a href="?filter=quests">Quests</a>
					</div>

					<div class="changelog-tab">
						<a href="?filter=spells">Spells</a>
					</div>

					<div class="changelog-tab">
						<a href="?filter=talents">Talents</a>
					</div>

					<div class="changelog-tab">
						<a href="?filter=raids">Raids</a>
					</div>

					<div class="changelog-tab">
						<a href="?filter=dungeons">Dungeons</a>
					</div>
				</div>

				<div class="changelog-botom column small-12">';

			echo '<table>
					<tr>
						<th>Revision</th>
						<th>Author</th>
						<th>Type</th>
						<th>ID</th>
						<th>DB</th>
						<th>Note</th>
						<th>Date</th>
					</tr>';

			while($result = $data->fetchAll(PDO::FETCH_ASSOC))
			{
				foreach($result as $row)
				{
					echo '<tr>
							<td>' . $row['revision'] . '</td>
							<td>' . $row['author'] . '</td>
							<td><span class="yellow">' . $row['type'] . '</span></td>
							<td>' . $row['typeID'] . '</td>
							<td>' . $row['db'] . '</td>
							<td>' . $row['note'] . '</td>
							<td>' . date('H:i - d.M, Y', $row['time']) . '</td>
						</tr>';
				}
			}

			echo '</table>
				</div>';
		}
		else
		{
			echo '<span class="red">Search was empty!</span>';
		}
	}
	else
	{
		if(isset($_GET['filter']))
		{
			$filter = $_GET['filter'];

			switch($filter)
			{
				case 'npc':
					global $con_web;

					$data = $con_web->prepare('SELECT * FROM changelog WHERE type = "NPC" ORDER BY id desc LIMIT 20');
					$data->execute();

					echo '<div class="changelog-top column small-12">
							<div class="changelog-tab">
								<a href="changelog.php">All</a>
							</div>

							<div class="changelog-tab-current">
								<a href="?filter=npc">NPCs</a>
							</div>

							<div class="changelog-tab">
								<a href="?filter=items">Items</a>
							</div>

							<div class="changelog-tab">
								<a href="?filter=quests">Quests</a>
							</div>

							<div class="changelog-tab">
								<a href="?filter=spells">Spells</a>
							</div>

							<div class="changelog-tab">
								<a href="?filter=talents">Talents</a>
							</div>

							<div class="changelog-tab">
								<a href="?filter=raids">Raids</a>
							</div>

							<div class="changelog-tab">
								<a href="?filter=dungeons">Dungeons</a>
							</div>
						</div>

						<div class="changelog-botom column small-12">';

					echo '<table>
							<tr>
								<th>Revision</th>
								<th>Author</th>
								<th>Type</th>
								<th>ID</th>
								<th>DB</th>
								<th>Note</th>
								<th>Date</th>
							</tr>';

					while($result = $data->fetchAll(PDO::FETCH_ASSOC))
					{
						foreach($result as $row)
						{
							echo '<tr>
									<td>' . $row['revision'] . '</td>
									<td>' . $row['author'] . '</td>
									<td><span class="yellow">' . $row['type'] . '</span></td>
									<td>' . $row['typeID'] . '</td>
									<td>' . $row['db'] . '</td>
									<td>' . $row['note'] . '</td>
									<td>' . date('H:i - d.M, Y', $row['time']) . '</td>
								</tr>';
						}
					}

					echo '</table>
						</div>';
				break;

				case 'items':
					global $con_web;

					$data = $con_web->prepare('SELECT * FROM changelog WHERE type = "Item" ORDER BY id desc LIMIT 20');
					$data->execute();

					echo '<div class="changelog-top column small-12">
							<div class="changelog-tab">
								<a href="changelog.php">All</a>
							</div>

							<div class="changelog-tab">
								<a href="?filter=npc">NPCs</a>
							</div>

							<div class="changelog-tab-current">
								<a href="?filter=items">Items</a>
							</div>

							<div class="changelog-tab">
								<a href="?filter=quests">Quests</a>
							</div>

							<div class="changelog-tab">
								<a href="?filter=spells">Spells</a>
							</div>

							<div class="changelog-tab">
								<a href="?filter=talents">Talents</a>
							</div>

							<div class="changelog-tab">
								<a href="?filter=raids">Raids</a>
							</div>

							<div class="changelog-tab">
								<a href="?filter=dungeons">Dungeons</a>
							</div>
						</div>

						<div class="changelog-botom column small-12">';

					echo '<table>
							<tr>
								<th>Revision</th>
								<th>Author</th>
								<th>Type</th>
								<th>ID</th>
								<th>DB</th>
								<th>Note</th>
								<th>Date</th>
							</tr>';

					while($result = $data->fetchAll(PDO::FETCH_ASSOC))
					{
						foreach($result as $row)
						{
							echo '<tr>
									<td>' . $row['revision'] . '</td>
									<td>' . $row['author'] . '</td>
									<td><span class="yellow">' . $row['type'] . '</span></td>
									<td>' . $row['typeID'] . '</td>
									<td>' . $row['db'] . '</td>
									<td>' . $row['note'] . '</td>
									<td>' . date('H:i - d.M, Y', $row['time']) . '</td>
								</tr>';
						}
					}

					echo '</table>
						</div>';
				break;

				case 'quests':
					global $con_web;

					$data = $con_web->prepare('SELECT * FROM changelog WHERE type = "Quest" ORDER BY id desc LIMIT 20');
					$data->execute();

					echo '<div class="changelog-top column small-12">
							<div class="changelog-tab">
								<a href="changelog.php">All</a>
							</div>

							<div class="changelog-tab">
								<a href="?filter=npc">NPCs</a>
							</div>

							<div class="changelog-tab">
								<a href="?filter=items">Items</a>
							</div>

							<div class="changelog-tab-current">
								<a href="?filter=quests">Quests</a>
							</div>

							<div class="changelog-tab">
								<a href="?filter=spells">Spells</a>
							</div>

							<div class="changelog-tab">
								<a href="?filter=talents">Talents</a>
							</div>

							<div class="changelog-tab">
								<a href="?filter=raids">Raids</a>
							</div>

							<div class="changelog-tab">
								<a href="?filter=dungeons">Dungeons</a>
							</div>
						</div>

						<div class="changelog-botom column small-12">';

					echo '<table>
							<tr>
								<th>Revision</th>
								<th>Author</th>
								<th>Type</th>
								<th>ID</th>
								<th>DB</th>
								<th>Note</th>
								<th>Date</th>
							</tr>';

					while($result = $data->fetchAll(PDO::FETCH_ASSOC))
					{
						foreach($result as $row)
						{
							echo '<tr>
									<td>' . $row['revision'] . '</td>
									<td>' . $row['author'] . '</td>
									<td><span class="yellow">' . $row['type'] . '</span></td>
									<td>' . $row['typeID'] . '</td>
									<td>' . $row['db'] . '</td>
									<td>' . $row['note'] . '</td>
									<td>' . date('H:i - d.M, Y', $row['time']) . '</td>
								</tr>';
						}
					}

					echo '</table>
						</div>';
				break;

				case 'spells':
					global $con_web;

					$data = $con_web->prepare('SELECT * FROM changelog WHERE type = "Spell" ORDER BY id desc LIMIT 20');
					$data->execute();

					echo '<div class="changelog-top column small-12">
							<div class="changelog-tab">
								<a href="changelog.php">All</a>
							</div>

							<div class="changelog-tab">
								<a href="?filter=npc">NPCs</a>
							</div>

							<div class="changelog-tab">
								<a href="?filter=items">Items</a>
							</div>

							<div class="changelog-tab">
								<a href="?filter=quests">Quests</a>
							</div>

							<div class="changelog-tab-current">
								<a href="?filter=spells">Spells</a>
							</div>

							<div class="changelog-tab">
								<a href="?filter=talents">Talents</a>
							</div>

							<div class="changelog-tab">
								<a href="?filter=raids">Raids</a>
							</div>

							<div class="changelog-tab">
								<a href="?filter=dungeons">Dungeons</a>
							</div>
						</div>

						<div class="changelog-botom column small-12">';

					echo '<table>
							<tr>
								<th>Revision</th>
								<th>Author</th>
								<th>Type</th>
								<th>ID</th>
								<th>DB</th>
								<th>Note</th>
								<th>Date</th>
							</tr>';

					while($result = $data->fetchAll(PDO::FETCH_ASSOC))
					{
						foreach($result as $row)
						{
							echo '<tr>
									<td>' . $row['revision'] . '</td>
									<td>' . $row['author'] . '</td>
									<td><span class="yellow">' . $row['type'] . '</span></td>
									<td>' . $row['typeID'] . '</td>
									<td>' . $row['db'] . '</td>
									<td>' . $row['note'] . '</td>
									<td>' . date('H:i - d.M, Y', $row['time']) . '</td>
								</tr>';
						}
					}

					echo '</table>
						</div>';
				break;

				case 'talents':
					global $con_web;

					$data = $con_web->prepare('SELECT * FROM changelog WHERE type = "Talent" ORDER BY id desc LIMIT 20');
					$data->execute();

					echo '<div class="changelog-top column small-12">
							<div class="changelog-tab">
								<a href="changelog.php">All</a>
							</div>

							<div class="changelog-tab">
								<a href="?filter=npc">NPCs</a>
							</div>

							<div class="changelog-tab">
								<a href="?filter=items">Items</a>
							</div>

							<div class="changelog-tab">
								<a href="?filter=quests">Quests</a>
							</div>

							<div class="changelog-tab">
								<a href="?filter=spells">Spells</a>
							</div>

							<div class="changelog-tab-current">
								<a href="?filter=talents">Talents</a>
							</div>

							<div class="changelog-tab">
								<a href="?filter=raids">Raids</a>
							</div>

							<div class="changelog-tab">
								<a href="?filter=dungeons">Dungeons</a>
							</div>
						</div>

						<div class="changelog-botom column small-12">';

					echo '<table>
							<tr>
								<th>Revision</th>
								<th>Author</th>
								<th>Type</th>
								<th>ID</th>
								<th>DB</th>
								<th>Note</th>
								<th>Date</th>
							</tr>';

					while($result = $data->fetchAll(PDO::FETCH_ASSOC))
					{
						foreach($result as $row)
						{
							echo '<tr>
									<td>' . $row['revision'] . '</td>
									<td>' . $row['author'] . '</td>
									<td><span class="yellow">' . $row['type'] . '</span></td>
									<td>' . $row['typeID'] . '</td>
									<td>' . $row['db'] . '</td>
									<td>' . $row['note'] . '</td>
									<td>' . date('H:i - d.M, Y', $row['time']) . '</td>
								</tr>';
						}
					}

					echo '</table>
						</div>';
				break;

				case 'raids':
					global $con_web;

					$data = $con_web->prepare('SELECT * FROM changelog WHERE type = "Raid" ORDER BY id desc LIMIT 20');
					$data->execute();

					echo '<div class="changelog-top column small-12">
							<div class="changelog-tab">
								<a href="changelog.php">All</a>
							</div>

							<div class="changelog-tab">
								<a href="?filter=npc">NPCs</a>
							</div>

							<div class="changelog-tab">
								<a href="?filter=items">Items</a>
							</div>

							<div class="changelog-tab">
								<a href="?filter=quests">Quests</a>
							</div>

							<div class="changelog-tab">
								<a href="?filter=spells">Spells</a>
							</div>

							<div class="changelog-tab">
								<a href="?filter=talents">Talents</a>
							</div>

							<div class="changelog-tab-current">
								<a href="?filter=raids">Raids</a>
							</div>

							<div class="changelog-tab">
								<a href="?filter=dungeons">Dungeons</a>
							</div>
						</div>

						<div class="changelog-botom column small-12">';

					echo '<table>
							<tr>
								<th>Revision</th>
								<th>Author</th>
								<th>Type</th>
								<th>ID</th>
								<th>DB</th>
								<th>Note</th>
								<th>Date</th>
							</tr>';

					while($result = $data->fetchAll(PDO::FETCH_ASSOC))
					{
						foreach($result as $row)
						{
							echo '<tr>
									<td>' . $row['revision'] . '</td>
									<td>' . $row['author'] . '</td>
									<td><span class="yellow">' . $row['type'] . '</span></td>
									<td>' . $row['typeID'] . '</td>
									<td>' . $row['db'] . '</td>
									<td>' . $row['note'] . '</td>
									<td>' . date('H:i - d.M, Y', $row['time']) . '</td>
								</tr>';
						}
					}

					echo '</table>
						</div>';
				break;

				case 'dungeons':
					global $con_web;

					$data = $con_web->prepare('SELECT * FROM changelog WHERE type = "Dungeon" ORDER BY id desc LIMIT 20');
					$data->execute();

					echo '<div class="changelog-top column small-12">
							<div class="changelog-tab">
								<a href="changelog.php">All</a>
							</div>

							<div class="changelog-tab">
								<a href="?filter=npc">NPCs</a>
							</div>

							<div class="changelog-tab">
								<a href="?filter=items">Items</a>
							</div>

							<div class="changelog-tab">
								<a href="?filter=quests">Quests</a>
							</div>

							<div class="changelog-tab">
								<a href="?filter=spells">Spells</a>
							</div>

							<div class="changelog-tab">
								<a href="?filter=talents">Talents</a>
							</div>

							<div class="changelog-tab">
								<a href="?filter=raids">Raids</a>
							</div>

							<div class="changelog-tab-current">
								<a href="?filter=dungeons">Dungeons</a>
							</div>
						</div>

						<div class="changelog-botom column small-12">';

					echo '<table>
							<tr>
								<th>Revision</th>
								<th>Author</th>
								<th>Type</th>
								<th>ID</th>
								<th>DB</th>
								<th>Note</th>
								<th>Date</th>
							</tr>';

					while($result = $data->fetchAll(PDO::FETCH_ASSOC))
					{
						foreach($result as $row)
						{
							echo '<tr>
									<td>' . $row['revision'] . '</td>
									<td>' . $row['author'] . '</td>
									<td><span class="yellow">' . $row['type'] . '</span></td>
									<td>' . $row['typeID'] . '</td>
									<td>' . $row['db'] . '</td>
									<td>' . $row['note'] . '</td>
									<td>' . date('H:i - d.M, Y', $row['time']) . '</td>
								</tr>';
						}
					}

					echo '</table>
						</div>';
				break;
			}
		}
		else
		{
			global $con_web;

			$data = $con_web->prepare('SELECT * FROM changelog ORDER BY id desc LIMIT 20');
			$data->execute();

			echo '<div class="changelog-top column small-12">
					<div class="changelog-tab-current">
						<a href="">All</a>
					</div>

					<div class="changelog-tab">
						<a href="?filter=npc">NPCs</a>
					</div>

					<div class="changelog-tab">
						<a href="?filter=items">Items</a>
					</div>

					<div class="changelog-tab">
						<a href="?filter=quests">Quests</a>
					</div>

					<div class="changelog-tab">
						<a href="?filter=spells">Spells</a>
					</div>

					<div class="changelog-tab">
						<a href="?filter=talents">Talents</a>
					</div>

					<div class="changelog-tab">
						<a href="?filter=raids">Raids</a>
					</div>

					<div class="changelog-tab">
						<a href="?filter=dungeons">Dungeons</a>
					</div>
				</div>

				<div class="changelog-botom column small-12">';

			echo '<table>
					<tr>
						<th>Revision</th>
						<th>Author</th>
						<th>Type</th>
						<th>ID</th>
						<th>DB</th>
						<th>Note</th>
						<th>Date</th>
					</tr>';

			while($result = $data->fetchAll(PDO::FETCH_ASSOC))
			{
				foreach($result as $row)
				{
					echo '<tr>
							<td>' . $row['revision'] . '</td>
							<td>' . $row['author'] . '</td>
							<td><span class="yellow">' . $row['type'] . '</span></td>
							<td>' . $row['typeID'] . '</td>
							<td>' . $row['db'] . '</td>
							<td>' . $row['note'] . '</td>
							<td>' . date('H:i - d.M, Y', $row['time']) . '</td>
						</tr>';
				}
			}

			echo '</table>
				</div>';
		}
	}
}



function UserCP($value)
{
	global $con_web;
	global $con_realmd;

	if(isset($_SESSION['username']))
	{
		$username = $_SESSION['username']; // Set session name

		$data = $con_realmd->prepare('SELECT * FROM account WHERE username = :username');
		$data->execute(array(
			':username' => $username
		));

		while($result = $data->fetchAll(PDO::FETCH_ASSOC))
		{
			foreach($result as $info)
			{
				switch ($value)
				{
					case 'AVATAR':
						$data = $con_web->prepare('SELECT * FROM avatar WHERE username = :username');
						$data->execute(array(
							':username' => $username
						));

						$result = $data->fetchAll(PDO::FETCH_ASSOC);

						foreach($result as $info)
						{
							echo $info['url'];
						}
						break;

					case 'USERNAME':
						echo ucfirst($info['username']);
						break;
					
					case 'EMAIL':
						echo ucfirst($info['email']);
						break;

					case 'STATUS':
						if($info['locked'] == 0)
						{
							echo '<span class="green">Activated</span>';
						}
						else
						{
							echo '<span class="red">Banned</span>';
						}
						break;

					case 'RANK':
						$data = $con_realmd->prepare('SELECT COUNT(*) FROM account_access WHERE id = :userid');
						$data->execute(array(
							':userid' => $info['id']
						));

						if($data->fetchColumn() == 0)
						{
							echo '<span class="red">Frozen</span>';
						}
						else
						{
							$data = $con_realmd->prepare('SELECT * FROM account_access WHERE id = :userid');
							$data->execute(array(
								':userid' => $info['id']
							));

							$result = $data->fetchAll(PDO::FETCH_ASSOC);

							foreach($result as $info)
							{
								switch($info['gmlevel'])
								{
									case 0:
										echo '<span class="red">Frozen</span>';
										break;

									case 1:
										echo '<span class="betatester">Beta Tester</span>';
										break;

									case 2:
										echo '<span class="gamemaster">Game Master</span>';
										break;

									case 3:
										echo '<span class="gamemaster">Game Master</span>';
										break;

									case 4:
										echo '<span class="moderator">Moderator</span>';
										break;

									case 5:
										echo '<span class="administrator">Administrator</span>';
										break;
								}
							}
						}
						break;				
				}
			}
		}
	}
}



function MyCharacters()
{
	global $con_realmd;
	global $con_character;

	if(isset($_SESSION['username']))
	{
		$username = $_SESSION['username']; // Set session name

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

		$data = $con_realmd->prepare('SELECT * FROM account WHERE username = :username');
		$data->execute(array(
			':username' => $username
		));

		$result = $data->fetchAll(PDO::FETCH_ASSOC);

		foreach($result as $info)
		{
			$data = $con_character->prepare('SELECT COUNT(*) FROM characters WHERE account = :userid');
			$data->execute(array(
				':userid' => $info['id']
			));

			if($data->fetchColumn() > 0)
			{
				$data = $con_character->prepare('SELECT * FROM characters WHERE account = :userid');
				$data->execute(array(
					':userid' => $info['id']
				));

				while($result = $data->fetchAll(PDO::FETCH_ASSOC))
				{
					foreach($result as $info)
					{
						echo '<tr>
								<td><a href="armory/armory.php?character=' . strtolower($info['name']) . '">' . $info['name'] . '</a></td>
								<td>' . $faction[$info['race']] . '</td>
								<td>' . $race[$info['race']] . '</td>
								<td>' . $class[$info['class']] . '</td>
								<td><span class="yellow">' . $info['level'] . '</span></td>
							</tr>';
					}
				}
			}
			else
			{
				echo '<tr>
						<td><span class="red">No characters found on your account :(</span></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>';
			}
		}
	}
}



function ServerInfo($value)
{
	global $con_character;
	global $GeneralConfig;

	switch ($value)
	{
		case 'REALM':
			echo 'Northcraft';
			break;

		case 'LOGON':
			if(@fsockopen('logon.worldofnorthcraft.com', 3724, $errno, $errstr, 2))
			{
				echo 'Online';
			}
			else
			{
				echo '<span class="red">Offline</span>';
			}
			break;
		
		case 'WORLD':
			if(@fsockopen('logon.worldofnorthcraft.com', 8085, $errno, $errstr, 2))
			{
				echo 'Online';
			}
			else
			{
				echo '<span class="red">Offline</span>';
			}
			break;

		case 'PLAYERS':
			$data = $con_character->prepare('SELECT COUNT(*) FROM characters WHERE online = 1');
			$data->execute();
			$rows = $data->fetchColumn();
			echo $rows;
			break;

		case 'UPTIME':
			$data = $con_character->prepare('SELECT * FROM uptime WHERE realmid = 1');
			$data->execute();

			$result = $data->fetchAll(PDO::FETCH_ASSOC);

			foreach($result as $info)
			{
				// Echo Uptime
			}
			break;

		case 'REALMLIST':
			echo $GeneralConfig['REALMLIST'];
			break;
	}
}



function IPCheck()
{
	global $con_realmd;

	$ip = $_SERVER['REMOTE_ADDR'];

	$data = $con_realmd->prepare('SELECT COUNT(*) FROM ip_banned WHERE ip = :remoteip');
	$data->execute(array(
		':remoteip' => $ip
	));

	echo '<style>.red { color: #e74c3c; }</style>';

	if($data->fetchColumn() == 1)
	{
		$data = $con_realmd->prepare('SELECT * FROM ip_banned WHERE ip = :remoteip');
		$data->execute(array(
			':remoteip' => $ip
		));

		$result = $data->fetchAll(PDO::FETCH_ASSOC);

		foreach($result as $info)
		{
			if($info['bandate'] > $info['unbandate'])
			{
				$unban = "Permanent";
			}
			else
			{
				$unban = date('H:i - d. M, Y', $info['unbandate']);
			}

			die('IP Address: <span class="red">' . $info['ip'] . '</span><br>Ban Date: <span class="red">' . date('H:i - d. M, Y', $info['bandate']) . '</span><br>Unban Date: <span class="red">' . $unban . '</span><br>Banned By: <span class="red">' . $info['bannedby'] . '</span><br>Ban Reason: <span class="red">' . $info['banreason'] . '</span>');
		}
	}
}



function AccountMenu()
{
	if(isset($_SESSION['username']))
	{
		echo '<li><a href="#" data-dropdown-menu class="dropdown dropdown-pane" data-dropdown="account-dropdown" aria-controls="account-dropdown" aria-expanded="false" data-options="is_hover:false; hover_timeout:200">' . ucfirst($_SESSION['username']) . '</a></li>
				<ul id="account-dropdown" data-dropdown-content class="f-dropdown sub-dropdown2" aria-hidden="true">
					<li><a href="account.php">User Panel</a></li>
					<li><a href="settings.php">Settings</a></li>
					<li><a href="?logout=1">Logout</a></li>
				</ul>';
	}
	else
	{
		echo '<li><a href="#" class="open-register" data-reveal-id="register-modal">REGISTER</a></li>
			  <li><a href="#" class="open-login" data-reveal-id="login-modal">LOGIN</a></li>';
	}
}



function AccountMenu2()
{
	if(isset($_SESSION['username']))
	{
		echo '<li><a href="#" data-dropdown-menu class="dropdown dropdown-pane" data-dropdown="account-dropdown" aria-controls="account-dropdown" aria-expanded="false" data-options="is_hover:false; hover_timeout:200">' . ucfirst($_SESSION['username']) . '</a></li>
				<ul id="account-dropdown" data-dropdown-content class="f-dropdown sub-dropdown2" aria-hidden="true">
					<li><a href="../account.php">User Panel</a></li>
					<li><a href="../settings.php">Settings</a></li>
					<li><a href="../?logout=1">Logout</a></li>
				</ul>';
	}
	else
	{
		echo '<li><a href="#" class="open-register" data-reveal-id="register-modal">REGISTER</a></li>
			  <li><a href="#" class="open-login" data-reveal-id="login-modal">LOGIN</a></li>';
	}
}



function Logout()
{
	if(isset($_GET['logout']))
	{
		$logout = $_GET['logout'];

		if(isset($_SESSION['username']))
		{
			if(intval($logout))
			{
				if($logout == 1)
				{
					session_start();
					session_destroy();
					header('Location: http://worldofnorthcraft.com');
				}
			}
		}
	}
}



function ChangePassword()
{
	if(isset($_POST['change-password']))
	{
		if(!empty($_POST['oldpassword']) && !empty($_POST['newpassword']) && !empty($_POST['repassword']))
		{
			global $con_realmd;

			$username    = $_SESSION['username'];
			$oldpassword = $_POST['oldpassword'];
			$newpassword = $_POST['newpassword'];
			$repassword  = $_POST['repassword'];

			if(strlen($oldpassword) && strlen($newpassword) && strlen($repassword) < 33)
			{
				$data = $con_realmd->prepare('SELECT COUNT(*) FROM account WHERE username = :username AND sha_pass_hash = :password');
				$data->execute(array(
					':username' => $username,
					':password' => sha1(strtoupper($username) . ":" . strtoupper($oldpassword))
				));

				if($data->fetchColumn() == 1)
				{
					if($repassword == $newpassword)
					{
						$data = $con_realmd->prepare('UPDATE account SET sha_pass_hash = :password WHERE username = :username AND sha_pass_hash = :oldpassword');
						$data->execute(array(
							':username'    => $username,
							':oldpassword' => sha1(strtoupper($username) . ":" . strtoupper($oldpassword)),
							':password'    => sha1(strtoupper($username) . ":" . strtoupper($repassword))
						));

						if($data)
						{
							echo '<span class="green">Password has been changed!</span>';
						}
						else
						{
							echo '<span class="red">Something went wrong!</span>';
						}
					}
					else
					{
						echo '<span class="red">New passwords dont match!</span>';
					}
				}
				else
				{
					echo '<span class="red">Old password is not correct!</span>';
				}
			}
			else
			{
				echo '<span class="red">Passwords are too long!</span>';
			}
		}
		else
		{
			echo '<span class="red">Fields cant be blank!</span>';
		}
	}
}



function ChangeAvatar()
{
	if(isset($_POST['change-avatar']))
	{
		if(!empty($_POST['avatar']))
		{
			global $con_web;

			$username = $_SESSION['username'];
			$avatar   = $_POST['avatar'];

			if(filter_var($avatar, FILTER_VALIDATE_URL))
			{
				$data = $con_web->prepare('SELECT COUNT(*) FROM avatar WHERE username = :username');
				$data->execute(array(
					':username' => $username
				));

				if($data->fetchColumn() == 1)
				{
					$data = $con_web->prepare('UPDATE avatar SET url = :avatar WHERE username = :username');
					$data->execute(array(
						':username' => $username,
						':avatar'   => $avatar
					));

					echo '<span class="green">Updated avatar successfully!</span>';
				}
			}
			else
			{
				echo '<span class="red">Please insert a valid url!</span>';
			}
		}
		else
		{
			echo '<span class="red">Field cant be blank!</span>';
		}
	}
}



function Support()
{
	if(isset($_POST['send']))
	{
		if(!empty($_POST['email']) && !empty($_POST['subject']) && !empty($_POST['message']))
		{
			global $con_web;

			$email   = $_POST['email'];
			$subject = $_POST['subject'];
			$message = $_POST['message'];
			$time    = time();
			$ip      = $_SERVER['REMOTE_ADDR'];
			$captcha = $_POST['g-recaptcha-response'];
			$secret  = '6LdOmigTAAAAACZnJEV52ID5UsQHBYFiekWr7-jy';

			if(filter_var($email, FILTER_VALIDATE_EMAIL))
			{
				if($captcha)
				{
					$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . $secret . "&response=" . $captcha . "&remoteip=" . $ip);
					$decode   = json_decode($response, true);

					if(intval($decode['success']) == 1)
					{
						$data = $con_web->prepare('SELECT COUNT(*) FROM support WHERE subject = :subject AND ip = :ip');
						$data->execute(array(
							':subject' => $subject,
							':ip'      => $ip
						));

						if(!$data->fetchColumn() == 1)
						{
							$data = $con_web->prepare('INSERT INTO support (email, subject, message, time, ip) VALUES(:email, :subject, :message, :time, :ip)');
							$data->execute(array(
								':email'   => $email,
								':subject' => $subject,
								':message' => $message,
								':time'    => $time,
								':ip'      => $ip
							));

							echo '<div data-alert class="alert-box success radius">Ticket has been sent!<a href="#" class="close">&times;</a></div>';
						}
						else
						{
							echo '<div data-alert class="alert-box alert radius">Please dont spam our system :)<a href="#" class="close">&times;</a></div>';
						}
					}
					else
					{
						echo '<div data-alert class="alert-box alert radius">Captcha is wrong!<a href="#" class="close">&times;</a></div>';
					}
				}
				else
				{
					echo '<div data-alert class="alert-box alert radius">Please fill in the captcha!<a href="#" class="close">&times;</a></div>';
				}
			}
			else
			{
				echo '<div data-alert class="alert-box alert radius">Email is not valid!<a href="#" class="close">&times;</a></div>';
			}
		}
		else
		{
			echo '<div data-alert class="alert-box alert radius">Form cannot be empty!<a href="#" class="close">&times;</a></div>';
		}
	}
}



function GrabFAQ()
{
	global $con_web;

	$data = $con_web->prepare('SELECT * FROM faq ORDER BY id');
	$data->execute();

	while($result = $data->fetchAll(PDO::FETCH_ASSOC))
	{
		foreach($result as $row)
		{
			echo '<div class="faq column small-12">
					<div class="faq-question column small-12">
						' . $row['question'] . '
					</div>

					<div class="faq-answer column small-12">
						' . $row['answer'] . '
					</div>
				</div>';
		}
	}
}



function DownloadClient()
{
	if(isset($_POST['download']))
	{
		$os = (int)$_POST['os'];

		if($os == 0)
		{
			//Windows
			echo '<meta http-equiv="refresh" content="0; url=downloads/windows-wotlk.torrent">';
		}
		elseif($os == 1)
		{
			//Mac OS X
			echo '<meta http-equiv="refresh" content="0; url=downloads/macosx-wotlk.torrent">';
		}
		else
		{
			die('<span class="red">Unauthorized attempt!</span>');
		}
	}
}



function ShowNews()
{
	global $con_web;

	$data = $con_web->prepare('SELECT COUNT(*) FROM news');
	$data->execute();

	if($data->fetchColumn() > 0)
	{
		$data = $con_web->prepare('SELECT * FROM news ORDER BY id desc LIMIT 4');
		$data->execute();

		while($result = $data->fetchAll(PDO::FETCH_ASSOC))
		{
			foreach($result as $row)
			{
				echo '<div class="news-box column small-12">
						<div class="avatar column small-3 medium-2">
							<center>
								<div class="news-avatar">
									<img src="' . $row['author_avatar'] . '" width="130">
								</div>

								<div class="news-author">
									' . ucfirst($row['author']) . '
								</div>
							</center>
						</div>

						<div class="news column small-9 medium-10">
							<div class="news-header column small-12 medium-12">
								<div class="news-title column small-6 medium-7 large-9">
									' . $row['title'] . '
								</div>

								<div class="news-date column small-6 medium-5 large-3">
									<div class="news-date-text">
									' . date('H:i - d. M, Y', $row['time']) . '
									</div>
								</div>
							</div>

							<div class="news-content column small-12 medium-12">
								' . $row['content'] . '
							</div>
						</div>
					</div>';
			}
		}
	}
	else
	{
		echo '<span class="red">No news posts has been found :(</span>';
	}

}

?>