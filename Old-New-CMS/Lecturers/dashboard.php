<?php
session_start();
ini_set ('display_errors', 1);
ini_set ('display_startup_errors', 1);
error_reporting (E_ALL);
include('../config.php');
include("../utils.php");
include("../renderers.php");



check_login_lecturer();

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>CMS | Dashboard</title>

  </head>

  <body>

  <section id="container" >
<?php include("includes/header.php");?>
<?php echo displayLecturerSidebar($bd, $_SESSION['id']);?>
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
function get_number_of_complaints_per_status($conn, $status, $lecturer_email){
  $sql = "SELECT * FROM complaint c JOIN lecturer l where status='$status' and l.id = c.lecturer_id and l.email = '$lecturer_email' ";
  $rt = mysqli_query($conn, $sql);
  $num_rows = mysqli_num_rows($rt);
  return $num_rows;
}

$num_rows = get_number_of_complaints_per_status($bd, $status, $_SESSION['login_lecturer']);
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
$num_rows = get_number_of_complaints_per_status($bd, $status, $_SESSION['login_lecturer']);
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
$num_rows = get_number_of_complaints_per_status($bd, $status, $_SESSION['login_lecturer']);
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