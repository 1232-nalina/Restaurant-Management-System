<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class SuperadminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Admin::where('email', 'superadmin@admin.com')->first();
        if (is_null($admin)) {
            $admin = new Admin();
            $admin->name = "superadmin";
            $admin->username = "superadmin";
            $admin->email = "superadmin@admin.com";
            $admin->password_changed = 1;
            $admin->password = Hash::make('inc0rrectp@ssw0rd');
            $admin->save();
        }
        $superAdminRole = Role::where('name', 'superadmin')->where('guard_name', 'admin')->firstOrFail();
        $permissions = Permission::all();
        $superAdminRole->syncPermissions($permissions);
        $admin->assignRole($superAdminRole);
    }
}
