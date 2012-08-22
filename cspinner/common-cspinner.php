<?

  if (!isset($context))
    $context = "../";

  require_once($context.'common.php');
  
  $cspinner_classes = array('ColoredSpinner', 'ColoredSpinnerFocus', 'ColoredSpinnerPress');

  /********************************************/
  /*                 SPINNER COLOR            */
  /********************************************/
  class ColoredSpinner extends Component {
  	
  	function __construct($ctx="") {
  		parent:: __construct("spinner_default_holo_{{holo}}.9.png", $ctx);
  	}
  	
    function generate_image($color, $size, $holo) {			   
	  $image_name = "spinner_default_holo.png";
	
	  // load picture
	  $button_img = $this->loadTransparentPNG($image_name, $size);
	  
	  // update colors
	  $rgb = $this->hex2RGB($color);
	  imagefilter($button_img, IMG_FILTER_COLORIZE, $rgb['red'], $rgb['green'], $rgb['blue']);
	  
	  // nine patch
	  $nine_patch = $this->loadTransparentPNG("spinner_nine_patch.png", $size);
	  
	  $result = $this->create_dest_image($image_name, $size);
	  
	  imagecopy($result[0], $button_img, 0, 0, 0, 0, $result[1], $result[2]);  
	  imagecopy($result[0], $nine_patch, 0, 0, 0, 0, $result[1], $result[2]);
	  
	  // output to browser
	  if (isset($_GET['action']) && $_GET['action'] == 'display') {
 			  $this->displayImage($result[0]);
		  } else {
		  	 $this->generateImageFile($result[0], $size, $holo);
		  }
    }
  }
    
  /************************************************/
  /*            SPINNER COLOR FOCUS              */
  /***********************************************/
  class ColoredSpinnerFocus extends Component {

  	function __construct($ctx="") {
  		parent:: __construct("spinner_focused_holo_{{holo}}.9.png", $ctx);
  	}
  	
    function generate_image($color, $size, $holo) {			   
	  $image_name = "spinner_default_holo.png";
	
	  // load picture
	  $button_img = $this->loadTransparentPNG($image_name, $size);
	 
	  // update colors
	  $rgb = $this->hex2RGB($color);
	  imagefilter($button_img, IMG_FILTER_COLORIZE, $rgb['red'], $rgb['green'], $rgb['blue']);
	  
	  // load picture
	  $back_img = $this->loadTransparentPNG("spinner_focused_holo.png", $size);
	 
	  // update colors
	  imagefilter($back_img, IMG_FILTER_COLORIZE, $rgb['red'], $rgb['green'], $rgb['blue']);
	  
	  // add nine patch
	  $border_img =  $this->loadTransparentPNG("spinner_nine_patch.png", $size);
	  
	  $result = $this->create_dest_image($image_name, $size);
	  
	  imagecopy($result[0], $button_img, 0, 0, 0, 0, $result[1], $result[2]);  
	  imagecopy($result[0], $back_img, 0, 0, 0, 0, $result[1], $result[2]);
  	  imagecopy($result[0], $border_img, 0, 0, 0, 0, $result[1], $result[2]);
	  
	  // output to browser
	  if (isset($_GET['action']) && $_GET['action'] == 'display') {
 			  $this->displayImage($result[0]);
		  } else {
		  	 $this->generateImageFile($result[0], $size, $holo);
		  }
    }
  }


  /************************************************/
  /*             SPINNER COLOR PRESS              */
  /***********************************************/
  class ColoredSpinnerPress extends Component {
  	
  	function __construct($ctx="") {
  		parent:: __construct("spinner_pressed_holo_{{holo}}.9.png", $ctx);
  	}
  	
    function generate_image($color, $size, $holo) {			   
	  $image_name = "spinner_default_holo.png";
	
	  // load picture
	  $button_img = $this->loadTransparentPNG($image_name, $size);
	 
	  // update colors
	  $rgb = $this->hex2RGB($color);
	  imagefilter($button_img, IMG_FILTER_COLORIZE, $rgb['red'], $rgb['green'], $rgb['blue']);
	  
	  // load picture
	  $back_img = $this->loadTransparentPNG("spinner_pressed_holo.png", $size);
	 
	  // update colors
	  imagefilter($back_img, IMG_FILTER_COLORIZE, $rgb['red'], $rgb['green'], $rgb['blue']);
	  
	  // add nine patch
	  $border_img =  $this->loadTransparentPNG("spinner_nine_patch.png", $size);
	  
	  $result = $this->create_dest_image($image_name, $size);
	  
	  imagecopy($result[0], $button_img, 0, 0, 0, 0, $result[1], $result[2]);  
	  imagecopy($result[0], $back_img, 0, 0, 0, 0, $result[1], $result[2]);
  	  imagecopy($result[0], $border_img, 0, 0, 0, 0, $result[1], $result[2]);
	  
	  // output to browser
	  if (isset($_GET['action']) && $_GET['action'] == 'display') {
 			  $this->displayImage($result[0]);
		  } else {
		  	 $this->generateImageFile($result[0], $size, $holo);
		  }
    }
  }

?>