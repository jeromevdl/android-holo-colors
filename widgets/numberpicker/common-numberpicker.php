<?

  if (!isset($context))
    $context = "../../";

  require_once($context.'common.php');
  
  $numberpicker_classes = array('NbPickerDownPress', 'NbPickerUpPress', 'NbPickerDownLongPress', 'NbPickerUpLongPress', 'NbPickerDownFocus', 'NbPickerUpFocus', 'NbPickerDownDisabledFocus', 'NbPickerUpDisabledFocus', 'NbPickerDivider');

  /******************************************/
  /*                 PRESS                  */
  /******************************************/
  class NbPickerDownPress extends Component {
  	
  	function __construct($ctx="") {
  		parent:: __construct("numberpicker_down_pressed_holo_{{holo}}.png", $ctx);
  	}
  	
    function generate_image($color, $size, $holo) {			   
	  $image_name = "numberpicker_down_pressed_holo.png";
	
	  // load picture
	  $button_img = $this->loadTransparentPNG($image_name, $size);
	  
	  // update colors
	  $rgb = $this->hex2RGB($color);
	  imagefilter($button_img, IMG_FILTER_COLORIZE, $rgb['red'], $rgb['green'], $rgb['blue']);
	  	  
	  // output to browser
	  if (isset($_GET['action']) && $_GET['action'] == 'display') {
 			  $this->displayImage($button_img);
		  } else {
		  	 $this->generateImageFile($button_img, $size, $holo);
		  }
    }
  }
  
  class NbPickerUpPress extends Component {
  	
  	function __construct($ctx="") {
  		parent:: __construct("numberpicker_up_pressed_holo_{{holo}}.png", $ctx);
  	}
  	
    function generate_image($color, $size, $holo) {			   
	  $image_name = "numberpicker_up_pressed_holo.png";
	
	  // load picture
	  $button_img = $this->loadTransparentPNG($image_name, $size);
	  
	  // update colors
	  $rgb = $this->hex2RGB($color);
	  imagefilter($button_img, IMG_FILTER_COLORIZE, $rgb['red'], $rgb['green'], $rgb['blue']);
	  	  
	  // output to browser
	  if (isset($_GET['action']) && $_GET['action'] == 'display') {
 			  $this->displayImage($button_img);
		  } else {
		  	 $this->generateImageFile($button_img, $size, $holo);
		  }
    }
  }

  /******************************************/
  /*                 LONG PRESS             */
  /******************************************/
  class NbPickerDownLongPress extends Component {
  	
  	function __construct($ctx="") {
  		parent:: __construct("numberpicker_down_longpressed_holo_{{holo}}.png", $ctx);
  	}
  	
    function generate_image($color, $size, $holo) {			   
	  $image_name = "numberpicker_down_longpressed_holo.png";
	
	  // load picture
	  $button_img = $this->loadTransparentPNG($image_name, $size);
	  
	  // update colors
	  $rgb = $this->hex2RGB($color);
	  imagefilter($button_img, IMG_FILTER_COLORIZE, $rgb['red'], $rgb['green'], $rgb['blue']);
	  	  
	  // output to browser
	  if (isset($_GET['action']) && $_GET['action'] == 'display') {
 			  $this->displayImage($button_img);
		  } else {
		  	 $this->generateImageFile($button_img, $size, $holo);
		  }
    }
  }
  
  class NbPickerUpLongPress extends Component {
  	
  	function __construct($ctx="") {
  		parent:: __construct("numberpicker_up_longpressed_holo_{{holo}}.png", $ctx);
  	}
  	
    function generate_image($color, $size, $holo) {			   
	  $image_name = "numberpicker_up_longpressed_holo.png";
	
	  // load picture
	  $button_img = $this->loadTransparentPNG($image_name, $size);
	  
	  // update colors
	  $rgb = $this->hex2RGB($color);
	  imagefilter($button_img, IMG_FILTER_COLORIZE, $rgb['red'], $rgb['green'], $rgb['blue']);
	  	  
	  // output to browser
	  if (isset($_GET['action']) && $_GET['action'] == 'display') {
 			  $this->displayImage($button_img);
		  } else {
		  	 $this->generateImageFile($button_img, $size, $holo);
		  }
    }
  }
  
  /******************************************/
  /*                   FOCUS                */
  /******************************************/
  class NbPickerDownFocus extends Component {
  	
  	function __construct($ctx="") {
  		parent:: __construct("numberpicker_down_focused_holo_{{holo}}.png", $ctx);
  	}
  	
    function generate_image($color, $size, $holo) {			   
	  $image_name = "numberpicker_down_focused_holo.png";
	
	  // load picture
	  $button_img = $this->loadTransparentPNG($image_name, $size);
	  	  
	  // update colors
	  $rgb = $this->hex2RGB($color);
	  imagefilter($button_img, IMG_FILTER_COLORIZE, $rgb['red'], $rgb['green'], $rgb['blue']);
	  
	  // back
	  $back_img =  $this->loadTransparentPNG("numberpicker_down_normal_holo_".$holo.".png", $size);
	
      $result = $this->create_dest_image($image_name, $size);
	    
	  imagecopy($result[0], $back_img, 0, 0, 0, 0, $result[1], $result[2]);
	  imagecopy($result[0], $button_img, 0, 0, 0, 0, $result[1], $result[2]);
	  
	  // output to browser
	  if (isset($_GET['action']) && $_GET['action'] == 'display') {
 			  $this->displayImage($result[0]);
		  } else {
		  	 $this->generateImageFile($result[0], $size, $holo);
		  }
    }
  }
  
  class NbPickerUpFocus extends Component {
  	
  	function __construct($ctx="") {
  		parent:: __construct("numberpicker_up_focused_holo_{{holo}}.png", $ctx);
  	}
  	
    function generate_image($color, $size, $holo) {			   
	  $image_name = "numberpicker_up_focused_holo.png";
	
	  // load picture
	  $button_img = $this->loadTransparentPNG($image_name, $size);
	  	  
	  // update colors
	  $rgb = $this->hex2RGB($color);
	  imagefilter($button_img, IMG_FILTER_COLORIZE, $rgb['red'], $rgb['green'], $rgb['blue']);
	  
	  // back
	  $back_img =  $this->loadTransparentPNG("numberpicker_up_normal_holo_".$holo.".png", $size);
	
      $result = $this->create_dest_image($image_name, $size);
	    
	  imagecopy($result[0], $back_img, 0, 0, 0, 0, $result[1], $result[2]);
	  imagecopy($result[0], $button_img, 0, 0, 0, 0, $result[1], $result[2]);
	  
	  // output to browser
	  if (isset($_GET['action']) && $_GET['action'] == 'display') {
 			  $this->displayImage($result[0]);
		  } else {
		  	 $this->generateImageFile($result[0], $size, $holo);
		  }
    }
  }
  
  /******************************************/
  /*          DISABLED FOCUS                */
  /******************************************/
  class NbPickerDownDisabledFocus extends Component {
  	
  	function __construct($ctx="") {
  		parent:: __construct("numberpicker_down_disabled_focused_holo_{{holo}}.png", $ctx);
  	}
  	
    function generate_image($color, $size, $holo) {			   
	  $image_name = "numberpicker_down_disabled_focused_holo.png";
	
	  // load picture
	  $button_img = $this->loadTransparentPNG($image_name, $size);
	  	  
	  // update colors
	  $rgb = $this->hex2RGB($color);
	  imagefilter($button_img, IMG_FILTER_COLORIZE, $rgb['red'], $rgb['green'], $rgb['blue']);
	  
	  // back
	  $back_img =  $this->loadTransparentPNG("numberpicker_down_disabled_holo_".$holo.".png", $size);
	
      $result = $this->create_dest_image($image_name, $size);
	    
	  imagecopy($result[0], $back_img, 0, 0, 0, 0, $result[1], $result[2]);
	  imagecopy($result[0], $button_img, 0, 0, 0, 0, $result[1], $result[2]);
	  
	  // output to browser
	  if (isset($_GET['action']) && $_GET['action'] == 'display') {
 			  $this->displayImage($result[0]);
		  } else {
		  	 $this->generateImageFile($result[0], $size, $holo);
		  }
    }
  }
  
  class NbPickerUpDisabledFocus extends Component {
  	
  	function __construct($ctx="") {
  		parent:: __construct("numberpicker_up_disabled_focused_holo_{{holo}}.png", $ctx);
  	}
  	
    function generate_image($color, $size, $holo) {			   
	  $image_name = "numberpicker_up_disabled_focused_holo.png";
	
	  // load picture
	  $button_img = $this->loadTransparentPNG($image_name, $size);
	  	  
	  // update colors
	  $rgb = $this->hex2RGB($color);
	  imagefilter($button_img, IMG_FILTER_COLORIZE, $rgb['red'], $rgb['green'], $rgb['blue']);
	  
	  // back
	  $back_img =  $this->loadTransparentPNG("numberpicker_up_disabled_holo_".$holo.".png", $size);
	
      $result = $this->create_dest_image($image_name, $size);
	    
	  imagecopy($result[0], $back_img, 0, 0, 0, 0, $result[1], $result[2]);
	  imagecopy($result[0], $button_img, 0, 0, 0, 0, $result[1], $result[2]);
	  
	  // output to browser
	  if (isset($_GET['action']) && $_GET['action'] == 'display') {
 			  $this->displayImage($result[0]);
		  } else {
		  	 $this->generateImageFile($result[0], $size, $holo);
		  }
    }
  }
  
  /******************************************/
  /*                DIVIDER                */
  /******************************************/
  class NbPickerDivider extends Component {
  	
  	function __construct($ctx="") {
  		parent:: __construct("numberpicker_selection_divider.9.png", $ctx);
  	}
  	
    function generate_image($color, $size, $holo) {			   
	  $image_name = "numberpicker_selection_divider.9.png";
	
	  // load picture
	  $button_img = $this->loadTransparentPNG($image_name, $size);
	  	  
	  // update colors
	  $rgb = $this->hex2RGB($color);
	  imagefilter($button_img, IMG_FILTER_COLORIZE, $rgb['red'], $rgb['green'], $rgb['blue']);
	  
	  // nine patch
	  $back_img =  $this->loadTransparentPNG("numberpicker_selection_divider_nine_patch.png", $size);
	
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