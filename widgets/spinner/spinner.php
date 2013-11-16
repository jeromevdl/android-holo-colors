<?

  require_once('common-spinner.php');

  $color = $_GET['color'];
  $size = $_GET['size'];
  $holo = $_GET['holo'];
  $kitkat = (bool) $_GET['kitkat'];
  $component = $_GET['component'];
  
  if (isset($color) && isset($size) && isset($holo) && isset($component) && isset($kitkat)) {
  	switch ($component) {
		case "spinner":
    		$sp = new Spinner();
    		break;
    	case "spinner-focus":
    		$sp = new SpinnerFocus();
    		break;
    	case "spinner-pressed":
    		$sp = new SpinnerPress();
    		break;
    	default:
    		$sp = new Spinner();
    		break;
  	}
    $sp->generate_image($color, $size, $holo, $kitkat);
  }

?>