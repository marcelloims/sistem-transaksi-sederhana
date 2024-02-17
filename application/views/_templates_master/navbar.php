<nav class="main-header navbar navbar-expand navbar-white navbar-light">
	<ul class="navbar-nav">
		<li class="nav-item">
			<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
		</li>
	</ul>

	<!-- Right navbar links -->
	<ul class="navbar-nav ml-auto">
		<?php if ($this->session->userdata('username')) { ?>
			<li>
				<div>Selamat Datang : <?= $this->session->userdata('username') ?></div>
			</li>
			<li></li>
		<?php } else { ?>
			<li><?= anchor('LoginController/login', 'Login') ?></li>
		<?php } ?>
	</ul>
	<ul class="navbar-nav">
		<!-- Notifications Dropdown Menu -->
		<li class="nav-item dropdown">
			<a class="nav-link" data-toggle="dropdown" href="#">
				<i class="fa fa-cogs" aria-hidden="true"></i>
			</a>
			<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
				<div class="dropdown-divider"></div>
				<a href="<?= base_url('admin/DashboardController/logout') ?>" class="dropdown-item">
					<i class="fa fa-sign-out" aria-hidden="true">Logout</i>
				</a>
			</div>
		</li>
	</ul>
</nav>
