<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Pelanggan
		</h1>
		<br>
		<div class="alert alert-info" role="alert">
								<h4 class="alert-heading"><i class="fa fa-info"></i> Pemberitahuan</h4>
								<p></p>
								<p class="mb-0">Inputkan NIK pelanggan yang sudah terdaftar, jika data sudah ada otomatis data akan
									tampil</p>
							</div>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			<li><a href="#">Forms</a></li>
			<li class="active">General Elements</li>
		</ol>
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
						<h3 class="box-title">Input Data Meteran</h3>
					</div>
					<!-- /.box-header -->
					<!-- form start -->
					<?php if ($this->session->flashdata('error')):?>
							<div id="pemberitahuan_success" class="alert alert-danger alert-dismissible">
								<button type="button" class="close" data-dismiss="alert"
									aria-hidden="true">&times;</button>
								<h4><i class="icon fa fa-ban"></i> Maaf !</h4>
								<?php echo $this->session->flashdata('error');?>
							</div>
							<?php elseif ($this->session->flashdata('success')):?>
							<div id="pemberitahuan_error" class="alert alert-success alert-dismissible">
								<button type="button" class="close" data-dismiss="alert"
									aria-hidden="true">&times;</button>
								<h4><i class="icon fa fa-check"></i> Sukses !</h4>
								  <?php echo $this->session->flashdata('success');?>

									</div>
							<?php elseif ($this->session->flashdata('error_sangsi')): ?>
							<div id="pemberitahuan_error_sangsi" class="alert alert-danger alert-dismissible">
								<button type="button" class="close" data-dismiss="alert"
									aria-hidden="true">&times;</button>
								<h4><i class="icon fa fa-ban"></i> Maaf !</h4>
								<?php echo $this->session->flashdata('error_sangsi');?>
							</div>
							<?php endif;?>			
						
					<form class="form-horizontal" action="<?= base_url();?>Controller/simpan_meteran" method="post">
						<div class="box-body">


								<div class="form-group">
									<label for="inputEmail3" class="col-sm-2 control-label">Nik</label>
									<div class="col-sm-10 col-md-6">
                    <input type="text" name="nik" id="nik" class=" form-control"  placeholder="Nik" onkeyup="find_data()" >
                  
									</div>
								</div>
						</div>

						<div class="box-body">
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label">Nama</label>
								<div class="col-sm-10 col-md-6">
									<input readonly type="text" name="nama" id="nama" class=" form-control" id="inputEmail3" placeholder="Nama">
								</div>
							</div>
						</div>

						<div class="box-body">
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label">Tgl lahir</label>
								<div class="col-sm-10 col-md-6">
									<input readonly type="text" name="tgl_lahir" id="tgl_lahir" class=" form-control" id="inputEmail3" placeholder="Tgl Lahir">
								</div>
							</div>
						</div>

            <div class="form-group">
              	<label class="control-label col-md-3 col-sm-3 col-xs-12">Jenis Kelamin</label>
                <div class="col-md-10 col-md-6">
                    <div class="radio">
                        <label>
                          <input readonly type="radio" name="jenis_kelamin" id="jenis_kelamin"  value="laki-laki" >laki-laki
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input readonly type="radio" name="jenis_kelamin" id="jenis_kelamin"  value="perempuan">Perempuan
                        </label>
						  </div>
            </div>
              </div>

			  

						<div class="box-body">
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label">Agama</label>
								<div class="col-sm-10 col-md-6">
									<input readonly type="text" name="agama" id="agama" class=" form-control" id="inputEmail3" placeholder="Agama">
								</div>
							</div>
						</div>

						<div class="box-body">
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label">Pekerjaan</label>
								<div class="col-sm-10 col-md-6">
									<input readonly type="text" name="pekerjaan" id="pekerjaan" class=" form-control" id="inputEmail3" placeholder="Pekerjaan">
								</div>
							</div>
						</div>
</div>
</div>

						<div class="col-md-6 col-sm-12 col-xs-12">
				<!-- Horizontal Form -->
				<div class="box box-info">
					<div class="box-header with-border">
					</div>


						<div class="box-body">
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label">No Hp</label>
								<div class="col-sm-10 col-md-6">
									<input readonly type="text" name="no_hp" id="no_hp" class=" form-control" id="inputEmail3" placeholder="No hp">
								</div>
							</div>
			  </div>
			  <div class="box-body">
					<div class="form-group">
						<label for="inputEmail3" name="bulan" class="col-sm-2 control-label">Bulan</label>
						<div class="col-sm-10 col-md-6">
							
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
		</div>
					</div>
					<div class="box-body">
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label">Tahun</label>
								<div class="col-sm-10 col-md-6">
										
							<select name="tahun" id="" class="form-control">
								<?php for ($i=2019; $i < 2030 ; $i++):?>
								<option value="<?php echo $i;?>"><?php echo $i;?></option>
								<?php endfor;?>
							</select>
						</div>
									<!-- <input type="text" name="meteran_awal" id="meteran_awal" class=" form-control" id="inputEmail3" placeholder="Tahun"> -->
								</div>
                </div>
						

              <div class="box-body">
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label">Meteran awal</label>
								<div class="col-sm-10 col-md-6">
									<input type="text" name="meteran_awal" id="meteran_awal" readonly class=" form-control" id="inputEmail3" placeholder="Meteran awal">
								</div>
                </div>
							</div>
              
              <div class="box-body">
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label">Meteran_akhir</label>
								<div class="col-sm-10 col-md-6">
									<input type="text" name="meteran_akhir" onkeyup="hitung();" id="meteran_akhir" class=" form-control" id="inputEmail3" placeholder="Meteran akhir">
								</div>
							</div>
              </div>

              <div class="box-body">
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label">Total Bayar(Rp)</label>
								<div class="col-sm-10 col-md-6">
									<input type="text" name="total_bayar" readonly id="total_bayar" class=" form-control" id="inputEmail3" placeholder="Total bayar">
								</div>
							</div>
						<div class="form-group">
								<div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
									<button class="btn btn-primary" type="button"><i
											class="fa fa-times"></i>Cancel</button>
									<button type="submit" class="btn btn-success"><i
											class="fa fa-save"></i>Simpan</button>
							</div>


						<!-- /.box-footer -->
					</form>
				</div>
				<!-- /.box -->
				<!-- general form elements disabled -->

				<!--/.col (right) -->
			</div>
			<!-- /.row -->
	</section>
	<!-- /.content -->
</div>
