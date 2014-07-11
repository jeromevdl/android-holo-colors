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
 * A convenience class to convert property values to specific types.
 *
 * @version $Revision: 1237446 $ 
 * @package log4php
 * @subpackage helpers
 * @since 0.5
 */
class LoggerOptionConverter {

	const DELIM_START = '${';
	const DELIM_STOP = '}';
	const DELIM_START_LEN = 2;
	const DELIM_STOP_LEN = 1;
	
	/** String values which are converted to boolean TRUE. */
	private static $trueValues = array('1', 'true', 'yes', 'on');
	
	/** 
	 * String values which are converted to boolean FALSE.
	 * 
	 * Note that an empty string must convert to false, because 
	 * parse_ini_file() which is used for parsing configuration 
	 * converts the value _false_ to an empty string.
	 */
	private static $falseValues = array('0', 'false', 'no', 'off', '');
	
	/**
	 * Read a predefined var.
	 *
	 * It returns a value referenced by <var>$key</var> using this search criteria:
	 * - if <var>$key</var> is a constant then return it. Else
	 * - if <var>$key</var> is set in <var>$_ENV</var> then return it. Else
	 * - return <var>$def</var>. 
	 *
	 * @param string $key The key to search for.
	 * @param string $def The default value to return.
	 * @return string	the string value of the system property, or the default
	 *					value if there is no property with that key.
	 */
	public static function getSystemProperty($key, $def) {
		if(defined($key)) {
			return (string)constant($key);
		} else if(isset($_SERVER[$key])) {
			return (string)$_SERVER[$key];
		} else if(isset($_ENV[$key])) {
			return (string)$_ENV[$key];
		} else {
			return $def;
		}
	}

	/**
	 * If <var>$value</var> is <i>true</i>, then <i>true</i> is
	 * returned. If <var>$value</var> is <i>false</i>, then
	 * <i>true</i> is returned. Otherwise, <var>$default</var> is
	 * returned.
	 *
	 * <p>Case of value is unimportant.</p>
	 *
	 * @param string $value
	 * @param boolean $default
	 * @return boolean
	 */
	public static function toBoolean($value, $default=true) {
		if (is_null($value)) {
			return $default;
		} elseif (is_string($value)) {
			$trimmedVal = strtolower(trim($value));
			if("1" == $trimmedVal or "true" == $trimmedVal or "yes" == $trimmedVal or "on" == $trimmedVal) {
				return true;
			} else if ("" == $trimmedVal or "0" == $trimmedVal or "false" == $trimmedVal or "no" == $trimmedVal or "off" == $trimmedVal) {
				return false;
			}
		} elseif (is_bool($value)) {
			return $value;
		} elseif (is_int($value)) {
			return !($value == 0); // true is everything but 0 like in C 
		}
		
		return $default;
	}

	/** Converts $value to boolean, or throws an exception if not possible. */
	public static function toBooleanEx($value) {
		if (isset($value)) {
			if (is_bool($value)) {
				return $value;
			}
			$value = strtolower(trim($value));
			if (in_array($value, self::$trueValues)) {
				return true;
			}
			if (in_array($value, self::$falseValues)) {
				return false;
			}
		}
		
		throw new LoggerException("Given value [" . var_export($value, true) . "] cannot be converted to boolean.");
	}
	
	/**
	 * @param string $value
	 * @param integer $default
	 * @return integer
	 */
	public static function toInt($value, $default) {
		$value = trim($value);
		if(is_numeric($value)) {
			return (int)$value;
		} else {
			return $default;
		}
	}
	
	
	/** 
	 * Converts $value to integer, or throws an exception if not possible. 
	 * Floats cannot be converted to integer.
	 */
	public static function toIntegerEx($value) {
		if (is_integer($value)) {
			return $value;
		}
		if (is_numeric($value) && ($value == (integer) $value)) {
			return (integer) $value;
		}
	
		throw new LoggerException("Given value [" . var_export($value, true) . "] cannot be converted to integer.");
	}
	
	/**
	 * Converts $value to integer, or throws an exception if not possible.
	 * Floats cannot be converted to integer.
	 */
	public static function toPositiveIntegerEx($value) {
		if (is_integer($value) && $value > 0) {
			return $value;
		}
		if (is_numeric($value) && ($value == (integer) $value) && $value > 0) {
			return (integer) $value;
		}
	
		throw new LoggerException("Given value [" . var_export($value, true) . "] cannot be converted to a positive integer.");
	}

