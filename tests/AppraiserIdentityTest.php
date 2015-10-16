<?php

namespace bradford\tests;

use PHPUnit_Framework_TestCase;
use Bradford\src\Client;
use Bradford\src\Parser;

use Bradford\src\Services\AppraiserIdentity;

/**
 *
 * @author Vincent Gabriel
 *
 */
class AppraiserIdentityTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test appariser identity via member id
     */
    public function testAppraiserIdentityMemberId()
    {
    	$client = new Client(BaseTest::$AMC_USERNAME, BaseTest::$AMC_PASSWORD, ['verify' => false]);
        $a = new AppraiserIdentity($client);
        $a->setMemberId('nguyen00040');
        $a->get()->process();

        $this->assertNotFalse($a->getResult());

        $client = new Client(BaseTest::$AMC_USERNAME, BaseTest::$AMC_PASSWORD, ['verify' => false]);
        $a = new AppraiserIdentity($client);
        $a->setMemberId('invalidname');
        $a->get()->process();

        $this->assertFalse((bool) $a->getResult());
    }

    /**
     * Test appraiser identity via email address
     */
    public function testAppraiserIdentityEmail()
    {
    	$client = new Client(BaseTest::$AMC_USERNAME, BaseTest::$AMC_PASSWORD, ['verify' => false]);
        $a = new AppraiserIdentity($client);
        $a->setMemberEmail('pam@bradfordsoftware.com');
        $a->get()->process();

        $this->assertNotFalse($a->getResult());

        $client = new Client(BaseTest::$AMC_USERNAME, BaseTest::$AMC_PASSWORD, ['verify' => false]);
        $a = new AppraiserIdentity($client);
        $a->setMemberEmail('invalidname');
        $a->get()->process();

        $this->assertFalse((bool) $a->getResult());
    }
}
