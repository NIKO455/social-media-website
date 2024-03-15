<?php

namespace App\Http\Controllers;

use App\Http\Enums\GroupUserRole;
use App\Http\Enums\GroupUserStatus;
use App\Http\Requests\GroupStoreRequest;
use App\Http\Resources\GroupResource;
use App\Http\Resources\PostResource;
use App\Http\Resources\UserResource;
use App\Models\Group;
use App\Models\GroupUser;
use App\Models\Post;
use App\Models\User;
use App\Traits\UploadFileTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Inertia\Inertia;

class GroupController extends Controller
{

    use UploadFileTrait;

    public function index($group)
    {
        $group = new GroupResource(Group::where('slug', $group)->first());
        $user = new UserResource(User::findOrFail(Auth::id()));
        if (!Auth::check()) {
            return Inertia::render('Pages/VisitGroup', compact('group'));
        }
        return Inertia::render('Pages/Group', compact('group','user'));
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

    public function edit($id)
    {
        $group = Group::findorFail($id);
        return Inertia::render('Pages/GroupEdit', ['group' => $group]);
    }

    public function update(GroupStoreRequest $request, $id)
    {
        $group = Group::findorFail($id);
        $group->update($request->all());

        return redirect()->back();
    }

    public function groupProfile(Request $request, $id): RedirectResponse
    {

        DB::beginTransaction();
        try {
            $group = Group::findorFail($id);
            $oldPath = $group->group_profile;
            if ($oldPath) {
                $this->deleteFile($oldPath);
            }
            $imagePath = $this->uploadFile($request, 'profile_path', $oldPath, 'public/groups');
            $group->update(['group_profile' => $imagePath]);
            DB::commit();
            return redirect()->back()->with('message', 'Cover Photo Updated');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
        }
    }

    public function groupCover(Request $request, $id): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $group = Group::findorFail($id);
            $oldPath = $group->group_cover;
            if ($oldPath) {
                $this->deleteFile($oldPath);
            }
            $imagePath = $this->uploadFile($request, 'cover_path', $oldPath, 'public/groups');
            $group->update(['group_cover' => $imagePath]);
            DB::commit();
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
        }
    }

    public function removeGroupProfile($id): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $group = Group::findorFail($id);
            $this->deleteFile($group->group_profile);
            $group->update(['group_profile' => null]);
            DB::commit();
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
        }

    }

    public function joinGroup($id)
    {
        $res = GroupUser::where('group_id', $id)->where('user_id', Auth::id())->first();
        if ($res) {
            return redirect()->back();
        }

        DB::beginTransaction();
        try {

            GroupUser::create([
                'status' => GroupUserStatus::PENDING->value,
                'role' => GroupUserRole::USER->value,
                'user_id' => Auth::id(),
                'group_id' => $id,
                'created_by' => Auth::id(),
            ]);

            DB::commit();
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
        }

    }

    public function acceptGroup($id)
    {

        DB::beginTransaction();
        try {
            $groupUser = GroupUser::findorFail($id);
            $groupUser->update([
                'status' => GroupUserStatus::APPROVED->value
            ]);

            DB::commit();
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
        }

    }

    public function rejectGroup($id)
    {

        DB::beginTransaction();
        try {
            $groupUser = GroupUser::findorFail($id);
            $groupUser->delete();

            DB::commit();
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
        }

    }
}