	/**
	 * Converts a standard or custom priority level to a Level
	 * object.
	 *
	 * <p> If <var>$value</var> is of form "<b>level#full_file_classname</b>",
	 * where <i>full_file_classname</i> means the class filename with path
	 * but without php extension, then the specified class' <i>toLevel()</i> method
	 * is called to process the specified level string; if no '#'
	 * character is present, then the default {@link LoggerLevel}
	 * class is used to process the level value.</p>
	 *
	 * <p>As a special case, if the <var>$value</var> parameter is
	 * equal to the string "NULL", then the value <i>null</i> will
	 * be returned.</p>
	 *
	 * <p>If any error occurs while converting the value to a level,
	 * the <var>$defaultValue</var> parameter, which may be
	 * <i>null</i>, is returned.</p>
	 *
	 * <p>Case of <var>$value</var> is insignificant for the level level, but is
	 * significant for the class name part, if present.</p>
	 *
	 * @param string $value
	 * @param LoggerLevel $defaultValue
	 * @return LoggerLevel a {@link LoggerLevel} or null
	 */
	public static function toLevel($value, $defaultValue) {
		if($value === null) {
			return $defaultValue;
		}
		$hashIndex = strpos($value, '#');
		if($hashIndex === false) {
			if("NULL" == strtoupper($value)) {
				return null;
			} else {
				// no class name specified : use standard Level class
				return LoggerLevel::toLevel($value, $defaultValue);
			}
		}

		$result = $defaultValue;

		$clazz = substr($value, ($hashIndex + 1));
		$levelName = substr($value, 0, $hashIndex);

		// This is degenerate case but you never know.
		if("NULL" == strtoupper($levelName)) {
			return null;
		}

		$clazz = basename($clazz);

		if(class_exists($clazz)) {
			$result = @call_user_func(array($clazz, 'toLevel'), $levelName, $defaultValue);
			if(!$result instanceof LoggerLevel) {
				$result = $defaultValue;
			}
		} 
		return $result;
	}
	
	
	/** Converts the value to a level. Throws an exception if not possible. */
	public static function toLevelEx($value) {
		if ($value instanceof LoggerLevel) {
			return $value;
		}
		$level = LoggerLevel::toLevel($value);
		if ($level === null) {
			throw new LoggerException("Given value [" . var_export($value, true) . "] cannot be converted to a logger level.");
		}
		return $level;
	}

	/**
	 * @param string $value
	 * @param float $default
	 * @return float
	 */
	public static function toFileSize($value, $default) {
		if($value === null) {
			return $default;
		}

		$s = strtoupper(trim($value));
		$multiplier = (float)1;
		if(($index = strpos($s, 'KB')) !== false) {
			$multiplier = 1024;
			$s = substr($s, 0, $index);
		} else if(($index = strpos($s, 'MB')) !== false) {
			$multiplier = 1024 * 1024;
			$s = substr($s, 0, $index);
		} else if(($index = strpos($s, 'GB')) !== false) {
			$multiplier = 1024 * 1024 * 1024;
			$s = substr($s, 0, $index);
		}
		if(is_numeric($s)) {
			return (float)$s * $multiplier;
		} 
		return $default;
	}
	

	/**
	 * Converts a value to a valid file size (integer).
	 * 
	 * Supports 'KB', 'MB' and 'GB' suffixes, where KB = 1024 B etc. 
	 *
	 * The final value will be rounded to the nearest integer.
	 *
	 * Examples:
	 * - '100' => 100
	 * - '100.12' => 100
	 * - '100KB' => 102400
	 * - '1.5MB' => 1572864
	 * 
	 * @param mixed $value File size (optionally with suffix).
	 * @return integer Parsed file size.
	 */
	public static function toFileSizeEx($value) {
		
		if (empty($value)) {
			throw new LoggerException("Empty value cannot be converted to a file size.");
		}
		
		if (is_numeric($value)) {
			return (integer) $value;
		}
		
		if (!is_string($value)) {
			throw new LoggerException("Given value [" . var_export($value, true) . "] cannot be converted to a file size.");
		}
		
		$str = strtoupper(trim($value));
		$count = preg_match('/^([0-9.]+)(KB|MB|GB)?$/', $str, $matches);
		
		if ($count > 0) {
			$size = $matches[1];
			$unit = $matches[2];
			
			switch($unit) {
				case 'KB': $size *= pow(1024, 1); break;
				case 'MB': $size *= pow(1024, 2); break;
				case 'GB': $size *= pow(1024, 3); break;
			}
			
			return (integer) $size;
		}
		
		throw new LoggerException("Given value [$value] cannot be converted to a file size.");
	}

