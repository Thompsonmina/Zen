<?php
session_start();
error_reporting(0);
include('../config.php');
include("../utils.php");



check_login_user();

$currentTime = date( 'd-m-Y h:i:s A', time () );


if(isset($_POST['submit']))
{
  $fullname=$_POST['fullname'];
	$email=$_POST['email'];
	$matric = $_POST['matric'];
$query=mysqli_query($bd, "update users set fullName='$fullname',userEmail='$email' where matric_number='".$_SESSION['login']."'");
if($query)
{
$successmsg="Profile Updated !!";
}
else
{
$errormsg="Profile not Updated !!";
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

    <title>CMS | User Change Password</title>

   
  </head>

  <body>
  <?php include("includes/header.php");?>

<section id="container" class="flex">
<?php include("includes/sidebar.php");?>

        <section class="wrapper p-4 w-full">
        <div class="w-full">
            <h1 class="text-xl font-bold">Profile</h1>
                        <section id="unseen" class="w-full">
                  	

 <?php $query=mysqli_query($bd, "select * from student where matric_number='".$_SESSION['login']."'");
 while($row=mysqli_fetch_array($query)) 
 {
 ?>                     

                      <form class="max-w-md py-10 w-full flex flex-col gap-y-5" method="post" name="profile" >

                      <div class="w-full">
<label class="block">Full Name</label>
<input class="w-full p-2 border border-gray-300" required type="text" name="fullname" required="required" value="<?php echo htmlentities($row['fullName']);?>" class="form-control" >
</div>

<div>
<label class="block">User Email </label>
<input class="w-full p-2 border border-gray-300" required  type="email" name="email" required="required" value="<?php echo htmlentities($row['userEmail']);?>" class="form-control">
</div>

<div>
 <label class="block">Matric Number</label>
<input  class="w-full p-2 border border-gray-300" required name="matric" required="required" value="<?php echo htmlentities($row['matric_number']);?>" class="form-control" readonly>
</div>

<?php } ?>

<button type="submit" name="submit" class="w-full border border-black p-2 mt-4">Create</button>


                          </form>
                          </section>		
		  	</div><!-- /row -->
		  	
		  	

      </section><!-- /MAIN CONTENT -->
    </section>

  </body>
</html>
