<?
  if (!isset($context)) {
    $context = "../../";
  	require_once('../ratingstarbig/common-ratingstarbig.php');
  } 
  else {
  	require_once('widgets/ratingstarbig/common-ratingstarbig.php');
  }
  
  $ratingbarsmall_classes = array('RatingStarSmall', 'RatingStarSmallHalf');
  
  
  /********************************************/
  /*           RATINGBAR NORMAL             */
  /********************************************/
  class RatingStarSmall extends RatingStarBig {
  	
  	function __construct($ctx="") {
  		parent:: __construct($ctx);
  		$this->_name = "rate_star_small_on_holo_{{holo}}.png";
  	}
  	
  }
  
  /********************************************/
  /*           RATINGBAR NORMAL HALF           */
  /********************************************/
  class RatingStarSmallHalf extends RatingStarBigHalf {
  	
  	function __construct($ctx="") {
  		parent:: __construct($ctx);
  		$this->_name = "rate_star_small_half_holo_{{holo}}.png";
  	}
 
  }
 
  
?>