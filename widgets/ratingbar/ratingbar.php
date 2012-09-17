<?

  require_once('common-ratingbar.php');
  
  $color = $_GET['color'];
  $size = $_GET['size'];
  $holo = $_GET['holo'];
  $component = $_GET['component'];
  
  if (isset($color) && isset($size) && isset($holo) && isset($component)) {
  	switch ($component) {
  		case "ratingbar":
		  	$sb = new RatingBarNormalOn();
		  	break;
		case "ratingbar-off":
			$sb = new RatingBarNormalOff();
		  	break;
		case "ratingbar-on-focus":
			$sb = new RatingBarFocusOn();
		  	break;
		case "ratingbar-on-pressed":
			$sb = new RatingBarPressOn();
		  	break;
		case "ratingbar-off-focus":
			$sb = new RatingBarFocusOff();
		  	break;
		case "ratingbar-off-pressed":
			$sb = new RatingBarPressOff();
		  	break;
		default:
			$sb = new RatingBarNormalOn();
		  	break;
  	}
  	
  	$sb->generate_image($color, $size, $holo);
  }
  

?>