<?

  if (!isset($context))
    $context = "../../";

  require_once($context.'common.php');
  
  $radio_classes = array('Radio', 'RadioOff', 'RadioOffFocus', 'RadioOffPress', 'RadioOnFocus', 'RadioOnPress', 'RadioDisabledOffFocus', 'RadioDisabledOnFocus');
  
  /********************************************/
  /*                   RADIO                  */
  /********************************************/
  class Radio extends Component {
  	
  	function __construct($ctx="") {
  		parent:: __construct("btn_radio_on_holo_{{holo}}.png", $ctx);
  	}

  	
    function generate_image($color, $size, $holo) {	
    	$image_name = "btn_radio_on.png";
	
	  // load picture
	  $checkbox_img =  $this->loadTransparentPNG($image_name, $size);
	 
	  // update colors
	  $rgb = $this->hex2RGB($color);
	  imagefilter($checkbox_img, IMG_FILTER_COLORIZE, $rgb['red'], $rgb['green'], $rgb['blue']);
	  
	  // add border
	  $checkbox_border_img =  $this->loadTransparentPNG("btn_radio_off_holo_".$holo.".png", $size);
	  
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
  /*               RADIO ON PRESS             */
  /********************************************/  
  class RadioOnPress extends Component {
  	
  	function __construct($ctx="") {
  		parent:: __construct("btn_radio_on_pressed_holo_{{holo}}.png", $ctx);
  	}

  	
    function generate_image($color, $size, $holo) {	
    	$image_name = "btn_radio_pressed_holo.png";

		  // load picture
		  $checkbox_img =  $this->loadTransparentPNG($image_name, $size);
		  // add inside radio
		  $radio_in_img =  $this->loadTransparentPNG("btn_radio_on_holo_".$holo.".png", $size);
		    
		  // update colors
		  $rgb = $this->hex2RGB($color);
		  imagefilter($checkbox_img, IMG_FILTER_COLORIZE, $rgb['red'], $rgb['green'], $rgb['blue']);
		  
		  // add border
		  $checkbox_border_img =  $this->loadTransparentPNG("btn_radio_off_holo_".$holo.".png", $size);
		  
		  $result = $this->create_dest_image($image_name, $size);
		  
		  imagecopy($result[0], $checkbox_img, 0, 0, 0, 0, $result[1], $result[2]);
		  imagecopy($result[0], $radio_in_img, 0, 0, 0, 0, $result[1], $result[2]);
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
  /*               RADIO ON FOCUS             */
  /********************************************/   
  class RadioOnFocus extends Component {
  	
  	function __construct($ctx="") {
  		parent:: __construct("btn_radio_on_focused_holo_{{holo}}.png", $ctx);
  	}
  	
    function generate_image($color, $size, $holo) {
    	$image_name = "btn_radio_on.png";
	  $focus_image_name = "btn_radio_off_focus.png";
	
	  // load picture
	  $checkbox_img = $this->loadTransparentPNG($image_name, $size);
	  $checkbox_focus_img = $this->loadTransparentPNG($focus_image_name, $size);
	 
	  // update colors
	  $rgb = $this->hex2RGB($color);
	  imagefilter($checkbox_img, IMG_FILTER_COLORIZE, $rgb['red'], $rgb['green'], $rgb['blue']);
	  imagefilter($checkbox_focus_img, IMG_FILTER_COLORIZE, $rgb['red'], $rgb['green'], $rgb['blue']);
	  
	  // add border
	  $checkbox_border_img = $this->loadTransparentPNG("btn_radio_off_holo_".$holo.".png", $size);
	  
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
  /*                 RADIO OFF                */
  /********************************************/   
  class RadioOff extends Component {
  	  	
  	function __construct($ctx="") {
  		parent:: __construct("btn_radio_off_holo_{{holo}}.png", $ctx);
  	}
    	
    function generate_image($color, $size, $holo) {	
      // add border
	  $checkbox_border_img =  $this->loadTransparentPNG("btn_radio_off_holo_".$holo.".png", $size);
	  
	  // output to browser
	  if (isset($_GET['action']) && $_GET['action'] == 'display') {
	 	  $this->displayImage($checkbox_border_img);
	  } else {
	  	 $this->generateImageFile($checkbox_border_img, $size, $holo);
	  }
    }
  }
  
  /********************************************/
  /*               RADIO OFF PRESS            */
  /********************************************/    
  class RadioOffPress extends Component {
  	
  	function __construct($ctx="") {
  		parent:: __construct("btn_radio_off_pressed_holo_{{holo}}.png", $ctx);
  	}

  	
    function generate_image($color, $size, $holo) {
    	 $image_name = "btn_radio_pressed_holo.png";
	
	  // load picture
	  $checkbox_img = $this->loadTransparentPNG($image_name, $size);
	    
	  // update colors
	  $rgb = $this->hex2RGB($color);
	  imagefilter($checkbox_img, IMG_FILTER_COLORIZE, $rgb['red'], $rgb['green'], $rgb['blue']);
	  
	  // add border
	  $checkbox_border_img = $this->loadTransparentPNG("btn_radio_off_holo_".$holo.".png", $size);
	  
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
  /*               RADIO OFF FOCUS            */
  /********************************************/
 class RadioOffFocus extends Component {
  	
  	function __construct($ctx="") {
  		parent:: __construct("btn_radio_off_focused_holo_{{holo}}.png", $ctx);
  	}

  	
    function generate_image($color, $size, $holo) {
    	$focus_image_name = "btn_radio_off_focus.png";
	
	  // load picture
	  $checkbox_focus_img = $this->loadTransparentPNG($focus_image_name, $size);
	 
	  // update colors
	  $rgb = $this->hex2RGB($color);
	  imagefilter($checkbox_focus_img, IMG_FILTER_COLORIZE, $rgb['red'], $rgb['green'], $rgb['blue']);
	  
	  // add border
	  $checkbox_border_img =  $this->loadTransparentPNG("btn_radio_off_holo_".$holo.".png", $size);
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
  /*          RADIO DISABLED OFF FOCUS              */
  /*****************************************************/ 
  class RadioDisabledOffFocus extends Component {
  	
  	function __construct($ctx="") {
  		parent:: __construct("btn_radio_off_disabled_focused_holo_{{holo}}.png", $ctx);
  	}
  	
    function generate_image($color, $size, $holo) {
	  $focus_image_name = "btn_radio_off_focus.png";
	
	  // load picture
	  $checkbox_focus_img = $this->loadTransparentPNG($focus_image_name, $size);
	 
	  // update colors
	  $rgb = $this->hex2RGB($color);
	  imagefilter($checkbox_focus_img, IMG_FILTER_COLORIZE, $rgb['red'], $rgb['green'], $rgb['blue']);
	  
	  // add border
	  $checkbox_border_img =  $this->loadTransparentPNG("btn_radio_off_disabled_holo_".$holo.".png", $size);
	  
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
  /*          RADIO DISABLED ON FOCUS              */
  /****************************************************/ 
  class RadioDisabledOnFocus extends Component {
  	
  	function __construct($ctx="") {
  		parent:: __construct("btn_radio_on_disabled_focused_holo_{{holo}}.png", $ctx);
  	}
  	
    function generate_image($color, $size, $holo) {
	  $focus_image_name = "btn_radio_off_focus.png";
	
	  // load picture
	  $checkbox_focus_img = $this->loadTransparentPNG($focus_image_name, $size);
	 
	  // update colors
	  $rgb = $this->hex2RGB($color);
	  imagefilter($checkbox_focus_img, IMG_FILTER_COLORIZE, $rgb['red'], $rgb['green'], $rgb['blue']);
	  
	  // add border
	  $checkbox_border_img =  $this->loadTransparentPNG("btn_radio_on_disabled_holo_".$holo.".png", $size);
	  
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