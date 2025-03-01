<x-main-layout>
    <div class="overflow-hidden">

@php
$products = \App\Models\Product::get();
$customers = \App\Models\Customer::get();
$cashier_id = Auth::id();
@endphp

<div class="container mx-auto p-4">
    <div class="mt-4 grid grid-cols-3 w-full h-full">
        <label for="userSelect" class="font-bold">Select Customer:</label>
        <div class='p-2 rounded mt-4 px-4 py-2 rounded'>
            <select id="userSelect" class="w-full" onchange="addUser()">
                <option value="">-- Select Customer --</option>
                @foreach ($customers as $customer)
                    <option value="{{ $customer['id'] }}">{{ $customer['first_name'] }}{{ $customer['middle_name'] }}{{ $customer['last_name'] }}</option>
                @endforeach
            </select>
        </div>
        <div class="mt-4 px-4 py-2 bg-blue-500 text-white rounded">
            <button class="w-full" onclick="addCustomUser()">Add New Customer</button>
        </div>
    </div>
</div>

<div class="grid grid-cols-5 gap-4 mt-4 relative h-screen">
    @foreach ($products as $product)
        <div class="h-fit relative border rounded bg-white shadow-lg cursor-pointer" onclick="addToCart({{ $product->id }}, '{{ $product->name }}', {{ $product->selling_price }})">
            <!-- Overlay Divs -->
            <div class="flex-col w-fit relative -left-3 top-4">
                <div class="bg-green-500 text-white border px-3 py-2 w-auto rounded">
                    P {{ $product->selling_price }}
                </div>
            </div>

            <!-- Product Image -->
            <div class="w-full h-48 bg-gray-200 flex items-center justify-center overflow-hidden rounded-lg mt-16">
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
            </div>

            <!-- Product Details -->
            <div class="border-t w-full bg-red-500 py-4 rounded-b">
                <p class="font-semibold text-lg text-center text-white">{{ $product->name }}</p>
            </div>
        </div>
        @endforeach
        <!-- Multiple User Carts -->
        <div>
            <div class="relative draggable mt-4 gap-4" id="cart-container"></div>
        </div>
</div>



</div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/interactjs/dist/interact.min.js"></script>


<script>
let carts = JSON.parse(localStorage.getItem("carts")) || {};
let selectedUser = null;
let cashierId = @json($cashier_id);

// Save carts to localStorage
function saveCarts() {
    localStorage.setItem("carts", JSON.stringify(carts));
}

// Load carts from localStorage on page load
window.onload = function () {
    for (let userId in carts) {
        renderUserCart(userId);
    }
};

function addUser() {
    let userSelect = document.getElementById("userSelect");
    let userId = parseInt(userSelect.value);

    if (!userId) return;
    if (carts[userId]) {
        alert(`User ${userId} is already in the cart.`);
        return;
    }

    carts[userId] = [];
    saveCarts();
    renderUserCart(userId);
    selectUser(userId);
}

function addCustomUser() {

    // Generate a unique user ID (find the highest existing ID and add 1)
    let userId = 100 + Math.max(0, ...Object.keys(carts).map(Number)) * 2;

    if (carts[userId]) {
        alert(`User ${userId} is already in the cart.`);
        return;
    }

    // Add the new user to the carts
    carts[userId] = [];

    // Save and update UI
    saveCarts();
    renderUserCart(userId, 'new_user');
    selectUser(userId);

    console.log(`Added custom user: ${userName} (ID: ${userId})`);
}

function renderUserCart(userId) {

    let cartContainer = document.getElementById("cart-container");

    let newCart = document.createElement("div");
    newCart.classList.add("p-4", "border", "rounded", "bg-white", "shadow-lg", "cursor-move", "draggable", "product-card", "relative");
    newCart.id = `user-cart-${userId}`;
    newCart.dataset.userId = userId;
    newCart.innerHTML = `
        <h2 class="text-lg font-bold">User ${userId}</h2>
        <ul class="cart-items text-sm text-gray-700"></ul>
        <p class="mt-2 font-bold">Total: $<span class="cart-total">0.00</span></p>
        <label for="payment-method-${userId}">Payment Method:</label>
        <select id="payment-method-${userId}" class="payment-method w-full p-2 border rounded mt-2">
            <option value="cash">Cash</option>
            <option value="card">Credit Card</option>
        </select>
        <button class="mt-2 px-4 py-2 bg-red-500 text-white rounded remove-user" onclick="removeUser(${userId})">Remove</button>
        <button class="mt-2 px-4 py-2 bg-green-500 text-white rounded checkout-user" onclick="checkoutUser(${userId})">Checkout</button>
    `;

    newCart.addEventListener("click", function () {
        selectUser(userId);
    });

    cartContainer.appendChild(newCart);
    updateCart(userId);
}


