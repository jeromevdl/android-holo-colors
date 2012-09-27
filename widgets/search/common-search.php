<?

  if (!isset($context))
    $context = "../../";

  require_once($context.'common.php');
  
  $search_classes = array('Search', 'SearchRight');
  
  /********************************************/
  /*                 Search                */
  /********************************************/
  class Search extends Component {
  	
  	function __construct($ctx="") {
  		parent:: __construct("textfield_search_selected_holo_{{holo}}.9.png", $ctx);
  	}
  	
    function generate_image($color, $size, $holo) {			   
	  $image_name = "textfield_search_selected_holo.png";
	
	  // load picture
	  $text_img = $this->loadTransparentPNG($image_name, $size);
	  
	  // update colors
	  $rgb = $this->hex2RGB($color);
	  imagefilter($text_img, IMG_FILTER_COLORIZE, $rgb['red'], $rgb['green'], $rgb['blue']);
	  
	  // add nine patch
	  $border_img =  $this->loadTransparentPNG("textfield_search_ninepatch.png", $size);
	  
	  $result = $this->create_dest_image($image_name, $size);
	    
	  imagecopy($result[0], $text_img, 0, 0, 0, 0, $result[1], $result[2]);
	  imagecopy($result[0], $border_img, 0, 0, 0, 0, $result[1], $result[2]);
	  
	  // output to browser
	  if (isset($_GET['action']) && $_GET['action'] == 'display') {
 			  $this->displayImage($result[0]);
		  } else {
		  	 $this->generateImageFile($result[0], $size, $holo);
		  }
    }
  }
  
  /***************************
   *        Search Right
   ***************************/
  class SearchRight extends Component {
  	
  	function __construct($ctx="") {
  		parent:: __construct("textfield_search_right_selected_holo_{{holo}}.9.png", $ctx);
  	} 
  	
  	function generate_image($color, $size, $holo) {
  	  $image_name = "textfield_search_right_selected_holo.png";
	
	  // load picture
	  $text_img = $this->loadTransparentPNG($image_name, $size);
	  
	  // update colors
	  $rgb = $this->hex2RGB($color);
	  imagefilter($text_img, IMG_FILTER_COLORIZE, $rgb['red'], $rgb['green'], $rgb['blue']);
	  
	  // add nine patch
	  $border_img =  $this->loadTransparentPNG("textfield_search_ninepatch.png", $size);
	  
	  $result = $this->create_dest_image($image_name, $size);
	    
	  imagecopy($result[0], $text_img, 0, 0, 0, 0, $result[1], $result[2]);
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