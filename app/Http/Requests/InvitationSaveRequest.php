<?php namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class InvitationSaveRequest extends FormRequest
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
            'name' => 'required|string|max:225',
            'location' => 'required|string|max:255',
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
            'name.required' => 'Nama tidak boleh kosong',
            'name.sting' => 'Nama hanya bisa berupa Text',
            'name.max' => 'Nama maksimal 255 karakter',
            'location.required' => 'Dari/Lokasi/Alamat tidak boleh kosong',
            'location.sting' => 'Dari/Lokasi/Alamat hanya bisa berupa Text',
            'location.max' => 'Dari/Lokasi/Alamat maksimal 255 karakter',
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
