<?

  require_once('common-kbutton.php');
  
  $color = $_GET['color'];
  $size = $_GET['size'];
  $holo = $_GET['holo'];
  $component = $_GET['component'];
  
  if (isset($color) && isset($size) && isset($holo) && isset($component)) {
  	switch ($component) {
  		case "kbutton":
	  		$button = new KButton();
	  		break;
	  	case "kbutton-pressed":
	  		$button = new KButtonPress();
	  		break;
	  	case "kbutton-focus":
	  		$button = new KButtonFocus();
	  		break;
	  	case "kbutton-disabled-focus":
	  		$button = new KButtonDisabledFocus();
	  		break;
	  	default:
	  		$button = new KButton();
	  		break;
  	}	
  	$button->generate_image($color, $size, $holo);
  }
  

?>