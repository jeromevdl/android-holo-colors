<?

  require_once('common-spinnerab.php');

  $color = $_GET['color'];
  $size = $_GET['size'];
  $holo = $_GET['holo'];
  $component = $_GET['component'];
  
  if (isset($color) && isset($size) && isset($holo) && isset($component)) {
  	switch ($component) {
		case "spinnerab":
    		$sp = new SpinnerAB();
    		break;
    	case "spinnerab-focus":
    		$sp = new SpinnerABFocus();
    		break;
    	case "spinnerab-pressed":
    		$sp = new SpinnerABPress();
    		break;
    	default:
    		$sp = new SpinnerAB();
    		break;
  	}
    $sp->generate_image($color, $size, $holo);
  }

?>