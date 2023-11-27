<?php

namespace App\Http\Requests\Classroom;

use Adobrovolsky97\LaravelRepositoryServicePattern\Request\Request;

/**
 * Class StoreRequest
 */
class StoreRequest extends Request
{
	/**
	 * Get validation rules
	 * 
	 * @return array
	 */
	public function rules(): array
	{
		return [
			'teacher_id' => 'required|integer',
			'created_by' => 'required|integer',
			'name' => 'required|string',
		];
	}

	/**
	 * Get validation messages
	 * 
	 * @return array
	 */
	public function messages(): array
	{
		return [
		
		];
	}
}