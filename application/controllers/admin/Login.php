<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct() 
    {
		parent::__construct();
		$this->load->library('form_validation');

		/*****loading model*/
		$this->load->model('Admin_login');
		$this->load->helper('cookie');
    }
    
	public function index()
	{
		if(!$this->session->userdata('admin_id'))
		{
			$this->form_validation->set_rules('username', 'Username', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');

			if ($this->form_validation->run() == FALSE)
			{
				$this->load->view('admin/login');
			}
			else
			{
				$username = $this->input->post('username', true);
				$password = md5($this->input->post('password', true));

				$redirect_url = $this->input->post('redirect_url') ? $this->input->post('redirect_url') : base_url().'admin/login';

				$remember_me = $this->input->post('remember_me', true);

				$where = array('username'=>$username, 'password'=>$password);
				$login_data = $this->Admin_login->login('admin_login', $where);

				if(!empty($login_data))
				{

					$session_data = array(
					'admin_id'   =>$login_data->id,
					'admin_email'  =>$login_data->email,
					'admin_username'  =>$login_data->username,
					);
					$this->session->set_userdata($session_data);
			

					if($remember_me == 1)
					{
						$cookie_username = array(
								'name'   => 'a_username',
								'value'  => $username,
								'expire' => time()+60*60, 
								);
						$cookie_password = array(
								'name'   => 'a_password',
								'value'  => $this->input->post('password', true),
								'expire' => time()+60*60, 
								);

						$this->input->set_cookie($cookie_username);
						$this->input->set_cookie($cookie_password);

					}
					else
					{
						delete_cookie("a_username");
						delete_cookie("a_password");				
					}

					redirect($redirect_url);
				}
				else
				{

					$this->session->set_flashdata('error_session','Invalid Username or Password');
					redirect('admin/login?next='.$redirect_url);
				}

			}
		}
		else
		{
			redirect('admin/dashboard');
		}
	}

	function logout()
	{
		$this->session->unset_userdata('admin_id');
		$this->session->unset_userdata('admin_username');
		$this->session->unset_userdata('admin_email');
		//$this->session->sess_destroy();

		redirect('admin/login', true);

	}

}