function renderUserCart(userId, type) {

    let cartContainer = document.getElementById("cart-container");

    let newCart = document.createElement("div");
    newCart.classList.add("p-4", "border", "rounded", "bg-white", "shadow-lg", "cursor-pointer", "absolute", "draggable", "product-card", "h-fit");
    newCart.id = `user-cart-${userId}`;
    newCart.dataset.userId = userId;

    if (type === 'new_user') {
    newCart.innerHTML = `
        <h2 class="text-lg font-bold">User ${userId}</h2>
        <ul class="cart-items text-sm text-gray-700"></ul>
        <p class="mt-2 font-bold">Total: $<span class="cart-total">0.00</span></p>
        
        <!-- First Name Input -->
        <label for="customer_first_name-${userId}" class="block text-sm font-medium text-gray-700">First Name</label>
        <input type="text" id="customer_first_name-${userId}" class="w-full p-2 border rounded mt-1" placeholder="Enter first name" />
        
        <!-- Middle Name Input -->
        <label for="customer_middle_name-${userId}" class="block text-sm font-medium text-gray-700 mt-2">Middle Name</label>
        <input type="text" id="customer_middle_name-${userId}" class="w-full p-2 border rounded mt-1" placeholder="Enter middle name" />
        
        <!-- Last Name Input -->
        <label for="customer_last_name-${userId}" class="block text-sm font-medium text-gray-700 mt-2">Last Name</label>
        <input type="text" id="customer_last_name-${userId}" class="w-full p-2 border rounded mt-1" placeholder="Enter last name" />
        
        <!-- Phone Number Input -->
        <label for="customer_phone-${userId}" class="block text-sm font-medium text-gray-700 mt-2">Phone Number</label>
        <input type="text" id="customer_phone-${userId}" class="w-full p-2 border rounded mt-1" placeholder="Enter phone number" />

        <!-- Payment Method Dropdown -->
        <label for="payment-method-${userId}" class="block text-sm font-medium text-gray-700 mt-2">Payment Method</label>
        <select id="payment-method-${userId}" class="payment-method w-full p-2 border rounded mt-1">
            <option value="cash">Cash</option>
            <option value="card">Credit Card</option>
        </select>

        <!-- Buttons -->
        <button class="mt-2 px-4 py-2 bg-red-500 text-white rounded remove-user" onclick="removeUser(${userId})">Remove</button>
        <button class="mt-2 px-4 py-2 bg-green-500 text-white rounded checkout-user" onclick="checkoutNewCustomer(${userId})">Checkout</button>
    `;
}
    else {
        newCart.innerHTML = `
        <h2 class="text-lg font-bold">User ${userId}</h2>
        <ul class="cart-items text-sm text-gray-700" id="total-cart-items-${userId}"></ul>
        <p class="mt-2 font-bold">Total: $<span class="cart-total" id="total-amount-${userId}">0.00</span></p>
        <label for="payment-method-${userId}">Payment Method:</label>
        <select id="payment-method-${userId}" class="hidden payment-method w-full p-2 border rounded mt-2">
            <option value="cash">Cash</option>
            <option value="card">Credit Card</option>
        </select>
        <button class="mt-2 px-4 py-2 bg-red-500 text-white rounded remove-user" onclick="removeUser(${userId})">Remove</button>
        <button class="mt-2 px-4 py-2 bg-green-500 text-white rounded checkout-user" onclick="payCart(${userId})">Pay</button>
    `;
    }

    newCart.addEventListener("click", function () {
        selectUser(userId);
    });

    cartContainer.appendChild(newCart);
    updateCart(userId);
}

function selectUser(id) {
    id = parseInt(id);
    if (!carts[id]) return;
    selectedUser = id;

    document.querySelectorAll("#cart-container > div").forEach(cart => cart.classList.remove("border-blue-500"));
    let cartElement = document.getElementById(`user-cart-${id}`);
    if (cartElement) {
        cartElement.classList.add("border-blue-500");
    }
}

function addToCart(id, name, price) {
    if (!selectedUser || !carts[selectedUser]) {
        alert("Select a customer first!");
        return;
    }

    carts[selectedUser].push({ id, name, price });
    saveCarts();
    updateCart(selectedUser);
}

