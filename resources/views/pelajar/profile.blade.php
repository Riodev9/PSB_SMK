@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-6">
        Profile
    </h1>

    <div class="space-y-6">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="max-w-xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="max-w-xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="max-w-xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
@endsection
                        <!-- Pilih Jurusan --> 
                        <div> 
                            <label class="text-sm text-slate-700">Pilih Jurusan</label> 
                            <select name="jurusan" class="w-full mt-1 px-4 py-2 rounded-xl
                             bg-white/70 backdrop-blur border border-slate-300 text-slate-800 focus:outline-none focus:ring-2
                              focus:ring-slate-400"> 
                                <option value="">-- Pilih Jurusan --</option> 
                                <option value="TKJ (Teknik Komputer dan Jaringan)">
                                TKJ (Teknik Komputer dan Jaringan)</option>
                                <option value="MM (Multimedia)">MM (Multimedia)</option>
                                <option value="OTKP (Otomatisasi Tata Kelola Perkantoran)">
                                OTKP (Otomatisasi Tata Kelola Perkantoran)</option>
                            </select> @error('jurusan') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror </div> 
                        <!-- Upload Ijazah --> 
                        <div>
                            <label class="text-sm text-slate-700">Fotocopy Ijazah / SKL</label>
                            <input type="file" name="ijazah" class="w-full mt-1 px-3 py-2 rounded-xl
                            bg-white/70 backdrop-blur border border-slate-300 text-slate-700">
                            @error('ijazah') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror </div> 
                        <!-- Upload KK --> 
                        <div> 