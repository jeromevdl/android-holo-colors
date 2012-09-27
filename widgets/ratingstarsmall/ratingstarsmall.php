<?

  require_once('common-ratingstarsmall.php');
  
  $color = $_GET['color'];
  $size = $_GET['size'];
  $holo = $_GET['holo'];
  $component = $_GET['component'];
  
  if (isset($color) && isset($size) && isset($holo) && isset($component)) {
  	switch ($component) {
  		case "ratingstarsmall":
		  	$sb = new RatingStarSmall();
		  	break;
		case "ratingstarsmall-half":
			$sb = new RatingStarSmallHalf();
		  	break;
		default:
			$sb = new RatingStarSmall();
		  	break;
  	}
  	
  	$sb->generate_image($color, $size, $holo);
  }
  

?>