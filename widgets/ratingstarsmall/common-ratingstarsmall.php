<?

/**
 * Copyright 2013 Android Holo Colors by Jérôme Van Der Linden
 * Copyright 2010 Android Asset Studio by Google Inc
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

if (!isset($context)) {
    $context = "../../";
    require_once('../ratingstarbig/common-ratingstarbig.php');
} else {
    require_once('widgets/ratingstarbig/common-ratingstarbig.php');
}

$ratingbarsmall_classes = array('RatingStarSmall', 'RatingStarSmallHalf');


/********************************************/
/*           RATINGBAR NORMAL             */
/********************************************/
class RatingStarSmall extends RatingStarBig
{

    function __construct($ctx = "")
    {
        parent:: __construct($ctx);
        $this->_name = "rate_star_small_on_holo_{{holo}}.png";
    }

}

/********************************************/
/*           RATINGBAR NORMAL HALF           */
/********************************************/
class RatingStarSmallHalf extends RatingStarBigHalf
{

    function __construct($ctx = "")
    {
        parent:: __construct($ctx);
        $this->_name = "rate_star_small_half_holo_{{holo}}.png";
    }

}


?>