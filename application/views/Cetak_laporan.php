<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<!-- Meta, title, CSS, favicons, etc. -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Capil Kabupaten Tanah Datar</title>
	<!-- favicon -->
	<link rel="shortcut icon" href="<?php echo base_url();?>gambar/gambar_web/logo-atas.png" type="image/x-icon">
	<!-- Bootstrap -->
	<link href="<?php echo base_url();?>asset/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	<!-- Font Awesome -->
	<link href="<?php echo base_url();?>asset/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<!-- NProgress -->
	<link href="<?php echo base_url();?>asset/nprogress/nprogress.css" rel="stylesheet">
	<!-- Custom Theme Style -->
	<link href="<?php echo base_url();?>asset/build/css/custom.min.css" rel="stylesheet">

</head>

<body onload="window.print()" class="">
	<div class="container body">
		<div class="">
			<style>
				.logo_kop_surat {
					height: 120px;
					width: 100px;
				}

			</style>
			<!-- page content -->
			<div class="right_col" role="main">
				<div class="">
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="x_panel">
								<div class="col-md-2">
									<img class="logo_kop_surat"
										src="<?php echo base_url();?>gambar/gambar_web/Lambang_Kabupaten_Tanah_Datar.png"
										alt="">
								</div>
								<div class="col-md-10 text-center">
									<center>
										<h1> PEMERINTAH KABUPATEN TANAH DATAR </br></h1>
										<h2></h2> DINAS KEPENDUDUKAN DAN PECATATAN SIPIL</br></h2>
										Jalan Soekarno Hatta No. 30 A Batusangkar , telp(0752)574430</br>
										BATUSANGKAR 27211</br>
										<hr size="blue_line ">
										<h2 class="">Daftar Laporan Pelayanan</small></h2>
									</center>

								</div>
								<div class="">


								</div>
								</br>

								<div class="x_content">
									<h2>Pada : <?php echo $waktu_laporan;?></h2>
									<table id="datatable-responsive"
										class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
										width="100%">
										<thead>
											<tr>
												<th>No</th>
												<th>Nik</th>
												<th>Nama</th>
												<th>Tgl_lahir </th>
												<th>Jenis_kelamin</th>
												<th>Agama</th>
                                                <th>Pekerjaan</th>
                                                <th>No hp</th>
												<th>Satus</th>
											</tr>
										</thead>
										<tbody>
											<?php
                                    $no=1;
                                     foreach ($tb_pelanggan as $value):?>
											<?php if ($value['']=='Tidak ada'):?>
											<td colspan="7">Tidak Ada data yang di temukan</td>
											<?php else :?>
											<tr>
												<td><?php echo $no++; ?></td>
												<td><?php echo $value['nik']  ?></td>
												<td><?php echo $value['nama']?></td>
                                                <td><?php echo $value['tgl_lahir']  ?></td>

												<td><?php echo $value['jenis_kelamin']  ?></td>

												<td><?php echo $value['agama']  ?></td>
                                                <td><?php echo $value['pekerjaan']  ?></td>
                                                <td><?php echo $value['no_hp']  ?></td>



												<td><?php if ($value['tb_pelanggan']=='C'):?>
													<span class="label label-warning"><i class="fa fa-print"></i> Cetak
														KTP</span>
													<?php else :?>
													<span class="label label-primary"><i class="fa fa-refresh"></i>
														Penggantioan
														data</span>
													<?php endif;?>
													<?php if ($value['status']=='lunas'):?>
													<span class="label label-danger"><i
															class="fa fa-refresh"></i>Proses</span>
													<?php elseif ($value['status']=='tidak ada tagihan'):?>
													<span class="label label-info"><i class="fa fa-spinner"></i>
														Menunggu di
														ambil</span>
													<?php else : ?>
													<span class="label label-success"><i
															class="fa fa-check"></i>Selesai</span>
													<?php endif;?>
												</td>
											</tr>
											<?php endif;?>
											<?php endforeach; ?>
										</tbody>
										</tbody>
									</table>

								</div>
								<div class="pull-right">
										Batusangkar, <?php echo $tanggal;?></br>
										Kapala Dinas Kependudukan dan <br>
										Pencatatan Sipil Kabupaten Tanah Datar
										<br>
										<br>
										<br>
										<br>
										<br>
										Ir. ELIZABETH, MT <br>
										NIP. 196308111989032001
									</div>
							</div>
							
						</div>
					</div>
				</div>
			</div>
			<!-- /page content -->
			<!-- footer content -->
			<footer>
				<div class="pull-right">
					Capil Kabupaten Tanah Datar
				</div>
				<div class="clearfix"></div>
			</footer>
			<!-- /footer content -->
		</div>
	</div>

	<!-- jQuery -->
	<script src="<?php echo base_url();?>asset/jquery/dist/jquery.min.js"></script>
	<!-- Bootstrap -->
	<script src="<?php echo base_url();?>asset/bootstrap/dist/js/bootstrap.min.js"></script>
	<!-- FastClick -->
	<script src="<?php echo base_url();?>asset/fastclick/lib/fastclick.js"></script>
	<!-- NProgress -->
	<script src="<?php echo base_url();?>asset/nprogress/nprogress.js"></script>
	<!-- iCheck -->
	<script src="<?php echo base_url();?>asset/iCheck/icheck.min.js"></script>
	<!-- Datatables -->
	<script src="<?php echo base_url();?>asset/build/js/custom.min.js"></script>
</body>

</html>
