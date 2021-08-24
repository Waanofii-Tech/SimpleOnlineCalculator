<?php
	session_start();

	require_once 'dbcon.php';
	
	if(ISSET($_POST['register'])){
		$username = $_POST['username'];
		$password = $_POST['password'];
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];

		$uppercase = preg_match('@[A-Z]@', $password);
		$lowercase = preg_match('@[a-z]@', $password);
		$number    = preg_match('@[0-9]@', $password);

		$queryone = "SELECT COUNT(*) as count FROM `user` WHERE `username` = :username";
		$stmtone = $dbcon->prepare($queryone);
		$stmtone->bindParam(':username', $username);
		
		$stmtone->execute();
		$row = $stmtone->fetch();
		
		$count = $row['count'];
		if ($count >0 ){
			$_SESSION['error']= "Username already exist";
			header('location: register.php');
		}
		else if (strlen($password) < 8 ) {
			$_SESSION['error']= "Password cannot be less than 8 character.";
			header('location: register.php');
		}
		else if (!$uppercase ) {
			$_SESSION['error']= "Password must contain at least one Upercase letter";
			header('location: register.php');
		}
		else if (!$lowercase) {
			$_SESSION['error']= "Password must contain at least one Lowercase Letter";
			header('location: register.php');
		}
		else if (!$number) {
			$_SESSION['error']= "Password must contain at least one number";
			header('location: register.php');
		}
		else {
			$query = "INSERT INTO `user` (username, password, firstname, lastname) VALUES(:username, :password, :firstname, :lastname)";
			$stmt = $dbcon->prepare($query);
			$password = md5($password);
			$stmt->bindParam(':username', $username);
			$stmt->bindParam(':password', $password);
			$stmt->bindParam(':firstname', $firstname);
			$stmt->bindParam(':lastname', $lastname);
			
			
			if($stmt->execute()){
				$_SESSION['success'] = "You have successfully created an account";

				header('location: register.php');
			}
		}
		

	}
?>