@props(['routeName' => ''])

<a href="{{ route($routeName) }}" @class([
    'px-7 py-4 font-semibold hover:bg-black/20 w-full flex gap-2 text-black/70 bg-white',
    '!bg-black !text-white hover:!bg-black/85' => Request::routeIs(
        $routeName . '*'),
])>
    {{ $slot }}
</a>
