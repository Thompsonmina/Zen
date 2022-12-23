<?php
session_start();
error_reporting(0);
include('../config.php');
include("../utils.php");
include("../renderers.php");




check_login_lecturer();
$host=$_SERVER['HTTP_HOST'];
$uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');

echo print_r($_POST);
if(isset($_GET['complaintid']))
{
    $complainid = $_GET["complaintid"];
    $query =  mysqli_query($bd, "SELECT c.id, c.complaint_text, c.status, s.FullName as stuFullName, s.id as studId, l.id as lecId, c.regDate, c.status, s.matric_number, l.fullName, co.code FROM complaint c JOIN student s ON c.student_id = s.id JOIN lecturer l ON c.lecturer_id = l.id JOIN course co ON c.course_id = co.id WHERE c.id = $complainid");
    $complain_details = mysqli_fetch_array($query);

    if ($complain_details['lecId'] !== $_SESSION["id"]){
        echo "you do not have permission to view this";
        exit();
    }
}

else if (isset($_POST["submit"]))
{
  echo "huh";

  echo $_POST['new_status'];
    $query =  mysqli_query($bd, "update complaint set status {$_POST['new_status']} where id = '".$_GET['complaintid']."'");
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

    <title>CMS | Lecturer Complaint</title>

    <script src="https://cdn.tailwindcss.com"></script>
  </head>

  <body>
          
    <?php include("includes/header.php");?>
    
    <section class="flex" >

<?php echo displayLecturerSidebar($bd, $_SESSION['id']);?>
  <section id="main-content" class="flex-grow">

          <?php
          if ($complain_details)
          {
          ?>
          	
          	<!-- BASIC FORM ELELEMNTS -->
          	<div class="row mt">
          		<div class="col-lg-12">
                  <div class="form-panel">
  
                  <form class="mx-auto max-w-md py-10"  method="post">
		        <p style="padding-left:4%; padding-top:2%;  color:red">
		        	<?php
                if(isset($errormsg)){
                  echo htmlentities($errormsg);
		        		}
              ?>
            </p>

		        <p style="padding-left:4%; padding-top:2%;  color:green">
		        	<?php
                if(isset($msg)){
                  echo htmlentities($msg);
		        		}
              ?>
            </p>
            <div class="flex flex-col gap-y-5">
            <label>Complaint</label>
            <input class="p-2 border border-gray-300" type="text" readonly value="<?php echo "{$complain_details['complaint_text']}"?>" class="form-control">
            
            <label>Lecturer</label>
            <input class="p-2 border border-gray-300" type="text" readonly value="<?php echo "{$complain_details['fullName']}" ?>"  required autofocus>

            <label class="">Student:</label>
            <input readonly value="<?php echo "{$complain_details['stuFullName']}" ?>" class="p-2 border border-gray-300" required >
            
            <label class="">Course</label>
            <input readonly value="<?php echo "{$complain_details['code']}" ?>"  class="p-2 border border-gray-300" required placeholder="Password">
            
            <select name="new_status" class="form-input block w-full py-2 px-3 leading-tight rounded-md bg-white border border-gray-300 focus:outline-none focus:shadow-outline-blue-300 focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                <?php
                    $query = mysqli_query($bd, "SELECT * from complaint_status");
              while ($row = mysqli_fetch_assoc($query)) {
                if ($row['id'] === $complain_details['status']){
                  echo "<option selected value={$row['id']}>{$row['status']}</option>";
                }
              echo "<option value={$row['id']}>{$row['status']}</option>";
              }
                ?>
            
            </select>

            <button class="w-full bg-yellow-500 p-2 text-white font-bold rounded" type="submit" name="submit" type="submit">Change Status</button>
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
