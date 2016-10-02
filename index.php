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
			    <li><a href="index.php" class="current-nav">News</a></li>
			</ul>
		</div>
	</div>
</div>

<div class="row">
	<div class="content columns small-12 medium-12">
		<div class="row">
			<div class="content-box column small-12 medium-8">
				<div class="box-header">
					News
				</div>

				<div class="box-content">
					<?php ShowNews(); ?>
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
		</div>
	</div>
</div>

<?php

include('footer.php');

?>