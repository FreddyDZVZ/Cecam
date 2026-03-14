<div class="min-h-screen bg-[#f5f1e8] flex items-center justify-center px-4 py-8">
    <div class="w-full max-w-7xl rounded-[28px] overflow-hidden shadow-2xl bg-[#f3ede2] border border-[#e7dcc7]">
        <div class="grid grid-cols-1 lg:grid-cols-[1.08fr_1fr] min-h-[720px]">

            {{-- Panel izquierdo con imagen --}}
            <div class="relative hidden lg:block">
                <img
                    src="{{ asset('images/login/cecam-login.jpg') }}"
                    alt="CECAM"
                    class="absolute inset-0 w-full h-full object-cover"
                >

                <div class="absolute inset-0 bg-gradient-to-t from-[#0f5a43]/85 via-[#0f5a43]/20 to-transparent"></div>

                <div class="absolute inset-x-0 bottom-0 p-10 xl:p-12 text-white">
                    <h1 class="text-6xl xl:text-7xl font-extrabold tracking-tight leading-none drop-shadow-lg">
                        CECAM
                    </h1>

                    <p class="mt-4 text-xl xl:text-2xl font-semibold leading-snug max-w-xl drop-shadow">
                        Centro de capacitación musical
                        <br>
                        y desarrollo de la cultura mixe
                    </p>
                </div>
            </div>

            {{-- Panel derecho --}}
            <div class="relative bg-[#f4efe5] flex items-center justify-center px-6 py-10 sm:px-10 lg:px-14 overflow-hidden">
                {{-- Fondo decorativo sutil --}}
                <div class="absolute inset-0 pointer-events-none">
                    <div class="absolute -bottom-10 -left-10 w-72 h-72 rounded-full bg-[#e6d6ba]/35 blur-3xl"></div>
                    <div class="absolute -top-10 -right-10 w-72 h-72 rounded-full bg-[#dcd0bb]/30 blur-3xl"></div>

                    <svg class="absolute bottom-0 left-0 w-72 h-72 opacity-10" viewBox="0 0 300 300" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M70 270C88 226 121 193 153 173C135 199 122 231 119 270" stroke="#7A5B3A" stroke-width="3" stroke-linecap="round"/>
                        <path d="M90 245C97 222 111 202 129 187" stroke="#7A5B3A" stroke-width="3" stroke-linecap="round"/>
                        <path d="M118 214C129 203 141 197 156 193" stroke="#7A5B3A" stroke-width="3" stroke-linecap="round"/>
                        <path d="M62 222C76 214 91 211 108 213" stroke="#7A5B3A" stroke-width="3" stroke-linecap="round"/>
                    </svg>

                    <svg class="absolute top-0 right-0 w-72 h-72 opacity-10 rotate-180" viewBox="0 0 300 300" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M70 270C88 226 121 193 153 173C135 199 122 231 119 270" stroke="#7A5B3A" stroke-width="3" stroke-linecap="round"/>
                        <path d="M90 245C97 222 111 202 129 187" stroke="#7A5B3A" stroke-width="3" stroke-linecap="round"/>
                        <path d="M118 214C129 203 141 197 156 193" stroke="#7A5B3A" stroke-width="3" stroke-linecap="round"/>
                        <path d="M62 222C76 214 91 211 108 213" stroke="#7A5B3A" stroke-width="3" stroke-linecap="round"/>
                    </svg>
                </div>

                <div class="relative z-10 w-full max-w-xl">
                    {{-- Logo/título móvil --}}
                    <div class="lg:hidden mb-8 text-center">
                        <h1 class="text-4xl font-extrabold text-[#14533f] tracking-tight">CECAM</h1>
                        <p class="mt-2 text-sm text-[#5e6d63]">
                            Centro de capacitación musical y desarrollo de la cultura mixe
                        </p>
                    </div>

                    <div class="text-center mb-8">
                        <h2 class="text-4xl sm:text-5xl font-extrabold text-[#14533f] tracking-tight">
                            Iniciar sesión
                        </h2>
                        <p class="mt-3 text-[#5c6b62] text-sm sm:text-base font-medium">
                            Ingresa tus datos para continuar.
                        </p>
                    </div>

                    <div class="rounded-[28px] border border-[#e7d8bb] bg-[#f6f1e8]/95 shadow-[0_15px_40px_rgba(0,0,0,0.08)] px-6 py-7 sm:px-8 sm:py-8">
                        <form wire:submit="login" class="space-y-6">
                            <div>
                                <label for="email" class="block text-sm font-semibold text-[#2f3b35] mb-2">
                                    Correo
                                </label>

                                <input
                                    type="email"
                                    id="email"
                                    wire:model.defer="email"
                                    placeholder="Correo"
                                    class="w-full h-12 rounded-full border border-[#ddcfb3] bg-[#f9f5ee] px-5 text-[#32433a] placeholder:text-[#b3ab9a] shadow-sm focus:outline-none focus:ring-2 focus:ring-[#176347] focus:border-[#176347] transition"
                                >

                                @error('email')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="password" class="block text-sm font-semibold text-[#2f3b35] mb-2">
                                    Contraseña
                                </label>

                                <input
                                    type="password"
                                    id="password"
                                    wire:model.defer="password"
                                    placeholder="Contraseña"
                                    class="w-full h-12 rounded-full border border-[#ddcfb3] bg-[#f9f5ee] px-5 text-[#32433a] placeholder:text-[#b3ab9a] shadow-sm focus:outline-none focus:ring-2 focus:ring-[#176347] focus:border-[#176347] transition"
                                >

                                @error('password')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex items-center gap-3">
                                <input
                                    type="checkbox"
                                    id="remember"
                                    wire:model="remember"
                                    class="h-4 w-4 rounded border-[#cbbd9e] text-[#176347] focus:ring-[#176347]"
                                >
                                <label for="remember" class="text-sm font-medium text-[#3f4a45]">
                                    Recordarme
                                </label>
                            </div>

                            <button
                                type="submit"
                                class="w-full h-12 rounded-xl bg-[#176347] hover:bg-[#124f39] text-white font-bold text-lg shadow-md transition duration-200"
                            >
                                Entrar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>