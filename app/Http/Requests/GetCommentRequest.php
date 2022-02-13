<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class GetCommentRequest extends FormRequest
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
            'latest_id' => 'required|integer|min:0',
        ];
    }

    /**
     * Customize Message
     *
     * @return array
     */
    public function messages()
    {
        return [
            'latest_id.required' => 'Latest ID tidak boleh kosong',
            'latest_id.integer' => 'Latest ID hanya bisa berupa Angka',
            'latest_id.min' => 'Latest ID minimal angka 0',
        ];
    }

    /**
     * Send Error JSON
     *
     * @param Validator $validator
     * @throws ValidationException
     */
    public function failedValidation(Validator $validator)
    {
        $response = new JsonResponse([
            'status' => false,
            'message' => $validator->errors()->all(':message')[0],
            'token' => csrf_token()
        ], 400);

        throw new ValidationException($validator, $response);
    }
}
