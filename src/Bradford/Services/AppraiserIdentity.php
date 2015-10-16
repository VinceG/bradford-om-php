<?php

namespace Bradford\src\Services;

use Bradford\src\Services\ServiceAbstract;

/**
 * Appraiser Identity
 * @package Bradford\Services
 * @author Vincent
 */
class AppraiserIdentity extends ServiceAbstract
{	
	/**
	 * @var method name - per API docs
	 */
	const METHOD_NAME = 'AppraiserIdentity.php';

	/**
	 * @var string root xml node element
	 */
	const XML_ROOT_NODE = 'AppraiserIdentity';

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

		// return an instance for chaining
		return $this;
	}

	/**
	 * Validate this API call query prior to calling it
	 * @return object
	 */
	public function validate() {
		// Perform validation prior to calling the request
		
		return true;
	}

	/**
	 * Return the query params for the API call
	 * @return object
	 */
	public function getQuery() {
		$query = $this->getDefaultQuery();
		if($this->getMemberId()) {
			$query['MemberId'] = $this->getMemberId();
		} 

		if($this->getMemberEmail()) {
			$query['AppraiserEmail'] = $this->getMemberEmail();
		}

		return $query;
	}
}