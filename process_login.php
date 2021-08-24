<?php
	session_start();
	require_once 'dbcon.php';
	if(ISSET($_POST['login'])){
		$username = $_POST['username'];
		$password = md5($_POST['password']);
		
		$query = "SELECT COUNT(*) as count FROM `user` WHERE `username` = :username AND `password` = :password";
		$stmt = $dbcon->prepare($query);
		$stmt->bindParam(':username', $username);
		$stmt->bindParam(':password', $password);
		$stmt->execute();
		$row = $stmt->fetch();
		
		$count = $row['count'];
		
		if($count > 0){
			$_SESSION['login']=true;
			$_SESSION['username']=$_POST['username'];
			$_SESSION['start']=10;
			$_SESSION['offset']=0;
			$_SESSION['disableprev']=true;
			$_SESSION['disablenext']=false;
			$_SESSION['selectedoption']=10;
			header('location:calculator.php');
		}else{
			$_SESSION['login']=false;
			$_SESSION['error'] = "Invalid username or password, please try again!";
			header('location:index.php');
		}
	}
?>