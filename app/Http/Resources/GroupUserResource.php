<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GroupUserResource extends JsonResource
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
            "status" => $this->status,
            "role" => $this->role,
            "token" => $this->token,
            "token_expire_date" => $this->token_expire_date,
            "token_used" => $this->token_used,
            "user_id" => $this->user_id,
            "group_id" => $this->group_id,
            "member_name"=> $this->user->name,
            "avatar_path" => asset('storage/' . $this->user->avatar_path),
            "created_by" => $this->created_by,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];
    }
}
