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

session_start();
if (!isset($_SESSION['id'])) {
    $_SESSION = array();
    $_SESSION['id'] = uniqid('', true);
}

$context = "./";

include_once('include/php/log4php/Logger.php');
Logger::configure('log4php.xml');
$logger = Logger::getLogger("generate_all");


$name = $_GET['name'];
$name = preg_replace('/\s+/', '', $name);
$lower_name = strtolower($name);
$color = $_GET['color'];
$holo = $_GET['holo'];
$kitkat = $_GET['kitkat'];
$minsdk = $_GET['minsdk'];
$compat = $_GET['compat'];

$edittext = $_GET['edittext'];
$text_handle = $_GET['text_handle'];
$checkbox = $_GET['checkbox'];
$radio = $_GET['radio'];
$button = $_GET['button'];
$cbutton = $_GET['cbutton'];
$spinner = $_GET['spinner'];
$cspinner = $_GET['cspinner'];
$progressbar = $_GET['progressbar'];
$ratingbar = $_GET['ratingbar'];
$ratingstarsmall = $_GET['ratingstarsmall'];
$ratingstarbig = $_GET['ratingstarbig'];
$seekbar = $_GET['seekbar'];
$toggle = $_GET['toggle'];
$list = $_GET['list'];
$fastscroll = $_GET['fastscroll'];
$search = $_GET['search'];
$numberpicker = $_GET['numberpicker'];
$switch = $_GET['switch'];
$switchjb = $_GET['switchjb'];
$autocomplete = $_GET['autocomplete'];
$tab = $_GET['tab'];
$navdrawer = $_GET['navdrawer'];

$origin = $_GET['origin'];
// TODO : temporary while plugin is not updated with origin
if (!isset($origin)) {
    $origin = "idea";
}

include_once("database.php");
update_stats($origin);

if (strlen($color) == 3) {
    $color2 = $color[0] . $color[0] . $color[1] . $color[1] . $color[2] . $color[2];
    $color = $color2;
}

$style = '<?xml version="1.0" encoding="utf-8"?>' . "\n\n";
$style .= "<!-- Generated with http://android-holo-colors.com -->\n";
$style .= '<resources xmlns:android="http://schemas.android.com/apk/res/android">' . "\n\n";

$stylev11 = $style;
$stylev8 = $style;

$style8_available = false;
$style11_available = false;
$style14_available = false;

$themev11 = $style . '  <style name="' . $name . '" parent="@style/_' . $name . '"/>' . "\n\n";
$themev9 = $style . '  <style name="' . $name . '" parent="@style/_' . $name . '">' . "\n\n";
$themev8 = $style . '  <style name="' . $name . '" parent="@style/_' . $name . '"/>' . "\n\n";

$themev8_available = ($minsdk == 'old');
$themev9_available = (isset($text_handle) && $text_handle == true);
$themev11_available = true;

if ($holo == 'light') {
    if ($minsdk == 'old' && $compat == 'compat') {
        $themev11 .= '  <style name="_' . $name . '" parent="Theme.AppCompat.Light">' . "\n\n";
        $themev8 .= '  <style name="_' . $name . '" parent="Theme.AppCompat.Light">' . "\n\n";
    } else if ($minsdk == 'old' && $compat == 'holoeverywhere') {
        $themev11_available = false;
        $style11_available = false;
        $themev8 .= '  <style name="_' . $name . '" parent="Holo.Theme.Light">' . "\n\n";
    } else if ($minsdk == 'old' && $compat == 'abs') {
        $themev11 .= '  <style name="_' . $name . '" parent="android:Theme.Holo.Light">' . "\n\n";
        $themev8 .= '  <style name="_' . $name . '" parent="Theme.Sherlock.Light">' . "\n\n";
    } else {
        $themev11 .= '  <style name="_' . $name . '" parent="android:Theme.Holo.Light">' . "\n\n";
        $themev8 .= '  <style name="_' . $name . '" parent="android:Theme.Light">' . "\n\n";
    }
} else if ($holo == 'light_dark_action_bar') {
    if ($minsdk == 'old' && $compat == 'compat') {
        $themev11 .= '  <style name="_' . $name . '" parent="Theme.AppCompat.Light.DarkActionBar">' . "\n\n";
        $themev8 .= '  <style name="_' . $name . '" parent="Theme.AppCompat.Light.DarkActionBar">' . "\n\n";
    } else if ($minsdk == 'old' && $compat == 'holoeverywhere') {
        $themev11_available = false;
        $style11_available = false;
        $themev8 .= '  <style name="_' . $name . '" parent="Holo.Theme.Light.DarkActionBar">' . "\n\n";
    } else if ($minsdk == 'old' && $compat == 'abs') {
        $themev11 .= '  <style name="_' . $name . '" parent="android:Theme.Holo.Light.DarkActionBar">' . "\n\n";
        $themev8 .= '  <style name="_' . $name . '" parent="Theme.Sherlock.Light.DarkActionBar">' . "\n\n";
    } else {
        $themev11 .= '  <style name="_' . $name . '" parent="android:Theme.Holo.Light.DarkActionBar">' . "\n\n";
        $themev8 .= '  <style name="_' . $name . '" parent="android:Theme.Light">' . "\n\n";
    }
    $holo = "light";
} else {
    if ($minsdk == 'old' && $compat == 'compat') {
        $themev11 = $style . '  <style name="' . $name . '" parent="Theme.AppCompat">' . "\n\n";
        $themev8 = $style . '  <style name="' . $name . '" parent="Theme.AppCompat">' . "\n\n";
    } else if ($minsdk == 'old' && $compat == 'holoeverywhere') {
        $themev11_available = false;
        $style11_available = false;
        $themev8 = $style . '  <style name="' . $name . '" parent="Holo.Theme">' . "\n\n";
    } else if ($minsdk == 'old' && $compat == 'abs') {
        $themev11 = $style . '  <style name="' . $name . '" parent="android:Theme.Holo">' . "\n\n";
        $themev8 = $style . '  <style name="' . $name . '" parent="Theme.Sherlock">' . "\n\n";
    } else {
        $themev11 = $style . '  <style name="' . $name . '" parent="android:Theme.Holo">' . "\n\n";
        $themev8 = $style . '  <style name="' . $name . '" parent="android:Theme.Black">' . "\n\n";
    }
}

// empty input
$_GET = array();

// empty folders
date_default_timezone_set('UTC');
$date = date("Ymd");
$root_folder = getcwd() . "/generated/" . $date . "/" . $_SESSION['id'];
if (file_exists($root_folder . ".zip")) {
    unlink($root_folder . ".zip");
}
rrmdir($root_folder);

date_default_timezone_set('UTC');
$date = date("Ymd");
$folder = getcwd() . "/generated/" . $date . "/" . $_SESSION['id'];

generateFolders($date, $themev8_available, $themev9_available, $themev11_available);


