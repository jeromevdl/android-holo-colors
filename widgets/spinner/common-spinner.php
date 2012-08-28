<?

  if (!isset($context))
    $context = "../../";

  require_once($context.'common.php');
  
  $spinner_classes = array('Spinner', 'SpinnerFocus', 'SpinnerPress');

  /********************************************/
  /*                 SPINNER AB               */
  /********************************************/
  class Spinner extends Component {
  	
  	function __construct($ctx="") {
  		parent:: __construct("spinner_default_holo_{{holo}}.9.png", $ctx);
  	}
  	
    function generate_image($color, $size, $holo) {			   
	  $image_name = "spinner_default_holo_".$holo.".9.png";
	
	  // load picture
	  $button_img = $this->loadTransparentPNG($image_name, $size);
	  
	  // output to browser
	  if (isset($_GET['action']) && $_GET['action'] == 'display') {
 			  $this->displayImage($button_img);
		  } else {
		  	 $this->generateImageFile($button_img, $size, $holo);
		  }
    }
  }
  
  /************************************************/
  /*            SPINNER AB FOCUS                 */
  /***********************************************/
  class SpinnerFocus extends Component {

  	function __construct($ctx="") {
  		parent:: __construct("spinner_focused_holo_{{holo}}.9.png", $ctx);
  	}
  	
    function generate_image($color, $size, $holo) {			   
	  $image_name = "spinner_focused_holo.png";
	
	  // load picture
	  $button_img = $this->loadTransparentPNG($image_name, $size);
	 
	  // update colors
	  $rgb = $this->hex2RGB($color);
	  imagefilter($button_img, IMG_FILTER_COLORIZE, $rgb['red'], $rgb['green'], $rgb['blue']);
	  
	  // add border
	  $border_img =  $this->loadTransparentPNG("spinner_default_holo_".$holo.".9.png", $size);
	  
	  $result = $this->create_dest_image($image_name, $size);
	  
	  imagecopy($result[0], $border_img, 0, 0, 0, 0, $result[1], $result[2]);  
	  imagecopy($result[0], $button_img, 0, 0, 0, 0, $result[1], $result[2]);
	  
	  // output to browser
	  if (isset($_GET['action']) && $_GET['action'] == 'display') {
 			  $this->displayImage($result[0]);
		  } else {
		  	 $this->generateImageFile($result[0], $size, $holo);
		  }
    }
  }


  /************************************************/
  /*             SPINNER AB PRESS                 */
  /***********************************************/
  class SpinnerPress extends Component {
  	
  	function __construct($ctx="") {
  		parent:: __construct("spinner_pressed_holo_{{holo}}.9.png", $ctx);
  	}
  	
    function generate_image($color, $size, $holo) {			   
	  $image_name = "spinner_pressed_holo.png";
	
	  // load picture
	  $button_img = $this->loadTransparentPNG($image_name, $size);
	 
	  // update colors
	  $rgb = $this->hex2RGB($color);
	  imagefilter($button_img, IMG_FILTER_COLORIZE, $rgb['red'], $rgb['green'], $rgb['blue']);
	  
	  // add ninepatch
	  $border_img =  $this->loadTransparentPNG("spinner_default_holo_".$holo.".9.png", $size);
	  
	  $result = $this->create_dest_image($image_name, $size);
	    
	  imagecopy($result[0], $border_img, 0, 0, 0, 0, $result[1], $result[2]);
	  imagecopy($result[0], $button_img, 0, 0, 0, 0, $result[1], $result[2]);
	  
	  // output to browser
	  if (isset($_GET['action']) && $_GET['action'] == 'display') {
 			  $this->displayImage($result[0]);
		  } else {
		  	 $this->generateImageFile($result[0], $size, $holo);
		  }
    }
  }

?>