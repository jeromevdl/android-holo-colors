<?

  require_once('common-progressbar.php');

  $color = $_GET['color'];
  $size = $_GET['size'];
  $holo = $_GET['holo'];
  $number = $_GET['number'];

  if (isset($color) && isset($size) && isset($holo) && isset($number)) {
    $et = new ProgressBar("", $number);
    $et->generate_image($color, $size, $holo);
  }

?>