// ============== edittext =================== //
if (isset($edittext) && $edittext == true) {
    require_once('widgets/edittext/common-edittext.php');
    $logger->debug("generate edittext");

    foreach ($edittext_classes as $clazz) {
        generateImageOnDisk($clazz, $color, $holo, $kitkat, "widgets/edittext/");
    }

    copy_directory("widgets/edittext/res/", $folder . "/res/", $holo, $lower_name);

    $stylev8 .= '  <style name="EditText' . $name . '" parent="android:Widget.EditText">' . "\n";
    $stylev8 .= '	  <item name="android:background">@drawable/' . $lower_name . '_edit_text_holo_' . $holo . '</item>' . "\n";
    // TODO replace with selector
    if ($holo == "dark") {
        $stylev8 .= '	  <item name="android:textColor">#ffffff</item>' . "\n";
    } else {
        $stylev8 .= '	  <item name="android:textColor">#000000</item>' . "\n";
    }
    $stylev8 .= '  </style>' . "\n\n";

    $style8_available = true;

    $themev11 .= '    <item name="android:editTextBackground">@drawable/' . $lower_name . '_edit_text_holo_' . $holo . '</item>' . "\n\n";
    $themev8 .= '    <item name="android:editTextStyle">@style/EditText' . $name . '</item>' . "\n\n";

}

// ================= text_handle ================= //
if (isset($text_handle) && $text_handle == true) {
    require_once('widgets/text_handle/common-text_handle.php');
    $logger->debug("generate text handle");

    foreach ($text_handle_classes as $clazz) {
        generateImageOnDisk($clazz, $color, $holo, $kitkat, "widgets/text_handle/");
    }

    $themev11 .= '    <item name="android:textColorHighlight">#99' . $color . '</item>' . "\n";
    $themev11 .= '    <item name="android:textSelectHandleLeft">@drawable/' . $lower_name . '_text_select_handle_left</item>' . "\n";
    $themev11 .= '    <item name="android:textSelectHandleRight">@drawable/' . $lower_name . '_text_select_handle_right</item>' . "\n";
    $themev11 .= '    <item name="android:textSelectHandle">@drawable/' . $lower_name . '_text_select_handle_middle</item>' . "\n\n";

    $themev8 .= '    <item name="android:textColorHighlight">#99' . $color . '</item>' . "\n\n";
    $themev9 .= '    <item name="android:textSelectHandleLeft">@drawable/' . $lower_name . '_text_select_handle_left</item>' . "\n";
    $themev9 .= '    <item name="android:textSelectHandleRight">@drawable/' . $lower_name . '_text_select_handle_right</item>' . "\n";
    $themev9 .= '    <item name="android:textSelectHandle">@drawable/' . $lower_name . '_text_select_handle_middle</item>' . "\n\n";

}

// ============== autocomplete =================== //
if (isset($autocomplete) && $autocomplete == true) {

    $logger->debug("generate autocomplete");

    if (!isset($edittext)) {
        require_once('widgets/edittext/common-edittext.php');
        foreach ($edittext_classes as $clazz) {
            generateImageOnDisk($clazz, $color, $holo, $kitkat, "widgets/edittext/");
        }
        copy_directory("widgets/edittext/res/", $folder . "/res/", $holo, $lower_name);
    }

    if (!isset($list)) {
        require_once('widgets/list/common-list.php');
        foreach ($list_classes as $clazz) {
            generateImageOnDisk($clazz, $color, $holo, $kitkat, "widgets/list/");
        }
        copy_directory("widgets/list/res/", $folder . "/res/", $holo, $lower_name);
    }

    if ($holo == "dark") {
        $stylev11 .= '  <style name="AutoCompleteTextView' . $name . '" parent="android:Widget.Holo.AutoCompleteTextView">' . "\n";
    } else {
        $stylev11 .= '  <style name="AutoCompleteTextView' . $name . '" parent="android:Widget.Holo.Light.AutoCompleteTextView">' . "\n";
    }
    $stylev11 .= '      <item name="android:dropDownSelector">@drawable/' . $lower_name . '_list_selector_holo_' . $holo . '</item>' . "\n";
    $stylev11 .= '	    <item name="android:background">@drawable/' . $lower_name . '_edit_text_holo_' . $holo . '</item>' . "\n";
    $stylev11 .= '  </style>' . "\n\n";

    $stylev8 .= '  <style name="AutoCompleteTextView' . $name . '" parent="android:Widget.AutoCompleteTextView">' . "\n";
    $stylev8 .= '      <item name="android:dropDownSelector">@drawable/' . $lower_name . '_list_selector_holo_' . $holo . '</item>' . "\n";
    $stylev8 .= '	  <item name="android:background">@drawable/' . $lower_name . '_edit_text_holo_' . $holo . '</item>' . "\n";
    // TODO replace with selector
    if ($holo == "dark") {
        $stylev8 .= '	  <item name="android:textColor">#ffffff</item>' . "\n";
    } else {
        $stylev8 .= '	  <item name="android:textColor">#000000</item>' . "\n";
    }
    $stylev8 .= '  </style>' . "\n\n";

    $themev11 .= '    <item name="android:autoCompleteTextViewStyle">@style/AutoCompleteTextView' . $name . '</item>' . "\n\n";
    $themev8 .= '    <item name="android:autoCompleteTextViewStyle">@style/AutoCompleteTextView' . $name . '</item>' . "\n\n";

    $style11_available = true;
    $style8_available = true;
}

// ============== checkbox =================== //
if (isset($checkbox) && $checkbox == true) {
    require_once('widgets/checkbox/common-checkbox.php');
    $logger->debug("generate checkbox");

    foreach ($checkbox_classes as $clazz) {
        generateImageOnDisk($clazz, $color, $holo, $kitkat, "widgets/checkbox/");
    }

    copy_directory("widgets/checkbox/res/", $folder . "/res/", $holo, $lower_name);

    $stylev8 .= '  <style name="CheckBox' . $name . '" parent="android:Widget.CompoundButton.CheckBox">' . "\n";
    $stylev8 .= '      <item name="android:button">@drawable/' . $lower_name . '_btn_check_holo_' . $holo . '</item>' . "\n";
    $stylev8 .= '  </style>' . "\n\n";

    $style8_available = true;

    $themev11 .= '    <item name="android:listChoiceIndicatorMultiple">@drawable/' . $lower_name . '_btn_check_holo_' . $holo . '</item>' . "\n\n";
    $themev8 .= '    <item name="android:checkboxStyle">@style/CheckBox' . $name . '</item>' . "\n\n";
}

// ============== radio =================== //
// spinner before v11 needs radio button in the dropdown
if ((isset($radio) && $radio == true) || ((isset($spinner) && $spinner == true) || (isset($cspinner) && $cspinner == true))) {
    require_once('widgets/radio/common-radio.php');
    $logger->debug("generate radio");


    foreach ($radio_classes as $clazz) {
        generateImageOnDisk($clazz, $color, $holo, $kitkat, "widgets/radio/");
    }

    copy_directory("widgets/radio/res/", $folder . "/res/", $holo, $lower_name);

    if (isset($radio) && $radio == true) {
        $stylev8 .= '  <style name="RadioButton' . $name . '" parent="android:Widget.CompoundButton.RadioButton">' . "\n";
        $stylev8 .= '      <item name="android:button">@drawable/' . $lower_name . '_btn_radio_holo_' . $holo . '</item>' . "\n";
        $stylev8 .= '  </style>' . "\n\n";

        $style8_available = true;

        $themev11 .= '    <item name="android:listChoiceIndicatorSingle">@drawable/' . $lower_name . '_btn_radio_holo_' . $holo . '</item>' . "\n\n";
        $themev8 .= '    <item name="android:radioButtonStyle">@style/RadioButton' . $name . '</item>' . "\n\n";
    }
}

