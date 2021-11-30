<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
class Dashboard extends CI_Controller {
		
	function __construct(){
		parent::__construct();
		$this->load->database(); 
		$this->load->library('session');
		// $this->load->helper('ckeditor');
	}

	public function index(){
		$segment_2 = segment(2);
		$segment_3 = segment(3);
		$segment_4 = segment(4);

		if($segment_2){
			if($segment_2 == "login") {
				$this->_load_login();
			} elseif($segment_2 == "vendors") {
				$this->_load_vendors();
			} elseif($segment_2 == "categories") {
				$this->_load_categories();
			} elseif($segment_2 == "configuration") {
				$this->_load_configuration();
			} elseif($segment_2 == "logout") {
				$this->_load_logout();
			} else {
				$this->_load_page_not_found();
			}
		} else{
			redirect( dashboard_url("vendors", 0) );
		}
	}

	public function _load_login() {
		if( is_login() ){
			redirect( dashboard_url(null, 0) );
		} else{
			$data['error'] = "";

			if(isset($_POST['submit'])){
				extract($_POST);

				$uname = get_option('username');
				$pword = get_option('password');
				$hash_pword = hash_password($password, $this->config->item('app_salt'));

				if( $uname == $username && $pword == $hash_pword ){
					$this->session->set_userdata('is_login', TRUE);
					redirect( dashboard_url(null, 0) );
				} else{
					$data['error'] = 'Incorrect username or password';
				}
			}

			load_dashboard_view('login', $data);
		}
	}

	public function _load_vendors() {
		validate_user_permission();
		$data['page_title'] = "Vendors";

		if( isset($_POST['submit']) ) {
			extract($_POST);

	        if($submit == "add"){
	        	$vendor_data = array(
					"vendor_name" => trim($name),
					"vendor_url" => generate_url($name, 'vendor'),
					"vendor_website" => $website,
					"category" => $category,
				);

				if( update_vendor(null, $vendor_data) ){
					$response = array(
						'type'=>'success',
						'message'=>' Successfully added the vendor'
					);
				} else{
					$response = array(
						'type'=>'danger',
						'message'=>' Failed to add the vendor'
					);
				}
	        } elseif($submit == "edit"){
	        	if( $vendor = vendor($vendor_id) ){
	        		$vendor_data = array(
		        		"vendor_name" => trim($name),
						"vendor_website" => $website,
						"category" => $category,
	        		);

	        		if($vendor->vendor_name != $name)
	        			$vendor_data['vendor_url'] = generate_url($name, 'vendor');

					if( update_vendor($vendor->vendor_id, $vendor_data) ){
						$response = array(
							'type'=>'success',
							'message'=>' Successfully updated the vendor'
						);
					} else{
						$response = array(
							'type'=>'danger',
							'message'=>' Failed to update the vendor'
						);
					}
	        	} else{
	        		$response = array(
						'type'=>'danger',
						'message'=>' An error occurred, please try again'
					);
	        	}
	        } else{ // bulk upload
				$error = array();
				$success = false;
				ini_set('memory_limit', '-1');

				$config['upload_path'] = FCPATH."assets/csv/"; 
				$up_response = upload_csv_file($config);

				if (($handle = fopen($up_response['data']['full_path'], "r")) !== FALSE) {			
					$row = 1;

				    while (($f_data = fgetcsv($handle,0, ",")) !== FALSE) {
				    	if($row != 1){
							$vendor_data = array(
								"vendor_name" => trim($f_data[0]),
								"vendor_url" => generate_url($f_data[0], 'vendor'),
								"vendor_website" => $f_data[1],
								"category" => $f_data[2],
							);

							if( update_vendor(null, $vendor_data) ){
								$success = true;
							} else{
								$error[] = $row;
							}
						}

						$row++;
				    }

				    fclose($handle);
				}

				if($success){
					$response = array(
						'type'=>'success',
						'message'=>' Successfully uploaded vendors'
					);
				} else{
					$response = array(
						'type'=>'danger',
						'message'=>' Failed to upload vendors'
					);
				}

				if($error) $response['message'] .= "<br>Error uploads (rows): ".implode(", ", $error);
			}

			$this->session->set_flashdata('message',$response);
			redirect( dashboard_url("vendors", 0) );
		}

		load_dashboard_view('vendors', $data);
	}

	public function _load_categories(){
		validate_user_permission();
		$data['page_title'] = "Categories";

		if( isset($_POST['submit']) ) {
			extract($_POST);

	        if($submit == "add"){
	        	$cat_data = array(
					"name" => trim($cat_name),
					"url" => generate_url($cat_name, 'category'),
				);

				if( update_category(null, $cat_data) ){
					$response = array(
						'type'=>'success',
						'message'=>' Successfully added the category'
					);
				} else{
					$response = array(
						'type'=>'danger',
						'message'=>' Failed to add the category'
					);
				}
	        } else{
	        	if( $cat = category($cat_id) ){
	        		$cat_data = array(
		        		'name' => trim($cat_name),
	        		);

	        		if($cat->name != $cat_name)
	        			$cat_data['url'] = generate_url($cat_name, 'category');

					if( update_category($cat->cat_id, $cat_data) ){
						$response = array(
							'type'=>'success',
							'message'=>' Successfully updated the category'
						);
					} else{
						$response = array(
							'type'=>'danger',
							'message'=>' Failed to update the category'
						);
					}
	        	} else{
	        		$response = array(
						'type'=>'danger',
						'message'=>' An error occurred, please try again'
					);
	        	}
	        }

	        $this->session->set_flashdata('message',$response);
			redirect( dashboard_url("categories", 0) );
		}

		load_dashboard_view('categories', $data);
	}

	public function _load_configuration() {
		validate_user_permission();
		$data['page_title'] = "Configuration";

		if(isset($_POST['submit'])){
			extract($_POST);

			if($submit == "access"){
				$msg = null;
				$type = "danger";

				$hash_old = hash_password($oldpword, $this->config->item('app_salt'));
				if($hash_old != get_option("password")){
					$msg = ' Incorrect old password';
				} else if($oldpword == $newpword){
					$msg = ' Old and new password must not be the same';
				} elseif($newpword != $cfnewpword) {
					$msg = ' New and confirm new password do not match';
				} else{
					$newpword = hash_password($newpword, $this->config->item('app_salt'));
					set_option("password", $newpword);
					$msg = ' Successfully updated your password';
					$type = "success";
				}

				$response = array(
					'type' => $type,
					'message' => $msg,
				);
			} else{
				foreach($_POST as $key => $option)
					if($key != "submit") set_option($key, $option);

				$response = array(
					'type' => 'success',
					'message' => ' Website configuration successfully updated!',
				);
			}

			$this->session->set_flashdata('message',$response);
			redirect( dashboard_url("configuration", 0) );
		}

		load_dashboard_view('configuration', $data);
	}	

	public function _load_logout() {
		$this->session->set_userdata('is_login',FALSE);
		$this->session->sess_destroy();
		redirect( dashboard_url("login", 0) );
	}

	public function _load_page_not_found() {
		load_view('dashboard/404');
	}

	// function _loadCKEditor(){
	// 	$this->load->library('CKEditor');
	// 	$ckeditorpath = base_url().'assets/dashboard/plugins/ckeditor/';
	// 	$this->ckeditor->basePath = $ckeditorpath;
	// 	$this->ckeditor->config['width'] = '100%';
	// 	$this->ckeditor->config['height'] = '300px';
	// }
}
