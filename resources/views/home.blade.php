<x-main-layout>
    home

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">logout</button>
    </form>
</x-main-layout>
