<?php

namespace bradford\tests;

use PHPUnit_Framework_TestCase;
use Bradford\src\Client;
use Bradford\src\Parser;

use Bradford\src\Services\GetOrderStatus;
use Bradford\src\Services\CreateOrder;
use Bradford\src\OrderFields;

/**
 *
 * @author Vincent Gabriel
 *
 */
class GetOrderStatusTest extends PHPUnit_Framework_TestCase
{
    /**
     * Setup a new order for testing @DeleteOrderTest will later delete it
     */
    public function setUp() {
        $client = new Client(BaseTest::$AMC_USERNAME, BaseTest::$AMC_PASSWORD, ['verify' => false]);
        $a = new CreateOrder($client);
        $a->setMemberId('nguyen00040');

        $fields = new OrderFields;
        $fields->setFields([
                'OrderId' => '12345',
                'PropAddress' => '5440 Tujunga Ave',
                'PropCity' => 'North Hollywood',
                'PropState' => 'CA',
                'PropZip' => '91601',
                'BorrowerFirstname' => 'Vincent',
                'BorrowerLastname' => 'Gabriel',
                'BorrowerEmail' => 'vgabriel@landmarknetwork.com',
                'BorrowerPhone' => '818-255-8345',
                'AppraisalType' => 'Appraisal Review',

                'PropAddress2' => 'APT 100',
                'PropType' => 'Single Family Residence',
                'LenderName' => 'Landmark Network Inc.',
                'LenderAddress' => '5161 Lankershim Blvd',
                'LenderCity' => 'North Hollywood',
                'LenderState' => 'CA',
                'LenderZip' => '91601',
                'LoanRefNumber' => '12345',
        ]);
        
        $a->setOrderFields($fields);
        $a->get()->process();
    }

    /**
     * Test Failure get order status
     */
    public function testGetOrderStatusFailed()
    {
        $client = new Client(BaseTest::$AMC_USERNAME, BaseTest::$AMC_PASSWORD, ['verify' => false]);
        $a = new GetOrderStatus($client);
        $a->setMemberId('nguyen00040');
        $a->setOrderId('noid');
        $a->get()->process();

        $this->assertEquals(360, $a->getErrorCode());
    }

    /**
     * Test success get order status
     */
    public function testGetOrderStatusPassed()
    {
        $client = new Client(BaseTest::$AMC_USERNAME, BaseTest::$AMC_PASSWORD, ['verify' => false]);
        $a = new GetOrderStatus($client);
        $a->setMemberId('nguyen00040');
        $a->setOrderId('12345');
        $a->get()->process();

        $this->assertEquals(0, $a->getErrorCode());
    }
}
