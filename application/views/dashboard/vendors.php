<?php $categories = categories(); ?>

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
                    <h3 class="text-primary"><?php echo $page_title; ?></h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php dashboard_url(); ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active"><?php echo $page_title; ?></li>
                    </ol>
                </div>
            </div>

            <div class="container-fluid">
                <?php notification(); ?>

                <div class="row column-forms">
                    <div class="col-md-9">
                        <div class="card addb-20">
                            <div class="card-body">
                                <div class="action-buttons pull-right">
                                    <a href="javascript:void(0)" class="btn btn-info btn-sm add_bulk" data-toggle="modal" data-target="#bulkVendors">Add Bulk Vendors</a>
                                </div>

                                <div class="filters">
                                    <select id="categorySel">
                                        <option value="all">- All Category -</option>
                                        <?php
                                            if( $categories ){
                                                foreach ($categories as $ck => $c)
                                                    echo '<option value="'.$c->cat_id.'">'.$c->name.'</option>';
                                            }
                                        ?>
                                    </select>
                                </div>

                                <div class="datatable-container">
                                    <table class="table" id="vendors_table" style="width: 100% !important">
                                        <thead>
                                            <tr>
                                                <th width="20%">Vendor ID</th>
                                                <th width="65%">Vendor Details</th>
                                                <th width="15%" class="no-sort">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="text-right mb-20 add-btn-container hide">
                            <button type="button" class="btn btn-info btn-sm add-btn">Add New</button>
                        </div>

                        <div class="card add-form">
                            <div class="card-body">
                                <h6 class="card-title form-title">Add Vendor</h6>

                                <form action="" method="post">
                                    <div class="form-group">
                                        <label>Vendor Name</label>
                                        <input type="text" class="form-control" name="name" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Vendor Website</label>
                                        <textarea class="form-control" rows="5" name="website" required></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label>Category</label>
                                        <select class="form-control" name="category" required>
                                            <option value="">- Select Category -</option>
                                            <?php
                                                if( $categories ){
                                                    foreach ($categories as $ck => $c)
                                                        echo '<option value="'.$c->cat_id.'">'.$c->name.'</option>';
                                                }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="text-right">
                                        <button type="submit" class="btn btn-info btn-sm" name="submit" value="add">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="card edit-form hide">
                            <div class="card-body">
                                <h6 class="card-title form-title">Edit Vendor</h6>

                                <form action="" method="post">
                                    <div class="form-group">
                                        <label>Vendor Name</label>
                                        <input type="text" class="form-control vendor-name" name="name" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Vendor Website</label>
                                        <textarea class="form-control vendor-website" rows="5" name="website" required></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label>Category</label>
                                        <select class="form-control vendor-category" name="category" required>
                                            <option value="">- Select Category -</option>
                                            <?php
                                                if( $categories ){
                                                    foreach ($categories as $ck => $c)
                                                        echo '<option value="'.$c->cat_id.'">'.$c->name.'</option>';
                                                }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="text-right">
                                        <input type="hidden" name="vendor_id" id="vendor_id">
                                        <button type="submit" class="btn btn-info btn-sm" name="submit" value="edit">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php load_dashboard_block('phtml_footer'); ?>            
        </div>

        <div class="modal fade" id="bulkVendors" tabindex="-1" role="dialog" aria-labelledby="bulkVendors" aria-hidden="true" data-keyboard="false">
            <div class="modal-dialog modal-lg" role="document" style="max-width: 350px">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">UPLOAD BULK VENDORS</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <a href="<?=theme_uri("upload_vendors.csv");?>" target="_blank">Get CSV Format</a>
                            </div>

                            <div class="form-group">
                                <label>Upload CSV</label>
                                <input type="file" name="csv_list" required style="width: 100%" accept=".csv">
                            </div>

                            <div class="text-right">
                                <button type="submit" class="btn btn-info btn-sm" name="submit" value="bulk">Upload</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <?php load_dashboard_block('meta_footer'); ?>

    <script type="text/javascript">
        var dataTable = $('#vendors_table').dataTable(),
            cat = 'all';      

        vendors_table();

        function vendors_table(){
            dataTable.fnDestroy();
            dataTable.find('tbody').html('');
            dataTable = $('#vendors_table').dataTable({
                "processing": true, 
                "serverSide": true,
                "order": [ 0, "asc" ], 
                "oLanguage": { 
                    "sProcessing": "Please wait...",
                    "sEmptyTable": "No vendors to list"
                },
                "ajax":{  
                    url: base_url + "ajax/admin_vendor_list",  
                    type:"POST",
                    dataType:"json",
                    data: {
                        category:cat,
                        "page" : function(d) {
                            var pageInfo = $('#vendors_table').DataTable().page.info().page;
                            return pageInfo;
                        }
                    }, 
                    "error":function(e){
                        console.log(e.responseText);
                        if(e.responseText.search("Sign in to your account") != -1){
                            window.location.reload();  
                        }
                    }      
                },
                "aoColumnDefs": [{'bSortable': false,'aTargets': 'no-sort' },],
            });
        }

        $('#categorySel').on('change', function(){
            cat = $(this).val();
            vendors_table();
        });

        $('.add-btn').on("click", function(){
            $('.add-form').removeClass("hide");
            $('.edit-form, .add-btn-container').addClass("hide");
            $('.vendor-name, .vendor-website, .vendor-category, #vendor_id').val("");
        });

        $(document).on("click", ".edit-vendor", function(){
            var val = $(this).data("id");
            $('.add-form').addClass("hide");
            $('.edit-form, .add-btn-container').removeClass("hide");

            if(val){
                $.ajax({
                    url: base_url + "ajax/get_data",
                    type : 'post',
                    dataType : 'json',
                    data : { id:val, type:"vendor" },
                    success:function(r){
                        if(r.status){
                            $('#vendor_id').val(r.data.vendor_id);
                            $('.vendor-name').val(r.data.vendor_name);
                            $('.vendor-website').val(r.data.vendor_website);
                            $('.vendor-category').val(r.data.category);
                        } else{
                            $toast = toastr['error']('An error occurred, please reload the page and try again');
                        }
                    }, error:function(e){
                        console.log(e.responseText);
                    }
                });
            } else{
                $toast = toastr['error']('An error occurred, please reload the page and try again');
            }
        });

        $(document).on("click", ".delete-vendor", function(){
            var id = $(this).data("id");

            if( confirm("Do you want to delete this vendor?") ){
                $.ajax({
                    url: base_url + "ajax/delete_data",
                    type : 'post',
                    dataType : 'json',
                    data : { id:id, type:"vendor" },
                    success:function(r){
                        if(r) location.reload();
                    }, error:function(e){
                        console.log(e.responseText);
                    }
                });
            }
        });
    </script>
</body>
</html>