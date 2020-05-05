<?php

namespace PatricPoba\Arkesel\Tests;

use PatricPoba\Arkesel\Sms;
use Orchestra\Testbench\TestCase;

class SmsTest extends TestCase 
{
    protected $sms ;
 
	protected $testValues = [
							'senderId' => 'MyStartUp',
							'apiKey'   => 'SDERWCSXCVEARAVESARAVES'
						];
	

	function setup() : void
	{   
		$this->sms = new Sms($this->testValues['senderId'], $this->testValues['apiKey']);
    }
    

    public function test_sms_end_point_is_valid()
	{ 
		return $this->assertSame(Sms::SMS_ENDPOINT, 'https://sms.arkesel.com/sms/api');
    }
    

    public function test_new_instance_with_constructor_arguments()
	{   
		$this->assertEquals($this->testValues['senderId'], 
							$this->sms->getSenderId(), 
							'Instance var $senderId not equal to '. $this->testValues['senderId']);

		$this->assertEquals($this->testValues['apiKey'], 
							$this->sms->getApiKey(), 
							'Instance var $apiKey not equal to '. $this->testValues['apiKey']); 
	}


	public function test_contructor_arguments_can_be_overridden()
	{  
		# re-setup
		// $this->setup(); 
		$newSenderId = 'MyBusiness';		
		$this->sms->from($newSenderId); 
		$this->assertEquals($this->sms->getSenderId(), $newSenderId, 'Constructor variable $sender_id could not be overridden');

        
		$newApiKey = 'fqwerxcfqwerfxcqerf';
		$this->sms->setApiKey($newApiKey); 
		$this->assertEquals($this->sms->getApiKey(), $newApiKey, 'Constructor variable $api_key could not be overridden');
  
	}
}
