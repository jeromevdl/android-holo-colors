<?

  require_once('common-radio.php');
  $color = $_GET['color'];
  $size = $_GET['size'];
  $holo = $_GET['holo'];
  $kitkat = (bool) $_GET['kitkat'];
  $component = $_GET['component'];
  
  if (isset($color) && isset($size) && isset($holo) && isset($component) && isset($kitkat)) {
  	switch ($component) {
  		case "radio":
		  	$radio = new Radio();
		  	break;
		case "radio-on-focus":
			$radio = new RadioOnFocus();
		  	break;
		case "radio-on-pressed":
			$radio = new RadioOnPress();
		  	break;
		case "radio-on-disabled-focus":
			$radio = new RadioDisabledOnFocus();
		  	break;
		case "radio-off":
			$radio = new RadioOff();
		  	break;
		case "radio-off-pressed":
			$radio = new RadioOffPress();
		  	break;
		case "radio-off-focus":
			$radio = new RadioOffFocus();
		  	break;
		case "radio-off-disabled-focus":
			$radio = new RadioDisabledOffFocus();
		  	break;
		default:
			$radio = new Radio();
		  	break;
  	}
  	$radio->generate_image($color, $size, $holo, $kitkat);
  }

?>