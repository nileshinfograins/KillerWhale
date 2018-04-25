<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    function __construct() 
    {
		parent::__construct();
		$this->load->library('form_validation');

		/*****loading model*/
		$this->load->model('Users');
		$this->load->helper('cookie');

		$this->load->helper('security'); 

		$this->load->library('email');

		$this->load->helper('string'); 

		$this->load->library('ether');
    }

	public function index()
	{
		$this->load->view('home');
	}

	public function thanks()
	{
		if(!$this->session->flashdata('success_payment'))
		{
			redirect(base_url());
		}
		$data['message'] = $this->session->flashdata('success_payment');
		$this->load->view('thanks', $data);

	}	

	public function team()
	{
		$this->load->view('team');
	}
}
