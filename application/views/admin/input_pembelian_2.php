<div class="container well">


<link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/css/jquery-ui-1.9.2.custom.min.css');?>">
<script src="<?php echo base_url('asset/js/jquery-ui-1.9.2.custom.min.js')?>"></script>	
<?
		$attr = array(
			'role' => 'form',
			
		); 
	 ?>    	

     <?php echo form_open('admin/proses_input_pembelian',$attr) ?>

  <div class="row">
	<div class="col-xs-6 clearfix">

	  <div class="form-group">
		<label for="inputEmail1" class="control-label">No Member</label>
		<input name="nama" type="text" class="form-control" id="inputEmail1" value="<?php echo $member1[0]['no_member'];?>" disabled>
		<input name="no_member" type="hidden" value="<?php echo $member1[0]['no_member'];?>">
		<input name="id_member" type="hidden" value="<?php echo $member1[0]['id'];?>">
	  </div>

	  <div class="form-group">
		<label for="inputEmail1" class="control-label">Nama Lengkap</label>
		<input name="nama" type="text" class="form-control" id="inputEmail1" value="<?php echo $member1[0]['nama'];?>" disabled>
	  </div>
	</div>
	
	<div class="col-xs-6 clearfix">

	  <div class="form-group">
		<label for="inputEmail1" class="control-label">Lokasi</label>
		<input name="lokasi_pembelian" type="text" class="form-control" value="" placeholder="Lokasi Pembelian">
	  </div>

	  <div class="form-group">
		<label for="inputEmail1" class="control-label">Tanggal</label>
		<input name="tanggal_pengeluaran" type="text" class="form-control" data-date="12-02-2012" data-date-format="yyyy-mm-dd" id="tanggalan" >
	  </div>

	  

	</div>
  </div>
  
  <div class="row">
	<div class="col-xs-12 clearfix">
		 <div class="form-group">
		<label for="inputEmail1" class="control-label">Produk</label>
		<input name="produk" type="text" class="form-control" id="inputEmail1" placeholder="Produk">
	  </div>
	   <div class="form-group">
		<label for="inputEmail1" class="control-label">Harga</label>
		<input name="harga" type="text" class="form-control" id="inputEmail1" placeholder="Harga">
	  </div>
	  <div class="form-group">
		<label for="inputEmail1" class="control-label">Keterangan</label>
		<input name="keterangan" type="text" class="form-control" id="inputEmail1" placeholder="Keterangan">
	  </div>

	  <div class="form-group">
		    
		      <button type="submit" class="btn btn-info" style="width:100%;">Input Pembelian</button>
		    
		  </div>
	</div>
</div>



</form>  
</div>

<link rel='stylesheet' type='text/css' href='<?=base_url('asset/css/jquery.window.css') ?>'>
<script src="<?php echo base_url('asset/jquery.js');?>"></script>
<script src="<?=base_url('asset/js/jquery.window.js') ?>"></script>
<script src="<?php echo base_url('asset/date/js/bootstrap-datepicker.js');?>"></script>
    
	<script>
		$('#tanggalan').datepicker();
	</script>