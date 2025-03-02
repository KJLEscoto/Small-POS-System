@props(['routeName' => ''])

@php
    // Get the full route name
    $currentRoute = Route::currentRouteName();

    // Check if the route starts with the given routeName or is within inventory/bin
    $isActive =
        Str::startsWith($currentRoute, $routeName) ||
        ($routeName === 'inventory.index' && Str::startsWith($currentRoute, 'bin.')) ||
        ($routeName === 'cashiers.index' && Str::startsWith($currentRoute, 'cashiers.')) ||
        ($routeName === 'customers.index' && Str::startsWith($currentRoute, 'customers.')) ||
        ($routeName === 'sales.index' && Str::startsWith($currentRoute, 'sales.'));
@endphp

<a href="{{ route($routeName) }}" @class([
    'px-5 rounded py-3 font-semibold hover:bg-gray-700/20 w-full flex text-black/60 bg-white',
    '!bg-gray-700 !text-white hover:!bg-gray-700/85' => $isActive,
])>
    {{ $slot }}
</a>
