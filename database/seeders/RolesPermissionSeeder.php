<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesPermissionSeeder extends Seeder
{

    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // setting general permition for each table
        $models = ['categories', 'admins'];
        $maps = ['create', 'read', 'update', 'delete'];

        $arrayOfPermissionNames = [];
        foreach ($models as $model) {
            // result should be ['create_categories' , 'create_admins',...]

            // $arrayOfPermissionNames += collect($maps)->map(function ( $map ) use ($model){
            //     return $map.'_'.$model ;
            //     });
            foreach ($maps as $map) {
                $arrayOfPermissionNames[] = $map . '_' . $model;
            }
        }

        $permissions = collect($arrayOfPermissionNames)->map(function ($permission) {
            return ['name' => $permission, 'guard_name' => 'admin'];
        });

        Permission::insert($permissions->toArray());

        // end of setting permissions



        // setting roles

        $roles = ['admins','super_admin'];

        // admins role
        foreach ($roles as  $role) {
            Role::create(['guard_name' => 'admin', 'name' => $role]);
        }

        // // super admin role
        // Role::create(['guard_name' => 'admin', 'name' => 'super_admin'])
        //     ->syncPermissions(Permission::all());
    } //end run

} //end seeder
