<?php

namespace App\Http\Resources;

use App\Http\Enums\GroupUserStatus;
use App\Models\GroupUser;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class GroupResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $coverUrl = $this->group_cover ? asset('storage/' . $this->group_cover) : null;
        $profileUrl = $this->group_profile ? asset('storage/' . $this->group_profile) : null;

        $user = new UserResource(User::where('id', $this->created_by)->first());

        $groupMember = GroupUserResource::collection(GroupUser::where("group_id", $this->id)->where('status', GroupUserStatus::APPROVED->value)->with('user')->get());

        $groupMeberApprove = GroupUserResource::collection(GroupUser::where("group_id", $this->id)->where('status', GroupUserStatus::PENDING->value)->with('user')->get());

        $groupPost = PostResource::collection(Post::where("group_id", $this->id)->get());


        return [
            "id" => $this->id,
            "name" => $this->name,
            "slug" => $this->slug,
            "group_profile" => $profileUrl,
            "group_cover" => $coverUrl,
            "auto_approval" => $this->auto_approval,
            "description" => $this->description,
            "group_member" => $groupMember,
            "group_approve" => $groupMeberApprove,
            "group_post" => $groupPost,
            "created_by" => $user,
            "user_status" => ($this->created_by == Auth::id()) ? 'admin' : 'user',
            "deleted_at" => $this->deleted_at,
            "deleted_by" => $this->deleted_by,
        ];
    }
}
