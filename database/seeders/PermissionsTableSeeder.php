<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'pointdeau_create',
            ],
            [
                'id'    => 18,
                'title' => 'pointdeau_edit',
            ],
            [
                'id'    => 19,
                'title' => 'pointdeau_show',
            ],
            [
                'id'    => 20,
                'title' => 'pointdeau_delete',
            ],
            [
                'id'    => 21,
                'title' => 'pointdeau_access',
            ],
            [
                'id'    => 22,
                'title' => 'audit_log_show',
            ],
            [
                'id'    => 23,
                'title' => 'audit_log_access',
            ],
            [
                'id'    => 24,
                'title' => 'localisation_create',
            ],
            [
                'id'    => 25,
                'title' => 'localisation_edit',
            ],
            [
                'id'    => 26,
                'title' => 'localisation_show',
            ],
            [
                'id'    => 27,
                'title' => 'localisation_delete',
            ],
            [
                'id'    => 28,
                'title' => 'localisation_access',
            ],
            [
                'id'    => 29,
                'title' => 'region_create',
            ],
            [
                'id'    => 30,
                'title' => 'region_edit',
            ],
            [
                'id'    => 31,
                'title' => 'region_show',
            ],
            [
                'id'    => 32,
                'title' => 'region_delete',
            ],
            [
                'id'    => 33,
                'title' => 'region_access',
            ],
            [
                'id'    => 34,
                'title' => 'ville_create',
            ],
            [
                'id'    => 35,
                'title' => 'ville_edit',
            ],
            [
                'id'    => 36,
                'title' => 'ville_show',
            ],
            [
                'id'    => 37,
                'title' => 'ville_delete',
            ],
            [
                'id'    => 38,
                'title' => 'ville_access',
            ],
            [
                'id'    => 39,
                'title' => 'departement_create',
            ],
            [
                'id'    => 40,
                'title' => 'departement_edit',
            ],
            [
                'id'    => 41,
                'title' => 'departement_show',
            ],
            [
                'id'    => 42,
                'title' => 'departement_delete',
            ],
            [
                'id'    => 43,
                'title' => 'departement_access',
            ],
            [
                'id'    => 44,
                'title' => 'relefe_create',
            ],
            [
                'id'    => 45,
                'title' => 'relefe_edit',
            ],
            [
                'id'    => 46,
                'title' => 'relefe_show',
            ],
            [
                'id'    => 47,
                'title' => 'relefe_delete',
            ],
            [
                'id'    => 48,
                'title' => 'relefe_access',
            ],
            [
                'id'    => 49,
                'title' => 'carte_create',
            ],
            [
                'id'    => 50,
                'title' => 'carte_edit',
            ],
            [
                'id'    => 51,
                'title' => 'carte_show',
            ],
            [
                'id'    => 52,
                'title' => 'carte_delete',
            ],
            [
                'id'    => 53,
                'title' => 'carte_access',
            ],
            [
                'id'    => 54,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
