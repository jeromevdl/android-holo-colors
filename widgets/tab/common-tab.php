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

$tab_classes = array('TabSelected', 'TabSelectedPress', 'TabSelectedFocus', 'TabUnselected', 'TabUnselectedPress', 'TabUnselectedFocus');

/******************************************/
/*             TAB SELECTED               */
/******************************************/
class TabSelected extends Component
{

    function __construct($ctx = "")
    {
        parent:: __construct("tab_selected_holo.9.png", $ctx);
    }

    function generate_image($color, $size, $holo, $kitkat)
    {
        $image_name = "tab_selected_holo.9.png";

        // load picture
        $tab_img = $this->loadTransparentPNG($image_name, $size);

        // update colors
        $rgb = $this->hex2RGB($color);
        imagefilter($tab_img, IMG_FILTER_COLORIZE, $rgb['red'], $rgb['green'], $rgb['blue']);

        // add nine patch
        $border_img = $this->loadTransparentPNG("tab_selected_nine_patch.png", $size);

        $result = $this->create_dest_image($image_name, $size);

        imagecopy($result[0], $tab_img, 0, 0, 0, 0, $result[1], $result[2]);
        imagecopy($result[0], $border_img, 0, 0, 0, 0, $result[1], $result[2]);

        // output to browser
        if (isset($_GET['action']) && $_GET['action'] == 'display') {
            $this->displayImage($result[0]);
        } else {
            $this->generateImageFile($result[0], $size, $holo);
        }
    }
}

/******************************************/
/*         TAB SELECTED PRESS             */
/******************************************/
class TabSelectedPress extends Component
{

    function __construct($ctx = "")
    {
        parent:: __construct("tab_selected_pressed_holo.9.png", $ctx);
    }

    function generate_image($color, $size, $holo, $kitkat)
    {
        $image_name = "tab_selected_pressed_holo.9.png";

        // load picture
        $tab_img = $this->loadTransparentPNG($image_name, $size);

        // update colors
        $rgb = $this->hex2RGB($color);
        imagefilter($tab_img, IMG_FILTER_COLORIZE, $rgb['red'], $rgb['green'], $rgb['blue']);

        // add nine patch
        $border_img = $this->loadTransparentPNG("tab_selected_nine_patch.png", $size);

        $result = $this->create_dest_image($image_name, $size);

        if ($kitkat) {
            $top_img = $this->loadTransparentPNG("tab_selected_pressed_top.png", $size);
        } else {
            $top_img = $this->loadTransparentPNG("tab_selected_pressed_holo_top.png", $size);
            imagefilter($top_img, IMG_FILTER_COLORIZE, $rgb['red'], $rgb['green'], $rgb['blue']);
        }

        imagecopy($result[0], $top_img, 0, 0, 0, 0, $result[1], $result[2]);
        imagecopy($result[0], $tab_img, 0, 0, 0, 0, $result[1], $result[2]);
        imagecopy($result[0], $border_img, 0, 0, 0, 0, $result[1], $result[2]);

        // output to browser
        if (isset($_GET['action']) && $_GET['action'] == 'display') {
            $this->displayImage($result[0]);
        } else {
            $this->generateImageFile($result[0], $size, $holo);
        }
    }
}

/******************************************/
/*         TAB SELECTED FOCUS             */
/******************************************/
class TabSelectedFocus extends Component
{

    function __construct($ctx = "")
    {
        parent:: __construct("tab_selected_focused_holo.9.png", $ctx);
    }

    function generate_image($color, $size, $holo, $kitkat)
    {
        $image_name = "tab_selected_focused_holo.9.png";

        // load picture
        $tab_img = $this->loadTransparentPNG($image_name, $size);

        // update colors
        $rgb = $this->hex2RGB($color);
        imagefilter($tab_img, IMG_FILTER_COLORIZE, $rgb['red'], $rgb['green'], $rgb['blue']);

        // add nine patch
        $border_img = $this->loadTransparentPNG("tab_selected_nine_patch.png", $size);

        $result = $this->create_dest_image($image_name, $size);

        imagecopy($result[0], $tab_img, 0, 0, 0, 0, $result[1], $result[2]);
        imagecopy($result[0], $border_img, 0, 0, 0, 0, $result[1], $result[2]);

        // output to browser
        if (isset($_GET['action']) && $_GET['action'] == 'display') {
            $this->displayImage($result[0]);
        } else {
            $this->generateImageFile($result[0], $size, $holo);
        }
    }
}

