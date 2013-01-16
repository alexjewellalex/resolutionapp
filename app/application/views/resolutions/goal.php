<?php $this->load->view('front/top'); ?>

<h3><?= $title ?></h3>
<?= ($this->session->flashdata('msg') ? '<div class="alert"><p>'.$this->session->flashdata('msg').'</p></div>' : ''); ?>

<?php 

$parents_arr = array(
	'' => 'NO PARENT GOAL'
);
if($goals) {
	foreach($goals as $a_goal) {
		if($a_goal->goal_type !== 1) {
			$parents_arr[$a_goal->id] = $a_goal->name;
		}
	}
}

?>

<?= form_open('resolution/save/' . (!empty($goal->id) ? $goal->id : '')) ?>
<?= 
	form_input(array(
		'name' => 'name',
		'value' => (!empty($goal->name) ? $goal->name : '' ),
		'placeholder' => 'GOAL NAME'
	)) . '<br />' .
	form_input(array(
		'name' => 'description', 
		'value' => (!empty($goal->description) ? $goal->description : '' ),
		'placeholder' => 'OPT. DESCRIPTION'
	)) . '<br />' .
	form_input(array(
		'name' => 'deadline', 
		'value' => (!empty($goal->date_deadline) ? date('m/d/Y', $goal->date_deadline) : '' ),
		'placeholder' => 'DEADLINE',
		'class' => 'datepicker'
	)) . '<br />'
?>
<?= form_dropdown('parent', $parents_arr, ((!empty($parent)) ? $parent : '')) . '<br />' ?>
<a class="btn btn-danger" href="<?= base_url() ?>">Cancel</a>&nbsp;&nbsp;
<?= form_submit(array(
	'type' => 'submit', 
	'value' => ($source == 'create') ? 'Create' : 'Save',
	'class' => 'btn btn-inverse'
)) ?>
<?= form_close() ?>

<?php $this->load->view('front/bottom'); ?>