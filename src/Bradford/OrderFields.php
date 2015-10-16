<?php

namespace Bradford\src;

use Bradford\src\Exception\ServiceException;

/**
 * Order Fields manager for Create/Update Order API Calls
 * @package Bradford
 * @author Vincent
 */
class OrderFields
{	
	/**
	 * @var array - appraisal types list accepted by Bradford
	 */
	public static $appraisalTypes = [
		'Appraisal Review',
		'Appraisal Update',
		'Commercial Appraisal',
		'Complete Valuation Report',
		'Completion Certificate',
		'Desktop Property Valuation',
		'Driveby Property Valuation',
		'Exterior Inspection',
		'Income Property Appraisal',
		'Inspection',
		'Other',
		'Rent Survey',
	];

	/**
	 * @var array - loan purposes list accepted by Bradford
	 */
	public static $loanPurposes = [
		'Divorce',
		'Estate Planning',
		'Other',
		'Purchase',
		'Refinance',
		'Second Mortgage',
	];

	/**
	 * @var array - property types list accepted by Bradford
	 */
	public static $propertyTypes = [
		'Church',
		'Commercial Non Residential',
		'Condominium',
		'Cooperative',
		'Farm',
		'Home And Business Combined',
		'Manufacture/Mobile Home',
		'Mixed Use Residential',
		'Multifamily More Than Four Units',
		'Other',
		'Single Family Residence',
		'Townhouse',
		'Two To Four Unit Property',
		'Vacant Land',
	];

	/**
	 * @var array - required fields for creating or updating orders
	 */
	protected static $requiredFields = [
		'OrderId' => 'AMC order reference idenitfier',
		'PropAddress' => 'property street address',
		'PropCity' => 'property city',
		'PropState' => 'property state',
		'PropZip' => 'property zipcode',
		'BorrowerFirstname' => 'property owner first name',
		'BorrowerLastname' => 'property owner last name',
		'BorrowerEmail' => 'property owner email',
		'BorrowerPhone' => 'property owner phone',
		'AppraisalType' => 'appraisal type',
	];

	/**
	 * @var array - optional fields for creating or updating orders
	 */
	protected static $optionalFields = [
		'PropAddress2' => 'property street address2',
		'PropType' => 'property type',
		'FhaCaseNbr' => 'fha case number',
		'LegalDescription' => 'legal description',
		'LenderName' => 'lender name',
		'LenderAddress' => 'lender address',
		'LenderCity' => 'lender city',
		'LenderState' => 'lender state',
		'LenderZip' => 'lender zipcode',
		'LoanPurpose' => 'purpose of loan',
		'LoanRefNumber' => 'loan reference number',
		'DueDate' => 'due date',
		'ScheduledDate' => 'scheduled date',
		'SubmittedDate' => 'submitted date',
	];

	/**
	 * @var array - list of fields set
	 */
	protected $_fields = [];

	/**
	 * Magic method to set properties as fields
	 * @param string $key
	 * @param string $value
	 * @return void
	 */
	public function __set($key, $value) {
		$this->setField($key, $value);
	}

	/**
	 * Magic method to get properties as fields
	 * @param string $key
	 * @return mixed
	 */
	public function __get($key) {
		return $this->getField($key);
	}

	/**
	 * method to set field key and value
	 * @param string $key
	 * @param string $value
	 * @return void
	 */
	public function setField($key, $value) {
		$this->_fields[$key] = $value;
	}

	/**
	 * Set multiple fields
	 * @param array $fields
	 * @return void
	 */
	public function setFields($fields) {
		foreach($fields as $key => $value) {
			$this->setField($key, $value);
		}
	}

	/**
	 * Magic method to get properties as fields
	 * @param string $key
	 * @return mixed
	 */
	public function getField($key) {
		return isset($this->_fields[$key]) ?: null;
	}

	/**
	 * Return array of fields
	 * @return array
	 */
	public function getFields() {
		return $this->_fields;
	}

	/**
	 * Validate set fields to make sure all required fields are set
	 * @throws ServiceException
	 * @return bool on success | exception on failure
	 */
	public function validate() {
		// We make sure we have all the requried fields filled out
		foreach(self::$requiredFields as $key => $value) {
			if(!$this->getField($key)) {
				throw new ServiceException(sprintf("Please fill out the '%s' - %s", $key, $value));
			}
		}

		return true;
	}
}