<?

  require_once('common-radio.php');
    
  $color = $_GET['color'];
  $size = $_GET['size'];
  $holo = $_GET['holo'];
  
  if (isset($color) && isset($size) && isset($holo)) {
  	$cof = new RadioDisabledOffFocus();
  	$cof->generate_image($color, $size, $holo);
  }
  
?>