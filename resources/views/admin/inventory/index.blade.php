<x-main-layout>
    @if (session('success'))
        <x-flash-msg msg="success" />
    @elseif (session('invalid'))
        <x-flash-msg msg="invalid" />
    @elseif (session('update'))
        <x-flash-msg msg="update" />
    @endif

    <div class="w-full flex justify-between items-center gap-5">
        <button onclick="openAddProductModal()" class="px-5 py-2 rounded-md bg-black hover:bg-black/80 text-white">
            <div class="w-auto h-auto flex items-center gap-2">
                <span class="ic--round-plus w-6 h-6"></span>
                <p class="text-nowrap">New Product</p>
            </div>
        </button>
        <a href="{{ route('bin.index') }}" class="px-5 py-2 rounded-md bg-red-500 hover:bg-red-600 text-white">
            <div class="w-auto h-auto flex items-center gap-2">
                <span class="material-symbols--delete w-6 h-6"></span>
                <p class="text-nowrap">Bin</p>
            </div>
        </a>
    </div>

    {{-- Products Table --}}
    <table class="w-full mt-5 border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-200 text-left *:text-nowrap">
                <th class="border border-gray-300 px-4 py-2">#</th>
                <th class="border border-gray-300 px-4 py-2">Product Name</th>
                <th class="border border-gray-300 px-4 py-2">Category</th>
                <th class="border border-gray-300 px-4 py-2">Stock</th>
                <th class="border border-gray-300 px-4 py-2">Original Price</th>
                <th class="border border-gray-300 px-4 py-2">Selling Price</th>
                <th class="border border-gray-300 px-4 py-2 text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $index => $product)
                <tr class="text-left hover:bg-gray-100 bg-white shadow-md *:text-nowrap">
                    <td class="border border-gray-300 px-4 py-2">{{ $index + 1 }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $product->name }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $product->category->name }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $product->stock }}</td>
                    <td class="border border-gray-300 px-4 py-2">₱{{ number_format($product->original_price, 2) }}</td>
                    <td class="border border-gray-300 px-4 py-2">₱{{ number_format($product->selling_price, 2) }}</td>
                    <td class="border border-gray-300 px-4 py-2 flex gap-2 justify-center items-center">
                        <div class="relative group">
                            <button
                                class="px-2 py-1 bg-blue-500 hover:bg-blue-600 text-white rounded flex items-center justify-center gap-1"
                                onclick="openEditProductModal({{ $product->id }}, '{{ $product->name }}', '{{ $product->category->id }}', '{{ $product->stock }}', '{{ $product->original_price }}', '{{ $product->selling_price }}')">
                                <span class="ri--edit-fill w-4 h-4"></span>
                                <span
                                    class="text-black absolute -top-4 opacity-0 group-hover:opacity-100 animate-transition text-[11px] font-semibold ">
                                    Edit
                                </span>
                            </button>
                        </div>

                        <div class="relative group">
                            <button
                                class="px-2 py-1 bg-red-500 hover:bg-red-600 text-white rounded flex items-center justify-center gap-1"
                                onclick="openDeleteModal({{ $product->id }}, '{{ $product->name }}')">
                                <span class="material-symbols--delete w-4 h-4"></span>
                                <span
                                    class="text-black absolute -top-4 opacity-0 group-hover:opacity-100 animate-transition text-[11px] font-semibold ">
                                    Bin
                                </span>
                            </button>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-5">
        {{ $products->links() }}
    </div>

    {{-- Add Product Modal --}}
    <div id="addProductModal" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden">
        <form action="{{ route('inventory.store') }}" method="POST" class="bg-white rounded-lg shadow-lg p-6 w-1/3">
            @csrf
            <h2 class="text-xl font-bold text-black">New Product</h2>

            <div class="mt-3">
                <div class="flex flex-col gap-5">
                    <section class="flex flex-col gap-1">
                        <label for="product_name">Product Name</label>
                        <input class="w-full px-4 py-2 border border-gray-300" type="text" name="product_name"
                            id="product_name" value="{{ old('product_name') }}">
                        @error('product_name')
                            <p class="text-red-500 font-semibold tracking-wider text-sm select-none">{{ $message }}
                            </p>
                        @enderror
                    </section>

                    <section class="flex flex-col gap-1">
                        <label for="product_category">Product Category</label>
                        <select class="w-full px-3 py-2 border border-gray-300" name="product_category"
                            id="product_category">
                            <option value="{{ old('product_category') }}" disabled selected>Select</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </section>

                    <section class="flex flex-col gap-1">
                        <label for="product_stock">Stock</label>
                        <input class="w-full px-4 py-2 border border-gray-300" type="number" name="product_stock"
                            id="product_stock" value="{{ old('product_stock') }}">
                    </section>

                    <section class="flex flex-col gap-1">
                        <label for="product_original_price">Original Price</label>
                        <input class="w-full px-4 py-2 border border-gray-300" type="text"
                            name="product_original_price" id="product_original_price"
                            value="{{ old('product_original_price') }}">
                        @error('product_original_price')
                            <p class="text-red-500 font-semibold tracking-wider text-sm select-none">{{ $message }}
                            </p>
                        @enderror
                    </section>

                    <section class="flex flex-col gap-1">
                        <label for="product_selling_price">Selling Price</label>
                        <input class="w-full px-4 py-2 border border-gray-300" type="text"
                            name="product_selling_price" id="product_selling_price"
                            value="{{ old('product_selling_price') }}">
                        @error('product_selling_price')
                            <p class="text-red-500 font-semibold tracking-wider text-sm select-none">{{ $message }}
                            </p>
                        @enderror
                    </section>
                </div>
            </div>

            <div class="flex justify-end mt-7 space-x-3">
                <button type="button" onclick="closeAddProductModal()"
                    class="px-8 py-2 text-black rounded-md border border-gray-300 hover:border-black">
                    Cancel
                </button>
                <button type="submit" class="px-8 py-2 bg-black text-white rounded-md hover:bg-black/80 font-semibold">
                    Add
                </button>
            </div>
        </form>
    </div>

    {{-- Edit Product Modal --}}
    <div id="editProductModal" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden">
        <form id="editProductForm" action="" method="POST"
            class="bg-white rounded-lg shadow-lg p-6 w-1/3 overflow-auto">
            @csrf
            @method('PUT')
            <h2 class="text-xl font-bold text-black">Edit Product</h2>

            <input type="hidden" name="id" id="edit_product_id">

            <div class="mt-3 flex flex-col gap-5">
                <section class="flex flex-col gap-1">
                    <label for="edit_product_name">Product Name</label>
                    <input class="w-full px-4 py-2 border border-gray-300" type="text" name="product_name"
                        id="edit_product_name">
                </section>

                <section class="flex flex-col gap-1">
                    <label for="edit_product_category">Product Category</label>
                    <select class="w-full px-3 py-2 border border-gray-300" name="product_category"
                        id="edit_product_category">
                        <option value="edit_product_category" disabled selected>Select</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </section>

                <section class="flex flex-col gap-1">
                    <label for="edit_product_stock">Stock</label>
                    <input class="w-full px-4 py-2 border border-gray-300" type="number" name="product_stock"
                        id="edit_product_stock">
                </section>

                <section class="flex flex-col gap-1">
                    <label for="edit_product_original_price">Original Price</label>
                    <input class="w-full px-4 py-2 border border-gray-300" type="text"
                        name="product_original_price" id="edit_product_original_price">
                </section>

                <section class="flex flex-col gap-1">
                    <label for="edit_product_selling_price">Selling Price</label>
                    <input class="w-full px-4 py-2 border border-gray-300" type="text"
                        name="product_selling_price" id="edit_product_selling_price">
                </section>
            </div>

            <div class="flex justify-end mt-7 space-x-3">
                <button type="button" onclick="closeEditProductModal()"
                    class="px-8 py-2 text-black rounded-md border border-gray-300 hover:border-black">
                    Cancel
                </button>
                <button type="submit"
                    class="px-8 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 font-semibold">
                    Update
                </button>
            </div>
        </form>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteProductModal"
        class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden">
        <div class="bg-white rounded-lg shadow-lg p-6 flex flex-col items-center justify-center gap-4 w-1/3">
            <div class="w-full h-auto text-red-500 px-5 flex flex-col items-center justify-center">
                <span class="material-symbols--delete w-16 h-16"></span>
                {{-- <h2 class="text-xl font-bold">Move to Recycle Bin</h2> --}}
                <p class="text-gray-700 text-center text-lg">Are you sure you want to move "<span
                        id="delete_product_name" class="font-semibold"></span>" to the
                    Recycle Bin?</p>
            </div>

            <p class="text-gray-500 text-sm">Don't worry, you can restore them later.
            </p>
            <div class="flex mt-2 items-center gap-3">
                <button type="button" onclick="closeDeleteModal()"
                    class="px-6 py-2 text-black rounded-md border border-gray-300 hover:border-black">
                    Cancel
                </button>
                <form id="deleteProductForm" action="" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="px-6 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 font-semibold">
                        Confirm
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openAddProductModal() {
            document.getElementById('addProductModal').classList.remove('hidden');
        }

        function closeAddProductModal() {
            document.getElementById('addProductModal').classList.add('hidden');
        }

        function openEditProductModal(id, name, categoryId, stock, original_price, selling_price) {
            document.getElementById('edit_product_id').value = id;
            document.getElementById('edit_product_name').value = name;
            document.getElementById('edit_product_stock').value = stock;
            document.getElementById('edit_product_original_price').value = original_price;
            document.getElementById('edit_product_selling_price').value = selling_price;

            // Fix: Ensure the correct category is selected
            let categoryDropdown = document.getElementById('edit_product_category');
            for (let i = 0; i < categoryDropdown.options.length; i++) {
                if (categoryDropdown.options[i].value == categoryId) {
                    categoryDropdown.options[i].selected = true;
                    break;
                }
            }

            // Set form action dynamically
            let updateUrl = "{{ route('inventory.update', ':id') }}".replace(':id', id);
            document.getElementById('editProductForm').action = updateUrl;

            // Show modal
            document.getElementById('editProductModal').classList.remove('hidden');
        }

        function closeEditProductModal() {
            document.getElementById('editProductModal').classList.add('hidden');
        }

        function openDeleteModal(id, name) {
            document.getElementById('delete_product_name').textContent = name;

            // Set form action dynamically
            let deleteUrl = "{{ route('inventory.destroy', ':id') }}".replace(':id', id);
            document.getElementById('deleteProductForm').action = deleteUrl;

            document.getElementById('deleteProductModal').classList.remove('hidden');
        }

        function closeDeleteModal() {
            document.getElementById('deleteProductModal').classList.add('hidden');
        }
    </script>
</x-main-layout>
