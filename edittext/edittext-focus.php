<?

  require_once('common-edittext.php');
    
  $color = $_GET['color'];
  $size = $_GET['size'];
  $holo = $_GET['holo'];

  if (isset($color) && isset($size) && isset($holo)) {
  	$et = new EditTextFocus();
    $et->generate_image($color, $size, $holo);
  }


?>