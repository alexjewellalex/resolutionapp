<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Initialize extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('login_register_model');
		// $this->load->model('connect_model');
	}

	public function index() {
		if($this->session->userdata('user_id')) {
			redirect(base_url() . 'resolution');
		} else {
			$this->load->view('ini/login');
		}
	}

	public function do_login() {
		if($this->login_register_model->check_login_credentials($_POST['email'], $_POST['password'])) {
			$this->login_register_model->set_last_login();
			redirect(base_url('resolution'));
		} else {
			$this->session->set_flashdata('msg', 'Login failed. Check your credentials.');
			redirect(base_url());
		}
	}

	public function register() {
		$this->load->view('ini/register');
	}

	public function do_register() {
		$empty_fields = 0;
		$personals = array(
			'name' => $_POST['name'],
			'email' => $_POST['email'],
			'password' => $_POST['password'],
			'password_confirm' => $_POST['password_confirm']
		);
		foreach($personals as $field => $value) { // move this to a model at some point
			if(empty($value)) {
				$empty_fields++;
			}
		}
		if($empty_fields == 0) {
			if($this->login_register_model->register_user($personals)) {
				redirect(base_url('resolution'));
			} else {
				$this->set_flashdata('msg', 'User exists. Try a different email address.');
				redirect(base_url() . 'initialize/register');
			}
		} else {
			$this->set_flashdata('msg', 'Please complete all fields.');
			redirect(base_url() . 'initialize/register');
		}
	}

	public function connect() {
		$this->load->view('ini/connect');
	}

	public function logout() {
		$this->session->sess_destroy();
		$this->session->set_flashdata('msg', 'Logged out.');
		redirect(base_url());
	}

}