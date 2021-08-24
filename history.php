<!DOCTYPE html>
<?php 

session_start();
    $start = $_SESSION['start'];
    $offset = $_SESSION['offset'];
if(!$_SESSION['login']){
	$_SESSION['error']="You don't have privilage to access this page! Please consider registering or loging in as your session might have expired.";
	header('location:index.php');
}
require_once 'dbcon.php';

$username = $_SESSION['username'];
$query = "SELECT question_id, expression, result FROM `history` WHERE `byuser` = :username LIMIT :start OFFSET :offset";
$stmt = $dbcon->prepare($query);
$stmt->bindParam(':username', $username);
$stmt->bindParam(':offset', $offset);
$stmt->bindParam(':start', $start);
$stmt->execute();
// $row = $stmt->fetch();

?>
<html lang="en">
	<head>
		<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1"/>
		<link rel="shortcut icon" type="image/png" href="img/fav-icon.png"/>
		<title>History</title>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
		<link rel="stylesheet" type="text/css" href="css/style.css"/>
	</head>
<body>
<nav class="navbar bg-primary">
		<div class="container-fluid">
			<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#myNavbar">
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
		<h3 class="text-primary">History of your calculated math expressions.</h3>
		<hr style="border-top:1px dotted #ccc;"/>
		
		<b>The followings are list of expression you have calculated so far. You can use the next button to show the next page of the history.</b>
        <form method = "POST" action = "retreive_history.php">
            <select class = "form-control" name = "start">
                <option <?php if ($_SESSION['selectedoption']==10){ echo "selected"; } ?> value="10">10</option>
                <option <?php if ($_SESSION['selectedoption']==15){ echo "selected"; } ?> value="15">15</option>
                <option <?php if ($_SESSION['selectedoption']==20){ echo "selected"; } ?> value="20">20</option>
                <option <?php if ($_SESSION['selectedoption']==25){ echo "selected"; } ?> value="25">25</option>
                <option <?php if ($_SESSION['selectedoption']==30){ echo "selected"; } ?> value="30">30</option>
                <option <?php if ($_SESSION['selectedoption']==35){ echo "selected"; } ?> value="35">35</option>
                <option <?php if ($_SESSION['selectedoption']==40){ echo "selected"; } ?> value="40">40</option>
            </select>
            <button class="btn btn-primary" <?php if ($_SESSION['disableprev']==true){ echo "disabled"; } ?> name="prev"><span class="glyphicon glyphicon-chevron-left"></span> Previous</button>
            <button class="btn btn-primary" <?php if ($_SESSION['disablenext']==true){ echo "disabled"; } ?> name="next"><span class="glyphicon glyphicon-chevron-right"></span> Next</button>

        </form>
		<br style="clear:both;"/><br />
		<!-- <div class="col-md-3"></div>
		<div class="col-md-6"> -->
            <table class = "table table-hover table-striped">
                <thead class = "active">
                    <tr>
                        <th scope="col">R.no</th>
                        <th scope="col">Expression</th>
                        <th scope="col">Result</th>
                    </tr>
                </thead>
                <tbody>
			<?php 
            $i=$offset;
            while($ret = $stmt->fetch(\PDO::FETCH_ASSOC) ){
                $data[]=array('question_id'=>$ret['question_id'],'expression'=>$ret['expression'],'result'=>$ret['result']);
                }
                foreach($data as $rows){
					$i++;
             ?>
                <tr>
                    <th scope="row"><?php echo $i; ?></th>
                    <td><?php echo $rows['expression']; ?></td>
                    <td><?php echo $rows['result']; ?></td>
                    </tr>
            <?php } 
            // $_SESSION['offset']+=$_SESSION['offset'];
            ?>
                </tbody>
            </table>
		<!-- </div> -->
	</div>
</body>
<script src = "js/jquery-3.3.1.min.js"></script>
<script src = "js/bootstrap.min.js"></script>
</html>