// ============== button =================== //
if ((isset($button) && $button == true) || (isset($cbutton) && $cbutton == true)) {
    if ((isset($button) && $button == true) && (!isset($cbutton))) {
        require_once('widgets/button/common-button.php');
        $logger->debug("generate button");

        foreach ($button_classes as $clazz) {
            generateImageOnDisk($clazz, $color, $holo, $kitkat, "widgets/button/");
        }

        copy_directory("widgets/button/res/", $folder . "/res/", $holo, $lower_name);
    } else {
        require_once('widgets/cbutton/common-cbutton.php');
        $logger->debug("generate cbutton");

        foreach ($cbutton_classes as $clazz) {
            generateImageOnDisk($clazz, $color, $holo, $kitkat, "widgets/cbutton/");
        }

        copy_directory("widgets/cbutton/res/", $folder . "/res/", $holo, $lower_name);
    }

    if ($holo == "dark") {
        $stylev11 .= '  <style name="Button' . $name . '" parent="android:Widget.Holo.Button">' . "\n";
        $stylev11 .= '	  <item name="android:background">@drawable/' . $lower_name . '_btn_default_holo_dark</item>' . "\n";
        $stylev11 .= '  </style>' . "\n\n";

        $stylev11 .= '  <style name="ImageButton' . $name . '" parent="android:Widget.Holo.ImageButton">' . "\n";
        $stylev11 .= '	  <item name="android:background">@drawable/' . $lower_name . '_btn_default_holo_dark</item>' . "\n";
        $stylev11 .= '  </style>' . "\n\n";

        $button_image = "btn_default_holo_dark";
    } else {
        $stylev11 .= '  <style name="Button' . $name . '" parent="android:Widget.Holo.Light.Button">' . "\n";
        $stylev11 .= '	  <item name="android:background">@drawable/' . $lower_name . '_btn_default_holo_light</item>' . "\n";
        $stylev11 .= '  </style>' . "\n\n";

        $stylev11 .= '  <style name="ImageButton' . $name . '" parent="android:Widget.Holo.Light.ImageButton">' . "\n";
        $stylev11 .= '	  <item name="android:background">@drawable/' . $lower_name . '_btn_default_holo_light</item>' . "\n";
        $stylev11 .= '  </style>' . "\n\n";

        $button_image = "btn_default_holo_light";
    }

    $stylev8 .= '  <style name="Button' . $name . '" parent="android:Widget.Button">' . "\n";
    $stylev8 .= '	  <item name="android:background">@drawable/' . $lower_name . '_' . $button_image . '</item>' . "\n";
    $stylev8 .= '	  <item name="android:minHeight">48dip</item>' . "\n";
    $stylev8 .= '	  <item name="android:minWidth">64dip</item>' . "\n";
    // TODO replace with selector
    if ($holo == "dark") {
        $stylev8 .= '	  <item name="android:textColor">#ffffff</item>' . "\n";
    } else {
        $stylev8 .= '	  <item name="android:textColor">#000000</item>' . "\n";
    }
    $stylev8 .= '  </style>' . "\n\n";

    $stylev8 .= '  <style name="ImageButton' . $name . '" parent="android:Widget.ImageButton">' . "\n";
    $stylev8 .= '	  <item name="android:background">@drawable/' . $lower_name . '_' . $button_image . '</item>' . "\n";
    $stylev8 .= '  </style>' . "\n\n";

    $style11_available = true;
    $style8_available = true;

    $themev11 .= '    <item name="android:buttonStyle">@style/Button' . $name . '</item>' . "\n\n";
    $themev11 .= '    <item name="android:imageButtonStyle">@style/ImageButton' . $name . '</item>' . "\n\n";

    $themev8 .= '    <item name="android:buttonStyle">@style/Button' . $name . '</item>' . "\n\n";
    $themev8 .= '    <item name="android:imageButtonStyle">@style/ImageButton' . $name . '</item>' . "\n\n";

}

// ============== cspinner =================== //
if (isset($cspinner) && $cspinner == true) {
    require_once('widgets/cspinner/common-cspinner.php');
    $logger->debug("generate colored spinner");

    foreach ($cspinner_classes as $clazz) {
        generateImageOnDisk($clazz, $color, $holo, $kitkat, "widgets/cspinner/");
    }

    copy_directory("widgets/cspinner/res/", $folder . "/res/", $holo, $lower_name);
}

// ============== spinner =================== //
if (isset($spinner) && $spinner == true && !isset($cspinner)) {
    require_once('widgets/spinner/common-spinner.php');
    $logger->debug("generate spinner");

    foreach ($spinner_classes as $clazz) {
        generateImageOnDisk($clazz, $color, $holo, $kitkat, "widgets/spinner/");
    }

    copy_directory("widgets/spinner/res/", $folder . "/res/", $holo, $lower_name);

}

// ============ cspinnner & spinner ============= //
if ((isset($spinner) && $spinner == true) || (isset($cspinner) && $cspinner == true)) {

    if (!isset($list)) {
        require_once('widgets/list/common-list.php');
        foreach ($list_classes as $clazz) {
            generateImageOnDisk($clazz, $color, $holo, $kitkat, "widgets/list/");
        }
        copy_directory("widgets/list/res/", $folder . "/res/", $holo, $lower_name);
    }

    if ($holo == "dark") {
        $stylev11 .= '  <style name="Spinner' . $name . '" parent="android:Widget.Holo.Spinner">' . "\n";
        $stylev11 .= '      <item name="android:background">@drawable/' . $lower_name . '_spinner_background_holo_' . $holo . '</item>' . "\n";
        $stylev11 .= '      <item name="android:dropDownSelector">@drawable/' . $lower_name . '_list_selector_holo_' . $holo . '</item>' . "\n";
        $stylev11 .= '  </style>' . "\n\n";
    } else {
        $stylev11 .= '  <style name="Spinner' . $name . '" parent="android:Widget.Holo.Light.Spinner">' . "\n";
        $stylev11 .= '      <item name="android:background">@drawable/' . $lower_name . '_spinner_background_holo_' . $holo . '</item>' . "\n";
        $stylev11 .= '      <item name="android:dropDownSelector">@drawable/' . $lower_name . '_list_selector_holo_' . $holo . '</item>' . "\n";
        $stylev11 .= '  </style>' . "\n\n";
    }

    $stylev8 .= '  <style name="Spinner' . $name . '" parent="android:Widget.Spinner">' . "\n";
    $stylev8 .= '      <item name="android:background">@drawable/' . $lower_name . '_spinner_background_holo_' . $holo . '</item>' . "\n";
    $stylev8 .= '      <item name="android:dropDownSelector">@drawable/' . $lower_name . '_list_selector_holo_' . $holo . '</item>' . "\n";
    $stylev8 .= '  </style>' . "\n\n";

    $stylev8 .= '  <style name="SpinnerDropDownItem' . $name . '" parent="android:Widget.DropDownItem.Spinner">' . "\n";
    $stylev8 .= '      <item name="android:checkMark">@drawable/' . $lower_name . '_btn_radio_holo_' . $holo . '</item>' . "\n";
    $stylev8 .= '  </style>' . "\n";

    $style11_available = true;
    $style8_available = true;

    $themev11 .= '    <item name="android:dropDownSpinnerStyle">@style/Spinner' . $name . '</item>' . "\n\n";

    $themev8 .= '    <item name="android:spinnerStyle">@style/Spinner' . $name . '</item>' . "\n\n";
    $themev8 .= '    <item name="android:spinnerDropDownItemStyle">@style/SpinnerDropDownItem' . $name . '</item>' . "\n\n";
}

