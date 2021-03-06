<?php 
error_reporting(0);
session_start();
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1"/>
		<link rel="shortcut icon" type="image/png" href="img/fav-icon.png"/>
		<title>Register</title>
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
			<a class="navbar-brand" href="index.php">Online Calculator</a>
			</div>
			<div class="collapse navbar-collapse" id="myNavbar">
			<ul class="nav navbar-nav navbar-right">
				<li><a href="register.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
				<li><a href="index.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
			</ul>
			</div>
		</div>
	</nav>
	<div class="col-md-3"></div>
	<div class="col-md-6 well">
		<h3 class="text-primary">Simple Online Calculator</h3>
		<hr style="border-top:1px dotted #ccc;"/>
		
		<a href="index.php">Already a member? Log in here...</a>
		<br style="clear:both;"/><br />
		<div class="col-md-3"></div>
		<div class="col-md-6">
			
			<form method="POST" action="create_account.php">	
				<div class="alert alert-info">Registration</div>
				<div class="form-group">
					<label>Username</label>
					<input type="text" name="username" class="form-control" required="required"/>
				</div>
				<div class="form-group">
					<label>Password</label>
					<input type="password" name="password" class="form-control" required="required"/>
				</div>
				<div class="form-group">
					<label>Firstname</label>
					<input type="text" name="firstname" class="form-control" required="required"/>
				</div>
				<div class="form-group">
					<label>Lastname</label>
					<input type="text" name="lastname" class="form-control" required="required"/>
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
				<button class="btn btn-primary btn-block" name="register"><span class="glyphicon glyphicon-save"></span> Register</button>
			</form>	
			
		</div>
	</div>
</body>
<script src = "js/jquery-3.3.1.min.js"></script>
<script src = "js/bootstrap.min.js"></script>
</html>