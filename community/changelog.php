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

		?>
		<div class="header-crump column small-12">
			<ul class="breadcrumbs">
			    <li><a href="../index.php">Home</a></li>
			    <li><a href="#">Community</a></li>
			    <li><a href="changelog.php" class="current-nav">Changelog</a></li>
			</ul>
		</div>
	</div>
</div>

<div class="row">
	<div class="content columns small-12 medium-12">
		<div class="row">
			<div class="content-box column small-12 medium-12">
				<div class="box-header">
					Changelog
				</div>

				<div class="box-content">
					<form method="GET">
						<div class="content-box-search">
							<label>Search the Changelog</label>
							<input type="text" name="search" autocomplete="OFF" placeholder="ID Search.." />
						</div>
							
						<div class="changelog">
							<?php Changelog(); ?>
						</div>
					</form>
				</div>
			</div>
		</div>

		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
	</div>
</div>

<?php

include('footer.php');

?>