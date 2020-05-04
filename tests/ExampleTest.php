<?php

namespace Patricpoba\ArkeselSms\Tests;

use Orchestra\Testbench\TestCase;
use Patricpoba\ArkeselSms\ArkeselSmsServiceProvider;

class ExampleTest extends TestCase
{

    protected function getPackageProviders($app)
    {
        return [ArkeselSmsServiceProvider::class];
    }
    
    /** @test */
    public function true_is_true()
    {
        $this->assertTrue(true);
    }
}
