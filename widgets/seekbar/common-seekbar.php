<?
  if (!isset($context))
    $context = "../../";
  
  require_once($context.'common.php');
  
  $seekbar_classes = array('SeekBar', 'SeekBarFocus', 'SeekBarPress', 'SeekBarDisabled', 'SeekBarPrimary', 'SeekBarSecondary');
  
  
  /********************************************/
  /*                 SEEKBAR                 */
  /********************************************/
  class SeekBar extends Component {
  	
  	function __construct($ctx="") {
  		parent:: __construct("scrubber_control_normal_holo.png", $ctx);
  	}
  	
    function generate_image($color, $size, $holo) {			   
	  $image_name = "scrubber_control_normal_holo.png";
	
	  // load picture
	  $seekbar_img = $this->loadTransparentPNG($image_name, $size);
	 
	  // update colors
	  $rgb = $this->hex2RGB($color);
	  imagefilter($seekbar_img, IMG_FILTER_COLORIZE, $rgb['red'], $rgb['green'], $rgb['blue']);
	  	  
	  // output to browser
	  if (isset($_GET['action']) && $_GET['action'] == 'display') {
 			  $this->displayImage($seekbar_img);
		  } else {
		  	 $this->generateImageFile($seekbar_img, $size, $holo);
		  }
    }
  }
  
  /********************************************/
  /*             SEEKBAR FOCUS                */
  /********************************************/
  class SeekBarFocus extends Component {
  	
  	function __construct($ctx="") {
  		parent:: __construct("scrubber_control_focused_holo.png", $ctx);
  	}
  	
    function generate_image($color, $size, $holo) {			   
	  $image_name = "scrubber_control_focused_holo.png";
	
	  // load picture
	  $seekbar_img = $this->loadTransparentPNG($image_name, $size);
	 
	  // update colors
	  $rgb = $this->hex2RGB($color);
	  imagefilter($seekbar_img, IMG_FILTER_COLORIZE, $rgb['red'], $rgb['green'], $rgb['blue']);
	  	  
	  // output to browser
	  if (isset($_GET['action']) && $_GET['action'] == 'display') {
 			  $this->displayImage($seekbar_img);
		  } else {
		  	 $this->generateImageFile($seekbar_img, $size, $holo);
		  }
    }
  }
  
  /********************************************/
  /*             SEEKBAR PRESSED              */
  /********************************************/
  class SeekBarPress extends Component {
  	
  	function __construct($ctx="") {
  		parent:: __construct("scrubber_control_pressed_holo.png", $ctx);
  	}
  	
    function generate_image($color, $size, $holo) {			   
	  $image_name = "scrubber_control_pressed_holo.png";
	
	  // load picture
	  $seekbar_img = $this->loadTransparentPNG($image_name, $size);
	 
	  // update colors
	  $rgb = $this->hex2RGB($color);
	  imagefilter($seekbar_img, IMG_FILTER_COLORIZE, $rgb['red'], $rgb['green'], $rgb['blue']);
	  	  
	  // output to browser
	  if (isset($_GET['action']) && $_GET['action'] == 'display') {
 			  $this->displayImage($seekbar_img);
		  } else {
		  	 $this->generateImageFile($seekbar_img, $size, $holo);
		  }
    }
  }
  
  /********************************************/
  /*             SEEKBAR DISABLED             */
  /********************************************/
  class SeekBarDisabled extends Component {
  	
  	function __construct($ctx="") {
  		parent:: __construct("scrubber_control_disabled_holo.png", $ctx);
  	}
  	
    function generate_image($color, $size, $holo) {			   
	  $image_name = "scrubber_control_disabled_holo.png";
	
	  // load picture
	  $seekbar_img = $this->loadTransparentPNG($image_name, $size);
	 
	  // update colors
	  $rgb = $this->hex2RGB($color);
	  imagefilter($seekbar_img, IMG_FILTER_COLORIZE, $rgb['red'], $rgb['green'], $rgb['blue']);
	 
	  // add background
	  $seekbar_back =  $this->loadTransparentPNG("scrubber_control_disabled_back_holo.png", $size);
	  
	  $result = $this->create_dest_image($image_name, $size);
	    
	  imagecopy($result[0], $seekbar_back, 0, 0, 0, 0, $result[1], $result[2]);
	  imagecopy($result[0], $seekbar_img, 0, 0, 0, 0, $result[1], $result[2]);
	 
	  // output to browser
	  if (isset($_GET['action']) && $_GET['action'] == 'display') {
 			  $this->displayImage($result[0]);
		  } else {
		  	 $this->generateImageFile($result[0], $size, $holo);
		  }
    }
  }

  /********************************************/
  /*           SEEKBAR PRIMARY                */
  /********************************************/
  class SeekBarPrimary extends Component {
  	
  	function __construct($ctx="") {
  		parent:: __construct("scrubber_primary_holo.9.png", $ctx);
  	}
  	
    function generate_image($color, $size, $holo) {			   
	  $image_name = "scrubber_primary_holo.png";
	
	  // load picture
	  $seekbar_img = $this->loadTransparentPNG($image_name, $size);
	 
	  // update colors
	  $rgb = $this->hex2RGB($color);
	  imagefilter($seekbar_img, IMG_FILTER_COLORIZE, $rgb['red'], $rgb['green'], $rgb['blue']);
	  	  
	  // add nine patch
	  $seekbar_nine_patch =  $this->loadTransparentPNG("scrubber_nine_patch.png", $size);
	  
	  $result = $this->create_dest_image($image_name, $size);
	    
	  imagecopy($result[0], $seekbar_img, 0, 0, 0, 0, $result[1], $result[2]);
	  imagecopy($result[0], $seekbar_nine_patch, 0, 0, 0, 0, $result[1], $result[2]);
	 
	  // output to browser
	  if (isset($_GET['action']) && $_GET['action'] == 'display') {
 			  $this->displayImage($result[0]);
		  } else {
		  	 $this->generateImageFile($result[0], $size, $holo);
		  }
    }
  }
  
  /********************************************/
  /*           SEEKBAR SECONDARY              */
  /********************************************/
  class SeekBarSecondary extends Component {
  	
  	function __construct($ctx="") {
  		parent:: __construct("scrubber_secondary_holo.9.png", $ctx);
  	}
  	
    function generate_image($color, $size, $holo) {			   
	  $image_name = "scrubber_secondary_holo.png";
	
	  // load picture
	  $seekbar_img = $this->loadTransparentPNG($image_name, $size);
	 
	  // update colors
	  $rgb = $this->hex2RGB($color);
	  imagefilter($seekbar_img, IMG_FILTER_COLORIZE, $rgb['red'], $rgb['green'], $rgb['blue']);
	  	  
	  // add nine patch
	  $seekbar_nine_patch =  $this->loadTransparentPNG("scrubber_nine_patch.png", $size);
	  
	  $result = $this->create_dest_image($image_name, $size);
	    
	  imagecopy($result[0], $seekbar_img, 0, 0, 0, 0, $result[1], $result[2]);
	  imagecopy($result[0], $seekbar_nine_patch, 0, 0, 0, 0, $result[1], $result[2]);
	 
	  // output to browser
	  if (isset($_GET['action']) && $_GET['action'] == 'display') {
 			  $this->displayImage($result[0]);
		  } else {
		  	 $this->generateImageFile($result[0], $size, $holo);
		  }
    }
  }
  
?>