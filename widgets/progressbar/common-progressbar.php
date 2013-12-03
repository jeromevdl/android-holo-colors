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

$progressbar_classes = array('ProgressBarPrimary', 'ProgressBarSecondary');

class ProgressBar extends Component
{

    public $_number;

    function __construct($ctx = "", $number)
    {
        parent:: __construct("progressbar_indeterminate_holo" . $number . ".png", $ctx);
        $_number = $number;
    }

    function generate_image($color, $size, $holo, $kitkat)
    {
        // load picture
        $progress_img = $this->loadTransparentPNG($this->_name, $size);

        // update colors
        $rgb = $this->hex2RGB($color);
        imagefilter($progress_img, IMG_FILTER_COLORIZE, $rgb['red'], $rgb['green'], $rgb['blue']);

        // output to browser
        if (isset($_GET['action']) && $_GET['action'] == 'display') {
            $this->displayImage($progress_img);
        } else {
            $this->generateImageFile($progress_img, $size, $holo);
        }
    }
}

class ProgressBarPrimary extends Component
{

    function __construct($ctx = "")
    {
        parent:: __construct("progress_primary_holo_{{holo}}.9.png", $ctx);
    }

    function generate_image($color, $size, $holo, $kitkat)
    {
        $image_name = "progress_primary_holo.png";

        // load picture
        $seekbar_img = $this->loadTransparentPNG($image_name, $size);

        // update colors
        $rgb = $this->hex2RGB($color);
        imagefilter($seekbar_img, IMG_FILTER_COLORIZE, $rgb['red'], $rgb['green'], $rgb['blue']);

        // add nine patch
        $seekbar_nine_patch = $this->loadTransparentPNG("progress_primary_nine_patch.png", $size);

        $result = $this->create_dest_image($image_name, $size);

        imagecopy($result[0], $seekbar_img, 0, 0, 0, 0, $result[1], $result[2]);
        imagecopy($result[0], $seekbar_nine_patch, 0, 0, 0, 0, $result[1], $result[2]);

        // output to browser
        if (isset($_GET['action']) && $_GET['action'] == 'display') {
            $this->displayImage($result[0]);
        } else {
            $this->generateImageFile($result[0], $size, $holo);
        }
    }
}


class ProgressBarSecondary extends Component
{

    function __construct($ctx = "")
    {
        parent:: __construct("progress_secondary_holo_{{holo}}.9.png", $ctx);
    }

    function generate_image($color, $size, $holo, $kitkat)
    {
        $image_name = "progress_secondary_holo.png";

        // load picture
        $seekbar_img = $this->loadTransparentPNG($image_name, $size);

        // update colors
        $rgb = $this->hex2RGB($color);
        imagefilter($seekbar_img, IMG_FILTER_COLORIZE, $rgb['red'], $rgb['green'], $rgb['blue']);

        // add nine patch
        $seekbar_nine_patch = $this->loadTransparentPNG("progress_secondary_nine_patch.png", $size);

        $result = $this->create_dest_image($image_name, $size);

        imagecopy($result[0], $seekbar_img, 0, 0, 0, 0, $result[1], $result[2]);
        imagecopy($result[0], $seekbar_nine_patch, 0, 0, 0, 0, $result[1], $result[2]);

        // output to browser
        if (isset($_GET['action']) && $_GET['action'] == 'display') {
            $this->displayImage($result[0]);
        } else {
            $this->generateImageFile($result[0], $size, $holo);
        }
    }
}

?>