<?php

function site_name($echo=1){
	$name = get_option("site_title");
	if($echo)
		echo $name;
	else
		return $name;
}

function theme_uri($path=null){
	return base_url('assets/'.$path);
}

function load_view($filename=null, $data=null){
 	$that=&get_instance();
 	$that->load->view($filename, $data); 
}

function dashboard_theme_uri($path=null){
	return base_url('assets/dashboard/'.$path);
}

function load_dashboard_block($filename=null,$data=null){
 	load_dashboard_view("block/".$filename,$data);
}

function load_dashboard_view($filename=null, $data=null){
 	$that=&get_instance();
 	$that->load->view("dashboard/".$filename, $data); 
}

function dashboard_url($url=null, $action=1) {
	if($action)
		echo base_url('dashboard/'.$url);
	else
		return base_url('dashboard/'.$url);
}

function segment($part){
	$that=&get_instance();
	return $that->uri->segment($part);
}

function canonical_segment($url){
	$that=&get_instance();
	if(segment(1) == TRUE)
		$url .= segment(1);
	if(segment(2) == TRUE)
	 	$url .= '/'.segment(2);
 	if(segment(3) == TRUE)
 		$url .= '/'.segment(3);
 	if(segment(4) == TRUE)
 		$url .= '/'.segment(4);
 	if(segment(5) == TRUE)
 		$url .= '/'.segment(5);
 	if(segment(6) == TRUE)
 		$url .= '/'.segment(6);
 	echo $url;
}

function notification() {
	$that =& get_instance();
	$that->load->library('Notif');
	echo $that->notif->show();
}



// login functions

function validate_user_permission() {
	if( is_login() ) {
		return 1;
	} else{
		redirect( base_url() );
	}
}

function is_login() {
	$that =& get_instance();
	$that->load->library('session');
	$session = $that->session->userdata;
	return ( isset( $session['is_login'] ) ? true : false );
}



// url functions

function generate_url($data, $type="page") {
	$slug_url = slugify($data);
	$url = $slug_url;
	$param = 1;

	if($type == "category") {
		while (category($url, array("key"=>"url"))) {
		    $param++;
		    $url = $slug_url.'-'.$param;
		}
	} elseif($type == "vendor") {
		while (vendor($url, array("key"=>"vendor_url"))) {
		    $param++;
		    $url = $slug_url.'-'.$param;
		}
	}

	return $url;
}

function slugify($text){ 
	// replace non letter or digits by -
	$text = preg_replace('~[^\\pL\d]+~u', '-', $text);
	
	// trim
	$text = trim($text, '-');
	
	// transliterate
	$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
	
	// lowercase
	$text = strtolower($text);
	
	// remove unwanted characters
	$text = preg_replace('~[^-\w]+~', '', $text);
	
	if (empty($text)){
	    return 'n-a-'.rand(1,99999);
	}

	return $text;
}



// config function

function set_option($key, $value){
	$that =& get_instance();
	$that->load->model('config_model');
	return $that->config_model->set_option($key, $value);
}

function get_option($key){
	$that =& get_instance();
	$that->load->model('config_model');
	return $that->config_model->get($key);
}

function configurations($options=null){
	$that =& get_instance();
	$that->load->model('config_model');
	return $that->config_model->get_all($options);
}

function hash_password($pword, $salt){
	$that =& get_instance();
	$that->load->model('config_model');
	return $that->config_model->hash_password($pword, $salt);
}



// breadcrumbs

