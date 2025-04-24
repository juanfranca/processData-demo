<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class FileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'file_name' => 'required|string|max:255',
            'file_type' => 'required|string|max:255',
            'file_path' => 'required|string|max:255'
        ];

        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {

            $rules = [
                'file_name' => 'sometimes|required|string|max:255',
                'file_type' => 'sometimes|required|string|max:255',
                'file_path' => 'sometimes|required|string|max:255'
            ];
        }
        return $rules;
    }

    protected function failedValidation(Validator $validator)
	{
		$method = match ($this->server()['REQUEST_METHOD']) {
			'PUT' => 'update',
			'POST' => 'create'
		};
		$errors = $validator->errors()->toArray();
		$mappedErrors = [];

		foreach ($errors as $key => $messages) {
			$mappedErrors[$key] = $messages;
		}

		throw new HttpResponseException($this->errorResponse("Failed to $method File", 400, $mappedErrors));
	}
}
