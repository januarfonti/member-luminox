<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CRUD_Model extends MY_Model{
	
	var $totRows = 0;
	var $totPages = 1;
	var $perPage = 10;
	var $baseURL = '#';
	var $afterURL = '';
	var $page;
	var $id = 0;
	var $logTemp = false;

	

	public function getData()	{
		// Order  Data
		if (isset($this->order) && count($this->order) > 1)	$this->db->order_by($this->order[0],$this->order[1]);
		return $this->db->get($this->table)->result();
	}	
	
	public function getDataPage($page = 1, $perPage = 0, $param=false)	{
		// set cookie per page

		$this->pre = !isset($this->pre) ? $this->table : $this->pre;
		$tpp = $this->session->userdata($this->pre.'_perPage');
		
		if ($tpp > 0 and $perPage == 0 ){
			$perPage = $tpp;
		} elseif ($tpp < 1 and $perPage == 0){
			$perPage = $this->perPage;
		}// elseif ($perPage > 0){
		//	$page = 1;
		//}  		
		
		$keyword = $this->session->userdata($this->pre.'_search');
		
		
		if (isset($_GET['search_key'])){
			$keyword = $_GET['search_key'];
		} else if ($page == 1) {
			$keyword = '';
		}
		
		$this->session->set_userdata($this->pre.'_search', $keyword);	
		
		$this->session->set_userdata($this->pre.'_perPage', $perPage);		
		$offset 			= ($page - 1) * $perPage;
		

		if ($perPage != -1) $this->db->limit($perPage, $offset);		
		/* default order ketika di halaman per page */
		if (isset($this->order_page) && count($this->order_page) > 1)	$this->db->order_by($this->order[0],$this->order[1]); 
		elseif (isset($this->order) && count($this->order) > 1)	$this->db->order_by($this->order[0],$this->order[1]);
		
		if (method_exists($this, 'customTable')) $this->customTable('getDataPage', $param);
		else $this->db->from($this->table);
		if (isset($this->select)) $this->db->select($this->select);
		
		if ($keyword){
			/* difinisi pencarian / searching di field apa saja */
			if (isset($this->search)) {
				$this->search = str_replace(' ', '', $this->search);
				$cari = explode(',', $this->search);
				if (count($cari) > 0) foreach ($cari as $golek) $this->db->or_like($golek, $keyword);
				else $this->db->like($cari, $keyword);
			}			
		}
		$data = $this->db->get()->result();
		
		if (method_exists($this, 'customTable')) $this->customTable('search', $param);
		else $this->db->from($this->table);
		if (isset($this->select)) $this->db->select($this->select);
		
		if ($keyword){
			/* difinisi pencarian / searching di field apa saja */
			if (count($cari) > 0) foreach ($cari as $golek) $this->db->or_like($golek, $keyword);
			else $this->db->like($cari, $keyword);
		}
		$this->totRows 	= $this->db->count_all_results();
		$this->totPages	= ceil( $this->totRows / $perPage);
		$this->perPage	= $perPage;
		$this->page		= $page;
		$att 				= array('_total' => $this->totRows);
		$data				= array('data' => $data);
		$data				= (object) array_merge((array) $data, (array) $att);
		return $data;
	}
	
	private function genPageUrl($page = '', $label = ''){
		$class = '';
		if ($label == '') $label = $page;
		if ($page == $this->page) $class = 'active';
		return '<li class="'.$class.'"><a href="'.$this->baseURL.'/'.$page.'/'.$this->afterURL.'">'.$label.'</a></li>';
	}
	
	public function getPaging($baseURL= '#', $after=''){
		if ($this->totPages <= 1) return false;
		
		$this->baseURL = $baseURL;
		$this->afterURL = $after;
		
		$page 	= $this->page;		
		$res 	= '<ul>';
		$res 	.= ($page > 1 ) ? $this->genPageUrl($page-1, 'Prev')  : '';
		$res 	.= $this->genPageUrl(1);		
		$res 	.= ($page-3 > 1)	? $this->genPageUrl('#', '...') : '';
		
		for($i=$page-2; $i<=$page+2; $i++){			
			if ($i > 1 && $i < $this->totPages)			
				$res	.= $this->genPageUrl($i);
		}
		
		$res 	.= ($page+3 < $this->totPages) ? $this->genPageUrl('#', '...') : '';
		$res 	.= $this->genPageUrl($this->totPages);
		$res 	.= ($page != $this->totPages) ? $this->genPageUrl($page+1, 'Next')  : '';
		
		$res 	.= '</ul>';
		return $res;	
	}
	
	public function getDataTable(){
		
		$perPage  = $_GET['iDisplayLength'];
		$page		= $_GET['iDisplayStart'];
		$keyword = $_GET['sSearch'];
		$offset	= $_GET['iDisplayStart'];
		
		if (isset($this->sortDataTable) && is_array($this->sortDataTable)){
			$sortCols	= $this->sortDataTable[$_GET['iSortCol_0']];
			$sortOrder = $_GET['sSortDir_0'];
			$this->db->order_by($sortCols, $sortOrder); 
		}
		
		if ($perPage != -1) $this->db->limit($perPage, $offset);		
		
		if (method_exists($this, 'customTable')) $this->customTable('getDataTable');
		else $this->db->from($this->table);
		if (isset($this->select)) $this->db->select($this->select);
		
		if ($keyword){
			/* difinisi pencarian / searching di field apa saja */
			if (isset($this->search)) {
				$this->search = str_replace(' ', '', $this->search);
				$cari = explode(',', $this->search);
				if (count($cari) > 0) foreach ($cari as $golek) $this->db->or_like($golek, $keyword);
				else $this->db->like($cari, $keyword);
			}			
		}
		$data = $this->db->get()->result();
		
		if (method_exists($this, 'customTable')) $this->customTable('getDataTable');
		else $this->db->from($this->table);
		if (isset($this->select)) $this->db->select($this->select);
		
		if ($keyword){
			/* difinisi pencarian / searching di field apa saja */
			if (count($cari) > 0) foreach ($cari as $golek) $this->db->or_like($golek, $keyword);
			else $this->db->like($cari, $keyword);
		}
		$this->totRows 	= $this->db->count_all_results();
		$this->perPage	= $perPage;
		$this->page		= $page;
		$jml					= count($data);
		if (method_exists($this, 'filterDataTable')) $data = $this->filterDataTable($data);
		$output = array(
            "sEcho" => intval($_GET['sEcho']),
            "iTotalRecords" => $this->totRows,
            "iTotalDisplayRecords" => $this->totRows,
            "aaData" => $data
        );
		return str_replace('null', '[]', json_encode($output));
	}
	
	public function getDetail($id)	{
		if (!$id && $id != 0) return false;
		
		$this->id = $id;
		if (isset($this->select)) $this->db->select($this->select);
		if (method_exists($this, 'customTable')) $this->customTable('getDetail');
		else $this->db->from($this->table);
		$this->db->where($this->pm, $id);
		return $this->db->get()->row();
	}
	
	public function add($data){
		if (!is_array($data)) return false;
		$res = $this->db->insert($this->table, $data);
		
		if ($res) $this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Data Berhasil Disimpan'));
		else $this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Data Gagal Disimpan'));
		if (!$res) return false;
		
		foreach ($data as $key => $val){
			if ($val != '') $this->db->where($key, $val);
		}
		$this->db->order_by($this->pm, 'desc');
		$pm = $this->pm;
		$this->id = $this->db->get($this->table)->row()->$pm;
		
		//write log
		if ($this->id) $this->writeLog('add', $this->id, $data[$this->logField]);
		
		return $this->id;
	}
	
	public function edit($id, $data){
		if (!is_array($data) or (!$id  && $id !== 0)) return false;
		$this->id = $id;
		
		//set Log
		$this->setLog($id);
		
		$this->db->where($this->pm, $id);
		$res = $this->db->update($this->table, $data); 	
		if ($res) {
			
			$this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Data Berhasil Diubah'));
			//write log
			$this->writeLog('edit', $id, $data[$this->logField]);
		
		} else 
			$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Data Gagal Diubah'));
		return $res;
	}
	
	public function delete($id){
		if (!$id) return false;
		//set Log
		$this->setLog($id);
		
		$this->id = $id;
		$this->db->where($this->pm, $id);
		$res = $this->db->delete($this->table); 	
		if ($res) {
			$this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Data Berhasil Dihapus'));
			//write log
			$this->writeLog('delete', $id);
		} else 
			$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Data Gagal Dihapus'));
		return $res;
	}
	
	public function moveToTrash($id=false){
		if (!$this->trashTable || !$id) return false;
		
		$check = $this->getDetail($id);
		if (!$check) return false;
		
		$trash = $this->trashTable;
		$this->id = $id;
		$this->db->from($this->table);
		$this->db->where($this->pm, $id);
		$data = $this->db->get()->row_array();
		$data['deleted_by'] = $_SESSION['id'];//$this->session->userdata('id');
		$res = $this->db->insert($trash, $data);
		if ($res) $res2 = $this->delete($id);
		if ($res2) {
			$this->session->set_flashdata('message', array('type' => 'success', 'text' => 'Data Berhasil Dihapus'));
			//write log sudah ada di method delete
			//$this->writeLog('delete', $id, $check->$logField);
		} else 
			$this->session->set_flashdata('message', array('type' => 'error', 'text' => 'Data Gagal Dihapus'));
		return $res2;
		
	}

	private function setLog($id){
		//if log enable
		if (!$this->logField) return false;
		$this->logTemp = $this->getDetail($id);
	}
	
	private function writeLog($action, $id=false, $logField = false){
		// if log eneble
		$field = $this->logField;
		if (!$field) return false;
		
		// custom for get detail user
		$this->db->where('usr_id', $_SESSION['id']);
		$username = $this->db->get('user')->row()->usr_username;
		$section = $this->title;
		
		if ($action == 'add'){
			$val = ($logField) ? $logField : $this->getDetail($id)->$field;
			$text = 'User dengan username "'.$username.'" menambah '.ucwords($section).' dengan nama "'.$val.'"';
			
		} elseif ($action == 'edit'){
			$val = ($logField) ? $logField : $this->getDetail($id)->$field;
			$text = 'User dengan username "'.$username.'" mengubah '.ucwords($section).' dengan nama "'.$this->logTemp->$field.'" menjadi "'.$val.'"';
			
		} elseif ($action == 'delete'){
			$text = 'User dengan username "'.$username.'" menghapus '.ucwords($section).' dengan nama "'.$this->logTemp->$field.'"';
		}
		
		$data = array(
			'log_user' => $_SESSION['id'],
			'log_action' => $action,
			'log_section' => $section,
			'log_val_id' => $id,
			'log_text' => $text,
		);
		//echo '<pre>';print_r($data);
		$res =  $this->db->insert('log', $data);				
		//echo '<br>';var_dump($res);die;
		return $res;
	}
}
?>