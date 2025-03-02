<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>

<body class="bg-gray-100 text-black antialiased scroll-smooth selection:bg-gray-700 selection:text-white tracking-wider">

    {{-- admin layout --}}
    @if (Request::routeIs('dashboard*') ||
            Request::routeIs('inventory*') ||
            Request::routeIs('cashiers*') ||
            Request::routeIs('bin*') ||
            Request::routeIs('category*') ||
            Request::routeIs('customers*') ||
            Request::routeIs('sales*'))
        <main class="grid grid-cols-12 w-full h-full">

            {{-- sidebar --}}
            <aside id="sidebar"
                class="col-span-2 w-full h-[calc(100vh)] overflow-auto bg-white border-r shadow-lg flex flex-col justify-between z-10">

                <div class="py-5 px-3">
                    <x-sidebar-logo />
                </div>

                <section class="h-full overflow-auto py-1">
                    <div class="flex flex-col w-full px-3">
                        <x-sidebar-menu routeName="dashboard.index">
                            <div class="w-auto h-auto flex items-center gap-3">
                                <span class="ic--round-dashboard w-5 h-5"></span>
                                <p class="text-nowrap">Dashboard</p>
                            </div>
                        </x-sidebar-menu>

                        <!-- PRODUCTS DROPDOWN -->
                        <div x-data="{ open: false }" x-init="open = {{ Route::is('inventory*') || Route::is('category*') || Route::is('bin*') ? 'true' : 'false' }}">

                            <button @click="open = !open"
                                class="w-full flex items-center justify-between py-3 px-5 hover:bg-gray-200 rounded"
                                :class="{ 'text-black': open, 'text-black/60': !open }">
                                <div class="flex items-center gap-3">
                                    <span class="solar--cart-4-bold w-5 h-5"></span>
                                    <p class="text-nowrap font-medium">Products</p>
                                </div>
                                <span x-show="!open" class="mingcute--down-line w-5 h-5"></span>
                                <span x-show="open" class="mingcute--up-line w-5 h-5"></span>
                            </button>

                            <!-- Dropdown Items -->
                            <div x-show="open" x-transition.opacity x-cloak class="ml-8 flex flex-col mt-1">
                                <x-sidebar-menu routeName="inventory.index">
                                    <div class="w-auto h-auto flex items-center gap-3">
                                        <p class="text-nowrap text-sm">Inventory</p>
                                    </div>
                                </x-sidebar-menu>
                                <x-sidebar-menu routeName="category.index">
                                    <div class="w-auto h-auto flex items-center gap-3">
                                        <p class="text-nowrap text-sm">Category</p>
                                    </div>
                                </x-sidebar-menu>
                            </div>
                        </div>

                        <!-- USERS DROPDOWN -->
                        <div x-data="{ open: false }" x-init="open = {{ Route::is('cashiers*') || Route::is('customers*') ? 'true' : 'false' }}">

                            <button @click="open = !open"
                                class="w-full flex items-center justify-between py-3 px-5 hover:bg-gray-200 rounded"
                                :class="{ 'text-black': open, 'text-black/60': !open }">
                                <div class="flex items-center gap-3">
                                    <span class="fa-solid--users w-5 h-5"></span>
                                    <p class="text-nowrap font-medium">Users</p>
                                </div>
                                <span x-show="!open" class="mingcute--down-line w-5 h-5"></span>
                                <span x-show="open" class="mingcute--up-line w-5 h-5"></span>
                            </button>

                            <!-- Dropdown Items -->
                            <div x-show="open" x-transition.opacity x-cloak class="ml-8 flex flex-col mt-1">
                                <x-sidebar-menu routeName="cashiers.index">
                                    <div class="w-auto h-auto flex items-center gap-3">
                                        <p class="text-nowrap text-sm">Cashiers</p>
                                    </div>
                                </x-sidebar-menu>
                                <x-sidebar-menu routeName="customers.index">
                                    <div class="w-auto h-auto flex items-center gap-3">
                                        <p class="text-nowrap text-sm">Customers</p>
                                    </div>
                                </x-sidebar-menu>
                            </div>
                        </div>

                        <x-sidebar-menu routeName="sales.index">
                            <div class="w-auto h-auto flex items-center gap-3">
                                <span class="tdesign--money-filled w-5 h-5"></span>
                                <p class="text-nowrap">Sales</p>
                            </div>
                        </x-sidebar-menu>
                    </div>
                </section>

                <section class="h-auto">
                    <button onclick="openLogoutModal()"
                        class="w-full bg-red-500 hover:bg-red-600 px-5 py-3 flex gap-2 text-white" type="submit">
                        <div class="w-auto h-auto flex items-center gap-3">
                            <span class="majesticons--logout w-5 h-5"></span>
                            <p class="text-nowrap">Logout</p>
                        </div>
                    </button>
                </section>

                <div id="logoutModal"
                    class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden">
                    <div class="bg-white rounded-lg shadow-lg p-6 w-96">
                        <h2 class="text-xl font-bold text-black">Confirm Logout</h2>
                        <p class="text-gray-600 mt-2">Are you sure you want to log out?</p>

                        <div class="flex justify-end mt-7 space-x-3">
                            <button onclick="closeLogoutModal()"
                                class="px-5 py-2 text-black rounded border border-gray-300 hover:border-black">
                                Cancel
                            </button>
                            <form action="{{ route('logout') }}" method="POST" class="inline">
                                @csrf
                                <button type="submit"
                                    class="px-5 py-2 bg-red-500 text-white rounded hover:bg-red-600 font-semibold">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <script>
                    function openLogoutModal() {
                        document.getElementById('logoutModal').classList.remove('hidden');
                    }

                    function closeLogoutModal() {
                        document.getElementById('logoutModal').classList.add('hidden');
                    }
                </script>
            </aside>

            {{-- main content --}}
            <section class="col-span-10 w-full h-[calc(100vh)] p-10 overflow-auto">
                {{ $slot }}
            </section>
        </main>

        {{-- cashier layout --}}
    @elseif (Request::routeIs('cashier*'))
        {{ $slot }}
    @else
        {{-- guest layout --}}
        <main>
            {{ $slot }}
        </main>
    @endif
</body>

</html>
