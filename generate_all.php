<?
 session_start();
 if (!isset($_SESSION['id'])) {
 	$_SESSION = array();
  	$_SESSION['id'] = uniqid('', true);
 }

 $context = "./";

  include_once('include/php/log4php/Logger.php');
  Logger::configure('log4php.xml');
  $logger = Logger::getLogger("generate_all");
 
 $name = $_GET['name'];
 $color = $_GET['color'];
 $holo = $_GET['holo'];
 $edittext = $_GET['edittext'];
 $checkbox = $_GET['checkbox'];
 $radio = $_GET['radio'];
 $button = $_GET['button'];
 $spinner = $_GET['spinner'];
 $progressbar = $_GET['progressbar'];
 $seekbar = $_GET['seekbar'];
 
 $style = "<!-- Generated with http://android-holo-colors.com -->\n";
 $style .= '<resources xmlns:android="http://schemas.android.com/apk/res/android">'."\n\n";
 
 $stylev11 = $style;
 $style_available = false;
 
 if ($holo == 'light') {
 	$themev11 = $style.'  <style name="'.$name.'" parent="android:Theme.Holo.Light">'."\n\n";
 } else {
 	$themev11 = $style.'  <style name="'.$name.'" parent="android:Theme.Holo">'."\n\n";
 }
	// empty input
	$_GET = array();
	 
	// empty folders
	date_default_timezone_set('UTC');
	$date = date("Ymd"); 
	$root_folder = "generated/".$date."/".$_SESSION['id'];
	if (file_exists($root_folder.".zip")) {
		unlink($root_folder.".zip");
	}
	rrmdir($root_folder);
	
	date_default_timezone_set('UTC');
    $date = date("Ymd"); 
    $folder = "generated/".$date."/".$_SESSION['id'];
	
	generateFolders($date);

  // ============== edittext =================== //
  if (isset($edittext) && $edittext == true) {
    require_once('edittext/common-edittext.php');
    $logger->debug("generate edittext");
  
    foreach ($edittext_classes as $clazz) {
      generateImageOnDisk($clazz, $color, $holo, "edittext/");
    }
    
    copy_directory("edittext/res/", $folder."/res/", $holo);
    
    $themev11 .= '    <item name="android:editTextBackground">@drawable/edit_text_holo_'.$holo.'</item>'."\n\n";
  }
  
  // ============== checkbox =================== //
  if (isset($checkbox) && $checkbox == true) {
    require_once('checkbox/common-checkbox.php');
    $logger->debug("generate checkbox");
  
    foreach ($checkbox_classes as $clazz) {
      generateImageOnDisk($clazz, $color, $holo, "checkbox/");
    }
    
    copy_directory("checkbox/res/", $folder."/res/", $holo);
    
    $themev11 .= '    <item name="android:listChoiceIndicatorMultiple">@drawable/btn_check_holo_'.$holo.'</item>'."\n\n";    
  }

  // ============== radio =================== //
  if (isset($radio) && $radio == true) {
    require_once('radio/common-radio.php');
    $logger->debug("generate radio");
  
  
    foreach ($radio_classes as $clazz) {
      generateImageOnDisk($clazz, $color, $holo, "radio/");
    }
    
    copy_directory("radio/res/", $folder."/res/", $holo);
    
    $themev11 .= '     <item name="android:listChoiceIndicatorSingle">@drawable/btn_radio_holo_'.$holo.'</item>'."\n\n"; 
  }
  
  // ============== button =================== //
  if (isset($button) && $button == true) {
    require_once('button/common-button.php');
    $logger->debug("generate button");
  
    foreach ($button_classes as $clazz) {
      generateImageOnDisk($clazz, $color, $holo, "button/");
    }
    
    copy_directory("button/res/", $folder."/res/", $holo);
        
    if ($holo == "dark") {
		$stylev11 .= '  <style name="Button'.$name.'" parent="android:Widget.Holo.Button">'."\n";
		$stylev11 .= '	  <item name="android:background">@drawable/btn_default_holo_dark</item>'."\n";
		$stylev11 .= '  </style>'."\n\n";
    } else {
    	$stylev11 .= '  <style name="Button'.$name.'" parent="android:Widget.Holo.Light.Button">'."\n";
		$stylev11 .= '	  <item name="android:background">@drawable/btn_default_holo_light</item>'."\n";
		$stylev11 .= '  </style>'."\n\n";
    }
    
	$style_available = true;
	
	$themev11 .= '     <item name="android:buttonStyle">@style/Button'.$name.'</item>'."\n\n";

  }
  
  // ============== spinner =================== //
  if (isset($spinner) && $spinner == true) {
    require_once('spinner/common-spinner.php');
    $logger->debug("generate spinner");
  
    foreach ($spinner_classes as $clazz) {
      generateImageOnDisk($clazz, $color, $holo, "spinner/");
    }
    
    copy_directory("spinner/res/", $folder."/res/", $holo);

	if ($holo == "dark") {
		$stylev11 .= '  <style name="Spinner'.$name.'" parent="android:Widget.Holo.Spinner">'."\n";
        $stylev11 .= '      <item name="android:background">@drawable/spinner_background_holo_dark</item>'."\n";
        $stylev11 .= '  </style>'."\n\n";
	} else {
		$stylev11 .= '  <style name="Spinner'.$name.'" parent="android:Widget.Holo.Light.Spinner">'."\n";
        $stylev11 .= '      <item name="android:background">@drawable/spinner_background_holo_light</item>'."\n";
        $stylev11 .= '  </style>'."\n\n";
	}
		
	$style_available = true;
    
    $themev11 .= '    <item name="android:dropDownSpinnerStyle">@style/Spinner'.$name.'</item>'."\n\n";    
  }
  
  

  // ============== spinner ab =================== //
  if (isset($spinnerab) && $spinnerab == true) {
    require_once('spinnerab/common-spinnerab.php');
    $logger->debug("generate spinner ab");
  
    foreach ($spinnerab_classes as $clazz) {
      generateImageOnDisk($clazz, $color, $holo, "spinnerab/");
    }
    
    copy_directory("spinnerab/res/", $folder."/res/", $holo);

	$stylev11 .= '  <style name="SpinnerActionBar'.$name.'">'."\n";
	$stylev11 .= '      <item name="android:background">@adrawable/spinner_ab_holo_'.$holo.'</item>'."\n";
	$stylev11 .= '  </style>'."\n\n";
    
    $style_available = true;
    
    $themev11 .= '    <item name="android:actionDropDownStyle">@style/SpinnerActionBar'.$name.'</item>'."\n\n";    
  }

  
  // ============= progressbar ================ //
  if (isset($progressbar) && $progressbar == true) {
  	require_once('progressbar/common-progressbar.php');
  	
  	$logger->debug("generate progressbar");
  
  	$img_sizes = array('mdpi', 'hdpi', 'xhdpi');
  	
  	for ($i = 1; $i <= 8 ; $i++) {  	  
	  $pb = new ProgressBar("progressbar/", $i);
	 	  	  
	  foreach ($img_sizes as $img_size) {
	  	 $pb->generate_image($color, $img_size, $holo);
	  }
  	}
  	
  	foreach ($progressbar_classes as $clazz) {
      generateImageOnDisk($clazz, $color, $holo, "progressbar/");
    }
  	
  	copy_directory("progressbar/res/", $folder."/res/", $holo);
    
    
	if ($holo == "dark") {
	    $stylev11 .= '  <style name="ProgressBar'.$name.'" parent="android:Widget.Holo.ProgressBar.Horizontal">'."\n";
	} else {
	    $stylev11 .= '  <style name="ProgressBar'.$name.'" parent="android:Widget.Holo.Light.ProgressBar.Horizontal">'."\n";
	}
    $stylev11 .= '      <item name="android:progressDrawable">@drawable/progress_horizontal_holo_'.$holo.'</item>'."\n";
    $stylev11 .= '      <item name="android:indeterminateDrawable">@drawable/progress_indeterminate_horizontal_holo'.$holo.'</item>'."\n";
    $stylev11 .= '  </style>'."\n\n";
    
    $style_available = true;
    
    $themev11 .= '     <item name="android:progressBarStyleHorizontal">@style/ProgressBar'.$name.'</item>'."\n\n";
    
  }
  
  //  ============== seekbar ================ //
   if (isset($seekbar) && $seekbar == true) {
    require_once('seekbar/common-seekbar.php');
    $logger->debug("generate seekbar");
  
    foreach ($seekbar_classes as $clazz) {
      generateImageOnDisk($clazz, $color, $holo, "seekbar/");
    }
    
    copy_directory("seekbar/res/", $folder."/res/", $holo);

	if ($holo == "dark") {
		$stylev11 .= '  <style name="SeekBar'.$name.'" parent="android:Widget.Holo.SeekBar">'."\n";
	} else {
		$stylev11 .= '  <style name="SeekBar'.$name.'" parent="android:Widget.Holo.Light.SeekBar">'."\n";
	}
    $stylev11 .= '      <item name="android:progressDrawable">@drawable/scrubber_progress_horizontal_holo_'.$holo.'</item>'."\n";
    $stylev11 .= '      <item name="android:indeterminateDrawable">@drawable/scrubber_progress_horizontal_holo_'.$holo.'</item>'."\n";
    $stylev11 .= '      <item name="android:thumb">@drawable/scrubber_control_selector_holo_'.$holo.'</item>'."\n";
	$stylev11 .= '  </style>'."\n\n";
    
    $style_available = true;
    
    $themev11 .= '    <item name="android:seekBarStyle">@style/SeekBar'.$name.'</item>'."\n\n";    
  }
  
    
  // ============== theme & style ================ //
  
  $themev11 .= "  </style>\n\n</resources>";
  $stylev11 .= "</resources>";
  
  $theme_file = "generated/".$date."/".$_SESSION['id']."/res/values-v11/themes.xml";
  $logger->debug("generate themes : ".$theme_file);
  $fp = fopen($theme_file, 'w');
  fwrite($fp, $themev11);
  fclose($fp);
  $logger->debug("generate themes OK");
  
  if ($style_available == true) {
	  $style_file = "generated/".$date."/".$_SESSION['id']."/res/values-v11/styles.xml";
	  $logger->debug("generate styles : ".$style_file);
	  $fp = fopen($style_file, 'w');
	  fwrite($fp, $stylev11);
	  fclose($fp);
	  $logger->debug("generate styles OK");
  }
  
  // ============== ZIP ====================== //
  $zipname = "generated/".$date."/".$_SESSION['id'].".zip";
  $logger->debug("preparing zip ".$zipname);
  		  
  if (Zip($folder, $zipname)) {
  	header('Set-Cookie: fileDownload=true'); 
  	header("Content-type: application/zip" );
  	header('Content-Disposition: attachment; filename="android-holo-colors.zip"');
	header('Content-Length: ' . filesize($zipname));
	header("Expires: 0");
	header("Cache-Control: no-cache, must-revalidate");
	header("Pragma: no-cache");
	if (!readfile($zipname)) {
		die('Unable to download zip');
	}
	exit;
  } else { 
  	$logger->error("generate zip FAIL");
  	die('Unable to create zip');
  }
  
  
	  /**********************************
	   *
	   * Generate 
	   *
	   **********************************/
		function generateImageOnDisk($clazz, $color, $holo, $ctx="") {
		  $sizes = array('mdpi', 'hdpi', 'xhdpi');
		  $obj = new $clazz($ctx);
		  
		  foreach ($sizes as $size) {
		    $obj->generate_image($color, $size, $holo);
		  }
		}

	  
	  /**********************************
	   *
	   * Generate folders for xml styles
	   *
	   **********************************/	  
	  function generateFolders($date) {
	  		$drawable = "generated/".$date."/".$_SESSION['id']."/res/drawable";
	  		if (file_exists($drawable) == FALSE) {
	  			mkdir($drawable, 0777, true);
	  		}
	  		$values11 = "generated/".$date."/".$_SESSION['id']."/res/values-v11";
	  		if (file_exists($values11) == FALSE) {
	  			mkdir($values11, 0777, true);
	  		}  
	  }

	  /**********************************
	   *
	   * Remove recursively content of a folder
	   *
	   **********************************/
		function rrmdir($dir) {  
		  if (is_dir($dir)) { 
		     $objects = scandir($dir); 
		     foreach ($objects as $object) { 
		       if ($object != "." && $object != "..") { 
		         if (filetype($dir."/".$object) == "dir") {
		         	rrmdir($dir."/".$object); 
		         } else {
		            unlink($dir."/".$object); 
		         }
		       } 
		     } 
		     reset($objects); 
		     rmdir($dir); 
		   } 
		 }

	  /**********************************
	   *
	   * Zip a folder and its content
	   *
	   **********************************/		
		function Zip($source, $destination)
		{
			$log = Logger::getLogger("zip");
			$log->debug("generate zip : ".$source." in ".$destination);
			
		    if (!extension_loaded('zip') || !file_exists($source)) {
		        return false;
		    }
		
		    $zip = new ZipArchive();
		    if (!$zip->open($destination, ZIPARCHIVE::CREATE)) {
		        return false;
		    }
		
		    $source = str_replace('\\', '/', realpath($source));
		
		    if (is_dir($source) === true)
		    {
		        $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source), RecursiveIteratorIterator::SELF_FIRST);
		
		        foreach ($files as $file)
		        {
		            $file = str_replace('\\', '/', realpath($file));
		
		            if (is_dir($file) === true)
		            {
		                $zip->addEmptyDir(str_replace($source . '/', '', $file . '/'));
		            }
		            else if (is_file($file) === true)
		            {
		                $zip->addFromString(str_replace($source . '/', '', $file), file_get_contents($file));
		            }
		        }
		    }
		    else if (is_file($source) === true)
		    {
		        $zip->addFromString(basename($source), file_get_contents($source));
		    }
		
		    return $zip->close();
		}


	  /*************************************************
	   *
	   * Copy a directory and its content to destination
	   *
	   *************************************************/
		function copy_directory( $source, $destination, $holo) {
			if ( is_dir( $source ) ) {
				$directory = dir( $source );
				while ( FALSE !== ( $readdirectory = $directory->read() ) ) {
					if ( $readdirectory == '.' || $readdirectory == '..' ) {
						continue;
					}
					$PathDir = $source . '/' . $readdirectory; 
					if ( is_dir( $PathDir ) ) {
						copy_directory( $PathDir, $destination . '/' . $readdirectory, $holo );
						continue;
					}
					if (strpos($readdirectory, $holo)) {
						copy( $PathDir, $destination . '/' . $readdirectory );
					}
				}
		 
				$directory->close();
			}else {
				copy( $source, $destination );
			}
		}

?>