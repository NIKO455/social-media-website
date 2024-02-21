<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use App\Models\PostAttachment;
use App\Traits\UploadFileTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    use UploadFileTrait;

    public function store(StorePostRequest $request)
    {
        $data = $request->validated();

        DB::beginTransaction();
        try {
            // Create the post
            $post = Post::create([
                'body' => $data['body'],
                'user_id' => $data['user_id'],
                'slug' => Str::uuid()->toString(),
                'created_by' => $data['user_id']
            ]);

            // Store attachments
            if ($request->hasFile('files')) {
                $counter = 0;

                foreach ($request->file('files') as $file) {
                    if ($counter < 2) {
                        $originalName = $file->getClientOriginalName();
                        $filenameWithoutExtension = pathinfo($originalName, PATHINFO_FILENAME);
                        $extension = $file->getClientOriginalExtension();
                        $fileName = 'media_' . uniqid() . '_' . time() . '.' . $filenameWithoutExtension . '.' . $extension;
                        $file->storeAs('public/public/posts/', $fileName);
                        PostAttachment::create([
                            'post_id' => $post->id,
                            'path' => $fileName,
                            'name' => $originalName,
                            'mime' => $extension,
                            'created_by' => $data['user_id'],
                        ]);
                        $counter++;
                    } else {
                        break;
                    }
                }
            }


            DB::commit();
            return response()->json(['message' => 'Post created successfully'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
        }
    }

    public function update(Request $request, $slug)
    {
        dd($request->all());
        $post = Post::where('slug', $slug)->first();
        dd($post);
        return response()->json(['post' => $post], 200);
    }

    public function delete($slug)
    {
        DB::beginTransaction();
        try {
            $post = Post::where('slug', $slug)->first();
            $post->delete();
            DB::commit();
            return response()->json(['message' => 'Post deleted successfully'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
        }
    }

}