function updateCart(userId) {
    let cartElement = document.getElementById(`user-cart-${userId}`);
    
    if (!cartElement) {
        console.error(`Cart element for user ${userId} not found`);
        return;
    }

    let list = cartElement.querySelector('.cart-items');
    let totalElement = cartElement.querySelector('.cart-total');

    if (!list) {
        console.error(`Cart items list not found inside #user-cart-${userId}`);
        return;
    }

    if (!totalElement) {
        console.error(`Cart total element not found inside #user-cart-${userId}`);
        return;
    }

    list.innerHTML = '';
    let total = 0;

    if (!carts[userId] || !Array.isArray(carts[userId])) {
        console.error(`Cart data for user ${userId} is invalid`);
        return;
    }

    carts[userId].forEach(item => {
        let li = document.createElement('li');
        li.innerText = `${item.name} - $${item.price.toFixed(2)}`;
        list.appendChild(li);
        total += item.price;
    });

    totalElement.innerText = total.toFixed(2);
}


function removeUser(id) {
    debugger;
    let cartElement = document.getElementById(`user-cart-${id}`);
    if (cartElement) {
        cartElement.remove();
    }
    delete carts[id];
    saveCarts();

    if (selectedUser === id) {
        selectedUser = null;
    }
}

function payCart(userId) {
    if (!carts[userId] || carts[userId].length === 0) {
        alert("No products added for this customer.");
        return;
    }

    let cartContainer = document.getElementById("cart-container");
    let totalAmount = document.getElementById(`total-amount-${userId}`).innerHTML;
    let totalCartItems = document.getElementById(`total-cart-items-${userId}`).innerHTML;

    debugger;

    cartContainer.classList.add(
        "p-4", "border", "rounded", "bg-white", "shadow-lg",
        "cursor-pointer", "absolute", "draggable", "product-card", "h-fit"
    );

    cartContainer.innerHTML = `
        <h2 class="text-lg font-bold">User ${userId}</h2>
        <ul class="cart-items text-sm text-gray-700" id="current-total-cart-items-${userId}"></ul>
        <p class="mt-2 font-bold">Total: $<span class="cart-total" id="current-total-amount-${userId}">0.00</span></p>
        
        <!-- Enter Amount Input -->
        <label for="enter-amount-${userId}" class="block text-sm font-medium text-gray-700 mt-2">Enter Amount</label>
        <input type="number" id="enter-amount-${userId}" class="w-full p-2 border rounded mt-1" placeholder="Enter amount" />

        <!-- Payment Method Dropdown -->
        <label for="payment-method-${userId}" class="block text-sm font-medium text-gray-700 mt-2">Payment Method</label>
        <select id="payment-method-${userId}" class="payment-method w-full p-2 border rounded mt-1">
            <option value="cash">Cash</option>
            <option value="card">Credit Card</option>
        </select>

        <!-- Checkout Button -->
        <button class="mt-2 px-4 py-2 bg-green-500 text-white rounded checkout-user" onclick="checkoutUser(${userId})">Checkout</button>
    `;

    document.getElementById(`current-total-amount-${userId}`).textContent = totalAmount;
    document.getElementById(`current-total-cart-items-${userId}`).innerHTML = totalCartItems;

    cartContainer.addEventListener("click", function () {
        selectUser(userId);
    });

    updateCart(userId);
}
    
function checkoutUser(userId) {
    if (!carts[userId] || carts[userId].length === 0) {
        alert("No products added for this customer.");
        return;
    }

    let total = carts[userId].reduce((sum, item) => sum + item.price, 0);
    let paymentMethod = document.getElementById(`payment-method-${userId}`).value;
    let payed_amount = document.getElementById(`enter-amount-${userId}`).value;
    let totals = carts[userId].reduce((sum, item) => sum + item.price, 0);

    if(!(payed_amount >= totals)){
        alert('Not enough payment!');
        return;
    }

    let requestData = {
        customer_id: userId,
        cashier_id: cashierId,
        items: carts[userId].map(item => ({
            id: item.id,
            name: item.name,
            price: item.price,
            quantity: 1, // Modify this if quantity is dynamic
        })),
        total: carts[userId].reduce((sum, item) => sum + item.price, 0),
        payment_method: paymentMethod,
    };

    axios.post("{{ route('cashier.purchase.store') }}", requestData)
        .then(response => {
            if(response.status === 200)
            {
                debugger;
                console.log(response.data);
                alert("Checkout successful!");
                showUserPurchaseSummary(userId);
            }
        })
        .catch(error => {
            console.error("Error during checkout:", error.response?.data || error);
            alert("Checkout failed.");
        });
}

