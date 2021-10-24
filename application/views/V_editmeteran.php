<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Meteran

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
						<h3 class="box-title">Edit Data Meteran</h3>
					</div>
					<!-- /.box-header -->
					<!-- form start -->
					<form class="form-horizontal" action="<?= base_url();?>Controller/edit_simpan_meteran/<?= $id;?>" method="post">
						<div class="box-body">

						

								<div class="form-group">
									<label for="inputEmail3"  class="col-sm-2 control-label">Nik</label>
									<div class="col-sm-10 col-md-6">
                    <input readonly type="text" name="nik" value="<?= $nik;?>" class=" form-control" id="inputEmail3" placeholder="nik">
                  
									</div>
								</div>
						</div>

						 
					
                            <div class="box-body">
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label">Meteran awal</label>
								<div class="col-sm-10 col-md-6">
									<input readonly type="text" name="meteran_awal" value="<?= $meteran_awal;?>"" class=" form-control" id="inputEmail3" placeholder="Meteran awal">
								</div>
							</div>
						</div>
                        <div class="box-body">
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label">Meteran akhir</label>
								<div class="col-sm-10 col-md-6">
									<input type="text" name="meteran_akhir" value="<?= $meteran_akhir;?>"" class=" form-control" id="inputEmail3" placeholder="Meteran akhir">
								</div>
							</div>
						</div>

						<div class="box-body">
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label">Bulan Tagihan</label>
								<div class="col-sm-10 col-md-6">
									<input readonly type="text" name="tgl_tagihan" value="<?= $tgl_tagihan;?>"" class=" form-control" id="inputEmail3" placeholder="tgl tagihan">
								</div>
							</div>
						</div>

						<div class="box-body">
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label">Tgl Pembayaran</label>
								<div class="col-sm-10 col-md-6">
									<input readonly type="text" name="tgl_pembayaran" value="<?= $tgl_pembayaran;?>"" class=" form-control" id="inputEmail3" placeholder="tgl pembayaran">
								</div>
							</div>
						</div>

                        <div class="box-body">
							<div class="form-group">
								<label for="inputEmail3" class="col-sm-2 control-label">total bayar</label>
								<div class="col-sm-10 col-md-6">
									<input type="text" name="total_bayar" value="<?= $total_bayar;?>"" class=" form-control" id="inputEmail3" placeholder="Total bayar">
								</div>
							</div>
						</div>
	<!-- /.box-body -->
						<div class="box-footer">
							<button type="submit"  class="btn btn-info pull-right">Simpan</button>
						</div>
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-10">	
									<div class="checkbox">

									</div>
								</div>
							</div>
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
