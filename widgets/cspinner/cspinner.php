<?

  require_once('common-cspinner.php');

  $color = $_GET['color'];
  $size = $_GET['size'];
  $holo = $_GET['holo'];
  $component = $_GET['component'];
  
  if (isset($color) && isset($size) && isset($holo) && isset($component)) {
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
    $sp->generate_image($color, $size, $holo);
  }

?>