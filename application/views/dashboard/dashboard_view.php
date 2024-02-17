<!DOCTYPE html>
<html>

<head>
	<?php $this->load->view('_templates_master/header'); ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
	<div class="wrapper">

		<!-- Navbar -->
		<?php $this->load->view('_templates_master/navbar'); ?>
		<!-- /.navbar -->

		<!-- Main Sidebar Container -->
		<?php $this->load->view('_templates_master/sidebar'); ?>

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<div class="content-header">
				<div class="container-fluid">
					<div class="row mb-2">
						<div class="col-sm-6">
							<h1 class="m-0 text-dark">Regards</h1>
						</div>
					</div>
				</div>
			</div>
			<!-- /.content-header -->

			<!-- Main content -->
			<section class="content">
				<div class="container">
					<div class="alert alert-info" role="alert">
						<h4 class="alert-heading">To Mr. Michael and Mrs. Marina</h4>
						<p>Sebelumnya terimakasih untuk kesempatan yang sudah diberikan kepada saya, mohon maaf bila ada salah kata atau ucapan sewaktu inteview maupun atas keterlambatan saya dalam memberi link guthub dan "FORM DATA PRIBADI PELAMAR" dikarena laptop saya rusak gak mau hidup dari beberapa hari lalu, jadi saya meminjam laptop untuk mengisi form dan melakukan test coding ini</p>
						<hr>
						<p class="mb-0">Mohon permakluman apabila ada kekurangan yang saya lakukan, sekali lagi terimakasih. <strong>God be with u</strong></p>
					</div>
				</div>
			</section>
			<!-- Main content -->
		</div>


		<footer class="main-footer">
			<strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
			All rights reserved.
			<div class="float-right d-none d-sm-inline-block">
				<b>Version</b> 3.0.5
			</div>
		</footer>

		<!-- Control Sidebar -->
		<?php $this->load->view('_templates_master/control-sidebar') ?>
		<!-- /.control-sidebar -->
	</div>
	<!-- ./wrapper -->

	<!-- jQuery -->
	<?php $this->load->view('_templates_master/js'); ?>
	<!-- jQuery -->
</body>

</html>
