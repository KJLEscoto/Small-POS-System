<x-main-layout>
    @if (session('success'))
        <x-flash-msg msg="success" />
    @elseif (session('invalid'))
        <x-flash-msg msg="invalid" />
    @elseif (session('update'))
        <x-flash-msg msg="update" />
    @endif

    <div class="w-full flex justify-between items-end gap-5">
        <section class="flex items-start gap-1 text-lg font-bold">
            <h1>Cashiers</h1>
            @if ($totalCashiers != 0)
                <span class="text-sm">({{ $totalCashiers }})</span>
            @endif
        </section>
        <a href="{{ route('cashiers.create') }}" class="px-5 py-2 rounded bg-gray-700 hover:bg-gray-700/80 text-white">
            <div class="w-auto h-auto flex items-center gap-2">
                <span class="ic--round-plus w-5 h-5"></span>
                <p class="text-nowrap">New Cashier</p>
            </div>
        </a>
    </div>

    <div class="mt-5 grid grid-cols-3 gap-5">
        @forelse ($cashiers as $cashier)
            <a href="{{ route('cashiers.show', $cashier->username) }}"
                class="rounded shadow-md p-7 border-2 border-white group hover:border-black h-auto w-full transition-all duration-200 ease-in bg-white flex flex-col gap-3 items-center cursor-pointer">
                <div class="w-auto h-auto">
                    <div class="w-20 h-20 rounded-full bg-gray-200 overflow-hidden">
                        @if ($cashier->image)
                            <img class="w-full h-full object-cover" src="{{ asset('storage/' . $cashier->image) }}" />
                        @else
                            <img class="w-full h-full object-cover"
                                src="{{ asset('storage/product_images/no_image.jpeg') }}" />
                        @endif
                    </div>
                </div>
                <div class="text-center">
                    <h1 class="font-semibold hover:underline underline-offset-4 text-lg">{{ $cashier->fullName() }}</h1>
                    <p class="text-sm">{{ $cashier->email }}</p>
                </div>
            </a>
        @empty
            <p class="text-gray-500 font-semibold text-sm">No cashiers here.</p>
        @endforelse
    </div>
</x-main-layout>
