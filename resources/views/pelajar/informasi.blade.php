@extends('layouts.halaman')

@section('content')
<div class="p-6">
    @if($informasi->isEmpty())
        <!-- EMPTY STATE -->
        <div class="flex flex-col items-center justify-center
                    text-center py-16 bg-white rounded-2xl
                    border border-dashed border-gray-300">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-gray-400 mb-4" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                      d="M9 12h6m-6 4h6M9 8h6m3 12H6a2 2 0 01-2-2V6a2 2 0 012-2h7l5 5v11a2 2 0 01-2 2z"/>
            </svg>

            <h3 class="text-gray-700 font-semibold text-lg">
                Belum ada informasi
            </h3>
            <p class="text-gray-500 text-sm mt-1">
                Informasi PSB akan ditampilkan di sini jika sudah tersedia.
            </p>
        </div>
    @else
        <!-- CARD LIST -->
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-1">
            @foreach($informasi as $info)
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100
                            hover:shadow-md transition duration-200">

                    <!-- Header -->
                    <div class="px-5 pt-5 pb-3 border-b">
                        <h3 class="font-semibold text-gray-800 text-lg leading-snug">
                            {{ $info->judul }}
                        </h3>
                        <p class="text-xs text-gray-400 mt-1">
                            {{ $info->created_at->format('d M Y') }}
                        </p>
                    </div>

                    <!-- Body -->
                    <div class="px-5 py-4">
                        <p class="text-gray-600 text-sm leading-relaxed
                                  whitespace-pre-line line-clamp-5">
                            {{ $info->isi }}
                        </p>
                    </div>

                    <!-- Footer -->
                    <div class="px-5 pb-4 text-right">
                        <span class="inline-block text-xs bg-blue-50 text-blue-600
                                     px-3 py-1 rounded-full">
                            Informasi PSB
                        </span>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection