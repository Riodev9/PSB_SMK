<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center
                bg-cover bg-center relative"
         style="background-image: url('{{ asset('9781.jpg') }}')">

        <!-- overlay -->
        <div class="absolute inset-0 bg-slate-800/40"></div>

        <!-- card -->
        <div class="relative w-full max-w-md
                    bg-white/10 backdrop-blur-2xl
                    border border-white/20
                    rounded-2xl shadow-2xl
                    p-8">

            <!-- title -->
            <h2 class="text-2xl font-bold text-white text-center">
                Daftar Akun
            </h2>
            <p class="text-sm text-white/80 text-center mt-1">
                Sistem Penerimaan Siswa Baru
            </p>

            <form method="POST"
                  action="{{ route('register') }}"
                  class="mt-6 space-y-4">
                @csrf

                <!-- Name -->
                <div>
                    <x-input-label for="name"
                                   class="text-white"
                                   :value="__('Nama')" />

                    <x-text-input
                        id="name"
                        class="block mt-1 w-full
                               bg-white/20 border border-white/30
                               text-gray-700 placeholder-white/60
                               focus:border-white focus:ring-white"
                        type="text"
                        name="name"
                        :value="old('name')"
                        autofocus autocomplete="name" />

                    <x-input-error
                        :messages="$errors->get('name')"
                        class="mt-1 text-red-300" />
                </div>

                <!-- Email -->
                <div>
                    <x-input-label for="email"
                                   class="text-white"
                                   :value="__('Email')" />

                    <x-text-input
                        id="email"
                        class="block mt-1 w-full
                               bg-white/20 border border-white/30
                               text-gray-700 placeholder-white/60
                               focus:border-white focus:ring-white"
                        type="email"
                        name="email"
                        :value="old('email')"
                        autocomplete="username" />

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
                               text-gray-700 placeholder-white/60
                               focus:border-white focus:ring-white"
                        type="password"
                        name="password"
                        autocomplete="new-password" />

                    <x-input-error
                        :messages="$errors->get('password')"
                        class="mt-1 text-red-300" />
                </div>

                <!-- Confirm Password -->
                <div>
                    <x-input-label for="password_confirmation"
                                   class="text-white"
                                   :value="__('Confirm Password')" />

                    <x-text-input
                        id="password_confirmation"
                        class="block mt-1 w-full
                               bg-white/20 border border-white/30
                               text-gray-700 placeholder-white/60
                               focus:border-white focus:ring-white"
                        type="password"
                        name="password_confirmation"
                        autocomplete="new-password" />

                    <x-input-error
                        :messages="$errors->get('password_confirmation')"
                        class="mt-1 text-red-300" />
                </div>

                <!-- Action -->
                <div class="flex items-center justify-between mt-6">
                    <a href="{{ route('login') }}"
                       class="text-sm text-white/80 hover:text-white">
                        {{ __('Already registered?') }}
                    </a>

                    <x-primary-button
                        class="bg-white text-slate-900
                               hover:bg-white/90
                               rounded-xl px-6 py-2">
                        {{ __('Register') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
