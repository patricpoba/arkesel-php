<?php

namespace PatricPoba\Arkesel\Tests;

use Orchestra\Testbench\TestCase;
use PatricPoba\Arkesel\ArkeselServiceProvider;

class ExampleTest extends TestCase
{

    protected function getPackageProviders($app)
    {
        return [ArkeselServiceProvider::class];
    }
    
    /** @test */
    public function true_is_true()
    {
        $this->assertTrue(true);
    }
}
