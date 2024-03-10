<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GroupResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "slug" => $this->slug,
            "cover_path" => '',
            "thumbnail_path" => '',
            "auto_approval" => $this->auto_approval,
            "description" => $this->description,
            "created_by" => 1,
            "user_status" => ($this->created_by == 1) ? 'admin' : 'user',
            "deleted_at" => $this->deleted_at,
            "deleted_by" => $this->deleted_by,
        ];
    }
}
