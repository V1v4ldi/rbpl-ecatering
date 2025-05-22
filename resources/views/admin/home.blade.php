<x-layout>
    <div class="">ini halaman admin</div>
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="hover:opacity-80 hover:-translate-y-0.5 transition-all duration-300 cursor-pointer">
                <i class='text-3xl bx bx-log-out'></i>
        </button>
    </form>
</x-layout>