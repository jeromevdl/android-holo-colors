<?

  require_once('common-button.php');
  
  $color = $_GET['color'];
  $size = $_GET['size'];
  $holo = $_GET['holo'];
  $kitkat = (bool) $_GET['kitkat'];
  $component = $_GET['component'];
  
  if (isset($color) && isset($size) && isset($holo) && isset($component) && isset($kitkat)) {
  	switch ($component) {
  		case "button":
	  		$button = new Button();
	  		break;
	  	case "button-pressed":
	  		$button = new ButtonPress();
	  		break;
	  	case "button-focus":
	  		$button = new ButtonFocus();
	  		break;
	  	case "button-disabled-focus":
	  		$button = new ButtonDisabledFocus();
	  		break;
	  	default:
	  		$button = new Button();
	  		break;
  	}	
  	$button->generate_image($color, $size, $holo, $kitkat);
  }
  

?>