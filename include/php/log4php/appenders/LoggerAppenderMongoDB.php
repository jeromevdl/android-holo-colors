<?php
/**
 * Licensed to the Apache Software Foundation (ASF) under one or more
 * contributor license agreements.  See the NOTICE file distributed with
 * this work for additional information regarding copyright ownership.
 * The ASF licenses this file to You under the Apache License, Version 2.0
 * (the "License"); you may not use this file except in compliance with
 * the License.  You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
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
 * Appender for writing to MongoDB.
 * 
 * This class was originally contributed by Vladimir Gorej.
 * 
 * @link http://github.com/log4mongo/log4mongo-php Vladimir Gorej's original submission.
 * @link http://www.mongodb.org/ MongoDB website.
 * 
 * @version $Revision: 806678 $
 * @package log4php
 * @subpackage appenders
 * @since 2.1
 */
class LoggerAppenderMongoDB extends LoggerAppender {
	
	// ******************************************
	// ** Constants                            **
	// ******************************************
	
	/** Default prefix for the {@link $host}. */	
	const DEFAULT_MONGO_URL_PREFIX = 'mongodb://';
	
	/** Default value for {@link $host}, without a prefix. */
	const DEFAULT_MONGO_HOST = 'localhost';
	
	/** Default value for {@link $port} */
	const DEFAULT_MONGO_PORT = 27017;
	
	/** Default value for {@link $databaseName} */
	const DEFAULT_DB_NAME = 'log4php_mongodb';
	
	/** Default value for {@link $collectionName} */
	const DEFAULT_COLLECTION_NAME = 'logs';
	
	/** Default value for {@link $timeout} */
	const DEFAULT_TIMEOUT_VALUE = 3000;
	
	// ******************************************
	// ** Configurable parameters              **
	// ******************************************
	
	/** Server on which mongodb instance is located. */
	protected $host;
	
	/** Port on which the instance is bound. */
	protected $port;
	
	/** Name of the database to which to log. */
	protected $databaseName;
	
	/** Name of the collection within the given database. */
	protected $collectionName;
			
	/** Username used to connect to the database. */
	protected $userName;
	
	/** Password used to connect to the database. */
	protected $password;
	
	/** Timeout value used when connecting to the database (in milliseconds). */
	protected $timeout;
	
	// ******************************************
	// ** Member variables                     **
	// ******************************************

	/** 
	 * Connection to the MongoDB instance.
	 * @var Mongo
	 */
	protected $connection;
	
	/** 
	 * The collection to which log is written. 
	 * @var MongoCollection
	 */
	protected $collection;

	/** 
	 * Set to true if the appender can append. 
	 * @todo Maybe we should use $closed here instead? 
	 */
	protected $canAppend = false;
	
	/** Appender does not require a layout. */
	protected $requiresLayout = false;
		
	public function __construct($name = '') {
		parent::__construct($name);
		$this->host = self::DEFAULT_MONGO_URL_PREFIX . self::DEFAULT_MONGO_HOST;
		$this->port = self::DEFAULT_MONGO_PORT;
		$this->databaseName = self::DEFAULT_DB_NAME;
		$this->collectionName = self::DEFAULT_COLLECTION_NAME;
		$this->timeout = self::DEFAULT_TIMEOUT_VALUE;
	}
	
	/**
	 * Setup db connection.
	 * Based on defined options, this method connects to the database and 
	 * creates a {@link $collection}. 
	 *  
	 * @throws Exception if the attempt to connect to the requested database fails.
	 */
	public function activateOptions() {
		try {
			$this->connection = new Mongo(sprintf('%s:%d', $this->host, $this->port), array("timeout" => $this->timeout));
			$db	= $this->connection->selectDB($this->databaseName);
			if ($this->userName !== null && $this->password !== null) {
				$authResult = $db->authenticate($this->userName, $this->password);
				if ($authResult['ok'] == floatval(0)) {
					throw new Exception($authResult['errmsg'], $authResult['ok']);
				}
			}
			
			$this->collection = $db->selectCollection($this->collectionName);												 
		} catch (Exception $ex) {
			$this->canAppend = false;
			throw new LoggerException($ex);
		} 
			
		$this->canAppend = true;
	}		 
	
	/**
	 * Appends a new event to the mongo database.
	 * 
	 * @throws LoggerException If the pattern conversion or the INSERT statement fails.
	 */
	public function append(LoggerLoggingEvent $event) {
		if ($this->canAppend == true && $this->collection != null) {
			$document = $this->format($event);
			$this->collection->insert($document);			
		}
	}
	
