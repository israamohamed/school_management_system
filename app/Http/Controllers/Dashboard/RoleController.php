<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;
use App\Http\Requests\RoleRequest;

class RoleController extends Controller
{
   
    public function index()
    {
        $roles = Role::with('permissions')->latest()->paginate();
        return view('dashboard.roles.index' , compact('roles') );
    }

  
    public function create()
    {
        $permissions = Permission::get()->groupBy('group');
        return view('dashboard.roles.create' , compact('permissions'));
    }

  
    public function store(RoleRequest $request)
    {
        $request->merge([
            'display_name' => [
                'en' => $request->display_name_en,
                'ar' => $request->display_name_ar
            ],
            'guard_name'   => 'web',
        ]);

        //return $request;

        $role = Role::create([
            'name' => $request->name,
            'display_name' => [
                'en' => $request->display_name_en,
                'ar' => $request->display_name_ar
            ],
            'guard_name'   => 'web',
        ]);

        $role->syncPermissions($request->permissions);

        toastr()->success(__('messages.added_successfully'));
        return redirect()->route('dashboard.role.index');

    }

   
    public function show($id)
    {
        //
    }

  
    public function edit($id)
    {
        $role = Role::where('name' , '!=' , 'super admin')->findOrFail($id);
        $permissions = Permission::get()->groupBy('group');
        return view('dashboard.roles.edit' , compact('role' , 'permissions'));
    }

   
    public function update(RoleRequest $request, $id)
    {
        $role = Role::where('name' , '!=' , 'super admin')->findOrFail($id);

        $request->merge([
            'display_name' => ['en' => $request->display_name_en , 'ar' => $request->display_name_ar],
            'guard_name'   => 'web',
        ]);

        $role->update($request->all());

        $role->syncPermissions($request->permissions);

        toastr()->success(__('messages.updated_successfully'));
        return redirect()->route('dashboard.role.index');
    }

    public function destroy($id)
    {
        $role = Role::where('name' , '!=' , 'super admin')->findOrFail($id);
        //check if role has users
        if($role->users &&  $role->users()->count() > 0)
        {
            toastr()->error(__('messages.role_has_users_warning'));
            return redirect()->route('dashboard.role.index');
        }
        else 
        {
            $role->delete();
            toastr()->success(__('messages.deleted_successfully'));
            return redirect()->route('dashboard.role.index');
        }
    }
}
