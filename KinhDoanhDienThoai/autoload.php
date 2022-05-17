<?php
function loadClass($c)
{
	include ROOT."\class\\$c.php";	
}
spl_autoload_register("loadClass");
?>