<x-main-layout>
    <main class="w-full h-screen">
        <div class="flex flex-col items-center justify-center h-full">
            <div class="w-1/3 flex flex-col items-center gap-7 text-center">
                <h1 class="text-xl font-bold">You do not have permission to access this page.</h1>

                @if (Auth::user()->role === 'cashier')
                    <a href="{{ route('cashier.index') }}"
                        class="rounded bg-black hover:bg-black/80 text-white px-8 py-2 font-semibold text-center">Go
                        Back</a>
                @elseif (Auth::user()->role === 'admin')
                    <a href="{{ route('dashboard.index') }}"
                        class="rounded bg-black hover:bg-black/80 text-white px-8 py-2 font-semibold text-center">Go
                        Back</a>
                @else
                    <a href="{{ route('welcome') }}"
                        class="rounded bg-black hover:bg-black/80 text-white px-8 py-2 font-semibold text-center">Go
                        Home</a>
                @endif
            </div>
        </div>
    </main>
</x-main-layout>
