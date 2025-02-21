@props(['routeName' => ''])

@php
    // Get the full route name
    $currentRoute = Route::currentRouteName();

    // Check if the route starts with the given routeName or is within inventory/bin
    $isActive =
        Str::startsWith($currentRoute, $routeName) ||
        ($routeName === 'inventory.index' && Str::startsWith($currentRoute, 'bin.'));
@endphp

<a href="{{ route($routeName) }}" @class([
    'px-7 py-4 font-semibold hover:bg-black/20 w-full flex text-black/70 bg-white',
    '!bg-black !text-white hover:!bg-black/85' => $isActive,
])>
    {{ $slot }}
</a>
