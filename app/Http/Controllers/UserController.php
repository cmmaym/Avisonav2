<?php

namespace AvisoNavAPI\Http\Controllers;

use AvisoNavAPI\Http\Requests\ConfigUserType;
use AvisoNavAPI\User;
use Illuminate\Http\Request;
use AvisoNavAPI\Traits\Filter;
use Illuminate\Support\Facades\Hash;
use AvisoNavAPI\Http\Requests\UserType;
use Illuminate\Support\Facades\Storage;
use AvisoNavAPI\Http\Resources\UserResource;
use AvisoNavAPI\Http\Requests\UpdateUserType;
use AvisoNavAPI\ModelFilters\Basic\UserFilter;


class UserController extends ApiController
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
        $user = new User($request->only(['username', 'name1', 'name2', 'email']));
        $user->num_ide = $request->input('numIde');
        $user->last_name1 = $request->input('lastName1');
        $user->last_name2 = $request->input('lastName2');
        $user->password = Hash::make($request->input('password'));
        $user->role_id = $request->input('role');
        $user->state = $request->input('state');

        $firmUpload = $request->file('firm');
        $path = $firmUpload->storeAs('firmas', uniqid().'.'.$firmUpload->getClientOriginalExtension(), 'public');

        $user->firm_path = $path;

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
    public function update(UpdateUserType $request, $id)
    {
        $user = User::where('id', '=', $id)->firstOrFail();
        
        $user->fill($request->only(['username', 'name1', 'name2', 'email']));
        $user->num_ide = $request->input('numIde');
        $user->last_name1 = $request->input('lastName1');
        $user->last_name2 = $request->input('lastName2');
        $user->state = $request->input('state');

        if(!is_null($request->input('password')))
        {
            $user->password = Hash::make($request->input('password'));
        }

        if($user->firm_path)
        {
            Storage::disk('public')->delete($user->firm_path);
        }

        $firmUpload = $request->file('firm');
        $path = $firmUpload->storeAs('firmas', uniqid().'.'.$firmUpload->getClientOriginalExtension(), 'public');

        $user->firm_path = $path;

        $user->role_id = $request->input('role');

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

    public function configUser(ConfigUserType $request){
        $user = $request->user();

        $user->fill($request->only(['name1', 'name2', 'email']));
        $user->num_ide = $request->input('numIde');
        $user->last_name1 = $request->input('lastName1');
        $user->last_name2 = $request->input('lastName2');

        if(!is_null($request->input('password')))
        {
            $user->password = Hash::make($request->input('password'));
        }

        if($user->firm_path)
        {
            Storage::disk('public')->delete($user->firm_path);
        }

        $firmUpload = $request->file('firm');
        $path = $firmUpload->storeAs('firmas', uniqid().'.'.$firmUpload->getClientOriginalExtension(), 'public');

        $user->firm_path = $path;

        $user->save();

        return new UserResource($user);
    }
}
