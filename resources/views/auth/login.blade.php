<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center
                bg-cover bg-center"
         style="background-image: url('{{ asset('9781.jpg') }}')">

        <!-- overlay -->
        <div class="absolute inset-0 bg-slate-800/40 "></div>

        <!-- card -->
        <div class="relative w-full max-w-md
                    bg-white/10 backdrop-blur-2xl
                    border border-white/20
                    rounded-2xl shadow-2xl
                    p-8">

            <!-- title -->
            <h2 class="text-2xl font-bold text-white text-center">
                Login Akun
            </h2>
            <p class="text-sm text-white/80 text-center mt-1">
                Sistem Penerimaan Siswa Baru
            </p>

            <!-- Session Status -->
            <x-auth-session-status
                class="mt-4 text-emerald-200"
                :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="mt-6 space-y-4">
                @csrf

                <!-- Email -->
                <div>
                    <x-input-label for="email"
                                   class="text-white"
                                   :value="__('Email')" />

                    <x-text-input
                        id="email"
                        class="block mt-1 w-full
                               bg-white/20 border border-white/30
                               text-white placeholder-white/60
                               focus:border-white focus:ring-white"
                        type="email"
                        name="email"
                        :value="old('email')"
                        autofocus autocomplete="username" />

                    <x-input-error
                        :messages="$errors->get('email')"
                        class="mt-1 text-red-300" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password"
                                   class="text-white"
                                   :value="__('Password')" />

                    <x-text-input
                        id="password"
                        class="block mt-1 w-full
                               bg-white/20 border border-white/30
                               text-white placeholder-white/60
                               focus:border-white focus:ring-white"
                        type="password"
                        name="password"
                        autocomplete="current-password" />

                    <x-input-error
                        :messages="$errors->get('password')"
                        class="mt-1 text-red-300" />
                </div>

                <!-- Remember -->
                <div class="flex items-center">
                    <input id="remember_me"
                           type="checkbox"
                           name="remember"
                           class="rounded border-white/30 bg-white/20
                                  text-white focus:ring-white">

                    <label for="remember_me"
                           class="ml-2 text-sm text-white/80">
                        {{ __('Remember me') }}
                    </label>
                </div>

                <!-- Action -->
                <div class="flex items-center justify-between mt-4">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}"
                           class="text-sm text-white/80 hover:text-white">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif

                    <x-primary-button
                        class="bg-white text-slate-900
                               hover:bg-white/90
                               rounded-xl px-6 py-2">
                        {{ __('Login') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>

