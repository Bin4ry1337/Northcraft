<?php

include('header.php');

?>

<div class="row">
	<div class="content">
		<div class="content-content column small-12">
			<?php DeleteTicket(); ?>
			<div class="content-content column small-12 medium-12 large-12">
				<div class="content-box2 column small-12 medium-12 large-12">
					<div class="content-box-header column small-12 medium-12 large-12">
						Tickets
					</div>

					<div class="content-box-content column small-12">
						<?php GrabTickets(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php

include('footer.php');

?>