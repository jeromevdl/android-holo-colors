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
 * Log every events as a separate email.
 * 
 * Configurable parameters for this appender are:
 * 
 * - layout             - Sets the layout class for this appender (required)
 * - to                 - Sets the recipient of the mail (required)
 * - from               - Sets the sender of the mail (optional)
 * - subject            - Sets the subject of the mail (optional)
 * - smtpHost           - Sets the mail server (optional, default is ini_get('SMTP'))
 * - port               - Sets the port of the mail server (optional, default is 25)
 *
 * An example:
 * 
 * {@example ../../examples/php/appender_mailevent.php 19}
 *  
 * {@example ../../examples/resources/appender_mailevent.properties 18}
 *
 * 
 * The above will output something like:
 * <pre>
 *      Date: Tue,  8 Sep 2009 21:51:04 +0200 (CEST)
 *      From: someone@example.com
 *      To: root@localhost
 *      Subject: Log4php test
 *
 *      Tue Sep  8 21:51:04 2009,120 [5485] FATAL root - Some critical message!
 * </pre>
 *
 * @version $Revision: 1237433 $
 * @package log4php
 * @subpackage appenders
 */
class LoggerAppenderMailEvent extends LoggerAppender {

	/**  'from' field (defaults to 'sendmail_from' from php.ini on win32).
	 * @var string
	 */
	protected $from;

	/** Mailserver port (win32 only).
	 * @var integer 
	 */
	protected $port = 25;

	/** Mailserver hostname (win32 only).
	 * @var string   
	 */
	protected $smtpHost = null;

	/**
	 * @var string 'subject' field
	 */
	protected $subject = '';

	/**
	 * @var string 'to' field
	 */
	protected $to = null;
	
	/** @var indiciates if this appender should run in dry mode */
	protected $dry = false;
	
	public function activateOptions() {
		if (empty($this->to)) {
			$this->warn("Required parameter 'to' not set. Closing appender.");
			$this->close = true;
			return;
		}
		
		$sendmail_from = ini_get('sendmail_from');
		if (empty($this->from) and empty($sendmail_from)) {
			$this->warn("Required parameter 'from' not set. Closing appender.");
			$this->close = true;
			return;
		}
		
		$this->closed = false;
	}
	
	public function setFrom($from) {
		$this->setString('from', $from);
	}
	
	public function setPort($port) {
		$this->setPositiveInteger('port', $port);
	}
	
	public function setSmtpHost($smtpHost) {
		$this->setString('smtpHost', $smtpHost);
	}
	
	public function setSubject($subject) {
		$this->setString('subject',  $subject);
	}
	
	public function setTo($to) {
		$this->setString('to',  $to);
	}

	public function setDry($dry) {
		$this->setBoolean('dry', $dry);
	}
	
	public function append(LoggerLoggingEvent $event) {
		$smtpHost = $this->smtpHost;
		$prevSmtpHost = ini_get('SMTP');
		if(!empty($smtpHost)) {
			ini_set('SMTP', $smtpHost);
		} 

		$smtpPort = $this->port;
		$prevSmtpPort= ini_get('smtp_port');		
		if($smtpPort > 0 and $smtpPort < 65535) {
			ini_set('smtp_port', $smtpPort);
		}

		// On unix only sendmail_path, which is PHP_INI_SYSTEM i.e. not changeable here, is used.

		$addHeader = empty($this->from) ? '' : "From: {$this->from}\r\n";
		
		if(!$this->dry) {
			$result = mail($this->to, $this->subject, $this->layout->getHeader() . $this->layout->format($event) . $this->layout->getFooter($event), $addHeader);			
		} else {
			echo "DRY MODE OF MAIL APP.: Send mail to: ".$this->to." with additional headers '".trim($addHeader)."' and content: ".$this->layout->format($event);
		}
			
		ini_set('SMTP', $prevSmtpHost);
		ini_set('smtp_port', $prevSmtpPort);
	}
}
