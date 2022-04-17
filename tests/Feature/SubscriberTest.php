<?php

namespace Tests\Feature;

use App\Models\Field;
use App\Models\Subscriber;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class SubscriberTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_new_subscriber()
    {
        Sanctum::actingAs($user = User::factory()->create(), ['*']);
        
        $response = $this->post('api/subscribers',[
            'name'=> 'Test Subscriber',
            'email'=> 'testsubscriber@yahoo.com',
            'address'=> 'VA London 312',
            'state'=> 'active',
        ]);

        $subscriber = Subscriber::first();

        $response->assertStatus(201)
            ->assertJson([
                'data'=>[
                    'type'=>'subscribers',
                    'subscriber_id'=>$subscriber->id,
                    'attributes'=>[
                        'name'=>$subscriber->name,
                        'email'=>$subscriber->email,
                        'address'=>$subscriber->address,
                        'state'=>$subscriber->state,
                        ],
                ]
            ]);
    }

    public function test_user_can_view_a_subscriber()
    {
        Sanctum::actingAs($user = User::factory()->create(), ['*']);

        $subscriber = Subscriber::factory()->create();
        
        $response = $this->get("api/subscribers/{$subscriber->id}");

        $response->assertStatus(200)
            ->assertJson([
                'data'=>[
                    'type'=>'subscribers',
                    'subscriber_id'=>$subscriber->id,
                    'attributes'=>[
                        'name'=>$subscriber->name,
                        'email'=>$subscriber->email,
                        'address'=>$subscriber->address,
                        'state'=>$subscriber->state,
                        ],
                ]
            ]);
    }

    public function test_user_can_view_all_subscribers()
    {
        Sanctum::actingAs($user = User::factory()->create(), ['*']);

        Subscriber::factory(2)->create();
        
        $response = $this->get("api/subscribers");

        $subscribers = Subscriber::orderBy('id','desc')->get();

        $response->assertStatus(200)
            ->assertJson([
                'data' => [
                    [
                        'data'=>[
                            'type'=>'subscribers',
                            'subscriber_id'=>$subscribers->first()->id,
                            'attributes'=>[
                                'name'=>$subscribers->first()->name,
                                'email'=>$subscribers->first()->email,
                                'address'=>$subscribers->first()->address,
                                'state'=>$subscribers->first()->state,
                            ],
                        ]
                    ],
                    [
                        'data'=>[
                            'type'=>'subscribers',
                            'subscriber_id'=>$subscribers->last()->id,
                            'attributes'=>[
                                'name'=>$subscribers->last()->name,
                                'email'=>$subscribers->last()->email,
                                'address'=>$subscribers->last()->address,
                                'state'=>$subscribers->last()->state,
                            ],
                        ]
                    ]
                ]
            ]);
    }

    public function test_user_can_create_new_subscriber_along_with_new_fields()
    {
        $this->withoutExceptionHandling();
        
        Sanctum::actingAs($user = User::factory()->create(), ['*']);

        $area = Field::factory()->create(['value'=>'area','type' => 'string']);
        $age = Field::factory()->create(['value'=>'age','type' => 'number']);
        $student = Field::factory()->create(['value'=>'student','type' => 'boolean']);
        $birth_date = Field::factory()->create(['value'=>'birth_date','type' => 'date']);
        $fields = [$area->slug =>'Nairobi',$age->slug =>30, $student->slug =>false, $birth_date->slug =>Carbon::now()];
        
        $response = $this->post('api/subscribers',[
            'name'=> 'Test Subscriber',
            'email'=> 'testsubscriber@yahoo.com',
            'address'=> 'VA London 312',
            'state'=> 'active',
            'fields' => $fields
        ]);

        $subscriber = Subscriber::first();

        $response->assertStatus(201)
            ->assertJson([
                'data'=>[
                    'type'=>'subscribers',
                    'subscriber_id'=>$subscriber->id,
                    'attributes'=>[
                        'name'=>$subscriber->name,
                        'email'=>$subscriber->email,
                        'address'=>$subscriber->address,
                        'state'=>$subscriber->state,
                    ],
                ]
            ]);
    }

    public function test_subscriber_comes_with_its_own_fields()
    {
        Sanctum::actingAs($user = User::factory()->create(), ['*']);

        $subscriber = Subscriber::factory()->create();
        
        $new_field1 = Field::factory()->create();
        $new_field2 = Field::factory()->create();

        $subscriber->fields()->attach(['field_id'=>$new_field1->id],['field_value'=>'Trial']);
        $subscriber->fields()->attach(['field_id'=>$new_field2->id],['field_value'=>'Trial']);

        $fields = $subscriber->fields;

        $response = $this->get("api/subscribers/{$subscriber->id}");

        $response->assertStatus(200)
            ->assertJson([
                'data'=>[
                    'type'=>'subscribers',
                    'subscriber_id'=>$subscriber->id,
                    'attributes'=>[
                        'name'=>$subscriber->name,
                        'fieldDetails'=> [
                            'data' => [
                                    [
                                        'data'=>[
                                            'type'=>'fields',
                                            'field_id'=>$fields->first()->id,
                                            'attributes'=>[
                                                'value'=>$fields->first()->value,
                                                'type'=>$fields->first()->type,
                                            ],
                                        ]
                                    ],
                                    [
                                        'data'=>[
                                            'type'=>'fields',
                                            'field_id'=>$fields->last()->id,
                                            'attributes'=>[
                                                'value'=>$fields->last()->value,
                                                'type'=>$fields->last()->type,
                                            ],
                                        ]
                                    ]
                                ]
                            ]
                        ]
                    ]
            ]);
    }
}
