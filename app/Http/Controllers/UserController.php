<?php

namespace AvisoNavAPI\Http\Controllers;

use AvisoNavAPI\User;
use Illuminate\Http\Request;
use AvisoNavAPI\Traits\Filter;
use Illuminate\Support\Facades\Hash;
use AvisoNavAPI\Http\Requests\UserType;
use AvisoNavAPI\Http\Resources\UserResource;
use AvisoNavAPI\Http\Requests\UpdateUserType;
use AvisoNavAPI\ModelFilters\Basic\UserFilter;

class UserController extends Controller
{
    use Filter;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collection = User::filter(request()->all(), UserFilter::class)->paginateFilter($this->perPage());

        return UserResource::collection($collection);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserType $request)
    {
        $user = new User($request->only(['num_ide', 'username', 'name1', 'name2', 'last_name1', 'last_name2', 'email']));
        $user->password = Hash::make($request->input('password'));
        $user->role_id = $request->input('role_id');

        $user->save();

        return new UserResource($user);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return new UserResource($user);
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserType $request, User $user)
    {
        $user->fill($request->only(['num_ide', 'username', 'name1', 'name2', 'last_name1', 'last_name2', 'email']));

        if(!is_null($request->input('password')))
        {
            $user->password = Hash::make($request->input('password'));
        }

        $user->role_id = $request->input('role_id');

        $user->save();

        return new UserResource($user);
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        
        return new UserResource($user);
    }

    public function me(Request $request)
    {
        return new UserResource($request->user());
    }
}
