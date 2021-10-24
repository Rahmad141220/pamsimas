<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Pembayaran

		</h1>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
			<!-- < column -->
			<!-- <div class="col-md-12"> -->
			<div class="col-md-6 col-sm-12 col-xs-12">
				<!-- Horizontal Form -->
				<div class="box box-info">
					<div class="box-header with-border">
						<h3 class="box-title">Input Pemabayaran</h3>
					</div>
					<!-- /.box-header -->
					<!-- form start -->
					<?php if ($this->session->flashdata('error')):?>
					<div id="pemberitahuan_success" class="alert alert-danger alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><i class="icon fa fa-ban"></i> Maaf !</h4>
						<?php echo $this->session->flashdata('error');?>
					</div>
					<?php elseif ($this->session->flashdata('success')):?>
					<div id="pemberitahuan_error" class="alert alert-success alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><i class="icon fa fa-check"></i> Sukses !</h4>
						<?php echo $this->session->flashdata('success');?>

					</div>
					<?php elseif ($this->session->flashdata('error_sangsi')): ?>
					<div id="pemberitahuan_error_sangsi" class="alert alert-danger alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><i class="icon fa fa-ban"></i> Maaf !</h4>
						<?php echo $this->session->flashdata('error_sangsi');?>
					</div>
					<?php endif;?>

					<form class="form-horizontal" action="<?= base_url();?>Controller/bayar_tagihan" method="post">
						<div class="box-body">



							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label">Nik</label>
								<div class="col-sm-10 col-md-6">
									<input type="text" name="nik" id="nik" class=" form-control" placeholder="Nik"
										onkeyup="find_data_pembayaran()">

								</div>
							</div>
						</div>

						<div class="box-body">
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label">Nama</label>
								<div class="col-sm-10 col-md-6">
									<input readonly type="text" name="nama" id="nama" class=" form-control"
										id="inputEmail3" placeholder="Nama">
								</div>
							</div>
						</div>

						<div class="box-body">
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label">Tgl lahir</label>
								<div class="col-sm-10 col-md-6">
									<input readonly type="text" name="tgl_lahir" id="tgl_lahir" class=" form-control"
										id="inputEmail3" placeholder="Tgl Lahir">
								</div>
							</div>
						</div>



						<div class="box-body">
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label">Agama</label>
								<div class="col-sm-10 col-md-6">
									<input readonly type="text" name="agama" id="agama" class=" form-control"
										id="inputEmail3" placeholder="Agama">
								</div>
							</div>
						</div>

						<div class="box-body">
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label">Pekerjaan</label>
								<div class="col-sm-10 col-md-6">
									<input readonly type="text" name="pekerjaan" id="pekerjaan" class=" form-control"
										id="inputEmail3" placeholder="Pekerjaan">
								</div>
							</div>
						</div>
				</div>
			</div>



			<!-- menu kanan -->
			<div class="col-md-6 col-sm-12 col-xs-12">
				<!-- Horizontal Form -->
				<div class="box box-info">
					<div class="box-header with-border">
					</div>

					<div class="box-body">
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label">No Hp</label>
							<div class="col-sm-10 col-md-6">
								<input readonly type="text" name="no_hp" id="no_hp" class=" form-control"
									id="inputEmail3" placeholder="No hp">
							</div>
						</div>
					</div>

					<div class="box-body">
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label">Total Tagihan(Rp)</label>
							<div class="col-sm-10 col-md-6">
								<input type="text" name="total_tagihan" id="total_tagihan" class=" form-control"
									id="inputEmail3" readonly placeholder="Total Tagihan">
							</div>
						</div>
					</div>
					<div class="box-body">
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label">Beban(Rp)</label>
							<div class="col-sm-10 col-md-6">
								<input type="text" value="20.000" name="beban" id="total_tagihan" class=" form-control"
									id="inputEmail3" readonly placeholder="beban">
							</div>
						</div>
					</div>




					<div class="box-body">
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label">Total Bayar(Rp)</label>
							<div class="col-sm-10 col-md-6">
								<input type="text" name="total_bayar" id="total_bayar" class=" form-control"
									id="inputEmail3" placeholder="Total bayar" onkeyup="jumlahkan()">
							</div>
						</div>
					</div>

					<div class="box-body">
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label">Kembalian</label>
							<div class="col-sm-10 col-md-6">
								<input type="text" name="" id="kembalian" readonly class=" form-control"
									id="inputEmail3" placeholder="Kembalian">
							</div>
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
						<button class="btn btn-primary" type="button"><i class="fa fa-times"></i>Cancel</button>
						<button type="submit" class="btn btn-success"><i class="fa fa-save"></i>Bayar</button>
					</div>
					</form>
				</div>
			</div>
	</section>

	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Data Tabel Meteran
		</h1>
		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-xs-12">
					<div class="box">
						<div class="box-header">
							<h3 class="box-title">Data Meteran</h3>
							<div class="x_content">
								<!-- <p class="text-muted font-13 m-b-30">
									<a href="<?php echo base_url();?>controller/faktur"
										class="btn btn-warning btn-sm"><i class="fa fa-print"></i>Print</a>


								</p> -->

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
											<td><?='Rp.'.number_format ($value['total_bayar']);?></td>
											<td><?= $value['tgl_tagihan'];?></td>
											<td><?= $value['tgl_pembayaran'];?></td>

											<td>
												<?php if ($value['status']=='0'):?>
												<a href="#" class="btn btn-success btn-xs"><i class="fa fa-check"></i>
													Lunas</a>
												<?php else :?>
												<a href="#" class="btn btn-danger btn-xs"><i class="fa fa-ban"></i>
													Belum
													Lunas (<?=$value['status']?> Tagihan)</a>
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
