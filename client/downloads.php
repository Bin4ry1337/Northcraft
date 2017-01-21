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
			    <li><a href="downloads.php" class="current-nav">Downloads</a></li>
			</ul>
		</div>
	</div>
</div>

<div class="row">
	<div class="content columns small-12 medium-12">
		<div class="row">
			<div class="content-box column small-12 medium-8">
				<div class="box-header">
					Download the WOTLK Client
				</div>

				<div class="box-content">
					<form method="POST">
						<div class="connect column small-12">
							<div class="connect-step column small-12">
								<span class="yellow">Step 1</span> - Download a BitTorrent Client
							</div>

							<div class="connect-step-info column small-12">
								Get a bittorrent client like: <a href="http://utorrent.com/" target="_BLANK">uTorrent</a>.
							</div>
						</div>

						<div class="connect column small-12">
							<div class="connect-step column small-12">
								<span class="yellow">Step 2</span> - Select Operating System
							</div>

							<div class="connect-step-info column small-12">
								<select name="os">
									<option value="0">Windows</option>
									<option value="1">Mac OS X</option>
								</select>
							</div>
						</div>

						<div class="connect column small-12">
							<div class="connect-step column small-12">
								<span class="yellow">Step 3</span> - Download the client
							</div>

							<div class="connect-step-info column small-12">
								<input type="submit" name="download" class="button small" value="Download" />
								<?php DownloadClient(); ?>
							</div>
						</div>
					</form>
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