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
              <? echo $output; ?>
            </div>  <!--col-md-12 -->
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