<?php 
	ob_start();
	include '../server/email_lost_password_server.php';
	include '../server/new_lost_password_server.php';
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<?php include '../includes/header.php'; ?>
	</head>
	<body>
		<?php 
			if (!isset($_SESSION['username'])) {
				include "../includes/navbar_login.php";
			}else{
				include "../includes/navbar_logout.php";
			}
		?><br><br><br>
		<div class="content">
			<div class="main">
				<div class="container">
					<h2 style=>Reset Password</h2>
					<?php include'../includes/errors.php'; ?>
					<form method="post" action="lost_password.php">
						<div class="form-group"><label>Enter your email address</label><br><input type="email" name="email"></div>
						<div class="form-group"><button type="submit" name="reset-password" class="btn btn-purple">Submit</button></div>
					</form>
				</div>
			</div>
		</div>
		<?php 
			include '../includes/footer.php';
			ob_end_flush();
		?>
	</body>
</html>