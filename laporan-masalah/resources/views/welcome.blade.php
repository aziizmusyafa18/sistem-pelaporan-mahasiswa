<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/TextPlugin.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    </head>
    <body class="antialiased bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-200">
        <header class="w-full p-6">
            @if (Route::has('login'))
                <nav class="flex items-center justify-end gap-4">
                    @auth
                        <a
                            href="{{ url('/dashboard') }}"
                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                        >
                            Dashboard
                        </a>
                    @else
                        <a
                            href="{{ route('login') }}"
                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                        >
                            Log in
                        </a>

                        @if (Route::has('register'))
                            <a
                                href="{{ route('register') }}"
                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                            >
                                Register
                            </a>
                        @endif
                    @endauth
                </nav>
            @endif
        </header>

        <main class="flex-grow">
            <!-- hero section -->
            <section class="bg-white dark:bg-gray-900">
                <div class="grid max-w-screen-xl px-4 py-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12">
                    <div class="mr-auto place-self-center lg:col-span-7">
                        <h1 class="max-w-2xl mb-4 text-4xl font-extrabold tracking-tight leading-none md:text-5xl xl:text-6xl dark:text-white gsap-animate-heading">Sistem Pelaporan Masalah Mahasiswa</h1>
                        <p id="typing-text" class="max-w-2xl mb-6 font-light text-gray-500 lg:mb-8 md:text-lg lg:text-xl dark:text-gray-400 gsap-animate-text"></p>
                        <a href="#how-it-works" class="inline-flex items-center justify-center px-5 py-3 mr-3 text-base font-medium text-center text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:focus:ring-primary-900 gsap-animate-buttons">
                            Mulai
                            <svg class="w-5 h-5 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </a>
                        <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-5 py-3 text-base font-medium text-center text-gray-900 border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 dark:text-white dark:border-gray-700 dark:hover:bg-gray-700 dark:focus:ring-gray-800 gsap-animate-buttons">
                            Daftar
                        </a>
                    </div>
                    <div class="hidden lg:mt-0 lg:col-span-5 lg:flex">
                        <img src="{{ asset('img/hero.png') }}" alt="mockup" class="gsap-animate-image">
                    </div>
                </div>
            </section>
            <!-- end hero -->

            <!-- how it work -->
             <section id="how-it-works" class="bg-gray-50 py-12 sm:py-16 lg:py-20 xl:py-24 gsap-animate-how-it-works">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div class="text-center">
                        <p class="text-sm font-bold uppercase tracking-widest text-gray-700">How It Works</p>
                        <h2 class="mt-6 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl lg:text-5xl">Buat Laporan Dengan 4 Langkah Mudah
                        </h2>
                        <p class="mx-auto mt-4 max-w-2xl text-lg font-normal text-gray-700 lg:text-xl lg:leading-8">
                            Silahkan Ikuti Alur Dibawah Ini Untuk Membuat Laporan Masalah Anda
                        </p>
                    </div>
                    <ul class="mx-auto mt-12 grid max-w-md grid-cols-1 gap-10 sm:mt-16 lg:mt-20 lg:max-w-5xl lg:grid-cols-4">
                        <li class="flex-start group relative flex lg:flex-col gsap-animate-step">
                            <span
                                class="absolute left-[18px] top-14 h-[calc(100%_-_32px)] w-px bg-gray-300 lg:right-0 lg:left-auto lg:top-[18px] lg:h-px lg:w-[calc(100%_-_72px)]"
                                aria-hidden="true"></span>
                            <div
                                class="inline-flex h-10 w-10 shrink-0 items-center justify-center rounded-xl border border-gray-300 bg-gray-50 transition-all duration-200 group-hover:border-gray-900 group-hover:bg-gray-900">
                                <i class="bi bi-box-arrow-in-right text-2xl text-gray-600 group-hover:text-white"></i>
                            </div>
                            <div class="ml-6 lg:ml-0 lg:mt-10">
                                <h3
                                    class="text-xl font-bold text-gray-900 before:mb-2 before:block before:font-mono before:text-sm before:text-gray-500">
                                    Login Akun Anda
                                </h3>
                                <h4 class="mt-2 text-base text-gray-700">Silahkan login Dengan Akun Yang Telah Disediakan DPA</h4>
                            </div>
                        </li>
                        <li class="flex-start group relative flex lg:flex-col gsap-animate-step">
                            <span
                                class="absolute left-[18px] top-14 h-[calc(100%_-_32px)] w-px bg-gray-300 lg:right-0 lg:left-auto lg:top-[18px] lg:h-px lg:w-[calc(100%_-_72px)]"
                                aria-hidden="true"></span>
                            <div
                                class="inline-flex h-10 w-10 shrink-0 items-center justify-center rounded-xl border border-gray-300 bg-gray-50 transition-all duration-200 group-hover:border-gray-900 group-hover:bg-gray-900">
                                <i class="bi bi-pencil-square text-2xl text-gray-600 group-hover:text-white"></i>
                            </div>
                            <div class="ml-6 lg:ml-0 lg:mt-10">
                                <h3
                                    class="text-xl font-bold text-gray-900 before:mb-2 before:block before:font-mono before:text-sm before:text-gray-500">
                                    Laporkan Masalah Anda
                                </h3>
                                <h4 class="mt-2 text-base text-gray-700">Silahkan Isi Judul Laporan Dan Deskripsi Masalah Anda</h4>
                            </div>
                        </li>
                        <li class="flex-start group relative flex lg:flex-col gsap-animate-step">
                            <span
                                class="absolute left-[18px] top-14 h-[calc(100%_-_32px)] w-px bg-gray-300 lg:right-0 lg:left-auto lg:top-[18px] lg:h-px lg:w-[calc(100%_-_72px)]"
                                aria-hidden="true"></span>
                            <div
                                class="inline-flex h-10 w-10 shrink-0 items-center justify-center rounded-xl border border-gray-300 bg-gray-50 transition-all duration-200 group-hover:border-gray-900 group-hover:bg-gray-900">
                                <i class="bi bi-hourglass-split text-2xl text-gray-600 group-hover:text-white"></i>
                            </div>
                            <div class="ml-6 lg:ml-0 lg:mt-10">
                                <h3
                                    class="text-xl font-bold text-gray-900 before:mb-2 before:block before:font-mono before:text-sm before:text-gray-500">
                                    Laporan Diproses
                                </h3>
                                <h4 class="mt-2 text-base text-gray-700">Admin/DPA Akan Segera Meninjau Dan Memberikan Tanggapan Masalah Anda</h4>
                            </div>
                        </li>
                        <li class="flex-start group relative flex lg:flex-col gsap-animate-step">
                            <div
                                class="inline-flex h-10 w-10 shrink-0 items-center justify-center rounded-xl border border-gray-300 bg-gray-50 transition-all duration-200 group-hover:border-gray-900 group-hover:bg-gray-900">
                                <i class="bi bi-check2-circle text-2xl text-gray-600 group-hover:text-white"></i>
                            </div>
                            <div class="ml-6 lg:ml-0 lg:mt-10">
                                <h3
                                    class="text-xl font-bold text-gray-900 before:mb-2 before:block before:font-mono before:text-sm before:text-gray-500">
                                    Masalah Selesai
                                </h3>
                                <h4 class="mt-2 text-base text-gray-700">Silahkan Cek Halaman Secara Berkala Untuk Mengetahui Update Tanggapan Laporan Dari DPA/Admin</h4>
                            </div>
                        </li>
                    </ul>
                    <div class="text-center mt-12">
                        <a href="{{ route('login') }}" class="inline-block px-8 py-3 text-base font-medium text-center text-white bg-blue-500 border border-blue-700 rounded-full hover:bg-blue-600 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900 gsap-animate-report-button">
                            Ajukan Laporan
                        </a>
                    </div>
                </div>
            </section>
            <!-- how it work end-->

            <!-- features -->
            <div class="py-12 bg-gray-50 items-center justify-center sm:px-10 lg:px-10 lg:py-20">
                <div class="max-w-xl px-4 mx-auto sm:px-6 lg:max-w-screen-xl lg:px-8">
                    <div>
                    <h3 class="text-3xl font-extrabold leading-8 tracking-tight text-center text-gray-900 sm:text-4xl sm:leading-10 gsap-animate-features-title">
                        Fitur Unggulan Kami
                    </h3>
                    <p class="max-w-3xl mx-auto mt-4 text-xl leading-7 text-center text-gray-500 gsap-animate-features-title">
                        Nikmati kemudahan pelaporan masalah dengan fitur-fitur yang kami tawarkan.
                    </p>
                    </div>

                    <div class="mt-12 lg:grid lg:grid-cols-3 lg:gap-8">
                    <div class="gsap-animate-feature-item">
                        <div class="flex items-center justify-center w-12 h-12 text-white bg-indigo-500 rounded-md">
                        <i class="bi bi-bar-chart-steps text-2xl"></i>
                        </div>
                        <div class="mt-5">
                        <h5 class="text-lg font-medium leading-6 text-gray-900">Pelacakan Status</h5>
                        <p class="mt-2 text-base leading-6 text-gray-600">
                            Pantau progres laporan Anda secara real-time.
                        </p>
                        </div>
                    </div>
                    <div class="mt-10 lg:mt-0 gsap-animate-feature-item">
                        <div class="flex items-center justify-center w-12 h-12 text-white bg-indigo-500 rounded-md">
                        <i class="bi bi-tags text-2xl"></i>
                        </div>
                        <div class="mt-5">
                        <h5 class="text-lg font-medium leading-6 text-gray-900">Kategori Jelas</h5>
                        <p class="mt-2 text-base leading-6 text-gray-600">
                            Laporkan masalah spesifik mulai dari akademik, fasilitas, hingga layanan.
                        </p>
                        </div>
                    </div>
                    <div class="mt-10 lg:mt-0 gsap-animate-feature-item">
                        <div class="flex items-center justify-center w-12 h-12 text-white bg-indigo-500 rounded-md">
                        <i class="bi bi-chat-left-text text-2xl"></i>
                        </div>
                        <div class="mt-5">
                        <h5 class="text-lg font-medium leading-6 text-gray-900">Tanggapan Terstruktur</h5>
                        <p class="mt-2 text-base leading-6 text-gray-600">
                            Dapatkan balasan dan solusi langsung dari pihak Admin/DPA.
                        </p>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            <!-- features end -->
        </main>

        <script>
            gsap.registerPlugin(ScrollTrigger, TextPlugin);

            gsap.to(".gsap-animate-heading", { duration: 1, x: 0, opacity: 1, ease: "power4.out" });
            gsap.to("#typing-text", { duration: 4, text: "Laporkan masalah akademik dan non-akademik Anda dengan mudah dan cepat. Silahkan login untuk mulai melaporkan masalah.", ease: "none", delay: 0.2 });
            gsap.to(".gsap-animate-buttons", { duration: 1.5, y: 0, opacity: 1, ease: "bounce.out", delay: 0.4, stagger: 0.2 });
            gsap.to(".gsap-animate-image", { duration: 1, x: 0, opacity: 1, ease: "power4.out", delay: 0.6 });

            gsap.set(".gsap-animate-step", { opacity: 0, y: 50 });
            document.querySelectorAll(".gsap-animate-step").forEach((step, index) => {
                gsap.to(step, {
                    scrollTrigger: {
                        trigger: "#how-it-works",
                        start: "top 70%",
                        toggleActions: "play none none none"
                    },
                    duration: 1,
                    y: 0,
                    opacity: 1,
                    delay: index * 0.3,
                    ease: "power4.out"
                });
            });

            gsap.set(".gsap-animate-report-button", { opacity: 0, y: 50 });
            gsap.to(".gsap-animate-report-button", {
                scrollTrigger: {
                    trigger: ".gsap-animate-report-button",
                    start: "top 90%",
                    toggleActions: "play none none none"
                },
                duration: 1.5,
                y: 0,
                opacity: 1,
                ease: "bounce.out"
            });

            gsap.set(".gsap-animate-features-title", { opacity: 0, y: 50 });
            gsap.to(".gsap-animate-features-title", {
                scrollTrigger: {
                    trigger: ".gsap-animate-features-title",
                    start: "top 80%",
                    toggleActions: "play none none none"
                },
                duration: 1,
                y: 0,
                opacity: 1,
                stagger: 0.2,
                ease: "power4.out"
            });

            gsap.set(".gsap-animate-feature-item", { opacity: 0, y: 50 });
            gsap.to(".gsap-animate-feature-item", {
                scrollTrigger: {
                    trigger: ".gsap-animate-feature-item",
                    start: "top 80%",
                    toggleActions: "play none none none"
                },
                duration: 2,
                y: 0,
                opacity: 1,
                stagger: 0.2,
                ease: "power4.out"
            });
        </script>
    </body>
</html>