<?

  require_once('common-switchjb.php');
  
  $color = $_GET['color'];
  $size = $_GET['size'];
  $holo = $_GET['holo'];
  $component = $_GET['component'];
  
  if (isset($color) && isset($size) && isset($holo) && isset($component)) {
  	
  	switch ($component) {
  		case "switchjb":
	  		$toggle = new SwitchThumbActivated();
	  		break;
	  	case "switchjb-pressed":
	  		$toggle = new SwitchThumbPress();
	  		break;
	  	case "switchjb-bg":
	  		$toggle = new SwitchBackground();
	  		break;
	  	default:
	  		$toggle = new SwitchThumbActivated();
	  		break;
  	}	
  	
  	$toggle->generate_image($color, $size, $holo);
  }
  

?>