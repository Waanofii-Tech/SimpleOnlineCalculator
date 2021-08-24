<?php
    //session_destroy();
    session_start();
    $_SESSION['login']=false;
    $_SESSION['success']="Your login session has been successfully destroyed!
    Now you are logged out!";
    header('location:index.php');
?>
