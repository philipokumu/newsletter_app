<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubscriberRequest;
use App\Http\Resources\Subscriber as SubscriberResource;
use App\Http\Resources\SubscriberCollection;
use App\Models\Field;
use App\Models\Subscriber;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function index()
    {
        $subscribers = Subscriber::orderBy('id','desc')->get();

        return new SubscriberCollection($subscribers);
    }

    public function store(SubscriberRequest $request)
    {
        $subscriber = Subscriber::create(request()->only(['name', 'email','address','state']));

        if (request()->has('fields')) {
            
            foreach (request()->get('fields') as $key => $value) {
                $subscriber->fields()->attach(['field_id'=>Field::where('slug',$key)->first()->id],['field_value'=>$value]);
            }
        }

        return new SubscriberResource($subscriber);
    }

    public function show(Subscriber $subscriber)
    {
        return new SubscriberResource($subscriber);
    }
}
