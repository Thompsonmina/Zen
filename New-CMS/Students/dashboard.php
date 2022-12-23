<?php
session_start();
error_reporting(0);
include('../config.php');
include("../utils.php");



check_login_user();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>CMS | Dashboard</title>

   
  </head>

  <body>

  <section id="container" >
<?php include("includes/header.php");?>
<?php include("includes/sidebar.php");?>
      <section id="main-content">
          <section class="wrapper">

              <div class="row">
                  <div class="col-lg-9 main-chart">
                  
                  
                  	<div class="col-md-2 col-sm-2 box0">
                        <div>
                 
                  </div></div>                  	
                  		<div class="col-md-2 col-sm-2 box0">
                  			<div class="box1">
					  			<span class="li_news"></span>
                                <?php 
           
$status=1;
$rt = mysqli_query($bd, "SELECT * FROM complaint JOIN student s where status='$status' and s.matric_number = {$_SESSION['login']}");
$num_rows = mysqli_num_rows($rt);
{?>
					  			<h3><?php echo htmlentities($num_rows);?></h3>
                  			</div>
					  			<p><?php echo htmlentities($num_rows);?> 
                  Pending Complaints
                </p>

                  		</div>
                      <?php }?>


                      <div class="col-md-2 col-sm-2 box0">
                        <div class="box1">
                  <span class="li_news"></span>
                    <?php 
$status=2;                   
$rt = mysqli_query($bd, "SELECT * FROM complaint JOIN student s where status='$status' and s.matric_number = {$_SESSION['login']}");
$num_rows = mysqli_num_rows($rt);
{?>
                  <h3><?php echo htmlentities($num_rows);?></h3>
                        </div>
                  <p><?php echo htmlentities($num_rows);?>
                  Complaints Being Looked At
                </p>
                      </div>
  <?php }?>

                      <div class="col-md-2 col-sm-2 box0">
                        <div class="box1">
                  <span class="li_news"></span>
                       <?php 
$status=3;                   
$rt = mysqli_query($bd, "SELECT * FROM complaint JOIN student s where status='$status' and s.matric_number = {$_SESSION['login']}");
$num_rows = mysqli_num_rows($rt);
{?>
                  <h3><?php echo htmlentities($num_rows);?></h3>
                        </div>
                  <p><?php echo htmlentities($num_rows);?>
                    Closed Complaints
                  </p>
                      </div>

<?php }?>
                  	
                  	
</div><!-- /row mt -->	
                  
                      
                     
                    				
				
				
          </section>
      </section>
  </section>

  </body>
</html>