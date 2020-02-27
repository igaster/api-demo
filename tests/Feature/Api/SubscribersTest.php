<?php

namespace Tests\Feature\Api;

use App\Models\Field;
use App\Models\Subscriber;
use Tests\TestCase;

class SubscribersTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->seedSubscribersWithFields(5);
    }

    public function testRetrieveASubscriber()
    {
        $response = $this->json('GET', 'api/subscribers/1');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'email',
                    'name',
                    'address',
                    'state',
                    'fields' => [
                        '*' => [
                            'title',
                            'type',
                        ]
                    ]
                ],
            ]);

        // $data = $response->json(); dd($data);
    }

    public function testSubscriberNotFound()
    {
        $response = $this->json('GET', 'api/subscribers/INVALID');

        $response->assertNotFound()
            ->assertJsonStructure([
                'message'
            ]);
    }

    public function testIndexSubscribers()
    {
        $response = $this->json('GET', 'api/subscribers');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'email',
                        'name',
                        'address',
                        'state',
                    ]
                ],
            ]);
    }

    public function testDeleteSubscriber()
    {
        $this->assertDatabaseHas('subscribers', [
            'id' => 1,
        ]);

        $response = $this->json('POST', 'api/subscribers/1', [
            '_method' => 'delete',
        ]);

        $response->assertStatus(204);

        $this->assertDatabaseMissing('subscribers', [
            'id' => 1,
        ]);
    }

    public function testCreateSubscriber()
    {
        $data = [
            'email' => 'test@email.com',
            'address' => 'dummy address',
            'name' => 'Giannis',
            'state' => Subscriber::STATE_UNCONFIRMED,
        ];

        $response = $this->json('POST', 'api/subscribers', $data);

        $response->assertStatus(201);

        $data['id'] = $response->json()['data']['id'];

        $this->assertDatabaseHas('subscribers', $data);
    }

    public function testUpdateSubscriber()
    {
        $subscriber = Subscriber::create([
            'name' => 'Giannis',
            'email' => 'test@email.com',
            'address' => 'dummy address',
            'state' => Subscriber::STATE_UNCONFIRMED,
        ]);

        $response = $this->json('POST', "api/subscribers/{$subscriber->id}", [
            'name' => 'George',
        ]);

        $response->assertOk();

        $this->assertEquals('George', $subscriber->refresh()->name);
    }

}
