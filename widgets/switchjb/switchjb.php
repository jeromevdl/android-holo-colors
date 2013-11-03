<?

  require_once('common-switchjb.php');
  
  $color = $_GET['color'];
  $size = $_GET['size'];
  $holo = $_GET['holo'];
  $component = $_GET['component'];
  
  if (isset($color) && isset($size) && isset($holo) && isset($component)) {
  	
  	switch ($component) {
  		case "switchjb":
	  		$toggle = new SwitchJBThumbActivated();
	  		break;
	  	case "switchjb-pressed":
	  		$toggle = new SwitchJBThumbPress();
	  		break;
	  	case "switchjb-bg":
	  		$toggle = new SwitchJBBackground();
	  		break;
	  	default:
	  		$toggle = new SwitchJBThumbActivated();
	  		break;
  	}	
  	
  	$toggle->generate_image($color, $size, $holo);
  }
  

?>