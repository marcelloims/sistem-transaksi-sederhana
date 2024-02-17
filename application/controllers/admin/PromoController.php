<?php

class PromoController extends CI_Controller
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
		$tool			= $this->PromoModel->getDataByLastTime();
		$no_kode_promo	= substr($tool->kode_promo,6,3)+1;

		$format_kode_promo	= null;
		
		
		if ($no_kode_promo <= 9) {
			$format_kode_promo = "promo-00" . $no_kode_promo;
		}
		elseif($no_kode_promo > 9 && $no_kode_promo <= 99)
		{
			$format_kode_promo = "promo-0" . $no_kode_promo;
		}
		else{
			$format_kode_promo = "promo-" . $no_kode_promo;
		}

		$data['format_kode_promo'] = $format_kode_promo;

		$this->load->view('promo/index', $data);
	}

	public function fetch()
	{
		$promo	= $this->PromoModel->getData()->result_array();
		// print_r($promo);

		echo json_encode($promo);
	}

	public function store()
	{
		$code 			= $this->input->post('code');
		$name 			= $this->input->post('name');
		$description 	= $this->input->post('description');


		if(!$code){
			$result['message']	= "Kode Promo tidak boleh kosong";
		}elseif (!$name) {
			$result['message']	= "Kode Promo tidak boleh kosong";
		}elseif (!$description) {
			$result['message']	= "Keterangan tidak boleh kosong";
		}else{
			
			$data	= [
				'kode_promo'	=> $code,
				'nama_promo'	=> $name,
				'keterangan'	=> $description,
				'created_by'	=> $this->session->userdata('email'),
				'updated_by'	=> $this->session->userdata('email'),
				'created_at'	=> date('Y-m-d H:i:s'),
				'updated_at'	=> date('Y-m-d H:i:s'),
			];
	
			$result = $this->PromoModel->store($data);
			// print_r($data);die;

			$tool			= $this->PromoModel->getDataByLastTime();
			$no_kode_promo	= substr($tool->kode_promo,6,3)+1;

			$format_kode_promo	= null;
			
			
			if ($no_kode_promo <= 9) {
				$format_kode_promo = "promo-00" . $no_kode_promo;
			}
			elseif($no_kode_promo > 9 && $no_kode_promo <= 99)
			{
				$format_kode_promo = "promo-0" . $no_kode_promo;
			}
			else{
				$format_kode_promo = "promo-" . $no_kode_promo;
			}
			
			$kode_promo = $format_kode_promo;

			if ($result == true) {
				$data = [
					'status' 		=> "Success",
					'code' 			=> 200,
					'message'		=> "Promo berhasil di simpan",
					'id_tool'		=> $kode_promo
				];

				echo json_encode($data);
			}else{
				$data = [
					'status' 	=> "Faild",
					'message'	=> "Promo gagal di simpan"
				];

				echo json_encode($data);
			}
		}
	}

	public function edit()
	{
		$code	= $this->input->post('code');

		$result = $this->PromoModel->getRowById($code)->row();

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
		$kode_promo 		= $this->input->post('code');
		$tool	= [
			'kode_promo'	=> $kode_promo,
			'nama_promo'	=> $this->input->post('name'),
			'keterangan'	=> $this->input->post('description'),
			'updated_by'	=> $this->session->userdata('email'),
			'updated_at'	=> date('Y-m-d H:i:s'),
		];

		$result = $this->PromoModel->update($tool, $kode_promo);
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

		$result	= $this->PromoModel->destroy($code);
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
