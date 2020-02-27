<?php

namespace Tests;

use App\Models\Field;
use App\Models\Subscriber;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\SQLiteConnection;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\DB;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use RefreshDatabase;

    // -----------------------------------------------
    //  Global Setup (Run once)
    // -----------------------------------------------

    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();
        // ...
    }

    public static function tearDownAfterClass(): void
    {
        // ...
        parent::tearDownAfterClass();
    }


    // -----------------------------------------------
    //  Test Setup (Runs before each test)
    // -----------------------------------------------

    public function setUp(): void
    {
        parent::setUp();

        if (DB::connection() instanceof SQLiteConnection) {
            DB::statement(DB::raw('PRAGMA foreign_keys=on'));
        }
    }

    public function tearDown(): void
    {
        parent::tearDown();
    }

    // -----------------------------------------------
    //  Helpers
    // -----------------------------------------------

    protected function seedSubscribersWithFields(int $countSubscribers, int $countFields = 0): Collection
    {
        return factory(Subscriber::class, $countSubscribers)->create()->each(function (Subscriber $subscriber) use ($countFields){

            $subscriber->fields()->createMany(
                factory(Field::class, $countFields)->make()->toArray()
            );

        });
    }


}
