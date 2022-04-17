<?php

namespace Tests\Feature;

use App\Models\Field;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class fieldsTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_add_new_field()
    {
        Sanctum::actingAs($user = User::factory()->create(), ['*']);

        $response = $this->post('api/fields',[
            'value'=> 'Area',
            'type'=> 'string',
        ]);

        $field = Field::first();
        $this->assertNotNull($field->slug);
        $response->assertStatus(201)
            ->assertJson([
                'data'=>[
                    'type'=>'fields',
                    'field_id'=>$field->id,
                    'attributes'=>[
                        'value'=>$field->value,
                        'type'=>$field->type,
                        'slug'=>$field->slug,
                        ],
                ]
            ]);
    }

    public function test_user_can_view_a_field()
    {
        Sanctum::actingAs($user = User::factory()->create(), ['*']);

        $field = Field::factory()->create();

        $response = $this->get("api/fields/{$field->slug}");

        $response->assertStatus(200)
            ->assertJson([
                'data'=>[
                    'type'=>'fields',
                    'field_id'=>$field->id,
                    'attributes'=>[
                        'value'=>$field->value,
                        'type'=>$field->type,
                        ],
                ]
            ]);
    }

    public function test_user_can_view_all_fields()
    {
        Sanctum::actingAs($user = User::factory()->create(), ['*']);

        Field::factory(2)->create();

        $response = $this->get("api/fields");

        $fields = Field::orderBy('id','desc')->get();

        $response->assertStatus(200)
            ->assertJson([
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
            ]);
    }
}
