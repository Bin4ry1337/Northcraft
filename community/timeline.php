<?php

include('header.php');

?>
<!-- OpenWoW -->
<script type="text/javascript" src="js/openwow.js"></script>	
<script type="text/javascript">
	var openwowTooltips = {
	        /* Enable or disable the rename of URLs into item, spell and other names automatically */
	        rename: true,
	        /* Enable or disable icons appearing on the left of the tooltip links. */
	        icons: true,
	        /* Overrides the default icon size of 15x15, 13x13 as an example, icons must be true */
	        iconsize: 18,
	        /* Enable or disable link rename quality colors, an epic item will be purple for example. */
	        qualitycolor: true,
	        /* TBA */
	        forcexpac: { },
	        /* Override link colors, qualitycolor must be true. Example: spells: '#000' will color all renamed spell links black. */
	        overridecolor: {
	            spells: '',
	            items: '',
	            npcs: '',
	            objects: '',
	            quests: '',
	            achievements: ''
	        } 
	};
</script>

<div class="header-bread columns small-12">
	<div class="row">
		<?php

		Login();
		Register();
		Support();

		?>
		<div class="header-crump column small-12">
			<ul class="breadcrumbs">
			    <li><a href="../index.php">Home</a></li>
			    <li><a href="#">Community</a></li>
			    <li><a href="timeline.php" class="current-nav">Timeline</a></li>
			</ul>
		</div>
	</div>
</div>

