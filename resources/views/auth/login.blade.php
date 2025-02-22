<x-main-layout>

    {{-- cashier login --}}
    @if (Request::routeIs('show.cashier.login'))
        <main class="w-full h-screen">

            <div class="flex flex-col items-center justify-center h-full">

                @if (session('invalid'))
                    <x-flash-msg msg="invalid" />
                    <p>{{ session('invalid') }}</p>
                @elseif ($errors->has('invalid'))
                    <x-flash-msg msg="invalid" />
                @endif

                <form action="{{ route('cashier.login') }}" method="POST"
                    class="w-1/3 flex flex-col items-center gap-7 p-7 border border-gray-200 shadow-md bg-white rounded">
                    @csrf

                    <section class="flex items-center gap-2">
                        <span class="mdi--cash-register w-8 h-8"></span>
                        <h1 class="text-xl font-bold">CASHIER LOGIN</h1>
                    </section>

                    <section class="flex flex-col gap-1 w-full">
                        <label for="username">Username</label>
                        <input value="{{ old('username') }}" type="text" name="username" id="username"
                            @class([
                                'w-full border px-3 py-2',
                                'border-red-500' => $errors->has('username'),
                            ])>
                        @error('username')
                            <p class="text-red-500 font-semibold tracking-wider text-sm select-none">{{ $message }}</p>
                        @enderror
                    </section>

                    <section class="flex flex-col gap-1 w-full">
                        <label for="password">Password</label>
                        <input value="{{ old('password') }}" type="password" name="password" id="password"
                            @class([
                                'w-full border px-3 py-2',
                                'border-red-500' => $errors->has('password'),
                            ])>
                        @error('password')
                            <p class="text-red-500 font-semibold tracking-wider text-sm select-none">{{ $message }}</p>
                        @enderror
                    </section>

                    <section class="w-full">
                        <button type="submit"
                            class="rounded bg-black hover:bg-black/80 text-white w-full px-4 py-2 font-semibold">Login</button>
                    </section>
                </form>
            </div>
        </main>

        {{-- admin login --}}
    @elseif (Request::routeIs('show.admin.login'))
        <main class="w-full h-screen">

            <div class="flex flex-col items-center justify-center h-full">

                @if (session('invalid'))
                    <x-flash-msg msg="invalid" />
                    <p>{{ session('invalid') }}</p>
                @elseif ($errors->has('invalid'))
                    <x-flash-msg msg="invalid" />
                @endif

                <form action="{{ route('admin.login') }}" method="POST"
                    class="w-1/3 flex flex-col items-center gap-7 p-7 border border-gray-200 shadow-md bg-white rounded">
                    @csrf

                    <section class="flex items-center gap-2">
                        <span class="eos-icons--admin w-8 h-8"></span>
                        <h1 class="text-xl font-bold">ADMIN LOGIN</h1>
                    </section>

                    <section class="flex flex-col gap-1 w-full">
                        <label for="username">Username</label>
                        <input value="{{ old('username') }}" type="text" name="username" id="username"
                            @class([
                                'w-full border px-3 py-2',
                                'border-red-500' => $errors->has('username'),
                            ])>
                        @error('username')
                            <p class="text-red-500 font-semibold tracking-wider text-sm select-none">{{ $message }}</p>
                        @enderror
                    </section>

                    <section class="flex flex-col gap-1 w-full">
                        <label for="password">Password</label>
                        <input value="{{ old('password') }}" type="password" name="password" id="password"
                            @class([
                                'w-full border px-3 py-2',
                                'border-red-500' => $errors->has('password'),
                            ])>
                        @error('password')
                            <p class="text-red-500 font-semibold tracking-wider text-sm select-none">{{ $message }}
                            </p>
                        @enderror
                    </section>

                    <section class="w-full">
                        <button type="submit"
                            class="rounded bg-black hover:bg-black/80 text-white w-full px-4 py-2 font-semibold">Login</button>
                    </section>
                </form>
            </div>
        </main>
    @endif
</x-main-layout>
