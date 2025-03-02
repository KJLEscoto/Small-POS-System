<x-main-layout>
    @if (session('success'))
        <x-flash-msg msg="success" />
    @elseif (session('invalid'))
        <x-flash-msg msg="invalid" />
    @elseif (session('update'))
        <x-flash-msg msg="update" />
    @endif

    <form action="{{ route('cashiers.update', $cashier->username) }}" method="POST" enctype="multipart/form-data"
        class="flex flex-col gap-5 p-10 bg-white/80 shadow-md rounded">
        @csrf
        @method('PUT')

        <div class="w-full flex justify-between items-end gap-5">
            <h1 class="text-lg font-bold">Edit Cashier</h1>
            <section class="flex items-center gap-3">
                <a href="{{ route('cashiers.show', $cashier->username) }}"
                    class="px-5 py-2 text-black rounded border border-gray-300 hover:border-black">
                    <div class="w-auto h-auto flex items-center gap-2">
                        <span class="mingcute--close-line w-4 h-4"></span>
                        <p class="text-nowrap">Cancel</p>
                    </div>
                </a>
                <button type="submit" class="px-5 py-2 rounded bg-blue-500 hover:bg-blue-600 text-white">
                    <div class="w-auto h-auto flex items-center gap-2">
                        <p class="text-nowrap">Save Changes</p>
                        <span class="bxs--save w-4 h-4"></span>
                    </div>
                </button>
            </section>
        </div>

        <hr>

        <div class="w-full flex flex-col gap-5 items-center justify-center mt-5">
            <div class="w-auto h-auto">
                <div class="w-60 h-60 bg-gray-200 rounded-full overflow-hidden">
                    @if ($cashier->image)
                        <img id="imagePreview" class="w-full h-full object-cover"
                            src="{{ asset('storage/' . $cashier->image) }}" />
                    @else
                        <img id="imagePreview" class="w-full h-full object-cover"
                            src="{{ asset('storage/user_images/default-user.jpg') }}" />
                    @endif
                </div>
            </div>
            <input type="file" name="image" accept="image/*" id="imageInput"
                class="border rounded p-2 w-full max-w-xs text-sm file:border-none file:bg-gray-100 file:px-3 file:py-1.5 file:rounded file:text-blue-600 file:cursor-pointer cursor-pointer">

            @error('image')
                <p class="text-red-500 font-semibold tracking-wider text-sm select-none">
                    {{ $message }}
                </p>
            @enderror
        </div>

        <h1 class="font-semibold text-xl">Personal Information</h1>
        <div class="grid grid-cols-3 gap-5">
            <section class="flex flex-col gap-1 w-full">
                <label class="font-medium">First Name</label>
                <input @class([
                    'w-full border px-3 py-2',
                    'border-red-500' => $errors->has('first_name'),
                ]) type="text" name="first_name" value="{{ $cashier->first_name }}">
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
                ]) type="text" name="last_name" value="{{ $cashier->last_name }}">
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
                ]) type="text" name="middle_name"
                    value="{{ $cashier->middle_name }}">
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
                    <option disabled {{ $cashier->gender ? '' : 'selected' }}>Select</option>
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
                    value="{{ \Carbon\Carbon::parse($cashier->date_of_birth)->format('Y-m-d') }}"
                    max="{{ date('Y-m-d') }}">

                @error('date_of_birth')
                    <p class="text-red-500 font-semibold tracking-wider text-sm select-none">
                        {{ $message }}
                    </p>
                @enderror
            </section>
        </div>

        <div class="grid grid-cols-2 gap-5">
            <section class="flex flex-col gap-1 w-full">
                <label class="font-medium">Role</label>
                <input readonly @class([
                    'w-full border px-3 py-2 read-only:bg-gray-100 read-only:cursor-not-allowed',
                    'border-red-500' => $errors->has('role'),
                ]) type="text" name="role"
                    value="{{ $cashier->role }}">
                @error('role')
                    <p class="text-red-500 font-semibold tracking-wider text-sm select-none">
                        {{ $message }}
                    </p>
                @enderror
            </section>
            <section class="flex flex-col gap-1 w-full">
                <label class="font-medium">Status</label>
                <select name="status" id="status" @class([
                    'w-full border px-3 py-2',
                    'border-red-500' => $errors->has('status'),
                ])>
                    <option disabled {{ $cashier->status ? '' : 'selected' }}>Select</option>
                    @php
                        $statuses = ['active' => 'Active', 'inactive' => 'Inactive'];
                    @endphp

                    @foreach ($statuses as $key => $value)
                        <option value="{{ $key }}" {{ $cashier->status == $key ? 'selected' : '' }}>
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
        </div>

        <hr class="mt-3">

        <h1 class="font-semibold text-xl">Account Details</h1>
        <div class="grid grid-cols-2 gap-5">
            <section class="flex flex-col gap-1 w-full">
                <label class="font-medium">Username</label>
                <input @class([
                    'w-full border px-3 py-2',
                    'border-red-500' => $errors->has('username'),
                ]) type="text" name="username" value="{{ $cashier->username }}">
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
                ]) type="email" name="email" value="{{ $cashier->email }}">
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
                ]) type="password" name="password">
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
                ]) type="password" name="password_confirmation">
                @error('password_confirmation')
                    <p class="text-red-500 font-semibold tracking-wider text-sm select-none">
                        {{ $message }}
                    </p>
                @enderror
            </section>
        </div>
    </form>

    <script>
        document.getElementById('imageInput').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('imagePreview').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
</x-main-layout>
