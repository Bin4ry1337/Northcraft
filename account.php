<?php

include('header.php');

function LoggedIn()
{
	if(!isset($_SESSION['username']))
	{
		echo '<meta http-equiv="refresh" content="0;url=http://worldofnorthcraft.com" />';
		exit();
	}
}

LoggedIn();

?>

<div class="header-bread columns small-12">
	<div class="row">
		<div class="header-crump column small-12">
			<ul class="breadcrumbs">
			    <li><a href="index.php">Home</a></li>
			    <li><a href="#">Account</a></li>
			    <li><a href="account.php" class="current-nav">Account Information</a></li>
			</ul>
		</div>
	</div>
</div>

<div class="row">
	<div class="content columns small-12 medium-12">
		<div class="row">
			<div class="content-box column small-12 medium-8">
				<div class="box-header">
					Account Information
				</div>

				<div class="box-content">
					<div class="account columns small-12">
						<div class="account-avatar column small-12 medium-3">
							<img src="<?php UserCP('AVATAR'); ?>" width="130" height="130">
						</div>

						<div class="account-info column small-12 medium-9">
							<div class="account-data column small-12 medium-6">
								<label>Username</label>
								<?php UserCP('USERNAME'); ?>
							</div>

							<div class="account-data column small-12 medium-6">
								<label>Email</label>
								<?php UserCP('EMAIL'); ?>
							</div>

							<div class="account-data column small-12 medium-6">
								<label>Account Status</label>
								<?php UserCP('STATUS'); ?>
							</div>

							<div class="account-data column small-12 medium-6">
								<label>Account Rank</label>
								<?php UserCP('RANK'); ?>
							</div>
						</div>

						<div class="account-options column small-12">
							<a href="settings.php" class="button small">Settings</a>
						</div>

						<div class="account-characters column small-12">
							<div class="account-char-title">
								My Characters
							</div>

							<table>
								<tr>
									<th>Character</th>
									<th>Faction</th>
									<th>Race</th>
									<th>Class</th>
									<th>Level</th>
								</tr>

								<?php MyCharacters(); ?>
							</table>
						</div>
					</div>
				</div>
			</div>

			<div class="content-box column small-12 medium-4">
				<div class="box-header2">
					Server Info
				</div>

				<div class="box-content2">
					<div class="server-info">
						<div class="server-info">
							<table>
								<tr>
									<td>Realm Name</td>
									<td><span class="blue"><?php ServerInfo('REALM'); ?></span></td>
								</tr>

								<tr>
									<td>Logon Server</td>
									<td><span class="green"><?php ServerInfo('LOGON'); ?></span></td>
								</tr>

								<tr>
									<td>World Server</td>
									<td><span class="green"><?php ServerInfo('WORLD'); ?></span></td>
								</tr>

								<tr>
									<td>Online Players</td>
									<td><span class="green"><?php ServerInfo('PLAYERS'); ?></span></td>
								</tr>

								<tr>
									<td>Status</td>
									<td><span class="green"><?php ServerInfo('STATUS'); ?></span></td>
								</tr>
							</table>

							<table class="server-table">
								<tr>
									<td><center><span class="yellow"><?php ServerInfo('REALMLIST'); ?></span></center></td>
								</tr>
							</table>
						</div>
					</div>
				</div>
			</div>

			<?php echo $GeneralConfig['DISCORD']; ?>
		</div>
	</div>
</div>

<?php

include('footer.php');

?>