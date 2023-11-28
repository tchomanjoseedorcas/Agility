<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this?->id,
            'task'=> new TaskResource($this?->task),
            'content' => $this?->content,
            'createdBy' => new UserResource($this?->created_by),
            'createdAt' => $this?->created_at,

        ];
    }
}

