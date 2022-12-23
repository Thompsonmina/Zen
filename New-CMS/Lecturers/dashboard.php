
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
    
    <script src="https://cdn.tailwindcss.com"></script>
  </head>

  <body>

    <?php include("includes/header.php");?>
    
    <section class="flex" >

<?php echo displayLecturerSidebar($bd, $_SESSION['id']);?>
  <section id="main-content" class="flex-grow">
          <section class="p-4">

              <h1 class="text-xl font-bold mb-6">Complaints</h1>
              <div class="flex gap-x-5 gap-y-2 flex-wrap">  	
              <div class="bg-gray-100 rounded p-4 flex flex-col">
                  <?php 
           
function get_number_of_complaints_per_status($conn, $status, $lecturer_email){
  $sql = "SELECT * FROM complaint c JOIN lecturer l where status='$status' and l.id = c.lecturer_id and l.email = '$lecturer_email' ";
  $rt = mysqli_query($conn, $sql);
  $num_rows = mysqli_num_rows($rt);
  return $num_rows;
}
$status=1;
$num_rows = get_number_of_complaints_per_status($bd, $status, $_SESSION['login_lecturer']);
{?>
                  <p class="text-xl font-medium mb-4"><?php echo htmlentities($num_rows);?></p>
                  <p>
                    Pending
                  </p>
                </div>
              <?php }?>


                      <div class="bg-gray-100 rounded p-4 flex flex-col">                       
                    <?php 
$status=2;                   
$num_rows = get_number_of_complaints_per_status($bd, $status, $_SESSION['login_lecturer']);
{?>
                  <p class="text-xl font-medium mb-4"><?php echo htmlentities($num_rows);?></p>
                  <p>
                    Being looked at
                  </p>
                </div>
                      
  <?php }?>

                      <div class="bg-gray-100 rounded p-4 flex flex-col">
                       <?php 
$status=3;                   
$num_rows = get_number_of_complaints_per_status($bd, $status, $_SESSION['login_lecturer']);
{?>
                  <p class="text-xl font-medium mb-4"><?php echo htmlentities($num_rows);?></p>
                  <p>
                    Closed
                  </p>
                </div>

<?php }?>
                  	
                  	
</div><!-- /row mt -->	
                  
                      
                     
                    				
				
				
          </section>
      </section>

    </section>

    <?php include("includes/footer.php");?>
  </body>
</html>
