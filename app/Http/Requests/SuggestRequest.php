<?php

namespace App\Http\Requests;

use App\Rules\GRecaptchaRule;
use Illuminate\Foundation\Http\FormRequest;

class SuggestRequest extends FormRequest
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

    public function rules()
    {
        dd($this);

        return [
            'title' => 'required|min:2|max:191',
            'content' => 'required|min:10',
            'g-recaptcha-response' => [
                'required', new GRecaptchaRule
            ]
        ];
    }

    public function messages()
    {
        return [
            'g-recaptcha-response.required' => 'Please ensure that you are a human!'
        ];
    }
}
