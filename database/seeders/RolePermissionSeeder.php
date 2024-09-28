<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //create roles

        //create roles if they don't already exist
        $roleSuperAdmin = Role::firstOrCreate(['name' => 'superadmin', 'guard_name' => 'admin']);
        $roleAdmin = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'admin']);
        $roleReception = Role::firstOrCreate(['name' => 'reception', 'guard_name' => 'admin']);
        $roleKitchen = Role::firstOrCreate(['name' => 'kitchen', 'guard_name' => 'admin']);
        $roleUser = Role::firstOrCreate(['name' => 'user', 'guard_name' => 'admin']);

        //persmissoin list as array
        $permissions = [

            [
                'group_name' => 'dashboard',
                'permissions' => [
                    'dashboard.view',
                    'dashboard.edit',
                ]
            ],

            [
                'group_name' => 'admin',
                'permissions' => [
                    'admin.create',
                    'admin.view',
                    'admin.edit',
                    'admin.delete',
                ]
            ],

            [
                'group_name' => 'role',
                'permissions' => [
                    //Role permission
                    'role.create',
                    'role.view',
                    'role.edit',
                    'role.delete',
                ]
            ],



            [
                'group_name' => 'stock',
                'permissions' => [
                    //Hosting permission
                    'stock.create',
                    'stock.view',
                    'stock.edit',
                    'stock.delete',
                ]
            ],
            [
                'group_name' => 'setting',
                'permissions' => [
                    //Hosting permission
                    'setting.create',
                    'setting.view',
                    'setting.edit',
                    'setting.delete',
                ]
            ],
            [
                'group_name' => 'income_category',
                'permissions' => [
                    //Hosting permission
                    'income_category.create',
                    'income_category.view',
                    'income_category.edit',
                    'income_category.delete',
                ]
            ],
            [
                'group_name' => 'expenses_category',
                'permissions' => [
                    //Hosting permission
                    'expenses_category.create',
                    'expenses_category.view',
                    'expenses_category.edit',
                    'expenses_category.delete',
                ]
            ],
            [
                'group_name' => 'expenses',
                'permissions' => [
                    //Hosting permission
                    'expenses.create',
                    'expenses.view',
                    'expenses.edit',
                    'expenses.delete',
                    'expenses.report',

                ],

            ],
            [
                'group_name' => 'table',
                'permissions' => [
                    //Hosting permission
                    'table.create',
                    'table.view',
                    'table.edit',
                    'table.delete',


                ],

            ],
            [
                'group_name' => 'menucategory',
                'permissions' => [
                    //Hosting permission
                    'menucategory.create',
                    'menucategory.view',
                    'menucategory.edit',
                    'menucategory.delete',
                ],

            ],
            [
                'group_name' => 'menuitem',
                'permissions' => [
                    //Hosting permission
                    'menuitem.create',
                    'menuitem.view',
                    'menuitem.edit',
                    'menuitem.delete',
                ],

            ],
            [
                'group_name' => 'order',
                'permissions' => [
                    //Hosting permission
                    'order.take',
                    'order.view',
                    'order.edit',
                    'order.delete',

                ],

            ],
            [
                'group_name' => 'payment',
                'permissions' => [
                    //Hosting permission
                    'payment.make',
                ],

            ],  [
                'group_name' => 'menuitemingredients',
                'permissions' => [
                    //Hosting permission
                    'menuitemingredients.take',
                    'menuitemingredients.view',
                    'menuitemingredients.edit',
                    'menuitemingredients.delete',
                ],

            ],[
                'group_name' => 'kitchen',
                'permissions' => [
                    //Hosting permission
                    'kitchen.view',
                    'kitchen.edit',
                    'kitchen.delete',
                    'kitchen.create',
                ],

            ],


        ];

        //Create and Assign Permissions
        for ($i = 0; $i < count($permissions); $i++) {
            $permissionGroup = $permissions[$i]['group_name'];
            for ($j = 0; $j < count($permissions[$i]['permissions']); $j++) {
                //create permisson


                $permission = Permission::firstOrCreate(['name' => $permissions[$i]['permissions'][$j], 'guard_name' => 'admin', 'group_name' => $permissionGroup]);
                $roleSuperAdmin->givePermissionTo($permission);
                $permission->assignRole($roleSuperAdmin);
            }
        }
    }
}
