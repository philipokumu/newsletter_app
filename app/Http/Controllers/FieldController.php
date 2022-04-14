<?php

namespace App\Http\Controllers;

use App\Http\Resources\Field as FieldResource;
use App\Http\Resources\FieldCollection;
use App\Models\Field;
use Illuminate\Http\Request;

class FieldController extends Controller
{
    public function index()
    {
        $fields = Field::orderBy('id','desc')->get();

        return new FieldCollection($fields);
    }

    public function store()
    {
        $data = request()->validate([
            'value'=> '',
            'type'=> '',
        ]);

        $field = Field::create($data);

        return new FieldResource($field);
    }

    public function show(Field $field)
    {
        return new FieldResource($field);
    }
}
