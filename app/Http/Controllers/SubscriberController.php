<?php

namespace App\Http\Controllers;

use App\Http\Resources\Subscriber as SubscriberResource;
use App\Http\Resources\SubscriberCollection;
use App\Models\Subscriber;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function index()
    {
        $subscribers = Subscriber::orderBy('id','desc')->get();

        return new SubscriberCollection($subscribers);
    }

    public function store()
    {
        $data = request()->validate([
            'name'=> '',
            'email'=> '',
            'address'=> '',
            'state'=> ''
        ]);

        $subscriber = Subscriber::create($data);

        return new SubscriberResource($subscriber);
    }

    public function show(Subscriber $subscriber)
    {
        return new SubscriberResource($subscriber);
    }
}
