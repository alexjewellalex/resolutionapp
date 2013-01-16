<?php

if(!empty($_POST['name'])){
	$name = stripslashes($_POST['name']);
	$email = (!empty($_POST['email'])) ? stripslashes($_POST['email']) : 'noemail@noemail.com';
	$fullMessage = 'Resolution App Interest Signup: ' . $name . ' (' . $email . ')' . "\n";
	$fromm = $name.' <'.$email.'>';
	$h = "From: $fromm\r\nReply-to: $email\r\nX-mailer: ".phpversion();
	mail('alex@alexjewell.com','Resolution App Interest Signup',$fullMessage,$h);
}

header('location:index.html');

?>