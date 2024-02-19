<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $attachmentsData = [];

        foreach ($this->attachments as $attachment) {
            $image = $attachment->path ? asset('storage/public/posts/' . $attachment->path) : null;

            $attachmentsData[] = [
                "id" => $attachment->id,
                "post_id" => $attachment->post_id,
                "name" => $attachment->name,
                "path" => $image,
                "mime" => $attachment->mime,
                "created_by" => $attachment->created_by,
            ];
        }

        return [
            "id" => $this->id,
            "body" => $this->body,
            "slug" => $this->slug,
            "user_id" => $this->user_id,
            "group_id" => $this->group_id,
            "created_at" => $this->created_at->diffForHumans(),
            "attachments" => $attachmentsData,
        ];
    }
}