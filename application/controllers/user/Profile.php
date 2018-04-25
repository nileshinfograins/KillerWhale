<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

    function __construct() 
    {
		parent::__construct();

		/********Check user is logged or not ****Start*****/
		_is_user_login();
		/********Check user is logged or not ****End*****/

		$this->load->library('form_validation');
		$this->load->library('pagination');
		$this->load->model('Users');
		$this->load->model('Transfer_history');

		$this->load->library('ether');

		$this->config->load('admin');

    }
    
    function _response($data)
    {
    	echo json_encode($data);
    	exit;
    }

	public function index()
	{
		$data['title'] = 'User Profile';

		$this->form_validation->set_rules('first_name', 'First Name', 'required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'required');
		//$this->form_validation->set_rules('email', 'Email', 'required|callback_email_unique[email]');
		$this->form_validation->set_rules('contact_number', 'Contact Number', 'required');
		$this->form_validation->set_rules('country', 'Country', 'required');

		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');

		$data['user_data'] = $this->Users->getSingle('users', array('id'=>$this->session->userdata('user_id')));

		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('user/my_profile', $data);
		}
		else
		{
			$first_name = $this->input->post('first_name', true);
			$last_name = $this->input->post('last_name', true);
			//$email = $this->input->post('email', true);
			$password = md5($this->input->post('password', true));
			$contact_number = $this->input->post('contact_number', true);
			$country = $this->input->post('country', true);

			$update_data = array(
				'first_name'=>$first_name,
				'last_name'=>$last_name,
				'password'=>$password,
				'contact_number'=>$contact_number,
				'country'=>$country,
				'modified_datetime'=>date('Y-m-d H:i:s'),
				);

			$this->Users->update_data('users', array('id'=>$this->session->userdata('user_id')), $update_data);

			$this->session->set_flashdata('error_message', 'Profile Updated Successfully');

			redirect(base_url().'user/profile');
		}
	}

	function email_unique($email)
	{
		$result = $this->Users->getWhere('users', array('id !='=>$this->session->userdata('user_id'), 'email'=>$email, 'is_delete'=>1));

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

	function change_password()
	{
		if($_POST)
		{
			$current_password = $this->input->post('current_password');
			$new_password = $this->input->post('new_password');
			$confirm_password = $this->input->post('confirm_password');

			if($new_password != $confirm_password)
			{
				echo 3;
				exit;
			}
			else
			{
				$user_data = $this->Users->getSingle('users', array('id'=>$this->session->userdata('user_id')));

				if($user_data->password == md5($current_password))
				{
					$update_data = array('password'=>md5($new_password));

					$this->Users->update_data('users', array('id'=>$this->session->userdata('user_id')), $update_data);

					echo 1;
					exit;
				}
				else
				{
					echo 2;
					exit;
				}

			}
		}
		else
		{
			redirect(base_url());
		}

	}

	function change_profile_image()
	{
		if($_POST)
		{
			$image_url = $_REQUEST['imageData'];
			if(!empty($image_url))
			{
				$directory = 'uploads/user_images/';
				$file_name = 'user_'.time().'.jpg';

				$image_full_path = $directory.$file_name;
				
				$image_url = str_replace('data:image/png;base64,', '', $image_url);
				$image_url = str_replace(' ', '+', $image_url);
				$image_data = base64_decode($image_url);

				$success = file_put_contents($image_full_path, $image_data);

				/********Update Image **********/
					$update_data = array(
						'profile_image'=>$file_name,
						);
					$this->Users->update_data('users', array('id'=>$this->session->userdata('user_id')), $update_data);
				/********Update Image **********/


				$image_url_n = base_url().'uploads/user_images/'.$file_name;
				echo json_encode($image_url_n);
				exit;
			}
			else
			{
				echo 2;
				exit;
			}			

		}
		else
		{
			redirect(base_url());
		}
	}


	public function wallet()
	{
		$data['title'] = 'Wallet';

		$data['user_data'] = $this->Users->getSingle('users', array('id'=>$this->session->userdata('user_id')));

		$user_address = $this->Users->getSingle('users_eth_address', array('user_id'=>$this->session->userdata('user_id')));

		/*******Get User Balance**Start*******/
		$data['wallet_data'] = $this->ether->getBalance($user_address->address);
		$data['user_address'] = $user_address->address;

		/*******Get User Balance**End*******/

		$this->load->view('user/wallet', $data);
	}

	function send_token_request()
	{
		if($this->input->server('REQUEST_METHOD') !== 'POST')
		{
			$this->_response([
				'error' => true,
				'message' => 'Invalid request method'
			]);
		}

		$type = $this->input->post('type', true);


		/*********Get From Address Private Key Start**********/
		$user_address = $this->Users->getSingle('users_eth_address', array('user_id'=>$this->session->userdata('user_id')));
		$key = $user_address->privateKey;
		/*********Get From Address Private Key End**********/

		$to_address = _isAddress($this->input->post('token_address', true));

		if($to_address == false)
		{
			$this->_response([
				'error' => true,
				'message' => 'Invalid Address'
			]);
		}

		$amount = $this->input->post('amount', true);

		if($type == 1)
		{
			$currency_type = 'ETH';

			$response = $this->ether->doTransferEth($key, $this->input->post('token_address', true), $amount);
		}
		else
		{
			$currency_type = 'KWT';

			$response = $this->ether->doTransferKWT($key, $this->input->post('token_address', true), $amount);
		}

		if(isset($response->code))
		{
			$obj = json_decode($response->responseText);

			$this->_response([
				'error' => true,
				'message' => $obj->error->message
			]);
		}


		/*********Get To Address Data Start**********/
		$to_user_address = $this->Users->getSingle('users_eth_address', array('address'=>$this->input->post('token_address', true)));
		if(!empty($to_user_address))
		{
			$to_user = $to_user_address->user_id;
		}
		else
		{
			$to_user = 0;
		}
		/*********Get To Address Data End**********/

		$insert_data = array(
			'tx_hash'=>$response->hash,
			'from_user'=>$this->session->userdata('user_id'),
			'to_user'=>$to_user,
			'from_address'=>$user_address->address,
			'to_address'=>$this->input->post('token_address', true),
			'currency_type'=>$currency_type,			
			'by'=>'user',
			'amount'=>$amount,
			'status'=>'success',
			'created_datetime'=>date('Y-m-d H:i:s'),												
			);

		$this->Users->insert_data('transfer_history', $insert_data);

		if($type == 1)
		{		
			$this->_response([
				'error' => false,
				'message' => 'Successfully send ETH to address'
			]);
		}
		else
		{
			$this->_response([
				'error' => false,
				'message' => 'Successfully send KWT to address'
			]);			
		}

	}

function exchange_token_request()
	{
		if($this->input->server('REQUEST_METHOD') !== 'POST')
		{
			$this->_response([
				'error' => true,
				'message' => 'Invalid request method'
			]);
		}

		$type = $this->input->post('type', true);


		/*********Get From Address Private Key Start**********/
		$user_address = $this->Users->getSingle('users_eth_address', array('user_id'=>$this->session->userdata('user_id')));
		$key = $user_address->privateKey;
		$token_address = $this->config->item('contract_address');
		/*********Get From Address Private Key End**********/


		$amount = $this->input->post('amount', true);

		if($type == 1)
		{
			$currency_type = 'ETH';

			$response = $this->ether->doTransferEth($key, $token_address, $amount);
		}
		else
		{
			$currency_type = 'KWT';

			$response = $this->ether->doTransferKWT($key, $token_address, $amount);
		}

		if(isset($response->code))
		{
			$obj = json_decode($response->responseText);

			$this->_response([
				'error' => true,
				'message' => $obj->error->message
			]);
		}

		$insert_data = array(
			'tx_hash'=>$response->hash,
			'from_user'=>$this->session->userdata('user_id'),
			'to_user'=>0,
			'from_address'=>$user_address->address,
			'to_address'=>$token_address,
			'currency_type'=>$currency_type,			
			'by'=>'user',
			'amount'=>$amount,
			'status'=>'success',
			'created_datetime'=>date('Y-m-d H:i:s'),												
			);

		$this->Users->insert_data('transfer_history', $insert_data);

		if($type == 1)
		{		
			$this->_response([
				'error' => false,
				'message' => 'Successfully send ETH to address'
			]);
		}
		else
		{
			$this->_response([
				'error' => false,
				'message' => 'Successfully send KWT to address'
			]);			
		}

	}

	public function assets()
	{
		$data['title'] = 'Assets';
		$this->load->view('user/assets', $data);
	}

	public function history()
	{
			$data['title'] = 'History';


			if (!empty($_GET['offset'])) 
			{
				$offset = $_GET['offset'];
			} 
			else 
			{
				$offset = 0;
			} 

			$per_page = 10;

			$data['transfer_data'] = $this->Transfer_history->getTransferHistoryByUserID($this->session->userdata('user_id'), $offset, $per_page);
			$total_records = $this->Transfer_history->getTransferHistoryByUserIDCount($this->session->userdata('user_id'));



            $config['base_url'] = base_url() . 'user/history';
            $config['total_rows'] = $total_records;
            $config['per_page'] = $per_page;
            $config["uri_segment"] = 3;
			$config['query_string_segment'] = 'offset';
			$config['page_query_string'] = true;             
            // custom paging configuration
            $config['num_links'] = 4;
            $config['use_page_numbers'] = TRUE;
            $config['reuse_query_string'] = TRUE;
             

            $config['full_tag_open'] = '<ul class="pagination">';
            $config['full_tag_close'] = '</ul>';
            

            $config['first_link'] = 'First';
            $config['first_tag_open'] = '<li class="firstlink page-item">';
            $config['first_tag_close'] = '</li>';
             
            $config['last_link'] = 'Last';
            $config['last_tag_open'] = '<li class="lastlink page-item">';
            $config['last_tag_close'] = '</li>';
             
            $config['next_link'] = 'Next';
            $config['next_tag_open'] = '<li class="nextlink page-item">';
            $config['next_tag_close'] = '</li>';
 
            $config['prev_link'] = 'Prev';
            $config['prev_tag_open'] = '<li class="prevlink page-item">';
            $config['prev_tag_close'] = '</li>';
 
            $config['cur_tag_open'] = '<li class="active"><a href="#">';
            $config['cur_tag_close'] = '</a></li>';
 
            $config['num_tag_open'] = '<li class="numlink page-item">';
            $config['num_tag_close'] = '</li>';

            $this->pagination->initialize($config);
                 
            // build paging links
            $data["links"] = $this->pagination->create_links();

		$this->load->view('user/history', $data);
	}

}
