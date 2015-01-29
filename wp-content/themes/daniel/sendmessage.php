<?php

	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$message = $_POST['message'];
		$name = $_POST['name'];
		$email = $_POST['email'];

		// Contact subject
		$subject ="Website Message";
	
		// From
		$header="from: $name <$email>";

		// Enter your email address
		$to ='danielinbeijing@googlemail.com';

		$send_contact=mail($to,$subject,$message,$header);

		if($send_contact){
			echo "success";
		}
	}
?>