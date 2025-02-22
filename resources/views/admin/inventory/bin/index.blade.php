<x-main-layout>
    @if (session('success'))
        <x-flash-msg msg="success" />
    @elseif (session('invalid'))
        <x-flash-msg msg="invalid" />
    @elseif (session('update'))
        <x-flash-msg msg="update" />
    @endif

    <div class="w-full flex justify-between items-center gap-5">
        <section class="flex items-start gap-1 text-lg font-bold">
            <h1>Recycle Bin</h1>
            @if ($archives->count() != 0)
                <span class="text-sm">({{ $archives->count() }})</span>
            @endif
        </section>
        <a href="{{ route('inventory.index') }}" class="px-5 py-2 rounded bg-black hover:bg-black/80 text-white">
            <div class="w-auto h-auto flex items-center gap-2">
                <span class="pajamas--go-back w-4 h-4"></span>
                <p class="text-nowrap">Back</p>
            </div>
        </a>
    </div>

    <table class="w-full border border-gray-300 text-left mt-5">
        <thead>
            <tr class="*:px-6 *:py-3 *:text-left *:text-sm *:font-semibold *:bg-gray-500 *:text-white *:text-nowrap">
                <th>#</th>
                <th>Product Image</th>
                <th>Product Name</th>
                <th>Category</th>
                <th>Stock</th>
                <th>Original Price</th>
                <th>Selling Price</th>
                <th class="flex items-center justify-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($archives as $index => $product)
                <tr class="border hover:bg-gray-100 bg-white *:px-6 *:py-4 *:text-nowrap">
                    <td>{{ $index + 1 }}</td>
                    <td>
                        @if ($product->image)
                            <img class="w-28 h-auto cursor-pointer hover:scale-105 transition duration-200 ease-in"
                                src="{{ asset('storage/' . $product->image) }}"
                                onclick="openImageModal('{{ asset('storage/' . $product->image) }}')">
                        @else
                            <img class="w-28 h-auto cursor-pointer hover:scale-105 transition duration-200 ease-in"
                                src="{{ asset('storage/product_images/no_image.jpeg') }}"
                                onclick="openImageModal('{{ asset('storage/product_images/no_image.jpeg') }}')">
                        @endif
                    </td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category->name ?? 'N/A' }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>₱{{ number_format($product->original_price, 2) }}</td>
                    <td>₱{{ number_format($product->selling_price, 2) }}</td>
                    <td class="m-auto">
                        <div class="flex items-center justify-center gap-2">
                            <div class="relative group">
                                <form action="{{ route('bin.restore', $product->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button
                                        class="px-2 py-1 bg-green-500 hover:bg-green-600 text-white rounded flex items-center justify-center gap-1"
                                        type="submit">
                                        <span class="tabler--restore w-4 h-4"></span>
                                        <span
                                            class="text-green-500 absolute -top-6 opacity-0 group-hover:opacity-100 animate-transition text-sm font-semibold ">
                                            Restore
                                        </span>
                                    </button>
                                </form>
                            </div>

                            <div class="relative group">
                                <button
                                    class="px-2 py-1 bg-red-500 hover:bg-red-600 text-white rounded flex items-center justify-center gap-1"
                                    onclick="openDeleteModal({{ $product->id }}, '{{ $product->name }}')">
                                    <span class="material-symbols--delete w-4 h-4"></span>
                                    <span
                                        class="text-red-500 absolute -top-6 opacity-0 group-hover:opacity-100 animate-transition text-sm font-semibold ">
                                        Delete
                                    </span>
                                </button>
                            </div>
                        </div>
                    </td>
                </tr>
            @empty
                <tr class="bg-white">
                    <td colspan="8" class="text-center p-3 text-gray-500 text-sm font-medium">Nothing to see here.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- delete modal --}}
    <div id="deleteProductModal"
        class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden">
        <div class="bg-white rounded-lg shadow-lg p-6 flex flex-col items-center justify-center gap-4 w-1/3">
            <div class="w-full h-auto text-red-500 px-5 flex flex-col items-center justify-center">
                <span class="material-symbols--delete w-16 h-16"></span>
                <p class="text-gray-700 text-center text-lg">Are you sure you want to permanently delete "<span
                        id="delete_product_name" class="font-semibold"></span>" ?</p>
            </div>

            <p class="text-gray-500 text-sm">This action can't be undone.
            </p>
            <div class="flex mt-2 items-center gap-3">
                <button type="button" onclick="closeDeleteModal()"
                    class="px-6 py-2 text-black rounded border border-gray-300 hover:border-black">
                    Cancel
                </button>
                <form id="deleteProductForm" action="" method="POST">
                    @csrf
                    @method('PATCH')
                    <button type="submit"
                        class="px-6 py-2 bg-red-500 text-white rounded hover:bg-red-600 font-semibold">
                        Confirm
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- image preview --}}
    <div id="imagePreviewModal" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden">
        <div class="relative bg-white p-4 rounded shadow-lg">
            <div class="w-full flex justify-end">
                <button type="button" onclick="closeImageModal()" class="w-fit text-gray-500 hover:text-red-500">
                    <span class="carbon--close-filled w-7 h-7"></span>
                </button>
            </div>
            <img id="modalImage" class="w-auto h-auto max-w-[80vw] max-h-[80vh]" src="" alt="Product Image">
        </div>
    </div>

    <script>
        function openImageModal(imageSrc) {
            document.getElementById('modalImage').src = imageSrc;
            document.getElementById('imagePreviewModal').classList.remove('hidden');
        }

        function closeImageModal() {
            document.getElementById('imagePreviewModal').classList.add('hidden');
        }

        function openDeleteModal(id, name) {
            document.getElementById('delete_product_name').textContent = name;

            // Set form action dynamically
            let deleteUrl = "{{ route('bin.forceDelete', ':id') }}".replace(':id', id);
            document.getElementById('deleteProductForm').action = deleteUrl;

            document.getElementById('deleteProductModal').classList.remove('hidden');
        }

        function closeDeleteModal() {
            document.getElementById('deleteProductModal').classList.add('hidden');
        }
    </script>
</x-main-layout>
