<?php

class Resolutions_model extends CI_Model {

	function __construct() {
        parent::__construct();
    }

    public function goals() {
        $query = $this->db->query('
            SELECT DISTINCT
              resolutions.* 
            FROM 
              `users`,  
              `resolutions_users` 
              INNER JOIN `resolutions`  
                  ON (`resolutions_users`.`resolution_id` = `resolutions`.`id`) 
            WHERE 
              resolutions_users.user_id = ' . $this->session->userdata('user_id'));
        $goals = false;
        if($query->num_rows() > 0) {
            $goals = $query->result();
            foreach($goals as $goal_id => $goal) {
                $goals[$goal_id]->subs = $this->subs_lookup($goal->id);
            }
        }
        return $goals;
    }

    public function goal_lookup($goal_id) {
    	$query = $this->db->get_where('resolutions', array(
    		'id' => $goal_id
    	));
        return ($query->num_rows() > 0) ? $query->row() : false;
    }

    public function subs_lookup($goal_id) {
        $subs = false;
        $query = $this->db->get_where('sub_resolutions', array('resolution_id' => $goal_id));
        if($query->num_rows() > 0) {
            $subs = array();
            foreach($query->result() as $subgoal) {
                $subs[] = $this->goal_lookup($subgoal->sub_resolution_id);
            }
        }
        return $subs;
    }

    public function save_new_goal($fields, $is_sub = false) {
    	$saved = false;
    	if(!empty($fields['parent'])) {
    		$parent_id = $fields['parent'];
    		unset($fields['parent']);
    	}
    	$saved = ($this->db->insert('resolutions', $fields)) ? true : false;
    	$saved_id = $this->db->insert_id();
        if(!$is_sub) {
            $saved = ($this->connect_resolution_user($saved_id, $this->session->userdata('user_id'))) ? true : false;
        }
    	if($is_sub && $saved) {
    		$saved = ($this->save_sub($parent_id, $saved_id)) ? true : false;
    	}
    	return $saved;
    }

    public function connect_resolution_user($resolution_id, $user_id) {
        return ($this->db->insert('resolutions_users', array(
            'resolution_id' => $resolution_id,
            'user_id' => $user_id
        ))) ? true : false;
    }

    public function save_edit_goal($goal_id, $fields, $is_sub = false) {
        $saved = false;
        if(!empty($fields['parent'])) {
            $parent_id = $fields['parent'];
            unset($fields['parent']);
        }
        $saved = ($this->db->update('resolutions', $fields, array('id' => $goal_id))) ? true : false;
        if($this->sub_exists($goal_id)) {
            $this->remove_sub($goal_id);
        }
        if($is_sub && $saved) {
            $saved = ($this->save_sub($parent_id, $saved_id)) ? true : false;
        }
        return $saved;
    }

    public function save_sub($parent_id, $sub_id, $is_new = true) {
    	$saved = false;
    	if($is_new) {
    		$saved = ($this->db->insert('sub_resolutions', array(
    			'resolution_id' => $parent_id,
    			'sub_resolution_id' => $sub_id
    		))) ? true : false;
    	} else {
    		$saved = ($this->db->where('sub_resolution_id', $sub_id)->update('sub_resolutions', array(
    			'resolution_id' => $parent_id
    		))) ? true : false;
    	}
    	return $saved;
    }

    public function sub_exists($sub_id) {
        $query = $this->db->get_where('sub_resolutions', array(
            'sub_resolution_id' => $sub_id
        ));
        return ($query->num_rows() > 0) ? true : false;
    }

    public function remove_sub($sub_id) {
        $query = $this->db->delete('sub_resolutions', array(
            'sub_resolution_id' => $sub_id
        ));
    }

    public function remove_all_subs($parent_id) {
        $this->db->delete('sub_resolutions', array(
            'resolution_id' => $parent_id
        ));
    }

    public function delete_resolution($goal_id, $parent_id) {
        $this->db->delete('resolutions', array(
            'id' => $goal_id
        ));
        if($parent_id) {
            $this->remove_sub($goal_id);
        } else {
            $this->disconnect_resolution_user($goal_id);
            $this->remove_all_subs($goal_id);
        }
    }

    public function disconnect_resolution_user($goal_id) {
        $this->db->delete('resolutions_users', array(
            'resolution_id' => $goal_id,
            'user_id' => $this->session->userdata('user_id')
        ));
    }


    public function complete_goal($goal_id) {
        $this->db->update('resolutions', array('status' => '0'), array('id' => $goal_id));
    }

}