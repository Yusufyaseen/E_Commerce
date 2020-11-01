<?php
 session_start();
 $pagetitle = "Categories Page";
 include "Init.php"; ?>
<div class = 'content'>
	<h1 class = 'text-center' id = "cth">Items of this category</h1>
	<?php 
	if(isset($_GET['pageid']) && is_numeric($_GET['pageid'])){
		$pageid = $_GET['pageid'];
		$count = check("id","categories",$pageid);
		if($count>0){
		$items = getitems("cat_id",$_GET['pageid']);
		if(! empty($items)){
		foreach($items as $item){
			echo "<div class = 'col-sm-6 col-md-4' >";
				echo "<div class = 'thumbnail ibox' >";
				echo "<figure>";
					echo "<span class = 'price' >" . "$" . $item['price'] . "</span>";
					echo "<span class = 'pull-right country' >" . $item['country'] . "</span>";
					echo "<img class = 'img-responsive img' id = 'itm' src ='items/".$item['image']."'/";
					echo "<figcaption class = 'caption'>";
						echo "<h3 id = 'nn'>" . "<a href = 'Item.php?itemid=" . $item['id'] . "'>" . $item['name'] . "</a>" ."</h3>";
						echo "<p id = 'parag'>" . $item['description'] . "</p>";
						echo "<p class = 'date'>" . $item['date'] . "</p>";
					echo "</figcaption>";
				echo "</figure>";
					/*echo "<span class = 'price' >" . $item['price'] . "</span>";
					echo "<img class = 'img-responsive img' src ='img.jpeg' alt = 'no' /";
					echo "<div class = 'caption' >";
						echo "<h3>" . $item['name'] . "</h3>";
						echo "<p>" . $item['description'] . "</p>";
					echo "</div>";*/
				
				echo "</div>";
			echo "</div>";
	}}}
	else{
			echo "<div class='content'>";
			$msg = "<div class = 'alert alert-danger'>There is no such id</div>";
			redirect($msg,4);
			echo "</div>";
	}
	}
	else{
			echo "<div class = 'content'>";
			$msg = "<div class = 'alert alert-danger'>Sorry you can not see the items</div>";
			redirect($msg,3);
			echo "</div>";
	}
	?>
</div>
<?php include $tpl . "Footer.php" ?>