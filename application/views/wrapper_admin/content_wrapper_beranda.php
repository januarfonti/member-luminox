<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="<?php echo base_url('asset/favicon.png');?>">

    <?php if( isset($html_title) && $html_title != '' ){
     echo '<title>' . $html_title . '</title>';} ?>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/css/bootstrap.min.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/css/style.css');?>">
    <script src="<?php echo base_url('asset/js/jquery-1.8.1.js')?>"></script>  
   

    <!-- Add custom CSS here -->
    <link href="<?php echo base_url('asset/css/simple-sidebar.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('asset/font-awesome/css/font-awesome.min.css');?>" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/date/css/datepicker.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/date/js/bootstrap-datepicker.js');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/date/less/datepicker.less');?>">
  </head>

  <body>
    <div id="wrapper">
      <!-- Sidebar -->
      <div id="sidebar-wrapper">
        <ul class="sidebar-nav">
          <li class="sidebar-brand"><a href="../admin/index"><img src="<? echo base_url('asset/images/logo-luminox.png')?>"></a></li>
          <li><?php echo anchor('/admin/aktivasi/', '<span class="glyphicon glyphicon-user"></span><span>  </span>Aktivasi Member'); ?></li>
          <li><?php echo anchor('/admin/data_member/', '<span class="glyphicon glyphicon-user"></span>  Data Member'); ?></li>
          <li><?php echo anchor('/admin/pembelian/', '<span class="glyphicon glyphicon-shopping-cart"></span>  Input Pembelian'); ?></li>
          <li><?php echo anchor('/admin/pembelian_2/', '<span class="glyphicon glyphicon-shopping-cart"></span>  Input Pembelian 2'); ?></li>
          <li><?php echo anchor('/admin/laporan_pembelian/', '<span class="glyphicon glyphicon-book"></span>  Laporan Pembelian'); ?></li>
          <li><?php echo anchor('/admin/servis/', '<span class="glyphicon glyphicon-cog"></span>  Input Servis Barang'); ?></li>
          <li><?php echo anchor('/admin/laporan_servis/', '<span class="glyphicon glyphicon-book"></span>  Laporan Servis'); ?></li>
          <li><?php echo anchor('/admin/barang/', '<span class="glyphicon glyphicon-hdd"></span>  Master Barang'); ?></li>
          <li><?php echo anchor('/admin/promo/', '<span class="glyphicon glyphicon-thumbs-up"></span>  Input Promosi'); ?></li>
          <li><?php echo anchor('/admin/barang_terbaru/', '<span class="glyphicon glyphicon-book"></span>  Input Barang Terbaru'); ?></li>
          <li><?php echo anchor('/auth/logout/','<span class="glyphicon glyphicon-log-out"></span>Logout'); ?></li>
        </ul>
      </div>
          
      <!-- Page content -->
      <div id="page-content-wrapper">
        <div class="content-header">
          <h1>
            <a id="menu-toggle" href="#" class="btn btn-default"><i class="icon-reorder"></i></a>
            Halaman Admin
          </h1>
        </div>

        <!-- Keep all page content within the page-content inset div! -->
        <div class="page-content inset">
          <div class="row">
            <div class="col-md-12">
              <ol class="breadcrumb">
                <li><a href="<? echo base_url(); ?>">Home</a></li>
                <?php if( isset($page_header) && $page_header != '' ){
                echo '<li class="active">'.$page_header.'</li>';}
                ?>
              </ol>
            </div>  <!--col-md-12 -->

            

            <div class="col-md-8">
             <div class="panel panel-success">
                <div class="panel-heading">
                  <h3 class="panel-title">Histori Terakhir</h3>
                </div>
                <div class="panel-body">
                  <strong>Histori Pembelian</strong>
                  <table class="table table-bordered">
                    <thead>
                      <tr class="danger">
                        <th>Tanggal</th>
                        <th>Nama Barang</th>
                        <th>No Member</th>
                        <th>Nama Member</th>
                        
                        
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach($transaksiterakhir as $row) : ?>
                      <tr>
                        <td><?php echo $row->tanggal_pengeluaran; ?></td>
                        <td><?php echo $row->nm_barang; ?></td>
                        <td><?php echo $row->no_member; ?></td>
                        <td><?php echo $row->nama; ?></td>
                        
                      </tr>

                      <?php endforeach; ?>
                    </tbody>
                  </table>

                  <strong>Histori Servis</strong>
                  <table class="table table-bordered">
                    <thead>
                      <tr class="danger">
                        <th>Tanggal Masuk</th>
                        <th>Tanggal Keluar</th>
                        <th>Nama Barang</th>
                        <th>No Member</th>
                        <th>Nama Member</th>
                        
                        
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach($servisterakhir as $row) : ?>
                      <tr>
                        
                        <td><?php echo $row->tgl_masuk; ?></td>
                        <td><?php echo $row->tgl_keluar; ?></td>
                        <td><?php echo $row->nm_barang; ?></td>
                        <td><?php echo $row->no_member; ?></td>
                        <td><?php echo $row->nama; ?></td>
                        
                      </tr>

                      <?php endforeach; ?>
                    </tbody>
                  </table>

                </div>
              </div>
            </div>

<div class="col-md-4 ">
              <div class="panel panel-success">
                <div class="panel-heading">
                  <h3 class="panel-title">Data Member</h3>
                </div>
                <div class="panel-body">
                  <strong>Member Terbaru</strong> </br><hr>
                  <?php
                    foreach($memberterbaru as $row){
                  ?>
                  <strong>No Member           :</strong> <?php echo $row->no_member; ?></br>
                  <strong>Nama                :</strong> <?php echo $row->nama; ?></br>
                  <strong>Alamat              :</strong> <?php echo $row->alamat; ?></br>
                  <strong>Kota                :</strong> <?php echo $row->kota; ?></br>
                  <strong>Email               :</strong> <?php echo $row->email; ?></br>
                  <strong>Tempat Pendaftaran  :</strong> <?php echo $row->venue; ?></br>
                  <strong>Waktu Pendaftaran   :</strong> <?php echo $row->created; ?>

                  <? } ?>
                  <hr>
                  <strong>Jumlah Member :</strong> <?  $this->db->like('role_id', '2');
                                              $this->db->from('user_roles');
                                              echo $this->db->count_all_results(); ?>
                   </br>

                </div>
              </div>
            </div>

</div>  <!--row -->
           

            

          

        </div>  <!--page content inset -->
      </div>  <!--page content wrapper -->
    </div>  <!--wrapper-->
  
    <!-- Bootstrap core JavaScript -->
    <!-- Placed at the end of the document so the pages load faster -->
    
    <script src="<?php echo base_url('asset/js/bootstrap.min.js');?>"></script>
    <!-- Put this into a custom JavaScript file to make things more organized -->
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("active");
    });
    </script>
  </body>
</html>