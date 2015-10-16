<?php

namespace Bradford\src;

/**
 * Parse XML back and forth to be able to use it as PHP array/objects
 * @author Vincent
 */
class Parser
{	
	/**
	 * Parse XML
	 * @param string $xml
	 * @return string
	 */
	public static function parse($xml) {
		libxml_use_internal_errors(true);
	
		// Try loading using simple xml
		$data = simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOERROR | LIBXML_PARSEHUGE);

		return json_decode(json_encode($data), true);
	}
}