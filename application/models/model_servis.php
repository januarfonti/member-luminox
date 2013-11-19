<?php


class Model_servis extends CI_Model{
    function __construct(){
        parent::__construct();
    }

//    GET DATA
    function get_pembelian_by_id($id){
        return $this->db->query("select `tbl_transaksi_detail`.`id_detail` AS `id_detail`,`tbl_transaksi_detail`.`kd_transaksi` AS `kd_transaksi`,`tbl_barang`.`seri_barang` AS `seri_barang`,`tbl_barang`.`nm_barang` AS `nm_barang`,`tbl_barang`.`harga` AS `harga`,`tbl_barang`.`file_url` AS `file_url`,`tbl_transaksi_header`.`total_harga` AS `total_harga`,`tbl_transaksi_header`.`lokasi_pembelian` AS `lokasi_pembelian`,`tbl_transaksi_header`.`tanggal_pengeluaran` AS `tanggal_pengeluaran`,`user_profiles`.`no_member` AS `no_member`,`user_profiles`.`nama` AS `nama`,`user_profiles`.`id` AS `id` from (((`tbl_transaksi_detail` join `tbl_transaksi_header` on((`tbl_transaksi_header`.`kd_transaksi` = `tbl_transaksi_detail`.`kd_transaksi`))) join `user_profiles` on((`user_profiles`.`id` = `tbl_transaksi_header`.`kd_pelanggan`))) join `tbl_barang` on((`tbl_barang`.`kd_barang` = `tbl_transaksi_detail`.`kd_barang`)))
                                where id_detail = $id ")->result();
    }
    
    function insertServis($data){
        $query = $this->db->insert('tbl_servis',$data);
        return $query;
    }

    function get_servisterakhir(){
        
        return $this->db->query("select * from tbl_servis ORDER BY tgl_masuk DESC LIMIT 2")->result();
        
                                
    }

}