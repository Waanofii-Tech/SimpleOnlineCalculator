<?php
    session_start();
    $byuser = $_SESSION['username'];
    require_once 'dbcon.php';
    // error_reporting(E_ALL ^ E_WARNING);
    $calculate = $_POST['expressionData'];
    eval('$computed = ' . $calculate . ';');
    $evaluated = $computed;
    $search = 'Division by zero in';
    if(is_infinite($evaluated)) {
        $result = "undefined: dividing by zero";//echo 'Found';
    }
    else {
        $result = $evaluated;
    }
    
    $query = "INSERT INTO `history` (byuser, expression, result) VALUES(:byuser, :expression, :result)";
    $stmt = $dbcon->prepare($query);
    $stmt->bindParam(':byuser', $byuser);
    $stmt->bindParam(':expression', $calculate);
    $stmt->bindParam(':result', $result);
    if($stmt->execute()){
        //do something
    }
    echo $result;
    exit;
?>