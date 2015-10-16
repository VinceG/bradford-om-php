<?php

namespace Bradford\src\Services;

/**
 * Services Interface
 * @package Bradford\Services
 * @author Vincent
 */
interface ServiceInterface
{	
	public function getMethodName();
	public function getXmlRootNode();
	public function get();
	public function getQuery();
	public function validate();
}