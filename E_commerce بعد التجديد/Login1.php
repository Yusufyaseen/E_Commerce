<?php
 session_start();
 $pagetitle = "Home Page";
 include "Init.php"; 
 ?>
 
	<div class = 'content'>
	<?php 
		$items = getall("items","desc","where approve = 1");
		foreach($items as $item){
			echo "<div class = 'col-sm-6 col-md-4' >";
				echo "<div class = 'thumbnail ibox' >";
				echo "<figure>";
					echo "<span class = 'price' >" . "$" . $item['price'] . "</span>";
					echo "<span class = 'pull-right country' >" . $item['country'] . "</span>";
					echo "<img class = 'img-responsive img' id = 'itm' src ='items/".$item['image']."' alt = 'no' /";
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
	?>
	<?php
 include $tpl . "Footer.php" 
 ?>