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
 $cbutton = $_GET['cbutton'];
 $spinner = $_GET['spinner'];
 $cspinner = $_GET['cspinner'];
 $progressbar = $_GET['progressbar'];
 $ratingbar = $_GET['ratingbar'];
 $ratingstarsmall = $_GET['ratingstarsmall'];
 $ratingstarbig = $_GET['ratingstarbig'];
 $seekbar = $_GET['seekbar'];
 $toggle = $_GET['toggle'];
 $list = $_GET['list'];
 $fastscroll = $_GET['fastscroll'];
 $search = $_GET['search'];
 $numberpicker = $_GET['numberpicker'];
 $switch = $_GET['switch'];
 $autocomplete = $_GET['autocomplete'];
 
 $style = '<?xml version="1.0" encoding="utf-8"?>'."\n\n";
 $style .= "<!-- Generated with http://android-holo-colors.com -->\n";
 $style .= '<resources xmlns:android="http://schemas.android.com/apk/res/android">'."\n\n";
 
 $stylev11 = $style;
 $stylev8 = $style;
 
 $style8_available = false;
 $style11_available = false;
 $style14_available = false;
 
 if ($holo == 'light') {
 	$themev11 = $style.'  <style name="'.$name.'" parent="android:Theme.Holo.Light">'."\n\n";
 	$themev8 = $style.'  <style name="'.$name.'" parent="android:Theme.Light">'."\n\n";
 } else {
 	$themev11 = $style.'  <style name="'.$name.'" parent="android:Theme.Holo">'."\n\n";
 	$themev8 = $style.'  <style name="'.$name.'" parent="android:Theme">'."\n\n";
 }
 
	// empty input
	$_GET = array();
	 
	// empty folders
	date_default_timezone_set('UTC');
	$date = date("Ymd"); 
	$root_folder = getcwd()."/generated/".$date."/".$_SESSION['id'];
	if (file_exists($root_folder.".zip")) {
		unlink($root_folder.".zip");
	}
	rrmdir($root_folder);
	
	date_default_timezone_set('UTC');
    $date = date("Ymd"); 
    $folder = getcwd()."/generated/".$date."/".$_SESSION['id'];
	
	generateFolders($date);

  // ============== edittext =================== //
  if ((isset($edittext) && $edittext == true)) {
    require_once('widgets/edittext/common-edittext.php');
    $logger->debug("generate edittext");
  
    foreach ($edittext_classes as $clazz) {
      generateImageOnDisk($clazz, $color, $holo, "widgets/edittext/");
    }
    
    copy_directory("widgets/edittext/res/", $folder."/res/", $holo);
    
    $stylev8 .= '  <style name="EditText'.$name.'" parent="android:Widget.EditText">'."\n";
    $stylev8 .= '	  <item name="android:background">@drawable/edit_text_holo_'.$holo.'</item>'."\n";
    // TODO replace with selector
    if ($holo == "dark") {
    	$stylev8 .= '	  <item name="android:textColor">#ffffff</item>'."\n";
    } else {
    	$stylev8 .= '	  <item name="android:textColor">#000000</item>'."\n";
    }
    $stylev8 .= '  </style>'."\n\n"; 
    
	$style8_available = true;
    
    $themev11 .= '    <item name="android:editTextBackground">@drawable/edit_text_holo_'.$holo.'</item>'."\n\n";
    $themev8 .= '    <item name="android:editTextStyle">@style/EditText'.$name.'</item>'."\n\n";
    
   }

  // ============== autocomplete =================== //
  if (isset($autocomplete) && $autocomplete == true) {
  	
    $logger->debug("generate autocomplete");
    
    if (!isset($edittext)) {
	  	require_once('widgets/edittext/common-edittext.php');
	    foreach ($edittext_classes as $clazz) {
	      generateImageOnDisk($clazz, $color, $holo, "widgets/edittext/");
	    }
	    copy_directory("widgets/edittext/res/", $folder."/res/", $holo);
    }

	if (!isset($list)) {
	    require_once('widgets/list/common-list.php');  
	    foreach ($list_classes as $clazz) {
	      generateImageOnDisk($clazz, $color, $holo, "widgets/list/");
	    }
	    copy_directory("widgets/list/res/", $folder."/res/", $holo);
	}
  	
  	if ($holo == "dark") {
  		$stylev11 .= '  <style name="AutoCompleteTextView'.$name.'" parent="android:Widget.Holo.AutoCompleteTextView">'."\n";
  	} else {
  		$stylev11 .= '  <style name="AutoCompleteTextView'.$name.'" parent="android:Widget.Holo.Light.AutoCompleteTextView">'."\n";
  	}
    $stylev11 .= '      <item name="android:dropDownSelector">@drawable/list_selector_holo_'.$holo.'</item>'."\n";
    $stylev11 .= '	    <item name="android:background">@drawable/edit_text_holo_'.$holo.'</item>'."\n";
    $stylev11 .= '  </style>'."\n\n";
    
    $stylev8 .= '  <style name="AutoCompleteTextView'.$name.'" parent="android:Widget.AutoCompleteTextView">'."\n";
    $stylev8 .= '      <item name="android:dropDownSelector">@drawable/list_selector_holo_'.$holo.'</item>'."\n";
    $stylev8 .= '	  <item name="android:background">@drawable/edit_text_holo_'.$holo.'</item>'."\n";
    // TODO replace with selector
    if ($holo == "dark") {
    	$stylev8 .= '	  <item name="android:textColor">#ffffff</item>'."\n";
    } else {
    	$stylev8 .= '	  <item name="android:textColor">#000000</item>'."\n";
    }
    $stylev8 .= '  </style>'."\n\n";
    
    $themev11 .= '    <item name="android:autoCompleteTextViewStyle">@style/AutoCompleteTextView'.$name.'</item>'."\n\n";
    $themev8 .= '    <item name="android:autoCompleteTextViewStyle">@style/AutoCompleteTextView'.$name.'</item>'."\n\n";    
    
    $style11_available = true;
	$style8_available = true;
  }
  
  // ============== checkbox =================== //
  if (isset($checkbox) && $checkbox == true) {
    require_once('widgets/checkbox/common-checkbox.php');
    $logger->debug("generate checkbox");
  
    foreach ($checkbox_classes as $clazz) {
      generateImageOnDisk($clazz, $color, $holo, "widgets/checkbox/");
    }
    
    copy_directory("widgets/checkbox/res/", $folder."/res/", $holo);
    
    $stylev8 .= '  <style name="CheckBox'.$name.'" parent="android:Widget.CompoundButton.CheckBox">'."\n";
    $stylev8 .= '      <item name="android:button">@drawable/btn_check_holo_'.$holo.'</item>'."\n";
    $stylev8 .= '  </style>'."\n\n";
    
    $style8_available = true;
    
    $themev11 .= '    <item name="android:listChoiceIndicatorMultiple">@drawable/btn_check_holo_'.$holo.'</item>'."\n\n";
    $themev8 .= '    <item name="android:checkboxStyle">@style/CheckBox'.$name.'</item>'."\n\n";  
  }

  // ============== radio =================== //
  // spinner before v11 needs radio button in the dropdown
  if ((isset($radio) && $radio == true) || ((isset($spinner) && $spinner == true) || (isset($cspinner) && $cspinner == true))) {
    require_once('widgets/radio/common-radio.php');
    $logger->debug("generate radio");
  
  
    foreach ($radio_classes as $clazz) {
      generateImageOnDisk($clazz, $color, $holo, "widgets/radio/");
    }
    
    copy_directory("widgets/radio/res/", $folder."/res/", $holo);
    
    if (isset($radio) && $radio == true) {
	    $stylev8 .= '  <style name="RadioButton'.$name.'" parent="android:Widget.CompoundButton.RadioButton">'."\n";
	    $stylev8 .= '      <item name="android:button">@drawable/btn_radio_holo_'.$holo.'</item>'."\n";
	    $stylev8 .= '  </style>'."\n\n";
	    
	    $style8_available = true;
	    
	    $themev11 .= '    <item name="android:listChoiceIndicatorSingle">@drawable/btn_radio_holo_'.$holo.'</item>'."\n\n";
	    $themev8 .= '    <item name="android:radioButtonStyle">@style/RadioButton'.$name.'</item>'."\n\n";
    }
  }
  
  // ============== button =================== //
  if ((isset($button) && $button == true) || (isset($cbutton) && $cbutton == true)) {
    if ((isset($button) && $button == true) && (!isset($cbutton))) {
	    require_once('widgets/button/common-button.php');
	    $logger->debug("generate button");
	  
	    foreach ($button_classes as $clazz) {
	      generateImageOnDisk($clazz, $color, $holo, "widgets/button/");
	    }
	    
	    copy_directory("widgets/button/res/", $folder."/res/", $holo);
    } else {
    	require_once('widgets/cbutton/common-cbutton.php');
	    $logger->debug("generate cbutton");
	  
	    foreach ($cbutton_classes as $clazz) {
	      generateImageOnDisk($clazz, $color, $holo, "widgets/cbutton/");
	    }
	    
	    copy_directory("widgets/cbutton/res/", $folder."/res/", $holo);
    }
        
    if ($holo == "dark") {
		$stylev11 .= '  <style name="Button'.$name.'" parent="android:Widget.Holo.Button">'."\n";
		$stylev11 .= '	  <item name="android:background">@drawable/btn_default_holo_dark</item>'."\n";
		$stylev11 .= '  </style>'."\n\n";
		
		$stylev11 .= '  <style name="ImageButton'.$name.'" parent="android:Widget.Holo.ImageButton">'."\n";
	    $stylev11 .= '	  <item name="android:background">@drawable/btn_default_holo_dark</item>'."\n";
	    $stylev11 .= '  </style>'."\n\n";
	    
	    $button_image = "btn_default_holo_dark";
    } else {
    	$stylev11 .= '  <style name="Button'.$name.'" parent="android:Widget.Holo.Light.Button">'."\n";
		$stylev11 .= '	  <item name="android:background">@drawable/btn_default_holo_light</item>'."\n";
		$stylev11 .= '  </style>'."\n\n";
		
		$stylev11 .= '  <style name="ImageButton'.$name.'" parent="android:Widget.Holo.Light.ImageButton">'."\n";
	    $stylev11 .= '	  <item name="android:background">@drawable/btn_default_holo_light</item>'."\n";
	    $stylev11 .= '  </style>'."\n\n";
	    
	    $button_image = "btn_default_holo_light";
    }
    
    $stylev8 .= '  <style name="Button'.$name.'" parent="android:Widget.Button">'."\n";
    $stylev8 .= '	  <item name="android:background">@drawable/'.$button_image.'</item>'."\n";
    $stylev8 .= '	  <item name="android:minHeight">48dip</item>'."\n";
    $stylev8 .= '	  <item name="android:minWidth">64dip</item>'."\n";
	// TODO replace with selector
    if ($holo == "dark") {
    	$stylev8 .= '	  <item name="android:textColor">#ffffff</item>'."\n";
    } else {
    	$stylev8 .= '	  <item name="android:textColor">#000000</item>'."\n";
    }
    $stylev8 .= '  </style>'."\n\n";
    
    $stylev8 .= '  <style name="ImageButton'.$name.'" parent="android:Widget.ImageButton">'."\n";
	$stylev8 .= '	  <item name="android:background">@drawable/'.$button_image.'</item>'."\n";
	$stylev8 .= '  </style>'."\n\n"; 
    
	$style11_available = true;
	$style8_available = true;
	
	$themev11 .= '    <item name="android:buttonStyle">@style/Button'.$name.'</item>'."\n\n";
	$themev11 .= '    <item name="android:imageButtonStyle">@style/ImageButton'.$name.'</item>'."\n\n";
	
	$themev8 .= '    <item name="android:buttonStyle">@style/Button'.$name.'</item>'."\n\n";
	$themev8 .= '    <item name="android:imageButtonStyle">@style/ImageButton'.$name.'</item>'."\n\n";

  }
  
  // ============== cspinner =================== //
  if (isset($cspinner) && $cspinner == true) {
    require_once('widgets/cspinner/common-cspinner.php');
    $logger->debug("generate colored spinner");
  
    foreach ($cspinner_classes as $clazz) {
      generateImageOnDisk($clazz, $color, $holo, "widgets/cspinner/");
    }
    
    copy_directory("widgets/cspinner/res/", $folder."/res/", $holo);
  }
  
  // ============== spinner =================== //
  if (isset($spinner) && $spinner == true && !isset($cspinner)) {
    require_once('widgets/spinner/common-spinner.php');
    $logger->debug("generate spinner");
  
    foreach ($spinner_classes as $clazz) {
      generateImageOnDisk($clazz, $color, $holo, "widgets/spinner/");
    }
    
    copy_directory("widgets/spinner/res/", $folder."/res/", $holo);

  }
  
  // ============ cspinnner & spinner ============= //
  if ((isset($spinner) && $spinner == true) || (isset($cspinner) && $cspinner == true)) {
  	
  	if (!isset($list)) {
	    require_once('widgets/list/common-list.php');  
	    foreach ($list_classes as $clazz) {
	      generateImageOnDisk($clazz, $color, $holo, "widgets/list/");
	    }
	    copy_directory("widgets/list/res/", $folder."/res/", $holo);
	}
	
    if ($holo == "dark") {
		$stylev11 .= '  <style name="Spinner'.$name.'" parent="android:Widget.Holo.Spinner">'."\n";
        $stylev11 .= '      <item name="android:background">@drawable/spinner_background_holo_'.$holo.'</item>'."\n";
        $stylev11 .= '      <item name="android:dropDownSelector">@drawable/list_selector_holo_'.$holo.'</item>'."\n";
        $stylev11 .= '  </style>'."\n\n";
	} else {
		$stylev11 .= '  <style name="Spinner'.$name.'" parent="android:Widget.Holo.Light.Spinner">'."\n";
        $stylev11 .= '      <item name="android:background">@drawable/spinner_background_holo_'.$holo.'</item>'."\n";
        $stylev11 .= '      <item name="android:dropDownSelector">@drawable/list_selector_holo_'.$holo.'</item>'."\n";
        $stylev11 .= '  </style>'."\n\n";
	}
	
	$stylev8 .= '  <style name="Spinner'.$name.'" parent="android:Widget.Spinner">'."\n";
    $stylev8 .= '      <item name="android:background">@drawable/spinner_background_holo_'.$holo.'</item>'."\n";
    $stylev8 .= '      <item name="android:dropDownSelector">@drawable/list_selector_holo_'.$holo.'</item>'."\n";
    $stylev8 .= '  </style>'."\n\n";
    
    $stylev8 .= '  <style name="Spinner'.$name.'.DropDown">'."\n";
    $stylev8 .= '      <item name="android:spinnerMode">dropdown</item>'."\n";
    $stylev8 .= '  </style>'."\n\n";

	$stylev8 .= '  <style name="SpinnerDropDownItem'.$name.'" parent="android:Widget.DropDownItem.Spinner">'."\n";
    $stylev8 .= '      <item name="android:checkMark">@drawable/btn_radio_holo_'.$holo.'</item>'."\n";
    $stylev8 .= '  </style>'."\n";

	$style11_available = true;
	$style8_available = true;
    
    $themev11 .= '    <item name="android:dropDownSpinnerStyle">@style/Spinner'.$name.'</item>'."\n\n";
    $themev8 .= '    <item name="android:spinnerStyle">@style/Spinner'.$name.'</item>'."\n\n";
    $themev8 .= '    <item name="android:dropDownSpinnerStyle">@style/Spinner'.$name.'.DropDown</item>'."\n\n";
    $themev8 .= '    <item name="android:spinnerDropDownItemStyle">@style/SpinnerDropDownItem'.$name.'</item>'."\n\n";
  }  

  
  // ============= progressbar ================ //
  if (isset($progressbar) && $progressbar == true) {
  	require_once('widgets/progressbar/common-progressbar.php');
  	
  	$logger->debug("generate progressbar");
  
  	$img_sizes = array('mdpi', 'hdpi', 'xhdpi');
  	
  	for ($i = 1; $i <= 8 ; $i++) {  	  
	  $pb = new ProgressBar("widgets/progressbar/", $i);
	 	  	  
	  foreach ($img_sizes as $img_size) {
	  	 $pb->generate_image($color, $img_size, $holo);
	  }
  	}
  	
  	foreach ($progressbar_classes as $clazz) {
      generateImageOnDisk($clazz, $color, $holo, "widgets/progressbar/");
    }
  	
  	copy_directory("widgets/progressbar/res/", $folder."/res/", $holo);
    
    
	if ($holo == "dark") {
	    $stylev11 .= '  <style name="ProgressBar'.$name.'" parent="android:Widget.Holo.ProgressBar.Horizontal">'."\n";
	} else {
	    $stylev11 .= '  <style name="ProgressBar'.$name.'" parent="android:Widget.Holo.Light.ProgressBar.Horizontal">'."\n";
	}
    $stylev11 .= '      <item name="android:progressDrawable">@drawable/progress_horizontal_holo_'.$holo.'</item>'."\n";
    $stylev11 .= '      <item name="android:indeterminateDrawable">@drawable/progress_indeterminate_horizontal_holo_'.$holo.'</item>'."\n";
    $stylev11 .= '  </style>'."\n\n";
    
    $stylev8 .= '  <style name="ProgressBar'.$name.'" parent="android:Widget.ProgressBar.Horizontal">'."\n";
    $stylev8 .= '      <item name="android:progressDrawable">@drawable/progress_horizontal_holo_'.$holo.'</item>'."\n";
    $stylev8 .= '      <item name="android:indeterminateDrawable">@drawable/progress_indeterminate_horizontal_holo_'.$holo.'</item>'."\n";
    $stylev8 .= '      <item name="android:minHeight">16dip</item>'."\n";
    $stylev8 .= '      <item name="android:maxHeight">16dip</item>'."\n";
    $stylev8 .= '  </style>'."\n\n";
    
    $style11_available = true;
	$style8_available = true;
    
    $themev11 .= '    <item name="android:progressBarStyleHorizontal">@style/ProgressBar'.$name.'</item>'."\n\n";
    $themev8 .= '    <item name="android:progressBarStyleHorizontal">@style/ProgressBar'.$name.'</item>'."\n\n";
  }
  
  //  ============== seekbar ================ //
   if (isset($seekbar) && $seekbar == true) {
    require_once('widgets/seekbar/common-seekbar.php');
    $logger->debug("generate seekbar");
  
    foreach ($seekbar_classes as $clazz) {
      generateImageOnDisk($clazz, $color, $holo, "widgets/seekbar/");
    }
    
    copy_directory("widgets/seekbar/res/", $folder."/res/", $holo);

	if ($holo == "dark") {
		$stylev11 .= '  <style name="SeekBar'.$name.'" parent="android:Widget.Holo.SeekBar">'."\n";
	} else {
		$stylev11 .= '  <style name="SeekBar'.$name.'" parent="android:Widget.Holo.Light.SeekBar">'."\n";
	}
    $stylev11 .= '      <item name="android:progressDrawable">@drawable/scrubber_progress_horizontal_holo_'.$holo.'</item>'."\n";
    $stylev11 .= '      <item name="android:indeterminateDrawable">@drawable/scrubber_progress_horizontal_holo_'.$holo.'</item>'."\n";
    $stylev11 .= '      <item name="android:thumb">@drawable/scrubber_control_selector_holo_'.$holo.'</item>'."\n";
	$stylev11 .= '  </style>'."\n\n";
	
	$stylev8 .= '  <style name="SeekBar'.$name.'" parent="android:Widget.SeekBar">'."\n";
	$stylev8 .= '      <item name="android:progressDrawable">@drawable/scrubber_progress_horizontal_holo_'.$holo.'</item>'."\n";
    $stylev8 .= '      <item name="android:indeterminateDrawable">@drawable/scrubber_progress_horizontal_holo_'.$holo.'</item>'."\n";
    $stylev8 .= '      <item name="android:minHeight">13dip</item>'."\n";
    $stylev8 .= '      <item name="android:maxHeight">13dip</item>'."\n";
    $stylev8 .= '      <item name="android:thumb">@drawable/scrubber_control_selector_holo_'.$holo.'</item>'."\n";
    $stylev8 .= '      <item name="android:thumbOffset">16dip</item>'."\n";
    $stylev8 .= '      <item name="android:paddingLeft">16dip</item>'."\n";
    $stylev8 .= '      <item name="android:paddingRight">16dip</item>'."\n";
    $stylev8 .= '  </style>'."\n\n";
    
    $style11_available = true;
	$style8_available = true;
    
    $themev11 .= '    <item name="android:seekBarStyle">@style/SeekBar'.$name.'</item>'."\n\n"; 
    $themev8 .= '    <item name="android:seekBarStyle">@style/SeekBar'.$name.'</item>'."\n\n";    
  }
  
  //  ============== ratingbar ================ //
  if (isset($ratingbar) && $ratingbar == true) {
    require_once('widgets/ratingbar/common-ratingbar.php');
    $logger->debug("generate ratingbar");
  
    foreach ($ratingbar_classes as $clazz) {
      generateImageOnDisk($clazz, $color, $holo, "widgets/ratingbar/");
    }
    
    copy_directory("widgets/ratingbar/res/", $folder."/res/", $holo);
    
    if ($holo == "dark") {
      $stylev11 .= '  <style name="RatingBar'.$name.'" parent="android:Widget.Holo.RatingBar">'."\n";
    } else {
       $stylev11 .= '  <style name="RatingBar'.$name.'" parent="android:Widget.Holo.Light.RatingBar">'."\n";	
    }
    $stylev11 .= '      <item name="android:progressDrawable">@drawable/ratingbar_full_holo_'.$holo.'</item>'."\n";
    $stylev11 .= '      <item name="android:indeterminateDrawable">@drawable/ratingbar_full_holo_'.$holo.'</item>'."\n";
    $stylev11 .= '  </style>'."\n\n";
    
    $stylev8 .= '  <style name="RatingBar'.$name.'" parent="android:Widget.RatingBar">'."\n";
    $stylev8 .= '      <item name="android:progressDrawable">@drawable/ratingbar_full_holo_'.$holo.'</item>'."\n";
    $stylev8 .= '      <item name="android:indeterminateDrawable">@drawable/ratingbar_full_holo_'.$holo.'</item>'."\n";
    $stylev8 .= '  </style>'."\n\n";
    
    $style11_available = true;
    $style8_available = true;
    
    $themev11 .= '    <item name="android:ratingBarStyle">@style/RatingBar'.$name.'</item>'."\n\n";
    $themev8 .= '    <item name="android:ratingBarStyle">@style/RatingBar'.$name.'</item>'."\n\n";
  }
  
  // ================== ratingstarbig ===================== //
  if (isset($ratingstarbig) && $ratingstarbig == true) {
    require_once('widgets/ratingstarbig/common-ratingstarbig.php');
    $logger->debug("generate ratingstarbig");
  
    foreach ($ratingbarbig_classes as $clazz) {
      generateImageOnDisk($clazz, $color, $holo, "widgets/ratingstarbig/");
    }
    
    copy_directory("widgets/ratingstarbig/res/", $folder."/res/", $holo);
  
  	if ($holo == "dark") {
      $stylev11 .= '  <style name="RatingBarBig'.$name.'" parent="android:Widget.Holo.RatingBar.Indicator">'."\n";
    } else {
       $stylev11 .= '  <style name="RatingBarBig'.$name.'" parent="android:Widget.Holo.Light.RatingBar.Indicator">'."\n";	
    }
    $stylev11 .= '      <item name="android:progressDrawable">@drawable/ratingbar_holo_'.$holo.'</item>'."\n";
    $stylev11 .= '      <item name="android:indeterminateDrawable">@drawable/ratingbar_holo_'.$holo.'</item>'."\n";
    $stylev11 .= '  </style>'."\n\n";
      
  	$stylev8 .= '  <style name="RatingBarBig'.$name.'">'."\n";
    $stylev8 .= '      <item name="android:progressDrawable">@drawable/ratingbar_holo_'.$holo.'</item>'."\n";
    $stylev8 .= '      <item name="android:indeterminateDrawable">@drawable/ratingbar_holo_'.$holo.'</item>'."\n";
    $stylev8 .= '      <item name="android:minHeight">35dip</item>'."\n";
    $stylev8 .= '      <item name="android:maxHeight">35dip</item>'."\n";
    $stylev8 .= '  </style>'."\n\n";
    
    $style11_available = true;
	$style8_available = true;
  
  	$themev11 .= '    <item name="android:ratingBarStyleIndicator">@style/RatingBarBig'.$name.'</item>'."\n\n"; 
    $themev8 .= '    <item name="android:ratingBarStyleIndicator">@style/RatingBarBig'.$name.'</item>'."\n\n"; 

  }
  
  // ================== ratingstarsmall ===================== //
  if (isset($ratingstarsmall) && $ratingstarsmall == true) {
    require_once('widgets/ratingstarsmall/common-ratingstarsmall.php');
    $logger->debug("generate ratingstarsmall");
  
    foreach ($ratingbarsmall_classes as $clazz) {
      generateImageOnDisk($clazz, $color, $holo, "widgets/ratingstarsmall/");
    }
    
    copy_directory("widgets/ratingstarsmall/res/", $folder."/res/", $holo);
  
  	if ($holo == "dark") {
      $stylev11 .= '  <style name="RatingBarSmall'.$name.'" parent="android:Widget.Holo.RatingBar.Small">'."\n";
    } else {
       $stylev11 .= '  <style name="RatingBarSmall'.$name.'" parent="android:Widget.Holo.Light.RatingBar.Small">'."\n";	
    }
    $stylev11 .= '      <item name="android:progressDrawable">@drawable/ratingbar_small_holo_'.$holo.'</item>'."\n";
    $stylev11 .= '      <item name="android:indeterminateDrawable">@drawable/ratingbar_small_holo_'.$holo.'</item>'."\n";
    $stylev11 .= '  </style>'."\n\n";
    
  	$stylev8 .= '  <style name="RatingBarSmall'.$name.'">'."\n";
    $stylev8 .= '      <item name="android:progressDrawable">@drawable/ratingbar_small_holo_'.$holo.'</item>'."\n";
    $stylev8 .= '      <item name="android:indeterminateDrawable">@drawable/ratingbar_small_holo_'.$holo.'</item>'."\n";
    $stylev8 .= '      <item name="android:minHeight">16dip</item>'."\n";
    $stylev8 .= '      <item name="android:maxHeight">16dip</item>'."\n";
    $stylev8 .= '  </style>'."\n\n"; 
    
    $style11_available = true;
  	$style8_available = true;
  	
  	$themev11 .= '    <item name="android:ratingBarStyleSmall">@style/RatingBarSmall'.$name.'</item>'."\n\n"; 
    $themev8 .= '    <item name="android:ratingBarStyleSmall">@style/RatingBarSmall'.$name.'</item>'."\n\n";
  }
  
  //  ============== toggle ================ //
  if (isset($toggle) && $toggle == true) {
    require_once('widgets/toggle/common-toggle.php');
    $logger->debug("generate toggle");
  
    foreach ($toggle_classes as $clazz) {
      generateImageOnDisk($clazz, $color, $holo, "widgets/toggle/");
    }
    
    copy_directory("widgets/toggle/res/", $folder."/res/", $holo);

	if ($holo == "dark") {
		$stylev11 .= '  <style name="Toggle'.$name.'" parent="android:Widget.Holo.Button.Toggle">'."\n";
	} else {
		$stylev11 .= '  <style name="Toggle'.$name.'" parent="android:Widget.Holo.Light.Button.Toggle">'."\n";
	}
    $stylev11 .= '      <item name="android:background">@drawable/btn_toggle_holo_'.$holo.'</item>'."\n";
	$stylev11 .= '  </style>'."\n\n";
	
	$stylev8 .= '  <style name="Toggle'.$name.'" parent="android:Widget.Button.Toggle">'."\n";
    $stylev8 .= '      <item name="android:background">@drawable/btn_toggle_holo_'.$holo.'</item>'."\n";
    $stylev8 .= '      <item name="android:minHeight">48dip</item>'."\n";
    if ($holo == "dark") {
    	// TODO : replace with selector
    	$stylev8 .= '	  <item name="android:textColor">#ffffff</item>'."\n";
    }
    $stylev8 .= '  </style>'."\n\n";
    
    $style11_available = true;
	$style8_available = true;
    
    $themev11 .= '    <item name="android:buttonStyleToggle">@style/Toggle'.$name.'</item>'."\n\n";
    $themev8 .= '    <item name="android:buttonStyleToggle">@style/Toggle'.$name.'</item>'."\n\n";
  }
  
  //  ============== list selector ================ //
   if ((isset($list) && $list == true)) {
    require_once('widgets/list/common-list.php');
    $logger->debug("generate list");
  
    foreach ($list_classes as $clazz) {
      generateImageOnDisk($clazz, $color, $holo, "widgets/list/");
    }
    
    copy_directory("widgets/list/res/", $folder."/res/", $holo);
    	
    	$themev11 .= '    <item name="android:listChoiceBackgroundIndicator">@drawable/list_selector_holo_'.$holo.'</item>'."\n\n";
	    $themev11 .= '    <item name="android:activatedBackgroundIndicator">@drawable/activated_background_holo_'.$holo.'</item>'."\n\n";
	    
	    $stylev8 .= '  <style name="ListView'.$name.'" parent="android:Widget.ListView">'."\n";
	    $stylev8 .= '      <item name="android:listSelector">@drawable/list_selector_holo_'.$holo.'</item>'."\n";
	    $stylev8 .= '  </style>'."\n\n";
	    
	    $stylev8 .= '  <style name="ListView'.$name.'.White" parent="android:Widget.ListView.White">'."\n";
	    $stylev8 .= '      <item name="android:listSelector">@drawable/list_selector_holo_'.$holo.'</item>'."\n";
	    $stylev8 .= '  </style>'."\n\n";
	  
	    $themev8 .= '    <item name="android:listViewStyle">@style/ListView'.$name.'</item>'."\n\n";
	    $themev8 .= '    <item name="android:listViewWhiteStyle">@style/ListView'.$name.'.White</item>'."\n\n";
	    
		$stylev8 .= '  <style name="SpinnerItem'.$name.'" parent="android:TextAppearance.Widget.TextView.SpinnerItem">'."\n";
	    // TODO : replace with selector
		if ($holo == "dark") {
	    	$stylev8 .= '      <item name="android:textColor">#ffffff</item>'."\n";
	    } else {
	    	$stylev8 .= '      <item name="android:textColor">#000000</item>'."\n";
	    }
		$stylev8 .= '  </style>'."\n\n";
    	$themev8 .= '    <item name="android:spinnerItemStyle">@style/SpinnerItem'.$name.'</item>'."\n\n";
	 
		$style8_available = true;
    
    // TODO dropdown, expandable...    
  }
  
  // ================= fastscroll ====================//
  if (isset($fastscroll) && $fastscroll==true) {
  	require_once('widgets/fastscroll/common-fastscroll.php');
    $logger->debug("generate fastscroll");
  
    foreach ($fastscroll_classes as $clazz) {
      generateImageOnDisk($clazz, $color, $holo, "widgets/fastscroll/");
    }
    
    copy_directory("widgets/fastscroll/res/", $folder."/res/", $holo, false);
    
    $themev11 .= '    <item name="android:fastScrollThumbDrawable">@drawable/fastscroll_thumb_holo</item>'."\n\n";
	
	// not available in v8
  }
  
    
  // ================ search edit text ================//
  /*
  if (isset($search) && $search == true) {
    require_once('widgets/search/common-search.php');
    $logger->debug("generate search");
  
    foreach ($search_classes as $clazz) {
      generateImageOnDisk($clazz, $color, $holo, "widgets/search/");
    }
    
    copy_directory("widgets/search/res/", $folder."/res/", $holo);
    
    // TODO : v8
    
    $themev11 .= '    <item name="android:searchViewTextField">@drawable/textfield_searchview_holo_dark</item>'."\n\n";
    $themev11 .= '    <item name="android:searchViewTextFieldRight">@drawable/textfield_searchview_right_holo_dark</item>'."\n\n";
  }
  */
  
    //  ============== numberpicker ================ //
   /*
   if (isset($numberpicker) && $numberpicker == true) {
    require_once('widgets/numberpicker/common-numberpicker.php');
    $logger->debug("generate numberpicker");
  
    foreach ($numberpicker_classes as $clazz) {
      generateImageOnDisk($clazz, $color, $holo, "widgets/numberpicker/");
    }
    
    copy_directory("widgets/numberpicker/res/", $folder."/res/", $holo);

	if ($holo == "dark") {
		$stylev11 .= '  <style name="NumberPicker'.$name.'" parent="android:Widget.Holo.NumberPicker">'."\n";
	} else {
		$stylev11 .= '  <style name="NumberPicker'.$name.'" parent="android:Widget.Holo.Light.NumberPicker">'."\n";
	}
    $stylev11 .= '      <item name="android:selectionDivider">@drawable/numberpicker_selection_divider</item>'."\n";
	$stylev11 .= '  </style>'."\n\n";
	
	if ($holo == "dark") {
		$stylev11 .= '  <style name="NumberPickerButtonUp'.$name.'" parent="android:Widget.Holo.ImageButton.NumberPickerUpButton">'."\n";
	} else {
		$stylev11 .= '  <style name="NumberPickerButtonUp'.$name.'" parent="android:Widget.Holo.Light.ImageButton.NumberPickerUpButton">'."\n";
	}
    $stylev11 .= '      <item name="android:src">@drawable/numberpicker_up_btn_holo_'.$holo.'</item>'."\n";
	$stylev11 .= '  </style>'."\n\n";
    
    if ($holo == "dark") {
		$stylev11 .= '  <style name="NumberPickerButtonDown'.$name.'" parent="android:Widget.Holo.ImageButton.NumberPickerDownButton">'."\n";
	} else {
		$stylev11 .= '  <style name="NumberPickerButtonDown'.$name.'" parent="android:Widget.Holo.Light.ImageButton.NumberPickerDownButton">'."\n";
	}
    $stylev11 .= '      <item name="android:src">@drawable/numberpicker_down_btn_holo_'.$holo.'</item>'."\n";
	$stylev11 .= '  </style>'."\n\n";
    
    $style11_available = true;
	$style8_available = true;
    
    $themev11 .= '    <item name="numberPickerUpButtonStyle">@style/NumberPickerButtonUp'.$name.'</item>'."\n";   
    $themev11 .= '    <item name="numberPickerDownButtonStyle">@style/NumberPickerButtonDown'.$name.'</item>'."\n";
    $themev11 .= '    <item name="numberPickerStyle">@style/NumberPicker'.$name.'</item>'."\n\n";
  }
  */
  
  //  ============== switch ================ //
  
   if (isset($switch) && $switch == true) {
    require_once('widgets/switch/common-switch.php');
    $logger->debug("generate switch");
  
    foreach ($switch_classes as $clazz) {
      generateImageOnDisk($clazz, $color, $holo, "widgets/switch/");
    }
    
    copy_directory("widgets/switch/res/", $folder."/res/", $holo);
    
    /*
    $stylev14 = $stylev11;
	$themev14 = $themev11;
	
	if ($holo == "dark") {
		$stylev14 .= '  <style name="Switch'.$name.'" parent="android:Widget.Holo.CompoundButton.Switch">'."\n";
	} else {
		$stylev14 .= '  <style name="Switch'.$name.'" parent="android:Widget.Holo.Light.CompoundButton.Switch">'."\n";
	}
    $stylev14 .= '      <item name="android:track">@drawable/switch_track_holo_'.$holo.'</item>'."\n";
    $stylev14 .= '      <item name="android:thumb">@drawable/switch_inner_holo_'.$holo.'</item>'."\n";
	$stylev14 .= '  </style>'."\n\n";
    
    $style14_available = true;
    
    $themev14 .= '    <item name="android:switchStyle">@style/Switch'.$name.'</item>'."\n\n";    
    
    $themev14 .= "  </style>\n\n</resources>";
    $stylev14 .= "</resources>";
    */
  }
  
  
    
  // ============== theme & style ================ //
  
  $themev11 .= "  </style>\n\n</resources>";
  $stylev11 .= "</resources>";
  
  $themev8 .= "  </style>\n\n</resources>";
  $stylev8 .= "</resources>";

  
  $theme_file = "generated/".$date."/".$_SESSION['id']."/res/values-v11/".strtolower($name)."_themes.xml";
  $fp = fopen($theme_file, 'w');
  fwrite($fp, $themev11);
  fclose($fp);
  
  $theme_file = "generated/".$date."/".$_SESSION['id']."/res/values/".strtolower($name)."_themes.xml";
  $fp = fopen($theme_file, 'w');
  fwrite($fp, $themev8);
  fclose($fp);
  
  if ($style8_available == true) {
	  $style_file = "generated/".$date."/".$_SESSION['id']."/res/values/".strtolower($name)."_styles.xml";
	  $fp = fopen($style_file, 'w');
	  fwrite($fp, $stylev8);
	  fclose($fp);
  }
  
  if ($style11_available == true) {
	  $style_file = "generated/".$date."/".$_SESSION['id']."/res/values-v11/".strtolower($name)."_styles.xml";
	  $fp = fopen($style_file, 'w');
	  fwrite($fp, $stylev11);
	  fclose($fp);
  }
  
  if ($style14_available == true) {
	  	$values14 = "generated/".$date."/".$_SESSION['id']."/res/values-v14";
 		if (file_exists($values14) == FALSE) {
  			mkdir($values14, 0777, true);
  		} 
  		  $theme_file = "generated/".$date."/".$_SESSION['id']."/res/values-v14/".strtolower($name)."_themes.xml";
		  $fp = fopen($theme_file, 'w');
		  fwrite($fp, $themev14);
		  fclose($fp);	
		  $style_file = "generated/".$date."/".$_SESSION['id']."/res/values-v14/".strtolower($name)."_styles.xml";
		  $fp = fopen($style_file, 'w');
		  fwrite($fp, $stylev14);
		  fclose($fp);
  }
  
  // ============== ZIP ====================== //
  $zipname = getcwd()."/generated/".$date."/".$_SESSION['id'].".zip";
  $logger->debug("preparing zip ".$zipname);
  		  
  if (Zip($folder, $zipname)) {
  	header('Set-Cookie: fileDownload=true'); 
  	header("Content-type: application/zip" );
  	header('Content-Disposition: attachment; filename="android-holo-colors-'.$name.'.zip"');
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
	  		$drawable = getcwd()."/generated/".$date."/".$_SESSION['id']."/res/drawable";
	  		if (file_exists($drawable."-mdpi") == FALSE) {
	  			mkdir($drawable."-mdpi", 0777, true);
	  		}
	  		if (file_exists($drawable."-xhdpi") == FALSE) {
	  			mkdir($drawable."-xhdpi", 0777, true);
	  		}
	  		if (file_exists($drawable."-hdpi") == FALSE) {
	  			mkdir($drawable."-hdpi", 0777, true);
	  		}
	  		if (file_exists($drawable) == FALSE) {
	  			mkdir($drawable, 0777, true);
	  		}
	  		$values = getcwd()."/generated/".$date."/".$_SESSION['id']."/res/values";
	  		if (file_exists($values) == FALSE) {
	  			mkdir($values, 0777, true);
	  		}
	  		$values11 = getcwd()."/generated/".$date."/".$_SESSION['id']."/res/values-v11";
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
		            
		            if (strstr($file, "res/")) {
		
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
		function copy_directory( $source, $destination, $holo, $check_holo=true) {
			$log = Logger::getLogger("copy");
			$log->debug("copy directory : ".$source." in ".$destination);
			
			if ( is_dir( $source ) ) {
				$directory = dir( $source );
				while ( FALSE !== ( $readdirectory = $directory->read() ) ) {
					if ( $readdirectory == '.' || $readdirectory == '..' || $readdirectory == '.DS_Store') {
						continue;
					}
					$PathDir = $source . '/' . $readdirectory; 
					$log->debug("Path : ".$PathDir." holo=".$check_holo);
					if ( is_dir( $PathDir ) ) {
						copy_directory( $PathDir, $destination . '/' . $readdirectory, $holo, $check_holo );
						continue;
					}
					if ($check_holo == false) {
						$log->debug("holo false => copy ".$PathDir);
						copy( $PathDir, $destination . '/' . $readdirectory );
					}
					else if (strpos($readdirectory, $holo)) {
						$log->debug("holo true => copy ".$PathDir);
						copy( $PathDir, $destination . '/' . $readdirectory );
					}
				}
				$directory->close();
			} else {
				copy( $source, $destination );
			}
		}

?>