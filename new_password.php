<?php 
	ob_start();
	include '../server/lost_password_server.php';
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
					<?php include'../includes/success.php'; ?>
					<?php include'../includes/errors.php'; ?>
				</div>
			</div>
		</div>
		<?php 
			include '../includes/footer.php';
			ob_end_flush();
		?>
	</body>
</html>