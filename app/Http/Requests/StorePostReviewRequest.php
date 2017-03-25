<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostReviewRequest extends FormRequest
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
            // When working with a real api, the id can be validated using a custom
            // Validation method, that will make a request to the api to make sure this id exists.
            'post_id' => 'integer|min:1|max:100',
            'subject' => 'required|string|min:10|max:200',
            'body' => 'required|string|min:50'
        ];
    }
}
