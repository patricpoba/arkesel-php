<?php

namespace PatricPoba\Arkesel\Tests;

use PatricPoba\Arkesel\Sms;
use Orchestra\Testbench\TestCase;
use PatricPoba\Arkesel\ArkeselServiceProvider;

class LaravelArkeselSmsTest extends TestCase
{

    protected function getPackageProviders($app)
    {
        return [ArkeselServiceProvider::class];
    }
    
    public function test_namespaces_are_valid()
	{ 
		// dd(app()->make('mNotifySms'));
		$this->assertInstanceOf(ArkeselServiceProvider::class, new ArkeselServiceProvider(app()));

		$this->assertInstanceOf(Sms::class, new Sms);

	}

	public function test_sms_facade_is_valid()
	{
		$this->assertInstanceOf(Sms::class, app()->make('arkesel-sms')); 
	}
}
