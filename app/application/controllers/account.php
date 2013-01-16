<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends CI_Controller {

	function __construct() {
		parent::__construct();
		if(!$this->session->userdata('user_id')) {
			$this->session->set_flashdata('msg', 'You must be logged in.');
			redirect(base_url());
		}
		$this->load->model('account_model');
	}

	public function index() {
		$this->load->view('account/home', array(
			'user' => $this->account_model->info()
		));
	}

	public function edit() {
		$this->load->view('account/edit', array(
			'user' => $this->account_model->info()
		));
	}

	public function save() {
		$this->account_model->save_account(array(
			'name' => $_POST['name'],
			'email' => $_POST['email']
		));
		$this->session->set_flashdata('msg', 'Account information saved.');
		redirect(base_url() . 'account');
	}

	public function change_password() {
		$this->load->view('account/password', array(
			'user' => $this->account_model->info()
		));
	}

	public function save_password() {
		$this->session->set_flashdata('msg', (($this->account_model->change_password(array(
			'curr_password' => $this->account_model->info()->password,
			'old_password' => $_POST['old_password'],
			'new_password' => $_POST['new_password'],
			'confirm_new_password' => $_POST['confirm_new_password']
		))) ? 'Password Changed' : 'Error changing password.'));
		redirect(base_url() . 'account');
	}

}