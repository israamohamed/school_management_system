<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Http\Requests\UserRequest;
use App\Models\User;

class UserController extends Controller
{
   
    public function index()
    {
        $users = User::search()->with('roles')->latest()->paginate();
        $roles = Role::get();
        return view('dashboard.users.index' , compact('users', 'roles') );
    }

  
    public function create()
    {
        $roles = Role::get();
        return view('dashboard.users.create' , compact('roles'));
    }

  
    public function store(UserRequest $request)
    {

        $user = User::create($request->all());

        $user->syncRoles($request->roles);

        toastr()->success(__('messages.added_successfully'));
        return redirect()->route('dashboard.user.index');

    }

   
    public function show($id)
    {
        //
    }

  
    public function edit($id)
    {
        $user = User::where('name' , '!=' , 'Admin')->findOrFail($id);
        $roles = Role::get();
        return view('dashboard.users.edit' , compact('user' , 'roles'));
    }

   
    public function update(UserRequest $request, $id)
    {
        $user = User::where('name' , '!=' , 'Admin')->findOrFail($id);

        $updated_data = $request->password ? $request->all() : $request->except(['password']);

        $user->update($updated_data);

        $user->syncRoles($request->roles);

        toastr()->success(__('messages.updated_successfully'));
        return redirect()->route('dashboard.user.index');
    }

    public function destroy($id)
    {
        $user = User::where('name' , '!=' , 'Admin')->findOrFail($id);
    
        $user->delete();
        toastr()->success(__('messages.deleted_successfully'));
        return redirect()->route('dashboard.user.index');
        
    }
}
