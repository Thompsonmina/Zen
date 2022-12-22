<?php
session_start();
error_reporting(0);
include("../config.php");
include("../utils.php");

console_log("omo x 2");

$host=$_SERVER['HTTP_HOST'];
console_log(print_r($_POST));

if(isset($_POST['submit']))
{
  console_log("gongonx 2");

$sql = "SELECT * FROM lecturer WHERE email="."'{$_POST['email']}'"."and password_hash='".md5($_POST['password'])."';";
echo $sql;
$ret=mysqli_query($bd, $sql);
$num=mysqli_fetch_array($ret);
console_log("yeah boy");
console_log($num);
if($num)
{
console_log("omo");
$extra="dashboard.php";//
$_SESSION['login_lecturer']=$_POST['email'];
$_SESSION['id']=$num['id'];
$uip=$_SERVER['REMOTE_ADDR'];
console_log("hmmm");

$uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
header("location:http://$host$uri/$extra");

exit();
}
else
{
console_log("i should be here too");

$uip=$_SERVER['REMOTE_ADDR'];
$status=0;

$errormsg="Invalid username or password";
$extra="login.php";
$uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
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

    <title>CMS | Lecturer Login</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        
    <!-- Custom styles for this template -->
    <link hreszsza="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">

  </head>

  <body>

      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->

	  <div id="login-page">
	  	<div class="container">
	  	
		      <form class="form-login" name="login" method="post" action="login.php">
		        <h2 class="form-login-heading">sign in now</h2>
		        <p style="padding-left:4%; padding-top:2%;  color:red">
		        	<?php if($errormsg){
echo htmlentities($errormsg);
		        		}?></p>

		        		<p style="padding-left:4%; padding-top:2%;  color:green">
		        	<?php if($msg){
echo htmlentities($msg);
		        		}?></p>
		        <div class="login-wrap">
		            <input type="text" class="form-control" name="email" placeholder="Email Address"  required autofocus>
		            <br>
		            <input type="password" class="form-control" name="password" required placeholder="Password">
		            <label class="checkbox">
		            </label>
		            <button class="btn btn-theme btn-block" name="submit" type="submit"><i class="fa fa-lock"></i> SIGN IN</button>
		            <hr>
              </div>
		           </form>		            
		        </div>
	  	
	  	</div>
  </body>
</html>
