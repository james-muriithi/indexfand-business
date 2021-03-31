<div id="sidebar" class="c-sidebar c-sidebar-fixed c-sidebar-lg-show">

    <div class="c-sidebar-brand d-md-down-none">
        <a class="c-sidebar-brand-full h4" href="#">
            {{ trans('panel.site_title') }}
        </a>
    </div>

    <ul class="c-sidebar-nav">
        <li class="c-sidebar-nav-item">
            <a href="{{ route("admin.home") }}" class="c-sidebar-nav-link">
                <i class="c-sidebar-nav-icon fas fa-fw fa-tachometer-alt">

                </i>
                {{ trans('global.dashboard') }}
            </a>
        </li>
{{--        @can('product_management_access')--}}
{{--            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/product-categories*") ? "c-show" : "" }} {{ request()->is("admin/product-tags*") ? "c-show" : "" }} {{ request()->is("admin/products*") ? "c-show" : "" }}">--}}
{{--                <a class="c-sidebar-nav-dropdown-toggle" href="#">--}}
{{--                    <i class="fa-fw fas fa-shopping-cart c-sidebar-nav-icon">--}}

{{--                    </i>--}}
{{--                    {{ trans('cruds.productManagement.title') }}--}}
{{--                </a>--}}
{{--                <ul class="c-sidebar-nav-dropdown-items">--}}
{{--                    @can('product_category_access')--}}
{{--                        <li class="c-sidebar-nav-item">--}}
{{--                            <a href="{{ route("admin.product-categories.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/product-categories") || request()->is("admin/product-categories/*") ? "c-active" : "" }}">--}}
{{--                                <i class="fa-fw fas fa-folder c-sidebar-nav-icon">--}}

{{--                                </i>--}}
{{--                                {{ trans('cruds.productCategory.title') }}--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    @endcan--}}
{{--                    @can('product_tag_access')--}}
{{--                        <li class="c-sidebar-nav-item">--}}
{{--                            <a href="{{ route("admin.product-tags.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/product-tags") || request()->is("admin/product-tags/*") ? "c-active" : "" }}">--}}
{{--                                <i class="fa-fw fas fa-folder c-sidebar-nav-icon">--}}

{{--                                </i>--}}
{{--                                {{ trans('cruds.productTag.title') }}--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    @endcan--}}
{{--                    @can('product_access')--}}
{{--                        <li class="c-sidebar-nav-item">--}}
{{--                            <a href="{{ route("admin.products.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/products") || request()->is("admin/products/*") ? "c-active" : "" }}">--}}
{{--                                <i class="fa-fw fas fa-shopping-cart c-sidebar-nav-icon">--}}

{{--                                </i>--}}
{{--                                {{ trans('cruds.product.title') }}--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    @endcan--}}
{{--                </ul>--}}
{{--            </li>--}}
{{--        @endcan--}}
{{--        @can('order_management_access')--}}
{{--            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/orders*") ? "c-show" : "" }}">--}}
{{--                <a class="c-sidebar-nav-dropdown-toggle" href="#">--}}
{{--                    <i class="fa-fw fab fa-500px c-sidebar-nav-icon">--}}

{{--                    </i>--}}
{{--                    {{ trans('cruds.orderManagement.title') }}--}}
{{--                </a>--}}
{{--                <ul class="c-sidebar-nav-dropdown-items">--}}
{{--                    @can('order_access')--}}
{{--                        <li class="c-sidebar-nav-item">--}}
{{--                            <a href="{{ route("admin.orders.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/orders") || request()->is("admin/orders/*") ? "c-active" : "" }}">--}}
{{--                                <i class="fa-fw fab fa-accusoft c-sidebar-nav-icon">--}}

{{--                                </i>--}}
{{--                                {{ trans('cruds.order.title') }}--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    @endcan--}}
{{--                </ul>--}}
{{--            </li>--}}
{{--        @endcan--}}
{{--        @can('shop_access')--}}
{{--            <li class="c-sidebar-nav-item">--}}
{{--                <a href="{{ route("admin.shops.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/shops") || request()->is("admin/shops/*") ? "c-active" : "" }}">--}}
{{--                    <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">--}}

{{--                    </i>--}}
{{--                    {{ trans('cruds.shop.title') }}--}}
{{--                </a>--}}
{{--            </li>--}}
{{--        @endcan--}}
        @can('business_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.businesses.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/businesses") || request()->is("admin/businesses/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-store-alt c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.business.title') }}
                </a>
            </li>
        @endcan
        @can('payment_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.payments.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/payments") || request()->is("admin/payments/*") ? "c-active" : "" }}">
                    <i class="fa-fw far fa-money-bill-alt c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.payment.title') }}
                </a>
            </li>
        @endcan
        @can('withdraw_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.withdraws.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/withdraws") || request()->is("admin/withdraws/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-mobile-alt c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.withdraw.title') }}
                </a>
            </li>
        @endcan
        @can('customer_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.customers.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/customers") || request()->is("admin/customers/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.customer.title') }}s
                </a>
            </li>
        @endcan
        @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
            @can('profile_password_edit')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'c-active' : '' }}" href="{{ route('profile.password.edit') }}">
                        <i class="fa-fw fas fa-key c-sidebar-nav-icon">
                        </i>
                        {{ trans('global.change_password') }}
                    </a>
                </li>
            @endcan
        @endif
        <li class="c-sidebar-nav-item">
            <a href="#" class="c-sidebar-nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                <i class="c-sidebar-nav-icon fas fa-fw fa-sign-out-alt">

                </i>
                {{ trans('global.logout') }}
            </a>
        </li>
    </ul>

</div>
