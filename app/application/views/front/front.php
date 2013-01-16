<!DOCTYPE html> 
<html>  
<head> 
<title>Resolution. A Year's Goaltracker</title>
 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<link href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.1.1/css/bootstrap-combined.min.css" rel="stylesheet" />

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

</style>

</head>
<body>

<div class="container">
	<header>
		<h1>Resolution.</h1>
		<h2>A Year's Goaltracker.</h2>
	</header>

	<div id="pull_app"></div>
</div>

<script>

function login_events() {
	$('#sub_login').click( function(party) {
		party.preventDefault();
		$.ajax({
			type: 'POST',
			url: $('#form_login').attr('action'),
			data: $('#form_login').serialize()
		}).done(function(response){
			$('#pull_app').html(response);
			$('#a_logout').click( function(party){
				party.preventDefault();
				$('#pull_app').load($('#a_logout').attr('href'), function(){
					login_events();
					// resolution stuff here
				});
			});
		});
	});
}

$(document).ready( function(){
	$('#pull_app').load('initialize', function() {
		login_events();
		$('#a_register').click( function(party) {
			party.preventDefault();
			$('#pull_app').load($(this).attr('href'), function() {
				$('#sub_register').click( function(party) {
					party.preventDefault();
					// serialize and register
				});
				$('#a_login').click( function(party) {
					party.preventDefault();
					$('#pull_app').load($('#a_login').attr('href'), function(){
						login_events();
					});
				});
			});
		});
	});
});

</script>

</body>
</html>