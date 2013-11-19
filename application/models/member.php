<?php if (!defined('BASEPATH')) exit ('No direct script access allowed');

/*
 * 
 * Model untuk box (article, video, photo)
 * 
 */

class Modeluser extends CI_Model {
	
	var $user = "users";
	var $profile = "user_profiles";
	/*var $country = "tblcountry";
	var $expertise = "tblexpertise";
	var $website = "tblwebuser";
	var $colleague = "tblcolleague";
	var $track = "tbltrack";
	var $message = "tblmessages";
	var $conversation = "tblobrolan";
	var $occupation = "tbloccupation";
	var $education = "tbleducation";
	var $city = "city"; */

	private $primari_key = 'id';
	
    public function __construct() {
        parent::__construct();

    }

    function uProfileUser($id) {
		$this->load->helper('date');
		$d = "%Y-%m-%d %h:%i:%s"; //set datetime mysql default
		$time = time(); // get update time
		$edu = ucwords($this->input->post('education'));
		$occu = ucwords($this->input->post('occupation'));

		$data['nmDpnUser'] = $this->input->post('firstname');
		$data['nmTengUser'] = $this->input->post('midname');
		$data['nmAkhUser'] = $this->input->post('lastname');
		//$data['pathProfilePic'] = $photo;
		$data['gdrUser'] = $this->input->post('gender');
		$data['abtMeUser'] = strip_tags($this->input->post('aboutme'), '<a>');
		$data['country'] = $this->input->post('country');
		$data['website'] = $this->input->post('website');
		$date = $this->input->post('date1_year').'-'.$this->input->post('date1_month').'-'.$this->input->post('date1_day');
		//$data['emailUser'] = $this->input->post('email');
		$data['idExpertise'] = $this->input->post('expertise');
		$data['compUser'] = $this->input->post('compbuss');
		$data['tlUser'] = $date;
		$data['occupation'] = $occu;		
		$data['education'] = $edu;		
		if (!$this->checkedu($edu)) $this->inserteducation($edu);
		if (!$this->checkoccu($occu)) $this->insertoccupation($occu);
		$this->db->where('user_id',$id);
		$this->db->update($this->profile, $data);
	  	if($this->db->affected_rows() > 0){
			return true;
		} else{
			return false;
		}	
	}    
	
	
}