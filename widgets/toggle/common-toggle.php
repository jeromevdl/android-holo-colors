<?

  if (!isset($context))
    $context = "../../";

  require_once($context.'common.php');
  
  $toggle_classes = array('Toggle', 'ToggleOnPress', 'ToggleOffPress', 'ToggleOnFocus', 'ToggleOffFocus', 'ToggleOnDisabled', 'ToggleOnDisabledFocus', 'ToggleOffDisabledFocus');

  /******************************************/
  /*                 TOGGLE                 */
  /******************************************/
  class Toggle extends Component {
  	
  	function __construct($ctx="") {
  		parent:: __construct("btn_toggle_on_normal_holo_{{holo}}.9.png", $ctx);
  	}
  	
    function generate_image($color, $size, $holo) {			   
	  $image_name = "btn_toggle_on_normal_holo.png";
	
	  // load picture
	  $button_img = $this->loadTransparentPNG($image_name, $size);
	  
	  // color picture
	  $color_img = $this->loadTransparentPNG("btn_toggle_on_normal_holo_color.png", $size);
	  
	  // update colors
	  $rgb = $this->hex2RGB($color);
	  imagefilter($color_img, IMG_FILTER_COLORIZE, $rgb['red'], $rgb['green'], $rgb['blue']);
	  
	  // add nine patch
	  $border_img =  $this->loadTransparentPNG("btn_toggle_nine_patch.png", $size);
	  
	  $result = $this->create_dest_image($image_name, $size);
	    
	  imagecopy($result[0], $button_img, 0, 0, 0, 0, $result[1], $result[2]);
	  imagecopy($result[0], $color_img, 0, 0, 0, 0, $result[1], $result[2]);
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
  /*         TOGGLE ON FOCUS                */
  /******************************************/
  class ToggleOnFocus extends Component {
  	
  	function __construct($ctx="") {
  		parent:: __construct("btn_toggle_on_focused_holo_{{holo}}.9.png", $ctx);
  	}
  	
    function generate_image($color, $size, $holo) {			   
	  $image_name = "btn_toggle_on_focused_holo.png";
	
	  // load picture
	  $button_img = $this->loadTransparentPNG($image_name, $size);
	  	  
	  // update colors
	  $rgb = $this->hex2RGB($color);
	  imagefilter($button_img, IMG_FILTER_COLORIZE, $rgb['red'], $rgb['green'], $rgb['blue']);
	  
	  // add nine patch
	  $border_img =  $this->loadTransparentPNG("btn_toggle_nine_patch.png", $size);
	  
	  // add shadow
	  $shadow_img =  $this->loadTransparentPNG("btn_toggle_shadow_dark.png", $size);
	  
	  $result = $this->create_dest_image($image_name, $size);
	    
	  imagecopy($result[0], $button_img, 0, 0, 0, 0, $result[1], $result[2]);
	  imagecopy($result[0], $border_img, 0, 0, 0, 0, $result[1], $result[2]);
	  imagecopy($result[0], $shadow_img, 0, 0, 0, 0, $result[1], $result[2]);
	  
	  // output to browser
	  if (isset($_GET['action']) && $_GET['action'] == 'display') {
 			  $this->displayImage($result[0]);
		  } else {
		  	 $this->generateImageFile($result[0], $size, $holo);
		  }
    }
  }
  
  /************************************************/
  /*              TOGGLE ON PRESS                 */
  /***********************************************/
  class ToggleOnPress extends Component {
  	
  	function __construct($ctx="") {
  		parent:: __construct("btn_toggle_on_pressed_holo_{{holo}}.9.png", $ctx);
  	}
  	
    function generate_image($color, $size, $holo) {			   
	  $image_name = "btn_toggle_on_pressed_holo.png";
	
	  // load picture
	  $button_img = $this->loadTransparentPNG($image_name, $size);
	 
	  // update colors
	  $rgb = $this->hex2RGB($color);
	  imagefilter($button_img, IMG_FILTER_COLORIZE, $rgb['red'], $rgb['green'], $rgb['blue']);
	  
	  // add ninepatch
	  $nine_patch_img =  $this->loadTransparentPNG("btn_toggle_nine_patch.png", $size);

	  // add shadow
	  $border_img =  $this->loadTransparentPNG("btn_border_shadow.png", $size);
	  
	  $result = $this->create_dest_image($image_name, $size);
	    
	  imagecopy($result[0], $button_img, 0, 0, 0, 0, $result[1], $result[2]);
	  imagecopy($result[0], $border_img, 0, 0, 0, 0, $result[1], $result[2]);
	  imagecopy($result[0], $nine_patch_img, 0, 0, 0, 0, $result[1], $result[2]);
	  
	  // output to browser
	  if (isset($_GET['action']) && $_GET['action'] == 'display') {
 			  $this->displayImage($result[0]);
		  } else {
		  	 $this->generateImageFile($result[0], $size, $holo);
		  }
    }
  }
  
  /******************************************/
  /*         TOGGLE OFF FOCUS                */
  /******************************************/
  class ToggleOffFocus extends Component {
  	
  	function __construct($ctx="") {
  		parent:: __construct("btn_toggle_off_focused_holo_{{holo}}.9.png", $ctx);
  	}
  	
    function generate_image($color, $size, $holo) {			   
	  $image_name = "btn_toggle_off_focused_holo.png";
	
	  // load picture
	  $button_img = $this->loadTransparentPNG($image_name, $size);
	  	  
	  // update colors
	  $rgb = $this->hex2RGB($color);
	  imagefilter($button_img, IMG_FILTER_COLORIZE, $rgb['red'], $rgb['green'], $rgb['blue']);
	  
	  // add nine patch
	  $border_img =  $this->loadTransparentPNG("btn_toggle_nine_patch.png", $size);
	  
	  // add shadow
	  $shadow_img =  $this->loadTransparentPNG("btn_toggle_shadow_dark.png", $size);
		  
	  // add toggle
	  $toggle_img =  $this->loadTransparentPNG("btn_toggle_on_normal_holo_color.png", $size);
	  
	  
	  $result = $this->create_dest_image($image_name, $size);
	    
	  imagecopy($result[0], $toggle_img, 0, 0, 0, 0, $result[1], $result[2]);
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
  
  /************************************************/
  /*              TOGGLE ON PRESS                 */
  /***********************************************/
  class ToggleOffPress extends Component {
  	
  	function __construct($ctx="") {
  		parent:: __construct("btn_toggle_off_pressed_holo_{{holo}}.9.png", $ctx);
  	}
  	
    function generate_image($color, $size, $holo) {			   
	  $image_name = "btn_toggle_off_pressed_holo.png";
	
	  // load picture
	  $button_img = $this->loadTransparentPNG($image_name, $size);
	 
	  // update colors
	  $rgb = $this->hex2RGB($color);
	  imagefilter($button_img, IMG_FILTER_COLORIZE, $rgb['red'], $rgb['green'], $rgb['blue']);
	  
	  // add ninepatch
	  $nine_patch_img =  $this->loadTransparentPNG("btn_toggle_nine_patch.png", $size);

	  // add shadow
	  $border_img =  $this->loadTransparentPNG("btn_border_shadow.png", $size);
	  
	  // add toggle
	  $toggle_img =  $this->loadTransparentPNG("btn_toggle_on_normal_holo_color.png", $size);
	  
	  $result = $this->create_dest_image($image_name, $size);
	   
	  imagecopy($result[0], $button_img, 0, 0, 0, 0, $result[1], $result[2]);
	  imagecopy($result[0], $border_img, 0, 0, 0, 0, $result[1], $result[2]);
	  imagecopy($result[0], $toggle_img, 0, 0, 0, 0, $result[1], $result[2]);
	  imagecopy($result[0], $nine_patch_img, 0, 0, 0, 0, $result[1], $result[2]);
	  
	  // output to browser
	  if (isset($_GET['action']) && $_GET['action'] == 'display') {
 			  $this->displayImage($result[0]);
		  } else {
		  	 $this->generateImageFile($result[0], $size, $holo);
		  }
    }
  }
  
  /******************************************/
  /*         TOGGLE DISABLED                */
  /******************************************/
  class ToggleOnDisabled extends Component {
  	
  	function __construct($ctx="") {
  		parent:: __construct("btn_toggle_on_disabled_holo_{{holo}}.9.png", $ctx);
  	}
  	
    function generate_image($color, $size, $holo) {			   
	  $image_name = "btn_toggle_on_disabled_holo.png";
	
	  // load picture
	  $button_img = $this->loadTransparentPNG($image_name, $size);
	  
	  // color picture
	  $color_img = $this->loadTransparentPNG("btn_toggle_on_disabled_holo_color.png", $size);
	  
	  // update colors
	  $rgb = $this->hex2RGB($color);
	  imagefilter($color_img, IMG_FILTER_COLORIZE, $rgb['red'], $rgb['green'], $rgb['blue']);
	  
	  // add nine patch
	  $border_img =  $this->loadTransparentPNG("btn_toggle_nine_patch.png", $size);
	  
	  // add shadow
	  $shadow_img =  $this->loadTransparentPNG("btn_toggle_shadow_light.png", $size);
	  
	  $result = $this->create_dest_image($image_name, $size);
	    
	  imagecopy($result[0], $button_img, 0, 0, 0, 0, $result[1], $result[2]);
	  imagecopy($result[0], $color_img, 0, 0, 0, 0, $result[1], $result[2]);
	  imagecopy($result[0], $border_img, 0, 0, 0, 0, $result[1], $result[2]);
	  imagecopy($result[0], $shadow_img, 0, 0, 0, 0, $result[1], $result[2]);
	  
	  // output to browser
	  if (isset($_GET['action']) && $_GET['action'] == 'display') {
 			  $this->displayImage($result[0]);
		  } else {
		  	 $this->generateImageFile($result[0], $size, $holo);
		  }
    }
  }
  
  /******************************************/
  /*         TOGGLE DISABLED FOCUS          */
  /******************************************/
  class ToggleOnDisabledFocus extends Component {
  	
  	function __construct($ctx="") {
  		parent:: __construct("btn_toggle_on_disabled_focused_holo_{{holo}}.9.png", $ctx);
  	}
  	
    function generate_image($color, $size, $holo) {			   
	  $image_name = "btn_toggle_on_disabled_focused_holo.png";
	
	  // load picture
	  $button_img = $this->loadTransparentPNG($image_name, $size);
	   
	  // update colors
	  $rgb = $this->hex2RGB($color);
	  imagefilter($button_img, IMG_FILTER_COLORIZE, $rgb['red'], $rgb['green'], $rgb['blue']);
	  
	  // add nine patch
	  $border_img =  $this->loadTransparentPNG("btn_toggle_nine_patch.png", $size);
	  
	  // add shadow
	  $shadow_img =  $this->loadTransparentPNG("btn_toggle_shadow_light.png", $size);
	  
	  $result = $this->create_dest_image($image_name, $size);
	    
	  imagecopy($result[0], $button_img, 0, 0, 0, 0, $result[1], $result[2]);
	  imagecopy($result[0], $border_img, 0, 0, 0, 0, $result[1], $result[2]);
	  imagecopy($result[0], $shadow_img, 0, 0, 0, 0, $result[1], $result[2]);
	  
	  // output to browser
	  if (isset($_GET['action']) && $_GET['action'] == 'display') {
 			  $this->displayImage($result[0]);
		  } else {
		  	 $this->generateImageFile($result[0], $size, $holo);
		  }
    }
  }
  
  /******************************************/
  /*         TOGGLE OFF DISABLED FOCUS      */
  /******************************************/
  class ToggleOffDisabledFocus extends Component {
  	
  	function __construct($ctx="") {
  		parent:: __construct("btn_toggle_off_disabled_focused_holo_{{holo}}.9.png", $ctx);
  	}
  	
    function generate_image($color, $size, $holo) {			   
	  $image_name = "btn_toggle_off_disabled_focused_holo.png";
	
	  // load picture
	  $button_img = $this->loadTransparentPNG($image_name, $size);
	  	  
	  // update colors
	  $rgb = $this->hex2RGB($color);
	  imagefilter($button_img, IMG_FILTER_COLORIZE, $rgb['red'], $rgb['green'], $rgb['blue']);
	  
	  // add nine patch
	  $border_img =  $this->loadTransparentPNG("btn_toggle_nine_patch.png", $size);
	  
	  // add shadow
	  $shadow_img =  $this->loadTransparentPNG("btn_toggle_shadow_light.png", $size);
		  
	  // add toggle
	  $toggle_img =  $this->loadTransparentPNG("btn_toggle_on_disabled_holo_color.png", $size);
	  
	  
	  $result = $this->create_dest_image($image_name, $size);
	    
	  imagecopy($result[0], $toggle_img, 0, 0, 0, 0, $result[1], $result[2]);
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

?>