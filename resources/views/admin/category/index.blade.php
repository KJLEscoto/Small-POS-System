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
            <h1>Categories</h1>
            @if ($totalCategories != 0)
                <span class="text-sm">({{ $totalCategories }})</span>
            @endif
        </section>
        <section class="flex items-center gap-2">
            <button onclick="openAddCategoryModal()" class="px-5 py-2 rounded bg-black hover:bg-black/80 text-white">
                <div class="w-auto h-auto flex items-center gap-2">
                    <span class="ic--round-plus w-5 h-5"></span>
                    <p class="text-nowrap">New Category</p>
                </div>
            </button>
        </section>
    </div>

    <table class="w-full border-collapse table-auto border border-gray-300 mt-5 shadow-lg rounded overflow-x-auto">
        <thead>
            <tr class="*:px-6 *:py-3 *:text-left *:text-sm *:font-semibold *:bg-gray-700 *:text-white *:text-nowrap">
                <th>#</th>
                <th>Type</th>
                <th>Description</th>
                <th>Total Products</th>
                <th class="flex items-center justify-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($categories as $index => $category)
                <tr class="border hover:bg-gray-50 bg-white *:px-6 *:py-4 *:text-nowrap">
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $category->type }}</td>
                    <td class="!text-wrap !w-[500px]">
                        @if ($category->description)
                            <p>{{ $category->description }}</p>
                        @else
                            <p>—</p>
                        @endif
                    </td>
                    <td>{{ $category->products->count() }}</td>
                    <td class="m-auto">
                        <div class="flex items-center justify-center gap-2">
                            <div class="relative group">
                                <button
                                    class="px-2 py-1 bg-green-500 hover:bg-green-600 text-white rounded flex items-center justify-center gap-1"
                                    data-id="{{ $category->id }}" data-type="{{ $category->type }}"
                                    data-description="{{ $category->description }}"
                                    data-products="{{ $category->products->pluck('name')->implode(',') }}"
                                    data-products-count="{{ $category->products->count() }}"
                                    data-created-at="{{ $category->created_at->format('M. d, Y | h:i A') }}"
                                    onclick="openViewCategoryModal(this)">
                                    <span class="mingcute--eye-fill w-4 h-4"></span>
                                    <span
                                        class="text-green-500 absolute -top-6 opacity-0 group-hover:opacity-100 animate-transition text-sm font-semibold">
                                        View
                                    </span>
                                </button>
                            </div>

                            <div class="relative group">
                                <button
                                    class="px-2 py-1 bg-blue-500 hover:bg-blue-600 text-white rounded flex items-center justify-center gap-1"
                                    data-id="{{ $category->id }}" data-type="{{ $category->type }}"
                                    data-description="{{ $category->description ?? '' }}"
                                    onclick="openEditCategoryModal(this)">
                                    <span class="ri--edit-fill w-4 h-4"></span>
                                    <span
                                        class="text-blue-500 absolute -top-6 opacity-0 group-hover:opacity-100 animate-transition text-sm font-semibold">
                                        Edit
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
        {{ $categories->links() }}
    </div>

    {{-- add category modal --}}
    <div id="addCategoryModal"
        class="fixed inset-0 flex justify-center items-center overflow-auto bg-gray-900 bg-opacity-50 hidden z-20">
        <form action="{{ route('category.store') }}" method="POST"
            class="bg-white rounded-lg shadow-lg p-6 w-1/3 h-auto overflow-auto">
            @csrf
            <h2 class="text-xl font-bold text-black">New Category</h2>

            <div class="mt-3">
                <div class="flex flex-col gap-5">

                    <section class="flex flex-col gap-1 w-full">
                        <label class="font-medium" for="category_type">Type</label>
                        <input @class([
                            'w-full border px-3 py-2',
                            'border-red-500' => $errors->has('category_type'),
                        ]) type="text" name="category_type" id="category_type"
                            value="{{ old('category_type') }}">
                        @error('category_type')
                            <p class="text-red-500 font-semibold tracking-wider text-sm select-none">
                                {{ $message }}
                            </p>
                        @enderror
                    </section>

                    <section class="flex flex-col gap-1 w-full">
                        <label class="font-medium" for="category_description">Description (opt.)</label>
                        <input @class([
                            'w-full border px-3 py-2',
                            'border-red-500' => $errors->has('category_description'),
                        ]) type="text" name="category_description"
                            id="category_description" value="{{ old('category_description') }}">
                        @error('category_description')
                            <p class="text-red-500 font-semibold tracking-wider text-sm select-none">
                                {{ $message }}
                            </p>
                        @enderror
                    </section>
                </div>
            </div>

            <div class="flex justify-end mt-7 space-x-3">
                <button type="button" onclick="closeAddCategoryModal()"
                    class="px-8 py-2 text-black rounded border border-gray-300 hover:border-black">
                    Cancel
                </button>
                <button type="submit" class="px-8 py-2 bg-black text-white rounded hover:bg-black/80 font-semibold">
                    Add
                </button>
            </div>
        </form>
    </div>

    {{-- view category --}}
    <div id="viewCategoryModal"
        class="fixed inset-0 flex justify-center items-center overflow-auto bg-gray-900 bg-opacity-50 hidden z-20">
        <div class="bg-white rounded-lg shadow-lg p-6 w-1/3 h-auto overflow-auto flex flex-col gap-5">

            <section class="flex flex-col">
                <h1 id="view_category_type" class="text-black text-lg font-semibold"></h1>
                <p id="view_category_description" class="text-gray-700"></p>
            </section>

            <div class="flex flex-col gap-2">
                <p class="font-medium">Associated Products (<span id="view_products_count"></span>)</p>
                <div>
                    <ul id="view_category_product"
                        class="list-decimal list-inside text-gray-700 h-32 overflow-auto border border-gray-200 px-4 py-2">
                    </ul>
                </div>
            </div>

            <div class="flex flex-col">
                <p class="font-medium">Date Added</p>
                <span id="view_category_date" class="text-gray-700"></span>
            </div>

            <div class="flex justify-end gap-3 mt-3">
                <button type="button" onclick="closeViewCategoryModal()"
                    class="px-6 py-2 text-black rounded border border-gray-300 hover:border-black">
                    Close
                </button>
                <button id="editCategoryFromView" class="px-6 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded"
                    onclick="openEditCategoryModalFromView()">
                    Edit
                </button>
            </div>
        </div>
    </div>

    {{-- edit category --}}
    <div id="editCategoryModal"
        class="fixed inset-0 flex justify-center items-center overflow-auto bg-gray-900 bg-opacity-50 hidden z-20">
        <form id="editCategoryForm" action="" method="POST"
            class="bg-white rounded-lg shadow-lg p-6 w-1/3 h-auto overflow-auto">
            @csrf
            @method('PUT')

            <h2 class="text-xl font-bold text-black">Edit Category</h2>
            <input type="hidden" name="id" id="open_edit_category">

            <div class="mt-3">
                <div class="flex flex-col gap-5">

                    <section class="flex flex-col gap-1 w-full">
                        <label class="font-medium" for="edit_category_type">Type</label>
                        <input @class([
                            'w-full border px-3 py-2',
                            'border-red-500' => $errors->has('category_type'),
                        ]) type="text" name="category_type" value=""
                            id="edit_category_type">
                        @error('category_type')
                            <p class="text-red-500 font-semibold tracking-wider text-sm select-none">
                                {{ $message }}
                            </p>
                        @enderror
                    </section>

                    <section class="flex flex-col gap-1 w-full">
                        <label class="font-medium" for="edit_category_description">Description (opt.)</label>
                        <input @class([
                            'w-full border px-3 py-2',
                            'border-red-500' => $errors->has('category_description'),
                        ]) type="text" name="category_description" value=""
                            id="edit_category_description">
                        @error('category_description')
                            <p class="text-red-500 font-semibold tracking-wider text-sm select-none">
                                {{ $message }}
                            </p>
                        @enderror
                    </section>
                </div>
            </div>

            <div class="flex justify-end mt-7 space-x-3">
                <button type="button" onclick="closeEditCategoryModal()"
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

    <script>
        function openAddCategoryModal() {
            document.getElementById('addCategoryModal').classList.remove('hidden');
        }

        function closeAddCategoryModal() {
            const modal = document.getElementById('addCategoryModal');
            modal.classList.add('hidden');

            modal.querySelector('form').reset();
        }

        // Open View Category Modal
        function openViewCategoryModal(button) {
            let id = button.getAttribute('data-id');
            let type = button.getAttribute('data-type') || 'N/A';
            let description = button.getAttribute('data-description');
            let productsString = button.getAttribute('data-products') || '';
            let productsCount = button.getAttribute('data-products-count') || 0;
            let dateAdded = button.getAttribute('data-created-at') || 'Unknown Date';

            document.getElementById('viewCategoryModal').classList.remove('hidden');

            document.getElementById('view_category_type').textContent = type;
            document.getElementById('view_category_description').textContent = description || 'No description available.';
            document.getElementById('view_category_date').textContent = dateAdded;
            document.getElementById('view_products_count').textContent = productsCount;

            let productList = document.getElementById('view_category_product');
            productList.innerHTML = ''; // Clear previous items
            if (productsString) {
                let products = productsString.split(',');
                products.forEach(product => {
                    let li = document.createElement('li');
                    li.textContent = product.trim();
                    productList.appendChild(li);
                });
            } else {
                productList.innerHTML = 'No associated products.';
            }

            // Store category data in the edit button inside view modal
            let editButton = document.getElementById('editCategoryFromView');
            editButton.setAttribute('data-id', id);
            editButton.setAttribute('data-type', type);

            if (description) {
                editButton.setAttribute('data-description', description);
            } else {
                editButton.removeAttribute('data-description');
            }
        }

        // Open Edit Category Modal from View Modal
        function openEditCategoryModalFromView() {
            let editButton = document.getElementById('editCategoryFromView');
            openEditCategoryModal(editButton);
        }

        // Close View Category Modal
        function closeViewCategoryModal() {
            document.getElementById('viewCategoryModal').classList.add('hidden');

            document.getElementById('view_category_product').innerHTML = '';
        }

        // Open Edit Category Modal
        function openEditCategoryModal(button) {
            let id = button.getAttribute('data-id');
            let type = button.getAttribute('data-type') || '';
            let description = button.getAttribute('data-description') || '';

            document.getElementById('editCategoryModal').classList.remove('hidden');

            document.getElementById('edit_category_type').value = type;
            document.getElementById('edit_category_description').value = description;

            let updateUrl = "{{ route('category.update', ':id') }}".replace(':id', id);
            document.getElementById('editCategoryForm').action = updateUrl;
        }

        // Close Edit Category Modal
        function closeEditCategoryModal() {
            document.getElementById('editCategoryModal').classList.add('hidden');

            document.getElementById('editCategoryForm').reset();
        }
    </script>
