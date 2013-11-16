<?

  require_once('common-edittext.php');

  $color = $_GET['color'];
  $size = $_GET['size'];
  $holo = $_GET['holo'];
  $kitkat = $_GET['kitkat'];
  $component = $_GET['component'];
  
  if (isset($color) && isset($size) && isset($holo) && isset($component)) {
  	switch ($component) {
  		case "edittext":
	  		$et = new EditText();
	  		break;
	  	case "edittext-activated":
	  		$et = new EditTextActivate();
	  		break;
	  	case "edittext-focus":
	  		$et = new EditTextFocus();
	  		break;
	  	default:
	  		$et = new EditText();
	  		break;
  	}	

    $et->generate_image($color, $size, $holo, $kitkat);
  }

?>