// ============== tab =================== //
if (isset($tab) && $tab == true) {
    require_once('widgets/tab/common-tab.php');
    $logger->debug("generate tab");

    foreach ($tab_classes as $clazz) {
        generateImageOnDisk($clazz, $color, $holo, $kitkat, "widgets/tab/");
    }

    copy_directory("widgets/tab/res/", $folder . "/res/", $holo, $lower_name, false);

    $content = str_replace("%%HoloColors%%", $name, file_get_contents($folder . "/res/layout/tab_indicator_holo.xml"));
    file_put_contents($folder . "/res/layout/tab_indicator_holo.xml", $content);

    $styletab .= '  <style name="Tab' . $name . '">' . "\n";
    $styletab .= '      <item name="android:gravity">center_horizontal</item>' . "\n";
    $styletab .= '      <item name="android:paddingLeft">16dip</item>' . "\n";
    $styletab .= '      <item name="android:paddingRight">16dip</item>' . "\n";
    $styletab .= '      <item name="android:background">@drawable/' . $lower_name . '_tab_indicator_holo</item>' . "\n";
    $styletab .= '      <item name="android:layout_width">0dip</item>' . "\n";
    $styletab .= '      <item name="android:layout_weight">1</item>' . "\n";
    $styletab .= '      <item name="android:minWidth">80dip</item>' . "\n";
    $styletab .= '  </style>' . "\n\n";

    $styletab .= '  <style name="TabText' . $name . '">' . "\n";
    if ($holo == "dark") {
        $styletab .= '	  <item name="android:textColor">#ffffff</item>' . "\n";
    } else {
        $styletab .= '	  <item name="android:textColor">#000000</item>' . "\n";
    }
    $styletab .= '      <item name="android:textSize">12sp</item>' . "\n";
    $styletab .= '      <item name="android:textStyle">bold</item>' . "\n";
    $styletab .= '      <!-- v14 <item name="android:textAllCaps">true</item> -->' . "\n";
    $styletab .= '      <item name="android:ellipsize">marquee</item>' . "\n";
    $styletab .= '      <item name="android:maxLines">2</item>' . "\n";
    $styletab .= '      <item name="android:maxWidth">180dip</item>' . "\n";
    $styletab .= '  </style>' . "\n\n";

    if ($minsdk == 'holo') {
        $stylev11 .= $styletab;
        $style11_available = true;
    } else {
        $stylev8 .= $styletab;
        $style8_available = true;
    }
}


// ============= progressbar ================ //
if (isset($progressbar) && $progressbar == true) {
    require_once('widgets/progressbar/common-progressbar.php');

    $logger->debug("generate progressbar");

    $img_sizes = array('mdpi', 'hdpi', 'xhdpi', 'xxhdpi');

    for ($i = 1; $i <= 8; $i++) {
        $pb = new ProgressBar("widgets/progressbar/", $i);

        foreach ($img_sizes as $img_size) {
            $pb->generate_image($color, $img_size, $holo, $kitkat);
        }
    }

    foreach ($progressbar_classes as $clazz) {
        generateImageOnDisk($clazz, $color, $holo, $kitkat, "widgets/progressbar/");
    }

    copy_directory("widgets/progressbar/res/", $folder . "/res/", $holo, $lower_name);


    if ($holo == "dark") {
        $stylev11 .= '  <style name="ProgressBar' . $name . '" parent="android:Widget.Holo.ProgressBar.Horizontal">' . "\n";
    } else {
        $stylev11 .= '  <style name="ProgressBar' . $name . '" parent="android:Widget.Holo.Light.ProgressBar.Horizontal">' . "\n";
    }
    $stylev11 .= '      <item name="android:progressDrawable">@drawable/' . $lower_name . '_progress_horizontal_holo_' . $holo . '</item>' . "\n";
    $stylev11 .= '      <item name="android:indeterminateDrawable">@drawable/' . $lower_name . '_progress_indeterminate_horizontal_holo_' . $holo . '</item>' . "\n";
    $stylev11 .= '  </style>' . "\n\n";

    $stylev8 .= '  <style name="ProgressBar' . $name . '" parent="android:Widget.ProgressBar.Horizontal">' . "\n";
    $stylev8 .= '      <item name="android:progressDrawable">@drawable/' . $lower_name . '_progress_horizontal_holo_' . $holo . '</item>' . "\n";
    $stylev8 .= '      <item name="android:indeterminateDrawable">@drawable/' . $lower_name . '_progress_indeterminate_horizontal_holo_' . $holo . '</item>' . "\n";
    $stylev8 .= '      <item name="android:minHeight">16dip</item>' . "\n";
    $stylev8 .= '      <item name="android:maxHeight">16dip</item>' . "\n";
    $stylev8 .= '  </style>' . "\n\n";

    $style11_available = true;
    $style8_available = true;

    $themev11 .= '    <item name="android:progressBarStyleHorizontal">@style/ProgressBar' . $name . '</item>' . "\n\n";
    $themev8 .= '    <item name="android:progressBarStyleHorizontal">@style/ProgressBar' . $name . '</item>' . "\n\n";
}

