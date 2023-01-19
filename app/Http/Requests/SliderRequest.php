<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'     =>'required|string|max:100',
            'age'      =>'required|numeric',
            'slider.*'  => 'required|json',
            'slider.title'  => 'required|string',
            'slider.alt'  => 'required|string',
            'slider.url'  => 'image|mimes:jpeg,png,jpg',
            ];
    }
}
