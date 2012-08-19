<?php
/**
 * Licensed to the Apache Software Foundation (ASF) under one or more
 * contributor license agreements. See the NOTICE file distributed with
 * this work for additional information regarding copyright ownership.
 * The ASF licenses this file to You under the Apache License, Version 2.0
 * (the "License"); you may not use this file except in compliance with
 * the License. You may obtain a copy of the License at
 *
 *	   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
 * @package log4php
 */

/**
 * An Appender that automatically creates a new logfile each day.
 *
 * The file is rolled over once a day. That means, for each day a new file 
 * is created. A formatted version of the date pattern is used as to create 
 * the file name using the {@link PHP_MANUAL#sprintf} function.
 *
 * This appender uses a layout.
 * 
 * Configurable parameters for this appender are:
 * - datePattern - The date format for the file name. Should be set before 
 *                 $file. Default value: "Ymd".
 * - file        - The path to the target log file. The filename should 
 *                 contain a '%s' which will be substituted by the date.
 * - append      - Sets if the appender should append to the end of the
 *                 file or overwrite content ("true" or "false"). Default 
 *                 value: true.
 * 
 * An example php file:
 * 
 * {@example ../../examples/php/appender_dailyfile.php 19}
 *  
 * An example configuration file:
 * 
 * {@example ../../examples/resources/appender_dailyfile.properties 18}
 *
 * The above will create a file like: daily_20090908.log
 *
 * @version $Revision: 1213283 $
 * @package log4php
 * @subpackage appenders
 */
class LoggerAppenderDailyFile extends LoggerAppenderFile {

	/**
	 * Format date. 
	 * It follows the {@link PHP_MANUAL#date()} formatting rules and <b>should always be set before {@link $file} param</b>.
	 * @var string
	 */
	protected $datePattern = "Ymd";
	
	/**
	 * Sets date format for the file name.
	 * @param string $datePattern a regular date() string format
	 */
	public function setDatePattern($datePattern) {
		$this->setString('datePattern', $datePattern);
	}
	
	/**
	 * @return string returns date format for the filename
	 */
	public function getDatePattern() {
		return $this->datePattern;
	}
	
	/** 
	 * Similar to parent method, but but replaces "%s" in the file name with 
	 * the current date in format specified by the 'datePattern' parameter.
	 */ 
	public function activateOptions() {
		$fileName = $this->getFile();
		$date = date($this->getDatePattern());
		$fileName = sprintf($fileName, $date);
		
		if(!is_file($fileName)) {
			$dir = dirname($fileName);
			if(!is_dir($dir)) {
				mkdir($dir, 0777, true);
			}
		}
	
		$this->fp = fopen($fileName, ($this->getAppend()? 'a':'w'));
		if($this->fp) {
			if(flock($this->fp, LOCK_EX)) {
				if($this->getAppend()) {
					fseek($this->fp, 0, SEEK_END);
				}
				fwrite($this->fp, $this->layout->getHeader());
				flock($this->fp, LOCK_UN);
				$this->closed = false;
			} else {
				// TODO: should we take some action in this case?
				$this->closed = true;
			}
		} else {
			$this->closed = true;
		}
	}
}
