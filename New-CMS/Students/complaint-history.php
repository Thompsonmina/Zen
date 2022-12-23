<?php
session_start();
error_reporting(0);
include('../config.php');
include("../utils.php");
include("../renderers.php");

console_log("atta boy");


check_login_user();
console_log("atta boy");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>CMS | Complaint History</title>
    <script src="https://cdn.tailwindcss.com"></script>

  </head>

  <body>

  <section id="container" >
<?php include("includes/header.php");?>
<?php include("includes/sidebar.php");?>

      <section id="main-content">
          <section class="wrapper">
          	<h3><i class="fa fa-angle-right"></i>Your Complaint History</h3>
		  		<div class="row mt">
			  		<div class="col-lg-12">
                      <div class="content-panel">
                          <section id="unseen">
                          <?php console_log("huh") ?>
                          <?php 
                          $additional_where_clause = "s.matric_number = {$_SESSION['login']}";
                          echo displayComplaints($bd, 1, True, $additional_where_clause);?>
                          <?php console_log("Whats up") ?>
                          

                          </section>
                  </div><!-- /content-panel -->
               </div><!-- /col-lg-4 -->			
		  	</div><!-- /row -->
		  	
		  	

		</section><! --/wrapper -->
      </section><!-- /MAIN CONTENT -->
  </section>

    <!-- js placed at the end of the document so the pages load faster -->
  

    <!--script for this page-->
    

  </body>
</html>