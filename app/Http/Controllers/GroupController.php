<?php

namespace App\Http\Controllers;

use App\Http\Enums\GroupUserRole;
use App\Http\Enums\GroupUserStatus;
use App\Http\Requests\GroupStoreRequest;
use App\Http\Resources\GroupResource;
use App\Models\Group;
use App\Models\GroupUser;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Inertia\Inertia;

class GroupController extends Controller
{

    public function index($group)
    {
        $group = new GroupResource(Group::where('slug', $group)->first());
        if (!Auth::check()) {
            return Inertia::render('Pages/VisitGroup', compact('group'));
        }
        return Inertia::render('Pages/Group', compact('group'));
    }

    public function store(GroupStoreRequest $request)
    {

        DB::beginTransaction();
        try {

            $group = Group::create([
                'name' => $request->name,
                'slug' => Str::uuid()->toString(),
                'description' => $request->description,
                'auto_approval' => $request->auto_approval,
                'created_by' => Auth::id(),
            ]);

            $groupUserData = [
                'status' => GroupUserStatus::APPROVED->value,
                'role' => GroupUserRole::ADMIN->value,
                'user_id' => Auth::id(),
                'group_id' => $group->id,
                'created_by' => Auth::id(),
            ];

            GroupUser::create($groupUserData);

            DB::commit();
            return redirect()->back();

        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
        }
    }

    public function coverPhoto(Request $request, $id): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $user = User::findorFail($id);
            $oldPath = $user->cover_path;
            $this->deleteFile($oldPath);
            $imagePath = $this->uploadFile($request, 'cover_path', $oldPath, 'public/users');
            $user->update(['cover_path' => $imagePath]);
            DB::commit();
            return redirect()->back()->with('message', 'Cover Photo Updated');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
        }
    }

    public function profilePhoto(Request $request, $id): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $user = User::findorFail($id);
            $oldPath = $user->avatar_path;
            $this->deleteFile($oldPath);
            $imagePath = $this->uploadFile($request, 'profile_path', $oldPath, 'public/users');
            $user->update(['avatar_path' => $imagePath]);
            DB::commit();
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
        }
    }

    public function removeProfile($id): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $user = User::findorFail($id);
            $this->deleteFile($user->avatar_path);
            $user->update(['avatar_path' => null]);
            DB::commit();
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
        }

    }
}
