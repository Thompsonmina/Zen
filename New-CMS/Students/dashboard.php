<?php
session_start();
error_reporting(0);
include('../config.php');
include("../utils.php");
include("../renderers.php");

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
  <?php include("includes/header.php"); ?>
  <section class="flex">

    <?php include("includes/sidebar.php"); ?>
    <section id="main-content" class="flex-grow">
      <section class="p-4">

        <h1 class="text-xl font-bold mb-6">Complaints</h1>
        <div class="flex gap-x-5 gap-y-2 flex-wrap">
          <div class="bg-gray-100 rounded p-4 flex flex-col">
            <?php

            function get_number_of_complaints_per_status($conn, $status, $matric)
            {
              $sql = "SELECT * FROM complaint c JOIN student s where status='$status' and s.id = c.student_id and s.matric_number = '$matric' ";
              $rt = mysqli_query($conn, $sql);
              $num_rows = mysqli_num_rows($rt);
              return $num_rows;
            }
            $status = 1;
            $num_rows = get_number_of_complaints_per_status($bd, $status, $_SESSION['login']); { ?>
              <p class="text-xl font-medium mb-4"><?php echo htmlentities($num_rows); ?></p>
              <p>
                Pending
              </p>
          </div>
        <?php
            } ?>


        <div class="bg-gray-100 rounded p-4 flex flex-col">
          <?php
          $status = 2;
          $num_rows = get_number_of_complaints_per_status($bd, $status, $_SESSION['login']); { ?>
            <p class="text-xl font-medium mb-4"><?php echo htmlentities($num_rows); ?></p>
            <p>
              Being looked at
            </p>
        </div>

      <?php
          } ?>

      <div class="bg-gray-100 rounded p-4 flex flex-col">
        <?php
        $status = 3;
        $num_rows = get_number_of_complaints_per_status($bd, $status, $_SESSION['login']); { ?>
          <p class="text-xl font-medium mb-4"><?php echo htmlentities($num_rows); ?></p>
          <p>
            Closed
          </p>
      </div>

    <?php
        } ?>

        </div><!-- /row mt -->
      </section>
    </section>
  </section>
</body>

</html>`