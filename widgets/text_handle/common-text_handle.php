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

$text_handle_classes = array('TextHandleLeft', 'TextHandleMiddle', 'TextHandleRight');

abstract class AbstractTextHandle extends Component
{

    public function generate_image_with_name($image_name, $color, $size, $holo)
    {
        // load picture
        $edittext_img = $this->loadTransparentPNG($image_name, $size);

        // update colors
        $rgb = $this->hex2RGB($color);
        imagefilter($edittext_img, IMG_FILTER_COLORIZE, $rgb['red'], $rgb['green'], $rgb['blue']);

        // add shadow
        $shadow_img = $this->loadTransparentPNG(str_replace(".png", "_shadow.png", $image_name), $size);

        $result = $this->create_dest_image($image_name, $size);

        imagecopy($result[0], $shadow_img, 0, 0, 0, 0, $result[1], $result[2]);
        imagecopy($result[0], $edittext_img, 0, 0, 0, 0, $result[1], $result[2]);

        // output to browser
        if (isset($_GET['action']) && $_GET['action'] == 'display') {
            $this->displayImage($result[0]);
        } else {
            $this->generateImageFile($result[0], $size, $holo);
        }
    }
}

/***************************
 *
 * TextHandleLeft
 *
 ***************************/
class TextHandleLeft extends AbstractTextHandle
{

    function __construct($ctx = "")
    {
        parent:: __construct("text_select_handle_left.png", $ctx);
    }

    function generate_image($color, $size, $holo, $kitkat)
    {
        $this->generate_image_with_name("text_select_handle_left.png", $color, $size, $holo);
    }
}

/***************************
 *
 * EditText activated class
 *
 ***************************/
class TextHandleMiddle extends AbstractTextHandle
{

    function __construct($ctx = "")
    {
        parent:: __construct("text_select_handle_middle.png", $ctx);
    }

    function generate_image($color, $size, $holo, $kitkat)
    {
        $this->generate_image_with_name("text_select_handle_middle.png", $color, $size, $holo);
    }
}

/***************************
 *
 * EditTextFocus class
 *
 ***************************/
class TextHandleRight extends AbstractTextHandle
{

    function __construct($ctx = "")
    {
        parent:: __construct("text_select_handle_right.png", $ctx);
    }

    function generate_image($color, $size, $holo, $kitkat)
    {
        $this->generate_image_with_name("text_select_handle_right.png", $color, $size, $holo);
    }
}

?>