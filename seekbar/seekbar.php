<?

  require_once('common-seekbar.php');
  
  $color = $_GET['color'];
  $size = $_GET['size'];
  $holo = $_GET['holo'];
  $component = $_GET['component'];
  
  if (isset($color) && isset($size) && isset($holo) && isset($component)) {
  	switch ($component) {
  		case "seekbar":
		  	$sb = new SeekBar();
		  	break;
		case "seekbar-disabled":
			$sb = new SeekBarDisabled();
		  	break;
		case "seekbar-focus":
			$sb = new SeekBarFocus();
		  	break;
		case "seekbar-pressed":
			$sb = new SeekBarPress();
		  	break;
		case "seekbar-primary":
			$sb = new SeekBarPrimary();
		  	break;
		case "seekbar-secondary":
			$sb = new SeekBarSecondary();
		  	break;
		default:
			$sb = new SeekBar();
		  	break;
  	}
  	
  	$sb->generate_image($color, $size, $holo);
  }
  

?>