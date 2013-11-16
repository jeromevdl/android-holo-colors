<?

  if (!isset($context))
    $context = "../../";

  require_once($context.'common.php');
  
  $fastscroll_classes = array('Fastscroll', 'FastscrollPressed');
    

  
  /********************************************/
  /*                 Fastscroll                */
  /********************************************/
  class Fastscroll extends Component {
  	
  	function __construct($ctx="") {
  		parent:: __construct("fastscroll_thumb_default_holo.png", $ctx);
  	}
  	
    function generate_image($color, $size, $holo, $kitkat) {			   
	  $image_name = "fastscroll_thumb_default_holo.png";
	
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
  
  /********************************************/
  /*          FastscrollPressed               */
  /********************************************/
  class FastscrollPressed extends Component {
  	
  	function __construct($ctx="") {
  		parent:: __construct("fastscroll_thumb_pressed_holo.png", $ctx);
  	}
  	
    function generate_image($color, $size, $holo, $kitkat) {			   
	  $image_name = "fastscroll_thumb_pressed_holo.png";
	
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
    
?>