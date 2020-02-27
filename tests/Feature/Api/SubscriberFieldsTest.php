<?php

namespace Tests\Feature\Api;

use App\Models\Field;
use App\Models\Subscriber;
use Tests\TestCase;

class SubscriberFieldsTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->seedSubscribersWithFields(5,3);
    }

    public function testRetrieveSubscriberFields()
    {
        $response = $this->json('GET', 'api/subscribers/1/fields');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'title',
                        'type',
                    ]
                ],
            ]);

        // $data = $response->json(); dd($data);
    }

    public function testAddSubscriberField()
    {
        $subscriber = Subscriber::create([
            'name' => 'Giannis',
            'email' => 'test@email.com',
            'address' => 'dummy address',
            'state' => Subscriber::STATE_UNCONFIRMED,
        ]);

        $response = $this->json('POST', "api/subscribers/{$subscriber->id}/fields", [
            'title' => 'Field 1',
            'type' => Field::TYPE_STRING,
        ]);

        $response->assertStatus(201);

        $subscriber->load('fields');

        $this->assertEquals(1, $subscriber->fields->count());

        $this->assertEquals('Field 1', $subscriber->fields->first()->title);
    }

}
