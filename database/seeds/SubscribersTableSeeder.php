<?php

use App\Models\Field;
use App\Models\Subscriber;
use Illuminate\Database\Seeder;

class SubscribersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Subscriber::class, 5)->create()->each(function (Subscriber $subscriber) {

            $subscriber->fields()->createMany(
                factory(Field::class, 3)->make()->toArray()
            );

        });
    }
}
