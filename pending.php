<?php 
	ob_start();
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
		?>
		<div class="content">
			<div class="main">
				<div class="container">
					<div class="padding" style="padding-top:70px"></div>
					<p>We sent an email to <strong><?php echo $_GET['email'] ?></strong> to help you recover your account.</p>
					<p>Please login into your email account and click on the link we sent to reset your password</p>
				</div>
			</div>
		</div>
		<?php 
			include '../includes/footer.php';
			ob_end_flush();
		?>
	</body>
</html>