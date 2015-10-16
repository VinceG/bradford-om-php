<?php

namespace bradford\tests;

use PHPUnit_Framework_TestCase;
use Bradford\src\Client;
use Bradford\src\Parser;

use Bradford\src\Exception\ServiceException;

use Bradford\src\Services\UpdateOrder;
use Bradford\src\Services\CreateOrder;
use Bradford\src\OrderFields;

/**
 *
 * @author Vincent Gabriel
 *
 */
class UpdateOrderTest extends PHPUnit_Framework_TestCase
{
    /**
     * Setup a new order for testing
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
     * Test update order failed
     */
    public function testUpdateOrderFailed()
    {
        $client = new Client(BaseTest::$AMC_USERNAME, BaseTest::$AMC_PASSWORD, ['verify' => false]);
        $a = new UpdateOrder($client);
        $a->setMemberId('nguyen00040');
        $a->setOrderId('12345');

        $fields = new OrderFields;
        $fields->setFields(['OrderId' => 12345, 'PropAddress' => '5440 Tujunga Ave']);
        

        try {
            $a->setOrderFields($fields);
            $a->get()->process();
        }

        catch (ServiceException $expected) {
            return;
        }

        $this->fail('An expected exception has not been raised.');
    }

    /**
     * Test update order invalid id
     */
    public function testUpdateOrderInvalidId()
    {
        $client = new Client(BaseTest::$AMC_USERNAME, BaseTest::$AMC_PASSWORD, ['verify' => false]);
        $a = new UpdateOrder($client);
        $a->setMemberId('nguyen00040');

        $fields = new OrderFields;
        $fields->setFields([
                'OrderId' => 'noid',
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

        $this->assertEquals(625, $a->getErrorCode());
    }

    /**
     * Test update order success
     */
    public function testUpdateOrderPassed()
    {
        $client = new Client(BaseTest::$AMC_USERNAME, BaseTest::$AMC_PASSWORD, ['verify' => false]);
        $a = new UpdateOrder($client);
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

        $this->assertNotEmpty($a->getResult());
    }
}
