<?php 
session_start();
if(!$_SESSION['login']){
	$_SESSION['error']="You don't have privilage to access this page! Please consider registering or loging in as your session might have expired.";
	header('location:index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1"/>
		<link rel="shortcut icon" type="image/png" href="img/fav-icon.png"/>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
		<link rel="stylesheet" type="text/css" href="css/style.css"/>
		<title>Calculator</title>
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
	<h4 class="text-primary">On this simple online calculator operators supported are +, -, *, / and you can also use parenthesis in your expression.</h4>
		<hr style="border-top:1px dotted #ccc;"/>
		
		<div class="col-md-3"></div>
		<div class="col-md-6">
			
			<form">	
				<div class="alert alert-info">Input your mathematical expression in the following field</div>
				<div class="form-group">
					<label>Expression</label>
					<input type="text" name="expression" id="expression" class="form-control" required="required"/>
				</div>
                <button class="btn btn-primary btn-block" id = "submit" name="calculate"><i class="glyphicon glyphicon-chevron-right"></i><i class="glyphicon glyphicon-chevron-right"></i> See result</button>
				<div class="form-group">
					<label>Result</label>
					<input type="text" disabled id="result" name="result" class="form-control"/>
				</div>
			</form>	
			
		</div>
	</div>
</body>
<script src = "js/jquery-3.3.1.min.js"></script>
<script src = "js/bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
    
        $("#submit").click(function() {
            var expressionData = $("#expression").val();
            var element = document.getElementById('submit');
            element.setAttribute("disabled", "disabled");
            if(expressionData=='') {
                return false;
            }
                
            $.ajax({
                    type: "POST",
                    url: "calculation_processor.php",
                data: {
                    expressionData: expressionData
                },
                cache: false,
                success: function(data) {
                    document.getElementById("result").value = data;
                    document.getElementById('submit').disabled = false;
                },
                error: function(xhr, status, error) {
                    console.error(xhr);
                }
            });
        
        });
    
    });
</script>
</html>
