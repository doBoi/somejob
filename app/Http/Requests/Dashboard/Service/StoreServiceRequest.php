<?php

namespace App\Http\Requests\Dashboard\Service;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use app\Models\Service;
use symfony\Component\HttpFoundation\Response;

class StoreServiceRequest extends FormRequest
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
            'title' => [
                'required',
                'string',
                'max:255',
            ],
            'desctription' => [
                'nullable',
                'string',
                'max:5000',
            ],
            'delivery_time' => [
                'required',
                'integer',
                'max:100',
            ],
            'revision_time' => [
                'required',
                'integer',
                'max:100',
            ],
            'price' => [
                'required',
                'integer',
            ],
            'note' => [
                'nullable',
                'string',
                'max:5000',
            ],

        ];
    }
}
