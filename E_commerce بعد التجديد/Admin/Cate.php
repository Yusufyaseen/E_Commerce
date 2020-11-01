<?php 
session_start();
$nonav2 = "";
$pagetitle = "Categories";
if(isset($_SESSION['username'])){
include "Init.php";
if(isset($_GET['do'])){
	$do = $_GET['do'];
}
else{
	$do = "Manage";
}
if($do=="Manage"){
	$sort = "asc";
	$sort_array = array('asc' , 'desc');
	if(isset($_GET['sort']) && in_array($_GET['sort'] , $sort_array)){
		$sort = $_GET['sort'];
	}
		$stmt2 = $con->prepare("select * from categories where parent = 0 order by ordering $sort");
		$stmt2->execute();
		$cats = $stmt2->fetchAll();
			if(!empty($cats)){
			?>
		
		<div class = "content cate">
		<h1 class = "text-center">Manage categories</h1><hr id = "cath">
			<div class = "panel panel-default">
				<div class = "panel-heading ">
				<i class = "fa fa-edit"></i> Manage categories
				<div class = "ordering pull-right">
					<i class = "fa fa-sort"></i> Ordering : [
					<a class = "<?php if($sort=="asc"){ echo 'active'; } ?>" href = "?sort=asc">Asc</a> |
					<a class = "<?php if($sort=="desc"){ echo 'active'; } ?>" href = "?sort=desc">Desc</a> ]
				</div>
				</div>
				<div class = "panel-body">
					<?php 
						foreach($cats as $row){
							echo "<div class = 'cat'>";
							echo "<div class = 'hidden-buttons'>";
								echo "<a href = 'Cate.php?do=Edit&catid=" . $row['id'] . "' class = 'btn btn-xs btn-primary'><i class = 'fa fa-edit'></i> Edit</a>";
								echo "<a href = 'Cate.php?do=Delete&catid=" . $row['id'] . "' class = 'btn btn-xs btn-danger'><i class = 'fa fa-close'></i> Delete</a>";
							echo "</div>";
							echo "<h3>" . $row['name'] . "</h3>";
							echo "<p>";
							if($row['description']==""){
								echo "No description founded";
							}
							else{
								echo $row['description'];
							}
							echo "</p>";
							if($row['visibility']==1){
							echo "<span class = 'visible'>" . "<i class = 'fa fa-eye'></i>" . " hidden" . "</span>";
							}
							if($row['allow_comment']==1){
							echo "<span class = 'commenting'>" . "<i class = 'fa fa-close'></i>" . " Comment disabled" . "</span>";
							}
							if($row['allo_adv']==1){
							echo "<span class = 'adding'>" . "<i class = 'fa fa-close'></i>" . " advertises disabled" . "</span>";
							}
								$stmt2 = $con->prepare("select * from categories where parent = " . $row['id'] . " order by id desc");
								$stmt2->execute();
								$cat = $stmt2->fetchAll();
								if(! empty($cat)){
									echo "<h4 id = 'head'>" . "Child Categories" . "</h4>";
									echo "<ul class = 'list-unstyled' id = 'lic'>";
									foreach($cat as $cats){
										echo "<li>" . "<a href = 'Cate.php?do=Edit&catid=" . $cats['id'] . "'>" . $cats['name'] . "</a>" 
										. "<a href = 'Cate.php?do=Delete&catid=" . $cats['id'] . "' class = 'btn33 btn-xs btn-danger'><i class = 'fa fa-close'></i> Delete</a>";
										echo "</li>";
									}
									echo "</ul>";
								}
							
							echo "<hr>";
			}
				?>
				</div>
				</div>
			</div>
			<a class = "btn btn-primary" href = "?do=Add"><i class="fa fa-plus"></i>  Add New Category</a>
		</div>
		<?php 
}
			else{
				echo "<div class = 'content'>";
				echo "<div class = 'no'>" . "There is not categories to show" . "</div>";
				echo "</div>";
				echo "<div class = 'btn8'>" . "<a href = 'Cate.php?do=Add' class='btn btn-sm btn-primary'>" . "<i class='fa fa-plus'>" . "</i>" . ' Add Category' . "</a>" . "</div>";
			}
		?>
			
		<?php
}
elseif($do=="Add"){ ?>
			  
			<div class = "content">
			<h1 class = "text-center"> Add new category </h1><hr>
			<div class = "roww">
				<form class = "add" action = "?do=Insert" method = "post"> 
					<label class = "col-sm-1 control-label">Name </label>
					<input type = "text" name = "name" class = "form-control" autocomplete = "off" autofocus = "on" required placeholder = "Enter your category " ?>
					<label class = "col-sm-1 control-label">Description </label>
					<input type = "text" name = "desc" class = "form-control"   placeholder = "Descripe your category">
					<label class = "col-sm-1 control-label">Ordering </label>
					<input type = "text" name = "ordering" class = "form-control order"  placeholder = "Number to arrange the categories" autocomplete = "off">
					<label class = "col-sm-1 control-label">Parent </label>
					<select class = "form-control" name = "parent">
						<option value = "0">None</option>
						<?php 
							$stmt = $con->prepare("select * from categories where parent = 0");
							$stmt->execute();
							$cate2 = $stmt->fetchAll();
							foreach($cate2 as $cates){
								echo "<option value = '" . $cates['id'] . "'>" . $cates['name'] . "</option>";
							}
							
						?>
					</select>
					<div class = "vbs">
					<label class = "col-sm-2 control-label vbs2">Visibility </label>
					<input id = "vis-yes" type = "radio" name = "visibility" value = "0"  class = "yes">
					<label for = "vis-yes" class = "Yes">Yes</label><br>
					<input id = "vis-no" type = "radio" name = "visibility" value = "1"  class = "no">
					<label for = "vis-no" class = "Noo">No</label>
					</div><hr>
					<div class = "allow">
					<label class = "col-sm-4  allowc">Allow Commenting </label>
					<input id = "allow-yes" type = "radio" name = "commenting" value = "0"  class = "yes">
					<label for = "allow-yes" class = "Yes">Yes</label><br>
					<input id = "allow-no" type = "radio" name = "commenting" value = "1"  class = "no">
					<label for = "allow-no" class = "No">No</label>
					</div><hr>
					<div class = "add">
					<label class = "col-sm-4  addc">Add Commenting </label>
					<input id = "add-yes" type = "radio" name = "adds" value = "0"  class = "yes">
					<label for = "add-yes" class = "Yes">Yes</label><br>
					<input id = "add-no" type = "radio" name = "adds" value = "1"  class = "no">
					<label for = "add-no" class = "No">No</label>
					</div>
					<input type = "submit" value = "Add member" class = "btn btn-primary" id = "bttn">
				</form>
				</div>
			</div>
<?php
}
elseif($do=="Insert"){
if($_SERVER['REQUEST_METHOD']=="POST"){
		
		$name = $_POST['name'];
		$desc = $_POST['desc'];
		$parent = $_POST['parent'];
		$ordering = $_POST['ordering'];
		$visibility = $_POST['visibility'];
		$comment = $_POST['commenting'];
		$ads = $_POST['adds'];		
		if(!empty($name)){
		$Count = check("name","categories",$name);
		if($Count>1){
			echo "<div class = 'content'>";
			$msg = "<div class = 'alert alert-danger'  >" . "Sorry this category is exists" . "</div>";
			redirect($msg,4);
			echo "</div>";
		}
		else{
		$stm = $con->prepare("insert into categories(name,description,parent,ordering,visibility,allow_comment,allo_adv) values(:name, :desc, :parent, :ordering, :visible, :allow-comments, :allow-adds) ") ;
		$stm->execute(array( 
			'name'				=> $name,
			'desc'	 			=> $desc,
			'parent'	 		=> $parent,
			'ordering' 			=> $ordering,
			'visible'			=> $visibility,
			'allow-comments' 	=> $comment,
			'allow-adds' 		=> $ads
		));
		echo "<div class = 'content'>";
		echo "<h1 class = 'text-center'>Insert category</h1>" . "<hr>";
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
if(isset($_GET['catid']) && is_numeric($_GET['catid'])){
		$catid = $_GET['catid'];
		$stmt = $con->prepare("SELECT *  from categories where id = ?  ");
		$stmt->execute(array($catid));
		$row = $stmt->fetch();
		$count = $stmt->rowCount();
		if ($count>0){ ?>
					  <
			<div class = "content">
			<h1 class = "text-center">Edit Category </h1><hr>
			<div class = "roww">
				<form class = "add" action = "?do=Update" method = "post"> 
					<input type = "hidden" name = "catid" value = "<?php echo $catid ?>" >
					<label class = "col-sm-1 control-label">Name </label>
					<input type = "text" name = "name" class = "form-control" autofocus = "on" required value = "<?php echo $row['name'] ?>">
					<label class = "col-sm-1 control-label">Description </label>
					<input type = "text" name = "desc" class = "form-control"  value = "<?php echo $row['description'] ?>">
					<label class = "col-sm-1 control-label">Ordering </label>
					<input type = "text" name = "ordering" class = "form-control order"  value = "<?php echo $row['ordering'] ?>">
					<label class = "col-sm-1 control-label">Parent </label>
					<select class = "form-control" name = "parent">
						<option value = "0">None</option>
						<?php 
							$stmt = $con->prepare("select * from categories where parent = 0");
							$stmt->execute();
							$cate2 = $stmt->fetchAll();
							foreach($cate2 as $cates){
								echo "<option value = '" . $cates['id'] . "'";
								if($row['parent']==$cates['id']){
									echo "selected";
								} 
								echo ">" . $cates['name'] . "</option>";
							}
							
						?>
					</select>
					<div class = "vbs">
					<label class = "col-sm-2 control-label vbs2">Visibility </label>
					<input id = "vis-yes" type = "radio" name = "visibility" value = "0"  class = "yes" <?php if($row['visibility'] == 0){ echo "checked"; } ?> >
					<label for = "vis-yes" class = "Yes">Yes</label><br>
					<input id = "vis-no" type = "radio" name = "visibility" value = "1"  class = "no" <?php if($row['visibility'] == 1){ echo "checked"; } ?> >
					<label for = "vis-no" class = "No" id = "no">No</label>
					</div><hr>
					<div class = "allow">
					<label class = "col-sm-4  allowc">Allow commenting </label>
					<input id = "allow-yes" type = "radio" name = "commenting" value = "0"  class = "yes" <?php if($row['allow_comment'] == 0){ echo "checked"; } ?> >
					<label for = "allow-yes" class = "Yes">Yes</label><br>
					<input id = "vis-no" type = "radio" name = "visibility" value = "1"  <?php if($row['allow_comment'] == 1){ echo "checked"; } ?> class = "no">
					<label for = "allow-no" class = "No">No</label>
					</div><hr>
					<div class = "add">
					<label class = "col-sm-4  addc">Add commenting </label>
					<input id = "add-yes" type = "radio" name = "adds" value = "0"  class = "yes" <?php if($row['allo_adv'] == 0){ echo "checked"; } ?> >
					<label for = "add-yes" class = "Yes">Yes</label><br>
					<input id = "add-no" type = "radio" name = "adds" value = "1"  class = "no" <?php if($row['allo_adv'] == 1){ echo "checked"; } ?> >
					<label for = "add-no" class = "No">No</label>
					</div>
					<input type = "submit" value = "Save" class = "btn btn-primary" id = "bttn2">
				</form>
			</div>
			</div>
		<?php
	}
	else{
		echo "<div class = 'content'>";
		$msg = "<div class = 'alert alert-danger'>there is no such id here </div>";
		redirect($msg,4);
		echo "</div>";
	}

}	
}
elseif($do=="Update"){
echo "<h1 class = 'text-center'>Update Category</h1>" . "<hr>";
	if($_SERVER['REQUEST_METHOD']=="POST"){
		$name = $_POST['name'];
		$desc = $_POST['desc'];
		$ordering = $_POST['ordering'];
		$visibility = $_POST['visibility'];
		$comment = $_POST['commenting'];
		$adv = $_POST['adds'];
		$catid = $_POST['catid'];
		$stm3 = $con->prepare("update categories SET name = ?,description = ?,ordering = ?, visibility = ?, allow_comment = ?, allo_adv = ? WHERE id = ? ") ;
		$stm3->execute(array($name, $desc, $ordering,$visibility, $comment, $adv, $catid));
		echo "<div class = 'content'>";
		$msg ="<div class = 'alert alert-danger'>" . $stm3->rowCount() . 'Has Updated' . "</div>";
		redirect($msg,4);
		echo "</div>";
	}
else{
			$msg = "<div class = 'alert alert-danger'>Sorry you can not browse this pafge directly</div>";
			redirect($msg,4);
}
}
elseif($do=="Delete"){
	echo "<h1 class = 'text-center'>Delete Categories</h1>" . "<hr>";
		if(isset($_GET['catid']) && is_numeric($_GET['catid'])){
		$catid = $_GET['catid'];
		$stmt = $con->prepare("select * from categories where id = ?  ");
		$stmt->execute(array($catid));
		$row = $stmt->fetch();
		$count = $stmt->rowCount();
		if($count>0){
			$stmt=$con->prepare("delete from categories where id = ?");
			$stmt->execute(array($catid));
			echo "<div class = 'content'>";
				$msg = "<div class = 'alert alert-success' >" . $stmt->rowCount() ." Record Deleted"  . "</div>"; 
				redirect($msg,3);
				echo "</div>";
			}
			
		else {
			echo "<div class = 'content'>";
			$msg = "<div class = 'alert alert-danger'>Sorry there is not such id here</div>";
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
