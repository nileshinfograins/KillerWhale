<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct() 
    {
		parent::__construct();
		$this->load->library('form_validation');

		/*****loading model*/
		$this->load->model('Users');
		$this->load->helper('cookie');

		$this->load->helper('security'); 

		$this->load->library('email');

                $this->email->initialize(array(
  'protocol' => 'smtp',
  'smtp_host' => 'smtp.sendgrid.net',
  'smtp_user' => 'rajatinfo',
  'smtp_pass' => 'Rajat123!@#',
  'smtp_port' => 587,
  'crlf' => "\r\n",
  'newline' => "\r\n"
));

		$this->load->helper('string'); 

		$this->load->library('ether');

		$this->config->load('admin');

    }

	function index()
	{
		if(!$this->session->userdata('user_id'))
		{
			$this->form_validation->set_rules('email', 'Email', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');

			if ($this->form_validation->run() == FALSE)
			{
				$this->load->view('login');
			}
			else
			{
				$redirect_url = $this->input->post('redirect_url');

				$email = $this->input->post('email', true);
				$password = md5($this->input->post('password', true));
				$remember_me = $this->input->post('remember_me', true);

				$where = array('email'=>$email, 'password'=>$password, 'is_delete'=>1);
				$login_data = $this->Users->login('users', $where);

				// $test = $this->db->last_query();
				// echo $test; die;

				if(!empty($login_data))
				{
					if($login_data->status == 1)
					{
						if($remember_me == 1)
						{
							$cookie_username = array(
									'name'   => 'w_email',
									'value'  => $email,
									'expire' => time()+60*60, 
									);
							$cookie_password = array(
									'name'   => 'w_password',
									'value'  => $this->input->post('password', true),
									'expire' => time()+60*60, 
									);

							$this->input->set_cookie($cookie_username);
							$this->input->set_cookie($cookie_password);

						}
						else
						{
							delete_cookie("w_email");
							delete_cookie("w_password");				
						}

						/************Update OTP of User***Start*********/
						$otp = $this->generate_otp(4);
						$update_data = array('OTP'=>$otp);
						$this->Users->update_data('users', array('id'=>$login_data->id), $update_data);
						/************Update OTP of User***End*********/

						/**********Send Mail to User***Start*******/
							$this->load->helper('html');
							
							$message='';
							$config['mailtype'] = 'html';
							$this->email->initialize($config);
							
							$subject = 'Killer whale Token : OTP';				

							$message.= 'Hello '.$login_data->first_name;
							$message.= br(2);
							$message.= 'Your OTP is: '.$otp;
							$message.= br(2);
							$message.= 'Thanks,';
							
							$this->email->from('info@killerwhale.io','Killer Whale');
							$this->email->to($email);

							$this->email->subject($subject);
							$this->email->message($message); 
							$this->email->send();
						/**********Send Mail to User***End*******/

						redirect(base_url().'login/otp_verification?token='.$login_data->token.'&next='.$redirect_url);
					}
					else
					{
						$this->session->set_flashdata('error_session','You are not allowed to login !');
						redirect(base_url().'login?next='.$redirect_url);
					}
					
				}
				else
				{
					$this->session->set_flashdata('error_session','Invalid Email or Password');
					redirect(base_url().'login?next='.$redirect_url);
				}

			}
		}
		else
		{
			redirect(base_url());
		}
	}

	function generate_otp($digits = 4){
	    $i = 0; //counter
	    $pin = ""; //our default pin is blank.
	    while($i < $digits){
	        //generate a random number between 0 and 9.
	        $pin .= mt_rand(0, 9);
	        $i++;
	    }
	    return $pin;
	}

	function otp_verification()
	{
		$token = $this->input->get('token');
		if($token)
		{
			$user_data = $this->Users->getSingle('users', array('token'=>$token));

			if(!empty($user_data))
			{
				if($user_data->OTP == $this->session->userdata('user_otp'))
				{
					redirect(base_url());
				}
				else
				{
					$data['token'] = $token;
					$this->load->view('otp_verification', $data);	
				}
			}
			else
			{
				redirect(base_url());
			}
		}
		else
		{
			redirect(base_url());
		}
	}

	function verify_otp()
	{
		if($_POST)
		{
			$token = $this->input->post('token');
			$otp = $this->input->post('user_otp');

			$redirect_url = $this->input->post('redirect_url');


			$user_data = $this->Users->getSingle('users', array('token'=>$token));

			if(!empty($user_data))
			{
				if($user_data->OTP == $otp)
				{
					$session_data = array(
					'user_id'   =>$user_data->id,
					'user_name'  =>$user_data->first_name,
					'user_email'  =>$user_data->email,
					'user_otp'  =>$user_data->OTP,
					);
					$this->session->set_userdata($session_data);

					if(!empty($redirect_url))
					{
						redirect($redirect_url);
					}
					else
					{
						redirect(base_url().'user/profile');
					}
				}
				else
				{
					$this->session->set_flashdata('error_message', 'Please enter correct otp');
					redirect('login/otp_verification?token='.$token.'&next='.$redirect_url);
				}
			}
			else
			{
				redirect(base_url());
			}
		}
		else
		{
			redirect(base_url());
		}
	}

	function signup()
	{
		if(!$this->session->userdata('user_id'))
		{
			$this->form_validation->set_rules('first_name', 'First Name', 'required');
			$this->form_validation->set_rules('last_name', 'Last Name', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required|callback_email_unique[email]');
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_rules('contact_number', 'Contact Number', 'required');
			$this->form_validation->set_rules('country', 'Country', 'required');

			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');

			if ($this->form_validation->run() == FALSE)
			{
				$this->load->view('register');
			}
			else
			{
				$first_name = $this->input->post('first_name', true);
				$last_name = $this->input->post('last_name', true);
				$email = $this->input->post('email', true);
				$password = md5($this->input->post('password', true));
				$contact_number = $this->input->post('contact_number', true);
				$country = $this->input->post('country', true);
				$referral_code = random_string('alnum', 10);
				$refer_by = $this->input->post('referral_code', true);

				$token = md5(uniqid(rand(), true));

				$insert_data = array(
					'first_name'=>$first_name,
					'last_name'=>$last_name,
					'email'=>$email,
					'password'=>$password,
					'contact_number'=>$contact_number,
					'country'=>$country,
					'token'=>$token,
					'referral_code'=>$referral_code,
					'refer_by'=>$refer_by,
					'status'=>0,
					'created_datetime'=>date('Y-m-d H:i:s'),
					'modified_datetime'=>date('Y-m-d H:i:s'),
					);

				$insert_id = $this->Users->insert_data('users', $insert_data);

				/*******Create User Address**Start*******/
					$this->ether->createAddress($insert_id);
				/*******Create User Address**End*******/

			/**********Send Mail to User***Start*******/
				$this->load->helper('html');
				
				$message='';
				$config['mailtype'] = 'html';
				$this->email->initialize($config);
				
				$subject = 'Killer Whale:- Account Activation';
				
				$message.= 'Thank you for registering a new account ';
				$message.= br(2);
				$message.= 'To activate your newly created account, you may simply click on the following:';
				$message.= br(1);
				$message.= 'URL: <a href='.base_url().'login/email_verification?token='.$token.'>Click Here</a>';
				$message.= br(2);
				$message.= 'Thanks,';
				
				$this->email->from('info@killerwhale.io','Killer Whale');
				$this->email->to($email);

				$this->email->subject($subject);
				$this->email->message($message); 
				$this->email->send();
				/**********Send Mail to User***End*******/

				$this->session->set_flashdata('error_session', 'Thank you for signing up. Please check your email account to complete signup');
				redirect(base_url().'register');
			}
		}
		else
		{
			redirect(base_url());
		}
	}

	function email_unique($email)
	{
		$result = $this->Users->getWhere('users', array('email'=>$email, 'is_delete'=>1));

		if(!empty($result))
		{
			$this->form_validation->set_message('email_unique', 'Email Already Exist !');
			return FALSE;
		}
		else
		{
			return TRUE;	
		}
	}

	function isEmailExist()
	{
		if($_GET)
		{
			$email = $this->input->get('email');
			$result = $this->Users->getWhere('users', array('email'=>$email, 'is_delete'=>1));

			if(!empty($result))
			{
				echo 'false';
			}
			else
			{
				echo  'true';	
			}
		}
		else
		{
			redirect(base_url());
		}
	}	

	function email_verification()
	{
		$token = $this->input->get('token');
		if(!empty($token))
		{
			$update_data = array('status'=>1);
			$where = array('token'=>$token);
			$this->Users->update_data('users', $where, $update_data);

			redirect(base_url().'login');
		}
		else
		{
			redirect(base_url());
		}
	}

	function forgot_password()
	{
		if(!$this->session->userdata('user_id'))
		{
			$this->form_validation->set_rules('email_f', 'Email', 'required');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');

			if ($this->form_validation->run() == FALSE)
			{
				$this->load->view('forgot_password');
			}
			else
			{
				$email = $this->input->post('email_f', true);

				$where = array('email'=>$email, 'is_delete'=>1, 'status' => 1);
				$login_data = $this->Users->getSingle('users', $where);

				if(!empty($login_data))
				{

					$token = $login_data->token;

					/**********Send Mail to User***Start*******/
						$this->load->helper('html');
						
						$message='';
						$config['mailtype'] = 'html';
						$this->email->initialize($config);
						
						$subject = 'Killer Whale:- Forgot Password';

						$message.= 'To reset your password, you may simply click on the following:';
						$message.= br(1);
						$message.= 'URL: <a href='.base_url().'reset_password?token='.$token.'>Click Here</a>';
						$message.= br(2);
						$message.= 'Thanks,';
						
						$this->email->from('info@killerwhale.io','Killer Whale');
						$this->email->to($email);

						$this->email->subject($subject);
						$this->email->message($message); 
						$this->email->send();
					/**********Send Mail to User***End*******/

					$this->session->set_flashdata('error_message','Please check your email account for password');

					redirect(base_url().'forgot_password');
				}
				else
				{
					$this->session->set_flashdata('error_message','Please enter your registered email');
					redirect(base_url().'forgot_password');
				}
			}
		}
		else
		{
			redirect(base_url());
		}
	}

	function reset_password()
	{
		$token = $this->input->get('token');

		$user_data = $this->Users->getSingle('users', array('token'=>$token));

		if(!empty($user_data))
		{
			$this->form_validation->set_rules('password_r', 'New Password', 'required');
			$this->form_validation->set_rules('password_c', 'Confirm Password', 'required');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');

			if ($this->form_validation->run() == FALSE)
			{
				$this->load->view('reset_password');
			}
			else
			{
				$password = $this->input->post('password_r', true);

				$where = array('token'=>$token);
				$update_data = array('password'=>MD5($password));
				$this->Users->update_data('users', $where, $update_data);


				$email = $user_data->email;
				
				/**********Send Mail to User***Start*******/
					$this->load->helper('html');
					
					$message='';
					$config['mailtype'] = 'html';
					$this->email->initialize($config);
					
					$subject = 'Killer Whale:- Reset Password';

					$message.= 'Thank you for resetting password';
					$message.= br(1);
					$message.= 'Your new password is: '.$password;
					$message.= br(2);
					$message.= 'Thanks,';
					
					$this->email->from('info@killerwhale.io','Killer Whale');
					$this->email->to($email);

					$this->email->subject($subject);
					$this->email->message($message); 
					$this->email->send();
				/**********Send Mail to User***End*******/

				$this->session->set_flashdata('error_message','You have successfully changed your password.');

				redirect(base_url().'reset_password?token='.$token);

			}
		}
		else
		{
			redirect(base_url());
		}
	}



	function logout()
	{
		$this->session->unset_userdata('user_id');
		$this->session->unset_userdata('user_email');
		$this->session->unset_userdata('user_otp');
		//$this->session->sess_destroy();

		redirect('login', true);
	}

	function killer_token_sale()
	{
		$total_supply = $this->config->item('total_supply');

		$total_supply_half = $total_supply/2;

		$wallet_data = $this->ether->getBalance($this->config->item('admin_wallet_address'));

		$remaining_token = $wallet_data->token - $total_supply_half;

		if($remaining_token <= 0)
		{
			$this->load->view('killer_token_sale_close');
		}
		else
		{
			$data['admin_data'] = $this->Users->getSingle('admin_setting', array('id'=>1));
			$this->load->view('killer_token_sale', $data);
		}

	}


}
