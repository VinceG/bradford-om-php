<?php

namespace Bradford\src\Services;

use Bradford\src\OrderFields;

/**
 * Services Order Interface
 * @package Bradford\Services
 * @author Vincent
 */
interface ServiceOrderInterface
{	
	public function setOrderFields(OrderFields $fields);
}