<div class="container well">


<link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/css/jquery-ui-1.9.2.custom.min.css');?>">
<script src="<?php echo base_url('asset/js/jquery-ui-1.9.2.custom.min.js')?>"></script>	
<form method="POST">

  <div class="row">
	<div class="col-xs-6 clearfix">

	  <div class="form-group">
		<label for="inputEmail1" class="control-label">No Member</label>
		<input name="nama" type="text" class="form-control" id="inputEmail1" value="<?php echo $member1[0]['no_member'];?>" disabled>
		<input name="no_member" type="hidden" value="<?php echo $member1[0]['no_member'];?>">
		<input name="kd_pelanggan" type="hidden" value="<?php echo $member1[0]['id'];?>">
	  </div>

	  <div class="form-group">
		<label for="inputEmail1" class="control-label">Nama Lengkap</label>
		<input name="nama" type="text" class="form-control" id="inputEmail1" value="<?php echo $member1[0]['nama'];?>" disabled>
	  </div>
	</div>
	
	<div class="col-xs-6 clearfix">

	  <div class="form-group">
		<label for="inputEmail1" class="control-label">Lokasi</label>
		<input name="lokasi" type="text" class="form-control" value="">
	  </div>

	  <div class="form-group">
		<label for="inputEmail1" class="control-label">Tanggal</label>
		<br><b><?php echo date('d M Y');?></b>
	  </div>
	</div>
  </div>
  
  <div class="row">
	<div class="col-xs-12">
		
		<br>
		<button href="<?php echo base_url('admin/popup_barang'); ?>" id="add-brg" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> &nbsp; Tambah Barang</button>
		<br><br>
		<table width="100%" class="table table-striped table-bordered table-hover" id="detail">
			<thead>
				<tr>
					<th>No</th>
					<th>Kode</th>
					<th>Nama</th>
					<th>Qty @ Harga</th>
					<th>Total</th>
					<th>Batal</th>
				</tr>
			</thead>
			<tbody>
			
			</tbody>
			<tfoot>
				<td colspan="4" align="right"> Total </td>
				<td  align="right" id="totcont"></td>
				<td></td>
			</tfoot>
		</table>
		
		<br>
		<button type="submit" name="submit" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span> &nbsp; Simpan</button> &nbsp;&nbsp;
		<button type="reset" class="btn btn-danger"><span class="glyphicon glyphicon-ban-circle"></span> &nbsp; Batal</button>
	</div>
  </div>

</form>  
</div>

<link rel='stylesheet' type='text/css' href='<?=base_url('asset/css/jquery.window.css') ?>'>
<script src="<?=base_url('asset/js/jquery.window.js') ?>"></script>
<script>
	var mywindow;
	var myi = 0;
	
	$.window.prepare({
	   dock: 'bottom',       // change the dock direction: 'left', 'right', 'top', 'bottom'
	   animationSpeed: 200,  // set animation speed
	});
	
	newWindow = function(url, title, h, w) {
		if (!h) h = 500;
		if (!w) w = 850;
		
		mywindow = $.window({
			title: title,
			url: url,
			width: w,
			height: h,
		});
	};		
	
	closeWindow = function(){
		mywindow.close();
	}
	
	addBarang = function(kode, seri, nama, harga, jml, popup ){
		//check if existing kode
		if ($('#detail tbody tr[kode="'+kode+'"]').length){
			var con = $('#detail tbody tr[kode="'+kode+'"]'),
				tjml = parseFloat(con.find('jml').html()) + jml,
				tot = tjml * parseFloat(con.find('.myharga').val());
			
			con.find('jml').html(tjml);
			con.find('.myjml').val(tjml);
			con.find('total').html(tot.formatMoney(2, ',', '.'));
		} else {
	
			myi++;
			var str = '';
			str += '<tr id="z'+myi+'" kode="'+kode+'">';
			str += '	<td align="center">'+myi+'.<input type="hidden" name="d['+myi+'][kd_barang]" value="'+kode+'"></td>';
			str += '	<td>'+kode+'</td>';
			str += '	<td>'+nama+'</td>';
			str += '	<td><jml>'+jml+'</jml> @ Rp '+harga.formatMoney(2, ',', '.')+'<input type="hidden" class="myjml" name="d['+myi+'][qty]" value="'+jml+'"></td>';
			str += '	<td align="right">Rp <total>'+(jml*harga).formatMoney(2, ',', '.')+'</total><input type="hidden" class="myharga" name="d['+myi+'][harga]" value="'+harga+'"></td>';
			str += '	<td align="center"><a href="#" onclick="hapus('+myi+')"><span class="glyphicon glyphicon-trash"></span></a></td>';
			str += '</tr>';
			$('#detail tbody').append(str);
		}
		
		hitung();
		if (popup) closeWindow();

	}
	
	$('#add-brg').click(function(){
 		window.eventReturnValue = false;
		newWindow($(this).attr('href'),  $(this).attr('title'),  $(this).attr('h'),  $(this).attr('w'));
		return false;
	})
	
	function hapus(id){
		$('#detail tbody tr#z'+id).slideUp(function(){
			$('#detail tbody tr#z'+id).remove();
			hitung();
		});
	}
	
	function hitung(){
		var total = 0;
		$('#detail tbody tr').each(function(){
			total += parseFloat($(this).find('.myharga').val()) * parseFloat($(this).find('.myjml').val()) ;
		})
		$('#totcont').html('Rp '+total.formatMoney(2, ',', '.'));
	}
	
	
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
