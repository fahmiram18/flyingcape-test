<?php

namespace App\Http\Requests;

use Adobrovolsky97\LaravelRepositoryServicePattern\Request\Request;

/**
 * Class classrooms
 */
class classrooms extends Request
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