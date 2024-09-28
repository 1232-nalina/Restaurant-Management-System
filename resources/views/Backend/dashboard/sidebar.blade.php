@php
    $whouser = Auth::guard('admin')->user();
@endphp

<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title">
                    <span>@lang('public.mainmenu')</span>
                </li>
                <li class=" @if (Request::routeIs('dashboard')) active @endif ">
                    <a href="{{ route('dashboard') }}"><i class="fas fa-tachometer-alt"></i><span> @lang('public.dashboard')
                        </span> </a>

                </li>


                {{-- @if ($whouser->can('income_category.create') || $whouser->can('income_category.edit') || $whouser->can('income_category.delete') || $whouser->can('income_category.view'))
                    <li class="submenu @if (Request::routeIs('income_category.index', 'income_category.create', 'income_category.edit')) active @endif">
                        <a href="{{ route('income_category.index') }}"><i class="fas fa-solid fa-money-bill"></i> <span> @lang('public.income-category')</span> <span
                                class="menu-arrow"></span></a>
                        <ul>


                            @if ($whouser->can('income_category.view'))
                                <li><a href="{{ route('income_category.index') }}"
                                        class="@if (Request::routeIs('income_category.index')) active @endif">@lang('public.income-category-view')</a></li>
                            @endif
                            @if ($whouser->can('income_category.create'))
                                <li><a href="{{ route('income_category.create') }}"
                                        class="@if (Request::routeIs('income_category.create')) active @endif">@lang('public.income-category-add')</a></li>
                            @endif



                        </ul>
                    </li>
                @endif --}}
                {{-- @if ($whouser->can('expenses_category.create') || $whouser->can('expenses_category.edit') || $whouser->can('expenses_category.delete') || $whouser->can('expenses_category.view') || $whouser->can('expenses.create') || $whouser->can('expenses.edit') || $whouser->can('expenses.delete') || $whouser->can('expenses.view') || $whouser->can('expenses.report'))

                    <li class="submenu @if (Request::routeIs('expenses_category.index', 'expenses_category.create', 'expenses_category.edit')) active @endif">
                        <a href="{{ route('expenses_category.index') }}"><i class="fas fa-solid fa-coins"></i> <span> @lang('public.expenses-management')</span> <span
                                class="menu-arrow"></span></a>
                        <ul>


                            @if ($whouser->can('expenses_category.view'))
                                <li><a href="{{ route('expenses_category.index') }}"
                                        class="@if (Request::routeIs('expenses_category.index')) active @endif">@lang('public.expenses-management-expenses-category')</a></li>
                            @endif
                            @if ($whouser->can('expenses.view'))
                                <li><a href="{{ route('expenses.index') }}"
                                        class="@if (Request::routeIs('expenses.index')) active @endif">@lang('public.expenses-management-all-expenses')</a></li>
                            @endif
                            @if ($whouser->can('expenses.report'))
                                <li><a href="{{ route('expenses.report.view') }}"
                                        class="@if (Request::routeIs('expenses.report.view')) active @endif">@lang('public.expenses-management-report')</a></li>
                            @endif




                        </ul>
                    </li>
                @endif --}}

                 <li class="submenu @if (Request::routeIs('about.index', 'about.create', 'about.edit')) active @endif">
                    <a href="{{ route('about.index') }}" class="@if (Request::routeIs('about.index' || 'about.create' || 'about.edit')) subdrop @endif"><i
                            class="fas fa-info"></i> <span>About</span> <span class="menu-arrow"></span></a>
                    <ul @if (Request::routeIs('about.index')) style="display: block;" @endif>
                        <li><a class="@if (Request::routeIs('about.index')) active @endif"
                                href="{{ route('about.index') }}">view</a></li>
                        <li><a class="@if (Request::routeIs('about.create')) active @endif"
                                href="{{ route('about.create') }}">add</a></li>
                    </ul>
                </li> 
                <li class="submenu @if (Request::routeIs('team.index', 'team.create', 'team.edit')) active @endif">
                    <a href="{{ route('team.index') }}" class="@if (Request::routeIs('team.index' || 'team.create' || 'team.edit')) subdrop @endif"><i
                            class="fas fa-users"></i> <span>Team</span> <span class="menu-arrow"></span></a>
                    <ul @if (Request::routeIs('team.index')) style="display: block;" @endif>
                        <li><a class="@if (Request::routeIs('team.index')) active @endif"
                                href="{{ route('team.index') }}">view</a></li>
                        <li><a class="@if (Request::routeIs('team.create')) active @endif"
                                href="{{ route('team.create') }}">add</a></li>
                    </ul>
                </li>
                @if (
                    $whouser->can('table.create') ||
                        $whouser->can('table.edit') ||
                        $whouser->can('table.delete') ||
                        $whouser->can('table.view'))
                    <li class="submenu @if (Request::routeIs('table.index', 'table.create', 'table.edit')) active @endif">
                        <a href="{{ route('table.index') }}"><i class="fas fa-chair"></i> <span>Tables</span> <span
                                class="menu-arrow"></span></a>
                        <ul>


                            @if ($whouser->can('table.view'))
                                <li><a href="{{ route('table.index') }}"
                                        class="@if (Request::routeIs('table.index')) active @endif">view</a></li>
                            @endif
                            @if ($whouser->can('table.create'))
                                <li><a href="{{ route('table.create') }}"
                                        class="@if (Request::routeIs('table.create')) active @endif">add</a></li>
                            @endif



                        </ul>
                    </li>
                @endif
                <li class="">
                <a href="{{ route('reservation.index') }}">
                    <i class="fas fa-chair"></i> 
                    <span>Reservations</span>
                    <span class="menu-arrow"></span>
                </a>
            </li>
                {{--@if (
                    $whouser->can('kitchen.create') ||
                        $whouser->can('kitchen.edit') ||
                        $whouser->can('kitchen.delete') ||
                        $whouser->can('kitchen.view'))
                    <li class="submenu @if (Request::routeIs('kitchen.index', 'kitchen.create', 'kitchen.edit')) active @endif">
                        <a href="{{ route('kitchen.index') }}"><i class="fas fa-chair"></i> <span>Kitchens</span> <span
                                class="menu-arrow"></span></a>
                        <ul>


                            @if ($whouser->can('kitchen.view'))
                                <li><a href="{{ route('kitchen.index') }}"
                                        class="@if (Request::routeIs('kitchen.index')) active @endif">view</a></li>
                            @endif
                            @if ($whouser->can('kitchen.create'))
                                <li><a href="{{ route('kitchen.create') }}"
                                        class="@if (Request::routeIs('kitchen.create')) active @endif">add</a></li>
                            @endif



                        </ul>
                    </li>
                @endif--}}

                @if ($whouser->can('menucategory.view') || $whouser->can('menuitem.view'))

                    <li class="submenu @if (Request::routeIs('menucategory.index', 'menucategory.create', 'menucategory.edit')) active @endif">
                        <a href="{{ route('menucategory.index') }}"><i class="fas fa-pizza-slice"></i> <span>menu</span>
                            <span class="menu-arrow"></span></a>
                        <ul>


                            @if ($whouser->can('menucategory.view'))
                                <li><a href="{{ route('menucategory.index') }}"
                                        class="@if (Request::routeIs('menucategory.index')) active @endif">Menu Categories</a>
                                </li>
                            @endif
                            @if ($whouser->can('menuitem.view'))
                                <li><a href="{{ route('menuitem.index') }}"
                                        class="@if (Request::routeIs('menuitem.index')) active @endif">Menu Items</a></li>
                            @endif

                        </ul>
                    </li>
                @endif
                @if ($whouser->can('order.take') || $whouser->can('order.view'))

                    <li class="submenu @if (Request::routeIs('order.take')) active @endif">
                        <a href="{{ route('order.take') }}"><i class="fas fa-utensils"></i> <span>order</span> <span
                                class="menu-arrow"></span></a>
                        <ul>


                            @if ($whouser->can('order.take'))
                                <li><a href="{{ route('order.take') }}"
                                        class="@if (Request::routeIs('order.take')) active @endif">Take Order</a></li>
                            @endif

                            @if ($whouser->can('order.view'))
                                <li><a href="{{ route('order.view') }}"
                                        class="@if (Request::routeIs('order.view')) active @endif">View Orders</a></li>
                            @endif




                        </ul>
                    </li>
                @endif

                @if (
                    $whouser->can('setting.create') ||
                        $whouser->can('setting.edit') ||
                        $whouser->can('setting.delete') ||
                        $whouser->can('setting.view') ||
                        $whouser->can('admin.view') ||
                        $whouser->can('admin.edit') ||
                        $whouser->can('admin.delete') ||
                        $whouser->can('admin.create') ||
                        $whouser->can('roles.create') ||
                        $whouser->can('roles.edit') ||
                        $whouser->can('roles.delete') ||
                        $whouser->can('roles.view'))

                    <li class="submenu @if (Request::routeIs(
                            'systemsetting.index',
                            'systemsetting.create',
                            'systemsetting.edit',
                            'admin.index',
                            'admin.create',
                            'admin.edit',
                            'roles.index',
                            'roles.create',
                            'roles.edit')) active @endif">
                        <a href="{{ route('systemsetting.index') }}"><i class="fas fa-user-cog"></i>
                            <span>@lang('public.system-setting')</span> <span class="menu-arrow"></span></a>
                        <ul>


                            {{-- @if ($whouser->can('setting.view'))
                                <li><a href="{{ route('systemsetting.index') }}"
                                        class="@if (Request::routeIs('systemsetting.index')) active @endif">@lang('public.system-setting-view')</a>
                                </li>
                            @endif --}}
                            {{-- @if ($whouser->can('setting.create'))
                                <li><a href="{{ route('systemsetting.create') }}"
                                        class="@if (Request::routeIs('systemsetting.create')) active @endif">Add</a></li>
                            @endif --}}
                            @if ($whouser->can('role.view'))
                                <li><a href="{{ route('roles.index') }}"
                                        class="@if (Request::routeIs('roles.index', 'roles.create', 'roles.edit')) active @endif ">@lang('public.system-setting-roles')</a>
                                </li>
                            @endif
                            @if ($whouser->can('admin.view'))
                                <li><a href="{{ route('admin.index') }}"
                                        class="@if (Request::routeIs('admin.index', 'admin.create', 'admin.edit')) active @endif">@lang('public.system-setting-users')</a>
                                </li>
                            @endif



                        </ul>
                    </li>
                @endif
                {{-- @if (
                    $whouser->can('stock.create') ||
                        $whouser->can('stock.edit') ||
                        $whouser->can('stock.delete') ||
                        $whouser->can('stock.view'))

                                <li class="submenu @if (Request::routeIs('stock.index', 'stock.create', 'stock.edit')) active @endif">
                                    <a href="{{ route('inventories.index') }}" class="@if (Request::routeIs('inventories.index' || 'inventories.create' || 'inventories.edit')) subdrop @endif"><i
                                            class="fas fa-envelope"></i> <span>Inventory</span> <span class="menu-arrow"></span></a>
                                    <ul @if (Request::routeIs('stock.index')) style="display: block;" @endif>

                                                @if ($whouser->can('stock.view'))
                                                <li><a class="@if (Request::routeIs('stock.index')) active @endif"
                                                    href="{{ route('inventories.index') }}">view</a></li>

                                                @endif
                                                @if ($whouser->can('stock.create'))
                                                <li><a class="@if (Request::routeIs('stock.create')) active @endif"
                                                    href="{{ route('inventories.create') }}">add</a></li>

                                                @endif
                                    </ul>







                        </ul>
                    </li>
                @endif--}}

                {{-- <li class="submenu @if (Request::routeIs('contact.index', 'contact.create', 'contact.edit')) active @endif">
                    <a href="{{ route('contact.index') }}" class="@if (Request::routeIs('contact.index' || 'contact.create' || 'contact.edit')) subdrop @endif"><i
                            class="fas fa-envelope"></i> <span>Contact</span> <span class="menu-arrow"></span></a>
                    <ul @if (Request::routeIs('contact.index')) style="display: block;" @endif>
                        <li><a class="@if (Request::routeIs('contact.index')) active @endif"
                                href="{{ route('contact.index') }}">view</a></li>
                        <li><a class="@if (Request::routeIs('contact.create')) active @endif"
                                href="{{ route('contact.create') }}">add</a></li>
                    </ul>
                </li> --}}

            </ul>
        </div>
    </div>
</div>
