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
			    <li><a href="support.php" class="current-nav">Support</a></li>
			</ul>
		</div>
	</div>
</div>

<div class="row">
	<div class="content columns small-12 medium-12">
		<div class="row">
			<div class="content-box column small-12 medium-12">
				<div class="box-header">
					Support
				</div>

				<div class="box-content">
					<div class="support">
						<form method="POST">
							<div class="support-box">
								<label>Your Email</label>
								<input type="text" name="email" />
							</div>

							<div class="support-box">
								<label>Subject</label>
								<input type="text" name="subject" />
							</div>

							<div class="support-box">
								<label>Message</label>
								<textarea name="message"></textarea>
							</div>

							<div class="support-box">
								<div id="g-recaptcha3" data-sitekey="6LdOmigTAAAAANVmsHLMSjaPhMti2FQ5ogO1ZJQ6"></div>
							</div>

							<div class="support-box">
								<input type="submit" class="button small" name="send" value="Send" />
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php

include('footer.php');

?>