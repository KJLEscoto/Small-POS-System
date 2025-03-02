<x-main-layout>
    products here
</x-main-layout>

{{-- place order modal --}}
<div id="placeOrderModal"
    class="fixed inset-0 flex justify-center items-center overflow-auto bg-gray-900 bg-opacity-50 hidden z-20">
    <form action="{{ route('cashier.store') }}" method="POST"
        class="bg-white rounded-lg shadow-lg p-6 w-1/3 h-[500px] overflow-auto">
        @csrf
        <h2 class="text-xl font-bold text-black">Place Order</h2>

        <div class="mt-3">
            <div class="flex flex-col gap-5">
                <section class="">
                    <h1>Orders:</h1>
                    {{--  orders here with quantity --}}
                </section>

                <section class="flex flex-col gap-1 w-full">
                    <label class="font-medium" for="customer">Customer</label>
                    <select @class(['w-full border px-3 py-2']) name="customer" id="customer">
                        <option value="{{ old('customer') }}" disabled selected>Select</option>
                        @foreach ($customers as $customer)
                            <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                        @endforeach
                    </select>
                    @error('customer')
                        <p class="text-red-500 font-semibold tracking-wider text-sm select-none">
                            {{ $message }}
                        </p>
                    @enderror
                </section>
            </div>
        </div>

        <div class="flex justify-end mt-7 space-x-3">
            <button type="button" onclick="closePlaceOrderModal()"
                class="px-5 py-2 text-black rounded border border-gray-300 hover:border-black">
                Cancel
            </button>
            <button type="submit" class="px-5 py-2 bg-gray-700 text-white rounded hover:bg-gray-700/80 font-semibold">
                Submit
            </button>
        </div>
    </form>
</div>
