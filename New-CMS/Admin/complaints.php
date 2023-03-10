<?php
session_start();
include('../config.php');
include("../renderers.php");
include("../utils.php");
if (strlen($_SESSION['alogin']) == 0) {
	header('location:login.php');
} else {
	date_default_timezone_set('Asia/Kolkata'); // change according timezone
	$currentTime = date('d-m-Y h:i:s A', time());

	if (isset($_GET['status'])) {
		$status = $_GET['status'];
		$status_name = $_GET['status'];
		$status_num  = $_GET['status-num'];
		$all = False;
	} else {
		$status_num = 0;
		$status = "All";
		$status_name = "All";
		$all = True;
	}

?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script src="https://cdn.tailwindcss.com"></script>

		<?php echo "<title>Admin| $status Complaints</title>" ?>
	</head>

	<body class="max-w-screen">
		<?php include('includes/header.php'); ?>

		<div class="wrapper">
			<div>
				<div class="flex">
					<?php include('includes/sidebar.php'); ?>

					<div class="p-4">
						<h1 class="text-xl font-bold mb-6">
							<?php echo $status_name; ?>
							complaints
						</h1>

						<?php echo displayComplaints($bd, $status_num, $all); ?>
					</div>
				</div>
			</div>
		</div>


	</body>
<?php } ?>