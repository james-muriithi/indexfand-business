<?php

return [
    'userManagement'     => [
        'title'          => 'User management',
        'title_singular' => 'User management',
    ],
    'permission'         => [
        'title'          => 'Permissions',
        'title_singular' => 'Permission',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'title'             => 'Title',
            'title_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'role'               => [
        'title'          => 'Roles',
        'title_singular' => 'Role',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'title'              => 'Title',
            'title_helper'       => ' ',
            'permissions'        => 'Permissions',
            'permissions_helper' => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'user'               => [
        'title'          => 'Users',
        'title_singular' => 'User',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => ' ',
            'name'                     => 'Name',
            'name_helper'              => ' ',
            'email'                    => 'Email',
            'email_helper'             => ' ',
            'email_verified_at'        => 'Email verified at',
            'email_verified_at_helper' => ' ',
            'password'                 => 'Password',
            'password_helper'          => ' ',
            'roles'                    => 'Roles',
            'roles_helper'             => ' ',
            'remember_token'           => 'Remember Token',
            'remember_token_helper'    => ' ',
            'created_at'               => 'Created at',
            'created_at_helper'        => ' ',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => ' ',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => ' ',
            'mobile'                   => 'Mobile',
            'mobile_helper'            => ' ',
        ],
    ],
    'productManagement'  => [
        'title'          => 'Product Management',
        'title_singular' => 'Product Management',
    ],
    'productCategory'    => [
        'title'          => 'Categories',
        'title_singular' => 'Category',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'name'               => 'Name',
            'name_helper'        => ' ',
            'description'        => 'Description',
            'description_helper' => ' ',
            'photo'              => 'Photo',
            'photo_helper'       => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated At',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted At',
            'deleted_at_helper'  => ' ',
            'created_by'         => 'Created By',
            'created_by_helper'  => ' ',
        ],
    ],
    'productTag'         => [
        'title'          => 'Tags',
        'title_singular' => 'Tag',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated At',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted At',
            'deleted_at_helper' => ' ',
            'created_by'        => 'Created By',
            'created_by_helper' => ' ',
        ],
    ],
    'product'            => [
        'title'          => 'Products',
        'title_singular' => 'Product',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'name'               => 'Name',
            'name_helper'        => ' ',
            'description'        => 'Description',
            'description_helper' => ' ',
            'price'              => 'Price',
            'price_helper'       => ' ',
            'category'           => 'Categories',
            'category_helper'    => ' ',
            'tag'                => 'Tags',
            'tag_helper'         => ' ',
            'photo'              => 'Photo',
            'photo_helper'       => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated At',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted At',
            'deleted_at_helper'  => ' ',
            'created_by'         => 'Created By',
            'created_by_helper'  => ' ',
            'status'             => 'Status',
            'status_helper'      => ' ',
            'quantity'           => 'Quantity',
            'quantity_helper'    => ' ',
            'shop'               => 'Shop',
            'shop_helper'        => ' ',
        ],
    ],
    'auditLog'           => [
        'title'          => 'Audit Logs',
        'title_singular' => 'Audit Log',
        'fields'         => [
            'id'                  => 'ID',
            'id_helper'           => ' ',
            'description'         => 'Description',
            'description_helper'  => ' ',
            'subject_id'          => 'Subject ID',
            'subject_id_helper'   => ' ',
            'subject_type'        => 'Subject Type',
            'subject_type_helper' => ' ',
            'user_id'             => 'User ID',
            'user_id_helper'      => ' ',
            'properties'          => 'Properties',
            'properties_helper'   => ' ',
            'host'                => 'Host',
            'host_helper'         => ' ',
            'created_at'          => 'Created at',
            'created_at_helper'   => ' ',
            'updated_at'          => 'Updated at',
            'updated_at_helper'   => ' ',
        ],
    ],
    'orderManagement'    => [
        'title'          => 'Order Management',
        'title_singular' => 'Order Management',
    ],
    'order'              => [
        'title'          => 'Orders',
        'title_singular' => 'Order',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'status'            => 'Status',
            'status_helper'     => '',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
            'customer'           => 'Customer',
            'cutomer_helper'    => ' ',
            'total'             => 'Total',
            'order_items'       => 'Order Items',
        ],
    ],
    'shopManagement'     => [
        'title'          => 'Shop Management',
        'title_singular' => 'Shop Management',
    ],
    'shop'               => [
        'title'          => 'Shops',
        'title_singular' => 'Shop',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'shop_name'          => 'Shop Name',
            'shop_name_helper'   => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
            'location'           => 'Location',
            'location_helper'    => ' ',
            'industry'           => 'Industry',
            'industry_helper'    => ' ',
            'description'        => 'Shop Description',
            'description_helper' => ' ',
            'short_name'         => 'Short Name',
            'short_name_helper'  => ' ',
            'user'               => 'User',
            'user_helper'        => ' ',
            'products'           => 'Products',
            'products_helper'   => ' ',
        ],
    ],
    'customerManagement' => [
        'title'          => 'Customer Management',
        'title_singular' => 'Customer Management',
    ],
    'customer'           => [
        'title'          => 'Customer',
        'title_singular' => 'Customer',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'mobile'            => 'Mobile',
            'mobile_helper'     => ' ',
            'email'             => 'Email',
            'email_helper'      => ' ',
            'location'          => 'Location',
            'location_helper'   => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'business'       => [
        'title'          => 'Businesses',
        'title_singular' => 'Business',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'name'               => 'Name',
            'name_helper'        => ' ',
            'tag'                => 'Tag',
            'tag_helper'         => ' ',
            'contact'            => 'Contact',
            'contact_helper'     => ' ',
            'email'              => 'Email',
            'email_helper'       => ' ',
            'industry'           => 'Industry',
            'industry_helper'    => ' ',
            'description'        => 'Description',
            'description_helper' => ' ',
            'networth'           => 'Networth',
            'networth_helper'    => ' ',
            'balance'            => 'Balance',
            'balance_helper'     => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'payment'        => [
        'title'          => 'Payments',
        'title_singular' => 'Payment',
        'fields'         => [
            'id'                    => 'ID',
            'id_helper'             => ' ',
            'sender_name'           => 'Sender Name',
            'sender_name_helper'    => ' ',
            'sender_contact'        => 'Sender Contact',
            'sender_contact_helper' => ' ',
            'receiver'              => 'Receiver',
            'receiver_helper'       => ' ',
            'code'                  => 'Code',
            'code_helper'           => ' ',
            'amount'                => 'Amount',
            'amount_helper'         => ' ',
            'status'                => 'Approved',
            'status_helper'         => ' ',
            'created_at'            => 'Created at',
            'created_at_helper'     => ' ',
            'updated_at'            => 'Updated at',
            'updated_at_helper'     => ' ',
            'deleted_at'            => 'Deleted at',
            'deleted_at_helper'     => ' ',
        ],
    ],
    'withdraw'       => [
        'title'          => 'Withdraw',
        'title_singular' => 'Withdraw',
    ],
];
