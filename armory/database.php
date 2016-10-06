<?php

include('header.php');

?>

<!-- OpenWoW -->
<script type="text/javascript" src="../js/openwow.js"></script>	
<script type="text/javascript">
	var openwowTooltips = {
	        /* Enable or disable the rename of URLs into item, spell and other names automatically */
	        rename: true,
	        /* Enable or disable icons appearing on the left of the tooltip links. */
	        icons: true,
	        /* Overrides the default icon size of 15x15, 13x13 as an example, icons must be true */
	        iconsize: 40,
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
	
	function nameq()
	{
		var searchTxt = $("input[name='name']").val();

		$.post("ajax/search_items.php", {searchVal: searchTxt}, function(output) {
			$("#output").html(output);
		});
	}
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
			    <li><a href="#">Armory</a></li>
			    <li><a href="database.php" class="current-nav">Item Database</a></li>
			</ul>
		</div>
	</div>
</div>

<div class="row">
	<div class="content columns small-12 medium-12">
		<div class="row">
			<div class="content-box2 column small-12 medium-12">
				<div class="box-header">
					Item Database
				</div>

				<div class="box-content">
					<div class="database-search">
						<form method="POST">
							<label>Search the database</label>
							<input type="text" name="name" autocomplete="OFF" placeholder="Item.." onkeydown="nameq();" />
						</form>
						<?php

						if(isset($_POST['name']))
						{
							global $con_world;

							$name = strtolower($_POST['name']);

							$data = $con_world->prepare('SELECT * FROM item_template WHERE name = :name');
							$data->execute(array(
								':name' => $name
							));

							$result = $data->fetchAll(PDO::FETCH_ASSOC);

							foreach($result as $item)
							{
								echo '<meta http-equiv="refresh" content="0;url=database.php?item=' . $item['entry'] . '" />';
							}
						}

						?>
					</div>

					<div class="database-result">
						<div id="output">

						</div>
						
						<?php itemDatabase(); ?>

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