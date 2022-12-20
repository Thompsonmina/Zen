<?php
session_start();
function log_out(){
    $_SESSION['alogin']=="";
    session_unset();
    //session_destroy();
    $_SESSION['errmsg']="You have successfully logout";
    ?>
    <script language="javascript">
    document.location="index.php";
    </script>
}

