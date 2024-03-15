<?php

namespace App\Http\Resources;

use App\Models\Group;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

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
        $comments = [];

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

        foreach ($this->comments as $comment) {
            $user = new UserResource(User::findOrFail($comment->user_id));
            $comments[] = [
                "id" => $comment->id,
                "user" => $user,
                "comment" => $comment->comment,
                "post_id" => $comment->post_id,
                "created_at" => $comment->created_at->diffForHumans(),
            ];
        }

        $groupName = $this->group_id ? Group::find($this->group_id)->name : null;


        return [
            "id" => $this->id,
            "body" => $this->body,
            "slug" => $this->slug,
            "user_id" => $this->user_id,
            "group_name" => $groupName,
            "reaction_count" => $this->reactions->count(),
            "hasLiked" => (bool)$this->reactions->where('user_id', Auth::id())->where('post_id', $this->id)->first(),
            "created_at" => $this->created_at->diffForHumans(),
            "comments" => $comments,
            "attachments" => $attachmentsData,
        ];
    }
}
