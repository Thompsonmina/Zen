<?php
include('../config.php');
error_reporting(0);
if(isset($_POST['submit']))
{
	$fullname=$_POST['fullname'];
	$email=$_POST['email'];
	$password_hash=md5($_POST['password']);
	$matric = $_POST['matric'];
	$query=mysqli_query($bd, "insert into student(fullName,userEmail,password_hash,matric_number) values('$fullname','$email','$password_hash','$matric')");
	$msg="Registration successfull. Now You can login !";
	header("./login");
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

    <title>CMS | User Registration</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">



    	<script>
function userAvailability() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
// add check for matric availabilty
data:'email='+$("#email").val(),
type: "POST",
success:function(data){
$("#user-availability-status1").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
</script>
  </head>

  <body>
	  <div id="login-page">
			<nav class="border-b border-black p-3 flex flex-col items-start sm:flex-row sm:items-center gap-x-5" role="navigation">
        <h1 class="font-mono text-4xl font-bold">cms</h1>
      </nav>

	  	<div >
		      <form class="mx-auto max-w-md py-10"  method="post">
					<h2 class="text-center text-xl font-bold mb-4">User Registration</h2>
		        <p style="padding-left: 1%; color: green">
		        	<?php if($msg){
echo htmlentities($msg);
		        		}?>


		        </p>
						<div class="flex flex-col gap-y-5">
							<input class="p-2 border border-gray-300" type="text" placeholder="Matric Num" name="matric" required="required" autofocus>
							<input class="p-2 border border-gray-300" type="text" placeholder="Full Name" name="fullname" required="required" autofocus>
							<input class="p-2 border border-gray-300 w-full" type="email" placeholder="Email" id="email" onBlur="userAvailability()" name="email" required="required">
							<input class="p-2 border border-gray-300 w-full" type="password" placeholder="Password" required="required" name="password">
							<button class="w-full bg-yellow-500 p-2 text-white font-bold rounded" type="submit" name="submit" id="submit"><i class="fa fa-user"></i> Register</button>
		            
		            <div>
		                Already Registered
		                <a class="underline" href="login.php">
		                   Sign in
		                </a>
		            </div>
		
		        </div>
		
		      
		
		      </form>	  	
	  	
	  	</div>
	  </div>
  </body>
</html>
