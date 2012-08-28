<?

  require_once('common-switch.php');
  
  $color = $_GET['color'];
  $size = $_GET['size'];
  $holo = $_GET['holo'];
  $component = $_GET['component'];
  
  if (isset($color) && isset($size) && isset($holo) && isset($component)) {
  	
  	switch ($component) {
  		case "switch":
	  		$toggle = new SwitchThumbActivated();
	  		break;
	  	case "switch-pressed":
	  		$toggle = new SwitchThumbPress();
	  		break;
	  	case "switch-bg":
	  		$toggle = new SwitchBackground();
	  		break;
	  	default:
	  		$toggle = new SwitchThumbActivated();
	  		break;
  	}	
  	
  	$toggle->generate_image($color, $size, $holo);
  }
  

?>