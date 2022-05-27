<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Role::insert([[
            'name'=>'Admin','guard_name'=>'web'
        ]]);

        Permission::insert([
            ['name'=>'user-list','guard_name'=>'web','group_name'=>'الإداريين'],
            ['name'=>'user-create','guard_name'=>'web','group_name'=>'الإداريين'],
            ['name'=>'user-edit','guard_name'=>'web','group_name'=>'الإداريين'],
            ['name'=>'user-destroy','guard_name'=>'web','group_name'=>'الإداريين'],

            ['name'=>'role-list','guard_name'=>'web','group_name'=>'الصلاحيات'],
            ['name'=>'role-create','guard_name'=>'web','group_name'=>'الصلاحيات'],
            ['name'=>'role-edit','guard_name'=>'web','group_name'=>'الصلاحيات'],
            ['name'=>'role-destroy','guard_name'=>'web','group_name'=>'الصلاحيات'],

            ['name'=>'customer-list','guard_name'=>'web','group_name'=>'المستخدمين'],
            ['name'=>'customer-create','guard_name'=>'web','group_name'=>'المستخدمين'],
            ['name'=>'customer-edit','guard_name'=>'web','group_name'=>'المستخدمين'],
            ['name'=>'customer-destroy','guard_name'=>'web','group_name'=>'المستخدمين'],

            ['name'=>'category-list','guard_name'=>'web','group_name'=>'الأقسام'],
            ['name'=>'category-create','guard_name'=>'web','group_name'=>'الأقسام'],
            ['name'=>'category-edit','guard_name'=>'web','group_name'=>'الأقسام'],
            ['name'=>'category-destroy','guard_name'=>'web','group_name'=>'الأقسام'],

            ['name'=>'country-list','guard_name'=>'web','group_name'=>'الدول والمدن'],
            ['name'=>'country-create','guard_name'=>'web','group_name'=>'الدول والمدن'],
            ['name'=>'country-edit','guard_name'=>'web','group_name'=>'الدول والمدن'],
            ['name'=>'country-destroy','guard_name'=>'web','group_name'=>'الدول والمدن'],

            ['name'=>'setting-edit','guard_name'=>'web','group_name'=>'الإعدادات'],
        ]);
        DB::table('model_has_roles')->insert(['role_id'=>1,'model_type'=>'App\Models\User','model_id'=>1]);

        DB::table('role_has_permissions')->insert([
            ['permission_id'=>1,'role_id'=>1],
            ['permission_id'=>2,'role_id'=>1],
            ['permission_id'=>3,'role_id'=>1],
            ['permission_id'=>4,'role_id'=>1],
            ['permission_id'=>5,'role_id'=>1],
            ['permission_id'=>6,'role_id'=>1],
            ['permission_id'=>7,'role_id'=>1],
            ['permission_id'=>8,'role_id'=>1],
            ['permission_id'=>9,'role_id'=>1],
            ['permission_id'=>10,'role_id'=>1],
            ['permission_id'=>11,'role_id'=>1],
            ['permission_id'=>12,'role_id'=>1],
            ['permission_id'=>13,'role_id'=>1],
            ['permission_id'=>14,'role_id'=>1],
            ['permission_id'=>15,'role_id'=>1],
            ['permission_id'=>16,'role_id'=>1],
            ['permission_id'=>17,'role_id'=>1],
            ['permission_id'=>18,'role_id'=>1],
            ['permission_id'=>19,'role_id'=>1],
            ['permission_id'=>20,'role_id'=>1],
            ['permission_id'=>21,'role_id'=>1],
        ]);

    }
}
