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
 * Log events using php {@link PHP_MANUAL#trigger_error} function and a {@link LoggerLayoutTTCC} default layout.
 *
 * This appender has no configurable parameters.
 *
 * Levels are mapped as follows:
 * 
 * - <b>level < WARN</b> mapped to E_USER_NOTICE
 * - <b>WARN <= level < ERROR</b> mapped to E_USER_WARNING
 * - <b>level >= ERROR</b> mapped to E_USER_ERROR  
 *
 * An example:
 * 
 * {@example ../../examples/php/appender_php.php 19}
 * 
 * {@example ../../examples/resources/appender_php.properties 18}
 *
 * @version $Revision: 1166182 $
 * @package log4php
 * @subpackage appenders
 */ 
class LoggerAppenderPhp extends LoggerAppender {

	public function append(LoggerLoggingEvent $event) {
		if($this->layout !== null) {
			$level = $event->getLevel();
			if($level->isGreaterOrEqual(LoggerLevel::getLevelError())) {
				trigger_error($this->layout->format($event), E_USER_ERROR);
			} else if ($level->isGreaterOrEqual(LoggerLevel::getLevelWarn())) {
				trigger_error($this->layout->format($event), E_USER_WARNING);
			} else {
				trigger_error($this->layout->format($event), E_USER_NOTICE);
			}
		}
	}
}
