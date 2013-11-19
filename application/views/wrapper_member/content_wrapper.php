
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="<?php echo base_url('asset/favicon.png');?>">

    <title><? echo $judul; ?></title>

    <!-- Bootstrap core CSS -->
    
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/css/bootstrap.min.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/css/style.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/date/css/datepicker.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/date/js/bootstrap-datepicker.js');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/date/less/datepicker.less');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/jquery.js');?>">
    

      

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="../../asset/js/html5shiv.js"></script>
      <script src="../../asset/js/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    
    <div id="wrap">
      <!-- Static navbar -->
      <div class="navbar navbar-default navbar-fixed-top">
        <div class="container">

          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Luminox</a>
          </div>

          <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li><?php echo anchor('/member/', '<span class="glyphicon glyphicon-home"></span>  Beranda'); ?></li>
              <li><?php echo anchor('/member/histori_pembelian/', '<span class="glyphicon glyphicon-shopping-cart"></span>  Histori Pembelian'); ?></li>
              <li><?php echo anchor('/member/histori_servis/', '<span class="glyphicon glyphicon-wrench"></span>  Histori Servis'); ?></li>
            </ul>
            
            <ul class="nav navbar-nav navbar-right">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span><? echo ''.$member['nama'].''; ?> <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><?php echo anchor('/auth/logout/', '<span class="glyphicon glyphicon-log-out"></span>  Logout'); ?></li>
                  <li><?php echo anchor('/member/ubah_profil/', '<span class="glyphicon glyphicon-wrench"></span>  Edit Profile'); ?></li>
                  <li><?php echo anchor('/auth/change_password/', '<span class="glyphicon glyphicon-lock"></span>  Change Password'); ?></li>
                </ul>
              </li>
            </ul>
          </div><!--/.nav-collapse -->
        </div> <!--/container -->
      </div> <!--/navbar -->
       <!-- Akhir Static navbar -->

      

      <!-- Awal dari content -->
      
      <?
          echo $content;
      ?>

      

      <!-- Akhir dari content -->
    </div>  <!-- Akhir dari wrap -->

    <div id="footer">
      <div class="container">
        <p class="credit">Copyright © LUMINOX 2013</p>
      </div>
    </div>




    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?php echo base_url('asset/js/jquery.js');?>"></script>
    <script src="<?php echo base_url('asset/js/bootstrap.min.js');?>"></script>
    <script>
      $('#sandbox-container .input-append.date').datepicker({
      });
    </script>    
  </body>
</html>
