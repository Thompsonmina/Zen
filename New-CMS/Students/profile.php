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

    <section id="main-content">
        <section class="wrapper p-4">
        <div class="row mt">
          <div class="col-lg-12">
                    <div class="content-panel">
                        <section id="unseen">
                  	

 <?php $query=mysqli_query($bd, "select * from student where matric_number='".$_SESSION['login']."'");
 while($row=mysqli_fetch_array($query)) 
 {
 ?>                     

                      <form class="mx-auto max-w-md py-10" method="post" name="profile" >

<label>Full Name</label>
<input class="p-2 border border-gray-300" required type="text" name="fullname" required="required" value="<?php echo htmlentities($row['fullName']);?>" class="form-control" >
 </div>
<label>User Email </label>
<input class="p-2 border border-gray-300" required  type="email" name="email" required="required" value="<?php echo htmlentities($row['userEmail']);?>" class="form-control">
</div>
 </div>

 <label>Matric Number</label>
<input  class="p-2 border border-gray-300" required name="matric" required="required" value="<?php echo htmlentities($row['matric_number']);?>" class="form-control" readonly>
</div>

<?php } ?>

<button type="submit" name="submit" class="btn btn-primary">Submit</button>

                          </form>
                          </section>
                  </div><!-- /content-panel -->
               </div><!-- /col-lg-4 -->			
		  	</div><!-- /row -->
		  	
		  	

		</section><! --/wrapper -->
      </section><!-- /MAIN CONTENT -->
    </section>

  </body>
</html>
