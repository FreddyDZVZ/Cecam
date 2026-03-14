<div class="space-y-6">
    <div class="rounded-3xl bg-white shadow-lg border border-[#eadfcd] p-6">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <h1 class="text-3xl font-extrabold text-[#14533f]">Usuarios</h1>
                <p class="mt-2 text-[#5f665f]">
                    Administra los accesos al sistema y asigna roles.
                </p>
            </div>

            <div class="flex flex-col sm:flex-row gap-3">
                <input
                    type="text"
                    wire:model.live.debounce.300ms="search"
                    placeholder="Buscar por nombre, correo o rol..."
                    class="w-full sm:w-80 h-11 rounded-xl border border-[#ddcfb3] bg-[#f9f5ee] px-4 text-[#32433a] placeholder:text-[#b3ab9a] shadow-sm focus:outline-none focus:ring-2 focus:ring-[#176347] focus:border-[#176347] transition"
                >

                <button
                    type="button"
                    wire:click="openCreateModal"
                    class="h-11 px-5 rounded-xl bg-[#176347] hover:bg-[#124f39] text-white font-semibold shadow-md transition"
                >
                    Nuevo usuario
                </button>
            </div>
        </div>
    </div>

    <div class="rounded-3xl bg-white shadow-lg border border-[#eadfcd] overflow-hidden">
        <div class="hidden md:block overflow-x-auto">
            <table class="min-w-full">
                <thead class="bg-[#f7f2e9] border-b border-[#eadfcd]">
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-bold text-[#14533f]">Nombre</th>
                        <th class="px-6 py-4 text-left text-sm font-bold text-[#14533f]">Correo</th>
                        <th class="px-6 py-4 text-left text-sm font-bold text-[#14533f]">Rol</th>
                        <th class="px-6 py-4 text-left text-sm font-bold text-[#14533f]">Estatus</th>
                        <th class="px-6 py-4 text-right text-sm font-bold text-[#14533f]">Acciones</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-[#f0e6d7]">
                    @forelse ($users as $user)
                        <tr wire:key="user-{{ $user->id }}" class="hover:bg-[#fcfaf6] transition">
                            <td class="px-6 py-4">
                                <p class="font-semibold text-[#2f3b35]">{{ $user->name }}</p>
                            </td>

                            <td class="px-6 py-4 text-[#5f665f]">
                                {{ $user->email }}
                            </td>

                            <td class="px-6 py-4 text-[#5f665f]">
                                {{ $user->role?->name ?? 'Sin rol' }}
                            </td>

                            <td class="px-6 py-4">
                                @if ($user->is_active)
                                    <span class="inline-flex items-center rounded-full bg-green-100 px-3 py-1 text-xs font-bold text-green-700">
                                        Activo
                                    </span>
                                @else
                                    <span class="inline-flex items-center rounded-full bg-rose-100 px-3 py-1 text-xs font-bold text-rose-700">
                                        Inactivo
                                    </span>
                                @endif
                            </td>

                            <td class="px-6 py-4">
                                <div class="flex justify-end gap-2 flex-wrap">
                                    <button
                                        type="button"
                                        wire:click="openEditModal({{ $user->id }})"
                                        class="px-4 py-2 rounded-xl bg-amber-500 hover:bg-amber-400 text-white text-sm font-semibold transition"
                                    >
                                        Editar
                                    </button>

                                    <button
                                        type="button"
                                        x-data="{}"
                                        x-on:click="
                                            Swal.fire({
                                                title: '{{ $user->is_active ? '¿Desactivar usuario?' : '¿Activar usuario?' }}',
                                                text: 'Se modificará el estatus de {{ addslashes($user->name) }}.',
                                                icon: 'warning',
                                                showCancelButton: true,
                                                confirmButtonText: 'Sí, continuar',
                                                cancelButtonText: 'Cancelar',
                                                reverseButtons: true,
                                                confirmButtonColor: '#176347',
                                                cancelButtonColor: '#9ca3af'
                                            }).then((result) => {
                                                if (result.isConfirmed) {
                                                    $wire.toggleStatus({{ $user->id }})
                                                }
                                            })
                                        "
                                        class="px-4 py-2 rounded-xl {{ $user->is_active ? 'bg-rose-600 hover:bg-rose-500' : 'bg-emerald-600 hover:bg-emerald-500' }} text-white text-sm font-semibold transition"
                                    >
                                        {{ $user->is_active ? 'Desactivar' : 'Activar' }}
                                    </button>

                                    <button
                                        type="button"
                                        x-data="{}"
                                        x-on:click="
                                            Swal.fire({
                                                title: '¿Eliminar usuario?',
                                                text: 'Esta acción eliminará a {{ addslashes($user->name) }} de forma permanente.',
                                                icon: 'warning',
                                                showCancelButton: true,
                                                confirmButtonText: 'Sí, eliminar',
                                                cancelButtonText: 'Cancelar',
                                                reverseButtons: true,
                                                confirmButtonColor: '#dc2626',
                                                cancelButtonColor: '#9ca3af'
                                            }).then((result) => {
                                                if (result.isConfirmed) {
                                                    $wire.deleteUser({{ $user->id }})
                                                }
                                            })
                                        "
                                        class="px-4 py-2 rounded-xl bg-red-700 hover:bg-red-600 text-white text-sm font-semibold transition"
                                    >
                                        Eliminar
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-[#7c7f79]">
                                No se encontraron usuarios.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="md:hidden divide-y divide-[#f0e6d7]">
            @forelse ($users as $user)
                <div wire:key="user-mobile-{{ $user->id }}" class="p-4 space-y-3">
                    <div>
                        <p class="font-bold text-[#2f3b35]">{{ $user->name }}</p>
                        <p class="text-sm text-[#5f665f]">{{ $user->email }}</p>
                    </div>

                    <div class="flex flex-wrap gap-2">
                        <span class="inline-flex items-center rounded-full bg-[#f3ede2] px-3 py-1 text-xs font-semibold text-[#5f665f]">
                            {{ $user->role?->name ?? 'Sin rol' }}
                        </span>

                        @if ($user->is_active)
                            <span class="inline-flex items-center rounded-full bg-green-100 px-3 py-1 text-xs font-bold text-green-700">
                                Activo
                            </span>
                        @else
                            <span class="inline-flex items-center rounded-full bg-rose-100 px-3 py-1 text-xs font-bold text-rose-700">
                                Inactivo
                            </span>
                        @endif
                    </div>

                    <div class="grid grid-cols-1 gap-2">
                        <button
                            type="button"
                            wire:click="openEditModal({{ $user->id }})"
                            class="w-full px-4 py-2 rounded-xl bg-amber-500 hover:bg-amber-400 text-white text-sm font-semibold transition"
                        >
                            Editar
                        </button>

                        <button
                            type="button"
                            x-data="{}"
                            x-on:click="
                                Swal.fire({
                                    title: '{{ $user->is_active ? '¿Desactivar usuario?' : '¿Activar usuario?' }}',
                                    text: 'Se modificará el estatus de {{ addslashes($user->name) }}.',
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonText: 'Sí, continuar',
                                    cancelButtonText: 'Cancelar',
                                    reverseButtons: true,
                                    confirmButtonColor: '#176347',
                                    cancelButtonColor: '#9ca3af'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        $wire.toggleStatus({{ $user->id }})
                                    }
                                })
                            "
                            class="w-full px-4 py-2 rounded-xl {{ $user->is_active ? 'bg-rose-600 hover:bg-rose-500' : 'bg-emerald-600 hover:bg-emerald-500' }} text-white text-sm font-semibold transition"
                        >
                            {{ $user->is_active ? 'Desactivar' : 'Activar' }}
                        </button>

                        <button
                            type="button"
                            x-data="{}"
                            x-on:click="
                                Swal.fire({
                                    title: '¿Eliminar usuario?',
                                    text: 'Esta acción eliminará a {{ addslashes($user->name) }} de forma permanente.',
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonText: 'Sí, eliminar',
                                    cancelButtonText: 'Cancelar',
                                    reverseButtons: true,
                                    confirmButtonColor: '#dc2626',
                                    cancelButtonColor: '#9ca3af'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        $wire.deleteUser({{ $user->id }})
                                    }
                                })
                            "
                            class="w-full px-4 py-2 rounded-xl bg-red-700 hover:bg-red-600 text-white text-sm font-semibold transition"
                        >
                            Eliminar
                        </button>
                    </div>
                </div>
            @empty
                <div class="p-6 text-center text-[#7c7f79]">
                    No se encontraron usuarios.
                </div>
            @endforelse
        </div>

        <div class="px-4 py-4 border-t border-[#eadfcd] bg-[#fcfaf6]">
            {{ $users->links() }}
        </div>
    </div>

    @if ($showModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 px-4">
            <div class="w-full max-w-2xl rounded-3xl bg-white border border-[#eadfcd] shadow-2xl overflow-hidden">
                <div class="px-6 py-5 border-b border-[#eadfcd] bg-[#f7f2e9] flex items-center justify-between">
                    <div>
                        <h2 class="text-2xl font-extrabold text-[#14533f]">
                            {{ $editingId ? 'Editar usuario' : 'Nuevo usuario' }}
                        </h2>
                        <p class="mt-1 text-sm text-[#5f665f]">
                            Completa la información del usuario.
                        </p>
                    </div>

                    <button
                        type="button"
                        wire:click="closeModal"
                        class="h-10 w-10 rounded-full bg-white border border-[#eadfcd] text-[#14533f] font-bold hover:bg-[#f3ede2] transition"
                    >
                        ✕
                    </button>
                </div>

                <form wire:submit="save" class="p-6 space-y-5">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-[#2f3b35] mb-2">
                                Nombre
                            </label>
                            <input
                                type="text"
                                wire:model.defer="name"
                                class="w-full h-11 rounded-xl border border-[#ddcfb3] bg-[#f9f5ee] px-4 text-[#32433a] shadow-sm focus:outline-none focus:ring-2 focus:ring-[#176347] focus:border-[#176347] transition"
                            >
                            @error('name')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-[#2f3b35] mb-2">
                                Correo
                            </label>
                            <input
                                type="email"
                                wire:model.defer="email"
                                class="w-full h-11 rounded-xl border border-[#ddcfb3] bg-[#f9f5ee] px-4 text-[#32433a] shadow-sm focus:outline-none focus:ring-2 focus:ring-[#176347] focus:border-[#176347] transition"
                            >
                            @error('email')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-[#2f3b35] mb-2">
                                Contraseña
                            </label>
                            <input
                                type="password"
                                wire:model.defer="password"
                                class="w-full h-11 rounded-xl border border-[#ddcfb3] bg-[#f9f5ee] px-4 text-[#32433a] shadow-sm focus:outline-none focus:ring-2 focus:ring-[#176347] focus:border-[#176347] transition"
                            >
                            @error('password')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            @if ($editingId)
                                <p class="mt-2 text-xs text-[#7c7f79]">
                                    Déjala vacía si no quieres cambiarla.
                                </p>
                            @endif
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-[#2f3b35] mb-2">
                                Confirmar contraseña
                            </label>
                            <input
                                type="password"
                                wire:model.defer="password_confirmation"
                                class="w-full h-11 rounded-xl border border-[#ddcfb3] bg-[#f9f5ee] px-4 text-[#32433a] shadow-sm focus:outline-none focus:ring-2 focus:ring-[#176347] focus:border-[#176347] transition"
                            >
                            @error('password_confirmation')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-[#2f3b35] mb-2">
                                Rol
                            </label>
                            <select
                                wire:model.defer="role_id"
                                class="w-full h-11 rounded-xl border border-[#ddcfb3] bg-[#f9f5ee] px-4 text-[#32433a] shadow-sm focus:outline-none focus:ring-2 focus:ring-[#176347] focus:border-[#176347] transition"
                            >
                                <option value="">Selecciona un rol</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                            @error('role_id')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center gap-3 pt-8">
                            <input
                                type="checkbox"
                                id="is_active"
                                wire:model.defer="is_active"
                                class="h-4 w-4 rounded border-[#cbbd9e] text-[#176347] focus:ring-[#176347]"
                            >
                            <label for="is_active" class="text-sm font-medium text-[#3f4a45]">
                                Usuario activo
                            </label>
                        </div>
                    </div>

                    <div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-3 pt-2">
                        <button
                            type="button"
                            wire:click="closeModal"
                            class="h-11 px-5 rounded-xl border border-[#d9cab0] bg-white text-[#5f665f] font-semibold hover:bg-[#f7f2e9] transition"
                        >
                            Cancelar
                        </button>

                        <button
                            type="submit"
                            class="h-11 px-5 rounded-xl bg-[#176347] hover:bg-[#124f39] text-white font-semibold shadow-md transition"
                        >
                            {{ $editingId ? 'Actualizar usuario' : 'Guardar usuario' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
