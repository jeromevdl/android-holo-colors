<?

  require_once('common-ratingstarbig.php');
  
  $color = $_GET['color'];
  $size = $_GET['size'];
  $holo = $_GET['holo'];
  $component = $_GET['component'];
  
  if (isset($color) && isset($size) && isset($holo) && isset($component)) {
  	switch ($component) {
  		case "ratingstarbig":
		  	$sb = new RatingStarBig();
		  	break;
		case "ratingstarbig-half":
			$sb = new RatingStarBigHalf();
		  	break;
		default:
			$sb = new RatingStarBig();
		  	break;
  	}
  	
  	$sb->generate_image($color, $size, $holo);
  }
  

?>