<div class="container">

<div class="page-header">
        <h3>Histori Pembelian</h3>
</div>

<ol class="breadcrumb">
  <li class="active"><? echo ''.$member['no_member'].''; ?></li>
  <li class="active"><? echo ''.$member['nama'].''; ?></li>
</ol>


<?php
              
              if(isset($historipembelian)){
              foreach($historipembelian as $row){
              ?>


  <div class="col-xs-6">

      <!-- ISI -->
        <div class="media">
          <a class="pull-left" href="#">
            
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

<div class="col-xs-12">
  <? echo $halaman ?>
</div>

</div> <!-- container -->
