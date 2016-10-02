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

<div class="row">
	<div class="content">
		<div class="content-content column small-12">
			<?php AddChangelog(); ?>
			<?php DeleteChangelog(); ?>
			<div class="content-content column small-12 medium-12 large-12">
				<div class="content-box column small-12 medium-12 large-12">
					<div class="content-box-header column small-12 medium-12 large-12">
						Add new changes
					</div>

					<div class="content-box-content column small-12">
						<form method="POST">
							<div class="input column small-12 medium-3 large-2">
								<label>Type</label>
								<select name="type1">
									<option value="0">Quest</option>
									<option value="1">Item</option>
									<option value="2">Spell</option>
									<option value="3">NPC</option>
									<option value="4">Talent</option>
									<option value="5">Dungeon</option>
									<option value="6">Raid</option>
								</select>
							</div>
							<div class="input column small-12 medium-3 large-2">
								<label>ID</label>
								<input type="text" name="id1" />
							</div>
							<div class="input column small-12 medium-6 large-8">
								<label>Note</label>
								<input type="text" name="note1" />
							</div>

							<div class="input column small-12 medium-3 large-2">
								<select name="type2">
									<option value="0">Quest</option>
									<option value="1">Item</option>
									<option value="2">Spell</option>
									<option value="3">NPC</option>
									<option value="4">Talent</option>
									<option value="5">Dungeon</option>
									<option value="6">Raid</option>
								</select>
							</div>
							<div class="input column small-12 medium-3 large-2">
								<input type="text" name="id2" />
							</div>
							<div class="input column small-12 medium-6 large-8">
								<input type="text" name="note2" />
							</div>

							<div class="input column small-12 medium-3 large-2">
								<select name="type3">
									<option value="0">Quest</option>
									<option value="1">Item</option>
									<option value="2">Spell</option>
									<option value="3">NPC</option>
									<option value="4">Talent</option>
									<option value="5">Dungeon</option>
									<option value="6">Raid</option>
								</select>
							</div>
							<div class="input column small-12 medium-3 large-2">
								<input type="text" name="id3" />
							</div>
							<div class="input column small-12 medium-6 large-8">
								<input type="text" name="note3" />
							</div>

							<div class="input column small-12 medium-3 large-2">
								<select name="type4">
									<option value="0">Quest</option>
									<option value="1">Item</option>
									<option value="2">Spell</option>
									<option value="3">NPC</option>
									<option value="4">Talent</option>
									<option value="5">Dungeon</option>
									<option value="6">Raid</option>
								</select>
							</div>
							<div class="input column small-12 medium-3 large-2">
								<input type="text" name="id4" />
							</div>
							<div class="input column small-12 medium-6 large-8">
								<input type="text" name="note4" />
							</div>

							<div class="input column small-12 medium-3 large-2">
								<select name="type5">
									<option value="0">Quest</option>
									<option value="1">Item</option>
									<option value="2">Spell</option>
									<option value="3">NPC</option>
									<option value="4">Talent</option>
									<option value="5">Dungeon</option>
									<option value="6">Raid</option>
								</select>
							</div>
							<div class="input column small-12 medium-3 large-2">
								<input type="text" name="id5" />
							</div>
							<div class="input column small-12 medium-6 large-8">
								<input type="text" name="note5" />
							</div>

							<div class="submit column small-12">
								<div class="submit-left column small-6">
									<input type="submit" class="button rem-button" name="add" value="+" onclick="confirm('Will fix this later. - Bin4ry');" />
								</div>

								<div class="submit-right column small-6">
									<input type="submit" class="button small" name="submit-changes" value="Submit" />
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>

			<div class="content-content column small-12 medium-12 large-12">
				<div class="content-box column small-12 medium-12 large-12">
					<div class="content-box-header column small-12 medium-12 large-12">
						Recent Changelogs
					</div>

					<div class="content-box-content column small-12">
						<?php GrabChangelogs(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php

include('footer.php');

?>