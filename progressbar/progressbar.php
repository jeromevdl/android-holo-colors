<?

  require_once('common-progressbar.php');

  $color = $_GET['color'];
  $size = $_GET['size'];
  $holo = $_GET['holo'];
  $component = $_GET['component'];
  
  if (isset($color) && isset($size) && isset($holo) && isset($component)) {
  	switch ($component) {
  		case "progressbar-secondary":
  			$pb = new ProgressBarPrimary();
  			break;
  		case "progressbar-primary":
  			$pb = new ProgressBarSecondary();
  			break;	
  		default:
  			$pb = new ProgressBarPrimary();
  			break;
  	}
  	
    $pb->generate_image($color, $size, $holo);
  }

?>