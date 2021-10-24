 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
 	<!-- Content Header (Page header) -->
 	<section class="content-header">
 		<h1>
 			Data Tabel Meteran
 		</h1>

 		<ol class="breadcrumb">
 			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
 			<li><a href="#">Tables</a></li>
 			<li class="active">Data tables</li>
 		</ol>
 	</section>
 	<section class="content">
 		<div class="row">
 			<div class="col-md-12 ">
 				<div class="box box-info">
 					<div class="box-header with-border">
 						<!-- <h3 class="box-title">Table</h3> -->
 					</div>
 					<div class="box-body">
 						<div class="alert alert-warning alert-dismissible">
 							<button type="button" class="close" data-dismiss="alert"
 								aria-hidden="true">&times;</button>
 							<h4><i class="icon fa fa-warning"></i> Peringatan</h4>
 							<ul>
 								<li>Untuk Tujuan Rekening Transfer Klik Lihat Rekening Transfer</li>
 								<li>Untuk Pembayaran Trasfer Silahkan klik Bayar untuk Upload Bukti Bayar, Tunggu
 									Konfirmasi dari Admin</li>

 							</ul>
 						</div>
 						<!-- Main content -->
 						<section class="content">
 							<div class="row">
 								<div class="col-xs-12">
 									<div class="box">
 										<div class="box-header">
 											<h3 class="box-title">Data Meteran</h3>
 											<div class="row">

 												<div class="box-body">
 													<button type="button" class="btn btn-primary fa fa-eye"
 														data-toggle="modal" data-target="#modal-white">
 														Lihat Rekening Transfer
 													</button>
 												</div>
 											</div>
 										</div>
 									</div>
 									<div class="modal modal-white fade" id="modal-white">
 										<div class="modal-dialog">
 											<div class="modal-content">
 												<div class="modal-header">
 													<button type="button" class="close" data-dismiss="modal"
 														aria-label="Close">
 														<span aria-hidden="true">&times;</span></button>
 													<h3 class="modal-title">
 														<center>Transfer Lewat Rekening dibawah
 													</h3>
 													</center>
 												</div>

 												<div class="modal-body">
 													<tr>

 														<p class="mb-0">Rek Bri : 001-0029-2009302-839283</p><br>
 														<p class="mb-0">Rek Bni : 0039-902-902</p><br>
 														<p class="mb-0">Rek Mandiri : 498-43-344444-5</p><br>
 														<p class="mb-0">Rek Nagari : 3774-44-55432-6454-3</p>
 													</tr>

 												</div>

 												<div class="modal-footer">
 													<button type="button" class="btn btn-primary"
 														data-dismiss="modal">Close</button>

 												</div>

 											</div>

 										</div>

 									</div>

 									<!-- </section> -->

 									<div class="x_content">
 									</div>

 									<!-- /.box-header -->
 									<div class="box-body">
 										<table id="example2" class="table table-bordered table-hover">
 											<thead>
 												<tr>
 													<th>No</th>
 													<th>Meteran Awal</th>
 													<th>Meteran Akhir</th>
 													<th>Total Bayar</th>
 													<th>Bulan Tagihan</th>
 													<th>Tanggal pembayaran</th>
 													<th>Status Tagihan</th>
 													<th>Aksi</th>

 												</tr>
 											</thead>
 											<tbody>
 												<?php 
										 if ($status=='0') 
										 :?>
 												<tr>
 													<td colspan="20">tidak ada data</td>
 												</tr>
 												<?php elseif ($status=='1')
										  :?> <?php
										  $no = 1;
										  foreach ($tagihan as $value):
										  
										  ?>

 												<tr>
 													<td><?= $no++?></td>
 													<td><?= $value['meteran_awal'];?></td>
 													<td><?= $value['meteran_akhir'];?></td>
 													<td><?= 'Rp.' .number_format ($value['total_bayar']);?></td>
 													<td><?= $value['tgl_tagihan'];?></td>
 													<td><?= $value['tgl_pembayaran'];?></td>
 													<td><?php if ($value['status']=='Sudah'):?>
 														<a href="#" class="btn btn-success btn-xs"><i
 																class="fa fa-check"></i>Tidak ada tagihan</a>
 														<?php else :?>
 														<a href="#" class="btn btn-danger btn-xs"><i
 																class="fa fa-ban"></i>Belum Lunas</a>
 														<?php endif; ?>
 													</td>
 													<td>
 														<?php if ($value['status']=='Belum'):?>
 														<button type="button"
 															class="btn btn-primary btn-xs bayar-tagihan"
 															data="<?=$value['id'];?>"><i
 																class="fa  fa-hourglass-2"></i>Bayar</a>
 														</button>
 														<?php endif; ?>
 													</td>
 												</tr>
 												<?php endforeach; ?>

 												<?php endif ; ?>


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
 <!-- modal untuk upload -->

 <!-- modal -->
 <div class="modal fade" id="modal_bayar">
 	<div class="modal-dialog">
 		<div class="modal-content">
 			<div class="modal-header">
 				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
 					<span aria-hidden="true">&times;</span></button>

 				<h4 class="modal-title">Upload Bukti Bayar</h4>
 			</div>
 			<form class="form-horizontal" enctype="multipart/form-data"
 				action="<?php echo base_url();?>c_user/upload_bukti_bayar" method="post">
 				<div class="alert alert-warning" role="alert">
 					<h4 class="alert-heading"><i class="fa fa-info"></i>
 						Pemberitahuan</h4>
 					<p></p>
 					<p class="mb-0">Upload Bukti Bayar, Setelah Berhasil Upload Tunggu Konfirmasi
 						dari Admin, Terimakasih
 					</p>
 				</div>
 				<input type="hidden" name="id" id="id_data" value="">
 				<div class="modal-body">
 					<input type="file" onchange="loadFile(event)" name="bukti bayar" class="form-control">
 				</div>
 				<div class="modal-footer">
 					<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
 					<button type="submit" class="btn btn-primary">Upload
 					</button>
 				</div>
 			</form>
 		</div>
 	</div>
 </div>
