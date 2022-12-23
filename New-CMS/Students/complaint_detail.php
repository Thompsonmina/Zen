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

    <title>CMS | Complaint Details </title>

    <script src="https://cdn.tailwindcss.com"></script>
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
          <?php
          if ($complain_details)
          {
          ?>
          	<h2> Complaint Details</h2>
 

                         	



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
            <label>Complaint Text</label>
            <textarea rows="5" class="p-2 w-full border border-gray" type="text" readonly> <?php echo "{$complain_details['complaint_text']}"?></textarea>
            
            <label>Lecturer</label>
            <input class="p-2 border border-gray-300" type="text" readonly value="<?php echo "{$complain_details['fullName']}" ?>"  required autofocus>

            <label class="">Student:</label>
            <input readonly value="<?php echo "{$complain_details['stuFullName']}" ?>" class="p-2 border border-gray-300" required >
            
            <label class="">Course</label>
            <input readonly value="<?php echo "{$complain_details['code']}" ?>"  class="p-2 border border-gray-300" required placeholder="Password">
            

    <a class="w-full bg-yellow-500 p-2 text-white font-bold rounded" href=<?php echo "complaint_detail.php?delcomplaintid={$complain_details['id']}&delete=true"?> name="delete" class="btn btn-primary">Delete Complaint</a>
    </div>
          </form>	

                        
                    <?php }?>
                          
                    </section>
                  </div><!-- /content-panel -->
               </div><!-- /col-lg-4 -->			
		  	</div><!-- /row -->
		  	
		  	

		</section><! --/wrapper -->
      </section><!-- /MAIN CONTENT -->
    </section>


         

  </body>
</html>
