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
							<h1 class="m-0 text-dark">Data Promo</h1>
						</div>
					</div>
				</div>
			</div>
			<!-- /.content-header -->

			<!-- Main content -->
			<section class="content">
				<div class="container">

					<!-- Modal Area -->
					<!-- Button trigger modal -->
					<a href="#form" class="btn btn-primary mb-3" data-toggle="modal" onclick="submit('add')">
						<i class="fas fa-plus"> Promo</i>
					</a>

					<div class="modal fade" id="form" role="dialog">
						<div class="modal-dialog">
							<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title"></h5>
									</div>
									<div class="modal-body">
										<div class="form-group">
											<label for="">Kode Barang</label>
											<input type="text" class="form-control" name="code" id="code" placeholder="Masukan Data" value="<?= $format_kode_promo ?>" readonly>
										</div>
										<div class="form-group">
											<label for="">Nama Promo</label>
											<input type="text" class="form-control" name="name" id="name" placeholder="Masukan Data">
										</div>
										<div class="form-group">
											<label for="">Keterangan</label>
											<input type="text" class="form-control" name="description" id="description" placeholder="Masukan Data">
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" data-dismiss="modal" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
										<button type="button" id="button-store"  class="btn btn-primary" onclick="store()">Simpan</button>
										<button type="button" id="button-update" class="btn btn-primary" onclick="update()">Ubah</button>
									</div>
							</div>
						</div>
					</div>
					<!-- Modal Area -->

					<div class="card">
						<div class="card-body">
							<table class="table">
								<thead class="text-center">
									<th>No</th>
									<th>Kode</th>
									<th>Nama Promo</th>
									<th>Keterangan</th>
									<th>Aksi</th>
								</thead>
								<tbody id="target">
									
								</tbody>
							</table>
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

		function fetchData(){
			$.ajax({
				type		:"POST",
				url			:"<?= base_url('admin/PromoController/fetch') ?>",
				dataType	: "json",
				success		: function (response){
					// console.log(response);
					let rows	= null;
					let no 		= 1;
					for(var i=0; i<response.length; i++)
					{
						rows += '<tr>'+
									'<td class="text-center">'+ no++ +'</td>' +
									'<td class="text-center">'+ response[i].kode_promo +'</td>' +
									'<td>'+ response[i].nama_promo +'</td>' +
									'<td class="text-center">'+ response[i].keterangan +'</td>' +
									'<td class="text-center">'+ 
										`<a href="#form" class="btn btn-sm btn-warning mr-2" data-toggle="modal" onclick="submit('`+ response[i].kode_promo +`')">` +
											'<i class="fas fa-edit">'+'</i>'+
										'</a>'+
										`<a href="#" class="btn btn-sm btn-danger" onclick="destroy('`+ response[i].kode_promo +`')">` +
											'<i class="fas fa-trash">'+'</i>'+
										'</a>'+
									'</td>'+
								'</tr>'
					}

					$("#target").html(rows);
				}
			})
		}

		fetchData();

		function store(){
			let code 			= $('#code').val();
			let name 			= $('#name').val();
			let description 	= $('#description').val();
			// console.log(code);
			$.ajax({
				url		: "<?= base_url('admin/PromoController/store') ?>",
				method	: "POST",
				data	: {
					code		: code,
					name		: name,
					description : description
				},
				dataType: "json",
				success	: function(response){
					console.log(response);
					if (response.code === 200) {
						$('#code').val(response.id_tool);
						$('#name').val('');
						$('#description').val('');

						// console.log(response.id_tool);

						$("#form").modal("hide");
						
						fetchData();

						Swal.fire({
							position: "top-end",
							icon: "success",
							title: response.message,
							showConfirmButton: false,
							timer: 1500
						});
					}
				}
			});
		}

		function submit(x){
			if (x == "add") {
				$("#button-store").show();
				$("#button-update").hide();
			}else{
				$("#button-store").hide();
				$("#button-update").show();
				// console.log(x);

				$.ajax({
					url		: "<?= base_url('admin/PromoController/edit') ?>",
					method	: "POST",
					data	: {
						code: x
					},
					dataType: "json",
					success	: function(response){
						// console.log(response);

						if (response.status === "Success") {
							$("#code").val(response.row.kode_promo);
							$("#name").val(response.row.nama_promo);
							$("#description").val(response.row.keterangan);
						}
					}
				});
			}
		}

		function update(){
			let code 			= $('#code').val();
			let name 			= $('#name').val();
			let description 	= $('#description').val();


			$.ajax({
				url		: "<?= base_url('admin/PromoController/update') ?>",
				method	: "POST",
				data	: {
					code		: code,
					name		: name,
					description : description
				},
				dataType: "json",
				success	: function(response){
					// console.log(response);

					if (response.code === 200) {
						$("#editModal").modal("hide");
						fetchData();

						Swal.fire({
							position: "top-end",
							icon: "success",
							title: response.message,
							showConfirmButton: false,
							timer: 1500
						});
					}
				}
			});
		}

		function destroy(x)
		{
			Swal.fire({
				title: "Kamu yakin?",
				text: "Data yang di hapus tidak akan bisa dikembalikan!",
				icon: "warning",
				showCancelButton: true,
				confirmButtonColor: "#3085d6",
				cancelButtonColor: "#d33",
				confirmButtonText: "Yakin!",
				cencelButtonText: "Batalkan",
				}).then((result) => {
				if (result.isConfirmed) {
					$.ajax({
						url		: "<?= base_url('admin/PromoController/destroy') ?>",
						method	: "POST",
						data	: {
							code	: x,
						},
						dataType: "json",
						success	: function(response){

							fetchData();

							Swal.fire({
							title: "Terhapus!",
							text: response.message,
							icon: "success"
							});
						}
					});
				}
			});
		}
	</script>
</body>

</html>
