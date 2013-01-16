<?php $this->load->view('front/top'); ?>

<h3>My Account</h3>
<?= ($this->session->flashdata('msg') ? '<div class="alert"><p>'.$this->session->flashdata('msg').'</p></div>' : ''); ?>

<p>
	<strong>Name:</strong> <?= $user->name ?><br />
	<strong>Email:</strong> <?= $user->email ?>
</p>

<p><a href="<?= base_url() . 'account/edit' ?>" class="btn btn-inverse">Edit Info</a> <a href="<?= base_url() . 'account/change_password' ?>" class="btn btn-warning">Change Password</a></p>

<?php $this->load->view('front/bottom'); ?>