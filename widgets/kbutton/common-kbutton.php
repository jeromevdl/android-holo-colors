<?

  if (!isset($context))
    $context = "../../";

  require_once($context.'common.php');
  
  $button_classes = array('KButton', 'KButtonFocus', 'KButtonPress', 'KButtonDisabledFocus');

  /********************************************/
  /*                 BUTTON                 */
  /********************************************/
  class KButton extends Component {
  	
  	function __construct($ctx="") {
  		parent:: __construct("btn_default_normal_holo_{{holo}}.9.png", $ctx);
  	}
  	
    function generate_image($color, $size, $holo) {			   
	  $image_name = "btn_default_normal_holo.png";
	
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
  /*                 BUTTON FOCUS                 */
  /***********************************************/
  class KButtonFocus extends Component {
  	
  	function __construct($ctx="") {
  		parent:: __construct("btn_default_focused_holo_{{holo}}.9.png", $ctx);
  	}
  	
    function generate_image($color, $size, $holo) {			   
	  $image_name = "btn_default_focused_holo.png";
	
	  // load picture
	  $button_img = $this->loadTransparentPNG($image_name, $size);
	 
	  // update colors
	  $rgb = $this->hex2RGB($color);
	  imagefilter($button_img, IMG_FILTER_COLORIZE, $rgb['red'], $rgb['green'], $rgb['blue']);
	  
	  // add nine patch
	  $nine_patch_img =  $this->loadTransparentPNG("nine_patch.png", $size);
	  
	  // add border
	  $border_img =  $this->loadTransparentPNG("btn_border_shadow.png", $size);
	  
	  $result = $this->create_dest_image($image_name, $size);
	    
	  imagecopy($result[0], $button_img, 0, 0, 0, 0, $result[1], $result[2]);
	  imagecopy($result[0], $nine_patch_img, 0, 0, 0, 0, $result[1], $result[2]);
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
  /*         BUTTON DISABLED FOCUS               */
  /***********************************************/
  class KButtonDisabledFocus extends Component {
  	
  	function __construct($ctx="") {
  		parent:: __construct("btn_default_disabled_focused_holo_{{holo}}.9.png", $ctx);
  	}
  	
    function generate_image($color, $size, $holo) {			   
	  $image_name = "btn_default_disabled_focused_holo.png";
	
	  // load picture
	  $button_img = $this->loadTransparentPNG($image_name, $size);
	 
	  // update colors
	  $rgb = $this->hex2RGB($color);
	  imagefilter($button_img, IMG_FILTER_COLORIZE, $rgb['red'], $rgb['green'], $rgb['blue']);
	  
	  // add ninepatch
	  $nine_img =  $this->loadTransparentPNG("nine_patch.png", $size);
	
	  $result = $this->create_dest_image($image_name, $size);
	    
	  imagecopy($result[0], $button_img, 0, 0, 0, 0, $result[1], $result[2]);
	  imagecopy($result[0], $nine_img, 0, 0, 0, 0, $result[1], $result[2]);
	  
	  // output to browser
	  if (isset($_GET['action']) && $_GET['action'] == 'display') {
 			  $this->displayImage($result[0]);
		  } else {
		  	 $this->generateImageFile($result[0], $size, $holo);
		  }
    }
  }


  /************************************************/
  /*                 BUTTON PRESS                 */
  /***********************************************/
  class KButtonPress extends Component {
  	
  	function __construct($ctx="") {
  		parent:: __construct("btn_default_pressed_holo_{{holo}}.9.png", $ctx);
  	}
  	
    function generate_image($color, $size, $holo) {			   
	  $image_name = "btn_default_pressed_holo_".$holo.".png";
	
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

?>