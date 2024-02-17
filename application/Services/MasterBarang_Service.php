<?php

namespace application\Services;

class MasterBarang_Service 
{
	public function store()
	{
		if ($this->form_validation->run() == FALSE)
		{
				$data['tools']	= $this->MasterBarang_Model->getData()->result();
				$this->load->view('master_barang/index', $data);
		}
		else
		{
				var_dump('ss');die;
		}
	}
}