</x-main-layout>


{{-- 
-Food & Snacks
Instant noodles
Biscuits & crackers
Chips & junk food
Candies & chocolates
Bread & pastries

-Beverages
Soft drinks
Bottled water
Coffee & tea
Juice drinks
Powdered milk & chocolate drinks

-Canned & Packaged Goods
Canned sardines & tuna
Canned meat (corned beef, luncheon meat)
Canned vegetables & beans
Condiments (soy sauce, vinegar, ketchup)
Cooking oil

-Rice & Grains
Rice
Corn grits
Instant porridge (lugaw, champorado)

-Frozen & Fresh Products
Hotdogs & longganisa
Eggs
Ice & ice candies

-Personal Care & Hygiene
Bath soap & body wash
Shampoo & conditioner (sachets)
Toothpaste & toothbrush
Deodorant
Feminine hygiene products

-Household Essentials
Laundry detergent & fabric conditioner
Dishwashing liquid & paste
Cleaning products (bleach, disinfectant)
Candles & matches
Mosquito coils

-Baby & Child Care
Baby powder
Baby soap & shampoo
Diapers
Baby milk formula

-School & Office Supplies
Ballpens & pencils
Notebooks & paper
Erasers & sharpeners
Glue & scissors

-Electronics & Accessories
Phone load & SIM cards
Earphones
Flashlights & batteries

-Miscellaneous Items
Plastic bags & eco bags
Cigarettes (if allowed)
Small toys & trinkets
Umbrellas & raincoats
--}}
