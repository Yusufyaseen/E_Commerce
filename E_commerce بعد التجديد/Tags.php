<?php
 session_start();
 $pagetitle = "Tags Page";
 include "Init.php"; ?>
<div class = 'content'>
	
	<?php 
	if(isset($_GET['name'])){
		$categs = $_GET['name'];
		echo "<h1 class = 'text-center'>" . $_GET['name'] . "</h1>";
		$stmt = $con->prepare("select * from items where tags like '%$categs%' ");
		$stmt->execute();
		$items = $stmt->fetchAll();
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
	} 
	}
	else{
			echo "<div class = 'content'>";
			$msg = "<div class = 'alert alert-danger'>Sorry you must enter the tag name</div>";
			redirect($msg,3);
			echo "</div>";
	}
	?>
</div>
<?php include $tpl . "Footer.php" ?>