<?php $this->load->view('front/top'); ?>

<?= ($this->session->flashdata('msg') ? '<div class="alert"><p>'.$this->session->flashdata('msg').'</p></div>' : ''); ?>

<p><a class="btn btn-inverse" href="<?= base_url() ?>resolution/create">+ NEW GOAL</a></p>

<?php

if(!empty($goals)){
	?><ul id="ul_goals"><?php
	foreach($goals as $goal) {
		?><li class="li_maingoal">
			<span class="maingoal inline"><?= $goal->name ?></span>
			<div class="btn-toolbar pull-right">
				<div class="btn-group">
					<a class="btn btn-success" href="<?= base_url() ?>resolution/complete/<?= $goal->id ?>"><i class="icon-ok"></i></a>
					<a class="btn" href="<?= base_url() ?>resolution/edit/<?= $goal->id ?>"><i class="icon-pencil"></i></a>
					<a class="btn btn-inverse" href="<?= base_url() ?>resolution/create/<?= $goal->id ?>"><i class="icon-plus icon-white"></i></a>
					<a class="btn btn-danger" href="<?= base_url() ?>resolution/delete/<?= $goal->id ?>"><i class="icon-remove"></i></a>
				</div>
			</div>
			<div class="clearfix"></div>
			<?php 
				if($goal->subs) {
					?><ul><?php
						foreach($goal->subs as $subgoal) {
							?><li<?= ($subgoal->status == 0) ? ' class="subcomplete"' : '' ?>><span><?= $subgoal->name ?><?= ($subgoal->status == 0) ? ' <em>(Completed!)</em>' : '' ?></span> <div class="subgoal_icons"><?= ($subgoal->status == 1) ? '<a href="<?= base_url() ?>resolution/complete/<?= $subgoal->id ?>"><i class="icon-ok"></i></a>' : '' ?> <a href="<?= base_url() ?>resolution/edit/<?= $subgoal->id ?>/<?= $goal->id ?>"><i class="icon-pencil"></i></a> <a href="<?= base_url() ?>resolution/delete/<?= $subgoal->id ?>/<?= $goal->id ?>"><i class="icon-remove"></i></a></div></li><?php
						}
					?></ul><?php
				}
			?>
		</li><?php
	}
	?></ul><?php
} else {
	?><p><em>You have no goals. Try <a href="<?= base_url() ?>resolution/create">making one</a>.</em></p><?php
}

?>

<?php $this->load->view('front/bottom'); ?>