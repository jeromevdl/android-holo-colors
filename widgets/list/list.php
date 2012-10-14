<?

  require_once('common-list.php');

  $color = $_GET['color'];
  $size = $_GET['size'];
  $holo = $_GET['holo'];
  $component = $_GET['component'];
  
  if (isset($color) && isset($size) && isset($holo) && isset($component)) {
  	switch ($component) {
  		case "list":
	  		$list = new ListPress();
	  		break;
	  	case "list-longpress":
	  		$list = new ListLongPress();
	  		break;
	  	case "list-focus":
	  		$list = new ListFocus();
	  		break;
	  	case "list-activated":
	  		$list = new ListActivated();
	  		break;
	  	default:
	  		$list = new ListPress();
	  		break;
  	}	

    $list->generate_image($color, $size, $holo);
  }

?>