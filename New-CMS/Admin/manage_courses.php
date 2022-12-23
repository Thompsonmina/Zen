<?php
session_start();
include('../config.php');
include('../utils.php');

check_login_admin();
$currentTime = date('d-m-Y h:i:s A', time());


if (isset($_POST['submit'])) {
	$title = $_POST['name'];
	$code = $_POST['code'];
	$sql = mysqli_query($bd, "insert into course(name,code) values('$title','$code')");
	$_SESSION['msg'] = "Course Created !!";
	console_log("hazzah");
	$host = $_SERVER['HTTP_HOST'];
	$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	header("location:http://$host$uri/manage_courses.php");
}

if (isset($_GET['del'])) {
	mysqli_query($bd, "delete from course where id = '" . $_GET['id'] . "'");
	$_SESSION['delmsg'] = "Course deleted !!";
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
		<div>
			<div class="flex">
				<?php include('includes/sidebar.php'); ?>
				<div class="span9 w-full">
					<div class="p-8">

						<div class="module">
							<div class="module-head">
								<h3 class="text-xl font-bold">Course</h3>
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

								<form class="flex flex-col gap-y-5 w-full max-w-xs" name="Course" method="post">

									<div>
										<label for="basicinput">Course Title</label>
										<div>
											<input class="w-full p-2 border border-gray-300 rounded" type="text" placeholder="Enter Course Title" name="name" class="span8 tip" required>
										</div>
									</div>


									<div>
										<label for="basicinput">Course Code</label>
										<div>
											<input class="w-full p-2 border border-gray-300 rounded" type="text" placeholder="Enter Course code" name="code" class="span8 tip" required>
										</div>
									</div>

									<button type="submit" name="submit" class="w-full border border-black p-2 mt-4">Create</button>

								</form>
							</div>
						</div>


						<div class="py-8">
							<div class="">
								<h3 class="text-xl font-bold mb-4">Manage Courses</h3>
							</div>
							<div class="">
								<table class="table-auto" cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display" width="100%">
									<thead>
										<tr>
											<th class="text-left">#</th>
											<th class="text-left">Course</th>
											<th class="text-left">Code</th>
										</tr>
									</thead>
									<tbody>

										<?php $query = mysqli_query($bd, "select * from course");
										$cnt = 1;
										while ($row = mysqli_fetch_array($query)) {
										?>
											<tr class="cursor-pointer">
												<td><?php echo htmlentities($cnt); ?></td>
												<td><?php echo htmlentities($row['name']); ?></td>
												<td><?php echo htmlentities($row['code']); ?></td>
												<td>
													<a href="edit-category.php?id=<?php echo $row['id'] ?>"><i class="icon-edit"></i></a>
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

	<?php include('includes/footer.php'); ?>
</body>