<?php

class Login_register_model extends CI_Model {

	function __construct() {
        parent::__construct();
    }

	public function check_login_credentials($email, $password) {
		if($this->check_if_user_exists($email)) {
			$this->db->select('id, email, password');
			$this->db->from('users');
			$this->db->where('email = ' . "'" . $email . "'");
			$this->db->limit(1);

			$query = $this->db->get();

			if($query->num_rows() == 1) {
		    	if($password == $this->encrypt->decode($query->row()->password)) {
		    		$this->session->set_userdata(array(
		    			'user_id' => $query->row()->id,
		    			'logged_in' => true
		    		));
		    		return true;
		    	} else {
		    		return false;
		    	}
			} else {
		    	return false;
			}
		} else {
			return false;
		}
	}

	public function register_user($personals) {
		if(!$this->check_if_user_exists($personals['email'])) {
			if($personals['password'] == $personals['password_confirm']) {
				unset($personals['password_confirm']);
				$personals['password'] = $this->encrypt->encode($personals['password']);
				$personals['user_type'] = 4;
				$personals['date_created'] = time();
				$this->db->insert('users', $personals);
				$this->session->set_userdata(array(
					'user_id' => $this->db->insert_id(),
					'logged_in' => true
				));
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	public function check_if_user_exists($email) {
		$this->db->select('email');
		$this->db->from('users');
		$this->db->where('email = ' . "'" . $email . "'");
		$this->db->limit(1);

		$query = $this->db->get();

		if($query->num_rows() == 1) {
			return true;
		} else {
			return false;
		}
	}

	public function set_last_login() {
		$this->db->update('users', array(
			'last_login' => time()
		), array(
			'id' => $this->session->userdata('user_id')
		));
	}

}