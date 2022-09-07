<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use DateTime;
use Illuminate\Foundation\Http\FormRequest;

class StorePriceRequest extends FormRequest
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
            //
            'buy' => 'required|numeric|min:100',
            'sell' => 'required|numeric|min:100',
            'date' => 'required|date|unique:prices',
        ];
    }

    protected function prepareForValidation()
    {
        if ($this->date != null && DateTime::createFromFormat('d-m-Y', $this->date)) {
            $this->merge([
                'date' => Carbon::parse($this->date)->format('Y-m-d'),
            ]);
        }
    }
}
