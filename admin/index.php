<?php

include('header.php');

?>

<div class="row">
	<div class="content">
		<div class="content-content column small-12">
			<div class="content-content column small-12 medium-4 large-4">
				<div class="content-box column small-12 medium-12">
					<div class="content-box-header column small-12 medium-12">
						Server Information
					</div>

					<div class="content-box-content column small-12 medium-12">
						<table>
							<tr>
								<td>Logon Server</td>
								<td><?php Dashboard('LOGON_SERVER'); ?></td>
							</tr>
							<tr>
								<td>World Server</td>
								<td><?php Dashboard('WORLD_SERVER'); ?></td>
							</tr>
							<tr>
								<td>Players Online</td>
								<td><?php Dashboard('PLAYERS_ONLINE'); ?></td>
							</tr>
							<tr>
								<td>Uptime</td>
								<td><?php Dashboard('UPTIME'); ?></td>
							</tr>
						</table>
					</div>
				</div>
			</div>

			
			<div class="content-content column small-12 medium-4 large-4">
				<div class="content-box column small-12 medium-12">
					<div class="content-box-header column small-12 medium-12">
						Statistics
					</div>

					<div class="content-box-content column small-12 medium-12">
						<table>
							<tr>
								<td>News Articles</td>
								<td><?php Dashboard('NEWS_ARTICLES'); ?></td>
							</tr>
							<tr>
								<td>Users Today</td>
								<td><?php Dashboard('USERS_TODAY'); ?></td>
							</tr>
							<tr>
								<td>Users Yesterday</td>
								<td><?php Dashboard('USERS_YESTERDAY'); ?></td>
							</tr>
							<tr>
								<td>Users Total</td>
								<td><?php Dashboard('USERS_TOTAL'); ?></td>
							</tr>
						</table>
					</div>
				</div>
			</div>

			<div class="content-content column small-12 medium-4 large-4">
				<div class="content-box column small-12 medium-12">
					<div class="content-box-header column small-12 medium-12">
						System Information
					</div>

					<div class="content-box-content column small-12 medium-12">
						<table>
							<tr>
								<td>Errors</td>
								<td><?php Dashboard('ERRORS'); ?></td>
							</tr>
							<tr>
								<td>PHP Version</td>
								<td><?php Dashboard('PHP_VERSION'); ?></td>
							</tr>
							<tr>
								<td>CMS Version</td>
								<td><?php Dashboard('CMS_VERSION'); ?></td>
							</tr>
							<tr>
								<td>Exploit Attempts</td>
								<td><?php Dashboard('EXPLOITS'); ?></td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php

include('footer.php');

?>