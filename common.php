<?   

  include_once('include/php/log4php/Logger.php');
  Logger::configure($context.'log4php.xml');
    
  abstract class Component
  {
  	public $logger;
  	public $_context = "";
  	public $_color = "000";
  	public $_holo = "light";
  	public $_name = "";
  	
    abstract protected function generate_image($color, $size, $holo);
    
    function __construct($name, $ctx="") 
    {
    	 $this->_context = $ctx;
    	 $this->_name = $name;
    	 $this->logger = Logger::getLogger(__CLASS__);
    }
    
    /***************************
	   *
	   * Add nine patch lines
	   *
	   ***************************/
	  function drawNinePatch($image, $image_name, $size, $ninepatch) {
	  	
	  	$image_path = $this->_context."images/drawable-".$size."/".$image_name;
	  	
	  	$this->logger->debug("drawNinePatch : ".$image_path);
	  					   
	  	$nine = $ninepatch[$size];
	  	  	
	  	$black = imagecolorallocate($image, 0, 0, 0);
	  	
	  	$size = getimagesize($image_path);
	    $w = $size[0];
	    $h = $size[1];
	  	  	
	  	// left
	  	imageline($image, 0, $nine[0], 0, $nine[1], $black);
	  	
	  	// right
	  	imageline($image, $w - 1, $nine[2], $w - 1, $nine[3], $black);
	  	
	  	// top
	  	imageline($image, $nine[4], 0, $nine[5], 0, $black);
	  	
	  	// bottom
	  	imageline($image, $nine[4], $h - 1, $nine[5], $h - 1, $black);
	  	
	  	return $image;
	  }
	  
	  /***************************
	   *
	   * Display image in browser
	   *
	   ***************************/
	  function displayImage($image) {
	  		header( "Content-type: image/png" );
	  		ImagePNG($image);
	  		imagedestroy($image);
	  }

	  
	  /******************************************************
	   *
	   * Generate image in the good subfolder (date & session id)
	   *
	   ******************************************************/
	  function generateImageFile($image, $size, $holo) {
	  		$id = $_SESSION['id'];
	  		date_default_timezone_set('UTC');
	  		$date = date("Ymd");
	  		$folder = getcwd()."/generated/".$date."/".$_SESSION['id']."/res/drawable-".$size;
	  		if (file_exists($folder) == FALSE) {
	  			mkdir($folder, 0777, true);
	  		}
	  		ImagePNG($image, $folder."/".str_replace("{{holo}}", $holo, $this->_name));
	  		imagedestroy($image);
	  }
	
	  /***************************
	   *
	   * Convert hexadecimal to RGB
	   *
	   ***************************/
	  function hex2RGB($hexStr, $returnAsString = false, $seperator = ',') {
	  	$hexStr = preg_replace("/[^0-9A-Fa-f]/", '', $hexStr); // Gets a proper hex string
	    $rgbArray = array();
	    if (strlen($hexStr) == 6) { //If a proper hex code, convert using bitwise operation. No overhead... faster
	        $colorVal = hexdec($hexStr);
	        $rgbArray['red'] = 0xFF & ($colorVal >> 0x10);
	        $rgbArray['green'] = 0xFF & ($colorVal >> 0x8);
	        $rgbArray['blue'] = 0xFF & $colorVal;
	    } elseif (strlen($hexStr) == 3) { //if shorthand notation, need some string manipulations
	        $rgbArray['red'] = hexdec(str_repeat(substr($hexStr, 0, 1), 2));
	        $rgbArray['green'] = hexdec(str_repeat(substr($hexStr, 1, 1), 2));
	        $rgbArray['blue'] = hexdec(str_repeat(substr($hexStr, 2, 1), 2));
	    } else {
	        return false; //Invalid hex color code
	    }
	    return $returnAsString ? implode($seperator, $rgbArray) : $rgbArray; // returns the rgb string or the associative array
	  }
	  
	  /***************************
	   *
	   * Load Transparent PNG
	   *
	   ***************************/
	  function loadTransparentPNG($image_name, $size) {
	  	$image_path = $this->_context."images/drawable-".$size."/".$image_name;
	  	
   		$this->logger->debug("loadTransparentPNG : ".$image_path);
	  	
	  	$im = ImageCreateFromPNG($image_path);
	  
	    $size = getimagesize($image_path);
	    $w = $size[0];
	    $h = $size[1];
	
	    // crée l'image de sortie
	    $im2 =  imagecreatetruecolor($w,$h);
	    imagealphablending($im2,false);
	    imagesavealpha($im2,true);
	
	    // remplit l'image de sortie
	    imagecopyresampled($im2,$im,0,0,0,0,$w,$h,$w,$h);
	    
	    $this->logger->debug("loadTransparentPNG OK");
	  	
	    return $im2;
	  }
	  
	  /***************************
	   *
	   * Create a empty transparent image to copy all others into this one
	   *
	   ***************************/
	  function create_dest_image($image_name, $size, $ctx="") {
	  	  $image_path = $this->_context."images/drawable-".$size."/".$image_name;
	  	  
	  	  $this->logger->debug("create_dest_image : ".$image_path);
	  	  
		  $size = getimagesize($image_path);
		  $w = $size[0];
		  $h = $size[1];
		    
		  $dest = imagecreatetruecolor($w, $h);
		  imagesavealpha($dest, true);
		  $transparent = imagecolorallocatealpha($dest, 0, 0, 0, 127);
		  imagefill($dest, 0, 0, $transparent);
		  
		  return array($dest, $w, $h);
	  }
  }  
?>