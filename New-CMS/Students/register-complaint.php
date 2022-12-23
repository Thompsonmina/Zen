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
$query = mysqli_query($bd, "select * from course_lecturer WHERE course_id = $course and lecturer_id = $lecturer");
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

    <script src="https://cdn.tailwindcss.com"></script>


  
  </head>

  <body>
  <?php include("includes/header.php");?>

<section id="container" class="flex">
<?php include("includes/sidebar.php");?>

    <section id="main-content">
        <section class="wrapper p-4">
          <h3 class="text-xl font-bold mb-6"><i class="fa fa-angle-right"></i>Complaints </h3>
        <div class="row mt">
          <div class="col-lg-12">
                    <div class="content-panel">
                        <section id="unseen">

            <form class="mx-auto max-w-md py-10" name="login" method="post">
		        
              <label class="">Lecturer</label>
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


        <label class="col-sm-2 col-sm-2 control-label">Course</label>
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

          
            <label class="col-sm-2 col-sm-2 control-label">Complaint Text </label>
            <textarea class="p-2 border border-gray-300" name="complaint_text" required="required" cols="10" rows="10" class="form-control" maxlength="2000"></textarea>
            <button class="w-full bg-yellow-500 p-2 text-white font-bold rounded" name="submit" type="submit">Submit</button>

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
