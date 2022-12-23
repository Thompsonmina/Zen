<?php
session_start();
error_reporting(0);
include('../config.php');
include("../utils.php");



check_login_user();

if (isset($_POST['submit'])) {
  $sql = mysqli_query($bd, "SELECT password_hash FROM  student where password_hash='" . md5($_POST['password']) . "' && matric_number='" . $_SESSION['login'] . "'");
  $num = mysqli_fetch_array($sql);
  if ($num > 0) {
    $con = mysqli_query($bd, "update student set password='" . md5($_POST['newpassword']) . " where matric_number='" . $_SESSION['login'] . "'");
    $successmsg = "Password Changed Successfully !!";
  } else {
    $errormsg = "Old Password not match !!";
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

  <title>CMS | Student Change Password</title>

  <script src="https://cdn.tailwindcss.com"></script>
</head>


<body>
  <?php include("includes/header.php"); ?>

  <section id="container" class="flex">
    <?php include("includes/sidebar.php"); ?>
    <section id="main-content" class="w-full flex-grow">
      <section class="p-4">
        <h3 class="text-xl font-bold mb-6"><i class="fa fa-angle-right"></i> Change Password</h3>

        <!-- BASIC FORM ELELEMNTS -->
        <div class="w-full">
          <div class="form-panel">

            <?php if (isset($successmsg)) { ?>
              <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <b>Well done!</b> <?php echo htmlentities($successmsg); ?>
              </div>
            <?php } ?>

            <?php if (isset($errormsg)) { ?>
              <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <b>Oh snap!</b> </b>
                <?php
                if (isset($errormsg)) {
                  echo htmlentities($errormsg);
                }
                ?>
              </div>
            <?php } ?>


            <form class="flex flex-col gap-y-5 max-w-xs" method="post" name="chngpwd" onSubmit="return valid();">
              <div class="w-full">
                <label class="">Current Password</label>
                <div class="col-sm-10">
                  <input class="w-full p-2 border border-gray-300 rounded" type="password" name="password" required="required" class="form-control">
                </div>
              </div>

              <div class="form-group">
                <label class="">New Password</label>
                <div class="col-sm-10">
                  <input class="w-full p-2 border border-gray-300 rounded" type="password" name="newpassword" required="required" class="form-control">
                </div>
              </div>

              <div class="form-group">
                <label class="">Confirm Password</label>
                <div class="col-sm-10">
                  <input class="w-full p-2 border border-gray-300 rounded" type="password" name="confirmpassword" required="required" class="form-control">
                </div>
              </div>

              <button type="submit" name="submit" class="w-full border border-black p-2 mt-4">Submit</button>


            </form>
          </div>
        </div>

      </section>
    </section><!-- /MAIN CONTENT -->
  </section>

</body>

</html>