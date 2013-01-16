<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Resolution extends CI_Controller {

	function __construct() {
		parent::__construct();
		if(!$this->session->userdata('user_id')) {
			$this->session->set_flashdata('msg', 'You must be logged in.');
			redirect(base_url());
		}
		$this->load->model('resolutions_model');
	}

	public function index() {
		$this->load->view('resolutions/home', array(
			'goals' => $this->resolutions_model->goals()
		));
	}

	public function create($parent_id = false) {
		$goal_vars['title'] = 'New Goal';
		$goal_vars['goal'] = '';
		$goal_vars['source'] = 'create';
		$goal_vars['goals'] = $this->resolutions_model->goals();
		if($parent_id !== false) {
			$goal_vars['title'] = 'New Sub Goal';
			$goal_vars['parent'] = $parent_id;
		}
		$this->load->view('resolutions/goal', $goal_vars);
	}

	public function edit($goal_id, $parent_id = false) {
		$this->load->view('resolutions/goal', array(
			'title' => 'Edit Goal',
			'goal' => $this->resolutions_model->goal_lookup($goal_id),
			'goals' => $this->resolutions_model->goals(),
			'source' => 'edit',
			'parent' => $parent_id
		));
	}

	public function save($goal_id = false) {
		$goal = array(
			'name' => $_POST['name'],
			'description' => $_POST['description'],
			'date_deadline' => strtotime($_POST['deadline']),
			'date_created' => time(),
			'goal_type' => '0',
			'status' => '1'
		);

		$sub = false;
		if(!empty($_POST['parent'])) {
			$goal['parent'] = $_POST['parent'];
			$goal['goal_type'] = 1;
			$sub = true;
		}

		if($goal_id == false) {
			$saved = $this->resolutions_model->save_new_goal($goal, $sub);
		} else {
			$saved = $this->resolutions_model->save_edit_goal($goal_id, $goal, $sub);
		}

		$this->session->set_flashdata('msg', (($saved) ? 'Your resolution has been saved.' : 'There was an error saving your resolution.'));
		redirect(base_url() . 'resolution');
	}

	public function complete($goal_id) {
		$this->resolutions_model->complete_goal($goal_id);
		$this->session->set_flashdata('msg', 'Congratulations! You have completed a goal!');
		redirect(base_url() . 'resolution');
	}

	public function delete($goal_id, $parent_id = false) {
		$this->resolutions_model->delete_resolution($goal_id, $parent_id);
		$this->session->set_flashdata('msg', 'Resolution deleted.');
		redirect(base_url() . 'resolution');
	}

}