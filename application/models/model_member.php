<?php

Class Model_member extends CI_Model {

public function __construct()
{
	
	$this->load->database();
	$this->load->library(array('session', 'tank_auth'));
	$this->load->helper('url');
	$this->load->model('tank_auth/users');
	
}

function tampil(){

$query = $this->db->get('user_profiles');
return $query->result(); 
 }

 function caridata(){
$c = $this->input->POST ('cari');

//$this->db->like('nama', $c);

$this->db->like('nama', $c);
$this->db->or_like('no_member', $c); 

$query = $this->db->get ('user_profiles');
return $query->result(); 
 }

  function getAllProvinsi(){
        
        return $this->db->get('master_state')->result();
    }

   function getAllVenue(){
        
        return $this->db->get('tbl_venue')->result();
    }

    function getAllProfil(){
        
     	return $this->db->get('user_profiles')->result();   
    }

    function getAllUsers(){
        
     	return $this->db->get('users')->result();   
    }


    public function getUsersByID($id){
        $this->db->where('id',$id);
        $query = $this->db->get('users');
        return $query->result();
    }

    public function getProfilByID($id){
        $this->db->where('id',$id);
        $query = $this->db->get('user_profiles');
        return $query->result();
    }

    
    

    function updateAktivasiUsers($id,$data){
        $this->db->where('id',$id);
        $update = $this->db->update('users',$data);
        return $update;
    }
 
 public function detail_member($memberId)
	{
		$member=array();
		if ($memberId !== null){		
			$query = $this->db->get_where('user_profiles', array('id' => $memberId));
			if ($query->num_rows() == 1) {	
				foreach($query->result() as $row){
				$member['id'] = $row->id;
				$member['no_member'] = $row->no_member;
				$member['nama'] = $row->nama;
				
				}
				return $member;
			}	
		} else {
			$query = $this->db->get('user_profiles');
			if ($query->num_rows() !== 0 ){
				foreach($query->result() as $row){
				$member['id'] = $row->id;
				$member['no_member'] = $row->no_member;
				$member['nama'] = $row->nama;
				}
				return $member;
			}
			
		}		
	}


function ubah_member() {

	
	$id_member = $data['user_id']	= $this->tank_auth->get_user_id();
	$data = array(

		'id' => $this->input->post('id'),
		'no_member' => $this->input->post('no_member'),
		'regist' => $this->input->post('regist'),
		'nama' => $this->input->post('nama'),
		'alamat' => $this->input->post('alamat'),
		'kota' => $this->input->post('kota'),
		'state_id' => $this->input->post('provinsi'),
		'kodepos' => $this->input->post('kodepos'),
		'ttl' => $this->input->post('ttl'),
		'no_hp' => $this->input->post('no_hp'),
		'no_rumah' => $this->input->post('no_rumah')
		
	);
	
		$this->db->where('id',$this->input->post('id',$id_member));
		$this->db->update('user_profiles', $data);
		

}

function getAllPembelian(){
        //return $this->db->query("select * from tbl_transaksi_header ")->result();
        return $this->db->get('tbl_transaksi_header')->result();
    }

function get_provinsi_by_id(){
        //return $this->db->query("select id from tbl_transaksi_header ")->result();
        return $this->db->get('tbl_transaksi_header')->result();
    }

    function get_promo(){
        //return $this->db->query("select id from tbl_transaksi_header ")->result();
        return $this->db->get('tbl_promo')->result();
    }






  	function getHistoriPembelian(){
  		$id_member = $data['user_id']	= $this->tank_auth->get_user_id();
        return $this->db->query("select `user_profiles`.`no_member` AS `no_member`,`user_profiles`.`nama` AS `nama`,`tbl_barang`.`seri_barang` AS `seri_barang`,`tbl_barang`.`nm_barang` AS `nm_barang`,`tbl_barang`.`file_url` AS `file_url`,`tbl_barang`.`harga` AS `harga`,`tbl_transaksi_header`.`total_harga` AS `total_harga`,`tbl_transaksi_header`.`lokasi_pembelian` AS `lokasi_pembelian`,`tbl_transaksi_header`.`tanggal_pengeluaran` AS `tanggal_pengeluaran`,`tbl_transaksi_detail`.`qty` AS `qty`,`user_profiles`.`id` AS `id`,`tbl_transaksi_header`.`kd_transaksi` AS `kd_transaksi` from (((`tbl_barang` join `tbl_transaksi_detail` on((`tbl_barang`.`kd_barang` = `tbl_transaksi_detail`.`kd_barang`))) join `tbl_transaksi_header` on((`tbl_transaksi_detail`.`kd_transaksi` = `tbl_transaksi_header`.`kd_transaksi`))) join `user_profiles` on((`user_profiles`.`id` = `tbl_transaksi_header`.`kd_pelanggan`)))
        						where user_profiles.id = $id_member ")->result();
        //$this->db->where('user_profiles.id', $id_member); 
    }

    function getHistoriPembelian_limit(){
        $id_member = $data['user_id']   = $this->tank_auth->get_user_id();
        return $this->db->query("select `user_profiles`.`no_member` AS `no_member`,`user_profiles`.`nama` AS `nama`,`tbl_barang`.`seri_barang` AS `seri_barang`,`tbl_barang`.`nm_barang` AS `nm_barang`,`tbl_barang`.`file_url` AS `file_url`,`tbl_barang`.`harga` AS `harga`,`tbl_transaksi_header`.`total_harga` AS `total_harga`,`tbl_transaksi_header`.`lokasi_pembelian` AS `lokasi_pembelian`,`tbl_transaksi_header`.`tanggal_pengeluaran` AS `tanggal_pengeluaran`,`tbl_transaksi_detail`.`qty` AS `qty`,`user_profiles`.`id` AS `id`,`tbl_transaksi_header`.`kd_transaksi` AS `kd_transaksi` from (((`tbl_barang` join `tbl_transaksi_detail` on((`tbl_barang`.`kd_barang` = `tbl_transaksi_detail`.`kd_barang`))) join `tbl_transaksi_header` on((`tbl_transaksi_detail`.`kd_transaksi` = `tbl_transaksi_header`.`kd_transaksi`))) join `user_profiles` on((`user_profiles`.`id` = `tbl_transaksi_header`.`kd_pelanggan`)))
                                where user_profiles.id = $id_member ORDER BY tanggal_pengeluaran DESC LIMIT 0, 2")->result();
        //$this->db->where('user_profiles.id', $id_member); 
    }

    function get_profil_data(){
  		$id_member = $data['user_id']	= $this->tank_auth->get_user_id();
        return $this->db->query("select `user_profiles`.`no_member` AS `no_member`,`tbl_venue`.`venue` 
        						AS `venue`,`user_profiles`.`nama` AS `nama`,`user_profiles`.`alamat` 
        						AS `alamat`,`user_profiles`.`kota` AS `kota`,`master_state`.`state_name` 
        						AS `state_name`,`user_profiles`.`kodepos` AS `kodepos`,`user_profiles`.`ttl` 
        						AS `ttl`,`user_profiles`.`no_hp` AS `no_hp`,`user_profiles`.`no_rumah` 
        						AS `no_rumah`,`user_profiles`.`id` AS `id`,`users`.`email` 
        						AS `email` from (((`user_profiles` join `master_state` 
        							on((`master_state`.`state_id` = `user_profiles`.`state_id`))) 
        						join `tbl_venue` on((`tbl_venue`.`id_venue` = `user_profiles`.`regist`))) 
        						join `users` on((`users`.`id` = `user_profiles`.`id`))) 
        						where user_profiles.id = $id_member  ")->result();
    }

    function get_memberterbaru(){
        
        return $this->db->query("select `user_profiles`.`id` AS `id`,`tbl_venue`.`venue` AS `venue`,`user_roles`.`role_id` AS `role_id`,`user_profiles`.`nama` AS `nama`,`user_profiles`.`alamat` AS `alamat`,`user_profiles`.`kota` AS `kota`,`users`.`email` AS `email`,`users`.`created` AS `created`,`user_profiles`.`no_member` AS `no_member` from (((`user_profiles` join `user_roles` on((`user_profiles`.`id` = `user_roles`.`user_id`))) join `users` on((`users`.`id` = `user_profiles`.`id`))) join `tbl_venue` on((`tbl_venue`.`id_venue` = `user_profiles`.`regist`)))
                                where role_id = 2 ORDER BY created DESC LIMIT 0, 1")->result();
    }

     function hitung_member(){
        
        return $this->db->count_all('user_roles')->result();

    }


}

?>