<?php 
session_start();

$pagetitle = "Comments";
if(isset($_SESSION['username'])){
include "Init.php";
if(isset($_GET['do'])){
	$do = $_GET['do'];
}
else{
	$do = "Manage";
}
if($do=="Manage"){
	
	$stmt=$con->prepare("select comments.*,items.name as item_name,user.username as username from comments
	inner join items on items.id = comments.item_id
	inner join user on user.userid = comments.user_id
	order by id desc
	");
	$stmt->execute();
	$rows=$stmt->fetchAll();
	?>
			
			<div class = "content1">
			<h1 class = "text-center">Manage Comment </h1><hr>
			<div class="table-responsive" id="#cont">
			<table class="main-color text-center table table-bordered" id="tbl">
				<thead>
				<tr>
					<td>Id</td>
					<td>Comment</td>
					<td>Username</td>
				    <td>Item Name</td>
					<td>Registered Date</td>
					<td>Control</td>
				</tr>
				</thead>
				<?php
				foreach($rows as $row){
					echo "<tr>";
						echo "<td>" . $row['id'] . "</td>";
						echo "<td>" . $row['comment'] . "</td>";
						echo "<td>" . $row['item_name'] . "</td>";
						echo "<td>" . $row['username'] . "</td>";
						echo "<td>" . $row['date'] . "</td>";
						echo "<td> 
									<a href='Comments.php?do=Edit&comid=" . $row['id'] ."' class='btn btn-success'><i class = 'fa fa-edit'></i>Edit</a>
									<a href='Comments.php?do=Delete&comid=" . $row['id'] ."' class='btn btn-danger confirm'><i class = 'fa fa-close'></i>Delete</a> ";
									if($row['status']==0){
										echo "<a href='Comments.php?do=Approve&comid=" . $row['id'] ."' class='btn btn-info confirm'><i class = 'fa fa-check'></i>Approve</a> ";
									}
						echo "</td>";
					echo "</tr>";
				}
				?>
			</table>
			</div>
				</div>
		
<?php
}
elseif($do=="Edit"){ 

	if(isset($_GET['comid']) && is_numeric($_GET['comid'])){
		$comid = $_GET['comid'];
		$stmt = $con->prepare("SELECT *  from comments where id = ?  ");
		$stmt->execute(array($comid));
		$row = $stmt->fetch();
		$count = $stmt->rowCount();
		if ($count>0){?>
		  
			<div class = "content">
			<h1 class = "text-center"> Edit Comment </h1><hr>
				<form class = "edit" action = "?do=Update" method = "post"> 
					<input type = "hidden" name = "comid" value = "<?php echo $comid ?>" >
					<label class = "col-sm-1 control-label">Comment </label>
					<textarea class = "form-control" name = "comment"> <?php echo $row['comment'] ?></textarea>
					<input type = "submit" value = "Save" class = "btn btn-primary" id = "btn">
				</form>
			</div

	<?php }
		else {
			echo "<div class='content'>";
			$msg = "<div class = 'alert alert-danger'>there is no such id</div>";
			redirect($msg,4);
			echo "</div>";
		}
	}

}
elseif($do=="Update"){
	
	if($_SERVER['REQUEST_METHOD']=="POST"){
		$comment = $_POST['comment'];
		$comid = $_POST['comid'];
		$fe = array();
		if(empty($comment)){
			$fe[] = "You should put comment ";
		}	
			foreach($fe as $error){
				echo "<div class = 'content'>";
				echo "<div class = 'alert alert-danger'>" . $error . "</div>";
				echo "</div>";
			}
		if(empty($fe)){
		$stm = $con->prepare("update comments SET comment = ? where id = ? ") ;
		$stm->execute(array($comment,$comid));
		echo "<div class = 'content'>";
		echo "<h1 class = 'text-center'>Update Comment</h1>" . "<hr>";
		$msg ="<div class = 'alert alert-danger'>" . $stm->rowCount() . ' Has Updated' . "</div>";
		redirect($msg,4);
		echo "</div>";
	}}
else{
			$msg = "<div class = 'alert alert-danger'>Sorry you can not browse this page directly</div>";
			redirect($msg,4);
}
		}

elseif($do=="Delete"){
		
		if(isset($_GET['comid']) && is_numeric($_GET['comid'])){
		$comid = $_GET['comid'];
		$stmt = $con->prepare("SELECT * from comments where id = ?  ");
		$stmt->execute(array($comid));
		$count = $stmt->rowCount();
		if($count>0){
			$stmt=$con->prepare("delete from comments where id = ?");
			$stmt->execute(array($comid));
			echo "<div class = 'content'>";
			echo "<h1 class = 'text-center'>Delete Comment</h1>" . "<hr>";
				$msg = "<div class = 'alert alert-success' >" . $stmt->rowCount() ." Record Deleted"  . "</div>"; 
				redirect($msg,3);
				echo "</div>";
			}
			
		else {
			echo "<div class = 'content'>";
			$msg = "<div class = 'alert alert-danger'>Sorry you can not browse this pafge directly</div>";
			redirect($msg,4);
			echo "</div>";
		}


}}
elseif($do=="Approve"){
		
		if(isset($_GET['comid']) && is_numeric($_GET['comid'])){
		$comid = $_GET['comid'];
		$stmt = $con->prepare("SELECT * from comments where id = ?  ");
		$stmt->execute(array($comid));
		$row = $stmt->fetch();
		$count = $stmt->rowCount();
		if($count>0){
			$stmt=$con->prepare("update comments set status = 1 where id = ?");
			$stmt->execute(array($comid));
			echo "<div class = 'content'>";
			echo "<h1 class = 'text-center'>Activate Comment</h1>" . "<hr>";
				$msg = "<div class = 'alert alert-success' >" . $stmt->rowCount() ." Record Approved"  . "</div>"; 
				redirect($msg,3);
				echo "</div>";
			}
			
		else {
			echo "<div class = 'content'>";
			$msg = "<div class = 'alert alert-danger'>Sorry you can not browse this pafge directly</div>";
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
