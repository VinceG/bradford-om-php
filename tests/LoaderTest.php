<?php

namespace bradford\tests;

use PHPUnit_Framework_TestCase;
use Bradford\src\Client;
use Bradford\src\Parser;

/**
 *
 * @author Vincent Gabriel
 *
 */
class LoaderTest extends PHPUnit_Framework_TestCase
{
    /**
     * Check if class is loaded correctly
     */
    public function testLoaded()
    {
        $a = new Client('test', 'test');
        $this->assertTrue($a instanceof Client, 'Class Client was not loaded');
    }

    /**
     * Attempt to parse
     */
    public function testParseXML()
    {
        $xml = <<<EOF
<?xml version="1.0"?>
<user_info>
    <total_users>3</total_users>
    <users>
        <item0>
            <id>1</id>
            <name>Nitya</name>
            <address>
                <country>India</country>
                <city>Kolkata</city>
                <zip>700102</zip>
            </address>
        </item0>
        <item1>
            <id>2</id>
            <name>John</name>
            <address>
                <country>USA</country>
                <city>Newyork</city>
                <zip>NY1234</zip>
            </address>
        </item1>
        <item2>
            <id>3</id>
            <name>Viktor</name>
            <address>
                <country>Australia</country>
                <city>Sydney</city>
                <zip>123456</zip>
            </address>
        </item2>
    </users>
</user_info>
EOF;
	
		$parsed = Parser::parse($xml);
		$this->assertNotEmpty($parsed);

		$this->assertArrayHasKey('total_users', $parsed);
    }
}
