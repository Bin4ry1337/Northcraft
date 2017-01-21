<div class="row2">
	<div class="footer columns small-12 medium-12">
		<div class="row">
			<div class="footer column small-12 medium-12">
				<div class="footer-box column small-12 medium-4">
					<div class="footer-title">
						Get Started
					</div>

					<div class="footer-content">
						<ul class="footer-menu">
							<li><a href="../client/connect.php">How to Connect</a></li>
							<li><a href="../client/downloads.php">Download Client</a></li>
							<li><a href="../community/changelog.php">Changelog</a></li>
							<li><a href="../forums/">Forums</a></li>
							<li><a href="../armory/armory.php">Armory</a></li>
						</ul>
					</div>
				</div>

				<div class="footer-box column small-12 medium-3 medium-offset-1">
					<div class="footer-title">
						Information
					</div>

					<div class="footer-content">
						<ul class="footer-menu">
							<li><a href="../policies/terms.php">Terms of Service</a></li>
							<li><a href="../policies/privacy.php">Prvacy Policy</a></li>
							<li><a href="../policies/refund.php">Refund Policy</a></li>
							<li><a href="../community/faq.php">FAQ</a></li>
							<li><a href="../community/support.php">Support</a></li>
						</ul>
					</div>
				</div>

				<div class="footer-box column small-12 medium-2 medium-offset-1">
					<div class="footer-title">
						Follow Us
					</div>

					<div class="footer-content">
						<ul class="social-menu">
							<li><a href="<?php echo $GeneralConfig['FACEBOOK']; ?>"><img src="../img/icons/fb.png" width="40"></a></li>
							<li><a href="<?php echo $GeneralConfig['YOUTUBE']; ?>"><img src="../img/icons/yt.png" width="40"></a></li>
							<li><a href="<?php echo $GeneralConfig['REDDIT']; ?>"><img src="../img/icons/rt.png" width="40"></a></li>
						</ul>
					</div>
				</div>
			</div>

			<div class="footer column small-12">
				<div class="copyright column small-12">
					<div class="copyright-main">	
						Copyright © 2016 <a href="http://worldnorthcraft.com">Worldofnorthcraft.com</a> - All rights reserved. 
					</div>

					<div class="copyright-sub">
						Wrath of the Lich King, World of Warcraft and Blizzard Entertainment 
						are trademarks or registered trademarks of Blizzard Entertainment, Inc. 
						This site is in no way associated with Blizzard Entertainment.
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="login-modal" class="reveal-modal" data-reveal aria-hidden="true" role="dialog">
  	<div class="modal-box">
  		<form method="POST">
	  		<div class="modal-header">
	  			Login to an existing account
	  		</div>

	  		<div class="modal-contents">
	  			<div class="modal-content-box">
		  			<label>Username</label>
		  			<input type="text" name="username" />
		  			
		  			<label>Password</label>
	  				<input type="password" name="password" />
		  			
		  			<div id="g-recaptcha" data-sitekey="6Ld8gigTAAAAAAEF6MiiuKw0H0DybEVe4PDi0AaV"></div>

		  			<input type="submit" name="login" value="Login" class="button small" />
	  			</div>
	  		</div>
	  	</form>
  	</div>
  	<a class="close-reveal-modal" aria-label="Close">&#215;</a>
</div>

<div id="register-modal" class="reveal-modal" data-reveal aria-hidden="true" role="dialog">
  	<div class="modal-box">
  		<form method="POST">
	  		<div class="modal-header">
	  			Register a new account
	  		</div>

	  		<div class="modal-contents">
	  			<div class="modal-content-box">
		  			<label>Username</label>
		  			<input type="text" name="username" />
		  			
		  			<label>Email</label>
	  				<input type="text" name="email" />
		  			
		  			<label>Password</label>
	  				<input type="password" name="password" />
		  			
		  			<label>Re-Password</label>
	  				<input type="password" name="re-password" />
		
		  			<label>User Agreement</label>
	  				<label for="checkbox1">
		  				<input id="box1" type="checkbox" name="agreement" />
  						<label for="box1">By registering to our service you agree that you are over 13 years old and you accept our <a href="http://worldofnorthcraft.com/policies/terms.php">Terms of Service</a> and <a href="http://worldofnorthcraft.com/policies/privacy.php">Privacy Policy</a>.</label>
		  			</label>

		  			<div id="g-recaptcha2" data-sitekey="6Ld9gigTAAAAALSt-Um1KsdQpquhmaO7ROAvvSLE"></div>
		  			
		  			<input type="submit" name="register" value="Register" class="button small" />
	  			</div>
	  		</div>
	  	</form>
	</div>
  	<a class="close-reveal-modal" aria-label="Close">&#215;</a>
</div>

</body>
</html>

