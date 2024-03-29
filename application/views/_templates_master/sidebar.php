<aside class="main-sidebar sidebar-dark-primary elevation-4">
	<!-- Brand Logo -->
	<a href="<?= base_url() ?>assets/index3.html" class="brand-link">
		<img src="<?= base_url() ?>assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
		<span class="brand-text font-weight-light">AdminLTE 3</span>
	</a>

	<!-- Sidebar -->
	<div class="sidebar">
		<!-- Sidebar user panel (optional) -->
		<div class="user-panel mt-3 pb-3 mb-3 d-flex">
			
		</div>

		<!-- Sidebar Menu -->
		<nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
				<!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
				<li class="nav-item has-treeview menu-open">
					<a href="#" class="nav-link active">
						<i class="nav-icon fas fa-tachometer-alt"></i>
						<p>
							Menu
							<i class="right fas fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="<?= base_url('admin/DashboardController/dashboard'); ?>" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Message</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= base_url('admin/MasterBarangController/index'); ?>" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Master Barang</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= base_url('admin/PromoController/index'); ?>" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Promo</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= base_url('admin/TransaksiController/index'); ?>" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Transaksi</p>
							</a>
						</li>
					</ul>
				</li>
			</ul>
		</nav>
		<!-- /.sidebar-menu -->
	</div>
	<!-- /.sidebar -->
</aside>
