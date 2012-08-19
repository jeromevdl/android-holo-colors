<?

  require_once('common-seekbar.php');
  
  $color = $_GET['color'];
  $size = $_GET['size'];
  $holo = $_GET['holo'];
  
  if (isset($color) && isset($size) && isset($holo)) {
  	$cb = new SeekBarDisabled();
  	$cb->generate_image($color, $size, $holo);
  }
  

?>