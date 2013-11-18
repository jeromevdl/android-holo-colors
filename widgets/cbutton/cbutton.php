<?

  require_once('common-cbutton.php');
  
  $color = $_GET['color'];
  $size = $_GET['size'];
  $holo = $_GET['holo'];
  $kitkat = (bool) $_GET['kitkat'];
  $component = $_GET['component'];
  
  if (isset($color) && isset($size) && isset($holo) && isset($component) && isset($kitkat)) {
  	switch ($component) {
  		case "cbutton":
	  		$button = new CButton();
	  		break;
	  	case "cbutton-pressed":
	  		$button = new CButtonPress();
	  		break;
	  	case "cbutton-focus":
	  		$button = new CButtonFocus();
	  		break;
	  	case "cbutton-disabled-focus":
	  		$button = new CButtonDisabledFocus();
	  		break;
	  	default:
	  		$button = new CButton();
	  		break;
  	}	
  	$button->generate_image($color, $size, $holo, $kitkat);
  }
  

?>