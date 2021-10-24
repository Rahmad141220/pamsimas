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
						<h3 class="box-title">Edit Data Pelanggan</h3>
					</div>
					
					<!-- /.box-header -->
					<!-- form start -->
					<form class="form-horizontal" action="<?= base_url();?>Controller/edit_simpan/<?= $id;?>" method="post">
						<div class="box-body">
							
							

						

								<div class="form-group">
									<label for="inputEmail3"  class="col-sm-2 control-label">Nik</label>
									<div class="col-sm-10 col-md-6">
                    <input type="text" name="nik" value="<?= $nik;?>" class=" form-control" id="inputEmail3" placeholder="nik">
                  
									</div>
								</div>
						</div>

						<div class="box-body">
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label">Nama</label>
								<div class="col-sm-10 col-md-6">
									<input type="text" name="nama" value="<?= $nama;?>" class=" form-control" id="inputEmail3" placeholder="nama">
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
				  <input type="text" name="tgl_lahir" value="<?= $tgl_lahir?>" class="form-control pull-right" id="datepicker" placeholder="Tgl lahir">
				  <!-- <input type="text" name="tgl_lahir" class=" form-control" id="inputEmail3" placeholder="Tgl Lahir"> -->
				 </div>
			  </div>
</div>


            <div class="form-group">
              	<label class="control-label col-md-3 col-sm-3 col-xs-12">Jenis Kelamin</label>
                <div class="col-md-10 col-md-6">
                    <div class="radio">
                        <label>
                          <input type="radio" name="jenis_kelamin" <?php if ($jenis_kelamin=='laki-laki') {
							  echo 'checked';
						  }?>  value="laki-laki" >laki-laki
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" name="jenis_kelamin" <?php if ($jenis_kelamin=='perempuan') {
							  echo 'checked';
						  }?>   value="perempuan">Perempuan
                        </label>
                      </div>
            </div>
              </div>


						<div class="box-body">
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label">Agama</label>
								<div class="col-sm-10 col-md-6">

					<select class="form-control" name="agama" value="<?= $agama?>" placeholder="agama">
					  <option>Islam</option>
					  <option>Kristen</option>
					  <option>Khatolik</option>
					  <option>Hindu</option>
					  <option>Budha</option>
					</select>

							<!-- <input type="text" name="agama" class=" form-control" id="inputEmail3" placeholder="Agama">  -->
								</div>
							</div>
						</div>

						<div class="box-body">
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label">Pekerjaan</label>
								<div class="col-sm-10 col-md-6">
									<input type="text" name="pekerjaan" value="<?= $pekerjaan;?>"" class=" form-control" id="inputEmail3" placeholder="Pekerjaan">
								</div>
							</div>
						</div>

						<div class="box-body">
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label">No Hp</label>
								<div class="col-sm-10 col-md-6">
									<input type="text" name="no_hp" value="<?= $no_hp;?>" class=" form-control" id="inputEmail3" placeholder="No Hp">
								</div>
							</div>

							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-10">	
									<div class="checkbox">

									</div>
								</div>
							</div>
						</div>
						<!-- /.box-body -->
						<div class="box-footer">
							<button type="submit"  class="btn btn-info pull-right">Simpan</button>
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
