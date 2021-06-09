<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use App\Models\Admin;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminController extends Controller

{

    /** constructor: setting middlewares */
    public function __construct()
    {
        $this->middleware('admin.auth:admin');
           
    }

    public function index()
    {
        $admins = Admin::all() ; // except admins that has super admin role
        return view('admin.dashboard.admins.index', compact('admins'));
    } // end of index


    public function create()
    {
        $all_roles = Role::all()->pluck('name'); // except the super_admin role
        return view('admin.dashboard.admins.create',compact('all_roles'));
    } // end of create


    public function store(AdminRequest $request)
    {
        try {
            $request_data = $request->except(['password', 'roles']);

            // password encryption
            $request_data['password'] = bcrypt($request->password);


            // store admin data into database
            $admin = Admin::create($request_data);

            // assign roles
            $admin->assignRole($request->roles);

           

            //session alert success
          // session()->flash('success', __('site.added-successfuly'));

            return redirect()->route('admin.admins.index');
            
        } catch (\Exception $ex) {
            throw $ex;
          //  session()->flash('error', __('site.there-are-error'));
            return redirect()->back();
        }
    } // end of store


    public function show(Admin $admin)
    {
        //
    } // end of show


    public function edit(Admin $admin)
    {
        $all_roles = Role::all()->pluck('name'); // except the super_admin role
        $admin->roles= $admin->getRoleNames()->toArray();
        return view('admin.dashboard.admins.edit', compact('admin','all_roles'));
    } // end of edit


    public function update(AdminRequest $request, Admin $admin)
    {
        try {
            $request_data = $request->except(['password', 'roles']);

            // password encryption
            $request_data['password'] = bcrypt($request->password);


            // update admin data in database
            $admin->update($request_data);

            // sync roles
            $admin->syncRoles($request->roles);


            //session alert success
           session()->flash('success', __('site.added-successfuly'));

            return redirect()->route('admin.admins.index');
        } catch (\Exception $ex) {
            throw $ex;
            session()->flash('error', __('site.there-are-error'));
            return redirect()->back();
        }
    } // end of update


    public function destroy(Admin $admin)
    {
        $admin->delete();

        session()->flash('success', __('site.deleted-successfuly'));

        return redirect()->back();

    } // end of destroy
}// end of admin controller 
