<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function index(){
		if($segment_1 = segment(1)) {
			if(category($segment_1, array("key"=>"url"))) {
				if($segment_2 = segment(2)) {
					if(strpos($segment_2, "tracking-") !== false) {
						if($vendor = vendor(substr($segment_2, 9), array("key"=>"vendor_url"))) {
							$this->_load_vendor($vendor);
						} else {
							$this->_load_page_not_found();
						}
					} elseif($vendor = vendor($segment_2, array("key"=>"vendor_url"))) {
						$this->_load_vendor_result($vendor);
					} else {
						$this->_load_page_not_found();
					}
				} else {
					$this->_load_page_not_found();
				}
			} elseif($segment_1 == "privacy-policy"){
				$this->_load_privacy_policy();
			} else {
				$this->_load_page_not_found();
			}
		} else {
			$this->_load_frontpage();
		}
	}

	public function _load_frontpage() {
		$data = array(
            'robots' => "index",
			'title' => "Courier And Order Tracking in India - Track Courier Delivery Status Online",
			'description' => "Couriertracking.org.in Track courier offers easy to use online parcel / shipment / article / packet tracking solution for more than 130 courier services operating in India including speedpost, dtdc, professional, aramex, dhl, first flight, bluedart, fedex, shree mahavir, shree anjani, flipkart etc.",
			'page_type' => "home",
		);
		load_view("templates/home", $data);
	}

	public function _load_vendor($vendor){
		$data = array(
            'robots' => "index",
			'title' => "Track $vendor->vendor_name Courier Delivery Status Online | Tracking $vendor->vendor_name Package",
			'description' => "Easily track status of " .$vendor->vendor_name. " shipment tracking. ✈ Enter $vendor->vendor_name courier tracking awb number and submit to get delivery status online of your parcel, package etc.",
            'page_title' => $vendor->vendor_name,
			'page_type' => "page",
			'file' => "vendor",
			'vendor' => $vendor,
		);
		load_view("templates/page", $data);
	}

	public function _load_vendor_result($vendor){
		$data = array(
            'robots' => "noindex",
            'title' => $vendor->vendor_name." shipment tracking",
			'description' => "",
			'page_title' => $vendor->vendor_name,
			'page_type' => "page",
			'file' => "tracking",
			'vendor' => $vendor,
		);
		load_view("templates/page", $data);
	}

	public function _load_privacy_policy(){
		$data = array(
            'robots' => "index",
			'title' => "Privacy Policy",
			'description' => "",
			'page_title' => "Privacy Policy",
			'page_type' => "page",
			'file' => "privacy_policy",
		);
		load_view("templates/page", $data);
	}

	public function _load_page_not_found($type=null){
		if(!$type) $type = "page";

		$data = array(
			header("HTTP/1.1 404 Not Found"),
            'robots' => "noindex",
			'title' => "404 Not Found",
			'description' => "We're sorry, but the page you were looking for doesn't exist.",
			'page_title' => "Page Not Found",
			'page_type' => "page",
		);
		load_view("templates/404", $data);
	}
}
