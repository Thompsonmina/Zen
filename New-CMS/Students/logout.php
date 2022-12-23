<?php
session_start();
include("../config.php");
$_SESSION['login'] == "";
$ldate = date('d-m-Y h:i:s A', time());
session_unset();

?>
<script language="javascript">
  document.location = "../index.html";
</script>