<?php

namespace Bradford\src\Services;

use Bradford\src\Services\ServiceAbstract;
use Bradford\src\Exception\ServiceException;

/**
 * Get Order Status
 * @package Bradford\Services
 * @author Vincent
 */
class GetOrderStatus extends ServiceAbstract
{	
	/**
	 * @var method name - per API docs
	 */
	const METHOD_NAME = 'GetOrderStatus.php';
	/**
	 * @var string root xml node element
	 */
	const XML_ROOT_NODE = 'GetOrderStatus';

	/**
	 * Return the method name for the parent class to use
	 * @return string
	 */
	public function getMethodName() {
		return self::METHOD_NAME;
	}

	/**
	 * Return the xml root node tag name for the parent class to use
	 * @return string
	 */
	public function getXmlRootNode() {
		return self::XML_ROOT_NODE;
	}

	/**
	 * Run API call to the webserver
	 * @return object
	 */
	public function get() {
		// Run parent for validation
		parent::get();

		$this->_response = $this->getHttpClient()->request('GET', $this->getMethodName(), ['query' => $this->getQuery()] + $this->getClient()->getHttpClientOptions());

		return $this;
	}

	/**
	 * Validate this API call query prior to calling it
	 * @return object
	 */
	public function validate() {
		// Make sure order id is set
		if(!$this->getOrderId()) {
			throw new ServiceException("Please submit the Order ID");
		}
		return true;
	}

	/**
	 * Return the query params for the API call
	 * @return object
	 */
	public function getQuery() {
		$query = $this->getDefaultQuery();
		// This query uses member id only
		if($this->getMemberId()) {
			$query['MemberId'] = $this->getMemberId();
		}

		if($this->getOrderId()) {
			$query['OrderId'] = $this->getOrderId();
		}

		return $query;
	}
}