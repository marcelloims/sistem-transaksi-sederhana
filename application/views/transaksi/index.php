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
							<h1 class="m-0 text-dark">Transaksi</h1>
						</div>
					</div>
				</div>
			</div>
			<!-- /.content-header -->

			<!-- Main content -->
			<section class="content">
				<div class="container">
					<div class="row">
						<div class="col-6">
							<div class="row">
								<?php foreach ($products as $item) :?>
									<div class="col-4">
										<div class="card"">
											<div class="card-body">
												<h5 class="card-title"><?= $item->nama_barang ?></h5><br/>
												<h6 class="card-title mb-3">Rp. <?= number_format($item->harga ,0,',','.') ?></h6>
												
												<input type="number" name="qty" nim="1" class="form-control qty" id="<?= $item->kode_barang ?>" placeholder="Input Qty">
												
												<button type="button" name="add_cart" class=" float-right btn btn-sm mt-2 btn-primary add_cart" data-productname="<?= $item->nama_barang ?>" data-price="<?= $item->harga ?>" data-productid="<?= $item->kode_barang ?>">Add to Cart</button>
											</div>
										</div>
									</div>
								<?php endforeach; ?>
							</div>
						</div>
						<div class="col-6">
						<div class="card">
								<div class="card-body">
									<div id="cart_details">
										<h3 class="text-center">Cart is Empty</h3>
									</div>
								</div>
							</div>
						</div>
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
	<script>
		const rupiah = (number)=>{
			return new Intl.NumberFormat("id-ID", {
			style: "currency",
			currency: "IDR"
			}).format(number);
		}

		$(document).ready(function(){
			$(".add_cart").click(function(){
				let product_id 		= $(this).data("productid");
				let product_name 	= $(this).data("productname");
				let product_price 	= $(this).data("price");
				let qty				= $("#" + product_id).val()
			// console.log(qty);

				if (qty != '' && qty > 0) {
					$.ajax({
						url		: "<?= base_url('admin/TransaksiController/addToCart'); ?>",
						method	: "POST",
						data		: {
							product_id		: product_id,
							product_name	: product_name,
							product_price	: product_price,
							qty				: qty
						},
						success				: function(response){
							alert("Product Added into Cart");
							// console.log(response);
							$("#cart_details").html(response);
							$("#" + product_id).val('');
						}
					});
				}else{
					alert("Masukan Qty!");
				}
			});

			$("#cart_details").load("<?= base_url('admin/TransaksiController/load') ?>")

			$(document).on('click', '.remove_inventory', function(){
				let row_id = $(this).attr("id");

				if (confirm("Kamu yakin mau hapus ini?")) {
					$.ajax({
						url		: "<?= base_url('admin/TransaksiController/remove') ?>",
						method	: "POST",
						data	: {row_id : row_id},
						success : function(response){
							alert("Product dihapus dari keranjang");
							$('#cart_details').html(response);
						}
					})
				}else{
					return false;
				}
			});

			$(document).on('click', '#clear_cart', function(){
				if (confirm("Kamu yakin ingin hapus semua item?")) {
					$.ajax({
						url		: "<?= base_url('admin/TransaksiController/clear') ?>",
						success : function(response){
							alert("Keranjang sudah dikosongkan!");
							$('#cart_details').html(response);
						}
					})
				}else{
					return false;
				}
			});

			$(document).on('click','#save', function(){
				let customer = $('.customer').val();
				$.ajax({
					url		: "<?= base_url('admin/TransaksiController/save') ?>",
					method	: "POST",
					data	: {customer : customer},
					success : function(response){
						console.log(response);
						
						$("#cart_details").load("<?= base_url('admin/TransaksiController/load') ?>")
						$('#cart_details').html(response.cart);
						Swal.fire({
							position: "top-end",
							icon: "success",
							title: response.message,
							showConfirmButton: false,
							timer: 1500
						});
					}
				})
			});
		})
	</script>
</body>

</html>
