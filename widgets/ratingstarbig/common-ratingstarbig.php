<?
  if (!isset($context))
    $context = "../../";
  
  require_once($context.'common.php');
  
  $ratingbarbig_classes = array('RatingStarBig', 'RatingStarBigHalf');
  
  
  /********************************************/
  /*           RATINGBAR NORMAL             */
  /********************************************/
  class RatingStarBig extends Component {
  	
  	function __construct($ctx="") {
  		parent:: __construct("rate_star_big_on_holo_{{holo}}.png", $ctx);
  	}
  	
    function generate_image($color, $size, $holo) {			   
	  $image_name = "rate_star_big_on_holo.png";
	
	  // load picture
	  $ratingbar_img = $this->loadTransparentPNG($image_name, $size);
	 
	  // update colors
	  $rgb = $this->hex2RGB($color);
	  imagefilter($ratingbar_img, IMG_FILTER_COLORIZE, $rgb['red'], $rgb['green'], $rgb['blue']);
	  
	  // add border
	  $ratingbar_border =  $this->loadTransparentPNG("rate_star_big_on_holo_".$holo.".png", $size);
	  
	  $result = $this->create_dest_image($image_name, $size);
	    
	  imagecopy($result[0], $ratingbar_img, 0, 0, 0, 0, $result[1], $result[2]);
	  imagecopy($result[0], $ratingbar_border, 0, 0, 0, 0, $result[1], $result[2]);
	 
	  // output to browser
	  if (isset($_GET['action']) && $_GET['action'] == 'display') {
 			  $this->displayImage($result[0]);
		  } else {
		  	 $this->generateImageFile($result[0], $size, $holo);
		  }
    }
  }
  
  /********************************************/
  /*           RATINGBAR NORMAL HALF           */
  /********************************************/
  class RatingStarBigHalf extends Component {
  	
  	function __construct($ctx="") {
  		parent:: __construct("rate_star_big_half_holo_{{holo}}.png", $ctx);
  	}
  	
    function generate_image($color, $size, $holo) {			   
	  $image_name = "rate_star_big_half_holo.png";
	
	  // load picture
	  $ratingbar_img = $this->loadTransparentPNG($image_name, $size);
	 	 
	  // update colors
	  $rgb = $this->hex2RGB($color);
	  imagefilter($ratingbar_img, IMG_FILTER_COLORIZE, $rgb['red'], $rgb['green'], $rgb['blue']);
	  
	  // add border
	  $ratingbar_border =  $this->loadTransparentPNG("rate_star_big_half_holo_".$holo.".png", $size);
	  
	  $result = $this->create_dest_image($image_name, $size);
	    
	  imagecopy($result[0], $ratingbar_img, 0, 0, 0, 0, $result[1], $result[2]);
	  imagecopy($result[0], $ratingbar_border, 0, 0, 0, 0, $result[1], $result[2]);
	 
	  // output to browser
	  if (isset($_GET['action']) && $_GET['action'] == 'display') {
 			  $this->displayImage($result[0]);
		  } else {
		  	 $this->generateImageFile($result[0], $size, $holo);
		  }

    }
  }
 
  
?>