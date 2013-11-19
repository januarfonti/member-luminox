<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="<?php echo base_url('asset/favicon.png');?>">

    <title>Popup</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/css/bootstrap.min.css');?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/css/jquery.dataTables.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/css/popup.css');?>">
    <script src="<?php echo base_url('asset/js/jquery-1.8.1.js')?>"></script>	

</head>
<body>
	
	
		<div class="header">
			<h3>Pilih Barang</h3>
		</div>
			
		<div id="content" class="clearfix">
			
			<div class="box gradient">

				<div class="title"> 
					<h4><span>Daftar Barang</span></h4>
				</div>
				
				<div class="content  clearfix">
					<table cellpadding="0" cellspacing="0" border="0" class="responsive dynamicTable display table table-bordered" width="100%" id="dataTable">
						<thead>
							<tr>
								<th width="8%">Kode</th>
								<th>Seri</th>
								<th>Nama</th>
								<th width="8%">Stok</th>
								<th width="20%">Harga</th>								
								<th width="5%">Opsi</th>
							</tr>
						</thead>
					   <tbody></tbody>
					</table>
				</div>

			</div><!-- End .box -->
		</div>	
	</div>
	
	<script src="<?php echo base_url('asset/js/jquery.dataTables.min.js')?>"></script>
	<script>
	$(document).ready(function() {
	
		$('#dataTable').dataTable( {
			"bProcessing": true,
			"bServerSide": true,
			"bPaginate":true,
			"sPaginationType": "full_numbers",
			"iDisplayLength": 50,
			"sAjaxSource": "<?=base_url('admin/popup_barang'); ?>",	 
			"aoColumns": [
				null, 
				null, 
				null, 
				{ "sClass": "a_center"}, 
				{ "sClass": "a_right"}, 
				{"bSortable":false, "sClass": "a_center"}
			],
			 
			/*"fnServerData": function ( sSource, aoData, fnCallback ) {
				aoData.push( { "name" : "comp", "value" : "<?=$_GET['comp']?>" } );
				aoData.push( { "name" : "camp", "value" : "<?=$_GET['camp']?>" } );
				aoData.push( { "name" : "prst", "value" : "<?=$_GET['prst']?>" } );
				
				
				$.getJSON( sSource, aoData, function (json) { 
					fnCallback(json)
				} );
			}*/
		} );
	} );
	</script>
</body>
</html>