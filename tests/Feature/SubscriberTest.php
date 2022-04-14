<?php

namespace Tests\Feature;

use App\Models\Subscriber;
use App\Models\User;
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

    public function test_user_can_view_subscribers()
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
}
