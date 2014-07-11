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

$time = microtime();
$time = explode(' ', $time);
$time = $time[1] + $time[0];
$begintime = $time;

date_default_timezone_set('UTC');
$day_before = date("d") - 2;
if ($day_before < 10)
    $day_before = "0" . $day_before;

$date = date("Ym") . $day_before;
$previous_folder = getcwd() . "/generated/" . $date . "/";

if (file_exists($previous_folder)) {
    rrmdir($previous_folder);
}
$time = microtime();
$time = explode(" ", $time);
$time = $time[1] + $time[0];
$endtime = $time;
$totaltime = ($endtime - $begintime);

if (file_exists($previous_folder)) {
    echo "Unable to delete " . $previous_folder . "(" . $totaltime . " seconds)";
} else {
    echo $previous_folder . " successfully deleted (" . $totaltime . " seconds)";
}

// ========================= functions ====================================

function rrmdir($dir)
{
    foreach (glob($dir . '/*') as $file) {
        if (is_dir($file))
            rrmdir($file);
        else
            unlink($file);
    }
    rmdir($dir);
}

?>