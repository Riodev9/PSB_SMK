<section class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            Perbarui Kata Sandi
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            Pastikan akun Anda menggunakan kata sandi yang panjang dan acak agar tetap aman.
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <label for="update_password_current_password"
                   class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                Kata Sandi Saat Ini
            </label>

            <input id="update_password_current_password"
                   name="current_password"
                   type="password"
                   autocomplete="current-password"
                   class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600
                          dark:bg-gray-700 text-gray-900 dark:text-gray-100 shadow-sm
                          focus:ring focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />

            @error('current_password')
                <p class="mt-2 text-xs text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="update_password_password"
                   class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                Kata Sandi Baru
            </label>

            <input id="update_password_password"
                   name="password"
                   type="password"
                   autocomplete="new-password"
                   class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600
                          dark:bg-gray-700 text-gray-900 dark:text-gray-100 shadow-sm
                          focus:ring focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />

            @error('password')
                <p class="mt-2 text-xs text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="update_password_password_confirmation"
                   class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                Konfirmasi Kata Sandi
            </label>

            <input id="update_password_password_confirmation"
                   name="password_confirmation"
                   type="password"
                   autocomplete="new-password"
                   class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600
                          dark:bg-gray-700 text-gray-900 dark:text-gray-100 shadow-sm
                          focus:ring focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />

            @error('password_confirmation')
                <p class="mt-2 text-xs text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center gap-4">
            <button type="submit"
                    class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition">
                Simpan
            </button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }"
                   x-show="show"
                   x-transition
                   x-init="setTimeout(() => show = false, 2000)"
                   class="text-sm text-gray-600 dark:text-gray-400">
                    Berhasil disimpan.
                </p>
            @endif
        </div>
    </form>
</section>
