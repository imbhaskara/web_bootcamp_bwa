<?php

namespace App\Http\Requests\User\Checkout;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class Store extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // Bikin variable untuk validasi expired datetime
        $expiredValidation = date('Y-m', time());
        return [
            // Validasi data yang dibutuhkan untuk store data checkout
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email,'.Auth::id().',id',
            'occupation' => 'required|string|max:255',
            'card_number' => 'required|string|digits:16',
            'expired' => 'required|date|date_format:Y-m|after_or_equal:'.$expiredValidation,
            'cvv' => 'required|numeric|digits:3',
        ];
    }
}
