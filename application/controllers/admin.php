<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->helper(array('form', 'url'));
		$this->load->library(array('form_validation', 'tank_auth'));
		$this->load->model('tank_auth/users');
		$this->load->model('model_barang');
		$this->load->model('model_member');
		$this->load->model('model_servis');
		$this->load->model('model_pembelian');
		$this->load->model('model_trans');
		$this->load->model('general_model');
		$this->load->model('grocery_crud_model');
		$this->load->model('custom');
		$this->load->database();
		$this->load->library('grocery_CRUD');
	}

	public function show_output($output = null)
	{

		$this->load->view('wrapper_admin/content_wrapper_sidebar',$output);
	}

	function index()
	{
		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');
		} else {
			
			$html_title ="LUMINOX | Data Member";
			$this->load->vars( array( 'html_title' => $html_title) );

			$data['user_id']	= $this->tank_auth->get_user_id();
			$data['username']	= $this->tank_auth->get_username();
			$data['memberterbaru']=$this->model_member->get_memberterbaru();
			$data['transaksiterakhir']=$this->model_trans->get_transaksiterakhir();
			$data['servisterakhir']=$this->model_servis->get_servisterakhir();


			//$data['output']	=$this->load->view('admin/beranda',$data,TRUE);
			$this->load->view('wrapper_admin/content_wrapper_beranda',$data);


        	
		}
	}

	public function data_member()
	{
		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');
		} else {

			$crud = new grocery_CRUD();
			$crud->set_theme('datatables');
			$crud->set_table('user_profiles');
			$crud->set_relation('regist','tbl_venue','venue');
			$crud->set_relation('state_id','master_state','state_name');
			$crud->set_relation('id','users','{email} / Login Terakhir {last_login} / Dibuat {created} ');
			$crud->display_as('state_id','Provinsi');
			$crud->display_as('regist','Registrasi');
			$crud->display_as('id','Email / Status');
			$crud->set_subject('Member');
			$crud->required_fields('regist,nama,alamat,kota,state_id,ttl');
			$crud->columns('no_member','regist','nama','alamat','kota','state_id','ttl');
			$crud->fields('no_member','regist','nama','alamat','kota','state_id','ttl','id');
			$crud->edit_fields('no_member','regist','nama','alamat','kota','state_id','ttl','id');
			$crud->field_type('no_member', 'readonly');
			$crud->unset_delete();
			$crud->unset_add();
			$output = $crud->render();
			$html_title ="LUMINOX | Data Member";
			$this->load->vars( array( 'html_title' => $html_title) );

			$page_header ="Data Member";
			$this->load->vars( array( 'page_header' => $page_header) );

			$this->show_output($output);
		}
	}

	public function pembelian()
	{
		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');
		} else {

			$crud = new grocery_CRUD();
			$crud->set_theme('datatables');
			$crud->set_table('user_profiles');$crud->set_relation('regist','tbl_venue','venue');
			$crud->set_relation('state_id','master_state','state_name');
			$crud->display_as('state_id','Provinsi');
			$crud->display_as('regist','Registrasi');
			$crud->set_subject('Member');
			$crud->columns('no_member','regist','nama','alamat','kota','state_id','ttl');
			$crud->add_action('Input Pembelian', '', 'admin/input_pembelian','ui-icon-plus');
			$crud->unset_delete();
			$crud->unset_add();
			$crud->unset_edit();
			$crud->unset_read();
			$output = $crud->render();
			$html_title ="LUMINOX | Pembelian";
			$this->load->vars( array( 'html_title' => $html_title) );
			$page_header ="Pembelian";
			$this->load->vars( array( 'page_header' => $page_header) );
			
			$this->show_output($output);
		}
	}

	public function pembelian_2()
	{
		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');
		} else {

			$crud = new grocery_CRUD();
			$crud->set_theme('datatables');
			$crud->set_table('user_profiles');$crud->set_relation('regist','tbl_venue','venue');
			$crud->set_relation('state_id','master_state','state_name');
			$crud->display_as('state_id','Provinsi');
			$crud->display_as('regist','Registrasi');
			$crud->set_subject('Member');
			$crud->columns('no_member','regist','nama','alamat','kota','state_id','ttl');
			$crud->add_action('Input Pembelian', '', 'admin/input_pembelian_2','ui-icon-plus');
			$crud->unset_delete();
			$crud->unset_add();
			$crud->unset_edit();
			$crud->unset_read();
			$output = $crud->render();
			$html_title ="LUMINOX | Pembelian";
			$this->load->vars( array( 'html_title' => $html_title) );
			$page_header ="Pembelian";
			$this->load->vars( array( 'page_header' => $page_header) );
			
			$this->show_output($output);
		}
	}


	public function laporan_pembelian()
	{
		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');
		} else {

			$this->load->library('grocery_CRUD');
			$crud = new grocery_CRUD();
			$crud->set_theme('datatables');
			$crud->set_model('custom');
			$crud->set_table('tbl_transaksi_detail'); //Change to your table name
			$crud->basic_model->set_query_str('select `tbl_transaksi_detail`.`id_detail` AS `id_detail`,`tbl_transaksi_detail`.`kd_transaksi` AS `No Transaksi`,`tbl_barang`.`seri_barang` AS `seri_barang`,`tbl_barang`.`nm_barang` AS `nm_barang`,`tbl_barang`.`harga` AS `harga`,`tbl_barang`.`file_url` AS `file_url`,`tbl_transaksi_header`.`total_harga` AS `total_harga`,`tbl_transaksi_header`.`lokasi_pembelian` AS `lokasi_pembelian`,`tbl_transaksi_header`.`tanggal_pengeluaran` AS `tanggal_pengeluaran`,`user_profiles`.`no_member` AS `no_member`,`user_profiles`.`nama` AS `nama` from (((`tbl_transaksi_detail` join `tbl_transaksi_header` on((`tbl_transaksi_header`.`kd_transaksi` = `tbl_transaksi_detail`.`kd_transaksi`))) join `user_profiles` on((`user_profiles`.`id` = `tbl_transaksi_header`.`kd_pelanggan`))) join `tbl_barang` on((`tbl_barang`.`kd_barang` = `tbl_transaksi_detail`.`kd_barang`)))'); //Query text here
			$crud->set_primary_key('id_detail','tbl_transaksi_detail');
			$crud->columns('No Transaksi','no_member','nama','seri_barang','nm_barang','harga','lokasi_pembelian','tanggal_pengeluaran');
			
			$crud->unset_add();
			$crud->unset_read();
			$crud->unset_edit();
			
			$output = $crud->render();
			$html_title ="LUMINOX | Laporan Pembelian";
			$this->load->vars( array( 'html_title' => $html_title) );
			$page_header ="Laporan Pembelian";
			$this->load->vars( array( 'page_header' => $page_header) );
			$this->show_output($output);
		}
	}


	
	public function barang()
	{
		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');
		} else {

			$crud = new grocery_CRUD();
			$crud->set_theme('datatables');
			$crud->set_table('tbl_barang');
			$crud->set_subject('Data Barang');
			$crud->required_fields('seri_barang','nama_barang','stok','harga','file_url');
			$crud->set_field_upload('file_url','uploads');
			$output = $crud->render();
			$html_title ="LUMINOX | Data Barang";
			$this->load->vars( array( 'html_title' => $html_title) );
			$page_header ="Daftar Barang";
			$this->load->vars( array( 'page_header' => $page_header) );
			$this->show_output($output);
		}
	}

	public function barang_terbaru()
	{
		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');
		} else {

			$crud = new grocery_CRUD();
			$crud->set_theme('datatables');
			$crud->set_table('tbl_barangterbaru');
			$crud->set_subject('Data Barang');
			$crud->set_relation('kd_barang','tbl_barang','nm_barang');
			//$crud->add_fields('username','email','activated');
			$crud->display_as('kd_barang','Nama Barang');
			//$crud->required_fields('seri_barang','nama_barang','stok','harga','file_url');
			//$crud->set_field_upload('file_url','uploads');
			$output = $crud->render();
			$html_title ="LUMINOX | Input Barang Terbaru";
			$this->load->vars( array( 'html_title' => $html_title) );
			$page_header ="Input Barang Terbaru";
			$this->load->vars( array( 'page_header' => $page_header) );
			$this->show_output($output);
		}
	}

	public function aktivasi()
	{
		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');
		} else {

			$crud = new grocery_CRUD();
			$crud->set_theme('datatables');
			$crud->set_table('users');
			$crud->set_subject('Aktivasi');
			$crud->set_relation('id','user_profiles','nama');
			$crud->display_as('id','Nama');
			$crud->display_as('created','Waktu Pendaftaran');
			$crud->columns('id','username','email','activated','created');
			$crud->edit_fields('username','email','activated');
			$crud->field_type('username', 'readonly');
			$crud->field_type('email', 'readonly');
			$crud->unset_delete();
			$crud->unset_add();
			$crud->unset_read();
			$output = $crud->render();
			$html_title ="LUMINOX | Aktivasi Manual Member";
			$this->load->vars( array( 'html_title' => $html_title) );
			$page_header ="Aktivasi Manual Member";
			$this->load->vars( array( 'page_header' => $page_header) );
			$this->show_output($output);
		}
	}

	public function hak_akses_member()
	{
		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');
		} else {

			$crud = new grocery_CRUD();
			$crud->set_theme('datatables');
			$crud->set_table('user_roles');
			$crud->set_subject('Hak Akses Member');
			$crud->set_relation('user_id','user_profiles','nama');
			$crud->set_relation('role_id','roles','full');
			$crud->display_as('user_id','Nama');
			$crud->display_as('role_id','Hak Akses');
			$crud->columns('user_id','role_id');
			$crud->edit_fields('user_id','role_id');
			$crud->unset_delete();
			$crud->unset_add();
			$crud->unset_read();
			$output = $crud->render();
			$html_title ="LUMINOX | Hak AKses Member";
			$this->load->vars( array( 'html_title' => $html_title) );
			$page_header ="Hak Akses Member";
			$this->load->vars( array( 'page_header' => $page_header) );
			$this->show_output($output);
		}
	}

	public function servis()
	{
		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');
		} else {

			$this->load->library('grocery_CRUD');
			$crud = new grocery_CRUD();
			$crud->set_theme('datatables');
			$crud->set_model('custom');
			$crud->set_table('tbl_transaksi_detail'); //Change to your table name
			$crud->basic_model->set_query_str('select `tbl_transaksi_detail`.`id_detail` AS `id_detail`,`tbl_transaksi_detail`.`kd_transaksi` AS `No Transaksi`,`tbl_barang`.`seri_barang` AS `seri_barang`,`tbl_barang`.`nm_barang` AS `nm_barang`,`tbl_barang`.`harga` AS `harga`,`tbl_barang`.`file_url` AS `file_url`,`tbl_transaksi_header`.`total_harga` AS `total_harga`,`tbl_transaksi_header`.`lokasi_pembelian` AS `lokasi_pembelian`,`tbl_transaksi_header`.`tanggal_pengeluaran` AS `tanggal_pengeluaran`,`user_profiles`.`no_member` AS `no_member`,`user_profiles`.`nama` AS `nama` from (((`tbl_transaksi_detail` join `tbl_transaksi_header` on((`tbl_transaksi_header`.`kd_transaksi` = `tbl_transaksi_detail`.`kd_transaksi`))) join `user_profiles` on((`user_profiles`.`id` = `tbl_transaksi_header`.`kd_pelanggan`))) join `tbl_barang` on((`tbl_barang`.`kd_barang` = `tbl_transaksi_detail`.`kd_barang`)))'); //Query text here
			$crud->set_primary_key('id_detail','tbl_transaksi_detail');
			$crud->columns('No Transaksi','no_member','nama','seri_barang','nm_barang','harga','lokasi_pembelian','tanggal_pengeluaran');
			$crud->unset_delete();
			$crud->unset_add();
			$crud->unset_read();
			$crud->unset_edit();
			$crud->add_action('Input Servis', '', 'admin/input_servis','ui-icon-plus');
			$output = $crud->render();
			$html_title ="LUMINOX | Servis";
			$this->load->vars( array( 'html_title' => $html_title) );
			$page_header ="Servis Barang";
			$this->load->vars( array( 'page_header' => $page_header) );
			$this->show_output($output);
		}
	}

	public function input_servis($id)
	{
		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');
		} else {

			$html_title ="LUMINOX | Input Pembelian";
			$this->load->vars( array( 'html_title' => $html_title) );
			$page_header ="Input Servis";
			$this->load->vars( array( 'page_header' => $page_header) );
			$data['data_servis']=$this->model_servis->get_pembelian_by_id($id);
			$data['output']	=$this->load->view('admin/input_servis',$data,TRUE);
			$this->load->view('wrapper_admin/content_wrapper_pembelian',$data);

		}
	}

	 function proses_input_servis(){
        $data=array(
            
            'id_detail'=>$this->input->post('id_detail'),
            'id_member'=>$this->input->post('id_member'),
            'no_member'=>$this->input->post('no_member'),
            'nama'=>$this->input->post('nama'),
            'seri_barang'=>$this->input->post('seri_barang'),
            'nm_barang'=>$this->input->post('nm_barang'),
            'tgl_masuk'=>$this->input->post('tgl_masuk'),
            'tgl_keluar'=>$this->input->post('tgl_keluar'),
            'keterangan'=>$this->input->post('keterangan'),
        );
        $this->model_servis->insertServis($data);
        redirect("admin/servis");
}

