<?

  require_once('common-toggle.php');
  
  $color = $_GET['color'];
  $size = $_GET['size'];
  $holo = $_GET['holo'];
  $component = $_GET['component'];
  
  if (isset($color) && isset($size) && isset($holo) && isset($component)) {
  	
  	switch ($component) {
  		case "toggle":
	  		$toggle = new Toggle();
	  		break;
	  	case "toggle-on-focus":
	  		$toggle = new ToggleOnFocus();
	  		break;
	  	case "toggle-on-pressed":
	  		$toggle = new ToggleOnPress();
	  		break;
	  	case "toggle-off-focus":
	  		$toggle = new ToggleOffFocus();
	  		break;
	  	case "toggle-off-pressed":
	  		$toggle = new ToggleOffPress();
	  		break;
	  	case "toggle-disabled":
	  		$toggle = new ToggleOnDisabled();
	  		break;
	  	case "toggle-disabled-focus":
	  		$toggle = new ToggleOnDisabledFocus();
	  		break;
	  	case "toggle-off-disabled-focus":
	  		$toggle = new ToggleOffDisabledFocus();
	  		break;
	  	default:
	  		$toggle = new Toggle();
	  		break;
  	}	
  	
  	$toggle->generate_image($color, $size, $holo);
  }
  

?>