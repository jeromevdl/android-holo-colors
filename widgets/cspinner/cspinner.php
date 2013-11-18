<?

  require_once('common-cspinner.php');

  $color = $_GET['color'];
  $size = $_GET['size'];
  $holo = $_GET['holo'];
  $kitkat = (bool) $_GET['kitkat'];
  $component = $_GET['component'];
  
  if (isset($color) && isset($size) && isset($holo) && isset($component) && isset($kitkat)) {
  	switch ($component) {
		case "cspinner":
    		$sp = new ColoredSpinner();
    		break;
    	case "cspinner-focus":
    		$sp = new ColoredSpinnerFocus();
    		break;
    	case "cspinner-pressed":
    		$sp = new ColoredSpinnerPress();
    		break;
    	default:
    		$sp = new ColoredSpinner();
    		break;
  	}
    $sp->generate_image($color, $size, $holo, $kitkat);
  }

?>