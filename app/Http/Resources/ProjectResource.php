<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this?->id,
            'user' => new UserResource($this?->user),
            'status' => new StatusResource($this?->status),
            'label' => $this?->label,
            'description' => $this?->description,
            'budget' => $this?->budget,
            'isValidate' => $this?->is_validate,
            'startDate' => $this?->start_date,
            'endDate' => $this?->end_date,
            'createdAt' => $this?->created_at
        ];
    }
}
