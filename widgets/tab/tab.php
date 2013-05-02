<?

  require_once('common-tab.php');
  
  $color = $_GET['color'];
  $size = $_GET['size'];
  $holo = $_GET['holo'];
  $component = $_GET['component'];
  
  if (isset($color) && isset($size) && isset($holo) && isset($component)) {
  	
  	switch ($component) {
  		case "tab":
	  		$toggle = new TabSelected();
	  		break;
	  	case "tab-selected-pressed":
	  		$toggle = new TabSelectedPress();
	  		break;
	  	case "tab-selected-focus":
	  		$toggle = new TabSelectedFocus();
	  		break;
	  	 case "tab-unselected":
	  		$toggle = new TabUnselected();
	  		break;
	  	case "tab-unselected-pressed":
	  		$toggle = new TabUnselectedPress();
	  		break;
	  	case "tab-unselected-focus":
	  		$toggle = new TabUnselectedFocus();
	  		break;
	  	default:
	  		$toggle = new TabSelected();
	  		break;
  	}	
  	
  	$toggle->generate_image($color, $size, $holo);
  }
  

?>