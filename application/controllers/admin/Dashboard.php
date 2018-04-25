<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    function __construct() 
    {
			parent::__construct();

			/****checks it is login or not start****/
				_is_admin_login();
			/****checks it is login or not End****/
			$this->config->load('admin');

			$this->load->library('form_validation');
			$this->load->library('pagination');
			$this->load->model('Users');
			$this->load->model('Transfer_history');
			$this->load->library('ether');
    }

    
    function _response($data)
    {
    	echo json_encode($data);
    	exit;
    }

	public function index()
	{
		$data['title'] = 'Wallet';

		/*******Get User Balance**Start*******/
		$data['user_count'] = $this->Users->getAllUsersCount();

		$data['wallet_data'] = $this->ether->getBalance($this->config->item('admin_wallet_address'));
		$data['user_address'] = $this->config->item('admin_wallet_address');

		/*******Get User Balance**End*******/

		$this->load->view('admin/wallet', $data);		
	}

	public function user_management($offset = 0)
	{
			$data['title'] = 'User Management';


			$per_page = 10;

			$data['user_data'] = $this->Users->getAllUsers($offset, $per_page);
			$total_records = $this->Users->getAllUsersCount();


			$config = [
			'base_url' => base_url('admin/user_management'),
			'per_page' => $per_page,
			'total_rows' => $total_records,
			'full_tag_open' => '<ul class="pagination">',
			'full_tag_close' => '</ul>',
			'next_tag_open' => '<li>',
			'next_tag_close' => '</li>',
			'prev_tag_open' => '<li>',
			'prev_tag_close' => '</li>',
			'num_tag_open' => '<li>',
			'num_tag_close' => '</li>',
			'first_tag_open' => '<li>',
			'first_tag_close' => '</li>',
			'last_tag_open' => '<li>',
			'last_tag_close' => '</li>',
			'cur_tag_open' => '<li class="active"><a href="#">',
			'cur_tag_close' => '</a></li>',
		];

            $this->pagination->initialize($config);
                 
            // build paging links
            $data["links"] = $this->pagination->create_links();

		$this->load->view('admin/user_list', $data);
	}

	function delete_user()
	{
		if($_POST)
		{
			$id = $this->input->post('id');

			$where = array('id'=>$id);
			$update_data = array('is_delete'=>0);
			$this->Users->update_data('users', $where, $update_data);

			$this->_response([
				'error' => false,
				'message' => 'User deleted successfully'
			]);	

		}
		else
		{
			redirect(base_url());
		}
	}	


	function change_user_status()
	{
		if($_POST)
		{
			$id = $this->input->post('id');

			$user_data = $this->Users->getSingle('users', array('id'=>$id));

			if($user_data->status == 1)
			{
				$status = 0;
			}
			else
			{
				$status = 1;
			}	

			$where = array('id'=>$id);
			$update_data = array('status'=>$status);
			$this->Users->update_data('users', $where, $update_data);

			$this->_response([
				'error' => false,
				'message' => 'Status changed successfully',
				'status' => $status
			]);	

		}
		else
		{
			redirect(base_url());
		}
	}
	public function profile()
	{
		$data['title'] = 'My Profile';

		$this->form_validation->set_rules('username', 'User Name', 'required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');

		$data['admin_data'] = $this->Users->getSingle('admin_login', array('id'=>1));

		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('admin/my_profile', $data);
		}
		else
		{
			$username = $this->input->post('username', true);
			$email = $this->input->post('email', true);

			$update_data = array(
				'username'=>$username,
				'email'=>$email,
				'modified_datetime'=>date('Y-m-d H:i:s'),
				);

			$this->Users->update_data('admin_login', array('id'=>1), $update_data);

			$this->session->set_flashdata('error_message', 'Profile Updated Successfully');

			redirect(base_url().'admin/profile');
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

				$this->_response([
					'error' => true,
					'message' => 'New password and confirm password doesn\'t match',
				]);	

			}
			else
			{
				$user_data = $this->Users->getSingle('admin_login', array('id'=>1));

				if($user_data->password != md5($current_password))
				{
					$this->_response([
						'error' => true,
						'message' => 'Please enter correct old password.',
					]);	

				}

				$update_data = array('password'=>md5($new_password));

				$this->Users->update_data('admin_login', array('id'=>1), $update_data);

				$this->_response([
					'error' => false,
					'message' => 'Password changed successfully.',
				]);	

			}
		}
		else
		{
			redirect(base_url());
		}
	}

	public function history($offset = 0)
	{
		$data['title'] = 'Transfer History';

		$per_page = 10;

		$data['transfer_data'] = $this->Transfer_history->getAllTransferHistory($this->config->item('admin_wallet_address'), $offset, $per_page);
		$total_records = $this->Transfer_history->getAllTransferHistoryCount($this->config->item('admin_wallet_address'));

        $config = [
			'base_url' => base_url('admin/history'),
			'per_page' => $per_page,
			'total_rows' => $total_records,
			'full_tag_open' => '<ul class="pagination">',
			'full_tag_close' => '</ul>',
			'next_tag_open' => '<li>',
			'next_tag_close' => '</li>',
			'prev_tag_open' => '<li>',
			'prev_tag_close' => '</li>',
			'num_tag_open' => '<li>',
			'num_tag_close' => '</li>',
			'first_tag_open' => '<li>',
			'first_tag_close' => '</li>',
			'last_tag_open' => '<li>',
			'last_tag_close' => '</li>',
			'cur_tag_open' => '<li class="active"><a href="#">',
			'cur_tag_close' => '</a></li>',
		];

        $this->pagination->initialize($config);
             
        // build paging links
        $data["links"] = $this->pagination->create_links();

	$this->load->view('admin/history', $data);
	}	

	public function user_history()
	{
		if(!$this->uri->segment(3))
		{
			redirect(base_url().'admin/dashboard');
		}

		$user_data = $this->Users->getSingle('users', array('id'=>$this->uri->segment(3)));

		if(empty($user_data))
		{
			redirect(base_url().'admin/dashboard');
		}		


		$data['title'] = 'User Transfer History';

		$data['user_id'] = $this->uri->segment(3);

		if (!empty($_GET['offset'])) 
		{
			$offset = $_GET['offset'];
		} 
		else 
		{
			$offset = 0;
		} 

		$per_page = 10;

		$data['transfer_data'] = $this->Transfer_history->getTransferHistoryByUser($this->uri->segment(3), $offset, $per_page);
		$total_records = $this->Transfer_history->getTransferHistoryByUserCount($this->uri->segment(3));

        $config['base_url'] = base_url() . 'admin/user_history/'.$this->uri->segment(3);
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

	$this->load->view('admin/user_history', $data);
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
		$key = $this->config->item('contract_pvtKey');
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
			'from_user'=>0,
			'to_user'=>$to_user,
			'from_address'=>$this->config->item('admin_wallet_address'),
			'to_address'=>$this->input->post('token_address', true),
			'currency_type'=>$currency_type,			
			'by'=>'admin',
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

	public function referral_setting()
	{
		$data['title'] = 'Referral Setting';

		$this->form_validation->set_rules('level_one_percentage', 'First Level', 'required');
		$this->form_validation->set_rules('level_second_percentage', 'Second Level', 'required');
		$this->form_validation->set_rules('level_third_percentage', 'THird Level', 'required');

		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');

		$data['referral_data'] = $this->Users->getSingle('referral_setting', array('id'=>1));

		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('admin/referral_setting', $data);
		}
		else
		{
			$level_one_percentage = $this->input->post('level_one_percentage', true);
			$level_second_percentage = $this->input->post('level_second_percentage', true);
			$level_third_percentage = $this->input->post('level_third_percentage', true);

			$update_data = array(
				'first_level'=>$level_one_percentage,
				'second_level'=>$level_second_percentage,
				'third_level'=>$level_third_percentage,
				'created_datetime'=>date('Y-m-d H:i:s'),
				'updated_datetime'=>date('Y-m-d H:i:s'),
				);

			$this->Users->update_data('referral_setting', array('id'=>1), $update_data);

			$this->session->set_flashdata('error_message', 'Updated Successfully');

			redirect(base_url().'admin/referral_setting');
		}
	}


	public function wallet()
	{
		if(!$this->uri->segment(3))
		{
			redirect(base_url().'admin');
		}

		$user_id = $this->uri->segment(3);

		$data['title'] = 'User Wallet';

		$data['user_data'] = $this->Users->getSingle('users', array('id'=>$user_id));

		$userdata_address = $this->Users->getSingle('users_eth_address', array('user_id'=>$user_id));

		$data['admin_wallet_data'] = $this->ether->getBalance($this->config->item('admin_wallet_address'));

		/*******Get User Balance**Start*******/
		$data['wallet_data'] = $this->ether->getBalance($userdata_address->address);
		$data['user_address'] = $userdata_address->address;

		/*******Get User Balance**End*******/

		$this->load->view('admin/user_wallet', $data);		

	}



}
