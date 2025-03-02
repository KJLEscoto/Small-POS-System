<x-main-layout>
    <main class="grid grid-cols-12 w-full h-auto">
        <section class="col-span-9 w-full h-full">
            <nav
                class="sticky top-0 left-0 w-full px-10 py-5 bg-white shadow flex items-center justify-between overflow-auto">
                <div class="w-1/2 relative flex items-center">
                    <span class="meteor-icons--search w-5 h-5 absolute left-3 text-gray-500"></span>
                    <input type="text" name="search" id="search"
                        class="pl-10 py-2 pr-4 rounded border border-gray-300 w-full outline-none focus:ring-2 focus:ring-gray-700"
                        placeholder="Search...">
                </div>
                <div class="flex items-center gap-3">
                    <img class="w-10 h-10 rounded-full shadow"
                        src="{{ asset('storage/user_images/default-user.jpg') }}">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="text-red-600 hover:underline">Logout</button>
                    </form>
                </div>
            </nav>

            <div class="h-[calc(100vh-5.2rem)] px-10 py-5 overflow-auto">
                <div class="grid grid-cols-5 gap-3">
                    @foreach ($products as $product)
                        <section
                            class="product-card border-2 border-transparent hover:border-gray-500 w-full h-auto hover:scale-105 transition cursor-pointer hover:shadow-lg rounded-md overflow-hidden"
                            data-name="{{ $product->name }}" data-category="{{ $product->category->type }}"
                            data-price="{{ $product->selling_price }}">
                            <div class="w-auto h-40 overflow-hidden relative">
                                <img class="w-full h-full object-cover"
                                    src="{{ asset($product->image ? 'storage/' . $product->image : 'storage/user_images/default-user.jpg') }}">
                                <p
                                    class="text-[10px] font-medium rounded absolute bottom-2 left-2 px-2 py-1 text-white bg-gray-700 shadow border">
                                    Stock: {{ $product->stock }}</p>
                            </div>
                            <div class="bg-white w-full text-center p-2">
                                <h1 class="font-medium truncate">{{ $product->name }}</h1>
                                <p class="text-[10px] truncate">{{ $product->category->type }}</p>
                            </div>
                        </section>
                    @endforeach
                </div>
            </div>
        </section>

        <section
            class="col-span-3 w-full h-[100vh] bg-white flex flex-col justify-between sticky top-0 p-5 gap-5 overflow-auto">
            <x-sidebar-logo />
            <div id="order-list" class="h-full border overflow-auto w-full bg-white divide-y divide-gray-300"></div>
            <div class="w-full text-left font-bold">
                <p id="total-price">Total: ₱0.00</p>
            </div>
            <div class="w-full flex gap-3 items-center">
                <button type="button" id="clear"
                    class="bg-red-700 hover:bg-red-700/90 text-white w-full py-2 px-5 rounded">Clear</button>
                <button type="button" id="openPlaceOrderModal"
                    class="bg-gray-700 hover:bg-gray-700/90 text-white w-full py-2 px-5 rounded">Place Order</button>
            </div>
        </section>
    </main>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const orderList = document.querySelector("#order-list");
            const clearButton = document.querySelector("#clear");
            const totalPriceElement = document.querySelector("#total-price");

            function updateTotal() {
                let total = [...orderList.querySelectorAll(".sub_total")]
                    .reduce((sum, subTotal) => sum + parseFloat(subTotal.textContent) || 0, 0);
                totalPriceElement.textContent = `Total: ₱${total.toFixed(2)}`;
            }

            document.addEventListener("click", (event) => {
                const productCard = event.target.closest(".product-card");
                if (productCard) {
                    const productName = productCard.dataset.name;
                    const productCategory = productCard.dataset.category;
                    const productPrice = parseFloat(productCard.dataset.price) || 0;
                    let existingItem = [...orderList.children].find(item => item.dataset.name ===
                        productName);

                    if (existingItem) {
                        let quantity = existingItem.querySelector(".quantity");
                        let subTotal = existingItem.querySelector(".sub_total");
                        quantity.textContent = parseInt(quantity.textContent) + 1;
                        subTotal.textContent = (productPrice * parseInt(quantity.textContent)).toFixed(2);
                    } else {
                        orderList.innerHTML += `
                            <section class="grid grid-cols-3 w-full p-4" data-name="${productName}" data-price="${productPrice}">
                                <div class="flex flex-col w-full justify-start items-start truncate">
                                    <h1 class="truncate font-medium w-full">${productName}</h1>
                                    <p class="truncate text-[10px] w-full">${productCategory}</p>
                                </div>
                                <div class="flex w-full justify-end items-center gap-2">
                                    <button class="decrement p-2 bg-red-500 text-white hover:scale-110 transition rounded-full flex items-center justify-center">
                                        <span class="ic--round-minus decrement w-4 h-4"></span>    
                                    </button>
                                    <p class="quantity">1</p>
                                    <button class="increment p-2 bg-blue-500 text-white hover:scale-110 transition rounded-full flex items-center justify-center">
                                        <span class="ic--round-plus increment w-4 h-4"></span>    
                                    </button>
                                </div>
                                <div class="w-full flex items-center justify-end">
                                    <p class="sub_total">${productPrice.toFixed(2)}</p>
                                </div>
                            </section>`;
                    }
                    updateTotal();
                }

                const orderItem = event.target.closest("section");
                if (!orderItem) return;
                let quantity = orderItem.querySelector(".quantity");
                let subTotal = orderItem.querySelector(".sub_total");
                let productPrice = parseFloat(orderItem.dataset.price) || 0;

                if (event.target.classList.contains("increment")) {
                    quantity.textContent = parseInt(quantity.textContent) + 1;
                }
                if (event.target.classList.contains("decrement")) {
                    if (parseInt(quantity.textContent) > 1) {
                        quantity.textContent = parseInt(quantity.textContent) - 1;
                    } else {
                        orderItem.remove();
                    }
                }
                subTotal.textContent = (parseInt(quantity.textContent) * productPrice).toFixed(2);
                updateTotal();
            });

            clearButton.addEventListener("click", function() {
                orderList.innerHTML = "";
                updateTotal();
            });
        });
    </script>
</x-main-layout>