//  ============== seekbar ================ //
if (isset($seekbar) && $seekbar == true) {
    require_once('widgets/seekbar/common-seekbar.php');
    $logger->debug("generate seekbar");

    foreach ($seekbar_classes as $clazz) {
        generateImageOnDisk($clazz, $color, $holo, $kitkat, "widgets/seekbar/");
    }

    copy_directory("widgets/seekbar/res/", $folder . "/res/", $holo, $lower_name);

    if ($holo == "dark") {
        $stylev11 .= '  <style name="SeekBar' . $name . '" parent="android:Widget.Holo.SeekBar">' . "\n";
    } else {
        $stylev11 .= '  <style name="SeekBar' . $name . '" parent="android:Widget.Holo.Light.SeekBar">' . "\n";
    }
    $stylev11 .= '      <item name="android:progressDrawable">@drawable/' . $lower_name . '_scrubber_progress_horizontal_holo_' . $holo . '</item>' . "\n";
    $stylev11 .= '      <item name="android:indeterminateDrawable">@drawable/' . $lower_name . '_scrubber_progress_horizontal_holo_' . $holo . '</item>' . "\n";
    $stylev11 .= '      <item name="android:thumb">@drawable/' . $lower_name . '_scrubber_control_selector_holo_' . $holo . '</item>' . "\n";
    $stylev11 .= '  </style>' . "\n\n";

    $stylev8 .= '  <style name="SeekBar' . $name . '" parent="android:Widget.SeekBar">' . "\n";
    $stylev8 .= '      <item name="android:progressDrawable">@drawable/' . $lower_name . '_scrubber_progress_horizontal_holo_' . $holo . '</item>' . "\n";
    $stylev8 .= '      <item name="android:indeterminateDrawable">@drawable/' . $lower_name . '_scrubber_progress_horizontal_holo_' . $holo . '</item>' . "\n";
    $stylev8 .= '      <item name="android:minHeight">13dip</item>' . "\n";
    $stylev8 .= '      <item name="android:maxHeight">13dip</item>' . "\n";
    $stylev8 .= '      <item name="android:thumb">@drawable/' . $lower_name . '_scrubber_control_selector_holo_' . $holo . '</item>' . "\n";
    $stylev8 .= '      <item name="android:thumbOffset">16dip</item>' . "\n";
    $stylev8 .= '      <item name="android:paddingLeft">16dip</item>' . "\n";
    $stylev8 .= '      <item name="android:paddingRight">16dip</item>' . "\n";
    $stylev8 .= '  </style>' . "\n\n";

    $style11_available = true;
    $style8_available = true;

    $themev11 .= '    <item name="android:seekBarStyle">@style/SeekBar' . $name . '</item>' . "\n\n";
    $themev8 .= '    <item name="android:seekBarStyle">@style/SeekBar' . $name . '</item>' . "\n\n";
}

//  ============== ratingbar ================ //
if (isset($ratingbar) && $ratingbar == true) {
    require_once('widgets/ratingbar/common-ratingbar.php');
    $logger->debug("generate ratingbar");

    foreach ($ratingbar_classes as $clazz) {
        generateImageOnDisk($clazz, $color, $holo, $kitkat, "widgets/ratingbar/");
    }

    copy_directory("widgets/ratingbar/res/", $folder . "/res/", $holo, $lower_name);

    if ($holo == "dark") {
        $stylev11 .= '  <style name="RatingBar' . $name . '" parent="android:Widget.Holo.RatingBar">' . "\n";
    } else {
        $stylev11 .= '  <style name="RatingBar' . $name . '" parent="android:Widget.Holo.Light.RatingBar">' . "\n";
    }
    $stylev11 .= '      <item name="android:progressDrawable">@drawable/' . $lower_name . '_ratingbar_full_holo_' . $holo . '</item>' . "\n";
    $stylev11 .= '      <item name="android:indeterminateDrawable">@drawable/' . $lower_name . '_ratingbar_full_holo_' . $holo . '</item>' . "\n";
    $stylev11 .= '  </style>' . "\n\n";

    $stylev8 .= '  <style name="RatingBar' . $name . '" parent="android:Widget.RatingBar">' . "\n";
    $stylev8 .= '      <item name="android:progressDrawable">@drawable/' . $lower_name . '_ratingbar_full_holo_' . $holo . '</item>' . "\n";
    $stylev8 .= '      <item name="android:indeterminateDrawable">@drawable/' . $lower_name . '_ratingbar_full_holo_' . $holo . '</item>' . "\n";
    $stylev8 .= '  </style>' . "\n\n";

    $style11_available = true;
    $style8_available = true;

    $themev11 .= '    <item name="android:ratingBarStyle">@style/RatingBar' . $name . '</item>' . "\n\n";
    $themev8 .= '    <item name="android:ratingBarStyle">@style/RatingBar' . $name . '</item>' . "\n\n";
}

// ================== ratingstarbig ===================== //
if (isset($ratingstarbig) && $ratingstarbig == true) {
    require_once('widgets/ratingstarbig/common-ratingstarbig.php');
    $logger->debug("generate ratingstarbig");

    foreach ($ratingbarbig_classes as $clazz) {
        generateImageOnDisk($clazz, $color, $holo, $kitkat, "widgets/ratingstarbig/");
    }

    copy_directory("widgets/ratingstarbig/res/", $folder . "/res/", $holo, $lower_name);

    if ($holo == "dark") {
        $stylev11 .= '  <style name="RatingBarBig' . $name . '" parent="android:Widget.Holo.RatingBar.Indicator">' . "\n";
    } else {
        $stylev11 .= '  <style name="RatingBarBig' . $name . '" parent="android:Widget.Holo.Light.RatingBar.Indicator">' . "\n";
    }
    $stylev11 .= '      <item name="android:progressDrawable">@drawable/' . $lower_name . '_ratingbar_holo_' . $holo . '</item>' . "\n";
    $stylev11 .= '      <item name="android:indeterminateDrawable">@drawable/' . $lower_name . '_ratingbar_holo_' . $holo . '</item>' . "\n";
    $stylev11 .= '  </style>' . "\n\n";

    $stylev8 .= '  <style name="RatingBarBig' . $name . '">' . "\n";
    $stylev8 .= '      <item name="android:progressDrawable">@drawable/' . $lower_name . '_ratingbar_holo_' . $holo . '</item>' . "\n";
    $stylev8 .= '      <item name="android:indeterminateDrawable">@drawable/' . $lower_name . '_ratingbar_holo_' . $holo . '</item>' . "\n";
    $stylev8 .= '      <item name="android:minHeight">35dip</item>' . "\n";
    $stylev8 .= '      <item name="android:maxHeight">35dip</item>' . "\n";
    $stylev8 .= '  </style>' . "\n\n";

    $style11_available = true;
    $style8_available = true;

    $themev11 .= '    <item name="android:ratingBarStyleIndicator">@style/RatingBarBig' . $name . '</item>' . "\n\n";
    $themev8 .= '    <item name="android:ratingBarStyleIndicator">@style/RatingBarBig' . $name . '</item>' . "\n\n";

}

// ================== ratingstarsmall ===================== //
if (isset($ratingstarsmall) && $ratingstarsmall == true) {
    require_once('widgets/ratingstarsmall/common-ratingstarsmall.php');
    $logger->debug("generate ratingstarsmall");

    foreach ($ratingbarsmall_classes as $clazz) {
        generateImageOnDisk($clazz, $color, $holo, $kitkat, "widgets/ratingstarsmall/");
    }

    copy_directory("widgets/ratingstarsmall/res/", $folder . "/res/", $holo, $lower_name);

    if ($holo == "dark") {
        $stylev11 .= '  <style name="RatingBarSmall' . $name . '" parent="android:Widget.Holo.RatingBar.Small">' . "\n";
    } else {
        $stylev11 .= '  <style name="RatingBarSmall' . $name . '" parent="android:Widget.Holo.Light.RatingBar.Small">' . "\n";
    }
    $stylev11 .= '      <item name="android:progressDrawable">@drawable/' . $lower_name . '_ratingbar_small_holo_' . $holo . '</item>' . "\n";
    $stylev11 .= '      <item name="android:indeterminateDrawable">@drawable/' . $lower_name . '_ratingbar_small_holo_' . $holo . '</item>' . "\n";
    $stylev11 .= '  </style>' . "\n\n";

    $stylev8 .= '  <style name="RatingBarSmall' . $name . '">' . "\n";
    $stylev8 .= '      <item name="android:progressDrawable">@drawable/' . $lower_name . '_ratingbar_small_holo_' . $holo . '</item>' . "\n";
    $stylev8 .= '      <item name="android:indeterminateDrawable">@drawable/' . $lower_name . '_ratingbar_small_holo_' . $holo . '</item>' . "\n";
    $stylev8 .= '      <item name="android:minHeight">16dip</item>' . "\n";
    $stylev8 .= '      <item name="android:maxHeight">16dip</item>' . "\n";
    $stylev8 .= '  </style>' . "\n\n";

    $style11_available = true;
    $style8_available = true;

    $themev11 .= '    <item name="android:ratingBarStyleSmall">@style/RatingBarSmall' . $name . '</item>' . "\n\n";
    $themev8 .= '    <item name="android:ratingBarStyleSmall">@style/RatingBarSmall' . $name . '</item>' . "\n\n";
}

