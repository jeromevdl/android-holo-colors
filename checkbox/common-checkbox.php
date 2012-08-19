<?
  if (!isset($context))
    $context = "../";
  
  require_once($context.'common.php');
  
  $checkbox_classes = array('Checkbox', 'CheckboxOff', 'CheckboxOffFocus', 'CheckboxOffPress', 'CheckboxOnFocus', 'CheckboxOnPress', 'CheckboxDisabledOnFocus', 'CheckboxDisabledOffFocus');
  
  
  /********************************************/
  /*                 CHECKBOX                 */
  /********************************************/
  class Checkbox extends Component {
  	
  	function __construct($ctx="") {
  		parent:: __construct("btn_check_on_holo_{{holo}}.png", $ctx);
  	}
  	
    function generate_image($color, $size, $holo) {			   
	  $image_name = "btn_check.png";
	
	  // load picture
	  $checkbox_img = $this->loadTransparentPNG($image_name, $size);
	 
	  // update colors
	  $rgb = $this->hex2RGB($color);
	  imagefilter($checkbox_img, IMG_FILTER_COLORIZE, $rgb['red'], $rgb['green'], $rgb['blue']);
	  
	  // add border
	  $checkbox_border_img =  $this->loadTransparentPNG("btn_check_off_holo_".$holo.".png", $size);
	  
	  $result = $this->create_dest_image($image_name, $size);
	    
	  imagecopy($result[0], $checkbox_border_img, 0, 0, 0, 0, $result[1], $result[2]);
	  imagecopy($result[0], $checkbox_img, 0, 0, 0, 0, $result[1], $result[2]);
	  
	  // output to browser
	  if (isset($_GET['action']) && $_GET['action'] == 'display') {
 			  $this->displayImage($result[0]);
		  } else {
		  	 $this->generateImageFile($result[0], $size, $holo);
		  }
    }
  }
  
  /********************************************/
  /*         CHECKBOX ON PRESS                */
  /********************************************/  
  class CheckboxOnPress extends Component {
  	
  	function __construct($ctx="") {
  		parent:: __construct("btn_check_on_pressed_holo_{{holo}}.png", $ctx);
  	}
  	
    function generate_image($color, $size, $holo) {			   
	  $image_name = "btn_check_pressed_holo.png";
	
	  // load picture
	  $checkbox_img = $this->loadTransparentPNG($image_name, $size);
	 
	  // update colors
	  $rgb = $this->hex2RGB($color);
	  imagefilter($checkbox_img, IMG_FILTER_COLORIZE, $rgb['red'], $rgb['green'], $rgb['blue']);
	  
	  // add border
	  $checkbox_border_img = $this->loadTransparentPNG("btn_check_on_holo_".$holo.".png", $size);
	  
	  $result = $this->create_dest_image($image_name, $size);
	    
	  imagecopy($result[0], $checkbox_img, 0, 0, 0, 0, $result[1], $result[2]);
	  imagecopy($result[0], $checkbox_border_img, 0, 0, 0, 0, $result[1], $result[2]);
	  
	  // output to browser
	  if (isset($_GET['action']) && $_GET['action'] == 'display') {
 		$this->displayImage($result[0]);
	  } else {
		$this->generateImageFile($result[0], $size, $holo);
	  }
    }
  }
  
  /********************************************/
  /*         CHECKBOX ON FOCUS                */
  /********************************************/ 
  class CheckboxOnFocus extends Component {
    
  	function __construct($ctx="") {
  		parent:: __construct("btn_check_on_focused_holo_{{holo}}.png", $ctx);
  	}
    
    function generate_image($color, $size, $holo) {				   
	  $image_name = "btn_check.png";
	  $focus_image_name = "btn_check_on_focus.png";
	
	  // load picture
	  $checkbox_img = $this->loadTransparentPNG($image_name, $size);
	  $checkbox_focus_img = $this->loadTransparentPNG($focus_image_name, $size);
	 
	  // update colors
	  $rgb = $this->hex2RGB($color);
	  imagefilter($checkbox_img, IMG_FILTER_COLORIZE, $rgb['red'], $rgb['green'], $rgb['blue']);
	  imagefilter($checkbox_focus_img, IMG_FILTER_COLORIZE, $rgb['red'], $rgb['green'], $rgb['blue']);
	  
	  // add border
	  $checkbox_border_img = $this->loadTransparentPNG("btn_check_off_holo_".$holo.".png", $size);
	  
	  $result = $this->create_dest_image($image_name, $size);
	    
	  imagecopy($result[0], $checkbox_border_img, 0, 0, 0, 0, $result[1], $result[2]);
	  imagecopy($result[0], $checkbox_img, 0, 0, 0, 0, $result[1], $result[2]);
	  imagecopy($result[0], $checkbox_focus_img, 0, 0, 0, 0, $result[1], $result[2]);
	  
	  // output to browser
	  if (isset($_GET['action']) && $_GET['action'] == 'display') {
 		$this->displayImage($result[0]);
	  } else {
		$this->generateImageFile($result[0], $size, $holo);
	  }
    }
  }

  /********************************************/
  /*              CHECKBOX OFF                */
  /********************************************/
  class CheckboxOff extends Component {
  	
  	function __construct($ctx="") {
  		parent:: __construct("btn_check_off_holo_{{holo}}.png", $ctx);
  	}
  	
    function generate_image($color, $size, $holo) {  					   
	  // add border
	  $checkbox_border_img = $this->loadTransparentPNG("btn_check_off_holo_".$holo.".png", $size);
	  
	  // output to browser
	  if (isset($_GET['action']) && $_GET['action'] == 'display') {
 		$this->displayImage($checkbox_border_img);
	  } else {
		$this->generateImageFile($checkbox_border_img, $size, $holo);
	  }
    }
  }

  /********************************************/
  /*           CHECKBOX OFF PRESS             */
  /********************************************/  
  class CheckboxOffPress extends Component {
  	
  	function __construct($ctx="") {
  		parent:: __construct("btn_check_off_pressed_holo_{{holo}}.png", $ctx);
  	}
  	
    function generate_image($color, $size, $holo) {				   
	  $image_name = "btn_check_pressed_holo.png";
	
	  // load picture
	  $checkbox_img = $this->loadTransparentPNG($image_name, $size);
	 
	  // update colors
	  $rgb = $this->hex2RGB($color);
	  imagefilter($checkbox_img, IMG_FILTER_COLORIZE, $rgb['red'], $rgb['green'], $rgb['blue']);
	  
	  // add border
	  $checkbox_border_img = $this->loadTransparentPNG("btn_check_off_holo_".$holo.".png", $size);
	  
	  $result = $this->create_dest_image($image_name, $size);
	    
	  imagecopy($result[0], $checkbox_img, 0, 0, 0, 0, $result[1], $result[2]);
	  imagecopy($result[0], $checkbox_border_img, 0, 0, 0, 0, $result[1], $result[2]);
	  
	  // output to browser
	  if (isset($_GET['action']) && $_GET['action'] == 'display') {
 		$this->displayImage($result[0]);
	  } else {
		$this->generateImageFile($result[0], $size, $holo);
	  }
    }
  }

  /********************************************/
  /*          CHECKBOX OFF FOCUS              */
  /********************************************/ 
  class CheckboxOffFocus extends Component {
  	
  	function __construct($ctx="") {
  		parent:: __construct("btn_check_off_focused_holo_{{holo}}.png", $ctx);
  	}
  	
    function generate_image($color, $size, $holo) {
	  $focus_image_name = "btn_check_off_focus.png";
	
	  // load picture
	  $checkbox_focus_img = $this->loadTransparentPNG($focus_image_name, $size);
	 
	  // update colors
	  $rgb = $this->hex2RGB($color);
	  imagefilter($checkbox_focus_img, IMG_FILTER_COLORIZE, $rgb['red'], $rgb['green'], $rgb['blue']);
	  
	  // add border
	  $checkbox_border_img =  $this->loadTransparentPNG("btn_check_off_holo_".$holo.".png", $size);
	  
	  $result = $this->create_dest_image($focus_image_name, $size);
	    
	  imagecopy($result[0], $checkbox_border_img, 0, 0, 0, 0, $result[1], $result[2]);
	  imagecopy($result[0], $checkbox_focus_img, 0, 0, 0, 0, $result[1], $result[2]);
	  
	  // output to browser
	  if (isset($_GET['action']) && $_GET['action'] == 'display') {
 			 $this->displayImage($result[0]);
		  } else {
		  	 $this->generateImageFile($result[0], $size, $holo);
		  }
    }
  }

  /*****************************************************/
  /*          CHECKBOX DISABLED OFF FOCUS              */
  /*****************************************************/ 
  class CheckboxDisabledOffFocus extends Component {
  	
  	function __construct($ctx="") {
  		parent:: __construct("btn_check_off_disabled_focused_holo_{{holo}}.png", $ctx);
  	}
  	
    function generate_image($color, $size, $holo) {
	  $focus_image_name = "btn_check_off_focus.png";
	
	  // load picture
	  $checkbox_focus_img = $this->loadTransparentPNG($focus_image_name, $size);
	 
	  // update colors
	  $rgb = $this->hex2RGB($color);
	  imagefilter($checkbox_focus_img, IMG_FILTER_COLORIZE, $rgb['red'], $rgb['green'], $rgb['blue']);
	  
	  // add border
	  $checkbox_border_img =  $this->loadTransparentPNG("btn_check_off_disabled_holo_".$holo.".png", $size);
	  
	  $result = $this->create_dest_image($focus_image_name, $size);
	    
	  imagecopy($result[0], $checkbox_border_img, 0, 0, 0, 0, $result[1], $result[2]);
	  imagecopy($result[0], $checkbox_focus_img, 0, 0, 0, 0, $result[1], $result[2]);
	  
	  // output to browser
	  if (isset($_GET['action']) && $_GET['action'] == 'display') {
 			 $this->displayImage($result[0]);
		  } else {
		  	 $this->generateImageFile($result[0], $size, $holo);
		  }
    }
  }
  
  /****************************************************/
  /*          CHECKBOX DISABLED ON FOCUS              */
  /****************************************************/ 
  class CheckboxDisabledOnFocus extends Component {
  	
  	function __construct($ctx="") {
  		parent:: __construct("btn_check_on_disabled_focused_holo_{{holo}}.png", $ctx);
  	}
  	
    function generate_image($color, $size, $holo) {
	  $focus_image_name = "btn_check_on_focus.png";
	
	  // load picture
	  $checkbox_focus_img = $this->loadTransparentPNG($focus_image_name, $size);
	 
	  // update colors
	  $rgb = $this->hex2RGB($color);
	  imagefilter($checkbox_focus_img, IMG_FILTER_COLORIZE, $rgb['red'], $rgb['green'], $rgb['blue']);
	  
	  // add border
	  $checkbox_border_img =  $this->loadTransparentPNG("btn_check_on_disabled_holo_".$holo.".png", $size);
	  
	  $result = $this->create_dest_image($focus_image_name, $size);
	    
	  imagecopy($result[0], $checkbox_border_img, 0, 0, 0, 0, $result[1], $result[2]);
	  imagecopy($result[0], $checkbox_focus_img, 0, 0, 0, 0, $result[1], $result[2]);
	  
	  // output to browser
	  if (isset($_GET['action']) && $_GET['action'] == 'display') {
 			 $this->displayImage($result[0]);
		  } else {
		  	 $this->generateImageFile($result[0], $size, $holo);
		  }
    }
  }
?>