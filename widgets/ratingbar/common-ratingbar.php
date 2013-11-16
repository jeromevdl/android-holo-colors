<?
  if (!isset($context))
    $context = "../../";
  
  require_once($context.'common.php');
  
  $ratingbar_classes = array('RatingBarNormalOn', 'RatingBarNormalOff', 'RatingBarFocusOn', 'RatingBarFocusOff', 'RatingBarPressOn', 'RatingBarPressOff');
  
  
  /********************************************/
  /*           RATINGBAR NORMAL ON            */
  /********************************************/
  class RatingBarNormalOn extends Component {
  	
  	function __construct($ctx="") {
  		parent:: __construct("btn_rating_star_on_normal_holo_{{holo}}.png", $ctx);
  	}
  	
    function generate_image($color, $size, $holo, $kitkat) {			   
	  $image_name = "btn_rating_star_on_normal_holo.png";
	
	  // load picture
	  $ratingbar_img = $this->loadTransparentPNG($image_name, $size);
	 
	  // update colors
	  $rgb = $this->hex2RGB($color);
	  imagefilter($ratingbar_img, IMG_FILTER_COLORIZE, $rgb['red'], $rgb['green'], $rgb['blue']);
	  
	  // add border
	  $ratingbar_border =  $this->loadTransparentPNG("btn_rating_star_on_normal_holo_".$holo.".png", $size);
	  
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
  /*           RATINGBAR NORMAL OFF           */
  /********************************************/
  class RatingBarNormalOff extends Component {
  	
  	function __construct($ctx="") {
  		parent:: __construct("btn_rating_star_off_normal_holo_{{holo}}.png", $ctx);
  	}
  	
    function generate_image($color, $size, $holo, $kitkat) {			   
	  $image_name = "btn_rating_star_off_normal_holo_".$holo.".png";
	
	  // load picture
	  $ratingbar_img = $this->loadTransparentPNG($image_name, $size);
	 	 
	  // output to browser
	  if (isset($_GET['action']) && $_GET['action'] == 'display') {
 			  $this->displayImage($ratingbar_img);
		  } else {
		  	 $this->generateImageFile($ratingbar_img, $size, $holo);
		  }
    }
  }
  
  /********************************************/
  /*           RATINGBAR FOCUS ON            */
  /********************************************/
  class RatingBarFocusOn extends Component {
  	
  	function __construct($ctx="") {
  		parent:: __construct("btn_rating_star_on_focused_holo_{{holo}}.png", $ctx);
  	}
  	
    function generate_image($color, $size, $holo, $kitkat) {			   
	  $image_name = "btn_rating_star_on_normal_holo.png";
	
	  // load picture
	  $ratingbar_img = $this->loadTransparentPNG($image_name, $size);
	 
	  // update colors
	  $rgb = $this->hex2RGB($color);
	  imagefilter($ratingbar_img, IMG_FILTER_COLORIZE, $rgb['red'], $rgb['green'], $rgb['blue']);
	  
	  // add border
	  $ratingbar_border =  $this->loadTransparentPNG("btn_rating_star_on_normal_holo_".$holo.".png", $size);
	  
	  // add focus
	  $ratingbar_focus =  $this->loadTransparentPNG("btn_rating_star_focused_holo.png", $size);
	  
	  // update colors
	  imagefilter($ratingbar_focus, IMG_FILTER_COLORIZE, $rgb['red'], $rgb['green'], $rgb['blue']);
	  
	  $result = $this->create_dest_image($image_name, $size);
	    
	  imagecopy($result[0], $ratingbar_img, 0, 0, 0, 0, $result[1], $result[2]);
	  imagecopy($result[0], $ratingbar_border, 0, 0, 0, 0, $result[1], $result[2]);
	  imagecopy($result[0], $ratingbar_focus	, 0, 0, 0, 0, $result[1], $result[2]);
	 
	  // output to browser
	  if (isset($_GET['action']) && $_GET['action'] == 'display') {
 			  $this->displayImage($result[0]);
		  } else {
		  	 $this->generateImageFile($result[0], $size, $holo);
		  }
    }
  }

/********************************************/
  /*           RATINGBAR FOCUS OFF            */
  /********************************************/
  class RatingBarFocusOff extends Component {
  	
  	function __construct($ctx="") {
  		parent:: __construct("btn_rating_star_off_focused_holo_{{holo}}.png", $ctx);
  	}
  	
    function generate_image($color, $size, $holo, $kitkat) {			   
	  $image_name = "btn_rating_star_off_normal_holo_".$holo.".png";
	
	  // load picture
	  $ratingbar_img = $this->loadTransparentPNG($image_name, $size);
	   
	  // add focus
	  $ratingbar_focus =  $this->loadTransparentPNG("btn_rating_star_focused_holo.png", $size);
	  
	  // update colors
	  $rgb = $this->hex2RGB($color);
	  imagefilter($ratingbar_focus, IMG_FILTER_COLORIZE, $rgb['red'], $rgb['green'], $rgb['blue']);
	  
	  $result = $this->create_dest_image($image_name, $size);
	    
	  imagecopy($result[0], $ratingbar_img, 0, 0, 0, 0, $result[1], $result[2]);
	  imagecopy($result[0], $ratingbar_focus	, 0, 0, 0, 0, $result[1], $result[2]);
	 
	  // output to browser
	  if (isset($_GET['action']) && $_GET['action'] == 'display') {
 			  $this->displayImage($result[0]);
		  } else {
		  	 $this->generateImageFile($result[0], $size, $holo);
		  }
    }
  }
  
  /********************************************/
  /*           RATINGBAR PRESSED ON            */
  /********************************************/
  class RatingBarPressOn extends Component {
  	
  	function __construct($ctx="") {
  		parent:: __construct("btn_rating_star_on_pressed_holo_{{holo}}.png", $ctx);
  	}
  	
    function generate_image($color, $size, $holo, $kitkat) {			   
	  $image_name = "btn_rating_star_on_normal_holo.png";
	
	  // load picture
	  $ratingbar_img = $this->loadTransparentPNG($image_name, $size);
	 
	  // update colors
	  $rgb = $this->hex2RGB($color);
	  imagefilter($ratingbar_img, IMG_FILTER_COLORIZE, $rgb['red'], $rgb['green'], $rgb['blue']);
	  
	  // add border
	  $ratingbar_border =  $this->loadTransparentPNG("btn_rating_star_on_normal_holo_".$holo.".png", $size);
	  
	  // add pressed
	  $ratingbar_focus =  $this->loadTransparentPNG("btn_rating_star_pressed_holo.png", $size);
	  
	  // update colors
	  imagefilter($ratingbar_focus, IMG_FILTER_COLORIZE, $rgb['red'], $rgb['green'], $rgb['blue']);
	  
	  $result = $this->create_dest_image($image_name, $size);
	    
	  imagecopy($result[0], $ratingbar_img, 0, 0, 0, 0, $result[1], $result[2]);
	  imagecopy($result[0], $ratingbar_border, 0, 0, 0, 0, $result[1], $result[2]);
	  imagecopy($result[0], $ratingbar_focus	, 0, 0, 0, 0, $result[1], $result[2]);
	 
	  // output to browser
	  if (isset($_GET['action']) && $_GET['action'] == 'display') {
 			  $this->displayImage($result[0]);
		  } else {
		  	 $this->generateImageFile($result[0], $size, $holo);
		  }
    }
  }

/********************************************/
  /*           RATINGBAR PRESS OFF            */
  /********************************************/
  class RatingBarPressOff extends Component {
  	
  	function __construct($ctx="") {
  		parent:: __construct("btn_rating_star_off_pressed_holo_{{holo}}.png", $ctx);
  	}
  	
    function generate_image($color, $size, $holo, $kitkat) {			   
	  $image_name = "btn_rating_star_off_normal_holo_".$holo.".png";
	
	  // load picture
	  $ratingbar_img = $this->loadTransparentPNG($image_name, $size);
	   
	  // add pressed
	  $ratingbar_focus =  $this->loadTransparentPNG("btn_rating_star_pressed_holo.png", $size);
	  
	  // update colors
	  $rgb = $this->hex2RGB($color);
	  imagefilter($ratingbar_focus, IMG_FILTER_COLORIZE, $rgb['red'], $rgb['green'], $rgb['blue']);
	  
	  $result = $this->create_dest_image($image_name, $size);
	    
	  imagecopy($result[0], $ratingbar_img, 0, 0, 0, 0, $result[1], $result[2]);
	  imagecopy($result[0], $ratingbar_focus	, 0, 0, 0, 0, $result[1], $result[2]);
	 
	  // output to browser
	  if (isset($_GET['action']) && $_GET['action'] == 'display') {
 			  $this->displayImage($result[0]);
		  } else {
		  	 $this->generateImageFile($result[0], $size, $holo);
		  }
    }
  }
  
?>