	/** 
	 * Converts a value to string, or throws an exception if not possible. 
	 * 
	 * Objects can be converted to string if they implement the magic 
	 * __toString() method.
	 * 
	 */
	public static function toStringEx($value) {
		if (is_string($value)) {
			return $value;
		}
		if (is_numeric($value)) {
			return (string) $value;
		}
		if (is_object($value) && method_exists($value, '__toString')) {
			return (string) $value;
		}
	
		throw new LoggerException("Given value [" . var_export($value, true) . "] cannot be converted to string.");
	}
	
	
	/**
	 * Find the value corresponding to <var>$key</var> in
	 * <var>$props</var>. Then perform variable substitution on the
	 * found value.
	 *
	 * @param string $key
	 * @param array $props
	 * @return string
	 */
	public static function findAndSubst($key, $props) {
		$value = @$props[$key];

		// If coming from the LoggerConfiguratorIni, some options were
		// already mangled by parse_ini_file:
		//
		// not specified      => never reaches this code
		// ""|off|false|null  => string(0) ""
		// "1"|on|true        => string(1) "1"
		// "true"             => string(4) "true"
		// "false"            => string(5) "false"
		// 
		// As the integer 1 and the boolean true are therefore indistinguable
		// it's up to the setter how to deal with it, they can not be cast
		// into a boolean here. {@see toBoolean}
		// Even an empty value has to be given to the setter as it has been
		// explicitly set by the user and is different from an option which
		// has not been specified and therefore keeps its default value.
		//
		// if(!empty($value)) {
			return LoggerOptionConverter::substVars($value, $props);
		// }
	}

	/**
	 * Perform variable substitution in string <var>$val</var> from the
	 * values of keys found with the {@link getSystemProperty()} method.
	 * 
	 * <p>The variable substitution delimeters are <b>${</b> and <b>}</b>.
	 * 
	 * <p>For example, if the "MY_CONSTANT" contains "value", then
	 * the call
	 * <code>
	 * $s = LoggerOptionConverter::substVars("Value of key is ${MY_CONSTANT}.");
	 * </code>
	 * will set the variable <i>$s</i> to "Value of key is value.".</p>
	 * 
	 * <p>If no value could be found for the specified key, then the
	 * <var>$props</var> parameter is searched, if the value could not
	 * be found there, then substitution defaults to the empty string.</p>
	 * 
	 * <p>For example, if {@link getSystemProperty()} cannot find any value for the key
	 * "inexistentKey", then the call
	 * <code>
	 * $s = LoggerOptionConverter::substVars("Value of inexistentKey is [${inexistentKey}]");
	 * </code>
	 * will set <var>$s</var> to "Value of inexistentKey is []".</p>
	 * 
	 * <p>A warn is thrown if <var>$val</var> contains a start delimeter "${" 
	 * which is not balanced by a stop delimeter "}" and an empty string is returned.</p>
	 * 
	 * @param string $val The string on which variable substitution is performed.
	 * @param array $props
	 * @return string
	 */
	 // TODO: this method doesn't work correctly with key = true, it needs key = "true" which is odd
	public static function substVars($val, $props = null) {
		$sbuf = '';
		$i = 0;
		while(true) {
			$j = strpos($val, self::DELIM_START, $i);
			if($j === false) {
				// no more variables
				if($i == 0) { // this is a simple string
					return $val;
				} else { // add the tail string which contails no variables and return the result.
					$sbuf .= substr($val, $i);
					return $sbuf;
				}
			} else {
			
				$sbuf .= substr($val, $i, $j-$i);
				$k = strpos($val, self::DELIM_STOP, $j);
				if($k === false) {
					// LoggerOptionConverter::substVars() has no closing brace. Opening brace
					return '';
				} else {
					$j += self::DELIM_START_LEN;
					$key = substr($val, $j, $k - $j);
					// first try in System properties
					$replacement = LoggerOptionConverter::getSystemProperty($key, null);
					// then try props parameter
					if($replacement == null and $props !== null) {
						$replacement = @$props[$key];
					}

					if(!empty($replacement)) {
						// Do variable substitution on the replacement string
						// such that we can solve "Hello ${x2}" as "Hello p1" 
						// the where the properties are
						// x1=p1
						// x2=${x1}
						$recursiveReplacement = LoggerOptionConverter::substVars($replacement, $props);
						$sbuf .= $recursiveReplacement;
					}
					$i = $k + self::DELIM_STOP_LEN;
				}
			}
		}
	}

}
