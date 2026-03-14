<nav class="h-20 bg-[#f4efe5] border-b border-[#e5d9c8] px-4 sm:px-6 lg:px-8 flex items-center justify-between">
    <div>
        <h2 class="text-2xl font-bold text-[#14533f]">Panel principal</h2>
        <p class="text-sm text-[#6a6d67]">Bienvenido al sistema CECAM</p>
    </div>

    <div class="flex items-center gap-4">
        <div class="hidden sm:block text-right">
            <p class="text-sm font-semibold text-[#2f3b35]">{{ auth()->user()?->name }}</p>
            <p class="text-xs text-[#6a6d67]">{{ auth()->user()?->role?->name ?? 'Sin rol' }}</p>
        </div>

        <div class="h-11 w-11 rounded-full bg-[#14533f] text-white flex items-center justify-center font-bold">
            {{ strtoupper(substr(auth()->user()?->name ?? 'U', 0, 1)) }}
        </div>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button
                type="submit"
                class="rounded-xl bg-red-600 hover:bg-red-500 text-white px-4 py-2 text-sm font-semibold transition"
            >
                Salir
            </button>
        </form>
    </div>
</nav>
