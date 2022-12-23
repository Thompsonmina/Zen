<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include('../config.php');
include("../utils.php");
include("../renderers.php");




check_login_lecturer();

if (isset($_GET['courseid'])) {
  $course = $_GET['courseid'];
  $status_num  = $_GET['status-num'];
  $all = True;
} else {
  $course = "";
  $status = "";
  $all = True;
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

  <title>CMS | All Complaints</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
  <?php include("includes/header.php"); ?>

  <section id="container" class="flex">
    <?php echo displayLecturerSidebar($bd, $_SESSION['id']); ?>

    <section id="main-content">
      <section class="p-4">
        <h3 class="text-xl font-bold mb-6"><i class="fa fa-angle-right"></i>Complaints </h3>
        <div class="row mt">
          <div class="col-lg-12">
            <div>
              <section id="unseen">
                <?php
                if ($course) {
                  $additional_where_clause = "l.email = '{$_SESSION['login_lecturer']}' and c.course_id = $course";
                } else {
                  $additional_where_clause = "l.email = '{$_SESSION['login_lecturer']}'";
                }
                echo displayComplaints($bd, 1, True, $additional_where_clause); ?>
                <?php console_log("Whats up") ?>


              </section>
            </div><!-- /content-panel -->
          </div><!-- /col-lg-4 -->
        </div><!-- /row -->



      </section>
    </section><!-- /MAIN CONTENT -->
  </section>

  <!--script for this page-->


</body>

</html>