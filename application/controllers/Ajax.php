<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
class Ajax extends CI_Controller {
		
	function __construct(){
		parent::__construct();
		$this->load->database();
        $this->load->library('session');
        $this->load->model("vendors_model");
        $this->load->model("categories_model");
	}

    public function get_data(){
        $response = array("status"=>0);
        extract($_POST);

        if(isset($id) && $id != ""){
            if($type == "category"){
                if($cat = category($id)){
                    $response = array(
                        "status"=>1,
                        "data"=>$cat,
                    );
                }
            } else if($type == "vendor"){
                if($vendor = vendor($id)){
                    $response = array(
                        "status"=>1,
                        "data"=>$vendor,
                    );
                }
            }
        }

        echo json_encode($response);
    }

    public function delete_data(){
        $response = false;
        extract($_POST);

        if(isset($id) && $id != ""){
            if($type == "category"){
                $this->categories_model->trash($id);
            } else {
                $this->vendors_model->trash($id);
            }

            $response = array(
                'type'=>'success',
                'message'=>' Successfully deleted the '.$type
            );
            $this->session->set_flashdata('message',$response);
            $response = true;
        }

        echo json_encode($response);
    }

    // for vendors table
    public function admin_vendor_list(){
        if(isset($_POST['order'])){
            if($_POST['order'][0]['column'] == 0)
                $order = 'vendor_id '.$_POST['order']['0']['dir'];
            if($_POST['order'][0]['column'] == 1)
                $order = 'vendor_name '.$_POST['order']['0']['dir'].", vendor_id ASC";
        }

        $vendors = $this->vendors_model->get_admin_vendor_list( array( 'order_by'  => $order ) );
        $data = array();

        if($vendors['result']){
            $recordsTotal = $vendors['recordsTotal'];
            $recordsFiltered = $vendors['recordsFiltered'];

            foreach($vendors['result'] as $v) {
                $category = ($v->cat_id ? $v->name : "N/A");

                $row = array();

                $row[] = $v->vendor_id;

                $row[] = '<p><b>Name:</b> '.$v->vendor_name.'</p>
                    <p><b>Website:</b> <a href="'.$v->vendor_website.'" target="_blank">'.$v->vendor_website.'</a></p>
                    <p><b>Category:</b> '.$category.'</p>';

                $row[] = '<a href="javascript:void(0)" data-id="'.$v->vendor_id.'" class="edit-vendor table-link" title="Edit Vendor"><i class="fa fa-pencil-square-o"></i></a>
                    <a href="javascript:void(0)" data-id="'.$v->vendor_id.'" class="delete-vendor table-link" title="Delete Vendor"><i class="fa fa-trash"></i></a>';

                $data[] = $row;         
            }
        } else {
            $recordsTotal = 0;
            $recordsFiltered = 0;
        }

        $output = array(  
            "draw" => $_POST['draw'],  
            "recordsTotal" => $recordsTotal,
            "recordsFiltered" => $recordsFiltered,
            "data" => $data,
        );  
        
        echo json_encode($output);
    }

    // for categories table
    public function admin_category_list(){
        if(isset($_POST['order'])){
            if($_POST['order'][0]['column'] == 0)
                $order = 'cat_id '.$_POST['order']['0']['dir'];
            if($_POST['order'][0]['column'] == 1)
                $order = 'name '.$_POST['order']['0']['dir'];
        }

        $categories = $this->categories_model->get_admin_category_list( array( 'order_by'  => $order ) );
        $data = array();

        if($categories['result']){
            $recordsTotal = $categories['recordsTotal'];
            $recordsFiltered = $categories['recordsFiltered'];

            foreach($categories['result'] as $c) {
                $w_vendor = ( $this->vendors_model->count( array("category"=>$c->cat_id) ) ? 1 : 0);

                $row = array();

                $row[] = $c->cat_id;

                $row[] = $c->name;

                $row[] = '<a href="javascript:void(0)" data-id="'.$c->cat_id.'" class="edit-category table-link" title="Edit Category"><i class="fa fa-pencil-square-o"></i></a>
                    <a href="javascript:void(0)" data-id="'.$c->cat_id.'" data-vendors="'.$w_vendor.'" class="delete-category table-link" title="Delete Category"><i class="fa fa-trash"></i></a>';

                $data[] = $row;         
            }
        } else {
            $recordsTotal = 0;
            $recordsFiltered = 0;
        }

        $output = array(  
            "draw" => $_POST['draw'],  
            "recordsTotal" => $recordsTotal,
            "recordsFiltered" => $recordsFiltered,
            "data" => $data,
        );  
        
        echo json_encode($output);
    }
}