<div class="container well">


<link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/css/jquery-ui-1.9.2.custom.min.css');?>">
<script src="<?php echo base_url('asset/js/jquery-ui-1.9.2.custom.min.js')?>"></script>	
<form method="POST">

  <div class="row">
	<div class="col-xs-6 clearfix">

	  <div class="form-group">
		<label for="inputEmail1" class="control-label">No Invoice</label>
		<input name="nama" type="text" class="form-control" id="inputEmail1" value="<?php echo $data->header->kd_transaksi;?>" disabled>
	  </div>
	  
	  <div class="form-group">
		<label for="inputEmail1" class="control-label">No Member</label>
		<input name="nama" type="text" class="form-control" id="inputEmail1" value="<?php echo $data->member->no_member;?>" disabled>
	  </div>

	  <div class="form-group">
		<label for="inputEmail1" class="control-label">Nama Lengkap</label>
		<input name="nama" type="text" class="form-control" id="inputEmail1" value="<?php echo $data->member->nama;?>" disabled>
	  </div>
	</div>
	
	<div class="col-xs-6 clearfix">

	  <div class="form-group">
		<label for="inputEmail1" class="control-label">Lokasi</label>
		<input name="lokasi" type="text" class="form-control" value="<?php echo $data->header->lokasi_pembelian;?>" disabled>
	  </div>

	  <div class="form-group">
		<label for="inputEmail1" class="control-label">Tanggal</label>
		<br><b><?php echo date('d M Y', strtotime($data->header->tanggal_pengeluaran));?></b>
	  </div>
	</div>
  </div>
  
  <div class="row">
	<div class="col-xs-12">
		
		<br><br>
		<table width="100%" class="table table-striped table-bordered table-hover" id="detail">
			<thead>
				<tr>
					<th width="5%">No</th>
					<th width="15%">Kode</th>
					<th>Nama</th>
					<th width="20%">Qty @ Harga</th>
					<th width="15%">Total</th>
				</tr>
			</thead>
			<tbody>
			<?php 
				$i=0; 
				$total=0;  
				if(is_array($data->detail)) foreach ($data->detail as $val){  
					$total += $val->harga * $val->qty;
			?>
			<tr>
				<td align="center"><?=++$i;?>.</td>
				<td><?=$val->kd_barang;?></td>
				<td><?=$val->nm_barang;?></td>
				<td><?=$val->qty.' @ Rp '.number_format($val->harga, 2, ',' , '.');?></td>
				<td align="right">Rp <?=number_format(($val->qty * $val->harga), 2, ',' , '.');?></td>
			</tr>
			<?php } ?>			
			</tbody>
			<tfoot>
				<td colspan="4" align="right"> Total </td>
				<td  align="right" id="totcont">Rp <?=number_format($total, 2, ',' , '.');?></td>
			</tfoot>
		</table>
		
		<br>
	</div>
  </div>

</form>  
</div>
