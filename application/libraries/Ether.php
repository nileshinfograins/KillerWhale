<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//User mail send library
class Ether {

	private $CI,
			$Api;

	public function __construct()
	{
		$this->CI = & get_instance();
		$this->Api = 'http://infograins.in:4100';
		$this->CI->load->model('Users');
	}

	//Function to create a new ether wallet address
	public function createAddress($userID)
	{
		$address = $this->_callApi('/create');

		$ip = $this->CI->input->ip_address();

		if( $address !== FALSE )
		{
			$this->CI->Users->insert_data('users_eth_address', [
				'user_id' => $userID,
				'type' => 'eth',
				'address' => $address->address,
				'privateKey' => $address->privateKey,
				'address_json' => json_encode($address),
				'created_date' => date('Y-m-d H:i:s'),
				'created_ip' => $ip
			]);

			return TRUE;
		}

		return FALSE;
	}

	//Function to get balance
	//Using ether address of user
	//@return object
	public function getBalance($addr)
	{
		return $this->_callApi("/balance/{$addr}");
	}

	//Function to transfer token from address to address
	//Using ether address of user
	//@return object
	public function doTransferKWT($key, $addr, $amount)
	{
		return $this->_callApi("/kittx/{$key}/{$addr}/{$amount}");
	}

	//Function to transfer token from main address
	//Using ether address of user
	//@return object
	public function doTransferEth($key, $addr, $amount)
	{
		return $this->_callApi("/ethtx/{$key}/{$addr}/{$amount}");
	}

	//Function call api using curl
	private function _callApi($url, $data = [])
	{
		$curl = curl_init($this->Api . $url);

		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		//curl_setopt($curl, CURLOPT_POST, true);
		//curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

		$curl_response = curl_exec($curl);

		if ($curl_response === false)
		{
		    $info = curl_getinfo($curl);
		    curl_close($curl);

		    return FALSE;
		}

		curl_close($curl);

		return json_decode($curl_response);
	}
}
