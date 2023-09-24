<?php

namespace App\Http\Requests\Dashboard\Profile;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use app\Models\DetailUser;
use symfony\Component\HttpFoundation\Response;

class UpdateDetailUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
        // set ke true agar validation jalan
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'photo' => [
                'nullable',
                'file',
                'max:1024',
            ],
            'role' => [
                'nullable',
                'string',
                'max:100',
            ],
            'contact_number' => [
                'required',
                'regex:/(^([a-zA-Z]+)(\d+)?$)/u',
                'max:12',
            ],
            'biography' => [
                'nullable',
                'string',
                'max:5000',
            ],
        ];
    }
}
