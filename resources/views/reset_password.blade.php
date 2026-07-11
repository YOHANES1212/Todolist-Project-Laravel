<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Reset Password - {{ config('app.name', 'Laravel') }}</title>
        @php
            $viteHot = file_exists(public_path('hot'));
            $viteManifest = file_exists(public_path('build/manifest.json'));
        @endphp

        @if ($viteHot || $viteManifest)
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        @endif
        <style>
            html, body { opacity: 0; transition: opacity 180ms ease-in; }
            noscript body { opacity: 1 !important; }
        </style>
    </head>
    <body class="min-h-screen bg-gradient-to-br from-[#ff6256] via-[#ff7b76] to-[#ff9690] text-slate-900">
        <div class="min-h-screen flex items-center justify-center px-4 py-10">
            <div class="relative w-full max-w-[480px] overflow-hidden rounded-[2rem] bg-white/95 shadow-[0_45px_120px_rgba(0,0,0,0.18)] backdrop-blur-sm ring-1 ring-white/60">
                <div class="absolute -right-20 top-8 h-56 w-56 rounded-full bg-white/20 blur-3xl"></div>
                <div class="absolute -left-16 bottom-10 h-56 w-56 rounded-full bg-[#ffffff]/15 blur-3xl"></div>

                <div class="relative flex flex-col gap-6 px-8 py-12 sm:px-12">
                    <div class="space-y-3">
                        <h1 class="text-3xl font-semibold tracking-tight text-slate-900">Reset Password</h1>
                        <p class="max-w-sm text-sm text-slate-500">Masukkan password baru untuk akun kamu.</p>
                    </div>

                    @if ($errors->any())
                        <div class="rounded-2xl bg-red-50 px-4 py-3 text-sm text-red-600">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <form action="{{ route('password.update') }}" method="POST" class="space-y-5">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="space-y-2">
                            <label for="email" class="sr-only">Email</label>
                            <div class="relative">
                                <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="3" y="5" width="18" height="14" rx="2" />
                                        <path d="m3 7 9 6 9-6" />
                                    </svg>
                                </span>
                                <input id="email" name="email" type="email" value="{{ old('email', $email) }}" placeholder="Enter Email" required class="w-full rounded-2xl border border-slate-200 bg-[#F8F8F8] py-3 pl-12 pr-4 text-sm text-slate-900 outline-none transition focus:border-[#ff5d5a] focus:ring-2 focus:ring-[#ff5d5a]/15" />
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label for="password" class="sr-only">Password Baru</label>
                            <div class="relative">
                                <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="3" y="11" width="18" height="11" rx="2" />
                                        <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                                    </svg>
                                </span>
                                <input id="password" name="password" type="password" placeholder="Password Baru" required minlength="8" class="w-full rounded-2xl border border-slate-200 bg-[#F8F8F8] py-3 pl-12 pr-4 text-sm text-slate-900 outline-none transition focus:border-[#ff5d5a] focus:ring-2 focus:ring-[#ff5d5a]/15" />
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label for="password_confirmation" class="sr-only">Konfirmasi Password</label>
                            <div class="relative">
                                <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="3" y="11" width="18" height="11" rx="2" />
                                        <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                                    </svg>
                                </span>
                                <input id="password_confirmation" name="password_confirmation" type="password" placeholder="Konfirmasi Password" required class="w-full rounded-2xl border border-slate-200 bg-[#F8F8F8] py-3 pl-12 pr-4 text-sm text-slate-900 outline-none transition focus:border-[#ff5d5a] focus:ring-2 focus:ring-[#ff5d5a]/15" />
                            </div>
                        </div>

                        <button type="submit" class="inline-flex w-full items-center justify-center rounded-2xl bg-[#ff5d5a] px-6 py-3 text-sm font-semibold text-white transition hover:bg-[#ff4340] focus:outline-none focus:ring-2 focus:ring-[#ff5d5a]/50">Reset Password</button>
                    </form>

                    <p class="text-center text-sm text-slate-500"><a href="{{ route('login') }}" class="font-semibold text-[#ff5d5a] hover:text-[#ff3f3a]">&larr; Kembali ke Sign In</a></p>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                document.documentElement.style.opacity = '1';
                document.body.style.opacity = '1';
            });
        </script>
    </body>
</html>