function breadcrumbs($page_title=null) {
	$that =& get_instance();
	$links = array(array( 'label'=>'Home','link'=>base_url() ));

	$segment_1 = segment(1);
	$segment_2 = segment(2);

	if ( $segment_1 == 'filetypes' ){
		if($segment_2)
			$links[] = array( 'label'=>"File Types", 'link'=>base_url("filetypes") );
	} else if( $segment_1 == 'software' ){
		if($segment_2)
			$links[] = array( 'label'=>"Software", 'link'=>base_url("software") );
	} else if( $segment_1 == 'extension' ){
		$ext = file_type( urldecode($segment_2), array("key"=>"file_extension_url") );
		$cat = category($ext->category);
		$links[] = array( 'label'=>"File Types", 'link'=>base_url("filetypes") );
		$links[] = array( 'label'=>$cat->category_name, 'link'=>base_url("filetypes/".$cat->category_url) );
	}

	$links[] = array( 'label'=>$page_title );

	echo "<span>";
	$total = count($links) - 1;
	foreach ($links as $key => $link) {
		if( $key < $total )
			echo '<a href="'.$link["link"].'">'.$link["label"].'</a> / ';
		else
			echo $link['label'];	
	}
	echo "</span>";
}



// categories functions

function update_category($id=null, $data=null){
	$that =& get_instance();
	$that->load->model('categories_model');
	if($id) return $that->categories_model->update($id, $data);
	else return $that->categories_model->insert($data);
}

function category($id=null, $options=null){
	$that =& get_instance();
	$that->load->model('categories_model');
	return $that->categories_model->get($id, $options);
}

function categories($options=null){
	$that =& get_instance();
	$that->load->model('categories_model');
	return $that->categories_model->get_all($options);
}



// vendors functions

function update_vendor($id=null, $data=null){
	$that =& get_instance();
	$that->load->model('vendors_model');
	if($id) return $that->vendors_model->update($id, $data);
	else return $that->vendors_model->insert($data);
}

function vendor($id=null, $options=null){
	$that =& get_instance();
	$that->load->model('vendors_model');
	return $that->vendors_model->get($id, $options);
}

function vendors($options=null){
	$that =& get_instance();
	$that->load->model('vendors_model');
	return $that->vendors_model->get_all($options);
}



// upload functions

function upload_image($options=null) {	
	$that =& get_instance();
	$that->load->helper('string');
	ini_set('memory_limit', '-1');

	$config = array(
		'upload_path' => './uploads/',
		'allowed_types' => 'gif|jpg|png|jpeg|GIF|JPG|PNG|JPEG',
		'max_size'=> 0,
		'max_width'=> 0,
		'max_height'=> 0
	);

	$input_name = 'userfile';

	if(isset($options)) {
		extract($options);
		if(isset($folder)) $config['upload_path'] = './uploads/'.$folder;
		if(isset($max_size)) $config['max_size'] = $max_size;
		if(isset($max_width)) $config['max_width'] = $max_width;
		if(isset($max_height)) $config['max_height'] = $max_height;
		if(isset($input_name)) $config['input_name'] = $input_name;
		if(isset($upload_path)) $config['upload_path'] = $upload_path;
	}

    $that->load->library('upload', $config);

    $return = array();
    if($_FILES['userfile']['name']){
		$ext = pathinfo($_FILES['userfile']['name'], PATHINFO_EXTENSION);
	    $new_name = random_string('alnum', 20).".".$ext;
		$_FILES['userfile']['name'] = $new_name;

	    if ( ! $that->upload->do_upload($input_name)) {
	        $return = array(
	        	'status'=>0,
	        	'error' => $that->upload->display_errors()
	        );
	    } else {
	    	$return = array(
	        	'status'=>1,
	        	'data' => $that->upload->data()
	        );
	    }
	}

    return $return;
}

function upload_csv_file($options=null) {	
	$that =& get_instance();
	ini_set('memory_limit', '-1');
	$config = array(
		'upload_path' => './uploads/',
		'allowed_types' => 'csv|CSV',
		'max_size'=> 0,
	);

	$file_name = 'csv_list';

	if(isset($options)) {
		extract($options);
		if(isset($max_size)) $config['max_size'] = $max_size;
		if(isset($input_name)) $config['input_name'] = $input_name;
		if(isset($upload_path)) $config['upload_path'] = $upload_path;
	}

    $that->load->library('upload', $config);
        
    if ( ! $that->upload->do_upload($file_name)) {
        $return = array(
        	'status'=>0,
        	'error' => $that->upload->display_errors()
        );
    } else {
        $return = array(
        	'status'=>1,
        	'data' => $that->upload->data()
        );
    }

    return $return;
}