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

$edittext_classes = array('EditText', 'EditTextActivate', 'EditTextFocus');

abstract class AbstractEditText extends Component
{

    public function generate_image_with_name($image_name, $color, $size, $holo)
    {
        // load picture
        $edittext_img = $this->loadTransparentPNG($image_name, $size);

        // update colors
        $rgb = $this->hex2RGB($color);
        imagefilter($edittext_img, IMG_FILTER_COLORIZE, $rgb['red'], $rgb['green'], $rgb['blue']);

        // add nine patch
        $nine_img = $this->loadTransparentPNG("nine_patch.png", $size);

        $result = $this->create_dest_image($image_name, $size);

        imagecopy($result[0], $edittext_img, 0, 0, 0, 0, $result[1], $result[2]);
        imagecopy($result[0], $nine_img, 0, 0, 0, 0, $result[1], $result[2]);


        // output to browser
        if (isset($_GET['action']) && $_GET['action'] == 'display') {
            $this->displayImage($result[0]);
        } else {
            $this->generateImageFile($result[0], $size, $holo);
        }
    }
}

/********************************************/
/*                 EditText                */
/********************************************/
class EditText extends Component
{

    function __construct($ctx = "")
    {
        parent:: __construct("textfield_default_holo_{{holo}}.9.png", $ctx);
    }

    function generate_image($color, $size, $holo, $kitkat)
    {
        $image_name = "textfield_default_holo_" . $holo . ".9.png";

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

/***************************
 *
 * EditText activated class
 *
 ***************************/
class EditTextActivate extends AbstractEditText
{

    function __construct($ctx = "")
    {
        parent:: __construct("textfield_activated_holo_{{holo}}.9.png", $ctx);
    }

    function generate_image($color, $size, $holo, $kitkat)
    {
        $this->generate_image_with_name("textfield_activated_holo.png", $color, $size, $holo);
    }
}

/***************************
 *
 * EditTextFocus class
 *
 ***************************/
class EditTextFocus extends AbstractEditText
{

    function __construct($ctx = "")
    {
        parent:: __construct("textfield_focused_holo_{{holo}}.9.png", $ctx);
    }

    function generate_image($color, $size, $holo, $kitkat)
    {
        $this->generate_image_with_name("textfield_focused_holo.png", $color, $size, $holo);
    }
}


?>