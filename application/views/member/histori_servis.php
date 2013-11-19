<div class="container">



<div class="page-header">
        <h3>Histori Servis</h3>
</div>

<ol class="breadcrumb">
  <li class="active"><? echo ''.$member['no_member'].''; ?></li>
  <li class="active"><? echo ''.$member['nama'].''; ?></li>
</ol>


<table class="table table-bordered">
        <thead>
          <tr class="danger">
            <th>Seri</th>
            <th>Nama Barang</th>
            <th>Tanggal Masuk Servis</th>
            <th>Tanggal Keluar Servis</th>
            <th>Keterangan</th>
            
          </tr>
        </thead>


        <tbody>
          
          <?php foreach($historiservis as $row) : ?>
          

          <tr>

            <td><?php echo $row->seri_barang; ?></td>
            <td><?php echo $row->nm_barang; ?></td>
            <td><?php echo $row->tgl_masuk; ?></td>
            <td><?php echo $row->tgl_keluar; ?></td>
            <td><?php echo $row->keterangan; ?></td>
            
            

          </tr>

          <?php endforeach; ?>
          
        </tbody>
      </table>




<div class="col-xs-12">
  <? echo $halaman ?>
</div>

</div> <!-- container -->
