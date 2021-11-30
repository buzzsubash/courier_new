<?php if ( ! defined('BASEPATH')) exit('Access Denied...');

class Config_model extends CI_Model {
	protected $table = 'options';
	protected $key = 'key';
    function __construct(){
        parent::__construct();
    }
	
	public function get($key){
		$this->db->where($this->key,$key);
		$dataset=$this->db->get($this->table);
		
		if($dataset->num_rows()){
			$dataset = $dataset->row();
			return $dataset->value;
		}else{
			return "";
		}
	}
	
	public function get_all($filter=null){
		if(isset($filter))extract($filter);
		$filter = array(
			'limit'=>9999,
			'start'=>0,
			'order_by'=>"order ASC",//add comma for multiple order by..
			'fields'=>'*',
			'config_group'=>null
		);
		extract($filter,EXTR_SKIP);

		$this->db->select($fields);

		if(isset($config_group)) {
			$this->db->where('config_group',$config_group);
		}

		if($order_by) {
			$order_by = explode(',',$order_by);
			foreach($order_by as $ob){
				$ob = rtrim($ob," "); 
				$ob = ltrim($ob," "); 
				$obs = explode(" ",$ob);
				$this->db->order_by($obs[0],$obs[1]);	
			}
		}
		
		$dataset=$this->db->get($this->table,$limit,$start);
		if($dataset->num_rows()){
			return $dataset->result();
		}else{
			return FALSE;
		}
	}
	
	public function set_option($key,$value,$label=null){
		if($this->is_key_exists($key)){
			$data['value']=$value;
			return $this->update_option($key,$data);
		}else{
			return $this->add_option($key,$value);
		}
	}
	
	public function add_option($key,$value,$label=null){
		$data=array(
			'key'=>$key,
			'value'=>$value,
			'label'=>$label
		);
		return $this->db->insert($this->table, $data);
	}
	
	public function update_option($key,$data){
		$this->db->where($this->key,$key);
        if($this->db->update($this->table,$data)){
            return true;
        }else{
            return false;
        }
	}

	public function is_key_exists($key){
		$this->db->select('key');
		$this->db->where($this->key,$key);
		$dataset=$this->db->get($this->table);
		if($dataset->num_rows()==1){
			return TRUE;
		}else{
			return FALSE;
		}
	}
	
	public function hash_password($password, $salt){
		return sha1($password.$salt);
	}
}