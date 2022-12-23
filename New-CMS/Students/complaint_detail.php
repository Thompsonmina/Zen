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
    $query =  mysqli_query($bd, "SELECT c.id, c.complaint_text, s.FullName as stuFullName, s.id as studId, c.regDate, c.status, s.matric_number, l.fullName, co.code FROM complaint c JOIN student s ON c.student_id = s.id JOIN lecturer l ON c.lecturer_id = l.id JOIN course co ON c.course_id = co.id WHERE c.id = $complainid");
    $complain_details = mysqli_fetch_array($query);

   

    if ($complain_details['studId'] !== $_SESSION["id"]){
        echo "you do not have permission to view this";
        exit();
    }
}

else if (isset($_GET["delete"]))
{
    $query =  mysqli_query($bd, "delete from complaint where id = '".$_GET['delcomplaintid']."'");
    echo "done";
    header("location:http://$host$uri/dashboard.php");
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

                        

                           <div class="col-sm-10" style="padding-left:25% ">
<a href=<?php echo "complaint_detail.php?delcomplaintid={$complain_details['id']}&delete=true"?> name="delete" class="btn btn-primary">Delete Complaint</a>
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