public function laporan_servis()
	{
		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');
		} else {

			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			$crud->set_table('tbl_servis');
			$crud->set_subject('Histori Servis');
			//$crud->set_relation('user_id','user_profiles','nama');
			//$crud->set_relation('role_id','roles','full');
			//$crud->display_as('user_id','Nama');
			$crud->display_as('seri_barang','Seri');
			$crud->display_as('nama','Nama Member');
			$crud->display_as('nama','Nama Member');
			$crud->display_as('nm_barang','Nama');
			
			$crud->columns('no_member','nama','seri_barang','nm_barang','tgl_masuk','tgl_keluar','keterangan');
			$crud->edit_fields('tgl_masuk','tgl_keluar','keterangan');
			
			
			$crud->unset_add();
			$crud->unset_read();

			$output = $crud->render();
			$html_title ="LUMINOX | Histori Servis";
			$this->load->vars( array( 'html_title' => $html_title) );
			$page_header ="Histori Servis";
			$this->load->vars( array( 'page_header' => $page_header) );
			$this->show_output($output);
		}
	}

    




	
	public function input_pembelian($id)
	{
		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');
			return false;
		} 
		
		if(isset($_POST['submit'])){
			$this->load->model('model_trans');
			$res = $this->model_trans->save($_POST['kd_pelanggan'], $_POST['no_member'], $_POST['lokasi'], $_POST['d'] );
			if($res) {
				redirect('admin/invoice/'.$res['kd_transaksi']);
				return false;
			}
		}

