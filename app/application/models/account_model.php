<?php

class Account_model extends CI_Model {

	function __construct() {
        parent::__construct();
    }

    public function info() {
    	$query = $this->db->get_where('users', array(
    		'id' => $this->session->userdata('user_id')
    	));
    	return ($query->num_rows() > 0) ? $query->row() : false;
    }

    public function save_account($fields) {
    	return ($this->db->update('users', array(
    		'name' => $fields['name'],
    		'email' => $fields['email']
    	), array(
    		'id' => $this->session->userdata('user_id')
    	))) ? true : false;
    }

    public function change_password($fields) {
    	if($fields['new_password'] == $fields['confirm_new_password']) {
    		if($this->encrypt->decode($fields['curr_password']) == $fields['old_password']){
    			return $this->db->update('users', array(
    				'password' => $this->encrypt->encode($fields['new_password'])
    			));
    		} else {
    			return false;
    		}
    	} else {
    		return false;
    	}
    }

}