<?

  require_once('common-numberpicker.php');
  
  $color = $_GET['color'];
  $size = $_GET['size'];
  $holo = $_GET['holo'];
  $component = $_GET['component'];
  
  if (isset($color) && isset($size) && isset($holo) && isset($component)) {
  	
  	switch ($component) {
  		case "numberpicker":
	  		$toggle = new NbPickerDownPress();
	  		break;
	  	case "numberpicker-down-longpressed":
	  		$toggle = new NbPickerDownLongPress();
	  		break;
	  	case "numberpicker-down-focus":
	  		$toggle = new NbPickerDownFocus();
	  		break;
	  	case "numberpicker-down-disabled-focus":
	  		$toggle = new NbPickerDownDisabledFocus();
	  		break;
	  	 case "numberpicker-up":
	  		$toggle = new NbPickerUpPress();
	  		break;
	  	case "numberpicker-up-longpressed":
	  		$toggle = new NbPickerUpLongPress();
	  		break;
	  	case "numberpicker-up-focus":
	  		$toggle = new NbPickerUpFocus();
	  		break;
	  	case "numberpicker-up-disabled-focus":
	  		$toggle = new NbPickerUpDisabledFocus();
	  		break;
	  	case "numberpicker-divider":
	  		$toggle = new NbPickerDivider();
	  		break;
	  	default:
	  		$toggle = new NbPickerDownPress();
	  		break;
  	}	
  	
  	$toggle->generate_image($color, $size, $holo);
  }
  

?>