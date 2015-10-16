<?php

namespace bradford\tests;

use PHPUnit_Framework_TestCase;
use Bradford\src\Client;
use Bradford\src\Parser;

use Bradford\src\Services\DeleteOrder;

/**
 *
 * @author Vincent Gabriel
 *
 */
class DeleteOrderTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test Failure delete order
     */
    public function testDeleteOrderFailed()
    {
    	$client = new Client(BaseTest::$AMC_USERNAME, BaseTest::$AMC_PASSWORD, ['verify' => false]);
        $a = new DeleteOrder($client);
        $a->setMemberId('nguyen00040');
        $a->setOrderId('noid');
        $a->get()->process();

        $this->assertEquals(460, $a->getErrorCode());
    }

    /**
     * Test Success delete order
     */
    public function testDeleteOrderPassed()
    {
        $client = new Client(BaseTest::$AMC_USERNAME, BaseTest::$AMC_PASSWORD, ['verify' => false]);
        $a = new DeleteOrder($client);
        $a->setMemberId('nguyen00040');
        $a->setOrderId('12345');
        $a->get()->process();

        $this->assertEquals(0, $a->getErrorCode());
    }
}
