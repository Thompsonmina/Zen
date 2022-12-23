<?php
session_start();
include('../config.php');
include('../utils.php');
if (strlen($_SESSION['alogin']) == 0) {
	header('location:index.php');
} else {
	date_default_timezone_set('Asia/Kolkata'); // change according timezone
	$currentTime = date('d-m-Y h:i:s A', time());


	if (isset($_POST['submit'])) {
		$fullname = $_POST['fullname'];
		$email = $_POST['email'];
		$matric = $_POST['matric'];
		$password = $_POST["password"];
		$pass_hash = md5($_POST['password']);

		$sql = mysqli_query($bd, "insert into student(fullname,userEmail,password_hash, matric_number) values('$fullname','$email', '$pass_hash', '$matric')");
		$_SESSION['msg'] = "Student Created !!";
		console_log("hazzah");
		$host = $_SERVER['HTTP_HOST'];
		$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		header("location:http://$host$uri/manage_students.php");
	}
?>


	<!DOCTYPE html>
	<html lang="en">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Admin| Manage Course</title>
		<script src="https://cdn.tailwindcss.com"></script>


	</head>

	<body>
		<?php include('includes/header.php'); ?>
		<div class="wrapper">
			<div class="">
				<div class="flex w-full">
					<?php include('includes/sidebar.php'); ?>

					<div class="span9 w-full">
						<div class="p-8 w-full">
							<div class="">
								<h3 class="text-xl font-bold">New Student</h3>
							</div>
							<div class="module-body">
								<?php if (isset($_POST['submit'])) { ?>
									<div class="alert alert-success">
										<button type="button" class="close" data-dismiss="alert">×</button>
										<strong>Well done!</strong> <?php echo htmlentities($_SESSION['msg']); ?><?php echo htmlentities($_SESSION['msg'] = ""); ?>
									</div>
								<?php } ?>


								<?php if (isset($_GET['del'])) { ?>
									<div class="alert alert-error">
										<button type="button" class="close" data-dismiss="alert">×</button>
										<strong>Oh snap!</strong> <?php echo htmlentities($_SESSION['delmsg']); ?><?php echo htmlentities($_SESSION['delmsg'] = ""); ?>
									</div>
								<?php } ?>

								<br />

								<form name="Student" class="flex flex-col gap-y-5 w-full  max-w-xs" method="post">
									<div class="w-full">
										<label class="block" for="basicinput">Student Matric</label>
										<input class="w-full p-2 border border-gray-300 rounded" placeholder="Enter Student Matric Number" name="matric" class="span8 tip" required>
									</div>

									<div class="w-full">
										<label class="block" for="basicinput">Student Full Name</label>
										<input class="w-full p-2 border border-gray-300 rounded" placeholder="Enter Student Fullname" name="fullname" class="span8 tip" required>
									</div>

									<div class="w-full">
										<label class="block" for="basicinput">Student Email Address</label>
										<input class="w-full p-2 border border-gray-300 rounded" placeholder="Enter Student Email Address" name="email" class="span8 tip" required>
									</div>

									<div class="w-full">
										<label class="block" for="basicinput">Password</label>
										<input class="w-full p-2 border border-gray-300 rounded" type="text" placeholder="password" name="password" class="span8 tip" required>
									</div>
							</div>

							<button type="submit" name="submit" class="w-full border border-black p-2 max-w-xs mt-8">Create</button>
							</form>
						</div>



						<div class="p-8">
							<div class="module-head">
								<h3 class="text-xl font-bold mb-4">Manage Students</h3>
							</div>
							<div class="overflow-x-scroll">
								<table class="table-auto w-full" cellspacing="0" cellpadding="0" border="0" width="20rem">
									<thead>
										<tr>
											<th class="text-left">#</th>
											<th class="text-left">Matric Number</th>

											<th class="text-left">Fullname</th>
											<th class="text-left">Email Address</th>
										</tr>
									</thead>
									<tbody>

										<?php $query = mysqli_query($bd, "select * from student");
										$cnt = 1;
										while ($row = mysqli_fetch_array($query)) {
										?>
											<tr class="cursor-pointer">
												<td><?php echo htmlentities($cnt); ?></td>
												<td><?php echo htmlentities($row['matric_number']); ?></td>
												<td><?php echo htmlentities($row['fullName']); ?></td>
												<td><?php echo htmlentities($row['userEmail']); ?></td>
												<td>
													<a href="category.php?id=<?php echo $row['id'] ?>&del=delete" onClick="return confirm('Are you sure you want to delete?')"><i class="icon-remove-sign"></i></a>
												</td>
											</tr>
										<?php $cnt = $cnt + 1;
										} ?>

								</table>
							</div>
						</div>



					</div>
				</div>
			</div>
		</div>
		</div>
	</body>
<?php } ?>