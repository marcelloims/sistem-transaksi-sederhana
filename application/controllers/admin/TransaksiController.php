<?php 

class TransaksiController extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('asia/singapore');
		if(!$this->session->userdata('is_admin')){
			return redirect('LoginController/login');
		}
	}

	public function index()
	{
		$data['products']	= $this->MasterBarangModel->getData()->result();
		// var_dump($data);die;
		$this->load->view('transaksi/index', $data);
	}

	function save()
	{
		
		$transaksi		= $this->TransaksiModel->getDataByLastTime();
		$no_transaksi = null;
		if ($transaksi == null) {
			$no_transaksi = 1;
		}else{
			$no_transaksi	= substr($transaksi->no_transaksi,7,3)+1;
		}

		$format_no_transaksi	= null;

		if ($no_transaksi <= 9) {
			$format_no_transaksi = date('Ym')."-00" . $no_transaksi;
		}
		elseif($no_transaksi > 9 && $no_transaksi <= 99)
		{
			$format_no_transaksi = date('Ym')."-0" . $no_transaksi;
		}
		else{
			$format_no_transaksi = date('Ym'). "-" . $no_transaksi;
		}

		$dataTransaksi = [
			"no_transaksi" 			=> $format_no_transaksi,
			"tgl_transaksi" 		=> date('Y-m-d H:i:s'),
			"customer" 				=> $_POST['customer'],
			"kode_promo" 			=> null,
			"total_bayar" 			=> $this->cart->total() ,
			"ppn" 					=> $this->cart->total() * 10 / 100,
			"grand_total" 			=> $this->cart->total() + ($this->cart->total() * 10 / 100),
			'created_by'			=> $this->session->userdata('email'),
			'updated_by'			=> $this->session->userdata('email'),
			'created_at'			=> date('Y-m-d H:i:s'),
			'updated_at'			=> date('Y-m-d H:i:s'),
		];

		$result = $this->TransaksiModel->save($dataTransaksi, $format_no_transaksi);
		
		$this->cart->destroy();

		if ($result == true) {
			$data = [
				"status"	=>  "Success",
				"code"		=>  200,
				"message"	=> "Transaksi di simpan",
				'cart'		=> $this->view()
			];

			echo json_encode($data);
		}else{
			return false;
		}
	}

	public function addToCart()
	{
		$data	= [
			"id"	=> $this->input->post('product_id'),
			"name"	=> $this->input->post('product_name'),
			"qty"	=> $this->input->post('qty'),
			"price"	=> $this->input->post('product_price'),
		];

		$this->cart->insert($data);

		echo $this->view();
	}

	function remove(){
		$row_id = $_POST['row_id'];

		$data = [
			'rowid'	=> $row_id,
			'qty'	=> 0
		];

		$this->cart->update($data);
		echo $this->view();
	}

	function load()
	{
		echo $this->view();
	}

	function clear()
	{
		$this->cart->destroy();
		echo $this->view();
	}

	function view()
	{
		$output = '';
		$output .= '
			<h3 class="text-center">Shopping Cart</h3>
			<div class="table-responsive">
				<div align="right">
					<button type="button" id="clear_cart" class="btn btn-danger">Clear Cart</button>
				</div>
				<br/>

				<table class="table table-bordered">
					<tr>
						<th>Name</th>
						<th>Qty</th>
						<th>Price</th>
						<th>Total</th>
						<th>Aksi</th>
					</tr>
		';

		$count = 0;

		foreach ($this->cart->contents() as $item) {
			$count++;

			$output .='
				<tr>
					<td>'.$item["name"].'</td>
					<td>'.$item["qty"].'</td>
					<td>Rp. '.number_format($item["price"],0,',','.').'</td>
					<td>Rp. '.number_format($item["subtotal"],0,',','.').'</td>
					<td>
						<button type="button" name="remove" class="btn btn-danger remove_inventory" id="'.$item["rowid"].'">Hapus</button>
					</td>
				</tr>
			';
		}
		
		$output .='
				<tr>
					<td colspan="4" align="right">Customer</td>
					<td width="180px"><input type="text" name="customer" id="customer" class="form-control customer"></td>
				</tr>
				<tr>
					<td colspan="4" align="right">Ppn</td>
					<td>Rp. '.number_format(10,0,',','.').'%</td>
				</tr>
				<tr>
					<td colspan="4" align="right">Total</td>
					<td>Rp. '.number_format($this->cart->total() + ($this->cart->total() * 10 / 100),0,',','.').'</td>
				</tr>
			</table>
			<button type="button" name="save" id="save" class="btn btn-success">Simpan</button>
		</div>
		';

		if ($count == 0) {
			$output = '<h3 align="center">Cart is Empty</h3>';
		}

		return $output;
	}
}
