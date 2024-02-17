<?php

class LoginController extends CI_Controller
{
	public function login()
	{
		$this->load->view('auth/login_view');
	}

	public function loginAction()
	{
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_error_delimiters('<span class="text-danger text-sm">','</span>');

		if ($this->form_validation->run() == TRUE) {
			$email		= $this->input->post('email');
			$password	= $this->input->post('password');

			$email		= $this->input->post('email');
			$password	= $this->secure->encrypt_url($this->input->post('password'));
			
			$result = $this->LoginModel->loginAction($email, $password);

			if ($result->num_rows() == 0) {
				$this->session->set_flashdata('error_login_message', 'Check your Email or Password and try again!');
				return redirect('LoginController/login');
			}

			if ($result->num_rows() == 1) {
				$user = $result->row_array();

				$this->session->set_userdata('is_admin', $user['id']);
				$this->session->set_userdata('username', $user['username']);
				$this->session->set_userdata('email', $user['email']);

				return redirect('admin/DashboardController/dashboard');
			}
		}else{
			// get Error Message
			$this->load->view('auth/login_view');
		}
	}
}
