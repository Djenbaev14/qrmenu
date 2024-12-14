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
        
        $gl_admin_permissions=[
            'company-list',
            'company-create',
            'company-edit',
            'company-show',

            'all-clients-list',

            'all-categories-list',
            'all-categories-edit',
            'all-categories-create',
            'all-categories-show',
            'all-categories-delete',
            
            'all-products-list',
            'all-products-edit',
            'all-products-create',
            'all-products-show',
            'all-products-delete',
        ];
        $admin_permissions = [
            'setting-list',
            'setting-create',
            'setting-edit',
            'setting-delete',

            'product-list',
            'product-create',
            'product-edit',
            'product-delete',
            
            'category-list',
            'category-create',
            'category-edit',
            'category-delete',
            
            'feedback-list',
            'only-thier-clients-list',
         ];

        for ($i = 0; $i < count($gl_admin_permissions); $i++) {
            Permission::create(['name' => $gl_admin_permissions[$i]]);
        }
        for ($i = 0; $i < count($admin_permissions); $i++) {
            Permission::create(['name' => $admin_permissions[$i]]);
        }
        $roles = [
            'Gl_admin',
            'Admin'
        ];
        foreach ($roles as $role_name) {
            $role=Role::create(['name' => $role_name]);
            if($role_name=='Gl_admin'){
                $role->syncPermissions($gl_admin_permissions);
            }elseif($role_name="Admin"){
                $role->syncPermissions($admin_permissions);
            }

        }
        
        User::create([
            'name'=>'admin',
            'phone'=>'990611470',
            'password'=>Hash::make('admin')
        ])->assignRole('Gl_admin');



    }
}
