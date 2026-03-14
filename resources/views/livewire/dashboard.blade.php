<div class="space-y-6">
    <div class="rounded-3xl bg-white shadow-lg border border-[#eadfcd] p-6">
        <h1 class="text-3xl font-extrabold text-[#14533f]">Dashboard</h1>

        <p class="mt-2 text-[#5f665f]">
            Bienvenido,
            <span class="font-semibold">{{ $user->name }}</span>
        </p>

        <p class="mt-1 text-sm text-[#7c7f79]">
            Rol: {{ $user->role?->name ?? 'Sin rol' }}
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">
        <div class="rounded-3xl bg-white shadow-md border border-[#eadfcd] p-6">
            <p class="text-sm text-[#6e746d]">Usuarios</p>
            <p class="mt-2 text-3xl font-extrabold text-[#14533f]">120</p>
        </div>

        <div class="rounded-3xl bg-white shadow-md border border-[#eadfcd] p-6">
            <p class="text-sm text-[#6e746d]">Alumnos</p>
            <p class="mt-2 text-3xl font-extrabold text-[#14533f]">86</p>
        </div>

        <div class="rounded-3xl bg-white shadow-md border border-[#eadfcd] p-6">
            <p class="text-sm text-[#6e746d]">Maestros</p>
            <p class="mt-2 text-3xl font-extrabold text-[#14533f]">14</p>
        </div>

        <div class="rounded-3xl bg-white shadow-md border border-[#eadfcd] p-6">
            <p class="text-sm text-[#6e746d]">Materias</p>
            <p class="mt-2 text-3xl font-extrabold text-[#14533f]">24</p>
        </div>
    </div>
</div>
