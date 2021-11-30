<?php load_view("inc/header.php"); ?>



<div role="main" class="main">
	<div class="container">
		<div id="content">
			<?php
				$file = (isset($file) && $file != "" ? $file : "page_content");
				load_view($file);
			?>
		</div>
	</div>
</div>

<?php load_view("inc/footer.php"); ?>
