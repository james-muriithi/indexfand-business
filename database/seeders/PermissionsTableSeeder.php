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
                'title' => 'product_management_access',
            ],
            [
                'id'    => 18,
                'title' => 'product_category_create',
            ],
            [
                'id'    => 19,
                'title' => 'product_category_edit',
            ],
            [
                'id'    => 20,
                'title' => 'product_category_show',
            ],
            [
                'id'    => 21,
                'title' => 'product_category_delete',
            ],
            [
                'id'    => 22,
                'title' => 'product_category_access',
            ],
            [
                'id'    => 23,
                'title' => 'product_tag_create',
            ],
            [
                'id'    => 24,
                'title' => 'product_tag_edit',
            ],
            [
                'id'    => 25,
                'title' => 'product_tag_show',
            ],
            [
                'id'    => 26,
                'title' => 'product_tag_delete',
            ],
            [
                'id'    => 27,
                'title' => 'product_tag_access',
            ],
            [
                'id'    => 28,
                'title' => 'product_create',
            ],
            [
                'id'    => 29,
                'title' => 'product_edit',
            ],
            [
                'id'    => 30,
                'title' => 'product_show',
            ],
            [
                'id'    => 31,
                'title' => 'product_delete',
            ],
            [
                'id'    => 32,
                'title' => 'product_access',
            ],
            [
                'id'    => 33,
                'title' => 'audit_log_show',
            ],
            [
                'id'    => 34,
                'title' => 'audit_log_access',
            ],
            [
                'id'    => 35,
                'title' => 'order_management_access',
            ],
            [
                'id'    => 36,
                'title' => 'order_edit',
            ],
            [
                'id'    => 37,
                'title' => 'order_show',
            ],
            [
                'id'    => 38,
                'title' => 'order_delete',
            ],
            [
                'id'    => 39,
                'title' => 'order_access',
            ],
            [
                'id'    => 40,
                'title' => 'shop_management_access',
            ],
            [
                'id'    => 41,
                'title' => 'shop_create',
            ],
            [
                'id'    => 42,
                'title' => 'shop_edit',
            ],
            [
                'id'    => 43,
                'title' => 'shop_show',
            ],
            [
                'id'    => 44,
                'title' => 'shop_delete',
            ],
            [
                'id'    => 45,
                'title' => 'shop_access',
            ],
            [
                'id'    => 46,
                'title' => 'customer_management_access',
            ],
            [
                'id'    => 47,
                'title' => 'customer_edit',
            ],
            [
                'id'    => 48,
                'title' => 'customer_show',
            ],
            [
                'id'    => 49,
                'title' => 'customer_delete',
            ],
            [
                'id'    => 50,
                'title' => 'customer_access',
            ],
            [
                'id'    => 51,
                'title' => 'profile_password_edit',
            ],
            [
                'id'    => 52,
                'title' => 'business_edit',
            ],
            [
                'id'    => 53,
                'title' => 'business_show',
            ],
            [
                'id'    => 54,
                'title' => 'business_delete',
            ],
            [
                'id'    => 55,
                'title' => 'business_access',
            ],
            [
                'id'    => 56,
                'title' => 'payment_show',
            ],
            [
                'id'    => 57,
                'title' => 'payment_access',
            ],
            [
                'id'    => 59,
                'title' => 'withdraw_access',
            ],
        ];

        Permission::insert($permissions);
    }
}
