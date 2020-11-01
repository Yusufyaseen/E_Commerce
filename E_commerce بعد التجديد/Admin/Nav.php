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
	margin-top:12px;
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
	float:right;
	margin-bottom:10px;
	position:relative;
	bottom:30px;
}
 .nav li{
	float :left;
	margin-right:25px;
	font-weight:bold

}

  .nav li a{
	text-decoration:none;
	color:#dddbdb;
	transition:all ease-in-out 0.4s;
	
}

  .nav li a:hover{
	color:#222;
	background:#eee;
	padding:5px;
	border-radius:5px;
	text-decoration:none

}
#logoo{
	width:55px;
	height:55px;
	left:20px;
	position:relative;
	border-radius:50%;
	top:4px;
	border:3px solid #eee;
}
	</style>
</head>
<div class="navbar-responsive">
<div class="nav">

		<h2>E<mark>_Commerce</mark></h2>
		<img class = 'img-responsive img ' id = "logoo" src ='down2.png' alt = 'no' />
			<ul>
				<li><a href="Dash.php" target="_self" >Home</a></li>
				<li><a href="../Login1.php" target="_self" >Visit Shop</a></li>
				<li><a href="Logout.php" target="_self">Logout</a></li>
				<li><a href="Members.php?do=Edit&userid=<?php echo $_SESSION['id'] ?>" target="_self">Edit profile</a></li>
				<li><a href="Members.php?do=Manage">Members</a></li>
				<li><a href="Cate.php?do=Manage" target="_self">Categories</a></li>
				<li><a href="Items.php" target="_self">Items</a></li>
				<li><a href="Comments.php?do=Manage" target="_self">Comments</a></li>
			</ul>
		</div>
		</div>
		</html>