<x-main-layout>
    @if (session('success'))
        <x-flash-msg msg="success" />
    @elseif (session('invalid'))
        <x-flash-msg msg="invalid" />
    @elseif (session('update'))
        <x-flash-msg msg="update" />
    @endif

    <div class="w-full flex justify-between items-end gap-5">
        <h1 class="text-lg font-bold">Customer Details</h1>
        <section class="flex items-center gap-3">
            <a href="{{ route('customers.index') }}"
                class="px-5 py-2 text-black rounded border border-gray-300 hover:border-black">
                <div class="w-auto h-auto flex items-center gap-2">
                    <span class="pajamas--go-back w-4 h-4"></span>
                    <p class="text-nowrap">Back</p>
                </div>
            </a>
            <button type="button" onclick="openUpdateBalanceModal()"
                class="px-5 py-2 rounded bg-blue-500 hover:bg-blue-600 text-white">
                <div class="w-auto h-auto flex items-center gap-2">
                    <p class="text-nowrap">Update Balance</p>
                    <span class="ri--edit-fill w-4 h-4"></span>
                </div>
            </button>
        </section>
    </div>

    <div class="mt-5 rounded bg-white shadow-md flex divide-x divide-gray-200 h-auto">
        <section class="flex flex-col gap-3 items-center justify-center p-14">
            <div class="w-auto h-auto">
                <div class="w-40 h-40 rounded-full overflow-hidden">
                    @if ($customer->image)
                        <img class="w-full h-full object-cover" src="{{ asset('storage/' . $customer->image) }}" />
                    @else
                        <img class="w-full h-full object-cover"
                            src="{{ asset('storage/user_images/default-user.jpg') }}" />
                    @endif
                </div>
            </div>
            <h1 class="font-medium text-center"> {{ $customer->name }} </h1>
        </section>
        <section class="h-auto w-full divide-y divide-gray-200 flex flex-col">
            <div class="p-5 h-full flex flex-col justify-center gap-4">
                <p class="text-xs font-medium">Account Balance</p>
                <div class="grid grid-cols-3">
                    <section class="flex items-center gap-2">
                        <p class="text-sm text-gray-700">Current Balance:</p>
                        @if ($customer->balance <= 0)
                            <h1 class=" font-medium text-green-500">₱{{ $customer->balance }}</h1>
                        @elseif ($customer->balance <= 499)
                            <h1 class=" font-medium text-blue-500">₱{{ $customer->balance }}</h1>
                        @else
                            <h1 class=" font-medium text-red-500">₱{{ $customer->balance }}</h1>
                        @endif
                    </section>
                    <section class="flex items-center gap-2">
                        <p class="text-sm text-gray-700">Last Update:</p>
                        <h1 class=" font-medium">{{ $customer->updated_at->format('M d, Y | h:i A') }}</h1>
                    </section>
                </div>
            </div>
        </section>
    </div>

    <div class="mt-5 rounded bg-white shadow-md flex divide-x divide-gray-200 h-auto">
        <div class="p-5 h-full flex flex-col justify-center gap-4">
            <p class="text-xs font-medium">Purchase History</p>
        </div>
    </div>

    {{-- update modal --}}
    <div id="updateBalanceModal"
        class="fixed inset-0 flex justify-center items-center overflow-auto bg-gray-900 bg-opacity-50 hidden z-20">
        <form action="{{ route('customers.update', $customer->id) }}" method="POST"
            class="bg-white rounded-lg shadow-lg p-6 w-1/3 h-auto overflow-auto">
            @csrf
            @method('PUT')

            <h2 class="text-xl font-bold text-black">Update Balance</h2>

            <div class="mt-3">
                <div class="flex flex-col gap-5">
                    <section class="flex flex-col gap-1 w-full">
                        <label class="font-medium" for="balance">Current Balance</label>
                        <input readonly
                            class="w-full border px-3 py-2 read-only:bg-gray-100 read-only:cursor-not-allowed"
                            type="text" name="balance" id="balance" value="{{ $customer->balance }}">
                    </section>

                    <section class="flex flex-col gap-1 w-full">
                        <label class="font-medium" for="amount">Amount</label>
                        <input class="w-full border px-3 py-2" type="text" name="amount" id="amount"
                            value="{{ old('amount') }}" oninput="updateTotal()">
                        @error('amount')
                            <p class="text-red-500 font-semibold tracking-wider text-sm select-none">
                                {{ $message }}
                            </p>
                        @enderror
                    </section>

                    {{-- Total Balance Preview --}}
                    <section id="totalPreview" class="hidden flex items-center gap-2 p-3 bg-gray-100 rounded">
                        <p class="text-sm text-gray-700">Total Balance:</p>
                        <h1 class="font-medium" id="totalBalance">₱{{ $customer->balance }}</h1>
                    </section>
                </div>
            </div>

            <div class="flex justify-end mt-7 space-x-3">
                <button type="button" onclick="closeUpdateBalanceModal()"
                    class="px-5 py-2 text-black rounded border border-gray-300 hover:border-black">Cancel</button>
                <button type="submit"
                    class="px-5 py-2 bg-blue-500 text-white rounded hover:bg-blue-500/80 font-semibold">Update</button>
            </div>
        </form>
    </div>

    <script>
        function openUpdateBalanceModal() {
            document.getElementById('updateBalanceModal').classList.remove('hidden');
        }

        function closeUpdateBalanceModal() {
            document.getElementById('updateBalanceModal').classList.add('hidden');
        }

        function updateTotal() {
            let balance = parseFloat(document.getElementById('balance').value.replace(/[₱,]/g, '')) || 0;
            let amount = parseFloat(document.getElementById('amount').value) || 0;
            let total = balance - amount;

            let totalPreview = document.getElementById('totalPreview');
            let totalBalance = document.getElementById('totalBalance');

            if (amount > 0) {
                totalPreview.classList.remove('hidden');
                totalBalance.textContent = `₱${total.toLocaleString()}`;
            } else {
                totalPreview.classList.add('hidden');
            }
        }
    </script>

</x-main-layout>
