<?php

namespace Bradford\src\Services;

use Bradford\src\Client;
use Bradford\src\Parser;
use Bradford\src\Services\ServiceInterface;
use Bradford\src\Exception\ServiceException;
use GuzzleHttp\Client as HttpClient;

/**
 * Get Order Status
 * @package Bradford\Services
 * @author Vincent
 */
abstract class ServiceAbstract implements ServiceInterface
{	
	/**
	 * @var int member id
	 */
	protected $_memberId = null;
	/**
	 * @var string email address
	 */
	protected $_memberEmail = null;
	/**
	 * @var int|string order id
	 */
	protected $_orderId = null;
	/**
	 * @var object this api client
	 */
	protected $_client = null;
	/**
	 * @var object Guzzle client
	 */
	protected $_httpClient = null;
	/**
	 * @var object returned response
	 */
	protected $_response;
	/**
	 * @var int error code
	 */
	protected $_errorCode = 0;
	/**
	 * @var string error type
	 */
	protected $_errorType = null;
	/**
	 * @var string error message
	 */
	protected $_errorDescription = null;
	/**
	 * @var string returned result
	 */
	protected $_result = null;
	/**
	 * @var string xml body
	 */
	protected $_body = null;
	/**
	 * @var array fields
	 */
	protected $_fields = [];

	/**
	 * Service Constructor
	 * @param Client $client
	 */
	public function __construct(Client $client) {
		$this->_client = $client;
		// Load guzzle http
		$this->_httpClient = new HttpClient(['base_uri' => ($this->_client->getDebug() ? Client::TEST_ENDPOINT : Client::PROD_ENDPOINT) ]);
	}

	/**
	 * Get default query params
	 * @return array
	 */
	public function getDefaultQuery() {
		return ['AmcUsername' => $this->getClient()->getAmcUsername(), 'AmcPassword' => $this->getClient()->getAmcPassword()];
	}

	/**
	 * Run actual query to the API right after validation
	 * @return void
	 */
	public function get() {
		if(!$this->getMemberId() && !$this->getMemberEmail()) {
			throw new ServiceException('You must provide either the MemberId or AppraiserEmail Attribute');
		}

		// Run validation
		$this->validate();
	}

	/**
	 * Process returned xml body
	 * @return object self
	 */
	public function process() {
		$data = Parser::parse((string) $this->_response->getBody());
		$root = $data[$this->getXmlRootNode()];

		$this->setBody($data);

		if($root['Result']['Code'] > 0) {
			$this->setErrorCode($root['Result']['Code']);
			$this->setErrorType($root['Result']['Type']);
			$this->setErrorMessage($root['Result']['Description']);
		} else {
			// Set reponse data
			// fix casting of false as string since they send out 'false' for
			// missing information or invalid information
			if($root['ResponseData'] == 'false') {
				$root['ResponseData'] = false;
			}
			$this->setResult($root['ResponseData']);
		}

		return $this;
	}

	/**
	 * Return is error occured
	 * @return bool
	 */
	public function isError() {
		return (bool) $this->getErrorCode();
	}

	/**
	 * Set returned error code
	 * @param int $code
	 */
	public function setErrorCode($code) {
		$this->_errorCode = $code;
	}

	/**
	 * Return error code
	 * @return int
	 */
	public function getErrorCode() {
		return $this->_errorCode;
	}

	/**
	 * Set returned error type
	 * @param string $type
	 */
	public function setErrorType($type) {
		$this->_errorType = $type;
	}

	/**
	 * Return error type
	 * @return string
	 */
	public function getErrorType() {
		return $this->_errorType;
	}

	/**
	 * Set returned error message
	 * @param string $message
	 */
	public function setErrorMessage($message) {
		$this->_errorDescription = $message;
	}

	/**
	 * Return error message
	 * @return string
	 */
	public function getErrorMessage() {
		return $this->_errorDescription;
	}

	/**
	 * Set returned result
	 * @param string $result
	 */
	public function setResult($result) {
		$this->_result = $result;
	}

	/**
	 * Return result
	 * @return mixed
	 */
	public function getResult() {
		return $this->_result;
	}

	/**
	 * Set XML body returned
	 * @param string $body
	 */
	public function setBody($body) {
		$this->_body = $body;
	}

	/**
	 * Return XML body
	 * @return string
	 */
	public function getBody() {
		return $this->_body;
	}

	/**
	 * Set Client Fields
	 * @param array $fields
	 */
	public function setFields($fields) {
		$this->_fields = $fields;
	}

	/**
	 * Return client fields
	 * @return array
	 */
	public function getFields() {
		return $this->_fields;
	}

	/**
	 * Set member email
	 * @param string $email
	 */
	public function setMemberEmail($email) {
		$this->_memberEmail = $email;
	}

	/**
	 * Set member ID
	 * @param int $id
	 */
	public function setMemberId($id) {
		$this->_memberId = $id;
	}

	/**
	 * Set Order Refrence ID
	 * @param int $id
	 */
	public function setOrderId($id) {
		$this->_orderId = $id;
	}

	/**
	 * Return Guzzle HTTP Client
	 * @return object
	 */
	public function getHttpClient() {
		return $this->_httpClient;
	}

	/**
	 * Return this API client
	 * @return object
	 */
	public function getClient() {
		return $this->_client;
	}

	/**
	 * Return member email
	 * @return string
	 */
	public function getMemberEmail() {
		return $this->_memberEmail;
	}

	/**
	 * Return member id
	 * @return int
	 */
	public function getMemberId() {
		return $this->_memberId;
	}

	/**
	 * Return order id
	 * @return mixed
	 */
	public function getOrderId() {
		return $this->_orderId;
	}
}