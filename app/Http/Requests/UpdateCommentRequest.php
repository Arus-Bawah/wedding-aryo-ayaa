<?php namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class UpdateCommentRequest extends FormRequest
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
            'comment' => 'required|string|max:255',
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
            'comment.required' => 'Messages tidak boleh kosong',
            'comment.sting' => 'Messages hanya bisa berupa Text',
            'comment.max' => 'Messages maksimal 255 karakter',
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
