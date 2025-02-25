<x-main-layout>
    <div class="w-full flex justify-between items-end gap-5">
        <h1 class="text-lg font-bold">Cashier Details</h1>
        <section class="flex items-center gap-3">
            <a href="{{ route('cashiers.index') }}"
                class="px-5 py-2 text-black rounded border border-gray-300 hover:border-black">
                <div class="w-auto h-auto flex items-center gap-2">
                    <span class="pajamas--go-back w-4 h-4"></span>
                    <p class="text-nowrap">Back</p>
                </div>
            </a>
            <a href="{{ route('cashiers.edit', $cashier->username) }}"
                class="px-5 py-2 rounded bg-blue-500 hover:bg-blue-600 text-white">
                <div class="w-auto h-auto flex items-center gap-2">
                    <p class="text-nowrap">Edit</p>
                    <span class="ri--edit-fill w-4 h-4"></span>
                </div>
            </a>
        </section>
    </div>

    <div class="mt-5 rounded bg-white shadow-md flex divide-x divide-gray-200 h-auto">
        <section class="flex flex-col gap-3 items-center justify-center p-14">
            <div class="w-auto h-auto">
                <div class="w-40 h-40 rounded-full overflow-hidden">
                    @if ($cashier->image)
                        <img class="w-full h-full object-cover" src="{{ asset('storage/' . $cashier->image) }}" />
                    @else
                        <img class="w-full h-full object-cover"
                            src="{{ asset('storage/product_images/no_image.jpeg') }}" />
                    @endif
                </div>
            </div>
            <h1 class="font-medium text-center"> {{ $cashier->fullName() }} </h1>
            @if ($cashier->status === 'active')
                <p class="text-xs px-4 py-1 rounded-full text-white bg-green-500 font-medium">{{ $cashier->status }}</p>
            @else
                <p class="text-xs px-4 py-1 rounded-full text-white bg-red-500 font-medium">{{ $cashier->status }}</p>
            @endif
        </section>
        <section class="h-auto w-full divide-y divide-gray-200 flex flex-col">
            <div class="p-5 h-full flex flex-col justify-center gap-4">
                <p class="text-xs font-medium">User Profile</p>
                <div class="grid grid-cols-3">
                    <section class="flex items-center gap-2">
                        <p class="text-sm text-gray-700">Gender:</p>
                        <h1 class=" font-medium">{{ $cashier->gender }}</h1>
                    </section>
                    <section class="flex items-center gap-2">
                        <p class="text-sm text-gray-700">Role:</p>
                        <h1 class=" font-medium">{{ $cashier->role }}</h1>
                    </section>
                    <section class="flex items-center gap-2">
                        <p class="text-sm text-gray-700">Date of Birth:</p>
                        <h1 class=" font-medium">{{ $cashier->date_of_birth->format('M d, Y') }}</h1>
                    </section>
                </div>
            </div>
            <div class="p-5 h-full flex flex-col justify-center gap-4">
                <p class="text-xs font-medium">Account Details</p>
                <div class="grid grid-cols-3">
                    <section class="flex items-center gap-2">
                        <p class="text-sm text-gray-700">Username:</p>
                        <h1 class=" font-medium">{{ $cashier->username }}</h1>
                    </section>
                    <section class="flex items-center gap-2">
                        <p class="text-sm text-gray-700">Email:</p>
                        <h1 class=" font-medium">{{ $cashier->email }}</h1>
                    </section>
                    <section class="flex items-center gap-2">
                        <p class="text-sm text-gray-700">Account Started:</p>
                        <h1 class=" font-medium">{{ $cashier->created_at->format('M d, Y') }}</h1>
                    </section>
                </div>
            </div>
        </section>
    </div>

</x-main-layout>
