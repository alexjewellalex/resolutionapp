<?php $this->load->view('front/top'); ?>

<?= ($this->session->flashdata('msg') ? '<div class="alert"><p>'.$this->session->flashdata('msg').'</p></div>' : ''); ?>

<form id="form_login" method="post" action="initialize/do_login">
	<input type="text" name="email" id="email" placeholder="EMAIL ADDRESS" /><br />
	<input type="password" name="password" id="password" placeholder="PASSWORD" /><br />
	<input class="btn btn-inverse" id="sub_login" type="submit" value="Login" />
</form>

<p>Not a member? Go ahead and <a id="a_register" href="initialize/register">register</a>!</p>

<?php $this->load->view('front/bottom'); ?>