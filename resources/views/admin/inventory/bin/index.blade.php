<x-main-layout>
    @if (session('success'))
        <x-flash-msg msg="success" />
    @elseif (session('invalid'))
        <x-flash-msg msg="invalid" />
    @elseif (session('update'))
        <x-flash-msg msg="update" />
    @endif

    <h1 class="text-lg font-bold">Recycle Bin</h1>
    <table class="w-full border border-gray-300 text-left mt-5">
        <thead>
            <tr class="bg-gray-200">
                <th class="p-2 border">#</th>
                <th class="p-2 border">Product Name</th>
                <th class="p-2 border">Category</th>
                <th class="p-2 border">Stock</th>
                <th class="p-2 border">Original Price</th>
                <th class="p-2 border">Selling Price</th>
                <th class="p-2 border">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($archives as $index => $product)
                <tr class="border">
                    <td class="p-2 border">{{ $index + 1 }}</td>
                    <td class="p-2 border">{{ $product->name }}</td>
                    <td class="p-2 border">{{ $product->category->name ?? 'N/A' }}</td>
                    <td class="p-2 border">{{ $product->stock }}</td>
                    <td class="p-2 border">₱{{ number_format($product->original_price, 2) }}</td>
                    <td class="p-2 border">₱{{ number_format($product->selling_price, 2) }}</td>
                    <td class="p-2 border">
                        <form action="{{ route('bin.restore', $product->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="px-4 py-1 bg-green-500 text-white rounded hover:bg-green-600">
                                Restore
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center p-3 text-gray-500">No archived products found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</x-main-layout>
