<?php
    
    session_start();
    require_once 'dbcon.php';
    $_SESSION['selectedoption']=$_POST['start'];
    $query = "SELECT COUNT(*) as count FROM `history` WHERE `byuser` = :username ";
	$stmt = $dbcon->prepare($query);
    $stmt->bindParam(':username', $_SESSION['username']);
    $stmt->execute();
    
    $row = $stmt->fetch();
    
    $count = $row['count'];
    if(ISSET($_POST['next'])){
        $_SESSION['start']=$_POST['start'];
        $_SESSION['offset']=$_SESSION['offset']+$_POST['start'];
        if (($_SESSION['offset']+$_SESSION['start']) >= $count){
            $_SESSION['disablenext']=true;
        }
        else {
            $_SESSION['disablenext']=false;
        }
        if ($_SESSION['offset'] < 0){
            $_SESSION['disableprev']=true;
        }
        else {
            $_SESSION['disableprev']=false;
        }
        header('location:history.php');
    }
    if(ISSET($_POST['prev'])){
        $_SESSION['start']=$_POST['start'];
        // if($_SESSION['offset'] <= $start){
        //     $_SESSION['offset']=0;
        // }
        // else {
            $_SESSION['offset']=$_SESSION['offset']-$_POST['start'];
        // }
        if (($_SESSION['offset']+$_SESSION['start']) >= $count){
            $_SESSION['disablenext']=true;
        }
        else {
            $_SESSION['disablenext']=false;
        }
        if ($_SESSION['offset'] <= 0){
            $_SESSION['disableprev']=true;
        }
        else {
            $_SESSION['disableprev']=false;
        }
        header('location:history.php');
    }
?>