/*		$data=array(
			'user_id' 		=> $this->tank_auth->get_user_id(),
			'username' 		=> $this->tank_auth->get_username(),
			'data_barang'=>$this->model_barang->getAllBarang(),
			'judul'=> 'Input Pembelian',

			);
			$data['nama_lengkap']	= $this->users->get_user_profile($data['user_id']);
*/
	   //$data['tampil']=$this->model_member->caridata();
		
		$html_title ="LUMINOX | Input Pembelian";
		$this->load->vars( array( 'html_title' => $html_title) );
		$page_header ="Input Pembelian";
		$this->load->vars( array( 'page_header' => $page_header) );
		$data['member1']		=$this->general_model->find('user_profiles','id ='.$id,'','','','','')->result_array();
		$data['output']	=$this->load->view('admin/input_pembelian',$data,TRUE);
		$this->load->view('wrapper_admin/content_wrapper_pembelian',$data);

	}

	public function input_pembelian_2($id)
	{
		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');
			return false;
		} 
		
		

$data=array(
			'user_id' 		=> $this->tank_auth->get_user_id(),
			'username' 		=> $this->tank_auth->get_username(),
			'data_barang'=>$this->model_barang->getAllBarang(),
			'judul'=> 'Input Pembelian',

			);
			$data['nama_lengkap']	= $this->users->get_user_profile($data['user_id']);

	   //$data['tampil']=$this->model_member->caridata();
		
		$html_title ="LUMINOX | Input Pembelian";
		$this->load->vars( array( 'html_title' => $html_title) );
		$page_header ="Input Pembelian";
		$this->load->vars( array( 'page_header' => $page_header) );
		$data['member1']		=$this->general_model->find('user_profiles','id ='.$id,'','','','','')->result_array();
		$data['output']	=$this->load->view('admin/input_pembelian_2',$data,TRUE);
		$this->load->view('wrapper_admin/content_wrapper_pembelian',$data);

	}

	function proses_input_pembelian(){
        $data=array(
            
            
            'id_member'=>$this->input->post('id_member'),
            'no_member'=>$this->input->post('no_member'),
            'produk'=>$this->input->post('produk'),
            'harga'=>$this->input->post('harga'),
            'keterangan'=>$this->input->post('keterangan'),
            'tanggal_pengeluaran'=>$this->input->post('tanggal_pengeluaran'),
            'lokasi_pembelian'=>$this->input->post('lokasi_pembelian'),
            
        );
        $this->model_pembelian->insertPembelian($data);
        redirect("admin/pembelian_2");
}
	
	public function invoice($kode=false){
		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');
			return false;
		} 
		
		if (!$kode) {
			redirect('admin/data_member');
			return false;
		}
		
		$this->load->model('model_trans');
		$pack = array(
			'data' => $this->model_trans->getSingleCompleteInvoice($kode),
		);
		
		$data=array(
			'user_id' => $this->tank_auth->get_user_id(),
			'username' => $this->tank_auth->get_username(),
		
			'output' => $this->load->view('admin/invoice', $pack, TRUE),
		);
		$html_title ="LUMINOX | Invoice";
		$this->load->vars( array( 'html_title' => $html_title) );
		$this->load->view('wrapper_admin/content_wrapper_pembelian',$data);
	}
	
	public function popup_barang($id=false){
	
		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');
			return false;
		} 
		
		if ($id){
			$pack = array(
				'data' => $this->model_barang->getDetail($id),
			);
			$this->load->view('admin/popup_barang-select', $pack);
			return false;
		}
		
		if(isset($_GET['iDisplayLength'])){
			echo $this->model_barang->getDataTable();
			return false;
		}
		
		$this->load->view('admin/popup_barang');
		
	}

	
	public function promo()
	{
		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');
		} else {

			$crud = new grocery_CRUD();
			$crud->set_theme('datatables');
			$crud->set_table('tbl_promo');
			$crud->set_subject('Promo Member');
			$crud->set_relation('id_jenispromo','tbl_jenispromo','jenispromo');
			//$crud->set_relation('role_id','roles','full');
			$crud->display_as('id_jenispromo','Jenis Promo');
			//$crud->display_as('role_id','Hak Akses');
			$crud->columns('id_jenispromo','deskripsi','file_url');
			$crud->set_field_upload('file_url','uploads');
			//$crud->edit_fields('user_id','role_id');
			
			$output = $crud->render();
			$html_title ="LUMINOX | Hak AKses Member";
			$this->load->vars( array( 'html_title' => $html_title) );
			$page_header ="Promo";
			$this->load->vars( array( 'page_header' => $page_header) );
			$this->show_output($output);
		}
	}

	function ubah_profil()
	{
		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');
		} else {
			$data['user_id']	= $this->tank_auth->get_user_id();
			$data['username']	= $this->tank_auth->get_username();
			$data['member']	= $this->users->get_user_profile($data['user_id']);
			$data['data_provinsi'] = $this->model_member->getAllProvinsi();
			$data['data_venue'] = $this->model_member->getAllVenue();
			
			$html_title ="LUMINOX | Ubah Profil";
			$this->load->vars( array( 'html_title' => $html_title) );
			$page_header ="Ubah Profil";
			$this->load->vars( array( 'page_header' => $page_header) );
			
			$data['output']	=$this->load->view('admin/ubah_profil',$data,TRUE);
			$this->load->view('wrapper_admin/content_wrapper_pembelian',$data);
		}
	}
	function proses_ubah()
	{
		$this->load->model('model_member','',TRUE);
		$this->model_member->ubah_member();
		redirect('member/ubah_profil','refresh');
	}
	


	/**
	 * Open a notice page
	 * @param  string $page Filename of the page to open w/o the .php extension
	 */
	public function notice($page){

		if($this->session->flashdata('tankauth_allow_notice')){
			// Check for $data
			if($this->session->flashdata('tankauth_notice_data')) extract($this->session->flashdata('tankauth_notice_data'));
			
			switch($page){
				
				// Registration
				case 'registration-success':
					$data['page_title'] = 'Successful Registration';
					break;
				case 'registration-disabled':
					$data['page_title'] = 'Registration Disabled';
					break;	

				
				// Activation
				case 'activation-sent':
					$data['email'] = $email;
					$data['page_title'] = 'Activation Email Sent';
					break;
				case 'activation-complete':
					$data['login_link'] = base_url('auth/login');
					$data['page_title'] = 'Activation Complete';
					break;
				case 'activation-failed':
					$data['page_title'] = 'Activation Failed';
					break;
				
				
				// Password
				case 'password-changed':
					$data['page_title'] = 'Password Changed';
					break;
				case 'password-sent':
					$data['page_title'] = 'New Password Sent';
					break;
				case 'password-reset':
					$data['page_title'] = 'Password Reset';
					break;
				case 'password-failed':
					$data['page_title'] = 'Password Failed';
					break;
				
				
				// Email
				case 'email-sent':
					$data['email'] = $new_email;
					$data['page_title'] = 'Confirmation Email Sent';
					break;
				case 'email-activated':
					$data['login_link'] = base_url('auth/login');
					$data['page_title'] = 'Your Email has been Activated';
					break;
				case 'email-failed':
					$data['page_title'] = 'Email Sending Failed';
					break;
				
				
				// User + Account
				case 'user-banned':
					$data['page_title'] = 'You have been Banned.';
					break;
				case 'user-deleted':
					$data['page_title'] = 'Your account has been Deleted.';
					break;
				case 'acct-unapproved':
					$data['logout_link'] = base_url('auth/logout');
					$data['page_title'] = 'Account not yet Approved';
					break;
				case 'logout-success':
					$data['page_title'] = 'Logged Out';
					break;
				
				default:
					redirect('/auth/login');
			}
			
			if($this->session->flashdata('is_logged_out')) $this->tank_auth->logout();
			
			$data['body_class'] = $page;
			$this->load->view('landing/'.$page, $data);
		}
		else {
			redirect('/auth/login');
		}

	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */