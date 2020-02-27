<?php

namespace Tests\Feature\Api;

use App\Models\Field;
use App\Models\Subscriber;
use Tests\TestCase;

class FieldsTest extends TestCase
{

    public function testUpdateField()
    {
        $this->seedSubscribersWithFields(1,3);

        $field = Subscriber::first()->fields()->create([
           'title' => '1st Field',
           'type' => Field::TYPE_STRING,
        ]);

        $response = $this->json('POST', "api/fields/{$field->id}", [
            'title' => '2nd Field',
        ]);

        $response->assertOk();

        $this->assertEquals('2nd Field', $field->refresh()->title);
    }

    public function testDeleteField()
    {
        $this->seedSubscribersWithFields(1,3);

        $subscriber = Subscriber::with('fields')->first();
        $field = $subscriber->fields->first();

        $this->assertEquals(3, $subscriber->fields->count());

        $this->assertDatabaseHas('fields', [
            'id' => $field->id,
        ]);

        $response = $this->json('POST', "api/fields/{$field->id}", [
            '_method' => 'delete',
        ]);

        $response->assertStatus(204);

        $this->assertEquals(2, $subscriber->refresh()->fields->count());

        $this->assertDatabaseMissing('fields', [
            'id' => $field->id,
        ]);
    }

}
