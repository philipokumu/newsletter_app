<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory()->create([
            'email' => 'user@example.com',
        ]);

        $subscribers = \App\Models\Subscriber::factory(10)->create();
        
        $fields_string = \App\Models\Field::factory()->create(['type'=>'string','value'=>'country']);
        $fields_boolean = \App\Models\Field::factory()->create(['type'=>'boolean','value'=>'isSwimmer']);
        $fields_number = \App\Models\Field::factory()->create(['type'=>'number','value'=>'height']);
        $fields_date = \App\Models\Field::factory()->create(['type'=>'date','value'=>'birth_date']);
        foreach ($subscribers as $subscriber) {
            $subscriber->fields()->attach(['field_id'=>$fields_string->id], ['field_value'=>array_rand(array_flip(['Germany','France']))]);
            $subscriber->fields()->attach(['field_id'=>$fields_boolean->id],['field_value'=>array_rand(array_flip(['true','false']))]);
            $subscriber->fields()->attach(['field_id'=>$fields_number->id],['field_value'=>rand(5,20)]);
            $subscriber->fields()->attach(['field_id'=>$fields_date->id],['field_value'=>Carbon::now()]);
        }
    }
}
