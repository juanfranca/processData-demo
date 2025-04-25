<?php

namespace App\Http\Requests;

use App\Traits\ResponseJson;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class FileRequest extends FormRequest
{
	use ResponseJson;
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
			'file_type' => [
				'required',
				'integer',
				Rule::in([1, 2, 3]),
				Rule::when($this->isMethod('post'), 'in:1', 'in:2,3'),
			],
			'file' => 'required|string'
		];

		return $rules;
	}

	protected function failedValidation(Validator $validator)
	{
		$errors = $validator->errors()->toArray();
		$mappedErrors = [];

		foreach ($errors as $key => $messages) {
			$mappedErrors[$key] = $messages;
		}

		throw new HttpResponseException($this->errorResponse("Failed to create the file", 400, $mappedErrors));
	}
}