/******************************************/
/*           TAB UNSELECTED               */
/******************************************/
class TabUnselected extends Component
{

    function __construct($ctx = "")
    {
        parent:: __construct("tab_unselected_holo.9.png", $ctx);
    }

    function generate_image($color, $size, $holo, $kitkat)
    {
        $image_name = "tab_unselected_holo.9.png";

        // load picture
        $tab_img = $this->loadTransparentPNG($image_name, $size);

        // update colors
        $rgb = $this->hex2RGB($color);
        imagefilter($tab_img, IMG_FILTER_COLORIZE, $rgb['red'], $rgb['green'], $rgb['blue']);

        // add nine patch
        $border_img = $this->loadTransparentPNG("tab_unselected_nine_patch.png", $size);

        $result = $this->create_dest_image($image_name, $size);

        imagecopy($result[0], $tab_img, 0, 0, 0, 0, $result[1], $result[2]);
        imagecopy($result[0], $border_img, 0, 0, 0, 0, $result[1], $result[2]);

        // output to browser
        if (isset($_GET['action']) && $_GET['action'] == 'display') {
            $this->displayImage($result[0]);
        } else {
            $this->generateImageFile($result[0], $size, $holo);
        }
    }
}

/******************************************/
/*       TAB UNSELECTED PRESS             */
/******************************************/
class TabUnselectedPress extends Component
{

    function __construct($ctx = "")
    {
        parent:: __construct("tab_unselected_pressed_holo.9.png", $ctx);
    }

    function generate_image($color, $size, $holo, $kitkat)
    {
        $image_name = "tab_unselected_pressed_holo.9.png";

        // load picture
        $tab_img = $this->loadTransparentPNG($image_name, $size);

        // update colors
        $rgb = $this->hex2RGB($color);
        imagefilter($tab_img, IMG_FILTER_COLORIZE, $rgb['red'], $rgb['green'], $rgb['blue']);

        // add nine patch
        $border_img = $this->loadTransparentPNG("tab_unselected_nine_patch.png", $size);

        $result = $this->create_dest_image($image_name, $size);

        if ($kitkat) {
            $top_img = $this->loadTransparentPNG("tab_unselected_pressed_top.png", $size);
        } else {
            $top_img = $this->loadTransparentPNG("tab_unselected_pressed_holo_top.png", $size);
            imagefilter($top_img, IMG_FILTER_COLORIZE, $rgb['red'], $rgb['green'], $rgb['blue']);
        }

        imagecopy($result[0], $top_img, 0, 0, 0, 0, $result[1], $result[2]);
        imagecopy($result[0], $tab_img, 0, 0, 0, 0, $result[1], $result[2]);
        imagecopy($result[0], $border_img, 0, 0, 0, 0, $result[1], $result[2]);

        // output to browser
        if (isset($_GET['action']) && $_GET['action'] == 'display') {
            $this->displayImage($result[0]);
        } else {
            $this->generateImageFile($result[0], $size, $holo);
        }
    }
}

/******************************************/
/*       TAB UNSELECTED FOCUS             */
/******************************************/
class TabUnselectedFocus extends Component
{

    function __construct($ctx = "")
    {
        parent:: __construct("tab_unselected_focused_holo.9.png", $ctx);
    }

    function generate_image($color, $size, $holo, $kitkat)
    {
        $image_name = "tab_unselected_focused_holo.9.png";

        // load picture
        $tab_img = $this->loadTransparentPNG($image_name, $size);

        // update colors
        $rgb = $this->hex2RGB($color);
        imagefilter($tab_img, IMG_FILTER_COLORIZE, $rgb['red'], $rgb['green'], $rgb['blue']);

        // add nine patch
        $border_img = $this->loadTransparentPNG("tab_unselected_nine_patch.png", $size);

        $result = $this->create_dest_image($image_name, $size);

        imagecopy($result[0], $tab_img, 0, 0, 0, 0, $result[1], $result[2]);
        imagecopy($result[0], $border_img, 0, 0, 0, 0, $result[1], $result[2]);

        // output to browser
        if (isset($_GET['action']) && $_GET['action'] == 'display') {
            $this->displayImage($result[0]);
        } else {
            $this->generateImageFile($result[0], $size, $holo);
        }
    }
}


?>