<?

  if (!isset($context))
    $context = "../";

  require_once($context.'common.php');
  
  $progressbar_classes = array('ProgressBarPrimary', 'ProgressBarSecondary');
  
  class ProgressBar extends Component {
  	
  	public $_number;
  	
  	function __construct($ctx="", $number) {
  		parent:: __construct("progressbar_indeterminate_holo".$number.".png", $ctx);
  		$_number = $number;
  	}
  	
    function generate_image($color, $size, $holo) {			   
    	  // load picture
		  $progress_img =  $this->loadTransparentPNG($this->_name, $size);
		 
		  // update colors
		  $rgb = $this->hex2RGB($color);
		  imagefilter($progress_img, IMG_FILTER_COLORIZE, $rgb['red'], $rgb['green'], $rgb['blue']);
		  
		  // output to browser
		  if (isset($_GET['action']) && $_GET['action'] == 'display') {
 			  $this->displayImage($progress_img);
		  } else {
		  	 $this->generateImageFile($progress_img, $size, $holo);
		  }
	}
  }
  
  class ProgressBarPrimary extends Component {
  	
  	function __construct($ctx="") {
  		parent:: __construct("progress_primary_holo.9.png", $ctx);
  	}
  	
  	function generate_image($color, $size, $holo) {	
  		$image_name = "progress_primary_holo.png";
	
	  // load picture
	  $seekbar_img = $this->loadTransparentPNG($image_name, $size);
	 
	  // update colors
	  $rgb = $this->hex2RGB($color);
	  imagefilter($seekbar_img, IMG_FILTER_COLORIZE, $rgb['red'], $rgb['green'], $rgb['blue']);
	  	  
	  // add nine patch
	  $seekbar_nine_patch =  $this->loadTransparentPNG("progress_primary_nine_patch.png", $size);
	  
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
  
  
  class ProgressBarSecondary extends Component {
  	
  	function __construct($ctx="") {
  		parent:: __construct("progress_secondary_holo.9.png", $ctx);
  	}
  	
  	function generate_image($color, $size, $holo) {	
  		$image_name = "progress_secondary_holo.png";
	
	  // load picture
	  $seekbar_img = $this->loadTransparentPNG($image_name, $size);
	 
	  // update colors
	  $rgb = $this->hex2RGB($color);
	  imagefilter($seekbar_img, IMG_FILTER_COLORIZE, $rgb['red'], $rgb['green'], $rgb['blue']);
	  	  
	  // add nine patch
	  $seekbar_nine_patch =  $this->loadTransparentPNG("progress_secondary_nine_patch.png", $size);
	  
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