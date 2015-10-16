<?php

namespace Bradford\src\Services;

use Bradford\src\Services\ServiceAbstract;
use Bradford\src\Exception\ServiceException;
use Bradford\src\Services\ServiceOrderInterface;
use Bradford\src\OrderFields;

/**
 * Update Order
 * @package Bradford\Services
 * @author Vincent
 */
class UpdateOrder extends ServiceAbstract implements ServiceOrderInterface
{	
	/**
	 * @var method name - per API docs
	 */
	const METHOD_NAME = 'UpdateOrder.php';
	/**
	 * @var string root xml node element
	 */
	const XML_ROOT_NODE = 'UpdateOrder';

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

		$this->_response = $this->getHttpClient()->request('POST', $this->getMethodName(), ['form_params' => $this->getQuery()] + $this->getClient()->getHttpClientOptions());

		return $this;
	}

	/**
	 * Set order fields for the query to run prior to running it
	 * @param OrderFields $rows object
	 * @return bool
	 */
	public function setOrderFields(OrderFields $rows) {
		// init
		$fields = $rows->getFields();

		// Set order id if we have it
		if(isset($fields['OrderId'])) {
			$this->setOrderId($fields['OrderId']);
		}

		// Run validate
		$rows->validate();

		$this->setFields($fields);

		return true;
	}

	/**
	 * Validate this API call query prior to calling it
	 * @return object
	 */
	public function validate() {
		// Make sure we have fields set
		if(!$this->getFields()) {
			throw new ServiceException('You must set the order fields attributes');
		}

		// Make sure we have fields set
		if(!$this->getOrderId()) {
			throw new ServiceException("Please submit the Order ID");
		}

		// Make sure 
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

		foreach($this->getFields() as $key => $value) {
			$query[$key] = $value;
		}

		return $query;
	}
}