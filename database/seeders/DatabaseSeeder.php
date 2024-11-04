<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        $permissions = [
            'dashboard-list',
            'dashboard-create',
            'dashboard-edit',
            'dashboard-delete',
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'company-list',
            'company-create',
            'company-edit',
            'company-delete',
            'product-list',
            'product-create',
            'product-edit',
            'product-delete',
            'category-list',
            'category-create',
            'category-edit',
            'category-delete',
            'subcategory-list',
            'subcategory-create',
            'subcategory-edit',
            'subcategory-delete'
         ];
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
        
        $roles = [
            'Gl_admin',
            'Admin'
        ];
        foreach ($roles as $role_name) {
            $role=Role::create(['name' => $role_name]);
            if($role_name=='Gl_admin' && $role_name=='Admin'){
                $role->givePermissionTo($permissions);
            }
        }
        
        DB::table('users')->insert([
            'role_id'=>1,
            'name'=>'admin',
            'phone'=>'990611470',
            'password'=>Hash::make('admin')
        ]);



    }
}
