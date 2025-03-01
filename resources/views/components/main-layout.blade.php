<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .gridicons--user-add {
            display: inline-block;
            --svg: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'%3E%3Ccircle cx='15' cy='8' r='4' fill='%23000'/%3E%3Cpath fill='%23000' d='M15 20s8 0 8-2c0-2.4-3.9-5-8-5s-8 2.6-8 5c0 2 8 2 8 2M6 10V7H4v3H1v2h3v3h2v-3h3v-2z'/%3E%3C/svg%3E");
            background-color: currentColor;
            -webkit-mask-image: var(--svg);
            mask-image: var(--svg);
            -webkit-mask-repeat: no-repeat;
            mask-repeat: no-repeat;
            -webkit-mask-size: 100% 100%;
            mask-size: 100% 100%;
        }

        .mingcute--close-line {
            display: inline-block;
            --svg: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cpath d='m12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035q-.016-.005-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093q.019.005.029-.008l.004-.014l-.034-.614q-.005-.018-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z'/%3E%3Cpath fill='%23000' d='m12 13.414l5.657 5.657a1 1 0 0 0 1.414-1.414L13.414 12l5.657-5.657a1 1 0 0 0-1.414-1.414L12 10.586L6.343 4.929A1 1 0 0 0 4.93 6.343L10.586 12l-5.657 5.657a1 1 0 1 0 1.414 1.414z'/%3E%3C/g%3E%3C/svg%3E");
            background-color: currentColor;
            -webkit-mask-image: var(--svg);
            mask-image: var(--svg);
            -webkit-mask-repeat: no-repeat;
            mask-repeat: no-repeat;
            -webkit-mask-size: 100% 100%;
            mask-size: 100% 100%;
        }

        .bxs--save {
            display: inline-block;
            --svg: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'%3E%3Cpath fill='%23000' d='M5 21h14a2 2 0 0 0 2-2V8l-5-5H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2M7 5h4v2h2V5h2v4H7zm0 8h10v6H7z'/%3E%3C/svg%3E");
            background-color: currentColor;
            -webkit-mask-image: var(--svg);
            mask-image: var(--svg);
            -webkit-mask-repeat: no-repeat;
            mask-repeat: no-repeat;
            -webkit-mask-size: 100% 100%;
            mask-size: 100% 100%;
        }

        .mingcute--eye-fill {
            display: inline-block;
            --svg: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cpath d='m12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035q-.016-.005-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093q.019.005.029-.008l.004-.014l-.034-.614q-.005-.018-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z'/%3E%3Cpath fill='%23000' d='M12 4C9.213 4 6.737 5.257 4.974 6.813C4.09 7.594 3.36 8.47 2.846 9.344C2.34 10.201 2 11.13 2 12s.34 1.799.846 2.656c.514.873 1.243 1.75 2.128 2.531C6.737 18.743 9.214 20 12 20c2.787 0 5.263-1.257 7.026-2.813c.885-.781 1.614-1.658 2.128-2.531C21.66 13.799 22 12.87 22 12s-.34-1.799-.846-2.656c-.514-.873-1.243-1.75-2.128-2.531C17.263 5.257 14.786 4 12 4m2 8c.36 0 .697-.095.989-.261A3 3 0 1 1 12.26 9.01A2 2 0 0 0 14 12'/%3E%3C/g%3E%3C/svg%3E");
            background-color: currentColor;
            -webkit-mask-image: var(--svg);
            mask-image: var(--svg);
            -webkit-mask-repeat: no-repeat;
            mask-repeat: no-repeat;
            -webkit-mask-size: 100% 100%;
            mask-size: 100% 100%;
        }

        .material-symbols--category-rounded {
            display: inline-block;
            --svg: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'%3E%3Cpath fill='%23000' d='M7.425 9.475L11.15 3.4q.15-.25.375-.363T12 2.925t.475.113t.375.362l3.725 6.075q.15.25.15.525t-.125.5t-.35.363t-.525.137h-7.45q-.3 0-.525-.137T7.4 10.5t-.125-.5t.15-.525M17.5 22q-1.875 0-3.187-1.312T13 17.5t1.313-3.187T17.5 13t3.188 1.313T22 17.5t-1.312 3.188T17.5 22M3 20.5v-6q0-.425.288-.712T4 13.5h6q.425 0 .713.288T11 14.5v6q0 .425-.288.713T10 21.5H4q-.425 0-.712-.288T3 20.5'/%3E%3C/svg%3E");
            background-color: currentColor;
            -webkit-mask-image: var(--svg);
            mask-image: var(--svg);
            -webkit-mask-repeat: no-repeat;
            mask-repeat: no-repeat;
            -webkit-mask-size: 100% 100%;
            mask-size: 100% 100%;
        }

        .carbon--close-filled {
            display: inline-block;
            --svg: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 32 32'%3E%3Cpath fill='%23000' d='M16 2C8.2 2 2 8.2 2 16s6.2 14 14 14s14-6.2 14-14S23.8 2 16 2m5.4 21L16 17.6L10.6 23L9 21.4l5.4-5.4L9 10.6L10.6 9l5.4 5.4L21.4 9l1.6 1.6l-5.4 5.4l5.4 5.4z'/%3E%3C/svg%3E");
            background-color: currentColor;
            -webkit-mask-image: var(--svg);
            mask-image: var(--svg);
            -webkit-mask-repeat: no-repeat;
            mask-repeat: no-repeat;
            -webkit-mask-size: 100% 100%;
            mask-size: 100% 100%;
        }

        .pajamas--go-back {
            display: inline-block;
            --svg: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3E%3Cpath fill='%23000' fill-rule='evenodd' d='m2.87 7.75l1.97 1.97a.75.75 0 1 1-1.06 1.06L.53 7.53L0 7l.53-.53l3.25-3.25a.75.75 0 0 1 1.06 1.06L2.87 6.25h9.88a3.25 3.25 0 0 1 0 6.5h-2a.75.75 0 0 1 0-1.5h2a1.75 1.75 0 1 0 0-3.5z' clip-rule='evenodd'/%3E%3C/svg%3E");
            background-color: currentColor;
            -webkit-mask-image: var(--svg);
            mask-image: var(--svg);
            -webkit-mask-repeat: no-repeat;
            mask-repeat: no-repeat;
            -webkit-mask-size: 100% 100%;
            mask-size: 100% 100%;
        }

        .tabler--restore {
            display: inline-block;
            --svg: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'%3E%3Cg fill='none' stroke='%23000' stroke-linecap='round' stroke-linejoin='round' stroke-width='2'%3E%3Cpath d='M3.06 13a9 9 0 1 0 .49-4.087'/%3E%3Cpath d='M3 4.001v5h5M11 12a1 1 0 1 0 2 0a1 1 0 1 0-2 0'/%3E%3C/g%3E%3C/svg%3E");
            background-color: currentColor;
            -webkit-mask-image: var(--svg);
            mask-image: var(--svg);
            -webkit-mask-repeat: no-repeat;
            mask-repeat: no-repeat;
            -webkit-mask-size: 100% 100%;
            mask-size: 100% 100%;
        }

        .material-symbols--delete {
            display: inline-block;
            --svg: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'%3E%3Cpath fill='%23000' d='M7 21q-.825 0-1.412-.587T5 19V6H4V4h5V3h6v1h5v2h-1v13q0 .825-.587 1.413T17 21zm2-4h2V8H9zm4 0h2V8h-2z'/%3E%3C/svg%3E");
            background-color: currentColor;
            -webkit-mask-image: var(--svg);
            mask-image: var(--svg);
            -webkit-mask-repeat: no-repeat;
            mask-repeat: no-repeat;
            -webkit-mask-size: 100% 100%;
            mask-size: 100% 100%;
        }

        .ri--edit-fill {
            display: inline-block;
            --svg: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'%3E%3Cpath fill='%23000' d='M7.243 17.997H3v-4.243L14.435 2.319a1 1 0 0 1 1.414 0l2.829 2.828a1 1 0 0 1 0 1.415zm-4.243 2h18v2H3z'/%3E%3C/svg%3E");
            background-color: currentColor;
            -webkit-mask-image: var(--svg);
            mask-image: var(--svg);
            -webkit-mask-repeat: no-repeat;
            mask-repeat: no-repeat;
            -webkit-mask-size: 100% 100%;
            mask-size: 100% 100%;
        }

        .ic--round-plus {
            display: inline-block;
            --svg: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'%3E%3Cpath fill='%23000' d='M18 12.998h-5v5a1 1 0 0 1-2 0v-5H6a1 1 0 0 1 0-2h5v-5a1 1 0 0 1 2 0v5h5a1 1 0 0 1 0 2'/%3E%3C/svg%3E");
            background-color: currentColor;
            -webkit-mask-image: var(--svg);
            mask-image: var(--svg);
            -webkit-mask-repeat: no-repeat;
            mask-repeat: no-repeat;
            -webkit-mask-size: 100% 100%;
            mask-size: 100% 100%;
        }

        .material-symbols--archive-rounded {
            display: inline-block;
            --svg: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'%3E%3Cpath fill='%23000' d='M5 21q-.825 0-1.412-.587T3 19V6.525q0-.35.113-.675t.337-.6L4.7 3.725q.275-.35.687-.538T6.25 3h11.5q.45 0 .863.188t.687.537l1.25 1.525q.225.275.338.6t.112.675V19q0 .825-.587 1.413T19 21zm.4-15h13.2l-.85-1H6.25zm6.6 4q-.425 0-.712.288T11 11v3.2l-.9-.9q-.275-.275-.7-.275t-.7.275t-.275.7t.275.7l2.6 2.6q.3.3.7.3t.7-.3l2.6-2.6q.275-.275.275-.7t-.275-.7t-.7-.275t-.7.275l-.9.9V11q0-.425-.288-.712T12 10'/%3E%3C/svg%3E");
            background-color: currentColor;
            -webkit-mask-image: var(--svg);
            mask-image: var(--svg);
            -webkit-mask-repeat: no-repeat;
            mask-repeat: no-repeat;
            -webkit-mask-size: 100% 100%;
            mask-size: 100% 100%;
        }

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
    @if (Request::routeIs('dashboard*') ||
            Request::routeIs('inventory*') ||
            Request::routeIs('cashiers*') ||
            Request::routeIs('bin*') ||
            Request::routeIs('category*'))
        <main class="grid grid-cols-12 w-full h-full">

            {{-- sidebar --}}
            <aside id="sidebar"
                class="col-span-2 w-full h-[calc(100vh)] overflow-auto bg-white border-r shadow-lg flex flex-col justify-between z-10">

                <section>
                    <div class="py-5 px-3">
                        <x-sidebar-logo />
                    </div>

                    <div class="flex flex-col w-full px-3">
                        <x-sidebar-menu routeName="dashboard.index">
                            <div class="w-auto h-auto flex items-center gap-3">
                                <span class="ic--round-dashboard w-6 h-6"></span>
                                <p class="text-nowrap">Dashboard</p>
                            </div>
                        </x-sidebar-menu>
                        <x-sidebar-menu routeName="inventory.index">
                            <div class="w-auto h-auto flex items-center gap-3">
                                <span class="solar--cart-4-bold w-6 h-6"></span>
                                <p class="text-nowrap">Inventory</p>
                            </div>
                        </x-sidebar-menu>
                        <x-sidebar-menu routeName="category.index">
                            <div class="w-auto h-auto flex items-center gap-3">
                                <span class="material-symbols--category-rounded w-6 h-6"></span>
                                <p class="text-nowrap">Category</p>
                            </div>
                        </x-sidebar-menu>
                        <x-sidebar-menu routeName="cashiers.index">
                            <div class="w-auto h-auto flex items-center gap-3">
                                <span class="mdi--cash-register w-6 h-6"></span>
                                <p class="text-nowrap">Cashiers</p>
                            </div>
                        </x-sidebar-menu>
                    </div>
                </section>

                <button onclick="openLogoutModal()"
                    class="w-full bg-red-500 hover:bg-red-600 px-7 py-4 flex gap-2 text-white" type="submit">
                    <div class="w-auto h-auto flex items-center gap-3">
                        <span class="majesticons--logout w-6 h-6"></span>
                        <p class="text-nowrap">Logout</p>
                    </div>
                </button>

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
    @elseif (Request::routeIs('cashier.index') || 
    (Request::routeIs('product.index'))
    )
        <main class="grid grid-cols-12 w-full h-full">
            {{-- sidebar --}}
            <aside id="sidebar"
                class="col-span-2 w-full h-[calc(100vh)] overflow-auto bg-white border-r shadow-lg flex flex-col justify-between z-10">

                <section>
                    <div class="py-5 px-3">
                        <x-sidebar-logo />
                    </div>

                    <div class="flex flex-col w-full px-3">
                        <x-sidebar-menu routeName="cashier.index">
                            <div class="w-auto h-auto flex items-center gap-3">
                                <span class="ic--round-dashboard w-6 h-6"></span>
                                <p class="text-nowrap">Dashboard</p>
                            </div>
                        </x-sidebar-menu>
                        <x-sidebar-menu routeName="product.index">
                            <div class="w-auto h-auto flex items-center gap-3">
                                <span class="solar--cart-4-bold w-6 h-6"></span>
                                <p class="text-nowrap">Products</p>
                            </div>
                        </x-sidebar-menu>
                        <x-sidebar-menu routeName="category.index">
                            <div class="w-auto h-auto flex items-center gap-3">
                                <span class="material-symbols--category-rounded w-6 h-6"></span>
                                <p class="text-nowrap">Category</p>
                            </div>
                        </x-sidebar-menu>
                        <x-sidebar-menu routeName="cashiers.index">
                            <div class="w-auto h-auto flex items-center gap-3">
                                <span class="mdi--cash-register w-6 h-6"></span>
                                <p class="text-nowrap">Cashiers</p>
                            </div>
                        </x-sidebar-menu>
                    </div>
                </section>

                <button onclick="openLogoutModal()"
                    class="w-full bg-red-500 hover:bg-red-600 px-7 py-4 flex gap-2 text-white" type="submit">
                    <div class="w-auto h-auto flex items-center gap-3">
                        <span class="majesticons--logout w-6 h-6"></span>
                        <p class="text-nowrap">Logout</p>
                    </div>
                </button>

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

            <section class="col-span-10 w-full h-[calc(100vh)] p-10 overflow-auto">
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
