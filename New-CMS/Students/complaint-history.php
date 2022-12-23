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
  <?php include("includes/header.php");?>
  <section class="flex" >

<?php include("includes/sidebar.php");?>
<section id="main-content">
          <section class="p-4">
          	<h3 class="text-xl font-bold mb-6"><i class="fa fa-angle-right"></i>Complaints </h3>
		  		<div class="row mt">
			  		<div class="col-lg-12">
                      <div>
                          <section id="unseen">
                          <?php 
                          $additional_where_clause = "s.matric_number = {$_SESSION['login']}";
                          echo displayComplaints($bd, 1, True, $additional_where_clause);?>
                          <?php console_log("Whats up") ?>
                          

                          </section>
                  </div><!-- /content-panel -->
               </div><!-- /col-lg-4 -->			
		  	</div><!-- /row -->
		  	
		  	

		</section>
      </section><!-- /MAIN CONTENT -->
    </section>
    

  </body>
</html>