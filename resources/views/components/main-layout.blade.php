<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .mdi--cash-register {
            display: inline-block;
            --svg: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'%3E%3Cpath fill='%23000' d='M2 17h20v4H2zM6.25 7H9V6H6V3h8v3h-3v1h6.8c1 0 2 1 2.2 2l.5 7h-17l.55-7c0-1 1-2 2.2-2M13 9v2h5V9zM6 9v1h2V9zm3 0v1h2V9zm-3 2v1h2v-1zm3 0v1h2v-1zm-3 2v1h2v-1zm3 0v1h2v-1zM7 4v1h6V4z'/%3E%3C/svg%3E");
            background-color: currentColor;
            -webkit-mask-image: var(--svg);
            mask-image: var(--svg);
            -webkit-mask-repeat: no-repeat;
            mask-repeat: no-repeat;
            -webkit-mask-size: 100% 100%;
            mask-size: 100% 100%;
        }

        .eos-icons--admin {
            display: inline-block;
            --svg: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'%3E%3Cpath fill='%23000' d='M12 1L3 5v6c0 5.55 3.84 10.74 9 12c5.16-1.26 9-6.45 9-12V5Zm0 3.9a3 3 0 1 1-3 3a3 3 0 0 1 3-3m0 7.9c2 0 6 1.09 6 3.08a7.2 7.2 0 0 1-12 0c0-1.99 4-3.08 6-3.08'/%3E%3C/svg%3E");
            background-color: currentColor;
            -webkit-mask-image: var(--svg);
            mask-image: var(--svg);
            -webkit-mask-repeat: no-repeat;
            mask-repeat: no-repeat;
            -webkit-mask-size: 100% 100%;
            mask-size: 100% 100%;
        }

        .ic--round-dashboard {
            display: inline-block;
            --svg: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'%3E%3Cpath fill='%23000' d='M4 13h6c.55 0 1-.45 1-1V4c0-.55-.45-1-1-1H4c-.55 0-1 .45-1 1v8c0 .55.45 1 1 1m0 8h6c.55 0 1-.45 1-1v-4c0-.55-.45-1-1-1H4c-.55 0-1 .45-1 1v4c0 .55.45 1 1 1m10 0h6c.55 0 1-.45 1-1v-8c0-.55-.45-1-1-1h-6c-.55 0-1 .45-1 1v8c0 .55.45 1 1 1M13 4v4c0 .55.45 1 1 1h6c.55 0 1-.45 1-1V4c0-.55-.45-1-1-1h-6c-.55 0-1 .45-1 1'/%3E%3C/svg%3E");
            background-color: currentColor;
            -webkit-mask-image: var(--svg);
            mask-image: var(--svg);
            -webkit-mask-repeat: no-repeat;
            mask-repeat: no-repeat;
            -webkit-mask-size: 100% 100%;
            mask-size: 100% 100%;
        }

        .solar--cart-4-bold {
            display: inline-block;
            --svg: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'%3E%3Cpath fill='%23000' d='M14.665 2.33a.75.75 0 0 1 1.006.335l2.201 4.402c1.353.104 2.202.37 2.75 1.047c.436.539.576 1.209.525 2.136H2.853c-.051-.927.09-1.597.525-2.136c.548-.678 1.397-.943 2.75-1.047l2.201-4.402a.75.75 0 0 1 1.342.67l-1.835 3.67Q8.559 7 9.422 7h5.156q.863-.001 1.586.005l-1.835-3.67a.75.75 0 0 1 .336-1.006'/%3E%3Cpath fill='%23000' fill-rule='evenodd' d='M3.555 14.257a74 74 0 0 1-.51-2.507h17.91a74 74 0 0 1-.51 2.507l-.429 2c-.487 2.273-.73 3.409-1.555 4.076S16.474 21 14.15 21h-4.3c-2.324 0-3.486 0-4.31-.667c-.826-.667-1.07-1.803-1.556-4.076zM10 13.25a.75.75 0 0 0 0 1.5h4a.75.75 0 0 0 0-1.5z' clip-rule='evenodd'/%3E%3C/svg%3E");
            background-color: currentColor;
            -webkit-mask-image: var(--svg);
            mask-image: var(--svg);
            -webkit-mask-repeat: no-repeat;
            mask-repeat: no-repeat;
            -webkit-mask-size: 100% 100%;
            mask-size: 100% 100%;
        }

        .majesticons--logout {
            display: inline-block;
            --svg: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'%3E%3Cpath fill='%23000' fill-rule='evenodd' d='M6 2a3 3 0 0 0-3 3v14a3 3 0 0 0 3 3h6a3 3 0 0 0 3-3V5a3 3 0 0 0-3-3zm10.293 5.293a1 1 0 0 1 1.414 0l4 4a1 1 0 0 1 0 1.414l-4 4a1 1 0 0 1-1.414-1.414L18.586 13H10a1 1 0 1 1 0-2h8.586l-2.293-2.293a1 1 0 0 1 0-1.414' clip-rule='evenodd'/%3E%3C/svg%3E");
            background-color: currentColor;
            -webkit-mask-image: var(--svg);
            mask-image: var(--svg);
            -webkit-mask-repeat: no-repeat;
            mask-repeat: no-repeat;
            -webkit-mask-size: 100% 100%;
            mask-size: 100% 100%;
        }
    </style>

