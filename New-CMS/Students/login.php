<?php
session_start();
error_reporting(0);
include("../config.php");
include("../utils.php");

console_log("omo x 2");

$host = $_SERVER['HTTP_HOST'];

if (isset($_POST['submit'])) {
	$ret = mysqli_query($bd, "SELECT * FROM student WHERE matric_number='" . $_POST['matric'] . "' and password_hash='" . md5($_POST['password']) . "'");
	$num = mysqli_fetch_array($ret);

	if ($num > 0) {
		console_log("omo");
		$extra = "dashboard.php"; //
		$_SESSION['login'] = $_POST['matric'];
		$_SESSION['id'] = $num['id'];
		$uip = $_SERVER['REMOTE_ADDR'];
		console_log("hmmm");

		$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		header("location:http://$host$uri/$extra");

		exit();
	} else {
		console_log("i should be here too");
		$uip = $_SERVER['REMOTE_ADDR'];
		$status = 0;

		$errormsg = "Invalid username or password";
		$extra = "login.php";
		$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		header("location:http://$host$uri/$extra");
	}
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="Dashboard">
	<meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
	<script src="https://cdn.tailwindcss.com"></script>

	<title>CMS | User Login</title>
</head>

<body>
	<nav class="shadow p-3 flex flex-col items-start sm:flex-row sm:items-center gap-x-5" role="navigation">
		<a href="/New-CMS">
			<h1 class="font-mono text-4xl font-bold">cms</h1>
		</a>
	</nav>

	<div id="login-page">
		<div>
			<form class="mx-auto max-w-md py-10" name="login" method="post">
				<h2 class="text-center text-xl font-bold">Students Sign In</h2>
				<p style="padding-left:4%; padding-top:2%;  color:red">
					<?php if ($errormsg) {
						echo htmlentities($errormsg);
					} ?></p>

				<p style="padding-left:4%; padding-top:2%;  color:green">
					<?php if ($msg) {
						echo htmlentities($msg);
					} ?></p>
				<div class="flex flex-col gap-y-5">
					<input class="p-2 border border-gray-300" type="text" name="matric" placeholder="Matric Number" required autofocus>

					<input class="p-2 border border-gray-300" type="password" name="password" required placeholder="Password">

					<button class="w-full bg-yellow-500 p-2 text-white font-bold rounded" name="submit" type="submit">Submit</button>
			</form>

			<div class="">
				Don't have an account yet?
				<a class="underline" href="registration.php">
					Create an account
				</a>
			</div>
		</div>

	</div>
	</div>
</body>

</html>