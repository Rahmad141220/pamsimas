    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    	<!-- Content Header (Page header) -->
    	<section class="content-header">
    		<h1>
    			Beranda
    		</h1>
    		<ol class="breadcrumb">
    			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    			<li class="active">Dashboard</li>
    		</ol>
    	</section>



    	<!-- Main content -->
    	<section class="content">
    		<!-- Small boxes (Stat box) -->
    		<div class="row">
    			<div class="col-lg-3 col-xs-6">
    				<!-- small box -->
    				<div class="small-box bg-aqua">
    					<div class="inner">
    						<h3><?= $jumlah_bayar;?></h3>

    						<p>Jumlah Bayar</p>
    					</div>
    					<div class="icon">
    						<i class="ion ion-bag"></i>
    					</div>
    					<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
    				</div>
    			</div>
    			<!-- ./col -->
    			<div class="col-lg-3 col-xs-6">
    				<!-- small box -->
    				<div class="small-box bg-green">
    					<div class="inner">
    						<h3><?= $jumlah_belum_bayar;?><sup style="font-size: 20px"></sup></h3>

    						<p>Jumlah Yang Belum di Bayar</p>
    					</div>
    					<div class="icon">
    						<i class="ion ion-stats-bars"></i>
    					</div>
    					<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
    				</div>
    			</div>
    			<!-- ./col -->
    			<div class="col-lg-3 col-xs-6">
    				<!-- small box -->
    				<div class="small-box bg-yellow">
    					<div class="inner">
    						<h3><?= $jumlah_bayar;?></h3>

    						<p>Jumlah Yang di Bayar</p>
    					</div>
    					<div class="icon">
    						<i class="ion ion-person-add"></i>
    					</div>
    					<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
    				</div>
    			</div>
    			<!-- ./col -->
    			<div class="col-lg-3 col-xs-6">
    				<!-- small box -->
    				<div class="small-box bg-red">
    					<div class="inner">
    						<h3><?= number_format($total_bayar);?></h3>
							<!-- number_format($row['total_bayar']), -->
    						<p>Total Bayar</p>
    					</div>
    					<div class="icon">
    						<i class="ion ion-pie-graph"></i>
    					</div>
    					<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
    				</div>
    			</div>
    			<!-- ./col -->
    		</div>

<!-- dashboard -->
<section class="content-header">
    		<h1>
    			Grafik Laporan
			</h1>
			<br>
	<!-- Main content -->
    	<!-- <section class="content"> -->
    		<div class="row">
    			<div class="col-md-12">
    				<!-- AREA CHART -->
    				<div class="box box-primary">
    					<div class="box-header with-border">
    						<h3 class="box-title"></h3>

    						<div class="box-tools pull-right">
    							<button type="button" class="btn btn-box-tool" data-widget="collapse"><i
    									class="fa fa-minus"></i>
    							</button>
    							<button type="button" class="btn btn-box-tool" data-widget="remove"><i
    									class="fa fa-times"></i></button>
    						</div>
    					</div>
    					<div class="box-body">
    						<div class="chart">
    							<canvas id="areaChart" style="height:250px"></canvas>
    						</div>
    					</div>

    	</section>
	</div>
	<div>
	<div>
	<div>


