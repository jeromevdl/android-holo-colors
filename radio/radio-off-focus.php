<?

  require_once('common-radio.php');
  
   $color = $_GET['color'];
  $size = $_GET['size'];
  $holo = $_GET['holo'];
  
  if (isset($color) && isset($size) && isset($holo)) {
  	$radio = new RadioOffFocus();
  	$radio->generate_image($color, $size, $holo);
  }

?>