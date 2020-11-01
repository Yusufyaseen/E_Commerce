<?php
session_start();
$pagetitle = "Login & signup";

 include "Init.php"; 

	/*
	$hashed = sha1($_POST['pass']);
	$stmt = $con->prepare("SELECT  userid , username , password from user where username = ? AND password = ? ");
	$stmt->execute(array($username,$hashed));
	$row = $stmt->fetch();
	$count = $stmt->rowCount();
	if ($count>0){
		$_SESSION['user']=$username;
		$_SESSION['id']=$row['userid'];
		header('location:Dash.php');
	}*/

$do = "";
	if(isset($_GET['do'])){
		$do = $_GET['do'];
	}
	
	
	if($do=="Login"){
		?>
		<div class = "content">
			<h1 class = "text-center" id = "login">Login</h1><hr>
			<form class="login" action="?do=Confirm" method="POST">
				<input type = "text" class = "form-control" class = "control" name = "user" placeholder = "Enter your name" autocomplete = "off"/>
				<input type = "password" class = "form-control" class = "control" name = "pass" placeholder = "Enter your password" autocomplete = "new-password"/>
				<input type = "submit" value = "Login" class = "btn btn-primary btn-block"/>
			</form>
		</div>
		
<?php	}
	elseif($do=="Confirm"){
		if($_SERVER['REQUEST_METHOD']=="POST"){
	$user = $_POST['user'];
	$pass = $_POST['pass'];
	$hashed = sha1($_POST['pass']);
	$stmt = $con->prepare("SELECT * from user where username = ? AND password = ? AND regstatus = 1 ");
	$stmt->execute(array($user,$hashed));
	$count = $stmt->rowCount();
	$row = $stmt->fetch();
	if ($count>0){
		$_SESSION['user']=$user;
		$_SESSION['uid']=$row['userid'];
		header('location:Login1.php');
		exit();
	}
	else{
		echo "<div class = 'content'>";
		$msg =  "<div class = 'alert alert-danger' >" . "You should be activated or enter a valid e_mail" .  "</div>";
		redirect($msg,4);
		echo "</div>";
	}
}
	}
		elseif($do=="Csn"){
		  if($_SERVER['REQUEST_METHOD']=="POST"){
			$user = $_POST['user'];
			$pass = $_POST['pass'];
			$pass2 = $_POST['pass2'];
			$email = $_POST['email'];
			$full = $_POST['full'];
			$errors = array();
			$filteruser = filter_var($_POST['user'],FILTER_SANITIZE_STRING);
			$filterfull = filter_var($_POST['full'],FILTER_SANITIZE_STRING);
			if(strlen($filteruser) < 4){
				$errors[] = "You should put more than 4 chars";
			}
			if(strlen($filterfull) < 6){
				$errors[] = "You should put more than 4 chars";
			}
			if(empty($pass)){
				$errors[] = "You should put password";
			}
			if( $pass < 6){
				$errors[] = "You should put password > 6";
			}
			if(sha1($pass) !== sha1($pass2)) {
				$errors[] = "Passwords must be identically";
			}
			$filteremail = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
			if(filter_var($filteremail,FILTER_VALIDATE_EMAIL)!= true){
				$errors[] = "You should put email valid";
			}
		    foreach($errors as $ers){
				echo "<div class = 'content'>";
				echo "<div class = 'alert alert-danger'  >" . $ers . "<br>" . "</div>";
				echo "</div>";
			}
			if(empty($errors)){
			$Count = check("username","user",$filteruser);
			if($Count>0){
			echo "<div class = 'content'>";
			$msg = "<div class = 'alert alert-danger'  >" . "Sorry this user is exists" . "</div>";
			redirect($msg,4);
			echo "</div>";
		}
		else{
		$stm = $con->prepare("insert into  user(username,password,email,fullname,regstatus,date) values(:user, :pass, :email, :full,0,now()) ") ;
		$stm->execute(array( 
			'user' => $filteruser,
			'pass' => sha1($pass),
			'email' => $filteremail,
			'full' => $filterfull,
			
		));
		echo "<div class = 'content'>";
		$msg =  "<div class = 'alert alert-success' >" . $stm->rowCount() . " Record registered & You should wait the activation" .  "</div>";
		redirect($msg,4);
		echo "</div>";
	}
}
			
}
	}
		
	elseif($do=="Sign"){
		
		?>
		<div class = "content">
			<h1 class = "text-center" id = "sign">Signup</h1><hr>
			<form class="login" action="?do=Csn" method="POST">
				<input type = "text" class = "form-control" class = "control" pattern = ".{4,}" title = "You should put more than 4 chars" name = "user" placeholder = "Enter your name" autocomplete = "off" required />
				<input type = "password" class = "form-control" class = "control"  pattern = ".{4,}" title = "You should put more than 4 points"  name = "pass" placeholder = "Enter your password" autocomplete = "new-password" required />
				<input type = "password" class = "form-control" class = "control"  pattern = ".{4,}" title = "You should put more than 4 points"  name = "pass2" placeholder = "Check your password" autocomplete = "new-password" required />
				<input type = "email" class = "form-control" class = "control" pattern = ".{4,}" title = "You should put more than 4 chars"  name = "email" placeholder = "Enter your email" autocomplete = "off"/ required >
				<input type = "text" class = "form-control" class = "control" pattern = ".{6,}" title = "You should put more than 6 chars"  name = "full" placeholder = "Enter your fullname" autocomplete = "off"/ required >
				<input type = "submit" value = "SignUp" class = "btn btn-success btn-block"/>
			</form>
		</div>
<?php	} 
include $tpl . "Footer.php" ?>