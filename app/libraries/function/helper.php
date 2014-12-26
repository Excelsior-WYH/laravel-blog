<?php
	
	if (!function_exists('showbug')){
		
		function showbug($msg){
			echo "<pre>";
			print_r($msg);
			echo "</pre>";
		}
	}





?>