
<?php
session_start();
include('../config.php');
include('../utils.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
date_default_timezone_set('Asia/Kolkata');// change according timezone
$currentTime = date( 'd-m-Y h:i:s A', time () );


if(isset($_POST['submit']))
{
	$fullname=$_POST['fullname'];
	$email=$_POST['email'];
    $password=$_POST["password"];
    $pass_hash= md5($_POST['password']);

$sql=mysqli_query($bd, "insert into lecturer(fullname,email,password_hash) values('$fullname','$email', '$pass_hash')");
$_SESSION['msg']="Course Created !!";
console_log("hazzah");
$host=$_SERVER['HTTP_HOST'];
$uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
header("location:http://$host$uri/manage_lecturers.php");

}

if(isset($_GET['del']))
		  {
		          mysqli_query($bd, "delete from lecturer where id = '".$_GET['id']."'");
                  $_SESSION['delmsg']="Lecturer Removed !!";
		  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin| Manage Course</title>
	<script src="https://cdn.tailwindcss.com"></script>

	<link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link type="text/css" href="css/theme.css" rel="stylesheet">
	<link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
	<link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
</head>
<body>
<?php include('includes/header.php');?>
	<div class="wrapper">
		<div class="">
			<div class="flex w-full">
			<?php include('includes/sidebar.php');?>				

			<div class="span9 w-full">
					<div class="p-8 w-full">
						<div class="">
							<h3 class="text-xl font-bold">New Lecturer</h3>
						</div>
							<div class="module-body">
								<?php if(isset($_POST['submit']))

								{?>
									<div class="alert alert-success">
										<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>Well done!</strong>	<?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?>
									</div>
							<?php } ?>


									<?php if(isset($_GET['del']))
{?>
									<div class="alert alert-error">
										<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>Oh snap!</strong> 	<?php echo htmlentities($_SESSION['delmsg']);?><?php echo htmlentities($_SESSION['delmsg']="");?>
									</div>
<?php } ?>

									<br />

			<form name="Lecturer" class="flex flex-col gap-y-5 w-full  max-w-xs" method="post">
				<div class="w-full">
					<label class="block" for="basicinput">Lecturer Full Name</label>
					<input class="w-full p-2 border border-gray-300 rounded" placeholder="Enter Lecturer Fullname"  name="fullname" class="span8 tip" required>
				</div>

				<div class="w-full">	
					<label class="block" for="basicinput">Lecturer Email Address</label>
					<input class="w-full p-2 border border-gray-300 rounded" placeholder="Enter Lecturer Email Address"  name="email" class="span8 tip" required>
				</div>

				<div class="w-full">
					<label class="block" for="basicinput">Password</label>
					<input class="w-full p-2 border border-gray-300 rounded" type="text" placeholder="password"  name="code" class="span8 tip" required>											</div>
				</div>

				<button type="submit" name="submit" class="w-full border border-black p-2 max-w-xs mt-8">Create</button>
			</form>
	</div>



	<div class="p-8">
		<div class="module-head">
			<h3 class="text-xl font-bold mb-4">Manage Lecturers</h3>
		</div>
		<div class="overflow-x-scroll">
			<table class="table-auto w-full" cellspacing="0" cellpadding="0" border="0" width="20rem">
				<thead>
					<tr>
						<th class="text-left">#</th>
						<th class="text-left">Fullname</th>
						<th class="text-left">Email Address</th>
					</tr>
				</thead>
				<tbody>

<?php $query=mysqli_query($bd, "select * from lecturer");
$cnt=1;
while($row=mysqli_fetch_array($query))
{
?>									
										<tr class="cursor-pointer">
											<td><?php echo htmlentities($cnt);?></td>
											<td><?php echo htmlentities($row['fullName']);?></td>
											<td><?php echo htmlentities($row['email']);?></td>
                                            <!-- maybe thier courses -->
											<td>
											<a href="category.php?id=<?php echo $row['id']?>&del=delete" onClick="return confirm('Are you sure you want to delete?')"><i class="icon-remove-sign"></i></a></td>
										</tr>
										<?php $cnt=$cnt+1; } ?>
										
								</table>
							</div>
						</div>						

						
						
					</div><!--/.content-->
				</div><!--/.span9-->
			</div>
		</div><!--/.container-->
	</div><!--/.wrapper-->

<?php include('includes/footer.php');?>
<!-- 
	<script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
	<script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
	<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="scripts/flot/jquery.flot.js" type="text/javascript"></script>
	<script src="scripts/datatables/jquery.dataTables.js"></script>
	<script>
		$(document).ready(function() {
			$('.datatable-1').dataTable();
			$('.dataTables_paginate').addClass("btn-group datatable-pagination");
			$('.dataTables_paginate > a').wrapInner('<span />');
			$('.dataTables_paginate > a:first-child').append('<i class="icon-chevron-left shaded"></i>');
			$('.dataTables_paginate > a:last-child').append('<i class="icon-chevron-right shaded"></i>');
		} );
	</script> -->
</body>
<?php } ?>