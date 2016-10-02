<?php

include('header.php');

?>

<div class="header-bread columns small-12">
	<div class="row">
		<?php

		Login();
		Register();

		?>
		<div class="header-crump column small-12">
			<ul class="breadcrumbs">
			    <li><a href="index.php">Home</a></li>
			    <li><a href="#">Client</a></li>
			    <li><a href="connect.php" class="current-nav">How to Connect</a></li>
			</ul>
		</div>
	</div>
</div>

<div class="row">
	<div class="content columns small-12 medium-12">
		<div class="row">
			<div class="content-box column small-12 medium-8">
				<div class="box-header">
					How to Connect
				</div>

				<div class="box-content">
					<div class="connect-box column small-12">
						<div class="connect-content">
							<div class="connect column small-12">
								<div class="connect-step column small-12">
									<span class="yellow">Step 1</span> - Download the WOTLK Client
								</div>

								<div class="connect-step-info column small-12">
									To get the WOTLK Client if you dont already have a working one, goto our <a href="downloads.php">Downloads</a> page.
								</div>
							</div>

							<div class="connect column small-12">
								<div class="connect-step column small-12">
									<span class="yellow">Step 2</span> - Register a new account
								</div>

								<div class="connect-step-info column small-12">
									Register an account by clicking register on the top right of the page or by clicking <a href="#" class="open-register" data-reveal-id="register-modal">here</a>.
								</div>
							</div>

							<div class="connect column small-12">
								<div class="connect-step column small-12">
									<span class="yellow">Step 3</span> - Change your realmlist
								</div>

								<div class="connect-step-info column small-12">
									Goto your world of warcraft folder -> Data\enUS\realmlist.wtf then open it in notepad and edit the contents to: <span class="red">set realmlist logon.worldofnorthcraft.com</span>
								</div>
							</div>

							<div class="connect column small-12">
								<div class="connect-step column small-12">
									<span class="yellow">Step 4</span> - Login to the server
								</div>

								<div class="connect-step-info column small-12">
									Login to the server and enjoy the game!
								</div>
							</div>
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
									<td>Uptime</td>
									<td><span class="green"><?php ServerInfo('UPTIME'); ?></span></td>
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

			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
		</div>
	</div>
</div>

<?php

include('footer.php');

?>