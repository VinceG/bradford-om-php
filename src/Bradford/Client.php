<?php

namespace Bradford\src;

/**
 * Client class used to communicate with the API
 * @package Bradford
 * @author Vincent
 */
class Client
{
	/**
	 * @var string
	 */
	const CLIENT_VERSION = '0.1a';
	/**
	 * @var string
	 */
	const TEST_ENDPOINT = 'http://awstaging.appraisalworld.com/secure/ws/OrderManagementServices/';
	/**
	 * @var string
	 */
	const PROD_ENDPOINT = 'https://webservices.appraisalworld.com/ws/OrderManagementServices/';
	/**
	 * @var string
	 */
	protected $amcUsername = null;
	/**
	 * @var string
	 */
	protected $amcPassword = null;
	/**
	 * @var bool
	 */
	protected $isDebug = false;
	/**
	 * @var array
	 */
	protected $_httpClientOptions = [];

	/**
	 * Constructor for the Client to run API calls
	 * @param string $amcUsername
	 * @param string $amcPassword
	 * @param array $httpClientOptions
	 * @return void
	 */
	public function __construct($amcUsername, $amcPassword, $httpClientOptions=[]) {
		$this->setAmcUsername($amcUsername);
		$this->setAmcPassword($amcPassword);

		$this->setHttpClientOptions($httpClientOptions);
	}

	/**
	 * Set debug level
	 * @param bool $debug
	 * @return void
	 */
	public function setDebug($debug) {
		$this->isDebug = $debug;
	}

	/**
	 * get debug level used currently
	 * @return bool
	 */
	public function getDebug() {
		return $this->isDebug;
	}

	/**
	 * Set Guzzle HTTP Client Options
	 * @param array $options
	 * @return void
	 */
	public function setHttpClientOptions(array $options = []) {
		$this->_httpClientOptions = $options;
	}

	/**
	 * return Guzzle HTTP Client Options
	 * @return array
	 */
	public function getHttpClientOptions() {
		return $this->_httpClientOptions;
	}

	/**
	 * Set AMC username
	 * @param username $username
	 * @return void
	 */
	public function setAmcUsername($username) {
		$this->amcUsername = $username;
	}

	/**
	 * Set AMC password
	 * @param string $password
	 * @return void
	 */
	public function setAmcPassword($password) {
		$this->amcPassword = $password;
	}

	/**
	 * return amc username
	 * @return string
	 */
	public function getAmcUsername() {
		return $this->amcUsername;
	}

	/**
	 * return amc password
	 * @return string
	 */
	public function getAmcPassword() {
		return $this->amcPassword;
	}

	/**
	 * Return client version
	 * @return string
	 */
	public static function getVersion() {
		return self::CLIENT_VERSION;
	}
}