	/**
	 * Converts the logging event into an array which can be logged to mongodb.
	 * 
	 * @param LoggerLoggingEvent $event
	 * @return array The array representation of the logging event.
	 */
	protected function format(LoggerLoggingEvent $event) {
		$timestampSec  = (int) $event->getTimestamp();
		$timestampUsec = (int) (($event->getTimestamp() - $timestampSec) * 1000000);

		$document = array(
			'timestamp'  => new MongoDate($timestampSec, $timestampUsec),
			'level'      => $event->getLevel()->toString(),
			'thread'     => (int) $event->getThreadName(),
			'message'    => $event->getMessage(),
			'loggerName' => $event->getLoggerName() 
		);	

		$locationInfo = $event->getLocationInformation();
		if ($locationInfo != null) {
			$document['fileName']   = $locationInfo->getFileName();
			$document['method']     = $locationInfo->getMethodName();
			$document['lineNumber'] = ($locationInfo->getLineNumber() == 'NA') ? 'NA' : (int) $locationInfo->getLineNumber();
			$document['className']  = $locationInfo->getClassName();
		}	

		$throwableInfo = $event->getThrowableInformation();
		if ($throwableInfo != null) {
			$document['exception'] = $this->formatThrowable($throwableInfo->getThrowable());
		}
		
		return $document;
	}
	
	/**
	 * Converts an Exception into an array which can be logged to mongodb.
	 * 
	 * Supports innner exceptions (PHP >= 5.3)
	 * 
	 * @param Exception $ex
	 * @return array
	 */
	protected function formatThrowable(Exception $ex) {
		$array = array(				
			'message'    => $ex->getMessage(),
			'code'       => $ex->getCode(),
			'stackTrace' => $ex->getTraceAsString(),
		);
                        
		if (method_exists($ex, 'getPrevious') && $ex->getPrevious() !== null) {
			$array['innerException'] = $this->formatThrowable($ex->getPrevious());
		}
			
		return $array;
	}
		
	/**
	 * Closes the connection to the logging database
	 */
	public function close() {
		if($this->closed != true) {
			$this->collection = null;
			if ($this->connection !== null) {
				$this->connection->close();
				$this->connection = null;	
			}					
			$this->closed = true;
		}
	}
	
	/** Sets the value of {@link $host} parameter. */
	public function setHost($host) {
		if (!preg_match('/^mongodb\:\/\//', $host)) {
			$host = self::DEFAULT_MONGO_URL_PREFIX . $host;
		}
		$this->host = $host;
	}
		
	/** Returns the value of {@link $host} parameter. */
	public function getHost() {
		return $this->host;
	}
		
	/** Sets the value of {@link $port} parameter. */
	public function setPort($port) {
		$this->setPositiveInteger('port', $port);
	}
		
	/** Returns the value of {@link $port} parameter. */
	public function getPort() {
		return $this->port;
	}
		
	/** Sets the value of {@link $databaseName} parameter. */
	public function setDatabaseName($databaseName) {
		$this->setString('databaseName', $databaseName);
	}
		
	/** Returns the value of {@link $databaseName} parameter. */
	public function getDatabaseName() {
		return $this->databaseName;
	}
	
	/** Sets the value of {@link $collectionName} parameter. */
	public function setCollectionName($collectionName) {
		$this->setString('collectionName', $collectionName);
	}
		
	/** Returns the value of {@link $collectionName} parameter. */
	public function getCollectionName() {
		return $this->collectionName;
	}
		
	/** Sets the value of {@link $userName} parameter. */
	public function setUserName($userName) {
		$this->setString('userName', $userName, true);
	}
	
	/** Returns the value of {@link $userName} parameter. */
	public function getUserName() {
		return $this->userName;
	}
		
	/** Sets the value of {@link $password} parameter. */
	public function setPassword($password) {
		$this->setString('password', $password, true);
	}
		
	/** Returns the value of {@link $password} parameter. */
	public function getPassword() {
		return $this->password;
	}
	
	/** Sets the value of {@link $timeout} parameter. */
	public function setTimeout($timeout) {
		$this->setPositiveInteger('timeout', $timeout);
	}

	/** Returns the value of {@link $timeout} parameter. */
	public function getTimeout() {
		return $this->timeout;
	}
	/** 
	 * Returns the mongodb connection.
	 * @return Mongo
	 */
	public function getConnection() {
		return $this->connection;
	}
	
	/** 
	 * Returns the active mongodb collection.
	 * @return MongoCollection
	 */
	public function getCollection() {
		return $this->collection;
	}
}
?>