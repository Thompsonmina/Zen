<?php
session_start();
include("../config.php");
include("../utils.php");

if(isset($_POST['submit']))
{
	$username=$_POST['username'];
	$password=md5($_POST['password']);
	$ret=mysqli_query($bd, "SELECT * FROM admin WHERE username='$username' and password_hash='$password'");
	$num=mysqli_fetch_array($ret);
	
	if($num>0)
	{
		$extra="index.php";//
		$_SESSION['alogin']=$_POST['username'];
		$_SESSION['id']=$num['id'];
		console_log("location:http://$host$uri/$extra");
		$host=$_SERVER['HTTP_HOST'];
		$uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
		header("location:http://$host$uri/$extra");
		exit();
	}
	else
	{
		$_SESSION['errmsg']="Invalid username or password";
		$extra="login.php";
		$host  = $_SERVER['HTTP_HOST'];
		$uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
		header("location:http://$host$uri/$extra");
		exit();
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>CMS | Admin login</title>	
	<script src="https://cdn.tailwindcss.com"></script>

</head>
<body>
	<nav class="border-b border-black p-3 flex flex-col items-start sm:flex-row sm:items-center gap-x-5" role="navigation">
		<a href="/New-CMS">
			<h1 class="font-mono text-4xl font-bold">cms</h1>
		</a>  
	</nav>

	<div>
		<div>
			<form class="mx-auto max-w-md py-10" name="login" method="post">
				<h2 class="text-center text-xl font-bold mb-4">Admin Sign In</h2>
				<span style="color:red;" >
					<?php echo htmlentities($_SESSION['errmsg']); ?>
					<?php echo htmlentities($_SESSION['errmsg']="");?>
				</span>
				<div class="flex flex-col gap-y-5">
					<input class="p-2 border border-gray-300" type="text" id="inputEmail" name="username" placeholder="Username">
					<input class="p-2 border border-gray-300" type="password" id="inputPassword" name="password" placeholder="Password">
					<button type="submit" class="w-full bg-yellow-500 p-2 text-white font-bold rounded" name="submit">Login</button>		
				</div>
				
			</form>
		</div>
	</div>
</body>