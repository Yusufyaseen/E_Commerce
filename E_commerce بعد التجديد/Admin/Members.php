<?php 
session_start();
$nonav2 = "";
$pagetitle = "Edit profile";
if(isset($_SESSION['username'])){
include "Init.php";
if(isset($_GET['do'])){
	$do = $_GET['do'];
}
else{
	$do = "Manage";
}
if($do=="Manage"){
	$query = "";
	if(isset($_GET['page']) && $_GET['page']=="pending"){
		$query = "and regstatus = 0";
	}
	$stmt=$con->prepare("select * from user where groupid!=1 $query order by userid desc");
	$stmt->execute();
	$rows=$stmt->fetchAll();
	if(! empty($rows)){
	?>
			
			<div class = "content1" >
			<h1 class = "text-center">Manage member </h1><hr>
			<div class="table-responsive" id="#cont">
			<table class="main-color text-center table table-bordered" id="tbl">
				<thead>
				<tr>
					<td>Id</td>
					<td>Username</td>
					<td>Fullname</td>
				    <td>Email</td>
					<td>Registered Date</td>
					<td>Control</td>
				</tr>
				</thead>
				<?php
				foreach($rows as $row){
					echo "<tr>";
						echo "<td>" . $row['userid'] . "</td>";
						echo "<td>" . $row['username'] . "</td>";
						echo "<td>" . $row['fullname'] . "</td>";
						echo "<td>" . $row['email'] . "</td>";
						echo "<td>" . $row['date'] . "</td>";
						echo "<td> 
									<a href='Members.php?do=Edit&userid=" . $row['userid'] ."' class='btn btn-success'><i class = 'fa fa-edit'></i>Edit</a>
									<a href='Members.php?do=Delete&userid=" . $row['userid'] ."' class='btn btn-danger confirm'><i class = 'fa fa-close'></i>Delete</a> ";
									if($row['regstatus']==0){
										echo "<a href='Members.php?do=Activate&userid=" . $row['userid'] ."' class='btn btn-info confirm'><i class = 'fa fa-check'></i>Activate</a> ";
									}
						echo "</td>";
					echo "</tr>";
				}
				?>
			</table>
			</div>
				<a href = 'Members.php?do=Add' class="btn btn-primary" id="aa"><i class="fa fa-plus"></i> New Members</a>
				</div>
			
<?php

}
else{
	echo "<div class = 'content'>";
	echo "<div class = 'no'>" . "There is not members to show" . "</div>";
	echo "</div>";
	echo "<div class = 'btn8'>" . "<a href = 'Members.php?do=Add' class='btn btn-sm btn-primary'>" . "<i class='fa fa-plus'>" . "</i>" . ' Add Member' . "</a>" . "</div>";
} }
elseif($do=="Add"){?>
			  
			<div class = "content">
			<h1 class = "text-center" id = "cad"> Add new member </h1><hr>
			<div class = "conc">
				<form class = "add" action = "?do=Insert" method = "post" enctype = "multipart/form-data"> 
			    	<fieldset>
					<legend id = "lgd"><img class = 'img-responsive img' src ='e.jpg' alt = 'no'></legend>
					<label class = "col-sm-1 control-label">Username </label>
					<input type = "text" name = "user" class = "form-control" autocomplete = "off" autofocus = "on" required placeholder = "Enter your name" ?>
					<label class = "col-sm-1 control-label">Password </label>
					<input type = "password" name = "pass" class = "form-control"  autocomplete = "new-password" placeholder = "Enter your password">
					<label class = "col-sm-1 control-label">E_mail </label>
					<input type = "email" name = "email" class = "form-control" required placeholder = "Enter your e_mail" autocomplete = "on">
					<label class = "col-sm-2 control-label">Full name </label>
					<input type = "text" name = "full" class = "form-control" required placeholder = "Enter your full name" autocomplete = "off">
					<label class = "col-sm-2 control-label">File</label>
					<input type = "file" name = "avatar" class = "form-control" required >
					<input type = "submit" value = "Add member" class = "btn btn-primary" id = "bttn">
					</fieldset>
				</form>
			</div>
			</div>
<?php

}
elseif($do=="Insert"){
	if($_SERVER['REQUEST_METHOD']=="POST"){
		echo "<h1 class = 'text-center'>Insert member</h1>" . "<hr>";
		$avatarname = $_FILES['avatar']['name'];
		$avatarsize = $_FILES['avatar']['size'];
		$avatartmp = $_FILES['avatar']['tmp_name'];
		$avatartype = $_FILES['avatar']['type'];
		$avatarallowex = array("jpeg", "png", "jpg", "gif");
		$avatarex=strtolower(end(explode('.',$avatarname)));
		$username = $_POST['user'];
		$email = $_POST['email'];
		$fullname = $_POST['full'];
		$password = sha1($_POST['pass']);
		$fe = array();
		if(empty($username)){
			$fe[] = "You should put username ";
		}
		if(empty($password)){
			$fe[] = "You should put password ";
		}
		if(empty($email)){
			$fe[] = "You should put email ";
		}
		if(empty($fullname)){
			$fe[] = "You should put fullname ";
		}
		if(!empty($avatarname) && ! in_array($avatarex,$avatarallowex)){
			$fe[] = "The Extention is not" . "<strong>". " Allowed " . "</strong>" . "here";
		}
		if(empty($avatarname) ){
			$fe[] = "Avatar Is" . "<strong>". "Required" . "</strong>";
		}
		if($avatarsize > 4194304){
			$fe[] = "Avatar Is" . "<strong>". " bid " . "</strong>";
		}
		foreach($fe as $errors){
			echo "<div class = 'content'>";
			echo "<div class = 'alert alert-danger'>" . $errors . "</div>";
			echo "</div>";
		}
		if(empty($fe)){
		$Count = check("username","user",$username);
		if($Count>0){
			echo "<div class = 'content'>";
			$msg = "<div class = 'alert alert-danger'  >" . "Sorry this user is exists" . "</div>";
			redirect($msg,4);
			echo "</div>";
		}
		else{
		$stm = $con->prepare("insert into  user(username,password,email,fullname,regstatus,date) values(:user, :pass, :email, :full,1,now()) ") ;
		$stm->execute(array( 
			'user' => $username,
			'pass' => $password,
			'email' => $email,
			'full' => $fullname
		));
		echo "<div class = 'content'>";
		$msg =  "<div class = 'alert alert-success' >" . $stm->rowCount() . "Record registered" .  "</div>";
		redirect($msg,4);
		echo "</div>";
	}
}}

else{
	echo "<div class = 'content'>";
	$msg = "<div class = 'alert alert-danger'> Sorry you can not browse this page directly </div>";
	 redirect($msg,4);
	 echo "</div>";
}
}
elseif($do=="Edit"){ 

	if(isset($_GET['userid']) && is_numeric($_GET['userid'])){
		$userId = $_GET['userid'];
		$stmt = $con->prepare("SELECT *  from user where userid = ?  ");
		$stmt->execute(array($userId));
		$row = $stmt->fetch();
		$count = $stmt->rowCount();
		if($count>0){ ?>
			<div class = "content">
			<h1 class = "text-center"> Edit member </h1><hr>
			<div class = "conc">
				<form class = "edit" action = "?do=Update" method = "post"> 
				<fieldset>
					<legend id = "lgd"><img class = 'img-responsive img' src ='fo2.png' alt = 'no'></legend>
					<input type = "hidden" name = "id" value = "<?php echo $userId ?>" >
					<label class = "col-sm-1 control-label">Username </label>
					<input type = "text" name = "user" class = "form-control" autocomplete = "off" autofocus = "on" required placeholder = "Enter your name" value = "<?php echo $row['username'] ?>" >
					<label class = "col-sm-1 control-label">Password </label>
					<input type = "hidden" name = "oldpass" value = "<?php echo $row['password'] ?>">
					<input type = "password" name = "newpass" class = "form-control"  autocomplete = "new-password" placeholder = "Enter your password" >					
					<label class = "col-sm-1 control-label">E_mail </label>
					<input type = "email" name = "email" class = "form-control" required placeholder = "Enter your e_mail" value = "<?php echo $row['email'] ?>" >
					<label class = "col-sm-2 control-label">Full name </label>
					<input type = "text" name = "full" class = "form-control" required placeholder = "Enter your full name"  value = "<?php echo $row['fullname'] ?>" >
					<label class = "col-sm-2 control-label">File</label>
					<input type = "file" name = "avatar" class = "form-control" required placeholder = "Enter your full name"  value = "<?php echo $row['avatar'] ?>" >
					<input type = "submit" value = "Save" class = "btn btn-primary" id = "btn">
				</fieldset>
				</form>
			</div>
			</div>

	<?php }
		else {
			echo "<div class='content'>";
			$msg = "<div class = 'alert alert-danger'>There is no such id here</div>";
			redirect($msg,4);
			echo "</div>";
		}
	}

}
elseif($do=="Update"){
	
	if($_SERVER['REQUEST_METHOD']=="POST"){
		$userid = $_POST['id'];
		$username = $_POST['user'];
		$email = $_POST['email'];
		$fullname = $_POST['full'];
		$fe = array();
		if(empty($username)){
			$fe[] = "You should put username ";
		}

		if(empty($email)){
			$fe[] = "You should put email ";
		}
		if(empty($fullname)){
			$fe[] = "You should put fullname ";
		}
		foreach($fe as $errors){
			echo "<div class = 'alert alert-danger'>" . $errors . "</div>";
		}
		if(empty($_POST['newpass'])){
			$pass = $_POST['oldpass'];
		}
		else{
			$pass = sha1 ($_POST['newpass']);
		}
		
		if(empty($fe)){
			$stmt2 = $con->prepare("select username from user where username = ? and userid != ?");
			$stmt2->execute(array($username, $userid));
			$count2 = $stmt2->rowCount();
			if($count2>0){
			echo "<div class = 'content'>";
			$msg = "<div class = 'alert alert-danger'  >" . "Sorry this user is exists" . "</div>";
			redirect($msg,4);
			echo "</div>";
			}
			else{
		
		$stm = $con->prepare("update user SET username = ?,email = ?,fullname = ?, password = ? WHERE userid = ? ") ;
		$stm->execute(array($username, $email, $fullname,$pass, $userid));
		echo "<div class = 'content'>";
		echo "<h1 class = 'text-center'>Update member</h1>" . "<hr>";
		$msg ="<div class = 'alert alert-success'>" . $stm->rowCount() . ' Has Updated' . "</div>";
		redirect($msg,4);
		echo "</div>";
	}}}
else{
			$msg = "<div class = 'alert alert-danger'>Sorry you can not browse this page directly</div>";
			redirect($msg,4);
} 
		}

elseif($do=="Delete"){
		
		if(isset($_GET['userid']) && is_numeric($_GET['userid'])){
		$userId = $_GET['userid'];
		$stmt = $con->prepare("SELECT * from user where userid = ?  ");
		$stmt->execute(array($userId));
		$row = $stmt->fetch();
		$count = $stmt->rowCount();
		if($count>0){
			$stmt=$con->prepare("delete from user where userid = ?");
			$stmt->execute(array($userId));
			echo "<div class = 'content'>";
			echo "<h1 class = 'text-center'>Delete page</h1>" . "<hr>";
				$msg = "<div class = 'alert alert-success' >" . $stmt->rowCount() ." Record Deleted"  . "</div>"; 
				redirect($msg,3);
				echo "</div>";
			}
			
		else {
			echo "<div class = 'content'>";
			$msg = "<div class = 'alert alert-danger'>Sorry this user id is not existed</div>";
			redirect($msg,4);
			echo "</div>";
		}


}}
elseif($do=="Activate"){
		echo "<h1 class = 'text-center'>Activate members</h1>" . "<hr>";
		if(isset($_GET['userid']) && is_numeric($_GET['userid'])){
		$userId = $_GET['userid'];
		$stmt = $con->prepare("SELECT * from user where userid = ?  ");
		$stmt->execute(array($userId));
		$row = $stmt->fetch();
		$count = $stmt->rowCount();
		if($count>0){
			$stmt=$con->prepare("update user set regstatus = 1 where userid = ?");
			$stmt->execute(array($userId));
			echo "<div class = 'content'>";
				$msg = "<div class = 'alert alert-success' >" . $stmt->rowCount() ." Record updated"  . "</div>"; 
				redirect($msg,3);
				echo "</div>";
			}
			
		else {
			echo "<div class = 'content'>";
			$msg = "<div class = 'alert alert-danger'>Sorry this user id is not existed</div>";
			redirect($msg,4);
			echo "</div>";
		}


}		
		}
include $tpl . "Footer.php";
}
else {
	include "Login.php";
}

?>
