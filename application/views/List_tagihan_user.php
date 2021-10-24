<div class="content-wrapper">
	<section class="content-header">
		<h1>Status Pembayaran</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			<li><a href="#">Tables</a></li>
			<li class="active">Data tables</li>
		</ol>
	</section>

	<!-- main content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">Data Meteran</h3>
						<div class="x_content">

						</div>
						<!-- /.box-header -->
						<div class="box-body">
							<table id="example2" class="table table-bordered table-hover">
								<thead>
									<tr>
										<th>No</th>
										<th>Id Bayar</th>
										<th>Nama</th>
										<th>Id Tagihan</th>
										<th>Tanggal Bayar</th>
										<th>Status </th>
										<th>Bukti Bayar</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php
                                      $no = 1;
                                      foreach ($tb_bayar as $value):
                                      ?>
									<tr>
										<td><?= $no++?></td>
										<td><?= $value['id_bayar']; ?></td>
										<td><?= $value['nama'];?></td>
										<td><?= $value['id_tagihan'];?></td>
										<td><?= $value['tgl_bayar']; ?></td>
										<td><?= $value['status'];?></td>
										<td>
											<style>
												.gambar {
													width: 100px;
													height: 80px;
													border-radius: 70%;
												}
											</style>
											<img id="output" class="gambar" name="bukti_bayar"src="<?=base_url();?><?= $value['bukti_bayar'];?>"												alt="">
										</td>

										<td>
											<?php if ($value['status']=='Diterima'):?>

											<a href="#" class="btn btn-info btn-xs"> <i class="fa fa-check"></i>
												Diterima</a>
											<?php elseif ($value['status']=='Ditolak'):?>

											<a href="#" class="btn btn-danger btn-xs"> <i class="fa fa-close"></i>
												Ditolak</a>
											<?php else: ?>


											<a href="<?php echo base_url(); ?>Controller/konfirmasi_pembayaran/<?php echo $value['id_bayar']; ?>/Terima"
												class="btn btn-info btn-xs"> <i class="fa fa-check"></i> Konfirmasi</a>
											<br>

											<a href="<?php echo base_url(); ?>Controller/konfirmasi_pembayaran/<?php echo $value['id_bayar'];?>/Tolak"
												class="btn btn-danger btn-xs"> <i class="fa fa-close"></i> Tolak</a>
											<?php endif;?>
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
