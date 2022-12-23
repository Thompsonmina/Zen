<?php
session_start();
error_reporting(0);
include('../config.php');
include("../utils.php");



check_login_user();
$host=$_SERVER['HTTP_HOST'];
$uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');


if(isset($_GET['complaintid']))
{
    echo "still here";
    $complainid = $_GET["complaintid"];
    $query =  mysqli_query($bd, "SELECT c.id, c.complaint_text, s.FullName as stuFullName, s.id as studId, l.id as lecId, c.regDate, c.status, s.matric_number, l.fullName, co.code FROM complaint c JOIN student s ON c.student_id = s.id JOIN lecturer l ON c.lecturer_id = l.id JOIN course co ON c.course_id = co.id WHERE c.id = $complainid");
    $complain_details = mysqli_fetch_array($query);

    if ($complain_details['lecId'] !== $_SESSION["id"]){
        echo "you do not have permission to view this";
        exit();
    }
}

else if (isset($_POST["submit"]))
{
    $query =  mysqli_query($bd, "update complaint set status {$_POST['new_status']} where id = '".$_POST['complaintid']."'");
    echo '<script> alert("Status has been successfully filled")</script>';

}

else{
    echo "no permission";
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

    <title>CMS | Student Change Password</title>

    <script src="https://cdn.tailwindcss.com"></script>
  </head>

  <body>

  <section id="container" >
     <?php include("includes/header.php");?>
      <?php include("includes/sidebar.php");?>
      <section id="main-content">
          <section class="wrapper">

          <?php
          if ($complain_details)
          {
          ?>
          	<h3><i class="fa fa-angle-right"></i> Complaint Details</h3>
          	
          	<!-- BASIC FORM ELELEMNTS -->
          	<div class="row mt">
          		<div class="col-lg-12">
                  <div class="form-panel">
  


                      <form class="form-horizontal style-form" method="post">
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Complaint</label>
                              <div class="col-sm-10">
                                  <input readonly value=<?php echo "{$complain_details['complaint_text']}"?> class="form-control">
                              </div>

                              <label class="col-sm-2 col-sm-2 control-label">Lecturer</label>
                              <div class="col-sm-10">
                                  <input readonly name="password" value=<?php echo "{$complain_details['fullName']}" ?> required="required" class="form-control">
                              </div>

                              <label class="col-sm-2 col-sm-2 control-label">Course</label>
                              <div class="col-sm-10">
                                  <input readonly name="password" value=<?php echo "{$complain_details['stuFullName']}" ?> required="required" class="form-control">
                              </div>
                               <label class="col-sm-2 col-sm-2 control-label">Course</label>
                              <div class="col-sm-10">
                                  <input readonly name="password" value=<?php echo "{$complain_details['code']}" ?> required="required" class="form-control">
                              </div>

                          </div>

                          <div class="relative rounded-md shadow-sm">
  <select name="new-status" class="form-input block w-full py-2 px-3 leading-tight rounded-md bg-white border border-gray-300 focus:outline-none focus:shadow-outline-blue-300 focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
    <option>Option 1</option>
    <option>Option 2</option>
    <option>Option 3</option>
  </select>
  <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
  </div>
</div>


                           <div class="col-sm-10" style="padding-left:25% ">
<button name="submit" class="btn btn-primary">Change Status</a>
</div>
</div>

                          </form>
                          </div>
                          </div>
                          </div>

                    <?php }?>
                          
          	
          	
		</section><! --/wrapper -->
      </section><!-- /MAIN CONTENT -->
  </section>

  </body>
</html>
