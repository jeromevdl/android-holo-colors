<?

  require_once('common-button.php');
  
  $color = $_GET['color'];
  $size = $_GET['size'];
  $holo = $_GET['holo'];
  
  if (isset($color) && isset($size) && isset($holo)) {
  	$button = new ButtonDisabledFocus();
  	$button->generate_image($color, $size, $holo);
  }
  

?>