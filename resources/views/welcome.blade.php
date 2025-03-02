<x-main-layout>
    <main class="w-full h-screen">
        <div class="flex items-center justify-center h-full">
            <div class="w-1/3 flex flex-col items-center gap-7">
                <h1 class="text-xl font-bold">WELCOME TO SARI-SARI POS SYSTEM</h1>
                <p class="text-lg">Continue as</p>
                <div class="flex items-center justify-evenly w-full gap-7">
                    <a href="{{ route('show.cashier.login') }}"
                        class="5 w-full justify-center py-3 rounded bg-gray-700 hover:bg-gray-700/80 text-white font-semibold flex gap-2 items-center">
                        <span class="mdi--cash-register w-7 h-7"></span>
                        <p>Cashier</p>
                    </a>
                    <a href="{{ route('show.admin.login') }}"
                        class="px-5 w-full justify-center py-3 rounded bg-gray-700 hover:bg-gray-700/80 text-white font-semibold flex gap-2 items-center">
                        <span class="eos-icons--admin w-7 h-7"></span>
                        <p>Admin</p>
                    </a>
                </div>
            </div>
        </div>
    </main>
</x-main-layout>
