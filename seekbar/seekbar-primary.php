<?

  require_once('common-seekbar.php');
  
  $color = $_GET['color'];
  $size = $_GET['size'];
  $holo = $_GET['holo'];
  
  if (isset($color) && isset($size) && isset($holo)) {
  	$cb = new SeekBarPrimary();
  	$cb->generate_image($color, $size, $holo);
  }
  

?>