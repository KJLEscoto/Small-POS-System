<x-main-layout>
    <section class="flex items-start gap-1 text-lg font-bold">
        <h1>Customers</h1>
        @if ($totalCustomers != 0)
            <span class="text-sm">({{ $totalCustomers }})</span>
        @endif
    </section>

    <div class="mt-5 grid grid-cols-3 gap-5">
        @forelse ($customers as $customer)
            <a href="{{ route('customers.show', $customer->name) }}"
                class="rounded shadow-md p-7 border-2 border-white group hover:border-black h-auto w-full transition-all duration-200 ease-in bg-white flex gap-7 items-center cursor-pointer">
                <div class="w-auto h-auto">
                    <div class="w-20 h-20 rounded-full bg-gray-200 overflow-hidden">
                        @if ($customer->image)
                            <img class="w-full h-full object-cover" src="{{ asset('storage/' . $customer->image) }}" />
                        @else
                            <img class="w-full h-full object-cover"
                                src="{{ asset('storage/user_images/default-user.jpg') }}" />
                        @endif
                    </div>
                </div>
                <div class="w-full">
                    <h1 class="w-fit font-semibold hover:underline underline-offset-4 text-lg truncate">
                        {{ $customer->name }}
                    </h1>
                    @if ($customer->balance <= 0)
                        <h1 class="text-gray-600">Balance: <span
                                class="text-green-500 font-medium">₱{{ $customer->balance }}</span>
                        </h1>
                    @elseif ($customer->balance <= 499)
                        <h1 class="text-gray-600">Balance: <span
                                class="text-blue-500 font-medium">₱{{ $customer->balance }}</span>
                        </h1>
                    @else
                        <h1 class="text-gray-600">Balance: <span
                                class="text-red-500 font-medium">₱{{ $customer->balance }}</span>
                        </h1>
                    @endif
                </div>
            </a>
        @empty
            <p class="text-gray-500 font-semibold text-sm">No customers here.</p>
        @endforelse
    </div>
</x-main-layout>
