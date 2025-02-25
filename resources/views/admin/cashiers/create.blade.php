<x-main-layout>
    <form action="{{ route('cashiers.store') }}" method="POST"
        class="flex flex-col gap-5 p-10 bg-white/80 shadow-md rounded">
        @csrf

        <input type="hidden" name="role" value="cashier">
        <input type="hidden" name="status" value="active">
        <input type="hidden" name="image" value="">

        <div class="flex items-end justify-between gap-5">
            <h1 class="text-lg font-bold">Cashier Registration</h1>
            <div class="flex items-center gap-3">
                <a href="{{ route('cashiers.index') }}"
                    class="px-5 py-2 text-black rounded border border-gray-300 hover:border-black">
                    <div class="w-auto h-auto flex items-center gap-2">
                        <span class="pajamas--go-back w-4 h-4"></span>
                        <p class="text-nowrap">Back</p>
                    </div>
                </a>
                <button type="submit" class="px-5 py-2 rounded bg-gray-700 hover:bg-gray-700/80 text-white">
                    <div class="w-auto h-auto flex items-center gap-2">
                        <p class="text-nowrap">Create Account</p>
                        <span class="gridicons--user-add w-5 h-5"></span>
                    </div>
                </button>
            </div>
        </div>

        <hr>

        <h1 class="font-semibold text-xl">Personal Information</h1>
        <div class="grid grid-cols-3 gap-5">
            <section class="flex flex-col gap-1 w-full">
                <label class="font-medium">First Name</label>
                <input @class([
                    'w-full border px-3 py-2',
                    'border-red-500' => $errors->has('first_name'),
                ]) type="text" name="first_name" value="{{ old('first_name') }}">
                @error('first_name')
                    <p class="text-red-500 font-semibold tracking-wider text-sm select-none">
                        {{ $message }}
                    </p>
                @enderror
            </section>
            <section class="flex flex-col gap-1 w-full">
                <label class="font-medium">Last Name</label>
                <input @class([
                    'w-full border px-3 py-2',
                    'border-red-500' => $errors->has('last_name'),
                ]) type="text" name="last_name" value="{{ old('last_name') }}">
                @error('last_name')
                    <p class="text-red-500 font-semibold tracking-wider text-sm select-none">
                        {{ $message }}
                    </p>
                @enderror
            </section>
            <section class="flex flex-col gap-1 w-full">
                <label class="font-medium">Middle Name</label>
                <input @class([
                    'w-full border px-3 py-2',
                    'border-red-500' => $errors->has('middle_name'),
                ]) type="text" name="middle_name" value="{{ old('middle_name') }}">
                @error('middle_name')
                    <p class="text-red-500 font-semibold tracking-wider text-sm select-none">
                        {{ $message }}
                    </p>
                @enderror
            </section>
        </div>

        <div class="grid grid-cols-2 gap-5">
            <section class="flex flex-col gap-1 w-full">
                <label class="font-medium">Gender</label>
                <input type="hidden" name="gender" value="">
                <select name="gender" id="gender" @class([
                    'w-full border px-3 py-2',
                    'border-red-500' => $errors->has('gender'),
                ])>
                    <option value="" disabled {{ old('gender') ? '' : 'selected' }}>Select</option>
                    @php
                        $genders = ['male' => 'Male', 'female' => 'Female'];
                    @endphp

                    @foreach ($genders as $key => $value)
                        <option value="{{ $key }}" {{ old('gender') == $key ? 'selected' : '' }}>
                            {{ $value }}
                        </option>
                    @endforeach
                </select>


                @error('gender')
                    <p class="text-red-500 font-semibold tracking-wider text-sm select-none">
                        {{ $message }}
                    </p>
                @enderror
            </section>

            <section class="flex flex-col gap-1 w-full">
                <label class="font-medium">Date of Birth</label>
                <input @class([
                    'w-full border px-3 py-1.5',
                    'border-red-500' => $errors->has('date_of_birth'),
                ]) type="date" name="date_of_birth"
                    value="{{ old('date_of_birth') }}" max="{{ date('Y-m-d') }}">
                @error('date_of_birth')
                    <p class="text-red-500 font-semibold tracking-wider text-sm select-none">
                        {{ $message }}
                    </p>
                @enderror
            </section>
        </div>

        <hr class="mt-3">

        <h1 class="font-semibold text-xl">Account Details</h1>
        <div class="grid grid-cols-2 gap-5">
            <section class="flex flex-col gap-1 w-full">
                <label class="font-medium">Username</label>
                <input @class([
                    'w-full border px-3 py-2',
                    'border-red-500' => $errors->has('username'),
                ]) type="text" name="username" value="{{ old('username') }}">
                @error('username')
                    <p class="text-red-500 font-semibold tracking-wider text-sm select-none">
                        {{ $message }}
                    </p>
                @enderror
            </section>
            <section class="flex flex-col gap-1 w-full">
                <label class="font-medium">Email</label>
                <input @class([
                    'w-full border px-3 py-2',
                    'border-red-500' => $errors->has('email'),
                ]) type="email" name="email" value="{{ old('email') }}">
                @error('email')
                    <p class="text-red-500 font-semibold tracking-wider text-sm select-none">
                        {{ $message }}
                    </p>
                @enderror
            </section>
        </div>

        <div class="grid grid-cols-2 gap-5">
            <section class="flex flex-col gap-1 w-full">
                <label class="font-medium">Password</label>
                <input @class([
                    'w-full border px-3 py-2',
                    'border-red-500' => $errors->has('password'),
                ]) type="password" name="password" value="{{ old('password') }}">
                @error('password')
                    <p class="text-red-500 font-semibold tracking-wider text-sm select-none">
                        {{ $message }}
                    </p>
                @enderror
            </section>
            <section class="flex flex-col gap-1 w-full">
                <label class="font-medium">Confirm Password</label>
                <input @class([
                    'w-full border px-3 py-2',
                    'border-red-500' => $errors->has('password_confirmation'),
                ]) type="password" name="password_confirmation"
                    value="{{ old('password_confirmation') }}">
                @error('password_confirmation')
                    <p class="text-red-500 font-semibold tracking-wider text-sm select-none">
                        {{ $message }}
                    </p>
                @enderror
            </section>
        </div>
    </form>
</x-main-layout>
