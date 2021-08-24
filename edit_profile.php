<?php
	session_start();
	require_once 'dbcon.php';
	if(ISSET($_POST['update'])){
        $username = $_SESSION['username'];
		$firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
		$newpassword = $_POST['newpassword'];
		$oldpassword = $_POST['oldpassword'];
        $uppercase = preg_match('@[A-Z]@', $newpassword);
		$lowercase = preg_match('@[a-z]@', $newpassword);
		$number    = preg_match('@[0-9]@', $newpassword);
        // $encnewpassword=md5($newpassword);
        if ($newpassword !=""){
            if (strlen($newpassword) < 8 ) {
    			$_SESSION['error']= "Password cannot be less than 8 character.";
    			header('location: profile.php');
    		}
    		else if (!$uppercase ) {
    			$_SESSION['error']= "Password must contain at least one Upercase letter";
    			header('location: profile.php');
    		}
    		else if (!$lowercase) {
    			$_SESSION['error']= "Password must contain at least one Lowercase Letter";
    			header('location: profile.php');
    		}
    		else if (!$number) {
    			$_SESSION['error']= "Password must contain at least one number";
    			header('location: profile.php');
    		}
        }
        if(empty($firstname) && empty($lastname) && empty($newpassword)){
            $_SESSION['error']="No information is changed";
            header('location:profile.php');
        }
        
		$query = "SELECT password FROM `user` WHERE `username` = :username";
		$stmt = $dbcon->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $row = $stmt->fetch();
        if(empty($oldpassword)){
            $_SESSION['error'] = "You need to provide your old passwrod to make any change to your profile!";
            header('location:profile.php');
        }
        if ($row['password']==md5($oldpassword)){
            // echo empty($newpassword);
            if (!empty($newpassword)){
                if(!empty($firstname)){
                    if(!empty($lastname)){
                        $querytwo = "UPDATE user SET password = :newpassword, firstname = :firstname, lastname = :lastname WHERE `username` = :username AND `password` = :oldpassword";
                        $stmttwo = $dbcon->prepare($querytwo);
                        // $newpassword=md5($newpassword);
                        $stmttwo->bindParam(':newpassword', md5($newpassword));
                        $stmttwo->bindParam(':firstname', $firstname);
                        $stmttwo->bindParam(':lastname', $lastname);
                        $stmttwo->bindParam(':username', $username);
                        $stmttwo->bindParam(':oldpassword', md5($oldpassword));
                    }
                    else {
                        
                        $querytwo = "UPDATE user SET password = :newpassword, firstname = :firstname WHERE `username` = :username AND `password` = :oldpassword";
                        $stmttwo = $dbcon->prepare($querytwo);
                        // $newpassword=md5($newpassword);
                        $stmttwo->bindParam(':newpassword', md5($newpassword));
                        $stmttwo->bindParam(':firstname', $firstname);
                        $stmttwo->bindParam(':username', $username);
                        $stmttwo->bindParam(':oldpassword', md5($oldpassword));
                    }
                }
                else if(!empty($lastname)){
                    $querytwo = "UPDATE user SET password = :newpassword, lastname = :lastname WHERE `username` = :username AND `password` = :oldpassword";
                    $stmttwo = $dbcon->prepare($querytwo);
                    // $newpassword=md5($newpassword);
                    $stmttwo->bindParam(':newpassword', md5($newpassword));
                    $stmttwo->bindParam(':lastname', $lastname);
                    $stmttwo->bindParam(':username', $username);
                    $stmttwo->bindParam(':oldpassword', md5($oldpassword));
                }
                else {
                    $querytwo = "UPDATE user SET password = :newpassword WHERE `username` = :username AND `password` = :oldpassword";
                    $stmttwo = $dbcon->prepare($querytwo);
                    // $newpassword=md5($newpassword);
                    $stmttwo->bindParam(':newpassword', md5($newpassword));
                    $stmttwo->bindParam(':username', $username);
                    $stmttwo->bindParam(':oldpassword', md5($oldpassword));
                }
            }
            else if (!empty($firstname)){
                if(!empty($lastname)){
                    $querytwo = "UPDATE user SET firstname = :firstname, lastname = :lastname WHERE `username` = :username AND `password` = :oldpassword";
                    $stmttwo = $dbcon->prepare($querytwo);
                    $stmttwo->bindParam(':firstname', $firstname);
                    $stmttwo->bindParam(':lastname', $lastname);
                    $stmttwo->bindParam(':username', $username);
                    $stmttwo->bindParam(':oldpassword', md5($oldpassword));
                }
                else {
                    
                    $querytwo = "UPDATE user SET firstname = :firstname WHERE `username` = :username AND `password` = :oldpassword";
                    $stmttwo = $dbcon->prepare($querytwo);
                    $stmttwo->bindParam(':firstname', $firstname);
                    $stmttwo->bindParam(':username', $username);
                    $stmttwo->bindParam(':oldpassword', md5($oldpassword));
                }
            }
            else if(!empty($lastname)) {
                
                $querytwo = "UPDATE user SET lastname = :lastname WHERE `username` = :username AND `password` = :oldpassword";
                $stmttwo = $dbcon->prepare($querytwo);
                $stmttwo->bindParam(':lastname', $lastname);
                $stmttwo->bindParam(':username', $username);
                $stmttwo->bindParam(':oldpassword', md5($oldpassword));
            }
            else {
                $_SESSION['error']="No information is changed";
                header('location:profile.php');
            }

            if($stmttwo->execute()){
                // $_SESSION['success']="You have succefully updated your information!";
			    header('location:profile.php');
            }
            else {
                $_SESSION['error'] = "You have to input at least one information to save a change!";
			    header('location:profile.php');
            }

        }
        else {
            $_SESSION['error'] = "Make sure your old password is correct!";
			header('location:profile.php');
        }
	}
?>
