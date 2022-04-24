<?php

namespace App\Rules;

use App\Models\Field;
use Illuminate\Contracts\Validation\Rule;

class FieldTypeRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // dd($value);
        $slug = str_replace("fields.","", $attribute);
        $field = Field::where('slug',$slug)->select('type')->first();
        $field_type = $field->type;
        $result = '';
        
        if ($field_type === 'number') {
            $result = is_numeric($value);
        }
        else if ($field_type === 'string') {
            $result = is_string($value);
        }
        else if ($field_type === 'date') {
            $result = strtotime($value);
        }
        else if ($field_type === 'boolean') {
            $result = is_bool($value);
        }
        else {
            $result = false;
        }
        return $result;

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute is invalid.';
    }
}
