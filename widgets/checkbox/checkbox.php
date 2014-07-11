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


require_once('common-checkbox.php');

$color = $_GET['color'];
$size = $_GET['size'];
$holo = $_GET['holo'];
$kitkat = (bool)$_GET['kitkat'];
$component = $_GET['component'];

if (isset($color) && isset($size) && isset($holo) && isset($component) && isset($kitkat)) {
    switch ($component) {
        case "checkbox":
            $cb = new Checkbox();
            break;
        case "checkbox-off":
            $cb = new CheckboxOff();
            break;
        case "checkbox-off-pressed":
            $cb = new CheckboxOffPress();
            break;
        case "checkbox-on-pressed":
            $cb = new CheckboxOnPress();
            break;
        case "checkbox-off-focus":
            $cb = new CheckboxOffFocus();
            break;
        case "checkbox-on-focus":
            $cb = new CheckboxOnFocus();
            break;
        case "checkbox-on-disabled-focus":
            $cb = new CheckboxDisabledOnFocus();
            break;
        case "checkbox-off-disabled-focus":
            $cb = new CheckboxDisabledOffFocus();
            break;
        default:
            $cb = new Checkbox();
            break;
    }
    $cb->generate_image($color, $size, $holo, $kitkat);
}


?>