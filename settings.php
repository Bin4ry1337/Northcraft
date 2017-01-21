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
			    <li><a href="account.php">Account</a></li>
			    <li><a href="settings.php" class="current-nav">Account Settings</a></li>
			</ul>
		</div>
	</div>
</div>

<div class="row">
	<div class="content columns small-12 medium-12">
		<div class="row">
			<div class="content-box column small-12 medium-8">
				<div class="box-header">
					Account Settings
				</div>

				<div class="box-content">
					<div class="account columns small-12">
						<div class="account-settings column small-12 medium-6">
							<form method="POST">
								<div class="setting-title column small-12">
									Change Avatar
								</div>
								
								<div class="setting column small-12">
									<label>Avatar Url</label>
									<input type="text" name="avatar" placeholder="http://google.com/images/panda.png" />
								</div>

								<div class="setting column small-12">
									<input type="submit" class="button small" name="change-avatar" value="Change" />

									<?php ChangeAvatar(); ?>
								</div>
							</form>
						</div>

						<div class="account-settings column small-12 medium-6">
							<form method="POST">
								<div class="setting-title column small-12">
									Change Password
								</div>

								<div class="setting column small-12">
									<label>Current Password</label>
									<input type="password" name="oldpassword" />
								</div>

								<div class="setting column small-12">
									<label>New Password</label>
									<input type="password" name="newpassword" />
								</div>

								<div class="setting column small-12">
									<label>Re-Password</label>
									<input type="password" name="repassword" />
								</div>

								<div class="setting column small-12">
									<input type="submit" class="button small" name="change-password" value="Change" />
									
									<?php ChangePassword(); ?>
								</div>
							</form>
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