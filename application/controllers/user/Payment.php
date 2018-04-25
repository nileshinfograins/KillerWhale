<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends CI_Controller {

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

	public function paypal()
	{
		if($this->input->server('REQUEST_METHOD') !== 'POST')
		{
			$this->session->set_flashdata('error_message','There is an error to send request');
			redirect(base_url().'killer_token_sale');
		}
		$data['amount'] = $this->input->post('paypal_amount', true);

		$insert_data = array(
			'user_id'=>$this->session->userdata('user_id'),
			'amount'=>$this->input->post('paypal_amount', true),
			'tokens'=>$this->input->post('total_token', true),
			'payment_by'=>'paypal',
			'status'=>'pending',
			'created_datetime'=>date('Y-m-d H:i:s'),
			'updated_datetime'=>date('Y-m-d H:i:s')
			);

		$insert_id = $this->Users->insert_data('token_sale_history', $insert_data);

		$data['transaction_id'] = $insert_id;

		$this->session->set_flashdata('success_message','Your payment has been successfully completed');
		$this->load->view('payment_paypal', $data);

	}

	function success_payment()
	{
		if(!$this->session->flashdata('success_message'))
		{
			redirect(base_url());
		}

		$id = $this->uri->segment(3);

		$transaction_data = $this->Users->getSingle('token_sale_history', array('transaction_id'=>$this->input->get('tx')));

		if($transaction_data)
		{
			redirect(base_url());
		}

		$transaction_data_n = $this->Users->getSingle('token_sale_history', array('id'=>$id));

		/*******Transfer ether to user address Start*********/
			/*********Get From Address Private Key Start**********/
			$key = $this->config->item('contract_pvtKey'); // Admin contract private key


			$user_address = $this->Users->getSingle('users_eth_address', array('user_id'=>$this->session->userdata('user_id')));
			$token_address = $user_address->address;
			/*********Get From Address Private Key End**********/		

			$response = $this->ether->doTransferKWT($key, $token_address, $transaction_data_n->tokens);
			
		/*******Transfer ether to user address End*********/

		/*******Referral Earning ***Start*****/
			$this->referral_earning($key, $transaction_data_n->tokens);
		/*******Referral Earning ***End*****/

		$where = array('id'=>$id);
		$update_data = array('transaction_id'=>$this->input->get('tx'), 'tx_hash'=>$response->hash, 'status'=>'complete');
		$this->Users->update_data('token_sale_history', $where, $update_data);

		$this->session->set_flashdata('success_payment','You have successfully purchased tokens.');
		redirect(base_url().'thanks');

	}

	private function referral_earning($key, $token)
	{
		/*******Level percantage **Start******/
		$referral_level = $this->Users->getSingle('referral_setting', array('id'=>1));
		$first_level_perct =  $referral_level->first_level;
		$second_level_perct =  $referral_level->second_level;
		$third_level_perct =  $referral_level->third_level;
		/*******Level percantage **End******/

		/*******First Level Referral System***Start******/
		$user_data = $this->Users->getSingle('users', array('id'=>$this->session->userdata('user_id')));

		if(!empty($user_data->refer_by))
		{
			$first_level_token = ($token * $first_level_perct)/100;

			$first_user_data = $this->Users->getSingle('users', array('referral_code'=>$user_data->refer_by));
			$first_user_address = $this->Users->getSingle('users_eth_address', array('user_id'=>$first_user_data->id));
			$first_token_address = $first_user_address->address;	

			$response1 = $this->ether->doTransferKWT($key, $first_token_address, $first_level_token);

			$insert_data1 = array(
				'user_id'=>$this->session->userdata('user_id'),
				'referral_user_id'=>$first_user_data->id,
				'percantage'=>$first_level_perct,
				'token'=>$first_level_token,
				'tx_hash'=>$response1->hash,
				'created_datetime'=>date('Y-m-d H:i:s'),
				'updated_datetime'=>date('Y-m-d H:i:s'),
				);

			$this->Users->insert_data('referral_earning', $insert_data1);

			/*********Update User referral Earning *Start*********/
			$query1 = "update users set referral_earning = referral_earning + $first_level_token where id = '".$first_user_data->id."'";
			$this->db->query($query1);
			/*********Update User referral Earning *End*********/

		}

		if(!empty($first_user_data->refer_by))
		{	
			$second_level_token = ($token * $second_level_perct)/100;

			$second_user_data = $this->Users->getSingle('users', array('referral_code'=>$first_user_data->refer_by));
			$second_user_address = $this->Users->getSingle('users_eth_address', array('user_id'=>$second_user_data->id));
			$second_token_address = $second_user_address->address;	

			$response2 = $this->ether->doTransferKWT($key, $second_token_address, $second_level_token);

			$insert_data2 = array(
				'user_id'=>$this->session->userdata('user_id'),
				'referral_user_id'=>$second_user_data->id,
				'percantage'=>$second_level_perct,
				'token'=>$second_level_token,
				'tx_hash'=>$response2->hash,
				'created_datetime'=>date('Y-m-d H:i:s'),
				'updated_datetime'=>date('Y-m-d H:i:s'),
				);

			$this->Users->insert_data('referral_earning', $insert_data2);

			/*********Update User referral Earning *Start*********/
			$query2 = "update users set referral_earning = referral_earning + $second_level_token where id = '".$second_user_data->id."'";
			$this->db->query($query2);
			/*********Update User referral Earning *End*********/


		}

		if(!empty($second_user_data->refer_by))
		{	
			$third_level_token = ($token * $third_level_perct)/100;

			$third_user_data = $this->Users->getSingle('users', array('referral_code'=>$second_user_data->refer_by));
			$third_user_address = $this->Users->getSingle('users_eth_address', array('user_id'=>$third_user_data->id));
			$third_token_address = $third_user_address->address;	

			$response3 = $this->ether->doTransferKWT($key, $third_token_address, $third_level_token);

			$insert_data3 = array(
				'user_id'=>$this->session->userdata('user_id'),
				'referral_user_id'=>$third_user_data->id,
				'percantage'=>$third_level_perct,
				'token'=>$third_level_token,
				'tx_hash'=>$response3->hash,
				'created_datetime'=>date('Y-m-d H:i:s'),
				'updated_datetime'=>date('Y-m-d H:i:s'),
				);

			$this->Users->insert_data('referral_earning', $insert_data3);

			/*********Update User referral Earning *Start*********/
			$query3 = "update users set referral_earning = referral_earning + $third_level_token where id = '".$third_user_data->id."'";
			$this->db->query($query3);
			/*********Update User referral Earning *End*********/

		}

		/*******First Level Referral System***End******/

	}

	function cancel_payment()
	{
		if(!$this->session->flashdata('success_message'))
		{
			redirect(base_url());
		}

		$id = $this->uri->segment(3);
		$where = array('id'=>$id);
		$update_data = array('status'=>'cancel');
		$this->Users->update_data('token_sale_history', $where, $update_data);

		$this->session->set_flashdata('success_payment','Your payment has been cancelled successfully.');

		redirect(base_url().'thanks');
	}

	function stripe_payment()
	{
		//check whether stripe token is not empty
		if(!empty($_POST['stripeToken']))
		{
			//get token, card and user info from the form
			$token  = $this->input->post('stripeToken', true);
			$name = $this->input->post('owner_name', true);
			$email = $this->input->post('email', true);
			$card_num = $this->input->post('card_num', true);
			$card_cvc = $this->input->post('cvc', true);
			$card_exp_month = $this->input->post('exp_month', true);
			$card_exp_year = $this->input->post('exp_year', true);
			
			//include Stripe PHP library
			require_once APPPATH."third_party/stripe/init.php";
			
			$stripe = array(
			  "secret_key"      => "sk_test_yqjGivoKr6zT6sDFURfr9tzV",
			  "publishable_key" => "pk_test_5SnhsenFVTkoWAH6QoWCqYHM"
			);

			\Stripe\Stripe::setApiKey($stripe['secret_key']);
			
			//add customer to stripe
			$customer = \Stripe\Customer::create(array(
				'email' => $email,
				'source'  => $token
			));
			
			$total_token = $this->input->post('stripe_total_token', true);
			$amount = $this->input->post('stripe_amount', true);

			//item information
			$itemName = "Token";
			$itemNumber = $total_token;
			$itemPrice = (int)($amount*100);
			$currency = "usd";

			if($itemPrice < 50)
			{
					//$this->session->set_flashdata('success_payment',' Token');
					redirect(base_url());
			}
			
			//charge a credit or a debit card
			$charge = \Stripe\Charge::create(array(
				'customer' => $customer->id,
				'amount'   => $itemPrice,
				'currency' => $currency,
				'description' => $itemNumber,
				'metadata' => array(
					'item_id' => $itemNumber
				)
			));
			
			//retrieve charge details
			$chargeJson = $charge->jsonSerialize();

			//check whether the charge is successful
			if($chargeJson['amount_refunded'] == 0 && empty($chargeJson['failure_code']) && $chargeJson['paid'] == 1 && $chargeJson['captured'] == 1)
			{
				//order details 
				$amount_tx = $chargeJson['amount'];
				$balance_transaction = $chargeJson['balance_transaction'];
				$currency = $chargeJson['currency'];
				$status = $chargeJson['status'];
				$date = date("Y-m-d H:i:s");
			
				if($status == 'succeeded')
				{

					/*******Transfer ether to user address Start*********/
					/*********Get From Address Private Key Start**********/
					$key = $this->config->item('contract_pvtKey'); // Admin contract private key


					$user_address = $this->Users->getSingle('users_eth_address', array('user_id'=>$this->session->userdata('user_id')));
					$token_address = $user_address->address;
					/*********Get From Address Private Key End**********/		

					$response = $this->ether->doTransferKWT($key, $token_address, $total_token);

					/*******Transfer ether to user address End*********/

					$insert_data = array(
						'transaction_id'=>$balance_transaction,
						'user_id'=>$this->session->userdata('user_id'),
						'amount'=>$amount,
						'tokens'=>$total_token,
						'tx_hash'=>$response->hash,
						'payment_by'=>'stripe',
						'status'=>'complete',
						'created_datetime'=>date('Y-m-d H:i:s'),
						'updated_datetime'=>date('Y-m-d H:i:s')
						);
					$this->Users->insert_data('token_sale_history', $insert_data);

					/*******Referral Earning ***Start*****/
					$this->referral_earning($key, $total_token);
					/*******Referral Earning ***End*****/					

					$this->session->set_flashdata('success_payment','You have successfully purchased tokens.');
					redirect(base_url().'thanks');

				}
				else
				{
					$this->session->set_flashdata('success_payment','Your transaction has been failed.');
					redirect(base_url().'thanks');
				}

			}
			else
			{
					$this->session->set_flashdata('success_payment','Invalid Token');
					redirect(base_url().'thanks');
			}
		}		
	}

}
