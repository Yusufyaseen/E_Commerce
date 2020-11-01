<?php 
session_start();
$nonav = "";
$pagetitle = "gbrnerth";
include "Init.php";
if($_SERVER['REQUEST_METHOD']=="POST"){
	$username = $_POST['user'];
	$hashed = sha1($_POST['pass']);
	$stmt = $con->prepare("SELECT * from user where username = ? AND password = ?  AND groupid=1 ");
	$stmt->execute(array($username,$hashed));
	$row = $stmt->fetch();
	$count = $stmt->rowCount();
	if ($count>0){
		/*$_SESSION['username']=$username;
		$_SESSION['id']=$row['userid'];
		header('location:Dash.php');*/
		echo "erro";
	}
	else{
		echo "erro";
	}
}


?>
	
	<form class="login" action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
		<h4>Admin login</h4>
		<input type = "text" class = "form-control" class = "control" name = "user" placeholder = "Enter your name" autocomplete = "off"/>
		<input type = "password" class = "form-control" class = "control" name = "pass" placeholder = "Enter your password" autocomplete = "new-password"/>
		<input type = "submit" value = "Login" class = "btn btn-primary btn-block"/>
	</form>
<?php include $tpl . "Footer.php" ?>