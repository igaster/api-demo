<?php

namespace Tests\Unit;

use App\Models\Field;
use App\Models\Subscriber;
use Tests\TestCase;

class SubscribersTest  extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $subscriber = factory(Subscriber::class)->create();

        $subscriber->fields()->createMany(
            factory(Field::class, 5)->make()->toArray()
        );
    }

    public function testSubscriberHasFields()
    {
        $subscriber = Subscriber::first();

        $this->assertEquals(5, $subscriber->fields->count());

        $this->assertInstanceOf(Field::class, $subscriber->fields()->first());
    }

    public function testFieldBelongsToSubscriber()
    {
        $field = Field::first();

        $this->assertInstanceOf(Subscriber::class, $field->subscriber);
    }

}
