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
 * FileAppender appends log events to a file.
 *
 * This appender uses a layout.
 * 
 * Configurable parameters for this appender are:
 * - file      - The target file to write to
 * - filename  - The target file to write to (deprecated, use "file" instead)
 * - append    - Sets if the appender should append to the end of the file or overwrite content ("true" or "false")
 *
 * An example php file:
 * 
 * {@example ../../examples/php/appender_file.php 19}
 *
 * An example configuration file:
 * 
 * {@example ../../examples/resources/appender_file.properties 18}
 * 
 * @version $Revision: 1213663 $
 * @package log4php
 * @subpackage appenders
 */
class LoggerAppenderFile extends LoggerAppender {

	/**
	 * @var boolean if {@link $file} exists, appends events.
	 */
	protected $append = true;
	
	/**
	 * @var string the file name used to append events
	 */
	protected $file;

	/**
	 * @var mixed file resource
	 */
	protected $fp = false;
	
	public function activateOptions() {
		$fileName = $this->getFile();

		if (empty($fileName)) {
			$this->warn("Required parameter 'fileName' not set. Closing appender.");
			$this->closed = true;
			return;
		}
		
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
	
	public function close() {
		if($this->closed != true) {
			if($this->fp and $this->layout !== null) {
				if(flock($this->fp, LOCK_EX)) {
					fwrite($this->fp, $this->layout->getFooter());
					flock($this->fp, LOCK_UN);
				}
				fclose($this->fp);
			}
			$this->closed = true;
		}
	}

	public function append(LoggerLoggingEvent $event) {
		if($this->fp and $this->layout !== null) {
			if(flock($this->fp, LOCK_EX)) {
				fwrite($this->fp, $this->layout->format($event));
				flock($this->fp, LOCK_UN);
			} else {
				$this->closed = true;
			}
		} 
	}
	
	/**
	 * Sets the file where the log output will go.
	 * @param string $file
	 */
	public function setFile($file) {
		$this->setString('file', $file);
	}
	
	/**
	 * @return string
	 */
	public function getFile() {
		return $this->file;
	}
	
	/**
	 * @return boolean
	 */
	public function getAppend() {
		return $this->append;
	}

	public function setAppend($append) {
		$this->setBoolean('append', $append);
	}

	/**
	 * Sets the file where the log output will go.
	 * @param string $fileName
	 * @deprecated Use setFile() instead.
	 */
	public function setFileName($fileName) {
		$this->setFile($fileName);
	}
	
	/**
	 * @return string
	 * @deprecated Use getFile() instead.
	 */
	public function getFileName() {
		return $this->getFile();
	}
	
	 
}
