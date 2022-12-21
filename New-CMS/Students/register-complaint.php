<?php
session_start();
error_reporting(0);
include('../config.php');
include("../utils.php");



check_login_user();
console_log("whats going on");
$currentTime = date( 'd-m-Y h:i:s A', time () );

if(isset($_POST['submit']))
{
$uid=$_SESSION['id'];
$course=$_POST['course'];
$lecturer=$_POST['lecturer'];
$complaint_text=$_POST['complaint_text'];

console_log("ok, here post $course $lecturer");
$query = mysqli_query($bd, "select * from course_lecture WHERE course_id = $course and lecture_id = $lecturer");
$row=mysqli_fetch_array($query);
if ($row > 0){
  console_log("this are th eissues");
  $query=mysqli_query($bd, "insert into complaint(student_id,course_id,lecturer_id,complaint_text, status) values('$uid','$course','$lecturer','$complaint_text','1')");
  console_log("this are th eissues 2");

echo '<script> alert("Your complain has been successfully filled")</script>';
}
else {
  echo '<script> alert("Course, Lecturer miss match")</script>';
  console_log("ok, here not match");

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

    <title>CMS | Register Complaint</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="assets/js/bootstrap-datepicker/css/datepicker.css" />
    <link rel="stylesheet" type="text/css" href="assets/js/bootstrap-daterangepicker/daterangepicker.css" />
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">

  
  </head>

  <body>

  <section id="container" >
     <?php include("includes/header.php");?>
      <?php include("includes/sidebar.php");?>
      <section id="main-content">
          <section class="wrapper">
          	<h3><i class="fa fa-angle-right"></i> Register Complaint</h3>
          	
          	<!-- BASIC FORM ELELEMNTS -->
          	<div class="row mt">
          		<div class="col-lg-12">
                  <div class="form-panel">
                  	

                      <?php if($successmsg)
                      {?>
                      <div class="alert alert-success alert-dismissable">
                       <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <b>Well done!</b> <?php echo htmlentities($successmsg);?></div>
                      <?php }?>

   <?php if($errormsg)
                      {?>
                      <div class="alert alert-danger alert-dismissable">
 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <b>Oh snap!</b> </b> <?php echo htmlentities($errormsg);?></div>
                      <?php }?>

                      <form class="form-horizontal style-form" method="post" name="complaint" enctype="multipart/form-data" >

<div class="form-group">
<label class="col-sm-2 col-sm-2 control-label">Course</label>
<div class="col-sm-4">
<select name="course" id="course" class="form-control" onChange="" required="">
<option value="">Select Course</option>
<?php $sql=mysqli_query($bd, "select id,code from course ");
while ($rw=mysqli_fetch_array($sql)) {
  ?>
  <option value="<?php echo htmlentities($rw['id']);?>"><?php echo htmlentities($rw['code']);?></option>
<?php
}
?>
</select>
 
</div>
 </div>




<div class="form-group">
<label class="col-sm-2 col-sm-2 control-label">Lecturer</label>
<div class="col-sm-4">
<select name="lecturer" id="lecturer" class="form-control" onChange="" required="">
<option value="">Select Lecturer</option>
<?php $sql=mysqli_query($bd, "select id,fullName from lecturer ");
while ($rw=mysqli_fetch_array($sql)) {
  ?>
  <option value="<?php echo htmlentities($rw['id']);?>"><?php echo htmlentities($rw['fullName']);?></option>
<?php
}
?>
</select>
</div>


</div>



<div class="form-group">
<label class="col-sm-2 col-sm-2 control-label">Complaint Text </label>
<div class="col-sm-6">
<textarea  name="complaint_text" required="required" cols="10" rows="10" class="form-control" maxlength="2000"></textarea>
</div>
</div>


                          <div class="form-group">
                           <div class="col-sm-10" style="padding-left:25% ">
<button type="submit" name="submit" class="btn btn-primary">Submit</button>
</div>
</div>

          </form>
          </div>
          </div>
          </div>
                          
          	
          	
		</section>
      </section>
    <?php include("includes/footer.php");?>
  </section>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>
    <script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>


    <!--common script for all pages-->
    <script src="assets/js/common-scripts.js"></script>

    <!--script for this page-->
    <script src="assets/js/jquery-ui-1.9.2.custom.min.js"></script>

	<!--custom switch-->
	<script src="assets/js/bootstrap-switch.js"></script>
	
	<!--custom tagsinput-->
	<script src="assets/js/jquery.tagsinput.js"></script>
	
	<!--custom checkbox & radio-->
	
	<script type="text/javascript" src="assets/js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
	<script type="text/javascript" src="assets/js/bootstrap-daterangepicker/date.js"></script>
	<script type="text/javascript" src="assets/js/bootstrap-daterangepicker/daterangepicker.js"></script>
	
	<script type="text/javascript" src="assets/js/bootstrap-inputmask/bootstrap-inputmask.min.js"></script>
	
	
	<script src="assets/js/form-component.js"></script>    
    
    
  <script>
      //custom select box

      $(function(){
          $('select.styled').customSelect();
      });

  </script>

  </body>
</html>
