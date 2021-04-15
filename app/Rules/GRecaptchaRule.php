<?php

namespace App\Rules;

use GuzzleHttp\Client;
use Illuminate\Contracts\Validation\Rule;

class GRecaptchaRule implements Rule
{

    private $msg = 'A verificação do ReCaptcha falhou!';
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

        if (!isset($value) || $value == '') {
            $this->msg = 'O captcha nao foi respondido!';
            return false;
        }

        // Validate ReCaptcha
        $client = new Client([
            'base_uri' => 'https://google.com/recaptcha/api/'
        ]);

        $response = $client->post('siteverify', [
            'query' => [
                'secret' => env('GOOGLE_RECAPTCHA_SECRET'),
                'response' => $value
            ]
        ]);

        return json_decode($response->getBody())->success;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->msg;
    }
}
