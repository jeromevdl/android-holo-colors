<?

  if (!isset($context))
    $context = "../../";

  require_once($context.'common.php');
  
  $edittext_classes = array('EditText', 'EditTextActivate', 'EditTextFocus');
    
  abstract class AbstractEditText extends Component {
  	
  	  public function generate_image_with_name($image_name, $color, $size, $holo) {
		  $ninepatch = array(// lefttop, leftbottom, righttop, rightbottom, topleft, topright
		  					   "mdpi" => array(21, 23, 8, 25, 13, 15), 
		  					   "hdpi" => array(31, 34, 11, 37, 19, 22), 
		  					   "xhdpi" => array(41, 45, 15, 49, 25, 29));
	
		  // load picture
		  $edittext_img =  $this->loadTransparentPNG($image_name, $size);
		 
		  // update colors
		  $rgb = $this->hex2RGB($color);
		  imagefilter($edittext_img, IMG_FILTER_COLORIZE, $rgb['red'], $rgb['green'], $rgb['blue']);
		  
		  // add nine patch  	
		  $edittext_img = $this->drawNinePatch($edittext_img, $image_name, $size, $ninepatch);
		  
		  // output to browser
		  if (isset($_GET['action']) && $_GET['action'] == 'display') {
 			  $this->displayImage($edittext_img);
		  } else {
		  	 $this->generateImageFile($edittext_img, $size, $holo);
		  }
	  }
  }
  
  /********************************************/
  /*                 EditText                */
  /********************************************/
  class EditText extends Component {
  	
  	function __construct($ctx="") {
  		parent:: __construct("textfield_default_holo_{{holo}}.9.png", $ctx);
  	}
  	
    function generate_image($color, $size, $holo) {			   
	  $image_name = "textfield_default_holo_".$holo.".9.png";
	
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
  
  /***************************
   *
   * EditText activated class
   *
   ***************************/
  class EditTextActivate extends AbstractEditText {
  	
  	function __construct($ctx="") {
  		parent:: __construct("textfield_activated_holo_{{holo}}.9.png", $ctx);
  	} 
  	
  	function generate_image($color, $size, $holo) {
  	  $this->generate_image_with_name("textfield_activated_holo.png", $color, $size, $holo);
    }
  }
  
  /***************************
   *
   * EditTextFocus class
   *
   ***************************/
  class EditTextFocus extends AbstractEditText {
  	
  	function __construct($ctx="") {
  		parent:: __construct("textfield_focused_holo_{{holo}}.9.png", $ctx);
  	}
  	
    function generate_image($color, $size, $holo) {
      $this->generate_image_with_name("textfield_focused_holo.png", $color, $size, $holo);
    }
  }

  
?>