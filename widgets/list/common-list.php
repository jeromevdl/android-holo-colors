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

$list_classes = array('ListFocus', 'ListPress', 'ListLongPress', 'ListActivated');


/********************************************/
/*                 LIST FOCUS                */
/********************************************/
class ListFocus extends Component
{

    function __construct($ctx = "")
    {
        parent:: __construct("list_focused_holo.9.png", $ctx);
    }

    function generate_image($color, $size, $holo, $kitkat)
    {
        $image_name = "list_focused_holo.png";

        // load picture
        $list_img = $this->loadTransparentPNG($image_name, $size);

        // update colors
        $rgb = $this->hex2RGB($color);
        imagefilter($list_img, IMG_FILTER_COLORIZE, $rgb['red'], $rgb['green'], $rgb['blue']);

        // add nine patch
        $border_img = $this->loadTransparentPNG("list_nine_patch.png", $size);

        $result = $this->create_dest_image($image_name, $size);

        imagecopy($result[0], $list_img, 0, 0, 0, 0, $result[1], $result[2]);
        imagecopy($result[0], $border_img, 0, 0, 0, 0, $result[1], $result[2]);

        // output to browser
        if (isset($_GET['action']) && $_GET['action'] == 'display') {
            $this->displayImage($result[0]);
        } else {
            $this->generateImageFile($result[0], $size, $holo);
        }
    }
}

/********************************************/
/*            LIST ACTIVATED                */
/********************************************/
class ListActivated extends Component
{
    function __construct($ctx = "")
    {
        parent:: __construct("list_activated_holo.9.png", $ctx);
    }

    function generate_image($color, $size, $holo, $kitkat)
    {
        $image_name = "list_activated_holo.9.png";

        // load picture
        $list_img = $this->loadTransparentPNG($image_name, $size);

        // update colors
        $rgb = $this->hex2RGB($color);
        imagefilter($list_img, IMG_FILTER_COLORIZE, $rgb['red'], $rgb['green'], $rgb['blue']);

        // add nine patch
        $border_img = $this->loadTransparentPNG("list_nine_patch.png", $size);

        $result = $this->create_dest_image($image_name, $size);

        imagecopy($result[0], $list_img, 0, 0, 0, 0, $result[1], $result[2]);
        imagecopy($result[0], $border_img, 0, 0, 0, 0, $result[1], $result[2]);

        // output to browser
        if (isset($_GET['action']) && $_GET['action'] == 'display') {
            $this->displayImage($result[0]);
        } else {
            $this->generateImageFile($result[0], $size, $holo);
        }
    }
}

/********************************************/
/*                 LIST PRESS                */
/********************************************/
class ListPress extends Component
{

    function __construct($ctx = "")
    {
        parent:: __construct("list_pressed_holo_{{holo}}.9.png", $ctx);
    }

    function generate_image($color, $size, $holo, $kitkat)
    {
        if ($kitkat) {
            $image_name = "list_pressed_holo_" . $holo . ".9.png";
        } else {
            $image_name = "list_pressed_holo.png";
        }

        // load picture
        $list_img = $this->loadTransparentPNG($image_name, $size);

        if ($kitkat) {
            $result = $this->create_dest_image($image_name, $size);
            imagecopy($result[0], $list_img, 0, 0, 0, 0, $result[1], $result[2]);

        } else {
            // update colors
            $rgb = $this->hex2RGB($color);
            imagefilter($list_img, IMG_FILTER_COLORIZE, $rgb['red'], $rgb['green'], $rgb['blue']);

            // add nine patch
            $border_img = $this->loadTransparentPNG("list_nine_patch.png", $size);

            $result = $this->create_dest_image($image_name, $size);

            imagecopy($result[0], $list_img, 0, 0, 0, 0, $result[1], $result[2]);
            imagecopy($result[0], $border_img, 0, 0, 0, 0, $result[1], $result[2]);
        }

        // output to browser
        if (isset($_GET['action']) && $_GET['action'] == 'display') {
            $this->displayImage($result[0]);
        } else {
            $this->generateImageFile($result[0], $size, $holo);
        }
    }
}

/********************************************/
/*            LIST LONG PRESS               */
/********************************************/
class ListLongPress extends Component
{

    function __construct($ctx = "")
    {
        parent:: __construct("list_longpressed_holo.9.png", $ctx);
    }

    function generate_image($color, $size, $holo, $kitkat)
    {
        if ($kitkat) {
            $image_name = "list_longpressed_holo_" . $holo . ".9.png";
        } else {
            $image_name = "list_longpressed_holo.png";
        }

        // load picture
        $list_img = $this->loadTransparentPNG($image_name, $size);

        if ($kitkat) {
            $result = $this->create_dest_image($image_name, $size);
            imagecopy($result[0], $list_img, 0, 0, 0, 0, $result[1], $result[2]);

        } else {
            // update colors
            $rgb = $this->hex2RGB($color);
            imagefilter($list_img, IMG_FILTER_COLORIZE, $rgb['red'], $rgb['green'], $rgb['blue']);

            // add nine patch
            $border_img = $this->loadTransparentPNG("list_nine_patch.png", $size);

            $result = $this->create_dest_image($image_name, $size);

            imagecopy($result[0], $list_img, 0, 0, 0, 0, $result[1], $result[2]);
            imagecopy($result[0], $border_img, 0, 0, 0, 0, $result[1], $result[2]);
        }

        // output to browser
        if (isset($_GET['action']) && $_GET['action'] == 'display') {
            $this->displayImage($result[0]);
        } else {
            $this->generateImageFile($result[0], $size, $holo);
        }
    }
}

?>