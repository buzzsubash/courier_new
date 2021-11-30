<?php load_view("inc/header.php"); ?>

<div class="breadcrumbs-container">
	<div class="container">
		<?php breadcrumbs($page_title); ?>
	</div>
</div>

<div role="main" class="main">
    <div class="container not-found-contents">
        <div class="not-found-header">
            <h1>404</h1>
            <h3>NOT FOUND</h3>
        </div>

        <p>We're sorry, but the page you were looking for doesn't exist.</p>
    </div>
</div>

<?php load_view("inc/footer.php"); ?>