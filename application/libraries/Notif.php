<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Notif {
	protected $data;
	protected $ci;
	
    function __construct()
    {
        $this->ci =& get_instance();
    }
	
	public function add($message,$type=null){
		$response = array(
			'type'=>$type,
			'message'=>$message
		);
		$this->ci->session->set_flashdata('message',$response);
	}
	
	public function get($type){
		
	}
	public function show(){
		$alert = "";
		if($response=$this->ci->session->flashdata('message')){
			switch ($response['type']) {
			    case 'success':
			        $icon = '<i class="icon fa fa-check"></i>';
			        break;
			    case 'warning':
			        $icon = '<i class="icon fa fa-warning"></i>';
			        break;
			    case 'danger':
			        $icon = '<i class="icon fa fa-ban"></i>';
			        break;
			   	case 'info':
			        $icon = '<i class="icon fa fa-info"></i>';
			        break;

			}


			$alert .= "<div class='alert alert-{$response['type']} alert-dismissable'>";
			$alert .= "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
			$alert .=  '<strong>'.$icon.$response['message'].'</strong>';
			$alert .= "</div>";
		}
		return $alert;
	}
	

	public function custom($header=null, $footer=null){
		$alert = "";
		if($response=$this->ci->session->flashdata('ctp_alert')){
			switch ($response['type']) {
			    case 'success':
			        $icon = '<i class="icon fa fa-check"></i>';
			        break;
			    case 'warning':
			        $icon = '<i class="icon fa fa-warning"></i>';
			        break;
			    case 'danger':
			        $icon = '<i class="icon fa fa-ban"></i>';
			        break;
			   	case 'info':
			        $icon = '<i class="icon fa fa-info"></i>';
			        break;
			    default:
       				echo "No existing icon type for \"<b>".$response['type']."</b>\" please choose between <b>success, warning, danger and info</b>";
			}

			if(isset($response['size'])) {
				$textTag[0] = "<".$response['size'].">";
				$textTag[1] = "</".$response['size'].">";
			} else {
				$textTag[0] = "<h4>";
				$textTag[1] = "</h4>";
			}



			$alert .= $header;
			$alert .= "<div class='alert alert-{$response['type']}'  style='margin:0'>";
			//$alert .= "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
			$alert .=  $textTag[0].$icon.$response['message'].$textTag[1];
			$alert .= "</div>";
			$alert .= $footer;
		}
		return $alert;
	}
	public function test_show(){
		$response=$this->ci->session->flashdata('message');
		return $test_alert = $response;
	}
	
}