//  ============== toggle ================ //
if (isset($toggle) && $toggle == true) {
    require_once('widgets/toggle/common-toggle.php');
    $logger->debug("generate toggle");

    foreach ($toggle_classes as $clazz) {
        generateImageOnDisk($clazz, $color, $holo, $kitkat, "widgets/toggle/");
    }

    copy_directory("widgets/toggle/res/", $folder . "/res/", $holo, $lower_name);

    if ($holo == "dark") {
        $stylev11 .= '  <style name="Toggle' . $name . '" parent="android:Widget.Holo.Button.Toggle">' . "\n";
    } else {
        $stylev11 .= '  <style name="Toggle' . $name . '" parent="android:Widget.Holo.Light.Button.Toggle">' . "\n";
    }
    $stylev11 .= '      <item name="android:background">@drawable/' . $lower_name . '_btn_toggle_holo_' . $holo . '</item>' . "\n";
    $stylev11 .= '  </style>' . "\n\n";

    $stylev8 .= '  <style name="Toggle' . $name . '" parent="android:Widget.Button.Toggle">' . "\n";
    $stylev8 .= '      <item name="android:background">@drawable/' . $lower_name . '_btn_toggle_holo_' . $holo . '</item>' . "\n";
    $stylev8 .= '      <item name="android:minHeight">48dip</item>' . "\n";
    if ($holo == "dark") {
        // TODO : replace with selector
        $stylev8 .= '	  <item name="android:textColor">#ffffff</item>' . "\n";
    } else {
        $stylev8 .= '	  <item name="android:textColor">#000000</item>' . "\n";
    }
    $stylev8 .= '  </style>' . "\n\n";

    $style11_available = true;
    $style8_available = true;

    $themev11 .= '    <item name="android:buttonStyleToggle">@style/Toggle' . $name . '</item>' . "\n\n";
    $themev8 .= '    <item name="android:buttonStyleToggle">@style/Toggle' . $name . '</item>' . "\n\n";
}

//  ============== list selector ================ //
if ((isset($list) && $list == true)) {
    require_once('widgets/list/common-list.php');
    $logger->debug("generate list");

    foreach ($list_classes as $clazz) {
        generateImageOnDisk($clazz, $color, $holo, $kitkat, "widgets/list/");
    }

    copy_directory("widgets/list/res/", $folder . "/res/", $holo, $lower_name);

    $themev11 .= '    <item name="android:listChoiceBackgroundIndicator">@drawable/' . $lower_name . '_list_selector_holo_' . $holo . '</item>' . "\n\n";
    $themev11 .= '    <item name="android:activatedBackgroundIndicator">@drawable/' . $lower_name . '_activated_background_holo_' . $holo . '</item>' . "\n\n";

    $stylev8 .= '  <style name="ListView' . $name . '" parent="android:Widget.ListView">' . "\n";
    $stylev8 .= '      <item name="android:listSelector">@drawable/' . $lower_name . '_list_selector_holo_' . $holo . '</item>' . "\n";
    $stylev8 .= '  </style>' . "\n\n";

    $stylev8 .= '  <style name="ListView' . $name . '.White" parent="android:Widget.ListView.White">' . "\n";
    $stylev8 .= '      <item name="android:listSelector">@drawable/' . $lower_name . '_list_selector_holo_' . $holo . '</item>' . "\n";
    $stylev8 .= '  </style>' . "\n\n";

    $themev8 .= '    <item name="android:listViewStyle">@style/ListView' . $name . '</item>' . "\n\n";
    $themev8 .= '    <item name="android:listViewWhiteStyle">@style/ListView' . $name . '.White</item>' . "\n\n";

    $stylev8 .= '  <style name="SpinnerItem' . $name . '" parent="android:TextAppearance.Widget.TextView.SpinnerItem">' . "\n";
    // TODO : replace with selector
    if ($holo == "dark") {
        $stylev8 .= '      <item name="android:textColor">#ffffff</item>' . "\n";
    } else {
        $stylev8 .= '      <item name="android:textColor">#000000</item>' . "\n";
    }
    $stylev8 .= '  </style>' . "\n\n";
    $themev8 .= '    <item name="android:spinnerItemStyle">@style/SpinnerItem' . $name . '</item>' . "\n\n";

    $style8_available = true;

    // TODO dropdown, expandable...    
}

// ================= fastscroll ====================//
if (isset($fastscroll) && $fastscroll == true) {
    require_once('widgets/fastscroll/common-fastscroll.php');
    $logger->debug("generate fastscroll");

    foreach ($fastscroll_classes as $clazz) {
        generateImageOnDisk($clazz, $color, $holo, $kitkat, "widgets/fastscroll/");
    }

    copy_directory("widgets/fastscroll/res/", $folder . "/res/", $holo, $lower_name, false);

    $themev11 .= '    <item name="android:fastScrollThumbDrawable">@drawable/' . $lower_name . '_fastscroll_thumb_holo</item>' . "\n\n";

    // not available in v8
}


// ================ search edit text ================//
/*
if (isset($search) && $search == true) {
  require_once('widgets/search/common-search.php');
  $logger->debug("generate search");

  foreach ($search_classes as $clazz) {
    generateImageOnDisk($clazz, $color, $holo, $kitkat,  "widgets/search/");
  }

  copy_directory("widgets/search/res/", $folder."/res/", $holo);

  // TODO : v8

  $themev11 .= '    <item name="android:searchViewTextField">@drawable/'.$lower_name.'_textfield_searchview_holo_dark</item>'."\n\n";
  $themev11 .= '    <item name="android:searchViewTextFieldRight">@drawable/'.$lower_name.'_textfield_searchview_right_holo_dark</item>'."\n\n";
}
*/

//  ============== numberpicker ================ //

