<?php

class DashboardController extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		if(!$this->session->userdata('is_admin')){
			return redirect('LoginController/login');
		}
	}

	public function dashboard()
	{
		$this->load->view('dashboard/dashboard_view');
	}

	public function logout()
    {
        $this->session->sess_destroy();
        redirect('LoginController/login');
    }
}
