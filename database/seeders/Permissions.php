<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class Permissions extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->delete();

        $permissions = [

            ['name'=>'branch.dashboard', 'guard_name'=>'web', 'group_name'=>'Branch'],
            ['name'=>'branch.sections', 'guard_name'=>'web', 'group_name'=>'Branch'],
            ['name'=>'branch.class.sections', 'guard_name'=>'web', 'group_name'=>'Branch'],
            ['name'=>'branch.class.rooms', 'guard_name'=>'web', 'group_name'=>'Branch'],
            ['name'=>'branch.class.routine', 'guard_name'=>'web', 'group_name'=>'Branch'],
            ['name'=>'branch.class.cordinator', 'guard_name'=>'web', 'group_name'=>'Branch'],
            ['name'=>'branch.staff.attendence', 'guard_name'=>'web', 'group_name'=>'Branch'],
            ['name'=>'branch.student', 'guard_name'=>'web', 'group_name'=>'Branch'],
            ['name'=>'branch.student.admission', 'guard_name'=>'web', 'group_name'=>'Branch'],
            ['name'=>'branch.student.attendance', 'guard_name'=>'web', 'group_name'=>'Branch'],
            ['name'=>'branch.student.fine', 'guard_name'=>'web', 'group_name'=>'Branch'],
            ['name'=>'branch.exams', 'guard_name'=>'web', 'group_name'=>'Branch'],
            ['name'=>'branch.fees', 'guard_name'=>'web', 'group_name'=>'Branch'],
            ['name'=>'branch.weaver_settings', 'guard_name'=>'web', 'group_name'=>'Branch'],
            ['name'=>'branch.income', 'guard_name'=>'web', 'group_name'=>'Branch'],
            ['name'=>'branch.expenses', 'guard_name'=>'web', 'group_name'=>'Branch'],
            ['name'=>'branch.report', 'guard_name'=>'web', 'group_name'=>'Branch'],
            
            

            ['name'=>'admin.setting', 'guard_name'=>'web', 'group_name'=>'Main_Wing'],
            ['name'=>'admin.dashboard', 'guard_name'=>'web', 'group_name'=>'Main_Wing'],
            ['name'=>'admin.helper.role.permission', 'guard_name'=>'web', 'group_name'=>'Main_Wing'],
            ['name'=>'branch.settings', 'guard_name'=>'web', 'group_name'=>'Main_Wing'],
            ['name'=>'admin.crm', 'guard_name'=>'web', 'group_name'=>'Main_Wing'],
            ['name'=>'branch.role.permission', 'guard_name'=>'web', 'group_name'=>'Main_Wing'],
            ['name'=>'admin.academic.settings', 'guard_name'=>'web', 'group_name'=>'Main_Wing'],
            ['name'=>'admin.staffs', 'guard_name'=>'web', 'group_name'=>'Main_Wing'],
            ['name'=>'admin.staff.attendence', 'guard_name'=>'web', 'group_name'=>'Main_Wing'],
            ['name'=>'admin.departments', 'guard_name'=>'web', 'group_name'=>'Main_Wing'],
            ['name'=>'admin.exams', 'guard_name'=>'web', 'group_name'=>'Main_Wing'],
            ['name'=>'admin.exam.with.class', 'guard_name'=>'web', 'group_name'=>'Main_Wing'],
            ['name'=>'admin.exam.mark.grade', 'guard_name'=>'web', 'group_name'=>'Main_Wing'],
            ['name'=>'admin.income', 'guard_name'=>'web', 'group_name'=>'Main_Wing'],
            ['name'=>'admin.expenses', 'guard_name'=>'web', 'group_name'=>'Main_Wing'],
            ['name'=>'admin.report', 'guard_name'=>'web', 'group_name'=>'Main_Wing'],
            
            
            
        ];

        Permission::insert($permissions);

    }
}
