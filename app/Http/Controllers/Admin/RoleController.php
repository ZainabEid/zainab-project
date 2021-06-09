<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;

class RoleController extends Controller
{
     /** constructor: setting middlewares */
     public function __construct()
     {
         $this->middleware('admin.auth:admin');
            
     }
  
    public function index()
    {
        $roles = Role::all();
        return view('admin.dashboard.roles.index' , compact('roles') );
    }// end of index

   
    public function create()
    {
        return view('admin.dashboard.roles.create');
    }// end of create

    
    public function store(RoleRequest $request)
    {
        $role = Role::create(['guard_name'=>'admin' ,'name' => $request->name]);
        $role->syncPermissions($request->permissions);

        return redirect()->route('admin.roles.index');
    }// end of store

   
    public function show(Role $role)
    {
        //
    }

   
    public function edit(Role $role)
    {
       $role->permissions = $role->permissions->pluck('name')->toArray();
        return view('admin.dashboard.roles.edit', compact('role'));
    }// end of edit

    
    public function update(RoleRequest $request, Role $role)
    {
        $role->update(['name' => $request->name]);
        $role->syncPermissions($request->permissions);

        return redirect()->route('admin.roles.index');
    }// end of update

    
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('admin.roles.index');
    }// end of destroy
}
