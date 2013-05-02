<?

  require_once('common-numberpicker.php');
  
  $color = $_GET['color'];
  $size = $_GET['size'];
  $holo = $_GET['holo'];
  $component = $_GET['component'];
  
  if (isset($color) && isset($size) && isset($holo) && isset($component)) {
  	
  	switch ($component) {
	  	case "numberpicker":
	  	default:
	  		$toggle = new NbPickerDivider();
	  		break;
  	}	
  	
  	$toggle->generate_image($color, $size, $holo);
  }
  

?>