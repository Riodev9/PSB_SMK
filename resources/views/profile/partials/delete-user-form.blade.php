<section class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            Hapus Akun
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            Setelah akun Anda dihapus, seluruh data dan sumber daya yang terkait akan dihapus secara permanen.
            Sebelum melanjutkan, silakan unduh atau simpan data yang masih ingin Anda pertahankan.
        </p>
    </header>

    <!-- Trigger Button -->
    <button
        x-data="{}"
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition"
    >
        Hapus Akun
    </button>

    <!-- Modal -->
    <div
        x-data="{ open: {{ $errors->userDeletion->isNotEmpty() ? 'true' : 'false' }} }"
        x-show="open"
        x-transition
        class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
    >
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg max-w-lg w-full p-6 space-y-4">
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                Apakah Anda yakin ingin menghapus akun?
            </h2>

            <p class="text-sm text-gray-600 dark:text-gray-400">
                Tindakan ini akan menghapus seluruh data akun Anda secara permanen.
                Untuk melanjutkan, silakan masukkan kata sandi Anda sebagai konfirmasi.
            </p>

            <form method="POST" action="{{ route('profile.destroy') }}" class="space-y-4">
                @csrf
                @method('delete')

                <div>
                    <label for="password" class="sr-only">Kata Sandi</label>
                    <input
                        id="password"
                        name="password"
                        type="password"
                        placeholder="Kata Sandi"
                        class="mt-1 block w-full md:w-3/4 rounded-md border-gray-300
                               dark:border-gray-600 dark:bg-gray-700
                               text-gray-900 dark:text-gray-100 shadow-sm
                               focus:ring focus:ring-red-500 focus:border-red-500 sm:text-sm"
                    />
                    @error('password')
                        <p class="mt-2 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end gap-3 mt-4">
                    <button
                        type="button"
                        x-on:click="open = false"
                        class="px-4 py-2 bg-gray-300 dark:bg-gray-600 rounded-md
                               hover:bg-gray-400 dark:hover:bg-gray-500 transition">
                        Batal
                    </button>

                    <button
                        type="submit"
                        class="px-4 py-2 bg-red-600 text-white rounded-md
                               hover:bg-red-700 transition">
                        Hapus Akun
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
