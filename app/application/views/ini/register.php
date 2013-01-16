<?php $this->load->view('front/top'); ?>

<?= ($this->session->flashdata('msg') ? '<div class="alert"><p>'.$this->session->flashdata('msg').'</p></div>' : ''); ?>

<?= form_open('initialize/do_register') ?>
<?= 
	form_input(array(
		'name' => 'name',
		'placeholder' => 'FULL NAME'
	)) . '<br />' .
	form_input(array(
		'name' => 'email',
		'placeholder' => 'EMAIL ADDRESS'
	)) . '<br />' .
	form_password(array(
		'name' => 'password',
		'placeholder' => 'PASSWORD'
	)) . '<br />' .
	form_password(array(
		'name' => 'password_confirm',
		'placeholder' => 'CONFIRM PASSWORD'
	)) . '<br />'
?>
<?= form_submit(array(
	'type' => 'submit', 
	'value' => 'Register',
	'class' => 'btn btn-inverse'
)); ?>
<?= form_close() ?>

<p>Already registered? Go ahead and <a id="a_login" href="<?= base_url() ?>">Login</a>!</p>

<?php $this->load->view('front/bottom'); ?>