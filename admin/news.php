<?php

include('header.php');

?>

<div class="row">
	<div class="content">
		<div class="content-content column small-12">
			<?php UpdateNews(); ?>
			<?php DeleteNews(); ?>
			<?php PostNews(); ?>

			<div class="content-content column small-12 medium-6 large-7">
				<div class="content-box column small-12 medium-12 large-12">
					<div class="content-box-header column small-12 medium-12 large-12">
						Write a new post
					</div>

					<div class="content-box-content column small-12">
						<form method="POST">
							<div class="box-strip column small-12">
								<label>News Title</label>
								<input type="text" name="title" />
							</div>

							<div class="box-strip column small-12">
								<textarea name="content" id="news-textarea"></textarea>
							</div>

							<div class="box-strip-button column small-12">
								<input type="submit" class="button small" name="post" value="Post" />
							</div>
						</form>
					</div>
				</div>
			</div>

			<?php EditNews(); ?>

			<div class="content-content column small-12 medium-6 large-5">
				<div class="content-box2 column small-12 medium-12 large-12">
					<div class="content-box-header column small-12 medium-12 large-12">
						Articles
					</div>

					<div class="content-box-content column small-12">
						<table>
							<?php GrabNews(); ?>
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