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
					<h4><span>Detail Barang</span></h4>
				</div>
				
				<div class="content clearfix">
					<form role="form" method="POST" id="post-trans" class="form-horizontal">
						<div class="form-group">
							<label class="col-xs-2 a_right">Kode Barang : </label>
							<label class="col-xs-10"><?=$data->kd_barang?></label>
						</div>
						
						<div class="form-group">
							<label class="col-xs-2 a_right">Seri : </label>
							<label class="col-xs-10"><?=$data->seri_barang?></label>
						</div>
						
						<div class="form-group">
							<label class="col-xs-2 a_right">Nama Barang : </label>
							<label class="col-xs-10"><?=$data->nm_barang?></label>
						</div>
						
						<div class="form-group">
							<label class="col-xs-2 a_right">Harga : </label>
							<label class="col-xs-10"><?='Rp '.number_format($data->harga, 2, ',' , '.')?></label>
						</div>

						<div class="form-group">
							<label class="col-xs-2 a_right">Jumlah :</label>
							<div class="col-xs-10">
								<input class="col-xs-2" id="jml" type="number" name="jml" required max="<?=$data->stok?>" value="1" max="<?=$data->stok?>" > &nbsp; * Jumlah barang yang ada : <?=$data->stok?>
								<input type="hidden" name="max" value="<?=$data->stok?>"  >
								<input type="hidden" name="kd_barang" value="<?=$data->kd_barang;?>"  >
								<input type="hidden" id="harga" name="harga" value="<?=$data->harga;?>"  >
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-xs-2 a_right">Total : </label>
							<label class="col-xs-10" id="total"><?='Rp '.number_format($data->harga, 2, ',' , '.')?></label>
						</div>
						
						<button type="submit" class="btn btn-success">Ok</button> &nbsp; 
						<button batal class="btn btn-danger">Batal</button>
						
						


					</form>
					
				</div>

			</div><!-- End .box -->
		</div>	
	</div>
	
	<script>

	$('#jml').keyup(function(){
		var val = $(this).val();
		$('#total').html('Rp '+ (val*$('#harga').val()).formatMoney(2, ',', '.'));
	})	
	
	$('#post-trans').submit(function(){
		var jml = parseFloat($('input[name="jml"]').val());
		var max = parseFloat($('input[name="max"]').val());
		if (jml <= 0) {
			alert('Jumlah tidak boleh kurang dari 0');
			return false;
		}
		
		parent.addBarang('<?=$data->kd_barang;?>', '<?=$data->seri_barang;?>', '<?=$data->nm_barang;?>',  <?=$data->harga;?>, jml, true)
		return false;
	})
	
	$('[batal]').click(function(){
		parent.closeWindow();
	})
	
	Number.prototype.formatMoney = function(c, d, t){
		var n = this, 
			c = isNaN(c = Math.abs(c)) ? 2 : c, 
			d = d == undefined ? "." : d, 
			t = t == undefined ? "," : t, 
			s = n < 0 ? "-" : "", 
			i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", 
			j = (j = i.length) > 3 ? j % 3 : 0;
		   return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
	};
		
	
	</script>
</body>
</html>