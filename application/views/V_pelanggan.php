<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Pelanggan

		</h1>
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
			<div class="col-md-12">
				
				<!-- Horizontal Form -->
				<div class="box box-info">
					<div class="box-header with-border">
						<h3 class="box-title">Input Data Pelanggan</h3>
		
					</div>
					
					

					<!-- /.box-header -->
					
					<!-- form start -->

					<form class="form-horizontal" action="<?= base_url();?>Controller/simpan_pelanggan" method="post">
						<div class="box-body">

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




							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label">Nik</label>
								<div class="col-sm-10 col-md-6">
									<input type="text" name="nik" class=" form-control" id="inputEmail3"
										placeholder="Nik">

								</div>
							</div>
						</div>

						<div class="box-body">
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label">Nama</label>
								<div class="col-sm-10 col-md-6">
									<input type="text" name="nama" class=" form-control" id="inputEmail3"
										placeholder="Nama">
								</div>
							</div>
						</div>


						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label">Tgl lahir</label>
							<div class="col-sm-10 col-md-6">

								<div class="input-group date">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input type="text" name="tgl_lahir" class="form-control pull-right" id="datepicker"
										placeholder="Tgl lahir">
									<!-- <input type="text" name="tgl_lahir" class=" form-control" id="inputEmail3" placeholder="Tgl Lahir"> -->
								</div>
							</div>
						</div>


						<!-- <div class="box-body">
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label">Tgl lahir</label>
								<div class="col-sm-10 col-md-6">
									<input type="text" name="tgl_lahir" class=" form-control" id="inputEmail3" placeholder="Tgl Lahir">
								</div>
							</div>
						</div> -->

						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12">Jenis Kelamin</label>
							<div class="col-md-10 col-md-6">
								<div class="radio">
									<label>
										<input type="radio" name="jenis_kelamin" value="laki-laki">laki-laki
									</label>
								</div>
								<div class="radio">
									<label>
										<input type="radio" name="jenis_kelamin" value="perempuan">Perempuan
									</label>

								</div>
							</div>
						</div>

						<!-- select -->
						<!-- <div class="box-body">
			   <div class="form-group">
					<label>Select</label>
					<select class="form-control">
					  <option>Islam</option>
					  <option>Kristen</option>
					  <option>Khatolik</option>
					  <option>Hindu</option>
					  <option>Budha</option>
					</select>
				  </div>
				</div>
			</div> -->


						<!-- <select class="form-control" name="agama" placeholder="agama">
					  <option>Islam</option>
					  <option>Kristen</option>
					  <option>Khatolik</option>
					  <option>Hindu</option>
					  <option>Budha</option>
					</select> -->

						<div class="box-body">
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label">Agama</label>
								<div class="col-sm-10 col-md-6">
									<select name="agama" class="form-control" id="agama">
										<option value="0">--Pilih Agama--</option>
										<option>Islam</option>
										<option>Kristen</option>
										<option>Khatolik</option>
										<option>Hindu</option>
										<option>Budha</option>
									</select>



								</div>
							</div>
						</div>

						<div class="box-body">
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label">Pekerjaan</label>
								<div class="col-sm-10 col-md-6">
									<input type="text" name="pekerjaan" class=" form-control" id="inputEmail3"
										placeholder="Pekerjaan">
								</div>
							</div>
						</div>

						<div class="box-body">
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label">No Hp</label>
								<div class="col-sm-10 col-md-6">
									<input type="text" name="no_hp" class=" form-control" id="inputEmail3"
										placeholder="No Hp">
								</div>
							</div>
						<div class="form-group">
							<div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
								<button class="btn btn-primary" type="button"><i class="fa fa-times"></i>Cancel</button>
								<button type="submit" class="btn btn-success"><i class="fa fa-save"></i>Simpan</button>
								
									
							
							</div>
					</form>
				</div>
			</div>
	</section>
</div>
