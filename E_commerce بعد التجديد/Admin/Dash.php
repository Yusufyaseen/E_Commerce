<?php 
SESSION_start();
$pagetitle = "Dashboared";
if(isset($_SESSION['username'])){
include "Init.php";
$latest1 = 5;
$latest2 = 3;
$numcomments = 2;
?>
<div class = "home">
	<div class = "content2">
	
		<h1>Dashboard</h1>
		<div class = "row">
			<div class = "col-sm-3">
				<div class = "stat mem">
				<i class = "fa fa-users"></i>
				<div class = "info">
				Total Members
				<span><a href = 'Members.php'><?php echo countitems("userid","user") ?></a></span>
				</div>
				</div>
			</div>
			<div class = "col-sm-3">
				<div class = "stat pen">
				<i class = "fa fa-user-plus"></i>
				<div class = "info">
				Pending Members
				<span><a href = 'Members.php?$do=Manage&page=pending'><?php echo countitems2("username","user","regstatus") ?></a></span>
				</div>
				</div>
			</div>
			<div class = "col-sm-3">
				<div class = "stat ite">
				<i class = "fa fa-tag" id = "tag"></i>
				<div class = "info">
				Total Items
				<span><a href = 'Items.php?$do=Manage'><?php echo countitems("id","items") ?></a></span>
				</div>
				</div>
			</div>
			<div class = "col-sm-3">
				<div class = "stat com">
				<i class = "fa fa-comments" id = "com"></i>
				<div class = "info">
				Total comments
				<span><a href = 'Comments.php?$do=Manage'><?php echo countitems("id","comments") ?></a></span>
				</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class = "latest">
	<div class = "content2">
	  <div class = "row">
		<div class = "col-sm-6">
			<div class = "panel panel-default">
				<div class = "panel-heading">
					<i class = "fa fa-users"></i> Latest <span class = "clr" ><?php  echo $latest1 ?> </span> registered users
				</div>
				<div class = "panel-body">
				<ul class = "list-unstyled late1">
				<?php 
					$thelatest = getlatest("*","user","userid","$latest1");
					if(! empty($thelatest)){
					foreach($thelatest as $row){
						echo "<li>" . $row['username'] . "<span class = 'btn btn-success pull-right' >" . "<a href = 'Members.php?do=Edit&userid= " . $row['userid'] . "'><i class = 'fa fa-edit'></i>Edit</a>" . "</span>" . "</li>";
						}
					}
					else{
						echo 'There is not users here';
					}
				?>
				</ul>
				</div>
			</div>
		</div>
		<div class = "col-sm-6" id = "dash">
			<div class = "panel panel-default">
				<div class = "panel-heading">
					<i class = "fa fa-tag"></i> Latest <span class = "clr" ><?php  echo $latest2 ?> </span> Items
				</div>
				<div class = "panel-body">
				<ul class = "list-unstyled late1">
				<?php 
					$thelatest2 = getlatest("*","items","id","$latest2");
					if(! empty($thelatest2)){
					foreach($thelatest2 as $row){
						echo "<li>";
						echo $row['name'];
						echo "<span class = 'btn btn-success pull-right' >" . "<a href = 'items.php?do=Edit&itemid= " . $row['id'] . "'><i class = 'fa fa-edit'></i>Edit</a>" . "</span>";
						if($row['approve']==0){ 
								echo "<span class = 'btn btn-info pull-right' id = 'btnd'>" . "<a href = 'items.php?do=Approve&itemid= " . $row['id'] . "'><i class = 'fa fa-edit'></i>Approve</a>"; 
						} 
					}
						echo "</li>";
					}
					else{
						echo "there is not items here";
						echo "<div class = 'btn3'>" . "<a href = 'Items.php?do=Add' class='btn btn-sm btn-primary'>" . "<i class='fa fa-plus'>" . "</i>" . ' Add Item' . "</a>" . "</div>";
					}
				?>
				</ul>
				</div>
			</div>
		</div>
	  </div>
	  <div class = "row">
		<div class = "col-sm-6">
			<div class = "panel panel-default">
				<div class = "panel-heading">
					<i class = "fa fa-comments-o"></i> Latest <span class = "clr" ><?php  echo $numcomments ?> </span> Comments 
				</div>
				<div class = "panel-body">
				<?php
					$stmt=$con->prepare("select comments.*,user.username as username from comments
					inner join user on user.userid = comments.user_id order by id desc limit $numcomments");
					$stmt->execute();
					$rows=$stmt->fetchAll();
					if(! empty($rows)){
					foreach($rows as $row){
						echo "<div class = 'content-box'>";
								echo "<span class = 'mn'>" . $row['username'] . "</span>";
								echo "<p class = 'mc'>" . $row['comment'] . "</p>";
						echo "</div>";
					}
					}
					else{
						echo "There is not comments";
					}
						?>
								</div>
							</div>
						</div>
					  </div>
					</div>
				</div>
				<?php
				include $tpl . "Footer.php";
				}
				else {
					include "Init.php";
					echo "<div class = 'content'>";
					$msg = "<div class = 'alert alert-danger'> Sorry you can not browse this page directly </div>";
					redirect($msg,3);
					 echo "</div>";
					 include $tpl . "Footer.php";
				}
				?>


