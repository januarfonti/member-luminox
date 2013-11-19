<script src="http://code.jquery.com/jquery-1.8.3.js"></script>
     <div class="container">
     <?
		$attr = array(
			'role' => 'form',
			'class' => 'form-horizontal'
		); 
	 ?>    	

     <?php echo form_open('member/proses_ubah',$attr) ?>
  		

  		  <input name="id" type="hidden" class="form-control" id="id" value="<? echo ''.$member['id'].''; ?>">

  		  <div class="form-group">
		    <label for="inputEmail1" class="col-lg-2 control-label">No Member</label>
		    <div class="col-lg-4">
		      <input name="no_member" type="text" class="form-control" id="no_member" readonly="true">
		    </div>
		  </div>

		  <div class="form-group">
		    	<label for="inputPassword1" class="col-lg-2 control-label">Tempat Pendaftaran</label>
		    		<div class="col-lg-4">
						  <select id="pilih-venue" class="form-control" name="regist">
				                         <option value=""></option>
				                                <?php
				                                if(isset($data_venue)){
				                                    foreach($data_venue as $row){
				                                        ?>
				                                        <option value="<?php echo $row->id_venue?>"><?php echo $row->venue?></option>
				                                    <?php
				                                    }
				                                }
				                                ?>
				           		</select>
             </div>
		  </div>

		  <div class="form-group">
		    <label for="inputEmail1" class="col-lg-2 control-label">Nama Lengkap</label>
		    <div class="col-lg-4">
		      <input name="nama" type="text" class="form-control" id="inputEmail1" value="<? echo ''.$member['nama'].''; ?>">
		    </div>
		  </div>


		  <div class="form-group">
		    <label for="inputPassword1" class="col-lg-2 control-label">Alamat</label>
		    <div class="col-lg-4">
		      <input name="alamat" type="text" class="form-control" id="inputPassword1" value="<? echo ''.$member['alamat'].''; ?>">
		    </div>
		  </div>

		  <div class="form-group">
		    <label for="inputEmail1" class="col-lg-2 control-label">Kota</label>
		    <div class="col-lg-4">
		      <input name="kota" type="text" class="form-control" id="inputEmail1" value="<? echo ''.$member['kota'].''; ?>">
		    </div>
		  </div>


		 

			<div class="form-group">
		    	<label for="inputPassword1" class="col-lg-2 control-label">Provinsi</label>
		    		<div class="col-lg-4">
		  <select id="pilih-provinsi" class="form-control" name="provinsi" value="PILIH PROVINSI" data-placeholder="Pilih Pelanggan">
                         <option value=""></option>
                                <?php
                                if(isset($data_provinsi)){
                                    foreach($data_provinsi as $row){
                                        ?>
                                        <option value="<?php echo $row->state_id?>"><?php echo $row->state_name?></option>
                                    <?php
                                    }
                                }
                                ?>
           </select>
             </div>
		  </div>

		  <div class="form-group">
		    <label for="inputEmail1" class="col-lg-2 control-label">Kodepos</label>
		    <div class="col-lg-4">
		      <input name="kodepos" type="text" class="form-control" id="inputEmail1" value="<? echo ''.$member['kodepos'].''; ?>">
		    </div>
		  </div>


		  <div class="form-group">
		    <label for="inputPassword1" class="col-lg-2 control-label">Tanggal Lahir</label>
		    <div class="col-lg-4 input-append date">
		      <input name="ttl" type="text" class="form-control" data-date="12-02-2012" data-date-format="yyyy-mm-dd" id="tanggalan" value="<? echo ''.$member['ttl'].''; ?>"><span class="add-on"><i class="icon-th"></i></span>
		    </div>
		  </div>

		

		  <div class="form-group">
		    <label for="inputEmail1" class="col-lg-2 control-label">Nomor HP</label>
		    <div class="col-lg-4">
		      <input name="no_hp" type="text" class="form-control" id="inputEmail1" value="<? echo ''.$member['no_hp'].''; ?>">
		    </div>
		  </div>


		  <div class="form-group">
		    <label for="inputPassword1" class="col-lg-2 control-label">Nomor Telpon Rumah</label>
		    <div class="col-lg-4">
		      <input name="no_rumah" type="text" class="form-control" id="inputPassword1" value="<? echo ''.$member['no_rumah'].''; ?>">
		    </div>
		  </div>

  
		  <div class="form-group">
		    <div class="col-lg-offset-2 col-lg-10">
		      <button type="submit" class="btn btn-info">Update Profil</button>
		    </div>
		  </div>

	</form>

     </div>

<?
          $this->load->helper('string'); ?>
        
        <?

        $kode_awal  = 99;
        $myVariable  = 99;
        $kode_akhir = random_string('numeric', 6);

?>
     <script type="text/javascript">

	function pilihprovinsi() {
    $('.sub-menu').hide();
    var yangdipilih = $('#pilih-provinsi').val();
    if (yangdipilih) {
        $('#' + yangdipilih + '-select').show();
    }
}

$(document).ready(function() {
      
    $('#pilih-provinsi').change(pilihprovinsi );
     pilihprovinsi();
     
    $("#pilih-provinsi").change(function () {
      var negoro = $('#pilih-provinsi option:selected').val();
      var kode_awal = "<?php echo $kode_awal; ?>";
      var kode_akhir = "<?php echo $kode_akhir; ?>";
      
      $("#no_member").val(negoro+kode_awal+kode_akhir);
        })
        .change();
    });
	

    
</script>

<script type="text/javascript">

	function pilihprovinsi() {
    $('.sub-menu').hide();
    var yangdipilih = $('#pilih-provinsi').val();
    if (yangdipilih) {
        $('#' + yangdipilih + '-select').show();
    }
}

$(document).ready(function() {
      
    $('#pilih-provinsi').change(pilihprovinsi );
     pilihprovinsi();
     
    $("#pilih-provinsi").change(function () {
      var negoro = $('#pilih-provinsi option:selected').val();
      var kode_awal = "<?php echo $kode_awal; ?>";
      var kode_akhir = "<?php echo $kode_akhir; ?>";
      
      $("#no_member").val(negoro+kode_awal+kode_akhir);
        })
        .change();
    });
	

    
</script>

 <script src="<?php echo base_url('asset/date/js/prettify.js');?>"></script>

    <script src="<?php echo base_url('asset/jquery.js');?>"></script>
    <script src="<?php echo base_url('asset/date/js/bootstrap-datepicker.js');?>"></script>
    
	<script>
		$('#tanggalan').datepicker();
	</script>

	<script src="http://www.google-analytics.com/urchin.js" type="text/javascript">
</script>