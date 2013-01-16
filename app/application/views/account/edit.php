<?php $this->load->view('front/top'); ?>

<h3>Edit Account</h3>

<?= form_open('account/save') ?>
<?= 
	form_input(array(
		'name' => 'name',
		'value' => (!empty($user->name) ? $user->name : '' ),
		'placeholder' => 'FULL NAME'
	)) . '<br />' .
	form_input(array(
		'name' => 'email',
		'value' => (!empty($user->email) ? $user->email : '' ),
		'placeholder' => 'EMAIL ADDRESS'
	)) . '<br />'
?>
<a class="btn btn-danger" href="<?= base_url() . 'account' ?>">Cancel</a>&nbsp;&nbsp;
<?= form_submit(array(
	'type' => 'submit', 
	'value' => 'Save',
	'class' => 'btn btn-inverse'
)) ?>
<?= form_close() ?>

<?php $this->load->view('front/bottom'); ?>