<!DOCTYPE html>
<html lang="en">

<head>
    <?php load_dashboard_block('meta_header'); ?>
</head>

<body class="fix-header fix-sidebar">
    <div id="main-wrapper">
        <?php load_dashboard_block('phtml_header'); ?>
        <?php load_dashboard_block('phtml_sidebar'); ?>

        <div class="page-wrapper">
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-primary"><?php echo $page_title; ?></h3> </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php dashboard_url(); ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active"><?php echo $page_title; ?></li>
                    </ol>
                </div>
            </div>

            <div class="container-fluid">
                <?php notification(); ?>

                <div class="card mb-20">
                    <div class="card-body">
                        <h3 class="card-title config-title">Website Configuration</h3>

                        <div class="config-container">
                            <div class="config-header">
                                <div class="row">
                                    <div class="col-md-4"><h3><i class="fa fa-edit"></i>Label</h3></div> 
                                    <div class="col-md-4"><h3><i class="fa fa-key"></i>Key</h3></div>
                                    <div class="col-md-4"><h3><i class="fa fa-th-list"></i>Value</h3></div>
                                </div>
                            </div>

                            <form action="" method="POST">
                                <?php
                                $items = configurations(array("config_group"=>1));
                                foreach($items as $key=>$item): ?>
                                    <div class="form-group row">
                                        <label for="input-<?=$item->key;?>" class="col-md-4"><?=$item->label;?></label>
                                        <div class="col-md-4"><?=$item->key;?></div>

                                        <div class="col-md-4">    
                                        <?php
                                        if($item->input_type == "text"){
                                            echo '<input type="text" class="form-control" name="'.$item->key.'" value="'.$item->value.'" placeholder="'.$item->label.'" id="input-'.$item->key.'">';
                                        } else{
                                            echo '<textarea class="form-control" name="'.$item->key.'" placeholder="'.$item->label.'" id="input-'.$item->key.'" rows="5">'.$item->value.'</textarea>';
                                        }
                                        ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>

                                <div class="text-right">
                                    <button type="submit" name="submit" class="btn btn-info" value="website">Save Changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="card mb-20">
                    <div class="card-body">
                        <h3 class="card-title config-title">Account Access</h3>

                        <form action="" method="POST">
                            <div class="row form-group">
                                <div class="col-md-6">
                                    <label class="control-label">Old Password</label>
                                    <input type="password" class="form-control" name="oldpword" required autocomplete="off">
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-md-6">
                                    <label class="control-label">New Password</label>
                                    <input type="password" class="form-control" name="newpword" required autocomplete="off">
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-md-6">
                                    <label>Confirm New Password</label>
                                    <input type="password" class="form-control" name="cfnewpword" required autocomplete="off">
                                </div>
                            </div>

                            <div class="text-right">
                                <button type="submit" name="submit" class="btn btn-info" value="access">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <?php load_dashboard_block('phtml_footer'); ?>            
        </div>
    </div>
    
    <?php load_dashboard_block('meta_footer'); ?>
</body>
</html>