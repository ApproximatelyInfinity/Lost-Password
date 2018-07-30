<?php 
	session_start();
	$errors = array();
	$user_id = "";
	
	//Connect to the database
	include '../includes/database_conn.php';
	
	//Email user
	if (isset($_POST['reset-password'])) {
		//Gets the email adderss from the user
		$email = mysqli_real_escape_string($conn, $_POST['email']);
		
		//Ensure that the user exists on our system
		$query = "SELECT email FROM users WHERE email='$email'";
		$results = mysqli_query($conn, $query);
		
		//Form validation
		if (empty($email)) {
			array_push($errors, "Your email is required");
		}else if(mysqli_num_rows($results) <= 0) {
			array_push($errors, "Sorry, no user exists on our system with that email");
		}
		
		//Generate a unique random token of length 100
		$token = bin2hex(random_bytes(50));
		
		//If there are no errors then proceed
		if (count($errors) == 0) {
			//Store token in the password-reset database table against the user's email
			$query = "INSERT INTO password_reset(email, token) VALUES ('$email', '$token')";
			$results = mysqli_query($conn, $query);
			
			//Send email to user with the token in a link they can click on
			$to = $email;
			$subject = "Password Reset for Melodic Odyssey";
			$msg = "Hey, It's cool we all forget things sometimes! \n\nIn order to reset your password, please click on the link below: \nhttps://www.melodicodyssey.com/lost/new_password.php?email=$email&token=$token \nKind Regards,\n-Melodic Odyssey";
			$msg = wordwrap($msg,70);
			$headers = "From: Recovery@example.com";
			mail($to, $subject, $msg, $headers);
			
			//Sends the user to the pending page
			header('location: https://www.example.com/lost/pending.php?email=' . $email);
		}
	}
?>