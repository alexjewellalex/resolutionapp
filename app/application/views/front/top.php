<!DOCTYPE html> 
<html>  
<head> 
<title>Resolution. A Year's Goaltracker</title>
 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<link href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.1.1/css/bootstrap-combined.min.css" rel="stylesheet" />
<link href="http://resolutionapp.com/includes/jQueryUI/css/smoothness/jquery-ui-1.9.1.custom.css" rel="stylesheet">

<style>

header{
	margin-top: 10px;
	margin-bottom: 20px;
}

header h1{
	margin: 0px;
	color: #903;
	line-height: 37px;
}

header h2{
	color: #444;
	margin: 0px;
	font-size: 15px;
	line-height: 18px;
}

#header_icons{
	padding-top: 10px;
}

#ul_goals{
	border-radius: 8px;
	margin-left: 0px;
	background-color: #eee;
	padding-bottom: 10px;
}

	#ul_goals li{
		list-style-type: none;
	}

.li_maingoal{
	padding-left: 10px;
	padding-right: 10px;
}

	.li_maingoal ul{
		background-color: #ddd;
		margin: 0px;
		padding: 5px 15px 5px 15px;
		font-weight: bold;
		border-radius: 6px;
	}

		.li_maingoal li{
			clear: both;
		}

		.li_maingoal li.subcomplete{
			color: #666;
		}

.maingoal{
	line-height: 50px;
	font-size: 18px;
	font-weight: bold;
}

.subgoal_icons{
	float: right;
}

</style>

</head>
<body>

<div class="container">
	<div class="row">
		<div class="span3">
			<header>
				<h1>Resolution.</h1>
				<h2>A Year's Goaltracker.</h2>
			</header>
		</div>
		<?php if($this->session->userdata('user_id')) { ?>
		<div id="header_icons" class="span2">
			<div class="btn-toolbar">
				<div class="btn-group">
					<a class="btn" href="<?= base_url() . 'resolution' ?>"><i class="icon-home"></i></a>
					<a class="btn dropdown-toggle" href="<?= base_url() . 'account' ?>" data-toggle="dropdown"><i class="icon-user"></i> <span class="caret"></span></a>
					<ul id="dropdown" class="dropdown-menu">
						<li><a href="<?= base_url() . 'account' ?>"><i class="icon-cog"></i> Account &amp; Settings</a></li>
						<li><a href="<?= base_url() ?>initialize/logout"><i class="icon-off"></i> Logout</a></li>
					</ul>
				</div>
			</div>
		</div>
		<?php } ?>
	</div>
	<div class="row">
		<div class="span5">