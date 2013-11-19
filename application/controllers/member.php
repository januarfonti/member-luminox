<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Member extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library(array('session', 'tank_auth'));
		$this->load->helper('url');
		$this->load->model('tank_auth/users');
		$this->load->model('model_member');
		$this->load->model('general_model');
	}
	function index()
	{
		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');
		} else {
			$data['user_id']	= $this->tank_auth->get_user_id();
			$jabatan_arr = $this->db->query('select no_member from user_profiles where id = '.$data['user_id'].'');
			if($jabatan_arr != FALSE)
			{
				$jabatan_arr	= $jabatan_arr->result_array();
				foreach ($jabatan_arr as $row){
					$no_member['']		= '';
					$no_member[$row['no_member']]= $row['no_member'];
				}
			}
			if($row['no_member'] == 0){
				redirect('member/ubah_profil');
			} else {
			$data['username']	= $this->tank_auth->get_username();
			$data['data_member'] = $this->model_member->get_profil_data();
			$data['member']	= $this->users->get_user_profile($data['user_id']);
			$data['historipembelian_limit'] = $this->model_member->getHistoriPembelian_limit();
			$data['promo'] = $this->model_member->get_promo();
			$data['judul']	    ='Selamat datang di halaman member';
			$data['content']	=$this->load->view('member/beranda',$data,TRUE);
			$this->load->view('wrapper_member/content_wrapper',$data);
			}	
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
			
			$data['judul']	    ='Ubah Profil';
			$data['content']	=$this->load->view('member/ubah_profil',$data,TRUE);
			$this->load->view('wrapper_member/content_wrapper',$data);
		}
	}
	function proses_ubah()
	{
		$this->load->model('model_member','',TRUE);
		$this->model_member->ubah_member();
		redirect('member/ubah_profil','refresh');
	}
	
	function histori_pembelian()
	{
		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');
		} else {
			$data=array(
			'user_id' 		=> $this->tank_auth->get_user_id(),
			'username' 		=> $this->tank_auth->get_username(),
			'data_barang'=>$this->model_member->getAllPembelian(),
			'judul'=> 'Histori Pembelian',
            );
			$data['member']	= $this->users->get_user_profile($data['user_id']);
			$page=$this->uri->segment(3);
			$limit=8;
			if(!$page):
			$offset = 0;
			else:
			$offset = $page;
			endif;
			$data['tot'] = $offset;
			$tot_hal = $this->db->query("select `user_profiles`.`no_member` AS `no_member`,`user_profiles`.`nama` AS `nama`,`tbl_barang`.`seri_barang` AS `seri_barang`,`tbl_barang`.`nm_barang` AS `nm_barang`,`tbl_barang`.`file_url` AS `file_url`,`tbl_barang`.`harga` AS `harga`,`tbl_transaksi_header`.`total_harga` AS `total_harga`,`tbl_transaksi_header`.`lokasi_pembelian` AS `lokasi_pembelian`,`tbl_transaksi_header`.`tanggal_pengeluaran` AS `tanggal_pengeluaran`,`tbl_transaksi_detail`.`qty` AS `qty`,`user_profiles`.`id` AS `id`,`tbl_transaksi_header`.`kd_transaksi` AS `kd_transaksi` from (((`tbl_barang` join `tbl_transaksi_detail` on((`tbl_barang`.`kd_barang` = `tbl_transaksi_detail`.`kd_barang`))) join `tbl_transaksi_header` on((`tbl_transaksi_detail`.`kd_transaksi` = `tbl_transaksi_header`.`kd_transaksi`))) join `user_profiles` on((`user_profiles`.`id` = `tbl_transaksi_header`.`kd_pelanggan`)))
        						where user_profiles.id = ".$data['user_id']."");
			$config['base_url'] = site_url('member/histori_pembelian');
			$config['total_rows'] = $tot_hal->num_rows();
			$config['per_page'] = $limit;
			$config['uri_segment'] = 3;
			$this->pagination->initialize($config);
			$data['halaman'] =$this->pagination->create_links();
			$data['historipembelian'] = $this->db->query("select `user_profiles`.`no_member` AS `no_member`,`user_profiles`.`nama` AS `nama`,`tbl_barang`.`seri_barang` AS `seri_barang`,`tbl_barang`.`nm_barang` AS `nm_barang`,`tbl_barang`.`file_url` AS `file_url`,`tbl_barang`.`harga` AS `harga`,`tbl_transaksi_header`.`total_harga` AS `total_harga`,`tbl_transaksi_header`.`lokasi_pembelian` AS `lokasi_pembelian`,`tbl_transaksi_header`.`tanggal_pengeluaran` AS `tanggal_pengeluaran`,`tbl_transaksi_detail`.`qty` AS `qty`,`user_profiles`.`id` AS `id`,`tbl_transaksi_header`.`kd_transaksi` AS `kd_transaksi` from (((`tbl_barang` join `tbl_transaksi_detail` on((`tbl_barang`.`kd_barang` = `tbl_transaksi_detail`.`kd_barang`))) join `tbl_transaksi_header` on((`tbl_transaksi_detail`.`kd_transaksi` = `tbl_transaksi_header`.`kd_transaksi`))) join `user_profiles` on((`user_profiles`.`id` = `tbl_transaksi_header`.`kd_pelanggan`)))
        						where user_profiles.id = ".$data['user_id']." limit ".$offset.",".$limit."")->result();
			$data['content']	=$this->load->view('member/histori_pembelian',$data,TRUE);
			$this->load->view('wrapper_member/content_wrapper',$data);
		}
	}
	function histori_servis()
	{
		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');
		} else {
			$data=array(
			'user_id' 		=> $this->tank_auth->get_user_id(),
			'username' 		=> $this->tank_auth->get_username(),
			'data_barang'=>$this->model_member->getAllPembelian(),
			'judul'=> 'Histori Servis',
            );
			$data['member']	= $this->users->get_user_profile($data['user_id']);
			$page=$this->uri->segment(3);
			$limit=8;
			if(!$page):
			$offset = 0;
			else:
			$offset = $page;
			endif;
			$data['tot'] = $offset;
			$tot_hal = $this->db->get("tbl_servis");
			$this->db->where('id_member', $data['user_id']);
			$config['base_url'] = site_url('member/histori_servis');
			$config['total_rows'] = $tot_hal->num_rows();
			$config['per_page'] = $limit;
			$config['uri_segment'] = 3;
			$this->pagination->initialize($config);
			$data['halaman'] =$this->pagination->create_links();
			$data['historiservis'] = $this->db->query("select * from tbl_servis
        						where id_member = ".$data['user_id']." limit ".$offset.",".$limit."")->result();
			$data['content']	=$this->load->view('member/histori_servis',$data,TRUE);
			$this->load->view('wrapper_member/content_wrapper',$data);
		}
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