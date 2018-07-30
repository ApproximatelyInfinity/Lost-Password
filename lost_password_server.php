<?php 
	session_start();
	
	//Initalize the variables
	$errors = array();
	$success = array();
	$email = $_GET['email'];
	$token = $_GET['token'];
	
	//Connect to the database
	include '../includes/database_conn.php';
	
	//If the email and token exist in the database
	if (isset($email) && isset($token)) {
		//Select the information from the password_reset table where the token and email match
		$query = "SELECT * FROM password_reset WHERE email = '$email' AND token = '$token' LIMIT 1";
		$result = mysqli_query($conn, $query);
		
		//If the information does exist
		if($result > 0) {
			//Scrable a random password
			$new_pass = "abcdefg12345678";
			$new_pass = str_shuffle($new_pass);
			
			//Encrypt the scrabled password
			$encyrpted_pass = password_hash($new_pass, PASSWORD_DEFAULT);
			
			//Insert the scrabled password into the database
			$query = "UPDATE users SET password = '$encyrpted_pass' WHERE email = '$email'";
			$result = mysqli_query($conn, $query);
			
			//Update the password_reset database to get rid of the token
			$query_delete = "DELETE FROM password_reset WHERE email = '$email'";
			$result = mysqli_query($conn, $query_delete);
			
			array_push($success, "Your password has been successfully updated\n");
			array_push($success, "Your new password is $new_pass");
		}else{
			array_push($errors, "This email and/pr token does not exist in our database");
		}
	}
?>