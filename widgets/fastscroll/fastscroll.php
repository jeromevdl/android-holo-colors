<?

  require_once('common-fastscroll.php');

  $color = $_GET['color'];
  $size = $_GET['size'];
  $holo = $_GET['holo'];
  $component = $_GET['component'];
  
  if (isset($color) && isset($size) && isset($holo) && isset($component)) {
  	switch ($component) {
  		case "fastscroll":
	  		$et = new Fastscroll();
	  		break;
	  	case "fastscroll-pressed":
	  		$et = new FastscrollPressed();
	  		break;
	  	default:
	  		$et = new Fastscroll();
	  		break;
  	}	

    $et->generate_image($color, $size, $holo);
  }

?>