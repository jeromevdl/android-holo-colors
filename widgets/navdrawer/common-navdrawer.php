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


if (!isset($context))
    $context = "../../";

require_once($context . 'common.php');

$navdrawer_classes = array('NavDrawer');

/********************************************/
/*                 NavDrawer                */
/********************************************/
class NavDrawer extends Component
{

    function __construct($ctx = "")
    {
        parent:: __construct("ic_navigation_drawer.png", $ctx);
    }

    function generate_image($color, $size, $holo, $kitkat)
    {
        $image_name = "ic_navigation_drawer.png";

        // load picture
        $nav_img = $this->loadTransparentPNG($image_name, $size);

        // update colors
        $rgb = $this->hex2RGB($color);
        imagefilter($nav_img, IMG_FILTER_COLORIZE, $rgb['red'], $rgb['green'], $rgb['blue']);

        // output to browser
        if (isset($_GET['action']) && $_GET['action'] == 'display') {
            $this->displayImage($nav_img);
        } else {
            $this->generateImageFile($nav_img, $size, $holo);
        }
    }
}

?>