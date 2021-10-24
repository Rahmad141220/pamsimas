 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Tabel Pelanggan 
    
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Tables</a></li>
        <li class="active">Data tables</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Pelanggan</h3>
     <!-- button cetak -->
     <div class="x_content">
						<p class="text-muted font-13 m-b-30">
								<a href="<?php echo base_url();?>controller/cetak_laporan_pelanggan"class="btn btn-warning btn-sm"><i class="fa fa-print"></i> Cetak Data Pelanggan</a>
						</p>
       
            </div>

            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Nik</th>
                  <th>Nama Pelanggan</th>
                  <th>Tanggal Lahir</th>
                  <th>Jenis Kelamin</th>
                  <th>Agama</th>
                  <th>Pekerjaan</th>
                  <th>No Hp</th>
                  <th>Status Tagihan</th>
                  <th>Aksi</th>
                
                </tr>
                </thead>
                <tbody>
                <?php if ($status_data=='Ada'):?>
                  <?php
                  $no = 1;
                  foreach ($tb_pelanggan as $value):
                  
                  ?>
                    
                <tr>
                  <td><?= $no++?></td>
                  <td><?= $value['nik']; ?></td>
                  <td><?= $value['nama']; ?></td>
                  <td><?= $value['tgl_lahir']; ?></td>
                  <td><?= $value['jenis_kelamin']; ?></td>
                  <td><?= $value['agama']; ?></td>
                  <td><?= $value['pekerjaan']; ?></td>
                  <td><?= $value['no_hp']; ?></td>
                  <td>
                    <?php if ($value['status_tagihan']=='0'):?>
                    <a href="#" class="btn btn-success btn-xs"><i class="fa fa-check"></i> Tidak Ada Tagihan</a>
                    <?php else :?>
                    <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-ban"></i> Belum Lunas (<?=$value['status_tagihan']?> Tagihan)</a>
                  <?php endif; ?>
                </td>
                  <td>
                    
                      
												<a href="<?php echo base_url(); ?>/Controller/editpelanggan/<?php echo $value['id']; ?>"
													class="btn btn-info btn-xs"> <i class="fa fa-edit"></i> Edit</a>
												<a href="<?php echo base_url(); ?>Controller/Hapus_data/<?php echo $value['id']; ?>"
													class="btn btn-danger btn-xs"> <i class="fa fa-trash"></i> Hapus</a>
											</td>

										</tr>
										<?php endforeach; ?>
                    <?php else :?>
                    <tr>
                      <td class="text-center" colspan="10" >Tidak Ada Data Ditemukan</td>
                    </tr>
                    <?php endif; ?>
									</tbody>
                
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
      
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->