<?

  require_once('common-search.php');

  $color = $_GET['color'];
  $size = $_GET['size'];
  $holo = $_GET['holo'];
  $component = $_GET['component'];
  
  if (isset($color) && isset($size) && isset($holo) && isset($component)) {
  	switch ($component) {
  		case "search":
	  		$et = new Search();
	  		break;
	  	case "search-right":
	  		$et = new SearchRight();
	  		break;
	  	default:
	  		$et = new Search();
	  		break;
  	}	

    $et->generate_image($color, $size, $holo);
  }

?>