<?php

namespace App\Http\Requests;

use App\Models\Field;
use App\Rules\FieldTypeRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SubscriberRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name'=> 'required|min:3',
            'email'=> 'required|email:rfc,dns',
            'address'=> 'required',
            'state'=> ['required',Rule::in(['active', 'unsubscribed','junk','bounced','unconfirmed'])]
        ];

        // Validate the new extra fields
        if (request()->has('fields')) {
            $fields = request()->get('fields');
            foreach($fields as $field => $value)
            {
                $rules['fields.'.$field] = ['required', new FieldTypeRule];
            }
        }

        return $rules;
    }
}
