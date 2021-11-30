<!DOCTYPE html>
<html class="login-page">
    <head>
        <?php load_dashboard_block('meta_header'); ?>
    </head>

    <body class="hold-transition">
        <div class="login-box <?=($error ? "w-error" : "");?>">
            <div class="login-box-body">
                <div class="text-center">
                    <a href="<?=base_url();?>" class="login-title"><?=strtoupper(site_name(0));?></a>
                </div>

                <p class="login-box-msg">Sign in to admin</p>

                <div class="login-error">
                    <?php if($error) echo '<div class="alert alert-danger text-center">'.$error.'</div>'; ?>
                </div>

                <form action="<?php base_url('admin/login') ?>" method="POST">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Username" name="username">
                    </div>

                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Password" name="password">
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary" name="submit">Sign In</button>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>