if (isset($numberpicker) && $numberpicker == true) {

    if (!isset($list)) {
        require_once('widgets/list/common-list.php');
        foreach ($list_classes as $clazz) {
            generateImageOnDisk($clazz, $color, $holo, $kitkat, "widgets/list/");
        }
        copy_directory("widgets/list/res/", $folder . "/res/", $holo, $lower_name);
    }

    require_once('widgets/numberpicker/common-numberpicker.php');
    $logger->debug("generate numberpicker");

    foreach ($numberpicker_classes as $clazz) {
        generateImageOnDisk($clazz, $color, $holo, $kitkat, "widgets/numberpicker/");
    }

    copy_directory("widgets/numberpicker/res/", $folder . "/res/", $holo, $lower_name);

    $stylev8 .= '  <style name="NumberPicker' . $name . '">' . "\n";
    $stylev8 .= '      <item name="android:orientation">vertical</item>">' . "\n";
    $stylev8 .= '      <item name="android:fadingEdge">vertical</item>">' . "\n";
    $stylev8 .= '      <item name="android:fadingEdgeLength">50dip</item>">' . "\n";
    $stylev8 .= '      <item name="solidColor">@android:color/transparent</item>">' . "\n";
    $stylev8 .= '      <item name="selectionDivider">@drawable/' . $lower_name . '_numberpicker_selection_divider</item>' . "\n";
    $stylev8 .= '      <item name="selectionDividerHeight">2dip</item>">' . "\n";
    $stylev8 .= '      <item name="internalLayout">@layout/number_picker_with_selector_wheel</item>' . "\n";
    $stylev8 .= '      <item name="internalMinWidth">64dip</item>">' . "\n";
    $stylev8 .= '      <item name="internalMaxHeight">180dip</item>">' . "\n";
    if ($holo == "dark") {
        $stylev8 .= '      <item name="virtualButtonPressedDrawable">@drawable/' . $lower_name . '_item_background_holo_dark</item>' . "\n";
    } else {
        $stylev8 .= '      <item name="virtualButtonPressedDrawable">@drawable/' . $lower_name . '_item_background_holo_light</item>' . "\n";
    }
    $stylev8 .= '  </style>' . "\n\n";

    $style8_available = true;

    $themev8 .= '    <item name="numberPickerStyle">@style/NumberPicker' . $name . '</item>' . "\n\n";
    $themev11 .= '    <item name="numberPickerStyle">@style/NumberPicker' . $name . '</item>' . "\n\n";
}

//  ============== switch JB ================ //
if (isset($switchjb) && $switchjb == true) {
    require_once('widgets/switchjb/common-switchjb.php');
    $logger->debug("generate switch jb");

    foreach ($switchjb_classes as $clazz) {
        generateImageOnDisk($clazz, $color, $holo, $kitkat, "widgets/switchjb/");
    }

    copy_directory("widgets/switchjb/res/", $folder . "/res/", $holo, $lower_name);

    if (isset($switch) && $switch == true) {
        // TODO : in this case provide switch jb in a "-16" folder and switch ics in default folder
        $switch = false;
    }
}


//  ============== switch ================ //

if (isset($switch) && $switch == true) {
    require_once('widgets/switch/common-switch.php');
    $logger->debug("generate switch");

    foreach ($switch_classes as $clazz) {
        generateImageOnDisk($clazz, $color, $holo, $kitkat, "widgets/switch/");
    }

    copy_directory("widgets/switch/res/", $folder . "/res/", $holo, $lower_name);

    /*
    $stylev14 = $stylev11;
	$themev14 = $themev11;
	
	if ($holo == "dark") {
		$stylev14 .= '  <style name="Switch'.$name.'" parent="android:Widget.Holo.CompoundButton.Switch">'."\n";
	} else {
		$stylev14 .= '  <style name="Switch'.$name.'" parent="android:Widget.Holo.Light.CompoundButton.Switch">'."\n";
	}
    $stylev14 .= '      <item name="android:track">@drawable/'.$lower_name.'_switch_track_holo_'.$holo.'</item>'."\n";
    $stylev14 .= '      <item name="android:thumb">@drawable/'.$lower_name.'_switch_inner_holo_'.$holo.'</item>'."\n";
	$stylev14 .= '  </style>'."\n\n";
    
    $style14_available = true;
    
    $themev14 .= '    <item name="android:switchStyle">@style/Switch'.$name.'</item>'."\n\n";    
    
    $themev14 .= "  </style>\n\n</resources>";
    $stylev14 .= "</resources>";
    */
}

// ============== navigation drawer =================== //
if ((isset($navdrawer) && $navdrawer == true)) {
    require_once('widgets/navdrawer/common-navdrawer.php');
    $logger->debug("generate navdrawer");

    foreach ($navdrawer_classes as $clazz) {
        generateImageOnDisk($clazz, $color, $holo, $kitkat, "widgets/navdrawer/");
    }
}


// ============== theme & style ================ //

$themev11 .= "  </style>\n\n</resources>";
$stylev11 .= "</resources>";

$themev8 .= "  </style>\n\n</resources>";
$stylev8 .= "</resources>";

$themev9 .= "  </style>\n\n</resources>";

if ($minsdk == 'holo') {
    $theme_file = "generated/" . $date . "/" . $_SESSION['id'] . "/res/values/themes_" . $lower_name . ".xml";
    @file_put_contents($theme_file, $themev11);
} else {
    if ($themev11_available) {
        $theme_file = "generated/" . $date . "/" . $_SESSION['id'] . "/res/values-v11/themes_" . $lower_name . ".xml";
        @file_put_contents($theme_file, $themev11);
    }

    $theme_file = "generated/" . $date . "/" . $_SESSION['id'] . "/res/values/themes_" . $lower_name . ".xml";
    @file_put_contents($theme_file, $themev8);

    if ($themev9_available) {
        $theme_file = "generated/" . $date . "/" . $_SESSION['id'] . "/res/values-v9/themes_" . $lower_name . ".xml";
        @file_put_contents($theme_file, $themev9);
    }
}

if ($style8_available == true && $minsdk != 'holo') {
    $style_file = "generated/" . $date . "/" . $_SESSION['id'] . "/res/values/styles_" . $lower_name . ".xml";
    @file_put_contents($style_file, $stylev8);
}

if ($style11_available == true) {
    if ($minsdk == 'holo') {
        $style_file = "generated/" . $date . "/" . $_SESSION['id'] . "/res/values/styles_" . $lower_name . ".xml";
    } else {
        $style_file = "generated/" . $date . "/" . $_SESSION['id'] . "/res/values-v11/styles_" . $lower_name . ".xml";
    }
    @file_put_contents($style_file, $stylev11);
}

/*
if ($style14_available == true) {
    $values14 = "generated/" . $date . "/" . $_SESSION['id'] . "/res/values-v14";
    if (file_exists($values14) == FALSE) {
        mkdir($values14, 0777, true);
    }
    $theme_file = "generated/" . $date . "/" . $_SESSION['id'] . "/res/values-v14/themes_" . $lower_name . ".xml";
    @file_put_contents($theme_file, $themev14);

    $style_file = "generated/" . $date . "/" . $_SESSION['id'] . "/res/values-v14/styles_" . $lower_name . ".xml";
    @file_put_contents($style_file, $stylev14);
}
*/

$color_file = "generated/" . $date . "/" . $_SESSION['id'] . "/res/values/colors_" . $lower_name . ".xml";
$color_content = "<?xml version=\"1.0\" encoding=\"utf-8\"?>" . "\n";
$color_content .= "<resources>" . "\n";
$color_content .= "    <color name=\"" . $lower_name . "_color\">#" . $color . "</color>" . "\n";
$color_content .= "</resources>" . "\n";
@file_put_contents($color_file, $color_content);


// ============== ZIP ====================== //
$zipname = getcwd() . "/generated/" . $date . "/" . $_SESSION['id'] . ".zip";
$logger->debug("preparing zip " . $zipname);

