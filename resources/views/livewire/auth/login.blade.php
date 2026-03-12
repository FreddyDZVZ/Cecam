<div class="min-h-screen bg-slate-100 flex items-center justify-center px-4">
    <div class="w-full max-w-md bg-white rounded-2xl shadow-xl p-8">
        <div class="mb-6 text-center">
            <h1 class="text-2xl font-bold text-slate-800">Iniciar sesión</h1>
            <p class="text-sm text-slate-500 mt-2">Accede al sistema CECAM</p>
        </div>

        <form wire:submit="login" class="space-y-5">
            <div>
                <label for="email" class="block text-sm font-medium text-slate-700 mb-1">
                    Correo electrónico
                </label>
                <input
                    type="email"
                    id="email"
                    wire:model="email"
                    class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-600"
                    placeholder="correo@ejemplo.com"
                >
                @error('email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-slate-700 mb-1">
                    Contraseña
                </label>
                <input
                    type="password"
                    id="password"
                    wire:model="password"
                    class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-600"
                    placeholder="********"
                >
                @error('password')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center gap-2">
                <input
                    type="checkbox"
                    id="remember"
                    wire:model="remember"
                    class="rounded border-slate-300 text-blue-600 focus:ring-blue-500"
                >
                <label for="remember" class="text-sm text-slate-600">
                    Recordarme
                </label>
            </div>

            <button
                type="submit"
                class="w-full rounded-xl bg-blue-800 hover:bg-blue-700 text-white font-medium py-3 transition"
            >
                Entrar
            </button>
        </form>
    </div>
</div>