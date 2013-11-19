<?php


class Model_trans extends CRUD_Model{
    
	function save($id_pel, $no_member, $lokasi, $data=false){
		$header = array(
			'kd_transaksi' => $this->getNewID(),
			'kd_pelanggan' => $id_pel,
			'no_member' => $no_member,
			'lokasi_pembelian' => $lokasi,
			'tanggal_pengeluaran' => date('Y-m-d'),
			'total_harga' => 0,
		);
		if (is_array($data) && count($data)  > 0) foreach ($data as $send){
			$send['kd_transaksi'] = $header['kd_transaksi'];
			$header['total_harga'] += $send['qty'] * $send['harga'];
			$res = $this->db->insert('tbl_transaksi_detail', $send);
		}
		if ($res) $res = $this->db->insert('tbl_transaksi_header', $header);
		
		if ($res && is_array($data) && count($data)  > 0) foreach ($data as $send){
			$query = 'update tbl_barang set stok = stok - '.$send['qty'].' where kd_barang = "'.$send['kd_barang'].'"';
			$res2 = $this->db->query($query);
		}
		
		if ($res){
			$header['detail'] = $data;
			return $header;
		}
		
		return $res;
	}
	
	function getNewID(){
		$this->db->order_by('kd_transaksi', 'desc');
		$this->db->limit(1);
		$data = $this->db->get('tbl_transaksi_header')->row();
		if (!$data) return 'PL-0000001';
		
		$curr = $data->kd_transaksi;
		$arr = explode('-', $curr);
		return $arr[0].'-'. substr('00000000'.(int)((int)$arr[1]+1), -7);
	}
	
	function getSingleCompleteInvoice($kode){
		$header = $this->db->where('kd_transaksi', $kode)->get('tbl_transaksi_header')->row();
		if (!$header) return false;
		
		$member = $this->db->where('id', $header->kd_pelanggan)->get('user_profiles')->row();
		$detail = $this->db->select('tbl_transaksi_detail.*, seri_barang, nm_barang, stok, file_url')
						->join('tbl_barang', 'tbl_barang.kd_barang=tbl_transaksi_detail.kd_barang', 'left')
						->where('kd_transaksi', $kode)
						->get('tbl_transaksi_detail')->result();
						
		$complete = (object)array(
			'header' => $header,
			'member' => $member,
			'detail' => $detail,
		);
		return $complete;
	}

	function get_transaksiterakhir(){
		return $this->db->query("select `tbl_transaksi_detail`.`id_detail` AS `id_detail`,`tbl_transaksi_detail`.`kd_transaksi` AS `kd_transaksi`,`tbl_barang`.`seri_barang` AS `seri_barang`,`tbl_barang`.`nm_barang` AS `nm_barang`,`tbl_barang`.`harga` AS `harga`,`tbl_barang`.`file_url` AS `file_url`,`tbl_transaksi_header`.`total_harga` AS `total_harga`,`tbl_transaksi_header`.`lokasi_pembelian` AS `lokasi_pembelian`,`tbl_transaksi_header`.`tanggal_pengeluaran` AS `tanggal_pengeluaran`,`user_profiles`.`no_member` AS `no_member`,`user_profiles`.`nama` AS `nama`,`user_profiles`.`id` AS `id` from (((`tbl_transaksi_detail` join `tbl_transaksi_header` on((`tbl_transaksi_header`.`kd_transaksi` = `tbl_transaksi_detail`.`kd_transaksi`))) join `user_profiles` on((`user_profiles`.`id` = `tbl_transaksi_header`.`kd_pelanggan`))) join `tbl_barang` on((`tbl_barang`.`kd_barang` = `tbl_transaksi_detail`.`kd_barang`)))
                                 ORDER BY tanggal_pengeluaran DESC LIMIT 0, 2")->result();
	}

}