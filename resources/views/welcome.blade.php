<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>PSB SMK Teknologi Obi</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-100 text-slate-800">

<!-- HERO -->
<section class="relative h-[90vh] flex items-center">
    <!-- Background Image -->
    <img src="{{ asset('smk1.jpg') }}"
         class="absolute inset-0 w-full h-full object-cover"
         alt="SMK Teknologi Obi">

    <!-- Overlay -->
    <div class="absolute inset-0 bg-slate-900/70"></div>

    <!-- Content -->
    <div class="relative max-w-6xl mx-auto px-6 text-center text-white">
        <h1 class="text-4xl md:text-5xl font-bold font-inter leading-tight">
            Selamat Datang Di Sistem
        </h1>
        <h1 class="text-4xl font inter md:text-5xl font-bold leading-tight">
            Penerimaan Siswa Baru
        </h1>
        <p class="mt-4 text-lg opacity-90">
            SMK Teknologi Obi
        </p>

        <div class="mt-8 flex justify-center gap-4">
            <a href="{{ route('login') }}"
               class="px-6 py-3 rounded-xl bg-white text-slate-900 font-semibold">
                Login
            </a>

            <a href="{{ route('register') }}"
               class="px-6 py-3 rounded-xl border border-white/40 hover:bg-white/10">
                Daftar Sekarang
            </a>
        </div>
    </div>
</section>


<!-- INFO SEKOLAH -->
<section class="max-w-6xl mx-auto px-6 py-20 grid md:grid-cols-2 gap-10 items-center">
    <div>
        <h2 class="text-2xl font-bold">
            Lingkungan Belajar Profesional
        </h2>
        <p class="mt-4 text-slate-600">
            SMK Teknologi Obi berkomitmen mencetak lulusan siap kerja
            dengan fasilitas modern dan pengajar berpengalaman.
        </p>
    </div>

    <img src="{{ asset('belajar.jpg') }}"
         class="rounded-2xl shadow-lg"
         alt="Kegiatan belajar">
</section>


<!-- ALUR PENDAFTARAN -->
<section class="bg-white py-16">
    <div class="max-w-6xl mx-auto px-6">
        <h2 class="text-2xl font-bold text-center">
            Alur Pendaftaran
        </h2>

        <div class="grid md:grid-cols-4 gap-6 mt-10 text-center">
            @foreach(['Daftar Akun','Lengkapi Data','Upload Berkas','Verifikasi'] as $step)
                <div class="p-4">
                    <div class="w-12 h-12 mx-auto rounded-full
                                bg-slate-900 text-white
                                flex items-center justify-center font-bold">
                        {{ $loop->iteration }}
                    </div>
                    <p class="mt-3 text-sm font-medium">{{ $step }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- JURUSAN -->
<section class="bg-slate-100 py-20">
    <div class="max-w-6xl mx-auto px-6">
        <h2 class="text-2xl font-bold text-center">
            Pilihan Jurusan
        </h2>

        <div class="grid md:grid-cols-3 gap-6 mt-10">
            <!-- TKJ -->
            <div class="bg-white rounded-2xl shadow overflow-hidden">
                <img src="{{ asset('tkj.jpg') }}"
                     class="h-40 w-full object-cover">
                <div class="p-5">
                    <h3 class="font-semibold">
                        TKJ
                    </h3>
                    <p class="text-sm text-slate-600 mt-1">
                        Teknik Komputer dan Jaringan
                    </p>
                </div>
            </div>

            <!-- MM -->
            <div class="bg-white rounded-2xl shadow overflow-hidden">
                <img src="{{ asset('multimedia.jpg') }}"
                     class="h-40 w-full object-cover">
                <div class="p-5">
                    <h3 class="font-semibold">
                        Multimedia
                    </h3>
                    <p class="text-sm text-slate-600 mt-1">
                        Desain & Konten Digital
                    </p>
                </div>
            </div>

            <!-- OTKP -->
            <div class="bg-white rounded-2xl shadow overflow-hidden">
                <img src="{{ asset('otkp.jpg') }}"
                     class="h-40 w-full object-cover">
                <div class="p-5">
                    <h3 class="font-semibold">
                        OTKP
                    </h3>
                    <p class="text-sm text-slate-600 mt-1">
                        Administrasi Perkantoran Modern
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- CTA -->
<section class="bg-slate-900 text-white py-16 text-center">
    <h2 class="text-2xl font-bold">
        Ayo Daftar Sekarang
    </h2>
    <p class="mt-2 text-sm opacity-80">
        Pendaftaran dibuka untuk Tahun Ajaran berjalan
    </p>

    <a href="{{ route('register') }}"
       class="inline-block mt-6 px-8 py-3 bg-white text-slate-900 rounded-xl font-semibold">
        Mulai Pendaftaran
    </a>
</section>

</body>
</html>