<div class="row">
<div class="contnt column small-12">
<div class="timeline">
	<div id="timeline-one">
		<div class="timeline-one-left">
			2017/01/01
		</div>

		<div class="timeline-one-center">
			
		</div>

		<div class="timeline-one-right">
			<div class="timeline-one-title">
				Release
			</div>

			<div class="timeline-one-content">
				<div class="timeline-content-header">
					<div class="timeline-top-header">
						PLAYERS VERSUS ENVIRONMENT
					</div>

					<div class="timeline-header-left">
						DUNGEONS
					</div>

					<div class="timeline-header-right">
						RAIDS
					</div>
				</div>

				<div class="timeline-content-content">

					<!-- Dungeons -->

					<div class="timeline-content-left">
						<div class="instance">
							<a href="https://www.wow-mania.com/armory/?zone=206">
								<div class="instance-icon">
									<img src="../img/dungeons/UK.png" width="30">
								</div>

								<div class="instance-name">
									Utgarde Keep (70-72)
								</div>
							</a>
						</div>

						<div class="instance">
							<a href="https://www.wow-mania.com/armory/?zone=4265">
								<div class="instance-icon">
									<img src="../img/dungeons/nexus.png" width="30">
								</div>

								<div class="instance-name">
									The Nexus (71-73)
								</div>
							</a>
						</div>

						<div class="instance">
							<a href="https://www.wow-mania.com/armory/?zone=4277">
								<div class="instance-icon">
									<img src="../img/dungeons/AN.png" width="30">
								</div>

								<div class="instance-name">
									Azjol-Nerub (72-74)
								</div>
							</a>
						</div>

						<div class="instance">
							<a href="https://www.wow-mania.com/armory/?zone=4494">
								<div class="instance-icon">
									<img src="../img/dungeons/AK.png" width="30">
								</div>

								<div class="instance-name">
									Ahn'kahet: The Old Kingdom (73-75)
								</div>
							</a>
						</div>

						<div class="instance">
							<a href="https://www.wow-mania.com/armory/?zone=4196">
								<div class="instance-icon">
									<img src="../img/dungeons/DTK.png" width="30">
								</div>

								<div class="instance-name">
									Drak'Tharon Keep (74-76)
								</div>
							</a>
						</div>

						<div class="instance">
							<a href="https://www.wow-mania.com/armory/?zone=4415">
								<div class="instance-icon">
									<img src="../img/dungeons/VH.png" width="30">
								</div>

								<div class="instance-name">
									The Violet Hold (75-77)
								</div>
							</a>
						</div>

						<div class="instance">
							<a href="https://www.wow-mania.com/armory/?zone=4416">
								<div class="instance-icon">
									<img src="../img/dungeons/gundrak.png" width="30">
								</div>

								<div class="instance-name">
									Gundrak (76-78)
								</div>
							</a>
						</div>

						<div class="instance">
							<a href="https://www.wow-mania.com/armory/?zone=4264">
								<div class="instance-icon">
									<img src="../img/dungeons/HoS.png" width="30">
								</div>

								<div class="instance-name">
									Halls of Stone (77-79)
								</div>
							</a>
						</div>

						<div class="instance">
							<a href="https://www.wow-mania.com/armory/?zone=4272">
								<div class="instance-icon">
									<img src="../img/dungeons/HoL.png" width="30">
								</div>

								<div class="instance-name">
									Halls of Lightning (80)
								</div>
							</a>
						</div>

						<div class="instance">
							<a href="https://www.wow-mania.com/armory/?zone=4228">
								<div class="instance-icon">
									<img src="../img/dungeons/oculus.png" width="30">
								</div>

								<div class="instance-name">
									The Oculus (80)
								</div>
							</a>
						</div>

						<div class="instance">
							<a href="https://www.wow-mania.com/armory/?zone=4100">
								<div class="instance-icon">
									<img src="../img/dungeons/CoT.png" width="30">
								</div>

								<div class="instance-name">
									CoT: Culling of Stratholme (80)
								</div>
							</a>
						</div>

						<div class="instance">
							<a href="https://www.wow-mania.com/armory/?zone=1196">
								<div class="instance-icon">
									<img src="../img/dungeons/UP.png" width="30">
								</div>

								<div class="instance-name">
									Utgarde Pinnacle (80)
								</div>
							</a>
						</div>
					</div>

					<!-- Raids -->

					<div class="timeline-content-right">
						<div class="instance">
							<a href="https://www.wow-mania.com/armory/?zone=3456">
								<div class="instance-icon">
									<img src="../img/raids/naxxramas.png" width="30">
								</div>

								<div class="instance-name">
									Naxxramas (10/25man)
								</div>
							</a>
						</div>

						<div class="instance">
							<a href="https://www.wow-mania.com/armory/?zone=4493">
								<div class="instance-icon">
									<img src="../img/raids/OS.png" width="30">
								</div>

								<div class="instance-name">
									Obsidian Sanctum (10/25man)
								</div>
							</a>
						</div>

						<div class="instance">
							<a href="https://www.wow-mania.com/armory/?zone=4603">
								<div class="instance-icon">
									<img src="../img/raids/VoA.png" width="30">
								</div>

								<div class="instance-name">
									Vault of Archavon: Archavon (10/25man)
								</div>
							</a>
						</div>

						<div class="instance">
							<a href="https://www.wow-mania.com/armory/?zone=4500">
								<div class="instance-icon">
									<img src="../img/raids/EoE.png" width="30">
								</div>

								<div class="instance-name">
									The Eye of Eternity (10/25man)
								</div>
							</a>
						</div>
					</div>
				</div>

				<div class="timeline-content-header">
					<div class="timeline-top-header">
						PLAYERS VERSUS PLAYERS
					</div>

					<div class="timeline-header-left2">
						GENERAL
					</div>

					<div class="timeline-header-center2">
						BATTLEGROUNDS
					</div>

					<div class="timeline-header-right2">
						ARENAS
					</div>
				</div>

				<div class="timeline-content-content">
					<div class="timeline-content-left2">
						<span class="orange">Waiting for confirmation</span>
					</div>

					<div class="timeline-content-center2">
						<span class="orange">Waiting for confirmation</span>
					</div>

					<div class="timeline-content-right2">
						<span class="orange">Waiting for confirmation</span>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div id="timeline-two">
		<div class="timeline-one-left">
			<div class="release-date">
				2017/03/01
			</div>

			<div class="confirmed">
				TO BE CONFIRMED
			</div>
		</div>

		<div class="timeline-two-center">
			
		</div>

		<div class="timeline-one-right">
			<div class="timeline-one-title">
				Secrets of Ulduar
			</div>

			<div class="timeline-two-content">
				<div class="timeline-content-header">
					<div class="timeline-top-header">
						PLAYERS VERSUS ENVIRONMENT
					</div>

					<div class="timeline-header-left">
						DUNGEONS
					</div>

					<div class="timeline-header-right">
						RAIDS
					</div>
				</div>

				<div class="timeline-content-content">

					<!-- Dungeons -->

					<div class="timeline-content-left">
						<div class="instance">
							<a href="https://www.wow-mania.com/armory/?zone=206">
								<div class="instance-icon">
									<img src="../img/dungeons/UK.png" width="30">
								</div>

								<div class="instance-name">
									Utgarde Keep (70-72)
								</div>
							</a>
						</div>

						<div class="instance">
							<a href="https://www.wow-mania.com/armory/?zone=4265">
								<div class="instance-icon">
									<img src="../img/dungeons/nexus.png" width="30">
								</div>

								<div class="instance-name">
									The Nexus (71-73)
								</div>
							</a>
						</div>

						<div class="instance">
							<a href="https://www.wow-mania.com/armory/?zone=4277">
								<div class="instance-icon">
									<img src="../img/dungeons/AN.png" width="30">
								</div>

								<div class="instance-name">
									Azjol-Nerub (72-74)
								</div>
							</a>
						</div>

						<div class="instance">
							<a href="https://www.wow-mania.com/armory/?zone=4494">
								<div class="instance-icon">
									<img src="../img/dungeons/AK.png" width="30">
								</div>

								<div class="instance-name">
									Ahn'kahet: The Old Kingdom (73-75)
								</div>
							</a>
						</div>

						<div class="instance">
							<a href="https://www.wow-mania.com/armory/?zone=4196">
								<div class="instance-icon">
									<img src="../img/dungeons/DTK.png" width="30">
								</div>

								<div class="instance-name">
									Drak'Tharon Keep (74-76)
								</div>
							</a>
						</div>

						<div class="instance">
							<a href="https://www.wow-mania.com/armory/?zone=4415">
								<div class="instance-icon">
									<img src="../img/dungeons/VH.png" width="30">
								</div>

								<div class="instance-name">
									The Violet Hold (75-77)
								</div>
							</a>
						</div>

						<div class="instance">
							<a href="https://www.wow-mania.com/armory/?zone=4416">
								<div class="instance-icon">
									<img src="../img/dungeons/gundrak.png" width="30">
								</div>

								<div class="instance-name">
									Gundrak (76-78)
								</div>
							</a>
						</div>

						<div class="instance">
							<a href="https://www.wow-mania.com/armory/?zone=4264">
								<div class="instance-icon">
									<img src="../img/dungeons/HoS.png" width="30">
								</div>

								<div class="instance-name">
									Halls of Stone (77-79)
								</div>
							</a>
						</div>

						<div class="instance">
							<a href="https://www.wow-mania.com/armory/?zone=4272">
								<div class="instance-icon">
									<img src="../img/dungeons/HoL.png" width="30">
								</div>

								<div class="instance-name">
									Halls of Lightning (80)
								</div>
							</a>
						</div>

						<div class="instance">
							<a href="https://www.wow-mania.com/armory/?zone=4228">
								<div class="instance-icon">
									<img src="../img/dungeons/oculus.png" width="30">
								</div>

								<div class="instance-name">
									The Oculus (80)
								</div>
							</a>
						</div>

						<div class="instance">
							<a href="https://www.wow-mania.com/armory/?zone=4100">
								<div class="instance-icon">
									<img src="../img/dungeons/CoT.png" width="30">
								</div>

								<div class="instance-name">
									CoT: Culling of Stratholme (80)
								</div>
							</a>
						</div>

						<div class="instance">
							<a href="https://www.wow-mania.com/armory/?zone=1196">
								<div class="instance-icon">
									<img src="../img/dungeons/UP.png" width="30">
								</div>

								<div class="instance-name">
									Utgarde Pinnacle (80)
								</div>
							</a>
						</div>
					</div>

					<!-- Raids -->

					<div class="timeline-content-right">
						<div class="instance">
							<a href="https://www.wow-mania.com/armory/?zone=3456">
								<div class="instance-icon">
									<img src="../img/raids/naxxramas.png" width="30">
								</div>

								<div class="instance-name">
									Naxxramas (10/25man)
								</div>
							</a>
						</div>

						<div class="instance">
							<a href="https://www.wow-mania.com/armory/?zone=4493">
								<div class="instance-icon">
									<img src="../img/raids/OS.png" width="30">
								</div>

								<div class="instance-name">
									Obsidian Sanctum (10/25man)
								</div>
							</a>
						</div>

						<div class="instance">
							<a href="https://www.wow-mania.com/armory/?zone=4603">
								<div class="instance-icon">
									<img src="../img/raids/VoA.png" width="30">
								</div>

								<div class="instance-name">
									Vault of Archavon: Archavon (10/25man)
								</div>
							</a>
						</div>

						<div class="instance">
							<a href="https://www.wow-mania.com/armory/?zone=4500">
								<div class="instance-icon">
									<img src="../img/raids/EoE.png" width="30">
								</div>

								<div class="instance-name">
									The Eye of Eternity (10/25man)
								</div>
							</a>
						</div>
					</div>
				</div>

				<div class="timeline-content-header">
					<div class="timeline-top-header">
						PLAYERS VERSUS PLAYERS
					</div>

					<div class="timeline-header-left2">
						GENERAL
					</div>

					<div class="timeline-header-center2">
						BATTLEGROUNDS
					</div>

					<div class="timeline-header-right2">
						ARENAS
					</div>
				</div>

				<div class="timeline-content-content">
					<div class="timeline-content-left2">
						<span class="orange">Waiting for confirmation</span>
					</div>

					<div class="timeline-content-center2">
						<span class="orange">Waiting for confirmation</span>
					</div>

					<div class="timeline-content-right2">
						<span class="orange">Waiting for confirmation</span>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="timeline-three">
		<div class="timeline-one-left">
			<div class="release-date">
				2017/05/01
			</div>

			<div class="confirmed">
				TO BE CONFIRMED
			</div>
		</div>

		<div class="timeline-three-center">
			
		</div>

		<div class="timeline-one-right">
			<div class="timeline-one-title">
				Call of the Crusade
			</div>
		</div>
	</div>

	<div class="timeline-four">
		<div class="timeline-one-left">
			<div class="release-date">
				2017/06/01
			</div>

			<div class="confirmed">
				TO BE CONFIRMED
			</div>
		</div>

		<div class="timeline-four-center">
			
		</div>

		<div class="timeline-one-right">
			<div class="timeline-one-title">
				Onyxia's Lair
			</div>
		</div>
	</div>

	<div class="timeline-five">
		<div class="timeline-one-left">
			<div class="release-date">
				2017/08/01
			</div>

			<div class="confirmed">
				TO BE CONFIRMED
			</div>
		</div>

		<div class="timeline-five-center">
			
		</div>

		<div class="timeline-one-right">
			<div class="timeline-one-title">
				Fall of the Lich King
			</div>
		</div>
	</div>

	<div class="timeline-six">
		<div class="timeline-one-left">
			<div class="release-date">
				2017/12/01
			</div>

			<div class="confirmed">
				TO BE CONFIRMED
			</div>
		</div>

		<div class="timeline-six-center">
			
		</div>

		<div class="timeline-one-right">
			<div class="timeline-one-title">
				Ruby Sanctum
			</div>
		</div>
	</div>
</div>
</div>
</div>

<?php

include('footer.php');

?>