<?php

namespace App\Http\Controllers;

use App\Http\Enums\GroupUserRole;
use App\Http\Enums\GroupUserStatus;
use App\Http\Requests\GroupStoreRequest;
use App\Models\Group;
use App\Models\GroupUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class GroupController extends Controller
{
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
}
