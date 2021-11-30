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
                                <div class="datatable-container">
                                    <table class="table" id="category_table" style="width: 100% !important">
                                        <thead>
                                            <tr>
                                                <th width="25%">Category ID</th>
                                                <th width="60%">Category Name</th>
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
                                <h6 class="card-title form-title">Add Category</h6>

                                <form action="" method="post">
                                    <div class="form-group">
                                        <label>Category Name</label>
                                        <input type="text" class="form-control" name="cat_name" required>
                                    </div>

                                    <div class="text-right">
                                        <button type="submit" class="btn btn-info btn-sm" name="submit" value="add">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="card edit-form hide">
                            <div class="card-body">
                                <h6 class="card-title form-title">Edit Category</h6>

                                <form action="" method="post">
                                    <div class="form-group">
                                        <label>Category Name</label>
                                        <input type="text" class="form-control cat_name" name="cat_name" required>
                                    </div>

                                    <div class="text-right">
                                        <input type="hidden" name="cat_id" id="cat_id">
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
    </div>
    
    <?php load_dashboard_block('meta_footer'); ?>

    <script type="text/javascript">
        var dataTable = $('#category_table').dataTable({
            "processing": true, 
            "serverSide": true,
            "order": [ 0, "asc" ], 
            "oLanguage": { 
                "sProcessing": "Please wait...",
                "sEmptyTable": "No categories to list"
            },
            "ajax":{  
                url: base_url + "ajax/admin_category_list",  
                type:"POST",
                dataType:"json",
                data: {
                    "page" : function(d) {
                        var pageInfo = $('#category_table').DataTable().page.info().page;
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

        $('.add-btn').on("click", function(){
            $('.add-form').removeClass("hide");
            $('.edit-form, .add-btn-container').addClass("hide");
            $('.cat_name, #cat_id').val("");
        });

        $(document).on("click", ".edit-category", function(){
            var val = $(this).data("id");
            $('.add-form').addClass("hide");
            $('.edit-form, .add-btn-container').removeClass("hide");

            if(val){
                $.ajax({
                    url: base_url + "ajax/get_data",
                    type : 'post',
                    dataType : 'json',
                    data : { id:val, type:"category" },
                    success:function(r){
                        if(r.status){
                            $('#cat_id').val(r.data.cat_id);
                            $('.cat_name').val(r.data.name);
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

        $(document).on("click", ".delete-category", function(){
            var id = $(this).data("id"),
                vendors = $(this).data("vendors"),
                c_msg = "Do you want to delete this category?";

            if(vendors) c_msg = "This category has vendors.\n" + c_msg;

            if( confirm(c_msg) ){
                $.ajax({
                    url: base_url + "ajax/delete_data",
                    type : 'post',
                    dataType : 'json',
                    data : { id:id, type:"category" },
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