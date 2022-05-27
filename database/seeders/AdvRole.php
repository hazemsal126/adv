<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class AdvRole extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Permission::insert([
            ['name'=>'advertisment-list','guard_name'=>'web','group_name'=>'الاعلانات'],
            ['name'=>'advertisment-create','guard_name'=>'web','group_name'=>'الاعلانات'],
            ['name'=>'advertisment-edit','guard_name'=>'web','group_name'=>'الاعلانات'],
            ['name'=>'advertisment-destroy','guard_name'=>'web','group_name'=>'الاعلانات'],
        ]);
    }
}
