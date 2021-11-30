<?php if ( ! defined('BASEPATH')) exit('Access Denied...');

class Categories_model extends CI_Model {
	protected $table='categories';
	protected $key = 'cat_id';
    function __construct(){
        parent::__construct();
    }

	public function get($id,$filter=null){
		if(isset($filter))extract($filter);
		$filter = array(
			'fields'=>'*',
			'key'=>null,
		);
		extract($filter,EXTR_SKIP);
		$this->db->select($fields);

		$this->db->where(isset($key)?$key:$this->key, $id);
		
		$dataset=$this->db->get($this->table);
		if($dataset->num_rows()){
			return $dataset->row();
		}else{
			return FALSE;
		}
	}

	public function get_all($filter=null){
		if(isset($filter))extract($filter);
		$filter = array(
			'limit'=>9999,
			'start'=>0,
			'order_by'=>'name ASC',//add comma for multiple order by..
			'fields'=>'*',
		);
		extract($filter,EXTR_SKIP);
		$this->db->select($fields);
		
		$order_by = explode(',',$order_by);
		foreach($order_by as $ob){
			$ob = rtrim($ob," "); 
			$ob = ltrim($ob," "); 
			$obs = explode(" ",$ob);
			$this->db->order_by($obs[0],$obs[1]);	
		}
		
		$dataset=$this->db->get($this->table,$limit,$start);
		if($dataset->num_rows()){
			return $dataset->result();
		}else{
			return FALSE;
		}
	}

	public function insert($data){
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
	}

	public function update($key,$data){
		$this->db->where($this->key,$key);
        if($this->db->update($this->table,$data)){
            return true;
        }else{
            return false;
        }
	}

	public function trash($id){
		$this->db->delete($this->table, array('cat_id' => $id));
	}



	// For admin category list table
	public function get_admin_category_list($args=null){
		$this->get_admin_category_data($args);

		if(isset($_POST['length']) && $_POST['length'] != -1)
		   $this->db->limit($_POST['length'], $_POST['start']);

		$dataset = $this->db->get();

		if($dataset->num_rows()) {
			$total       = $this->get_admin_category_count($args);
		 	$totalFilter = $this->get_admin_category_count($args);
			$result      =  array(
              	'result'          => $dataset->result(),
              	'recordsTotal'    => $total,
              	'recordsFiltered' => $totalFilter
            );
			return $result;	
		}
    }

    public function get_admin_category_data($filter=null){
		if(isset($filter))extract($filter);
		$filter = array(
			'order_by'=>'name ASC',//add comma for multiple order by..
			'fields'=>'*',
		);
		extract($filter,EXTR_SKIP);
		
		$this->db->select("
			cat_id,
			name,
		");

		$this->db->from($this->table);

    	$columns = array(
    		'cat_id',
    		'name',
        );

        if(isset($_POST['search']['value']) && $_POST['search']['value'] != ""){
			$new_string = strtolower($_POST['search']['value']);
			$i=0;
	        if(!empty($new_string)) {
	        	foreach($columns as $column){
					if($i===0) { // first loop
	                    $this->db->group_start();
	                	$this->db->like( 'LOWER('.$column.')', $new_string ); 
	                } else {
	                    $this->db->or_like( 'LOWER('.$column.')', $new_string );                    
	                }
	 
	                if(count($columns) - 1 == $i)//last loop
	                    $this->db->group_end();
	                $i++;
	            }
	        }
		}

		$order_by = explode(',',$order_by);
		foreach($order_by as $ob){
			$ob = rtrim($ob," "); 
			$ob = ltrim($ob," "); 
			$obs = explode(" ",$ob);			
			$this->db->order_by($obs[0],$obs[1]);	
		}
	}

	public function get_admin_category_count($args){
        $this->get_admin_category_data($args);
        $query = $this->db->get();
        return $query->num_rows();
    }
}