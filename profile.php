<?php 

session_start();
if(!$_SESSION['login']){
	$_SESSION['error']="You don't have privilage to access this page! Please consider registering or loging in as your session might have expired.";
	header('location:index.php');
}
require_once 'dbcon.php';

$username = $_SESSION['username'];

$query = "SELECT firstname, lastname, password FROM `user` WHERE `username` = :username";
$stmt = $dbcon->prepare($query);
$stmt->bindParam(':username', $username);
$stmt->execute();
$row = $stmt->fetch();

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1"/>
		<link rel="shortcut icon" type="image/png" href="img/fav-icon.png"/>
		<title>Profile</title>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
		<link rel="stylesheet" type="text/css" href="css/style.css"/>
	</head>
	<body>
	<nav class="navbar bg-primary">
		<div class="container-fluid">
			<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>                        
			</button>
			<a class="navbar-brand" href="calculator.php">Online Calculator</a>
			</div>
			<div class="collapse navbar-collapse" id="myNavbar">
			<ul class="nav navbar-nav">
				<li class="active"><a href="calculator.php">Calculator</a></li>
				<li><a href="history.php">History</a></li>
				<li><a href="profile.php">Profile</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<!-- <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li> -->
				<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
			</ul>
			</div>
		</div>
	</nav>
	<div class="col-md-2"></div>
	<div class="col-md-8 well">
		<h3 class="text-primary">Manage your profile</h3>
		<hr style="border-top:1px dotted #ccc;"/>
		
		<b>Fill the following details and press Save changes to edit your profile.</b>
		<br style="clear:both;"/><br />
		<div class="col-md-3"></div>
		<div class="col-md-6">
			
			<form method="POST" action="edit_profile.php">
				<div class="form-group">
					<label>Firstname</label>
					<input type="text" name="firstname" placeholder = "<?php echo $row['firstname'];?>" class="form-control" />
				</div>
				<div class="form-group">
					<label>Lastname</label>
					<input type="text" name="lastname" placeholder = "<?php echo $row['lastname'];?>" class="form-control" />
				</div>
				<div class="form-group">
					<label>Password</label>
					<input type="password" name="oldpassword" placeholder = "Fill your old password here" class="form-control" required="required"/>
				</div>
				<div class="form-group">
					<label>Password</label>
					<input type="password" name="newpassword" placeholder = "Fill your new password here" class="form-control" />
				</div>
				<?php
					
					if(ISSET($_SESSION['success'])){
				?>
				
				<div class="alert alert-success"><?php echo $_SESSION['success']?></div>
				<?php
					
					unset($_SESSION['success']);
					}
				?>
                <?php
					
					if(ISSET($_SESSION['error'])){
				?>
				
					<div class="alert alert-danger"><?php echo $_SESSION['error']?></div>
				<?php
					
						unset($_SESSION['error']);
					}
				?>
				<button class="btn btn-primary btn-block" name="update"><span class="glyphicon glyphicon-save"></span> Save changes</button>
			</form>	
			
		</div>
	</div>
</body>
<script src = "js/jquery-3.3.1.min.js"></script>
<script src = "js/bootstrap.min.js"></script>
</html>