<?php $this->load->view('front/top'); ?>

<h3>Change Password</h3>

<?= form_open('account/save_password') ?>
<?= 
	form_password(array(
		'name' => 'old_password',
		'placeholder' => 'CURRENT PASSWORD'
	)) . '<br />' .
	form_password(array(
		'name' => 'new_password',
		'placeholder' => 'NEW PASSWORD'
	)) . '<br />' .
	form_password(array(
		'name' => 'confirm_new_password',
		'placeholder' => 'CONFIRM NEW PASSWORD'
	)) . '<br />'
?>
<a class="btn btn-danger" href="<?= base_url() . 'account' ?>">Cancel</a>&nbsp;&nbsp;
<?= form_submit(array(
	'type' => 'submit', 
	'value' => 'Change',
	'class' => 'btn btn-inverse'
)) ?>
<?= form_close() ?>

<?php $this->load->view('front/bottom'); ?>