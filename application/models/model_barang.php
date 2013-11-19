<?php


class Model_barang extends CRUD_Model{
    
	/* Definisi Model 
	[ */	
	var $select =  '*';
	var $table = 'tbl_barang';
	var $pre = 'brg';
	var $pm = 'kd_barang';
	var $order = array('nm_barang', 'asc');
	var $sortDataTable = array('kd_barang', 'seri_barang', 'nm_barang', 'stok', 'harga');
	var $search = 'kd_barang,seri_barang,nm_barang,stok,harga';
	/* ] */
	
	
	protected function filterDataTable($data){
		foreach ($data as $row){
			// for popup
			$output[] = array(
				$row->kd_barang,
				$row->seri_barang,
				$row->nm_barang,
				$row->stok,
				'Rp '.number_format($row->harga, 2, ',' , '.'),
				'<a href="'.base_url('admin/popup_barang/'.$row->kd_barang).'?popup"><span class="glyphicon glyphicon-ok"></span></a>',
			);	
		}	
		return $output;
	}


//    GET DATA
    function getAllBarang(){
        return $this->db->query("select * from tbl_barang ")->result();
    }

    
    function getAllPelanggan(){
        return $this->db->query("select * from tbl_pelanggan ")->result();
    }

//    GET DATA BY ID
    public function getBarangById($id){
        $this->db->where('kd_barang',$id);
        $query = $this->db->get('tbl_barang');
        return $query->result();
    }

    public function getPelangganById($id){
        $this->db->where('kd_pelanggan',$id);
        $query = $this->db->get('tbl_pelanggan');
        return $query->result();
    }



//    INSERT DATA

    function insertBarang($data){
        $query = $this->db->insert('tbl_barang',$data);
        return $query;
    }
    function insertPelanggan($data){
        $query = $this->db->insert('tbl_pelanggan',$data);
        return $query;
    }


//    UPDATE DATA
    function updateBarang($id,$data){
        $this->db->where('kd_barang',$id);
        $update = $this->db->update('tbl_barang',$data);
        return $update;
    }

    
    function updatePelanggan($id,$data){
        $this->db->where('kd_pelanggan',$id);
        $update = $this->db->update('tbl_pelanggan',$data);
        return $update;
    }


//    DELETE DATA
    function deleteBarang($id){
        $this->db->where('kd_barang',$id);
        $delete = $this->db->delete('tbl_barang');
        return $delete;
    }
    function deletePelanggan($id){
        $this->db->where('kd_pelanggan',$id);
        $delete = $this->db->delete('tbl_pelanggan');
        return $delete;
    }


//    KODE BARANG
    function getKodeBarang()
    {
        $q = $this->db->query("select MAX(RIGHT(kd_barang,7)) as kd_max from tbl_barang");
        $kd = "";
        if($q->num_rows()>0)
        {
            foreach($q->result() as $k)
            {
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%07s", $tmp);
            }
        }
        else
        {
            $kd = "0000001";
        }
        return "BR-".$kd;
    }

    //    KODE PELANGGAN
    public function getKodePelanggan()
    {
        $q = $this->db->query("select MAX(RIGHT(kd_pelanggan,6)) as kd_max from tbl_pelanggan");
        $kd = "";
        if($q->num_rows()>0)
        {
            foreach($q->result() as $k)
            {
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%06s", $tmp);
            }
        }
        else
        {
            $kd = "000001";
        }
        return "PLG-".$kd;
    }


}