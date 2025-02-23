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
            <h1>Products</h1>
            @if ($totalProducts != 0)
                <span class="text-sm">({{ $totalProducts }})</span>
            @endif
        </section>
        <section class="flex items-center gap-2">
            <button onclick="openAddProductModal()" class="px-5 py-2 rounded bg-black hover:bg-black/80 text-white">
                <div class="w-auto h-auto flex items-center gap-2">
                    <span class="ic--round-plus w-5 h-5"></span>
                    <p class="text-nowrap">New Product</p>
                </div>
            </button>
            <a href="{{ route('bin.index') }}" class="px-5 py-2 rounded bg-orange-500 hover:bg-orange-600 text-white">
                <div class="w-auto h-auto flex items-center gap-2">
                    <section class="flex items-start gap-1">
                        <h1>Bin</h1>
                        @if ($bins->count() != 0)
                            <span class="text-sm">({{ $bins->count() }})</span>
                        @endif
                    </section>
                    <span class="material-symbols--delete w-5 h-5"></span>
                </div>
            </a>
        </section>
    </div>

    <table class="w-full border-collapse border border-gray-300 mt-5 shadow-lg rounded overflow-hidden">
        <thead>
            <tr class="*:px-6 *:py-3 *:text-left *:text-sm *:font-semibold *:bg-gray-700 *:text-white *:text-nowrap">
                <th>#</th>
                <th>Product Image</th>
                <th>Product Name</th>
                <th>Category</th>
                <th>Stock</th>
                <th>Original Price</th>
                <th>Selling Price</th>
                {{-- <th>Date Added</th> --}}
                <th class="flex items-center justify-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $index => $product)
                <tr class="border hover:bg-gray-50 bg-white *:px-6 *:py-4 *:text-nowrap">
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
                    <td>{{ $product->category->type }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>₱{{ number_format($product->original_price, 2) }}</td>
                    <td>₱{{ number_format($product->selling_price, 2) }}</td>
                    {{-- <td>{{ $product->created_at->format('M. d, Y | h:i A') }}</td> --}}
                    <td class="m-auto">
                        <div class="flex items-center justify-center gap-2">
                            <div class="relative group">
                                <button
                                    class="px-2 py-1 bg-blue-500 hover:bg-blue-600 text-white rounded flex items-center justify-center gap-1"
                                    onclick="openEditProductModal({{ $product->id }}, '{{ $product->name }}', '{{ asset('storage/' . $product->image) }}', '{{ $product->category->id }}', '{{ $product->stock }}', '{{ $product->original_price }}', '{{ $product->selling_price }}')">
                                    <span class="ri--edit-fill w-4 h-4"></span>
                                    <span
                                        class="text-blue-500 absolute -top-6 opacity-0 group-hover:opacity-100 animate-transition text-sm font-semibold ">
                                        Edit
                                    </span>
                                </button>
                            </div>

                            <div class="relative group">
                                <button
                                    class="px-2 py-1 bg-orange-500 hover:bg-orange-600 text-white rounded flex items-center justify-center gap-1"
                                    onclick="openDeleteModal({{ $product->id }}, '{{ $product->name }}')">
                                    <span class="material-symbols--delete w-4 h-4"></span>
                                    <span
                                        class="text-orange-500 absolute -top-6 opacity-0 group-hover:opacity-100 animate-transition text-sm font-semibold ">
                                        Bin
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

    <div class="mt-5">
        {{ $products->links() }}
    </div>

    {{-- Image Scale Preview --}}
    <div id="imagePreviewModal"
        class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden z-20">
        <div class="relative bg-white p-4 rounded shadow-lg">
            <div class="w-full flex justify-end">
                <button type="button" onclick="closeImageModal()" class="w-fit text-gray-500 hover:text-red-500">
                    <span class="carbon--close-filled w-7 h-7"></span>
                </button>
            </div>
            <img id="modalImage" class="w-auto h-auto max-w-[80vw] max-h-[80vh]" src="" alt="Product Image">
        </div>
    </div>

    {{-- Add Product Modal --}}
    <div id="addProductModal"
        class="fixed inset-0 flex justify-center items-center overflow-auto bg-gray-900 bg-opacity-50 hidden z-20">
        <form action="{{ route('inventory.store') }}" method="POST"
            class="bg-white rounded-lg shadow-lg p-6 w-1/3 h-[500px] overflow-auto" enctype="multipart/form-data">
            @csrf
            <h2 class="text-xl font-bold text-black">New Product</h2>

            <div class="mt-3">
                <div class="flex flex-col gap-5">

                    <div class="flex gap-4 w-full">
                        <section class="flex flex-col gap-1 w-full">
                            <label class="font-medium" for="product_name">Product Name</label>
                            <input @class([
                                'w-full border px-3 py-2',
                                'border-red-500' => $errors->has('product_name'),
                            ]) type="text" name="product_name" id="product_name"
                                value="{{ old('product_name') }}">
                            @error('product_name')
                                <p class="text-red-500 font-semibold tracking-wider text-sm select-none">
                                    {{ $message }}
                                </p>
                            @enderror
                        </section>

                        <section class="flex flex-col gap-1 w-full">
                            <label class="font-medium" for="product_category">Product Category</label>
                            <select @class([
                                'w-full border px-3 py-2',
                                'border-red-500' => $errors->has('product_category'),
                            ]) name="product_category" id="product_category">
                                <option value="{{ old('product_category') }}" disabled selected>Select</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->type }}</option>
                                @endforeach
                            </select>
                            @error('product_category')
                                <p class="text-red-500 font-semibold tracking-wider text-sm select-none">
                                    {{ $message }}
                                </p>
                            @enderror
                        </section>
                    </div>

                    <section class="flex flex-col gap-1 w-full">
                        <label class="font-medium" for="product_image">Product Image</label>
                        <input @class([
                            'w-full border px-3 py-2',
                            'border-red-500' => $errors->has('product_image'),
                        ]) type="file" name="product_image" id="product_image"
                            accept="image/*" value="{{ old('product_image') }}" onchange="previewImage(event)">
                        @error('product_image')
                            <p class="text-red-500 font-semibold tracking-wider text-sm select-none">{{ $message }}
                            </p>
                        @enderror
                        <img id="imagePreview" class="w-32 h-auto hidden border border-gray-300" alt="Product Preview">
                    </section>

                    <section class="flex flex-col gap-1">
                        <label class="font-medium" for="product_stock">Stock</label>
                        <input @class([
                            'w-full border px-3 py-2',
                            'border-red-500' => $errors->has('product_stock'),
                        ]) type="number" name="product_stock" id="product_stock"
                            value="{{ old('product_stock') }}">
                        @error('product_stock')
                            <p class="text-red-500 font-semibold tracking-wider text-sm select-none">{{ $message }}
                            </p>
                        @enderror
                    </section>

                    <section class="flex flex-col gap-1">
                        <label class="font-medium" for="product_original_price">Original Price</label>
                        <input @class([
                            'w-full border px-3 py-2',
                            'border-red-500' => $errors->has('product_original_price'),
                        ]) type="text" name="product_original_price"
                            id="product_original_price" value="{{ old('product_original_price') }}">
                        @error('product_original_price')
                            <p class="text-red-500 font-semibold tracking-wider text-sm select-none">{{ $message }}
                            </p>
                        @enderror
                    </section>

                    <section class="flex flex-col gap-1">
                        <label class="font-medium" for="product_selling_price">Selling Price</label>
                        <input @class([
                            'w-full border px-3 py-2',
                            'border-red-500' => $errors->has('product_selling_price'),
                        ]) type="text" name="product_selling_price"
                            id="product_selling_price" value="{{ old('product_selling_price') }}">
                        @error('product_selling_price')
                            <p class="text-red-500 font-semibold tracking-wider text-sm select-none">{{ $message }}
                            </p>
                        @enderror
                    </section>
                </div>
            </div>

            <div class="flex justify-end mt-7 space-x-3">
                <button type="button" onclick="closeAddProductModal()"
                    class="px-8 py-2 text-black rounded border border-gray-300 hover:border-black">
                    Cancel
                </button>
                <button type="submit" class="px-8 py-2 bg-black text-white rounded hover:bg-black/80 font-semibold">
                    Add
                </button>
            </div>
        </form>
    </div>

    {{-- Edit Product Modal --}}
    <div id="editProductModal"
        class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 z-20 hidden">
        <form id="editProductForm" action="" method="POST" enctype="multipart/form-data"
            class="bg-white rounded-lg shadow-lg p-6 w-1/3 h-[500px] overflow-auto overflow-auto">
            @csrf
            @method('PUT')

            <h2 class="text-xl font-bold text-black">Edit Product</h2>
            <input type="hidden" name="id" id="edit_product_id">

            <div class="mt-3 flex flex-col gap-5">
                <div class="flex gap-4 w-full">
                    <!-- Product Name -->
                    <section class="flex flex-col gap-1 w-full">
                        <label class="font-medium" for="edit_product_name">Product Name</label>
                        <input @class([
                            'w-full border px-3 py-2',
                            'border-red-500' => $errors->has('product_name'),
                        ]) type="text" name="product_name"
                            id="edit_product_name">
                        @error('product_name')
                            <p class="text-red-500 font-semibold tracking-wider text-sm select-none">
                                {{ $message }}
                            </p>
                        @enderror
                    </section>

                    <!-- Product Category -->
                    <section class="flex flex-col gap-1 w-full">
                        <label class="font-medium" for="edit_product_category">Product Category</label>
                        <select @class([
                            'w-full border px-3 py-2',
                            'border-red-500' => $errors->has('product_category'),
                        ]) name="product_category" id="edit_product_category">
                            <option disabled>Select</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->type }}</option>
                            @endforeach
                        </select>
                        @error('product_category')
                            <p class="text-red-500 font-semibold tracking-wider text-sm select-none">
                                {{ $message }}
                            </p>
                        @enderror
                    </section>
                </div>

                <!-- Product Image Upload -->
                <section class="flex flex-col gap-1 w-full">
                    <label class="font-medium" for="edit_product_image">Product Image</label>
                    <input @class([
                        'w-full border px-3 py-2',
                        'border-red-500' => $errors->has('product_image'),
                    ]) type="file" name="product_image" id="edit_product_image"
                        onchange="previewEditImage(event)">
                    @error('product_image')
                        <p class="text-red-500 font-semibold tracking-wider text-sm select-none">
                            {{ $message }}
                        </p>
                    @enderror
                    <img id="editImagePreview" class="w-32 h-auto mt-2 hidden" alt="no image">
                </section>

                <!-- Stock -->
                <section class="flex flex-col gap-1">
                    <label for="edit_product_stock">Stock</label>
                    <input @class([
                        'w-full border px-3 py-2',
                        'border-red-500' => $errors->has('product_stock'),
                    ]) type="number" name="product_stock" id="edit_product_stock">
                    @error('product_stock')
                        <p class="text-red-500 font-semibold tracking-wider text-sm select-none">
                            {{ $message }}
                        </p>
                    @enderror
                </section>

                <!-- Original Price -->
                <section class="flex flex-col gap-1">
                    <label for="edit_product_original_price">Original Price</label>
                    <input @class([
                        'w-full border px-3 py-2',
                        'border-red-500' => $errors->has('product_original_price'),
                    ]) type="text" name="product_original_price"
                        id="edit_product_original_price">
                    @error('product_original_price')
                        <p class="text-red-500 font-semibold tracking-wider text-sm select-none">
                            {{ $message }}
                        </p>
                    @enderror
                </section>

                <!-- Selling Price -->
                <section class="flex flex-col gap-1">
                    <label for="edit_product_selling_price">Selling Price</label>
                    <input @class([
                        'w-full border px-3 py-2',
                        'border-red-500' => $errors->has('product_selling_price'),
                    ]) type="text" name="product_selling_price"
                        id="edit_product_selling_price">
                    @error('product_selling_price')
                        <p class="text-red-500 font-semibold tracking-wider text-sm select-none">
                            {{ $message }}
                        </p>
                    @enderror
                </section>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-end mt-7 space-x-3">
                <button type="button" onclick="closeEditProductModal()"
                    class="px-8 py-2 text-black rounded border border-gray-300 hover:border-black">
                    Cancel
                </button>
                <button type="submit"
                    class="px-8 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 font-semibold">
                    Update
                </button>
            </div>
        </form>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteProductModal"
        class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 z-20 hidden">
        <div class="bg-white rounded-lg shadow-lg p-6 flex flex-col items-center justify-center gap-4 w-1/3">
            <div class="w-full h-auto text-orange-500 px-5 flex flex-col items-center justify-center">
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
                    class="px-6 py-2 text-black rounded border border-gray-300 hover:border-black">
                    Cancel
                </button>
                <form id="deleteProductForm" action="" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="px-6 py-2 bg-orange-500 text-white rounded hover:bg-orange-600 font-semibold">
                        Confirm
                    </button>
                </form>
            </div>
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

        function openAddProductModal() {
            document.getElementById('addProductModal').classList.remove('hidden');
        }

        function previewImage(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('imagePreview');

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            }
        }

        function closeAddProductModal() {
            const modal = document.getElementById('addProductModal');
            modal.classList.add('hidden');

            // Reset the specific form inside the modal
            modal.querySelector('form').reset();

            // Hide the image preview
            document.getElementById('imagePreview').classList.add('hidden');
        }

        function openEditProductModal(id, name, image, categoryId, stock, original_price, selling_price) {
            document.getElementById('edit_product_id').value = id;
            document.getElementById('edit_product_name').value = name;
            document.getElementById('edit_product_stock').value = stock;
            document.getElementById('edit_product_original_price').value = original_price;
            document.getElementById('edit_product_selling_price').value = selling_price;

            // Set category selection
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

            // Show existing image preview
            const imagePreview = document.getElementById('editImagePreview');
            if (image) {
                imagePreview.src = image;
                imagePreview.classList.remove('hidden');
            } else {
                imagePreview.classList.add('hidden');
            }

            // Show modal
            document.getElementById('editProductModal').classList.remove('hidden');
        }

        function previewEditImage(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('editImagePreview');

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            }
        }

        function closeEditProductModal() {
            document.getElementById('editProductModal').classList.add('hidden');
            document.querySelector('#editProductForm').reset();
            document.getElementById('editImagePreview').classList.add('hidden');
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

        // Restore the image preview after page reload
        window.onload = function() {
            @if ($errors->any())
                @if (old('id')) // Check if editing was in progress
                    openEditProductModal(
                        "{{ old('id') }}",
                        "{{ old('product_name') }}",
                        "{{ old('product_image') }}",
                        "{{ old('product_category') }}",
                        "{{ old('product_stock') }}",
                        "{{ old('product_original_price') }}",
                        "{{ old('product_selling_price') }}"
                    );
                @else
                    openAddProductModal();
                @endif
            @endif
        };
    </script>
</x-main-layout>
