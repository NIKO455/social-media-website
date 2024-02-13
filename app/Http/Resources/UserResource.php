<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $coverUrl = $this->cover_path ? asset('storage/' . $this->cover_path) : null;
        $profileUrl = $this->avatar_path ? asset('storage/' . $this->avatar_path) : null;

        return [
            "id" => $this->id,
            "name" => $this->name,
            "email" => $this->email,
            "username" => $this->username,
            "cover_url" => $coverUrl,
            "avatar_url" => $profileUrl,
            "description" => $this->description,
            "college" => $this->college,
            "work_place" => $this->work_place,
            "occupation" => $this->occupation,
            "school" => $this->school,
            "permanent_address" => $this->permanent_address,
            "current_address" => $this->current_address,
            "marital_status" => $this->marital_status,
        ];
    }
}
