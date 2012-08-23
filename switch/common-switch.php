<?

  if (!isset($context))
    $context = "../";

  require_once($context.'common.php');
  
  $switch_classes = array('SwitchThumbActivated', 'SwitchThumbPress', 'SwitchBackground');

  /******************************************/
  /*       SWITCH THUMB ACTIVATED          */
  /******************************************/
  class SwitchThumbActivated extends Component {
  	
  	function __construct($ctx="") {
  		parent:: __construct("switch_thumb_activated_holo_{{holo}}.9.png", $ctx);
  	}
  	
    function generate_image($color, $size, $holo) {			   
	  $image_name = "switch_thumb_activated_holo.png";
	
	  // load picture
	  $button_img = $this->loadTransparentPNG($image_name, $size);
	  
	  // update colors
	  $rgb = $this->hex2RGB($color);
	  imagefilter($button_img, IMG_FILTER_COLORIZE, $rgb['red'], $rgb['green'], $rgb['blue']);
	  
	  // shadow
	  $shadow_img = $this->loadTransparentPNG("switch_thumb_holo_".$holo."_shadow.png", $size);
	  
	  // add nine patch
	  $border_img =  $this->loadTransparentPNG("switch_thumb_nine_patch.png", $size);
	  
	  $result = $this->create_dest_image($image_name, $size);
	    
	  imagecopy($result[0], $button_img, 0, 0, 0, 0, $result[1], $result[2]);
	  imagecopy($result[0], $shadow_img, 0, 0, 0, 0, $result[1], $result[2]);
	  imagecopy($result[0], $border_img, 0, 0, 0, 0, $result[1], $result[2]);
	  
	  // output to browser
	  if (isset($_GET['action']) && $_GET['action'] == 'display') {
 			  $this->displayImage($result[0]);
		  } else {
		  	 $this->generateImageFile($result[0], $size, $holo);
		  }
    }
  }
  
  /******************************************/
  /*         SWITCH THUMB PRESS             */
  /******************************************/
  class SwitchThumbPress extends Component {
  	
  	function __construct($ctx="") {
  		parent:: __construct("switch_thumb_pressed_holo_{{holo}}.9.png", $ctx);
  	}
  	
    function generate_image($color, $size, $holo) {			   
	  $image_name = "switch_thumb_pressed_holo.png";
	
	  // load picture
	  $button_img = $this->loadTransparentPNG($image_name, $size);
	  
	  // update colors
	  $rgb = $this->hex2RGB($color);
	  imagefilter($button_img, IMG_FILTER_COLORIZE, $rgb['red'], $rgb['green'], $rgb['blue']);
	  
	  // shadow
	  $shadow_img = $this->loadTransparentPNG("switch_thumb_holo_".$holo."_shadow.png", $size);
	  
	  // add nine patch
	  $border_img =  $this->loadTransparentPNG("switch_thumb_nine_patch.png", $size);
	  
	  $result = $this->create_dest_image($image_name, $size);
	    
	  imagecopy($result[0], $button_img, 0, 0, 0, 0, $result[1], $result[2]);
	  imagecopy($result[0], $shadow_img, 0, 0, 0, 0, $result[1], $result[2]);
	  imagecopy($result[0], $border_img, 0, 0, 0, 0, $result[1], $result[2]);
	  
	  // output to browser
	  if (isset($_GET['action']) && $_GET['action'] == 'display') {
 			  $this->displayImage($result[0]);
		  } else {
		  	 $this->generateImageFile($result[0], $size, $holo);
		  }
    }
  }
  
  /******************************************/
  /*         SWITCH BACKGROUND              */
  /******************************************/
  class SwitchBackground extends Component {
  	
  	function __construct($ctx="") {
  		parent:: __construct("switch_bg_focused_holo_{{holo}}.9.png", $ctx);
  	}
  	
    function generate_image($color, $size, $holo) {			   
	  $image_name = "switch_bg_focused_holo.png";
	
	  // load picture
	  $button_img = $this->loadTransparentPNG($image_name, $size);
	  
	  // update colors
	  $rgb = $this->hex2RGB($color);
	  imagefilter($button_img, IMG_FILTER_COLORIZE, $rgb['red'], $rgb['green'], $rgb['blue']);
	  
	  // add back
	  $back_img =  $this->loadTransparentPNG("switch_bg_focused_holo_".$holo.".png", $size);
	  
	  $result = $this->create_dest_image($image_name, $size);
	    
	  imagecopy($result[0], $button_img, 0, 0, 0, 0, $result[1], $result[2]);
	  imagecopy($result[0], $back_img, 0, 0, 0, 0, $result[1], $result[2]);
	  
	  // output to browser
	  if (isset($_GET['action']) && $_GET['action'] == 'display') {
 			  $this->displayImage($result[0]);
		  } else {
		  	 $this->generateImageFile($result[0], $size, $holo);
		  }
    }
  }


?>