<?

  require_once('common-checkbox.php');
  
  $color = $_GET['color'];
  $size = $_GET['size'];
  $holo = $_GET['holo'];
  $kitkat = (bool) $_GET['kitkat'];
  $component = $_GET['component'];
  
  if (isset($color) && isset($size) && isset($holo) && isset($component) && isset($kitkat)) {
  	switch ($component) {
  		case "checkbox":
	  		$cb = new Checkbox();
	  		break;
	  	case "checkbox-off":
	  		$cb = new CheckboxOff();
	  		break;
	  	case "checkbox-off-pressed":
	  		$cb = new CheckboxOffPress();
	  		break;
	  	case "checkbox-on-pressed":
	  		$cb = new CheckboxOnPress();
	  		break;
	  	case "checkbox-off-focus":
	  		$cb = new CheckboxOffFocus();
	  		break;
	  	case "checkbox-on-focus":
	  		$cb = new CheckboxOnFocus();
	  		break;
	  	case "checkbox-on-disabled-focus":
	  		$cb = new CheckboxDisabledOnFocus();
	  		break;
	  	case "checkbox-off-disabled-focus":
	  		$cb = new CheckboxDisabledOffFocus();
	  		break;
	  	default:
	  		$cb = new Checkbox();
	  		break;
  	}	
  	$cb->generate_image($color, $size, $holo, $kitkat);
  }
  

?>