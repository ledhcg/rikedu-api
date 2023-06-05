<?php

namespace App\Http\Controllers;

use App\Contracts\ModeQuery;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\Role;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 15);

        $users = User::paginate($perPage);

        $users->modeQuery = ModeQuery::MODEL_COLLECTION;
        return $this->successResponse(
            new UserCollection($users),
            'Users retrieved successfully'
        );
    }

    public function teachers(Request $request)
    {
        $perPage = $request->get('per_page', 15);

        $role = Role::findByName('teacher');
        $users = $role->users()->paginate($perPage);

        $users->modeQuery = ModeQuery::MODEL_USER_TEACHER;
        return $this->successResponse(
            new UserCollection($users),
            'Users retrieved successfully'
        );
    }

    public function parents(Request $request)
    {
        $perPage = $request->get('per_page', 15);

        $role = Role::findByName('parent');
        $users = $role->users()->paginate($perPage);

        $users->modeQuery = ModeQuery::MODEL_USER_PARENT;
        return $this->successResponse(
            new UserCollection($users),
            'Users retrieved successfully'
        );
    }

    public function students(Request $request)
    {
        $perPage = $request->get('per_page', 15);

        $role = Role::findByName('student');
        $users = $role->users()->paginate($perPage);

        $users->modeQuery = ModeQuery::MODEL_USER_STUDENT;
        return $this->successResponse(
            new UserCollection($users),
            'Users retrieved successfully'
        );
    }

    public function superAdmin(Request $request)
    {
        $role = Role::findByName('super admin');
        $user = $role->users()->first();

        $user->modeQuery = ModeQuery::MODEL_USER_SUPER_ADMIN;
        return $this->successResponse(
            new UserResource($user),
            'User retrieved successfully'
        );
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
