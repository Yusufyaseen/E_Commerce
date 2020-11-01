<?php
 session_start();
 $pagetitle = "Profile";
 include "Init.php"; 
 if(isset($_SESSION['user'])){
	 $stmt = $con->prepare("select * from user where username = ?");
	 $stmt->execute(array($_SESSION['user']));
	 $row = $stmt->fetch();
?>

<div class = "info">
	<div class = "content">
	<h1 class = "text-center"><?php echo $_SESSION['user'] . " Profile" ?></h1><hr>
		<div class = "panel panel-primary">
			<div class = "panel-heading">My Information</div>
			<div class = "panel-body"> 
			<div class = "col-md-8" id = "eig"> 
			  <ul class = "list-unstyled">
				<li><i class = "fa fa-unlock-alt fa-fw"></i> <span>Login Name : </span><?php echo $row['username'] ?><br></li>
				<li><i class = "fa fa-envelope-o fa-fw"></i> <span>Email : </span><?php echo $row['email'] ?><br></li>
				<li><i class = "fa fa-user fa-fw"></i> <span>Register Date : </span><?php echo $row['date'] ?><br></li>
				<li><i class = "fa fa-calendar fa-fw"></i> <span>FullName : </span><?php echo $row['fullname'] ?><br></li>
				<li><i class = "fa fa-tags fa-fw"></i> <span>Favourite Category : </span><?php echo $row['userid'] ?></li>
			  </ul>
			</div>
			<div class = "col-md-4">
			<img class = 'img-responsive img' id = "four" src ='users/<?php echo $row['image'] ?>' alt = '<?php echo $row['username'] ?>' />
			</div>
			</div>
		</div>
	</div>
</div>
<div class = "info">
	<div class = "content">
		<div class = "panel panel-primary">
			<div class = "panel-heading">My Items</div>
			<div class = "panel-body"> <?php 
					$items = getitems("member_id",$row['userid'],1);
					if(!empty($items)){
						foreach($items as $item){
							echo "<div class = 'col-sm-6 col-md-4' >";
								echo "<div class = 'thumbnail ibox' >";
								if($item['approve']==0){
										echo "<div id = 'approveno'>" . "Waiting Approval" ."</div>";
									}
								else{
										 echo "<div id = 'approveyes'>" . "Approval" ."</div>";	
									}
									echo "<figure>";
										echo "<span class = 'price'>" ."$" . $item['price'] . "</span>";
										echo "<span class = 'pull-right country' >" . $item['country'] . "</span>";
										echo "<img class = 'img-responsive img' id = 'itm' src ='items/".$item['image']."' alt = 'no' ";
										echo "<figcaption class = 'caption'>";
										echo "<h3>" . "<a href = 'Item.php?itemid=" . $item['id'] . "' class = 'itemid'>" . $item['name'] . "</a>" ."</h3>";
										echo "<p class = 'para'>" . $item['description'] . "</p>";
										echo "<p class = 'date'>" . $item['date'] . "</p>";
										echo "</figcaption>";
									echo "</figure>";
								echo "</div>";
							echo "</div>";
							}
					}
					else{
						echo "There is no items here" . "<a href = 'Add.php'>" . "Crate New Item" . "</a>" . "   ";;
					}
						?>
			</div>
			</div>
	</div>
</div>
<div class = "info">
	<div class = "content">
		<div class = "panel panel-primary">
			<div class = "panel-heading">Latest Comments</div>
			<div class = "panel-body"> 
				<?php 
					$stmt=$con->prepare("select comment from comments where user_id = ? ");
					$stmt->execute(array($row['userid']));
					$comments=$stmt->fetchAll();
					if(!empty($comments)){
						foreach($comments as $com){
							echo "<p>" . $com['comment'] . "</p>";
						}
					}
					else {
						echo "There is no comments to show";
					}
				?>
			</div>
		</div>
	</div>
</div>
 <?php }
		else{
			header('location:Login1.php');
			exit();
		}
 include $tpl . "Footer.php" 
 ?>