<?php

include "Connect.php";
$tpl = "Includes/Templetes/";
$lang = "Includes/Languages/";
$func = "Includes/Functions/";
$css = "Layout/Css/";
$js = "Layout/Js/";
include $func . "Func.php";
include $lang . "Eng.php";
include $tpl . "Header.php" ;
if(!isset($nonav)){
	include "Nav.php";
}
?>