<x-perfect-scrollbar as="nav" aria-label="main" class="flex flex-col flex-1 gap-4 px-3">

    <x-sidebar.link title="Dashboard" href="{{ route('dashboard') }}" :isActive="request()->routeIs('dashboard')">
        <x-slot name="icon">
            <x-icons.dashboard class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>
    </x-sidebar.link>

    @can ('view role') 
        <x-sidebar.link title="Roles" href="{{ route('role.index') }}" :isActive="request()->routeIs(['role.index', 'role.create', 'role.show', 'role.edit'])">
            <x-slot name="icon">
                <x-eos-role-binding class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
            </x-slot>
        </x-sidebar.link>
    @endcan

    @can ('view permission') 
        <x-sidebar.link title="Permissions" href="{{ route('permission.index') }}" :isActive="request()->routeIs(['permission.index', 'permission.create', 'permission.show', 'permission.edit'])">
            <x-slot name="icon">
                <x-fas-user-shield class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
            </x-slot>
        </x-sidebar.link>
    @endcan

    
    @can ('view user') 
        <x-sidebar.dropdown title="Users" :active="Str::startsWith(
            request()
                ->route()
                ->uri(),
            'users',
        )">
            <x-slot name="icon">
                <x-heroicon-s-users class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
            </x-slot>
    
            <x-sidebar.sublink title="All" href="{{ route('users.index') }}" :active="request()->routeIs('users.index')" />
            @can ('create users') 
                <x-sidebar.sublink title="Create" href="{{ route('users.create') }}" :active="request()->routeIs('users.create')" />
            @endcan
        </x-sidebar.dropdown>
    @endcan

    @can ('view inventory') 
        <x-sidebar.dropdown title="Inventory" :active="Str::startsWith(
            request()
                ->route()
                ->uri(),
            'product',
        )">
            <x-slot name="icon">
                <x-fas-box-open class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
            </x-slot>
    
            <x-sidebar.sublink title="All products" href="{{ route('product.index') }}" :active="request()->routeIs('product.index')" />
            @can ('create inventory') 
                <x-sidebar.sublink title="Create product" href="{{ route('product.create') }}" :active="request()->routeIs('product.create')" />
            @endcan
        </x-sidebar.dropdown>
    @endcan

    @can ('view order') 
        <x-sidebar.dropdown title="Orders" :active="Str::startsWith(
            request()
                ->route()
                ->uri(),
            'orders',
        )">
            <x-slot name="icon">
                <x-fas-box-open class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
            </x-slot>
    
            <x-sidebar.sublink title="All orders" href="{{ route('orders.index') }}" :active="request()->routeIs('orders.index')" />
            @can ('create inventory') 
                <x-sidebar.sublink title="Create order" href="{{ route('orders.create') }}" :active="request()->routeIs('orders.create')" />
            @endcan
        </x-sidebar.dropdown>
    @endcan

    {{-- <div x-transition x-show="isSidebarOpen || isSidebarHovered" class="text-sm text-gray-500">Additional Links</div> --}}

    @php
        $links = array_fill(0, 20, '');
    @endphp

    {{-- @foreach ($links as $index => $link)
        <x-sidebar.link title="Dummy link {{ $index + 1 }}" href="#" />
    @endforeach --}}

</x-perfect-scrollbar>
