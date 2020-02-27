<?php

namespace Tests\Unit;

use App\Models\Subscriber;
use Tests\TestCase;

class ExampleTest extends TestCase
{

    public function setUp(): void
    {
        parent::setUp();

         $this->seed();
    }

    public function testBasicTest()
    {
        $this->assertTrue(true);
    }

    public function testDatabaseIsSeeded()
    {
        $this->assertEquals(5, Subscriber::count());

        $this->seed();

        $this->assertEquals(10, Subscriber::count());
    }
}
