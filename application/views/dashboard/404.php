<!DOCTYPE html>
<html lang="en">
<head>
    <?php load_dashboard_block('meta_header'); ?>
</head>

<body class="fix-header fix-sidebar">
    <div class="error-page" id="wrapper">
        <div class="error-box">
            <div class="error-body text-center">
                <h1>404</h1>
                <h3 class="text-uppercase">Page not found </h3>
                <p class="text-muted">Sorry! The page you are looking for doesn't exist.</p>
                <a href="<?php dashboard_url(); ?>" class="btn btn-info btn-rounded">Back to Dashboard</a>
            </div>
        </div>
    </div>
</body>
</html>