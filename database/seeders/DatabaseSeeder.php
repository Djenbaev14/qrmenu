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
        
        $super_admin_permissions=[
            'home-page',

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
            
            'all-orders-list',
            'all-orders-edit',
            'all-orders-create',
            'all-orders-show',
            'all-orders-delete',
            
            'all-qr-menu-list',
            'all-qr-menu-edit',
            'all-qr-menu-create',
            'all-qr-menu-show',
            'all-qr-menu-delete',
        ];
        $restaurant_owner_permissions = [
            'super-admin-home-page',

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
            
            'orders-list',
            'orders-edit',
            'orders-create',
            'orders-show',
            'orders-delete',
            
            'qr-menu-list',
            'qr-menu-edit',
            'qr-menu-create',
            'qr-menu-show',
            'qr-menu-delete',
         ];

        for ($i = 0; $i < count($super_admin_permissions); $i++) {
            Permission::create(['name' => $super_admin_permissions[$i]]);
        }
        for ($i = 0; $i < count($restaurant_owner_permissions); $i++) {
            Permission::create(['name' => $restaurant_owner_permissions[$i]]);
        }
        $roles = [
            'super_admin',
            'restaurant_owner'
        ];
        foreach ($roles as $role_name) {
            $role=Role::create(['name' => $role_name]);
            if($role_name=='super_admin'){
                $role->syncPermissions($super_admin_permissions);
            }elseif($role_name="restaurant_owner"){
                $role->syncPermissions($restaurant_owner_permissions);
            }

        }
        
        User::create([
            'name'=>'admin',
            'phone'=>'990611470',
            'password'=>Hash::make('admin')
        ])->assignRole('super_admin');



    }
}
