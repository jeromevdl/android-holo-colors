<?

  if (!isset($context))
    $context = "../";

  require_once($context.'common.php');
  
  $list_classes = array('ListFocus', 'ListPress', 'ListLongPress');
    
   
  /********************************************/
  /*                 LIST FOCUS                */
  /********************************************/
  class ListFocus extends Component {
  	
  	function __construct($ctx="") {
  		parent:: __construct("list_focused_holo.9.png", $ctx);
  	}
  	
    function generate_image($color, $size, $holo) {			   
	  $image_name = "list_focused_holo.png";
	
	  // load picture
	  $list_img = $this->loadTransparentPNG($image_name, $size);
	  
	  // update colors
	  $rgb = $this->hex2RGB($color);
	  imagefilter($list_img, IMG_FILTER_COLORIZE, $rgb['red'], $rgb['green'], $rgb['blue']);
	  
	  // add nine patch
	  $border_img =  $this->loadTransparentPNG("list_nine_patch.png", $size);
	  
	  $result = $this->create_dest_image($image_name, $size);
	    
	  imagecopy($result[0], $list_img, 0, 0, 0, 0, $result[1], $result[2]);
	  imagecopy($result[0], $border_img, 0, 0, 0, 0, $result[1], $result[2]);
	  
	  // output to browser
	  if (isset($_GET['action']) && $_GET['action'] == 'display') {
 		  $this->displayImage($result[0]);
	  } else {
		  $this->generateImageFile($result[0], $size, $holo);
	  }
    }
  }
  
  /********************************************/
  /*                 LIST PRESS                */
  /********************************************/
  class ListPress extends Component {
  	
  	function __construct($ctx="") {
  		parent:: __construct("list_pressed_holo_{{holo}}.9.png", $ctx);
  	}
  	
    function generate_image($color, $size, $holo) {			   
	  $image_name = "list_pressed_holo.png";
	
	  // load picture
	  $list_img = $this->loadTransparentPNG($image_name, $size);
	  
	  // update colors
	  $rgb = $this->hex2RGB($color);
	  imagefilter($list_img, IMG_FILTER_COLORIZE, $rgb['red'], $rgb['green'], $rgb['blue']);
	  
	  // add nine patch
	  $border_img =  $this->loadTransparentPNG("list_nine_patch.png", $size);
	  
	  $result = $this->create_dest_image($image_name, $size);
	    
	  imagecopy($result[0], $list_img, 0, 0, 0, 0, $result[1], $result[2]);
	  imagecopy($result[0], $border_img, 0, 0, 0, 0, $result[1], $result[2]);
	  
	  // output to browser
	  if (isset($_GET['action']) && $_GET['action'] == 'display') {
 		  $this->displayImage($result[0]);
	  } else {
		  $this->generateImageFile($result[0], $size, $holo);
	  }
    }
  }

  /********************************************/
  /*            LIST LONG PRESS               */
  /********************************************/
  class ListLongPress extends Component {
  	
  	function __construct($ctx="") {
  		parent:: __construct("list_longpressed_holo.9.png", $ctx);
  	}
  	
    function generate_image($color, $size, $holo) {			   
	  $image_name = "list_longpressed_holo.png";
	
	  // load picture
	  $list_img = $this->loadTransparentPNG($image_name, $size);
	  
	  // update colors
	  $rgb = $this->hex2RGB($color);
	  imagefilter($list_img, IMG_FILTER_COLORIZE, $rgb['red'], $rgb['green'], $rgb['blue']);
	  
	  // add nine patch
	  $border_img =  $this->loadTransparentPNG("list_nine_patch.png", $size);
	  
	  $result = $this->create_dest_image($image_name, $size);
	    
	  imagecopy($result[0], $list_img, 0, 0, 0, 0, $result[1], $result[2]);
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