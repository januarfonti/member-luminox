<div class="container">

  

  <div class="alert alert-info alert-block fade in">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  <strong><p>PROMO MEMBER</p></strong>
  <hr>
   <?php
            if(isset($promo)){
            foreach($promo as $row){
    ?>

    
    <p><strong><?php echo $row->tanggal_promo; ?></strong> <?php echo $row->deskripsi; ?></p>


    <? } } ?>

  </div>

  

 
  <?php echo $this->session->flashdata('ganti_password');?>
  


  <div class="panel panel-success">
            <div class="panel-heading">
              <h3 class="panel-title">Data Member</h3>
            </div>
            <div class="panel-body">
              


                 <div class="row">
    <div class="col-xs-6">
      <form class="form-horizontal" role="form">
  
         <?php
            if(isset($data_member)){
            foreach($data_member as $row){
         ?>

          <div class="form-group">
              <label class="col-lg-4 control-label">No Member</label>
              <div class="col-lg-8">
                <p class="form-control-static"><?php echo $row->no_member; ?></p>
              </div>
            </div>


          <div class="form-group">
              <label class="col-lg-4 control-label">Tempat Registrasi</label>
              <div class="col-lg-8">
                <p class="form-control-static"><?php echo $row->venue; ?></p>
              </div>
            </div>


          <div class="form-group">
            <label class="col-lg-4 control-label">Nama</label>
            <div class="col-lg-8">
              <p class="form-control-static"><?php echo $row->nama; ?></p>
            </div>
          </div>

          <div class="form-group">
            <label class="col-lg-4 control-label">Alamat</label>
            <div class="col-lg-8">
              <p class="form-control-static"><?php echo $row->alamat; ?></p>
            </div>
          </div>

          <div class="form-group">
            <label class="col-lg-4 control-label">Kota</label>
            <div class="col-lg-8">
              <p class="form-control-static"><?php echo $row->kota; ?></p>
            </div>
          </div>

          <div class="form-group">
            <label class="col-lg-4 control-label">Provinsi</label>
            <div class="col-lg-8">
              <p class="form-control-static"><?php echo $row->state_name; ?></p>
            </div>
          </div>
      </form>
    </div>
    <div class="col-xs-6">
      <form class="form-horizontal" role="form">

          <div class="form-group">
            <label class="col-lg-4 control-label">Kodepos</label>
            <div class="col-lg-8">
              <p class="form-control-static"><?php echo $row->kodepos; ?></p>
            </div>
          </div>

          <div class="form-group">
            <label class="col-lg-4 control-label">Tanggal Lahir</label>
            <div class="col-lg-8">
              <p class="form-control-static"><?php echo $row->ttl; ?></p>
            </div>
          </div>

          <div class="form-group">
            <label class="col-lg-4 control-label">Nomer HP</label>
            <div class="col-lg-8">
              <p class="form-control-static"><?php echo $row->no_hp; ?></p>
            </div>
          </div>

          <div class="form-group">
            <label class="col-lg-4 control-label">Nomer Rumah</label>
            <div class="col-lg-8">
              <p class="form-control-static"><?php echo $row->no_rumah; ?></p>
            </div>
          </div>

          <div class="form-group">
            <label class="col-lg-4 control-label">Email</label>
            <div class="col-lg-8">
              <p class="form-control-static"><?php echo $row->email; ?></p>
            </div>
          </div>
  
  
  <?php } 
} ?>
      </form>
    </div>
  </div>


            </div>
          </div>

 

 




  

  <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">Pembelian Terakhir</h3>
            </div>
            <div class="panel-body">
              
              <?php
              
              if(isset($historipembelian_limit)){
              foreach($historipembelian_limit as $row){
              ?>


  <div class="col-xs-6">

      <!-- ISI -->
        <div class="media">
          <a class="pull-left" href="#">
            <? 
              $config['base_url'] = 'http://localhost/luminox/';
            ?>
            <img class="media-object img-thumbnail img-responsive" src="<? site_url(); ?>/luminox/uploads/<? echo $row->file_url; ?>" alt="...">
          </a>
        
          <div class="media-body">
            <h3 class="media-heading"><?php echo $row->nm_barang; ?></h3>
            <div class="isi">
              <p>
                <strong>Seri</strong> <?php echo $row->seri_barang; ?><br>
                <strong>Harga</strong> <?php echo $row->harga; ?><br>
                <strong>Jumlah Pembelian</strong> <?php echo $row->qty; ?><br>
                <strong>Total Harga</strong> <?php echo $row->total_harga; ?><br>
                <strong>Tanggal Pembelian</strong> <?php echo $row->tanggal_pengeluaran; ?><br>
                <strong>Lokasi Pembelian</strong> <?php echo $row->lokasi_pembelian; ?><br>
                
              </p>
              
            </div>  
          </div>
        </div>
      <!-- ISI akhir-->

  </div><!-- KOLOM akhir-->
  
<?php }
            }
            ?>

<a href="<?php echo base_url('member/histori_pembelian');?>" class="btn btn-info btn-lg" style="width:100%;"><span class="glyphicon glyphicon-plus"></span>   Lihat Semua Pembelian</a>
            </div>
          </div>

  



</div> <!-- container -->

