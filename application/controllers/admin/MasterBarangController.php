<?php

// use application\Services\MasterBarang_Service;

class MasterBarangController extends CI_Controller
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
		$tool			= $this->MasterBarangModel->getDataByLastTime();
		$no_kode_barang	= substr($tool->kode_barang,4,3)+1;

		$format_kode_barang	= null;
		
		
		if ($no_kode_barang <= 9) {
			$format_kode_barang = "BRG-00" . $no_kode_barang;
		}
		elseif($no_kode_barang > 9 && $no_kode_barang <= 99)
		{
			$format_kode_barang = "BRG-0" . $no_kode_barang;
		}
		else{
			$format_kode_barang = "BRG-" . $no_kode_barang;
		}

		$data['format_kode_barang'] = $format_kode_barang;
		
		$this->load->view('master_barang/index', $data);
	}

	public function fetch()
	{
		$data['tools']		= $this->MasterBarangModel->getData()->result();

		echo json_encode($data);
	}

	public function store()
	{
		$code 	= $this->input->post('code');
		$name 	= $this->input->post('name');
		$price 	= $this->input->post('price');

		if(!$code){
			$result['message']	= "Kode Barang tidak boleh kosong";
		}elseif (!$name) {
			$result['message']	= "Kode Barang tidak boleh kosong";
		}elseif (!$price) {
			$result['message']	= "Kode Barang tidak boleh kosong";
		}else{
			$data	= [
				'kode_barang'	=> $code,
				'nama_barang'	=> $name,
				'harga'			=> $price,
				'created_by'	=> $this->session->userdata('email'),
				'updated_by'	=> $this->session->userdata('email'),
				'created_at'	=> date('Y-m-d H:i:s'),
				'updated_at'	=> date('Y-m-d H:i:s'),
			];

			$result = $this->MasterBarangModel->store($data);

			$tool			= $this->MasterBarangModel->getDataByLastTime();
			$no_kode_barang	= substr($tool->kode_barang,4,3)+1;

			$format_kode_barang	= null;
			
			
			if ($no_kode_barang <= 9) {
				$format_kode_barang = "BRG-00" . $no_kode_barang;
			}
			elseif($no_kode_barang > 9 && $no_kode_barang <= 99)
			{
				$format_kode_barang = "BRG-0" . $no_kode_barang;
			}
			else{
				$format_kode_barang = "BRG-" . $no_kode_barang;
			}
			
			$kode_barang = $format_kode_barang;

			if ($result == true) {
				$data = [
					'status' 		=> "Success",
					'code' 			=> 200,
					'message'		=> "Master Barang berhasil di simpan",
					'id_tool'		=> $kode_barang
				];

				echo json_encode($data);
			}else{
				$data = [
					'status' 	=> "Faild",
					'message'	=> "Master Barang gagal di simpan"
				];

				echo json_encode($data);
			}
		}

	}

	public function edit()
	{
		$code	= $this->input->post('code');

		$result = $this->MasterBarangModel->getRowById($code)->row();

		if ($result) {
			$data	= [
				'status'	=> "Success",
				'row'		=> $result,
			];

			echo json_encode($data);
		} else {
			$data	= [
				'status'	=> "Faild"
			];

			echo json_encode($data);
		}
	}

	public function update()
	{
		$kode_barang 		= $this->input->post('code');
		$tool	= [
			'kode_barang'	=> $kode_barang,
			'nama_barang'	=> $this->input->post('name'),
			'harga'			=> $this->input->post('price'),
			'updated_by'	=> $this->session->userdata('email'),
			'updated_at'	=> date('Y-m-d H:i:s'),
		];

		$result = $this->MasterBarangModel->update($tool, $kode_barang);
		// var_dump($tool);die;
		if ($result == true) {
			$data = [
				'status'	=> "Success",
				'code'		=> 200,
				"message"	=> "Master Barang update successfully"
			];

			echo json_encode($data);
		}else{
			$data = [
				'status'	=> "Faild",
				"message"	=> "Update Faild"
			];

			echo json_encode($data);
		}
	}

	public function destroy()
	{
		$code	= $this->input->post('code');

		$result	= $this->MasterBarangModel->destroy($code);
		if ($result == true) {
			$data = [
				'status'	=> "Success",
				'code'		=> 200,
				"message"	=> "Master Barang sudah dihapus"
			];

			echo json_encode($data);
		}
	}
}
