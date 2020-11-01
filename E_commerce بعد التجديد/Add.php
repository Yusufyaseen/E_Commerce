<?php
 session_start();
 $pagetitle = "Create New Item";
 include "Init.php"; 
 if(isset($_SESSION['user'])){
	 if($_SERVER['REQUEST_METHOD']=="POST"){
		/*$avatarname = $_FILES['avatar']['name'];
		$avatarsize = $_FILES['avatar']['size'];
		$avatartmp = $_FILES['avatar']['tmp_name'];
		$avatartype = $_FILES['avatar']['type'];
		$avatarallowex = array("jpeg", "png", "jpg", "gif");
		$avatarex=strtolower(end(explode('.',$avatarname)));*/
		$name = filter_var($_POST['name'],FILTER_SANITIZE_STRING);
		$description = filter_var($_POST['desc'],FILTER_SANITIZE_STRING);
		$price =filter_var($_POST['price'],FILTER_SANITIZE_NUMBER_INT);
		$country =filter_var($_POST['country'],FILTER_SANITIZE_STRING);
		$status = filter_var($_POST['status'],FILTER_SANITIZE_NUMBER_INT);
		$cat = filter_var($_POST['category'],FILTER_SANITIZE_NUMBER_INT);
		$tag = filter_var($_POST['tags'],FILTER_SANITIZE_STRING);
		$fe = array();
		if(empty($name)){
			$fe[] = "You should put the name of item ";
		}
		if(empty($description)){
			$fe[] = "You should put description ";
		}
		if(empty($price)){
			$fe[] = "You should put price ";
		}
		if(empty($country)){
			$fe[] = "You should put country ";
		}
		if(empty($tag)){
			$fe[] = "You should put country ";
		}
		if($status == 0){
			$fe[] = "You should put status ";
		}
		
		if($cat == 0){
			$fe[] = "You should put the category ";
		}	
		/*if(!empty($avatarname) && ! in_array($avatarex,$avatarallowex)){
			$fe[] = "The Extention is not" . "<strong>". " Allowed " . "</strong>" . "here";
		}
		if(empty($avatarname) ){
			$fe[] = "Avatar Is" . "<strong>". "Required" . "</strong>";
		}
		/*if($avatarsize > 4194304){
			$fe[] = "Avatar Is" . "<strong>". " bid " . "</strong>";
		}*/
 
								foreach($fe as $errors){
									echo "<div class = 'content'>";
									echo "<div class = 'alert alert-danger'>" . $errors . "</div>";
									echo "</div>";
											}
										if(empty($fe)){
										$stm = $con->prepare("insert into  items(name,description,price,country,status,date,member_id,cat_id,tags) values(:user, :desc, :price, :country,:status,now(), :member, :cat, :tags ) ") ;
										$stm->execute(array( 
											'user' => $name,
											'desc' => $description,
											'price' => $price,
											'country' => $country,
											'status' => $status,
											'member' => $_SESSION['uid'],
											'cat' => $cat,
											'tags' => $tag,
											));
										echo "<div class = 'content'>";
										$msg =  "<div class = 'alert alert-success' >" . $stm->rowCount() . " Record registered" .  "</div>";
										redirect($msg,4);
										echo "</div>";
									}
								
}


?>
<div class = "info">
	<div class = "content">
	<h1 class = "text-center"><?php echo $pagetitle . "To " . $_SESSION['user'] ?></h1><hr>

		<div class = "panel panel-primary">
			<div class = "panel-heading"><?php echo $pagetitle . "To " . $_SESSION['user'] ?></div>
			<div class = "panel-body"> 
				<div class = "row">
					<div class = "col-md-7">
							<form class = "add" action = "<?php echo $_SERVER['PHP_SELF'] ?>" method = "post"> 
							<label class = "col-sm-1 control-label">Name </label>
							<input type = "text" pattern = ".{4,}" title = "You should put more than 4 chars" name = "name" class = "form-control" autocomplete = "off" required autofocus = "on"  placeholder = "Enter your Item " >
							<label class = "col-sm-1 control-label">Description </label>
							<input type = "text" pattern = ".{4,}" title = "You should put more than 4 chars" name = "desc" class = "form-control" autocomplete = "off" required   placeholder = "Enter your description " >
							<label class = "col-sm-1 control-label">Price </label>
							<input type = "text" required name = "price" class = "form-control" autocomplete = "off" required   placeholder = "Price of the item " >
							<label class = "col-sm-1 control-label">Country </label>
							<input type = "text" required name = "country" class = "form-control" autocomplete = "off" required   placeholder = "Country of the item " >
							<label class = "col-sm-1 control-label">Tags </label>
							<input type = "text" name = "tags" class = "form-control" autocomplete = "off"   placeholder = "Tags of the item "  >
							<label class = "col-sm-1 control-label">image </label>
							<input type = "file" name = "avatar" class = "form-control" autocomplete = "off"    placeholder = "image of the item "  >
							<div class = "sts">
							<label class = "col-sm-1 control-label">Status </label>
							<select class = "form-control" name = "status">
							<option value = "0" >......</option>
								<option value = "1" >New</option>
								<option value = "2" >Used</option>
								<option value = "3" >Like New</option>
								<option value = "4" >Very old</option>
							</select>
							
							<label class = "col-sm-1 control-label">Categories </label>
							<select class = "form-control" name = "category">
							<option value = "0" >None</option>
								<?php 
									$stm = $con->prepare("select * from categories where parent = 0 ");
									$stm->execute();
									$cate = $stm->fetchAll();
									foreach($cate as $rows){
										echo "<option id = 'opt0' value = '" . $rows['id'] . "'>" . $rows['name'] . "</option>";
										$stmt2 = $con->prepare("select * from categories where parent = " . $rows['id'] . " order by id desc");
										$stmt2->execute();
										$cat = $stmt2->fetchAll();
										if(! empty($cat)){
											foreach($cat as $cat0){
												echo "<option value = '" . $cat0['id'] . "'>" . "......." . $cat0['name'] . "</option>";
									}
								}
							}
						?>
					</select>
							</div>
							<input type = "submit" value = "Add Item" class = "btn btn-primary btn-sm" id = "bttn2">
						</form>
						
					</div>
					<div class = "col-md-5">
						<div class = 'thumbnail ibox' >
							<figure>
								<span class = 'price' >$price</span>
									<span class = 'pull-right country' >Country</span>
								    <img class = 'img-responsive img' src ='fo4.jpg' alt = 'no' /
								    <figcaption class = 'caption'>
									<h3 id = "nn">Title</h3>
									<p>Description</p>
									</figcaption>
							 </figure>
						</div>
					</div>
				</div>
				
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