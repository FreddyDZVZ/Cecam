<aside class="hidden lg:flex lg:w-72 xl:w-80 bg-[#14533f] text-white min-h-screen flex-col shadow-2xl">
    <div class="px-6 py-8 border-b border-white/10">
        <h1 class="text-3xl font-extrabold tracking-tight">CECAM</h1>
        <p class="mt-2 text-sm text-white/80 leading-relaxed">
            Centro de capacitación musical y desarrollo de la cultura mixe
        </p>
    </div>

    <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
        <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
            Dashboard
        </x-nav-link>

        @if (auth()->user()?->isAdmin())
            <x-nav-link href="{{ route('usuarios.index') }}" :active="request()->routeIs('usuarios.*')">
                Usuarios
            </x-nav-link>
        @endif

        <x-nav-link href="#" :active="false">
            Roles
        </x-nav-link>

        <x-nav-link href="#" :active="false">
            Alumnos
        </x-nav-link>

        <x-nav-link href="#" :active="false">
            Maestros
        </x-nav-link>

        <x-nav-link href="#" :active="false">
            Materias
        </x-nav-link>

        <x-nav-link href="#" :active="false">
            Reportes
        </x-nav-link>
    </nav>

    <div class="px-4 py-6 border-t border-white/10">
        <div class="rounded-2xl bg-white/10 p-4">
            <p class="text-sm text-white/80">Sesión iniciada</p>
            <p class="mt-1 font-semibold">{{ auth()->user()?->name }}</p>
            <p class="text-sm text-white/70">{{ auth()->user()?->role?->name ?? 'Sin rol' }}</p>
        </div>
    </div>
</aside>
