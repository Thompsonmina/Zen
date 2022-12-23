<?php
session_start();
include('../config.php');
include('../utils.php');

check_login_admin();

$currentTime = date('d-m-Y h:i:s A', time());

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin| Change Password</title>

	<script src="https://cdn.tailwindcss.com"></script>

	<script type="text/javascript">

	</script>
</head>

<body>
	<?php include('includes/header.php'); ?>

	<div class="wrapper">
		<div>
			<div class="row">
				<?php include('includes/sidebar.php'); ?>
				<div class="span9">
					<div class="content">

					</div>
				</div>
			</div>
		</div>
	</div>

</body>