<?php

namespace App\Http\Resources\Classroom;

use App\Models\Classroom;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ClassroomResource
 *
 * @mixin Classroom
 */
class ClassroomResource extends JsonResource
{
	/**
	 * @var integer
	 */
	protected $statusCode = Response::HTTP_OK;

	/**
	 * @param $resource
	 * @param int $statusCode
	 */
	public function __construct($resource, int $statusCode = Response::HTTP_OK)
	{
		$this->statusCode = $statusCode;

		parent::__construct($resource);
	}

	/**
	 * @param $request
	 *
	 * @return array
	 */
	public function toArray($request): array
	{
		return [
			'id' => $this->id,
			'teacher_id' => $this->teacher_id,
			'created_by' => $this->created_by,
			'name' => $this->name,
		];
	}

	/**
	 * @param $request
	 *
	 * @return JsonResponse
	 */
	public function toResponse($request): JsonResponse
	{
		return parent::toResponse($request)->setStatusCode($this->statusCode);
	}
}
