<?

  require_once('common-spinnerab.php');

  $color = $_GET['color'];
  $size = $_GET['size'];
  $holo = $_GET['holo'];

  if (isset($color) && isset($size) && isset($holo)) {
    $et = new SpinnerABFocus();
    $et->generate_image($color, $size, $holo);
  }

?>