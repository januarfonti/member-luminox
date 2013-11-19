<script src="http://code.jquery.com/jquery-1.8.3.js"></script>


     <div class="container">

     	<?php
			if (isset($data_servis)){
			foreach($data_servis as $row){
		?>

     <?
		$attr = array(
			'role' => 'form',
			'class' => 'form-horizontal'
		); 
	 ?>    	

     <?php echo form_open('admin/proses_input_servis',$attr) ?>
  		
  		
		<div class="form-group">
		    <label for="inputPassword1" class="col-lg-2 control-label">ID Detail</label>
		    <div class="col-lg-4">
		      <input name="id_detail" type="text" class="form-control" readonly="true" id="inputPassword1" value="<?php echo $row->id_detail;?>">
		    </div>
		  </div>

		  <div class="form-group">
		    <label for="inputPassword1" class="col-lg-2 control-label">ID Member</label>
		    <div class="col-lg-4">
		      <input name="id_member" type="text" class="form-control" readonly="true" id="inputPassword1" value="<?php echo $row->id;?>">
		    </div>
		  </div>

     	<div class="form-group">
		    <label for="inputPassword1" class="col-lg-2 control-label">No Member</label>
		    <div class="col-lg-4">
		      <input name="no_member" type="text" class="form-control" readonly="true" id="inputPassword1" value="<?php echo $row->no_member;?>">
		    </div>
		  </div>
		
		<div class="form-group">
		    <label for="inputPassword1" class="col-lg-2 control-label">Nama</label>
		    <div class="col-lg-4">
		      <input name="nama" type="text" class="form-control" readonly="true" id="inputPassword1" value="<?php echo $row->nama;?>">
		    </div>
		  </div>


		<div class="form-group">
		    <label for="inputEmail1" class="col-lg-2 control-label">No Seri</label>
		    <div class="col-lg-4">
		      <input name="seri_barang" type="text" class="form-control" readonly="true" id="inputEmail1" value="<?php echo $row->seri_barang;?>">
		    </div>
		  </div>

		  <div class="form-group">
		    <label for="inputEmail1" class="col-lg-2 control-label">Nama Barang</label>
		    <div class="col-lg-4">
		      <input name="nm_barang" type="text" class="form-control" readonly="true" id="inputEmail1" value="<?php echo $row->nm_barang;?>">
		    </div>
		  </div>


		  <div class="form-group">
		    <label for="inputPassword1" class="col-lg-2 control-label">Tanggal Masuk Servis</label>
		    <div class="col-lg-4 input-append date">
		      <input name="tgl_masuk" type="text" class="form-control" data-date="12-02-2012" data-date-format="yyyy-mm-dd" id="tanggalan" ><span class="add-on"><i class="icon-th"></i></span>
		    </div>
		  </div>

		  <div class="form-group">
		    <label for="inputPassword1" class="col-lg-2 control-label">Tanggal Keluar Servis</label>
		    <div class="col-lg-4 input-append date">
		      <input name="tgl_keluar" type="text" class="form-control" data-date="12-02-2012" data-date-format="yyyy-mm-dd" id="tanggalan_dua" ><span class="add-on"><i class="icon-th"></i></span>
		    </div>
		  </div>

		  <div class="form-group">
		    <label for="inputPassword1" class="col-lg-2 control-label">Keterangan</label>
		    <div class="col-lg-4">
		      <textarea class="form-control" rows="5" name="keterangan"></textarea>
		    </div>
		  </div>

		  
  
		  <div class="form-group">
		    <div class="col-lg-offset-2 col-lg-10">
		      <button type="submit" class="btn btn-info">Submit</button>
		    </div>
		  </div>

	</form>

     </div>

     <?php }
}
?>

<script src="<?php echo base_url('asset/date/js/prettify.js');?>"></script>

    <script src="<?php echo base_url('asset/jquery.js');?>"></script>
    <script src="<?php echo base_url('asset/date/js/bootstrap-datepicker.js');?>"></script>
    
	<script>
		$('#tanggalan').datepicker();
	</script>

	<script>
		$('#tanggalan_dua').datepicker();
	</script>

	<script src="http://www.google-analytics.com/urchin.js" type="text/javascript">
</script>