function showUserPurchaseSummary(userId){
    
    debugger;

    let cartContainer = document.getElementById("cart-container");
    let totalAmount = document.getElementById(`current-total-amount-${userId}`).innerHTML;
    let totalCartItems = document.getElementById(`current-total-cart-items-${userId}`).innerHTML;
    let payed_amount = document.getElementById(`enter-amount-${userId}`).value;

    debugger;

    cartContainer.classList.add(
        "p-4", "border", "rounded", "bg-white", "shadow-lg",
        "cursor-pointer", "absolute", "draggable", "product-card", "h-fit"
    );

    //summary
    cartContainer.innerHTML = `
        <h2 class="text-lg font-bold">User ${userId}</h2>
        <ul class="cart-items text-sm text-gray-700" id="current-total-cart-items-${userId}"></ul>
        <p class="mt-2 font-bold">Total Amount: $<span class="cart-total" id="current-total-amount-${userId}">0.00</span></p>
        
        <!-- Enter Amount Input -->
        <p class="mt-2 font-bold">Payed: $<span class="cart-total" id="enter-amount-${userId}">0.00</span></p>
        
        <!-- Enter Amount Input -->
        <p class="mt-2 font-bold">Total Change: $<span class="cart-total" id="user-summary-change-amount-${userId}">0.00</span></p>
    
        <!-- Checkout Button -->
        <button class="mt-2 px-4 py-2 bg-red-500 text-white rounded checkout-user" onclick="removeUser(${userId})">Checkout</button>
    `;

    let totals = carts[userId].reduce((sum, item) => sum + item.price, 0);
    let totalChange = parseFloat(payed_amount) - parseFloat(totals);

    //objects
    let totalAmountObject = document.getElementById(`current-total-amount-${userId}`).textContent = totalAmount;
    let payed_amount_object = document.getElementById(`enter-amount-${userId}`).innerHTML = payed_amount;

    document.getElementById(`user-summary-change-amount-${userId}`).textContent = totalChange;
}

function checkoutNewCustomer(userId) {
    debugger

    let paymentMethod = document.getElementById(`payment-method-${userId}`).value;
    let customer_first_name = document.getElementById(`customer_first_name-${userId}`).value;
    let customer_middle_name = document.getElementById(`customer_middle_name-${userId}`).value;
    let customer_last_name = document.getElementById(`customer_last_name-${userId}`).value;
    let customer_phone_number = document.getElementById(`customer_phone-${userId}`).value;
    
    if (!paymentMethod || !customer_first_name || !customer_middle_name
        || !customer_last_name || !customer_phone_number
    ) {
        alert("Please fill in all required fields.");
        return;
    }

    let requestData = {
        customer_id: userId,
        cashier_id: cashierId,
        customer_first_name: customer_first_name,
        customer_middle_name: customer_middle_name,
        customer_last_name: customer_last_name,
        customer_phone_number: customer_phone_number,
        items: carts[userId].map(item => ({
            id: item.id,
            name: item.name,
            price: item.price,
            quantity: 1, // Modify this if quantity is dynamic
        })),
        total: carts[userId].reduce((sum, item) => sum + item.price, 0),
        payment_method: paymentMethod,
    };

    debugger
    axios.post("{{ route('cashier.purchase.store') }}", requestData)
        .then(response => {
            debugger;
            if(response.status === 200)
            {
                console.log(response.data);
                alert("Checkout successful!");
                removeUser(userId);
            }
            else
            {
                console.log('Checkout error!');
            }
        })
        .catch(error => {
            console.error("Error during checkout:", error.response?.data || error);
            alert("Checkout failed.");
        });
}

interact('.draggable')
.draggable({
    inertia: true,
    autoScroll: true,
    listeners: {
        move(event) {
            let target = event.target;
            let x = (parseFloat(target.getAttribute('data-x')) || 0) + event.dx;
            let y = (parseFloat(target.getAttribute('data-y')) || 0) + event.dy;

            target.style.transform = `translate(${x}px, ${y}px)`;
            target.setAttribute('data-x', x);
            target.setAttribute('data-y', y);
        }
    }
});

</script>
    </div>
</x-main-layout>
