<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class M_database extends CI_Model {
public function __construct() {
    $config["hostname"] = "localhost";
    $config["dbdriver"] = "mysql"; //You can change with your database, if you use mysql, you can change with mysql
    $config["database"] = "luminox";
    $config["username"] = "root";
    $config["password"] = "";
    $this->load->database($config);
}
 
public function record_count() {
        //create query to show number row on database
        return $this->db->count_all("user_profiles");
    }
  
    public function fetch_member($limit, $start) {
        //create query with limit function
        return $this->db->limit($limit, $start)->get("user_profiles");
    }
}
  
/* End of file m_database.php */
/* Location: ./application/models/m_database.php */