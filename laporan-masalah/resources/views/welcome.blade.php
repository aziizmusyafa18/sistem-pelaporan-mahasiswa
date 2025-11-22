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
        <main class="flex-grow">
            <!-- hero section -->
            <section class="relative h-screen flex items-center justify-center text-center bg-gray-900" style="mask-image: linear-gradient(rgba(0, 0, 0, 1) 80%, rgba(0, 0, 0, 0));">
                <header class="absolute top-0 left-0 w-full p-6 z-20">
                    @if (Route::has('login'))
                        <nav class="flex items-center justify-end gap-2 bg-transparent">
                            @auth
                                <a
                                    href="{{ url('/dashboard') }}"
                                    class="rounded-md px-3 py-2 text-white ring-1 ring-transparent transition hover:text-white/80 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                                >
                                    Dashboard
                                </a>
                            @else
                                <a
                                    href="{{ route('login') }}"
                                    class="rounded-md px-3 py-2 text-white ring-1 ring-transparent transition hover:text-white/80 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                                >
                                    Log in
                                </a>
        
                                @if (Route::has('register'))
                                    <a
                                        href="{{ route('register') }}"
                                        class="rounded-md px-3 py-2 text-white ring-1 ring-transparent transition hover:text-white/80 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                                    >
                                        Register
                                    </a>
                                @endif
                            @endauth
                        </nav>
                    @endif
                </header>
                <img src="{{ asset('img/logo.png') }}" alt="Background" class="absolute inset-0 w-full h-full object-cover">
                <div class="absolute inset-0 bg-black opacity-50"></div>
                <div class="relative z-10 px-4">
                    <h1 class="max-w-2xl mb-4 text-4xl font-extrabold tracking-tight leading-none md:text-5xl xl:text-6xl text-white gsap-animate-heading">Sistem Pelaporan Masalah Mahasiswa</h1>
                    <p id="typing-text" class="max-w-2xl mb-6 font-light text-gray-300 lg:mb-8 md:text-lg lg:text-xl dark:text-gray-400 gsap-animate-text"></p>
                    <a href="#how-it-works" class="inline-flex items-center justify-center px-5 py-3 mr-3 text-base font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900 gsap-animate-buttons">
                        Mulai
                        <svg class="w-5 h-5 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </a>
                    <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-5 py-3 text-base font-medium text-center text-white border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-900 focus:ring-4 focus:ring-gray-100 dark:border-gray-700 dark:hover:bg-gray-700 dark:focus:ring-gray-800 gsap-animate-buttons">
                        Daftar
                    </a>
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

            <!-- Footer -->
             <footer class="bg-white dark:bg-gray-900">
                <div class="container px-6 py-8 mx-auto">
                    <div class="flex flex-col items-center text-center">
                        <a href="#">
                            <img class="block w-auto h-24" src="{{ asset('img/logo.png') }}" alt="">
                        </a>
                        <h1 class="mt-4 text-xl font-semibold text-gray-700 dark:text-gray-200">Sistem Pelaporan Masalah Mahasiswa</h1>
                        <p>Institut Teknologi Al Mahrusiyah</p>

                    </div>

                    <hr class="my-6 border-gray-200 md:my-10 dark:border-gray-700" />

                    <div class="flex flex-col items-center sm:flex-row sm:justify-between">
                        <p class="text-sm text-gray-500 dark:text-gray-300">© Copyright 2025. By aziizmusyafa18 All Rights Reserved.</p>

                        <div class="flex -mx-2">
                            <a href="#" class="mx-2 text-gray-600 transition-colors duration-300 dark:text-gray-300 hover:text-blue-500 dark:hover:text-blue-400" aria-label="Website">
                                <svg xmlns="http://www.w3.org/2000/svg" width="auto" height="20" fill="currentColor" class="bi bi-globe" viewBox="0 0 16 16">
                                    <path d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m7.5-6.923c-.67.204-1.335.82-1.887 1.855A8 8 0 0 0 5.145 4H7.5zM4.09 4a9.3 9.3 0 0 1 .64-1.539 7 7 0 0 1 .597-.933A7.03 7.03 0 0 0 2.255 4zm-.582 3.5c.03-.877.138-1.718.312-2.5H1.674a7 7 0 0 0-.656 2.5zM4.847 5a12.5 12.5 0 0 0-.338 2.5H7.5V5zM8.5 5v2.5h2.99a12.5 12.5 0 0 0-.337-2.5zM4.51 8.5a12.5 12.5 0 0 0 .337 2.5H7.5V8.5zm3.99 0V11h2.653c.187-.765.306-1.608.338-2.5zM5.145 12q.208.58.468 1.068c.552 1.035 1.218 1.65 1.887 1.855V12zm.182 2.472a7 7 0 0 1-.597-.933A9.3 9.3 0 0 1 4.09 12H2.255a7 7 0 0 0 3.072 2.472M3.82 11a13.7 13.7 0 0 1-.312-2.5h-2.49c.062.89.291 1.733.656 2.5zm6.853 3.472A7 7 0 0 0 13.745 12H11.91a9.3 9.3 0 0 1-.64 1.539 7 7 0 0 1-.597.933M8.5 12v2.923c.67-.204 1.335-.82 1.887-1.855q.26-.487.468-1.068zm3.68-1h2.146c.365-.767.594-1.61.656-2.5h-2.49a13.7 13.7 0 0 1-.312 2.5m2.802-3.5a7 7 0 0 0-.656-2.5H12.18c.174.782.282 1.623.312 2.5zM11.27 2.461c.247.464.462.98.64 1.539h1.835a7 7 0 0 0-3.072-2.472c.218.284.418.598.597.933M10.855 4a8 8 0 0 0-.468-1.068C9.835 1.897 9.17 1.282 8.5 1.077V4z"/>
                                </svg>
                            </a>

                            <a href="https://www.instagram.com/aziizzz18/" class="mx-2 text-gray-600 transition-colors duration-300 dark:text-gray-300 hover:text-blue-500 dark:hover:text-blue-400" aria-label="Instagram">
                                <svg xmlns="http://www.w3.org/2000/svg" width="auto" height="20" fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
                                    <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92m-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217m0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334"/>
                                </svg>
                            </a>

                            <a href="https://github.com/aziizmusyafa18" class="mx-2 text-gray-600 transition-colors duration-300 dark:text-gray-300 hover:text-blue-500 dark:hover:text-blue-400" aria-label="Github">
                                <svg xmlns="http://www.w3.org/2000/svg" width="auto" height="20" fill="currentColor" class="bi bi-github" viewBox="0 0 16 16">
                                    <path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27s1.36.09 2 .27c1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.01 8.01 0 0 0 16 8c0-4.42-3.58-8-8-8"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- Footer end -->
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