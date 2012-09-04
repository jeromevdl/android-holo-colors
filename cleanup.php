<?
	$pwd = $_GET['pwd'];

	if (!isset($pwd) || $pwd != "5yr6U84H91h48AO") {
		die("Illegal access");	
	} 
	
	date_default_timezone_set('UTC');
	$day_before = date("d") - 1;
	if ($day_before < 10)
		$day_before = "0".$day_before;
		
	$date = date("Ym") . $day_before;
	$previous_folder = getcwd()."/generated/".$date."/";
	
	if (file_exists($previous_folder)) {
		rrmdir($previous_folder);
	}
	
	function rrmdir($dir) {
	    foreach(glob($dir . '/*') as $file) {
	        if(is_dir($file))
	            rrmdir($file);
	        else
	            unlink($file);
	    }
	    rmdir($dir);
	}
	
	if (file_exists($previous_folder)) {
		echo "Unable to delete ".$previous_folder;
	} else {
		echo $previous_folder." successfully deleted";
	}
?>