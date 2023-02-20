<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storeTransactionRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'product_category_id'=>'required',
            'product_id'=>'required',
            'party_id'=>'required',
            'quantity'=>'required',
        ];
    }
}
