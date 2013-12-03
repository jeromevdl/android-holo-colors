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

$button_classes = array('Button', 'ButtonFocus', 'ButtonPress', 'ButtonDisabledFocus');

/********************************************/
/*                 BUTTON                 */
/********************************************/
class Button extends Component
{

    function __construct($ctx = "")
    {
        parent:: __construct("btn_default_normal_holo_{{holo}}.9.png", $ctx);
    }

    function generate_image($color, $size, $holo, $kitkat)
    {
        $image_name = "btn_default_normal_holo.png";

        // load picture
        $button_img = $this->loadTransparentPNG($image_name, $size);

        // output to browser
        if (isset($_GET['action']) && $_GET['action'] == 'display') {
            $this->displayImage($button_img);
        } else {
            $this->generateImageFile($button_img, $size, $holo);
        }
    }
}

/************************************************/
/*                 BUTTON FOCUS                 */
/***********************************************/
class ButtonFocus extends Component
{

    function __construct($ctx = "")
    {
        parent:: __construct("btn_default_focused_holo_{{holo}}.9.png", $ctx);
    }

    function generate_image($color, $size, $holo, $kitkat)
    {
        $image_name = "btn_default_focused_holo.png";

        // load picture
        $button_img = $this->loadTransparentPNG($image_name, $size);

        // update colors
        $rgb = $this->hex2RGB($color);
        imagefilter($button_img, IMG_FILTER_COLORIZE, $rgb['red'], $rgb['green'], $rgb['blue']);

        // add nine patch
        $nine_patch_img = $this->loadTransparentPNG("nine_patch.png", $size);

        // add border
        $border_img = $this->loadTransparentPNG("btn_border_shadow.png", $size);

        $result = $this->create_dest_image($image_name, $size);

        imagecopy($result[0], $button_img, 0, 0, 0, 0, $result[1], $result[2]);
        imagecopy($result[0], $nine_patch_img, 0, 0, 0, 0, $result[1], $result[2]);
        imagecopy($result[0], $border_img, 0, 0, 0, 0, $result[1], $result[2]);

        // output to browser
        if (isset($_GET['action']) && $_GET['action'] == 'display') {
            $this->displayImage($result[0]);
        } else {
            $this->generateImageFile($result[0], $size, $holo);
        }
    }
}

/************************************************/
/*         BUTTON DISABLED FOCUS               */
/***********************************************/
class ButtonDisabledFocus extends Component
{

    function __construct($ctx = "")
    {
        parent:: __construct("btn_default_disabled_focused_holo_{{holo}}.9.png", $ctx);
    }

    function generate_image($color, $size, $holo, $kitkat)
    {
        $image_name = "btn_default_disabled_focused_holo.png";

        // load picture
        $button_img = $this->loadTransparentPNG($image_name, $size);

        // update colors
        $rgb = $this->hex2RGB($color);
        imagefilter($button_img, IMG_FILTER_COLORIZE, $rgb['red'], $rgb['green'], $rgb['blue']);

        // add ninepatch
        $nine_img = $this->loadTransparentPNG("nine_patch.png", $size);

        $result = $this->create_dest_image($image_name, $size);

        imagecopy($result[0], $button_img, 0, 0, 0, 0, $result[1], $result[2]);
        imagecopy($result[0], $nine_img, 0, 0, 0, 0, $result[1], $result[2]);

        // output to browser
        if (isset($_GET['action']) && $_GET['action'] == 'display') {
            $this->displayImage($result[0]);
        } else {
            $this->generateImageFile($result[0], $size, $holo);
        }
    }
}


/************************************************/
/*                 BUTTON PRESS                 */
/***********************************************/
class ButtonPress extends Component
{

    function __construct($ctx = "")
    {
        parent:: __construct("btn_default_pressed_holo_{{holo}}.9.png", $ctx);
    }

    function generate_image($color, $size, $holo, $kitkat)
    {

        if ($kitkat) {
            $image_name = "btn_default_pressed_holo_" . $holo . ".png";
        } else {
            $image_name = "btn_default_pressed_holo.png";
        }

        // load picture
        $button_img = $this->loadTransparentPNG($image_name, $size);

        if ($kitkat) {
            $result = $this->create_dest_image($image_name, $size);
            imagecopy($result[0], $button_img, 0, 0, 0, 0, $result[1], $result[2]);

        } else {

            // update colors
            $rgb = $this->hex2RGB($color);
            imagefilter($button_img, IMG_FILTER_COLORIZE, $rgb['red'], $rgb['green'], $rgb['blue']);

            // add ninepatch
            $nine_patch_img = $this->loadTransparentPNG("nine_patch.png", $size);

            // add border
            $border_img = $this->loadTransparentPNG("btn_border_shadow.png", $size);

            $result = $this->create_dest_image($image_name, $size);

            imagecopy($result[0], $button_img, 0, 0, 0, 0, $result[1], $result[2]);
            imagecopy($result[0], $nine_patch_img, 0, 0, 0, 0, $result[1], $result[2]);
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