</head>

<body
    class="bg-gray-100 text-black antialiased scroll-smooth selection:bg-gray-700 selection:text-white tracking-wider">


    {{-- admin layout --}}
    @if (Request::routeIs('dashboard*') || Request::routeIs('inventory*') || Request::routeIs('cashier*'))
        <main class="grid grid-cols-12 w-full h-full">

            {{-- sidebar --}}
            <aside id="sidebar"
                class="col-span-2 w-full h-[calc(100vh)] overflow-auto bg-white border-r shadow-lg flex flex-col justify-between">
                <div class="flex flex-col w-full">
                    <x-sidebar-menu routeName="dashboard.index">
                        <div class="w-auto h-auto">
                            <span class="ic--round-dashboard w-6 h-6"></span>
                        </div>
                        <p>Dashboard</p>
                    </x-sidebar-menu>
                    <x-sidebar-menu routeName="inventory.index">
                        <div class="w-auto h-auto">
                            <span class="solar--cart-4-bold w-6 h-6"></span>
                        </div>
                        <p>Inventory</p>
                    </x-sidebar-menu>
                    <x-sidebar-menu routeName="cashiers.index">
                        <div class="w-auto h-auto">
                            <span class="mdi--cash-register w-6 h-6"></span>
                        </div>
                        <p>Cashiers</p>
                    </x-sidebar-menu>
                </div>

                <button onclick="openLogoutModal()"
                    class="w-full bg-red-500 hover:bg-red-600 px-7 py-4 flex gap-2 items-center text-white"
                    type="submit">
                    <div class="majesticons--logout !w-6 !h-6"></div>
                    <p class="font-semibold">Logout</p>
                </button>

                <div id="logoutModal"
                    class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden">
                    <div class="bg-white rounded-lg shadow-lg p-6 w-96">
                        <h2 class="text-xl font-bold text-black">Confirm Logout</h2>
                        <p class="text-gray-600 mt-2">Are you sure you want to log out?</p>

                        <div class="flex justify-end mt-7 space-x-3">
                            <button onclick="closeLogoutModal()"
                                class="px-8 py-2 text-black rounded-md border border-gray-300 hover:border-black">
                                Cancel
                            </button>
                            <form action="{{ route('logout') }}" method="POST" class="inline">
                                @csrf
                                <button type="submit"
                                    class="px-8 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 font-semibold">
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
            <section class="col-span-10 w-full h-[calc(100vh)] p-5 overflow-auto">
                {{ $slot }}
            </section>
        </main>
    @else
        {{-- guest layout --}}
        <main>
            {{ $slot }}
        </main>
    @endif
</body>

</html>