if (Zip($folder, $zipname, $lower_name)) {
    header('Set-Cookie: fileDownload=true');
    header("Content-type: application/zip");
    header('Content-Disposition: attachment; filename="android-holo-colors-' . $lower_name . '.zip"');
    header('Content-Length: ' . filesize($zipname));
    header("Expires: 0");
    header("Cache-Control: no-cache, must-revalidate");
    header("Pragma: no-cache");
    if (!readfile($zipname)) {
        die('Unable to download zip');
    }
    exit;
} else {
    $logger->error("generate zip FAIL");
    die('Unable to create zip');
}


/**********************************
 *
 * Generate
 *
 **********************************/
function generateImageOnDisk($clazz, $color, $holo, $kitkat = false, $ctx = "")
{
    $sizes = array('mdpi', 'hdpi', 'xhdpi', 'xxhdpi');
    $obj = new $clazz($ctx);

    foreach ($sizes as $size) {
        $obj->generate_image($color, $size, $holo, $kitkat);
    }
}


/**********************************
 *
 * Generate folders for xml styles
 *
 **********************************/
function generateFolders($date, $themev8_available, $themev9_available, $themev11_available)
{
    $drawable = getcwd() . "/generated/" . $date . "/" . $_SESSION['id'] . "/res/drawable";
    $layout = getcwd() . "/generated/" . $date . "/" . $_SESSION['id'] . "/res/layout";
    if (file_exists($drawable . "-mdpi") == FALSE) {
        mkdir($drawable . "-mdpi", 0777, true);
    }
    if (file_exists($drawable . "-hdpi") == FALSE) {
        mkdir($drawable . "-hdpi", 0777, true);
    }
    if (file_exists($drawable . "-xhdpi") == FALSE) {
        mkdir($drawable . "-xhdpi", 0777, true);
    }
    if (file_exists($drawable . "-xxhdpi") == FALSE) {
        mkdir($drawable . "-xxhdpi", 0777, true);
    }
    if (file_exists($drawable) == FALSE) {
        mkdir($drawable, 0777, true);
    }
    if (file_exists($layout) == FALSE) {
        mkdir($layout, 0777, true);
    }
    $values = getcwd() . "/generated/" . $date . "/" . $_SESSION['id'] . "/res/values";
    if (file_exists($values) == FALSE) {
        mkdir($values, 0777, true);
    }
    if ($themev8_available) {
        if ($themev11_available) {
            $values11 = getcwd() . "/generated/" . $date . "/" . $_SESSION['id'] . "/res/values-v11";
            if (file_exists($values11) == FALSE) {
                mkdir($values11, 0777, true);
            }
        }

        if ($themev9_available) {
            $values9 = getcwd() . "/generated/" . $date . "/" . $_SESSION['id'] . "/res/values-v9";
            if (file_exists($values9) == FALSE) {
                mkdir($values9, 0777, true);
            }
        }
    }

}

/**********************************
 *
 * Remove recursively content of a folder
 *
 **********************************/
function rrmdir($dir)
{
    if (is_dir($dir)) {
        $objects = scandir($dir);
        foreach ($objects as $object) {
            if ($object != "." && $object != "..") {
                if (filetype($dir . "/" . $object) == "dir") {
                    rrmdir($dir . "/" . $object);
                } else {
                    unlink($dir . "/" . $object);
                }
            }
        }
        reset($objects);
        rmdir($dir);
    }
}

/**********************************
 *
 * Zip a folder and its content
 *
 **********************************/
function Zip($source, $destination, $name)
{
    $log = Logger::getLogger("zip");
    $log->debug("generate zip : " . $source . " in " . $destination);

    if (!extension_loaded('zip') || !file_exists($source)) {
        return false;
    }

    $zip = new ZipArchive();
    if (!$zip->open($destination, ZIPARCHIVE::CREATE)) {
        return false;
    }

    $source = str_replace('\\', '/', realpath($source));

    if (is_dir($source) === true) {
        $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source), RecursiveIteratorIterator::SELF_FIRST);

        foreach ($files as $file) {
            $file = str_replace('\\', '/', realpath($file));

            if (strstr($file, "res/")) {

                if (is_dir($file) === true) {
                    $zip->addEmptyDir(str_replace($source . '/', '', $file . '/'));
                } else if (is_file($file) === true) {
                    $filename = str_replace($source . '/', '', $file);
                    if (!strstr($filename, $name)) {
                        $exact_filename = strrchr($filename, "/");
                        if ($exact_filename) {
                            if (strstr($exact_filename, "attrs.xml") || strstr($exact_filename, "dimens.xml")) {
                                $exact_filename_with_theme = str_replace(".xml", "_" . $name . ".xml", $exact_filename);
                            } else {
                                $exact_filename_with_theme = str_replace("/", "/" . $name . "_", $exact_filename);
                            }
                            $filename = str_replace($exact_filename, $exact_filename_with_theme, $filename);
                        }
                    }
                    $log->debug("add " . $filename . " to zip");

                    // prefix all files with theme name
                    $zip->addFromString($filename, file_get_contents($file));
                }
            }
        }
    } else if (is_file($source) === true) {
        $zip->addFromString(basename($source), file_get_contents($source));
    }

    return $zip->close();
}


/*************************************************
 *
 * Copy a directory and its content to destination
 *
 *************************************************/
function copy_directory($source, $destination, $holo, $name, $check_holo = true)
{
    $log = Logger::getLogger("copy");
    $log->debug("copy directory : " . $source . " in " . $destination);

    if (is_dir($source)) {
        $directory = dir($source);
        while (FALSE !== ($readdirectory = $directory->read())) {
            if ($readdirectory == '.' || $readdirectory == '..' || $readdirectory == '.DS_Store') {
                continue;
            }
            $PathDir = $source . '/' . $readdirectory;
            $log->debug("File : " . $readdirectory . " Path : " . $PathDir . " holo=" . $check_holo);
            if (is_dir($PathDir)) {
                copy_directory($PathDir, $destination . '/' . $readdirectory, $holo, $name, $check_holo);
                continue;
            }
            if ($check_holo == false) {
                $log->debug("holo false => copy " . $PathDir . " in " . $destination . '/' . $readdirectory);
                copy($PathDir, $destination . '/' . $readdirectory);
                if (strstr($readdirectory, ".xml")) {
                    filter_file($destination . '/' . $readdirectory, $name);
                }

            } else if (strpos($readdirectory, $holo)) {
                $log->debug("holo true => copy " . $PathDir . " in " . $destination . '/' . $readdirectory);
                copy($PathDir, $destination . '/' . $readdirectory);

                if (strstr($readdirectory, ".xml")) {
                    filter_file($destination . '/' . $readdirectory, $name);
                }
            }


        }
        $directory->close();
    } else {
        copy($source, $destination);
    }
}

/*************************************************
 *
 * Add theme name in xml files
 *
 *************************************************/
function filter_file($file, $name)
{
    $content = @file_get_contents($file);
    if ($content) {
        $content = str_replace("@drawable/", "@drawable/" . $name . "_", $content);
    }

    @file_put_contents($file, $content);
}

?>
