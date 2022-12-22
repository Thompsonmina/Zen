
<?php
function console_log($output, $with_script_tags = true) {
    $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . 
');';
    if ($with_script_tags) {
        $js_code = '<script>' . $js_code . '</script>';
    }
    echo $js_code;
}

function check_login_user(){
    if(strlen($_SESSION['login'])==0)
    { 
    header('location:login.php');
    }
  }

function check_login_lecturer(){
if(strlen($_SESSION['login_lecturer'])==0)
    { 
    header('location:login.php');
    }
}

function check_login_admin(){
    if(strlen($_SESSION['alogin'])==0)
    {	
    header('location:login.php');
    }
}
  
?>