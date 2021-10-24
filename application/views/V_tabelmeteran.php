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

 	<!-- Main content -->
 	<section class="content">
 		<div class="row">
 			<div class="col-xs-12">
 				<div class="box">
 					<div class="box-header">
 						<h3 class="box-title">Data Meteran</h3>
 						<div class="x_content">
 							<p class="text-muted font-13 m-b-30">
 								<a href="#" data-toggle="modal" data-target="#modal_per_tahun"
 									class="btn btn-warning btn-sm"><i class="fa fa-print"></i> Cetak Data Meteran
 									Pertahun</a>
 								<a href="#" data-toggle="modal" data-target="#modal_per_bulan"
 									class="btn btn-warning btn-sm"><i class="fa fa-print"></i> Cetak Data Meteran
 									Perbulan</a>
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
                  $no = 1;
                  foreach ($tb_meteran as $value):
                  
                  ?>
 									<tr>
 										<td><?= $no++?></td>
 										<td><?= $value['nik']; ?></td>
 										<td><?= $value['nama']; ?></td>
 										<td><?= $value['meteran_awal'];?></td>
										 <td><?= $value['meteran_akhir'];?></td>
										 <td><?= 'Rp.' . ($value['total_bayar']);?></td>
 										<td><?= $value['tgl_tagihan'];?></td>
 										<td><?= $value['tgl_pembayaran'];?></td>
 										


 										<td>
 											<?php if ($value['status']=='Sudah'):?>
 											<a href="#" class="btn btn-success btn-xs"><i class="fa fa-check"></i>Tidak
 												ada tagihan</a>
 											<?php else :?>
 											<a href="#" class="btn btn-danger btn-xs"><i class="fa fa-ban"></i> Belum
 												Lunas</a>
 											<?php endif; ?>
 										</td>
 										<td>
 											<a href="<?php echo base_url(); ?>/Controller/editmeteran/<?php echo $value['id']; ?>"
 												class="btn btn-info btn-xs"> <i class="fa fa-edit"></i> Edit</a>

 											<a href="<?php echo base_url(); ?>Controller/hapus_meteran/<?php echo $value['id']; ?>"
 												class="btn btn-danger btn-xs"> <i class="fa fa-trash"></i> Hapus</a>
 										</td>
 									</tr>
 									<?php endforeach; ?>
 									<tfoot>
									 <th> </th>
 										<th> </th>
 										<th> </th>
 										<th> </th>
 										<th>Total :</th>
										 <th><?= 'Rp.' . ($total);?></th>
 										<th>Terbilang :</th>
 									<th colspan="3" ><?=$terbilang?></th>
										 
									 </tfoot>
 							</tbody>

 							</tfoot>
 							</table>
 					</div>
 					</table>
 				</div>
 			</div>
 		</div>
 </div>
 </section>
 </div>



 <!-- Modal pilih laporan per hari -->
 <div class="modal fade" id="modal_per_bulan" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
 	aria-hidden="true">
 	<div class="modal-dialog" role="document">
 		<div class="modal-content">
 			<div class="modal-header">
 				<h5 class="modal-title">Cetak Laporan</h5>
 				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
 					<span aria-hidden="true">&times;</span>
 				</button>
 			</div>
 			<div class="modal-body">
 				<form class="horizontal-form" action="<?php echo base_url();?>controller/cari_laporan_bulanan"
 					method="post">
 					<div class="form-group">
 						<div id="" class="alert alert-warning alert-dismissible">
 							<button type="button" class="close" data-dismiss="alert"
 								aria-hidden="true">&times;</button>
 							<h4><i class="icon fa fa-info"></i> Pemberitahuan !</h4>
 							Pilih Bulan dan tahun laporan !!
 						</div>
 						<div class="col-md-4 col-sm-3 col-xs-12">

 							<label for="">Pilih Bulan dan tahun</label>
 						</div>

 						<div class="col-md-4 col-sm-9 col-xs-12">
 							<select name="bulan" id="" class="form-control">
 								<option value="01">Januari</option>
 								<option value="02">Februari</option>
 								<option value="03">Maret</option>
 								<option value="04">April</option>
 								<option value="05">Mei</option>
 								<option value="06">Juni</option>
 								<option value="07">Juli</option>
 								<option value="08">Agustus</option>
 								<option value="09">September</option>
 								<option value="10">Oktober</option>
 								<option value="11">November</option>
 								<option value="12">Desember</option>
 							</select>
 						</div>
 						<div class="col-md-4 col-sm-9 col-xs-12">
 							<select name="tahun" id="" class="form-control">
 								<?php for ($i=2005; $i < 2030 ; $i++):?>
 								<option value="<?php echo $i;?>"><?php echo $i;?></option>
 								<?php endfor;?>
 							</select>
 						</div>
 						<small id="helpId" class="text-muted"></small>
 					</div>
 			</div>
 			<div class="modal-footer">
 				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
 				<button type="submit" class="btn btn-primary"><i class="fa fa-print"></i> Cetak</button>
 			</div>
 			</form>
 		</div>
 	</div>
 </div>
 <!-- Modal laporan per hari-->
 <div class="modal fade" id="modal_per_hari" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
 	aria-hidden="true">
 	<div class="modal-dialog" role="document">
 		<div class="modal-content">
 			<div class="modal-header">
 				<h5 class="modal-title">Cetak Laporan</h5>
 				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
 					<span aria-hidden="true">&times;</span>
 				</button>
 			</div>
 			<div class="modal-body">
 				<form class="horizontal-form" action="<?php echo base_url();?>controller/cari_laporan_harian"
 					method="post">
 					<div class="form-group">
 						<div id="" class="alert alert-warning alert-dismissible">
 							<button type="button" class="close" data-dismiss="alert"
 								aria-hidden="true">&times;</button>
 							<h4><i class="icon fa fa-info"></i> Pemberitahuan !</h4>
 							Pilih tanggal laporan !!
 						</div>
 						<div class="col-md-4 col-sm-3 col-xs-12">

 							<label for="">Pilih Tanggal</label>
 						</div>

 						<div class="col-md-4 col-sm-9 col-xs-12">
 							<div class="input-group date" id="myDatepicker2">
 								<input type="text" name="tanggal" id="tanggal" class="form-control">
 								<span class="input-group-addon">
 									<span class="glyphicon glyphicon-calendar"></span>
 								</span>
 							</div>
 						</div>
 						<small id="helpId" class="text-muted"></small>
 					</div>
 			</div>
 			<div class="modal-footer">
 				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
 				<button type="submit" class="btn btn-primary"><i class="fa fa-print"></i> Cetak</button>
 			</div>
 			</form>
 		</div>
 	</div>
 </div>

 <!-- Modal laporan per tahun-->
 <div class="modal fade" id="modal_per_tahun" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
 	aria-hidden="true">
 	<div class="modal-dialog" role="document">
 		<div class="modal-content">
 			<div class="modal-header">
 				<h5 class="modal-title">Cetak Laporan</h5>
 				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
 					<span aria-hidden="true">&times;</span>
 				</button>
 			</div>
 			<div class="modal-body">
 				<form class="horizontal-form" action="<?php echo base_url();?>controller/cari_laporan_tahunan"
 					method="post">
 					<div class="form-group">
 						<div id="" class="alert alert-warning alert-dismissible">
 							<button type="button" class="close" data-dismiss="alert"
 								aria-hidden="true">&times;</button>
 							<h4><i class="icon fa fa-info"></i> Pemberitahuan !</h4>
 							Pilih Tahun laporan !!
 						</div>
 						<div class="col-md-4 col-sm-3 col-xs-12">

 							<label for="">Pilih Tahun</label>
 						</div>
 						<div class="col-md-4 col-sm-9 col-xs-12">
 							<select name="tahun" id="" class="form-control">
 								<?php for ($i=2005; $i < 2030 ; $i++):?>
 								<option value="<?php echo $i;?>"><?php echo $i;?></option>
 								<?php endfor;?>
 							</select>
 						</div>
 						<small id="helpId" class="text-muted"></small>
 					</div>
 			</div>
 			<div class="modal-footer">
 				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
 				<button type="submit" class="btn btn-primary">Cetak</button>
 			</div>
 			</form>
 		</div>
 	</div>
 </div>
