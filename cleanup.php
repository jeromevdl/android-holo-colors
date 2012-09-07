<?
	$time = microtime();
	$time = explode(' ', $time);
	$time = $time[1] + $time[0];
	$begintime = $time;
	
	date_default_timezone_set('UTC');
	$day_before = date("d") - 2;
	if ($day_before < 10)
		$day_before = "0".$day_before;
		
	$date = date("Ym") . $day_before;
	$previous_folder = getcwd()."/generated/".$date."/";
	
	if (file_exists($previous_folder)) {
		rrmdir($previous_folder);
	}
	$time = microtime();
	$time = explode(" ", $time);
	$time = $time[1] + $time[0];
	$endtime = $time;
	$totaltime = ($endtime - $begintime);
	
	if (file_exists($previous_folder)) {
		echo "Unable to delete ".$previous_folder. "(".$totaltime." seconds)";
	} else {
		echo $previous_folder." successfully deleted (".$totaltime." seconds)";
	}
	
	// ========================= functions ====================================
		
	function rrmdir($dir) {
	    foreach(glob($dir . '/*') as $file) {
	        if(is_dir($file))
	            rrmdir($file);
	        else
	            unlink($file);
	    }
	    rmdir($dir);
	}
	
?>