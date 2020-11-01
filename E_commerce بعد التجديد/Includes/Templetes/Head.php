<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title><?php gettitle(); ?></title>
		<link rel="stylesheet" href="<?php echo $css ?>bootstrap.min.css"/>
		<link rel="stylesheet" href="<?php echo $css ?>font-awesome.min.css"/>
		<link rel="stylesheet" href="<?php echo $css ?>jquery.selectBoxIt.css"/>
		<link rel="stylesheet" href="<?php echo $css ?>ui.css"/>
		<link rel="stylesheet" href="<?php echo $css ?>front9.css"/>
	</head>
	<body>
	<html>
	<html>
<head>
	<style>
	 .nav
{
	background-color:#000;

	height:65px;
}

  .nav h2
{
	float :left;
	margin-top:2px;
	color:#9b9595;
	margin-left:20px;
	font-size:35px;
}

  .nav h2 mark
{
	color:#fff;
	font-size:30px;
	background:none;
}


  .nav ul{
	list-style:none;
	margin:auto;
	float:right;
	margin-top:23px;


}
 .nav li{
	float :left;
	margin-right:20px;
	font-weight:bold

}

  .nav li a{
	text-decoration:none;
	color:#000;
	position:relative;
	bottom:20px;
	right:0px;
	transition:all linear 0.4s;
	background:#eee;
	padding:5px;
	border-radius:5px;
	
}

  .nav li a:hover{
	color:#222;
	background:#fff;
	padding:5px;
	border-radius:5px;
	text-decoration:none
}
.log1{
	color:#d3c4c4;
	font-weight:bold;
	position:relative;
	top:3px;
	transition:all ease-out 0.3s;
}
.log1:hover{
	color:#222;
	background:#eee;
	padding:5px;
	border-radius:5px;
	text-decoration:none
	
}


.upper{
	position:relative;
	height:70px;
	overflow:hidden;
	background:#6d6b6b
}
.upper .img{
	width:60px;
	height:60px;
	position:relative;
	border-radius:50%;
	bottom:3px;
	border:3px solid #eee;
}
.upper .link{
	position:relative;
	font-weight:bold;
	font-size:17px;
	bottom:12px
}
.upper .link ul li{
	color:#777;
	position:relative;
	bottom:45px;
	float :left;
	margin-right:25px;
	font-weight:bold
	transition:all linear 0.3s;
}

.upper .link ul li a{
	color:#222;
	background:#eee;
	border-radius:5px;
	padding:4px 5px;
	transition:all linear 0.3s;
}
.upper .link ul li a:hover{
		color:#222;
	background:#fff;
	border-radius:5px;
	padding:4px 5px;
	text-decoration:none;
	text-decoration:none;
}
.upper ul{
	margin:auto;
	float:right;

}
.log{
	position:relative;
	top:12px;
	background:#fff;
	border-radius:10px;
	width:155px;
	padding:7px
}
.log .lo{

	transition:all linear 0.3s;
}
.log .lo:hover{
	text-decoration:none;
	background:#000;
	padding:6px;
	color:#fff;
	border-radius:10px;
}

	
	</style>
</head>
		<div class = "upper">
			<div class = "content">
			<div class = "link">
				<?php
					if(isset($_SESSION['user'])){ ?>
					<?php	
					
					
					echo "<img class = 'img-responsive img ' src ='down2.png' alt = 'no' />";
					echo "<ul class = 'list-unstyled'>";
					echo "<li>" . "<a href = 'Logout.php'>" . "logout" . "</a>" . "   " . "</li>";
					echo "<li>" . "<a href = 'Add.php'>" . "New Item" . "</a>" . "   " . "</li>";
					echo "<li>" . "<a href = 'Profile.php'>" . "My profile  " . "</a>" . "</li>";
					echo "</ul>";
		
				/*	$status = getstatus($_SESSION['user']);
					echo $status;*/
					}	
					else{
				?>
				<div class = "log">
				<a href = "Log.php?do=Login" class = "lo">Login</a>
				|
				<a href = "Log.php?do=Sign" class = "lo">Sign Up</a>
				</div>
					<?php } ?>
			</div>
			</div>
		</div>

<div class="navbar-responsive">
<div class="nav">

		<h2>E<mark>_Commerce</mark></h2>
		<div class = 'content'>
		<a href="Login1.php" target="_self" class = "log1">Home Page</a>
			<ul>
			<?php
				$stmt = $con->prepare("select * from categories where parent = 0 order by id asc ");
				$stmt->execute();
				$row = $stmt->fetchAll();
				foreach($row as $cat){
					echo "<li>" . "<a href = 'Cate1.php?pageid=" . $cat['id'] . "'>" . $cat['name'] . "</a>" . "</li>";
				}
				?>
			</ul>
		</div>
		</div>
		</div>
		</html>