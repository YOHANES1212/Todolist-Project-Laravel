<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Sign In - {{ config('app.name', 'Laravel') }}</title>
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
            /* Prevent flash-of-unstyled-content while CSS loads */
            html, body { opacity: 0; transition: opacity 180ms ease-in; }
            noscript body { opacity: 1 !important; }
        </style>
    </head>
    <body class="min-h-screen bg-gradient-to-br from-[#ff6256] via-[#ff7b76] to-[#ff9690] text-slate-900">
        <div class="min-h-screen flex items-center justify-center px-4 py-10">
            <div class="relative w-full max-w-[1040px] overflow-hidden rounded-[2rem] bg-white/95 shadow-[0_45px_120px_rgba(0,0,0,0.18)] backdrop-blur-sm ring-1 ring-white/60">
                <div class="absolute -right-28 top-8 h-72 w-72 rounded-full bg-white/20 blur-3xl"></div>
                <div class="absolute -left-16 bottom-10 h-72 w-72 rounded-full bg-[#ffffff]/15 blur-3xl"></div>

                <div class="grid min-h-[540px] grid-cols-1 lg:grid-cols-[45%_55%]">
                    <div class="relative flex flex-col justify-center gap-6 bg-white px-8 py-12 sm:px-12 lg:px-14">
                        <div class="space-y-3">
                            <h1 class="text-4xl font-semibold tracking-tight text-slate-900">Sign In</h1>
                            <p class="max-w-sm text-sm text-slate-500">Login untuk melanjutkan ke aplikasi tugas dan kolaborasi Anda.</p>
                        </div>

                        <form action="#" method="POST" class="space-y-5">
                            @csrf
                            <div class="space-y-2">
                                <label for="username" class="sr-only">Username</label>
                                <div class="relative">
                                    <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                                            <circle cx="12" cy="7" r="4" />
                                        </svg>
                                    </span>
                                    <input id="username" name="username" type="text" placeholder="Enter Username" required class="w-full rounded-2xl border border-slate-200 bg-[#F8F8F8] py-3 pl-12 pr-4 text-sm text-slate-900 outline-none transition focus:border-[#ff5d5a] focus:ring-2 focus:ring-[#ff5d5a]/15" />
                                </div>
                            </div>

                            <div class="space-y-2">
                                <label for="password" class="sr-only">Password</label>
                                <div class="relative">
                                    <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                            <rect x="3" y="11" width="18" height="11" rx="2" />
                                            <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                                        </svg>
                                    </span>
                                    <input id="password" name="password" type="password" placeholder="Enter Password" required class="w-full rounded-2xl border border-slate-200 bg-[#F8F8F8] py-3 pl-12 pr-4 text-sm text-slate-900 outline-none transition focus:border-[#ff5d5a] focus:ring-2 focus:ring-[#ff5d5a]/15" />
                                </div>
                            </div>

                            <div class="flex items-center justify-between gap-4 text-sm text-slate-600">
                                <label class="inline-flex items-center gap-2">
                                    <input type="checkbox" class="h-4 w-4 rounded border-slate-300 text-[#ff5d5a] focus:ring-[#ff5d5a]" />
                                    Remember Me
                                </label>
                                <a href="#" class="font-medium text-[#ff5d5a] hover:text-[#ff3f3a]">Forgot password?</a>
                            </div>

                            <button type="submit" class="inline-flex w-full items-center justify-center rounded-2xl bg-[#ff5d5a] px-6 py-3 text-sm font-semibold text-white transition hover:bg-[#ff4340] focus:outline-none focus:ring-2 focus:ring-[#ff5d5a]/50">Login</button>
                        </form>

                        <div class="relative py-4">
                            <div class="absolute inset-x-0 top-1/2 h-px bg-slate-200"></div>
                            <p class="relative mx-auto inline-block bg-white px-3 text-sm text-slate-500">Or, login with</p>
                        </div>

                        <div class="flex items-center justify-center gap-4">
                            <a href="#" class="inline-flex h-12 w-12 items-center justify-center rounded-full border border-slate-200 bg-white text-[#3b5998] transition hover:bg-[#f7f7f7]">
                                <span class="sr-only">Login with Facebook</span>
                                <svg viewBox="0 0 24 24" class="h-5 w-5" fill="currentColor"><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 5 3.657 9.125 8.438 9.876v-6.987H7.898v-2.89h2.54V9.833c0-2.507 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.463h-1.26c-1.243 0-1.63.771-1.63 1.562v1.875h2.773l-.443 2.89h-2.33v6.987C18.343 21.125 22 17 22 12z"/></svg>
                            </a>
                            <a href="#" class="inline-flex h-12 w-12 items-center justify-center rounded-full border border-slate-200 bg-white text-[#de5246] transition hover:bg-[#f7f7f7]">
                                <span class="sr-only">Login with Google</span>
                                <svg viewBox="0 0 24 24" class="h-5 w-5" fill="currentColor"><path d="M21.35 11.1H12v2.8h5.35c-.24 1.3-.96 2.4-2.05 3.12v2.6h3.33c1.95-1.8 3.07-4.45 3.07-7.52 0-.53-.04-1.05-.12-1.55z"/><path d="M12 22c2.7 0 4.96-.9 6.61-2.46l-3.33-2.6c-.92.62-2.1.98-3.28.98-2.52 0-4.66-1.7-5.43-3.96H2.98v2.49C4.6 19.9 8.04 22 12 22z"/><path d="M6.57 13.96c-.2-.62-.32-1.28-.32-1.96s.12-1.34.32-1.96V7.55H2.98A9.993 9.993 0 0 0 2 12c0 1.6.38 3.1 1.05 4.45l3.52-2.49z"/><path d="M12 5.4c1.47 0 2.8.5 3.84 1.48l2.88-2.88C16.94 2.38 14.7 1.4 12 1.4 8.04 1.4 4.6 3.5 2.98 7.55l3.52 2.49C7.34 7.1 9.48 5.4 12 5.4z"/></svg>
                            </a>
                            <a href="#" class="inline-flex h-12 w-12 items-center justify-center rounded-full border border-slate-200 bg-white text-[#c13584] transition hover:bg-[#f7f7f7]">
                                <span class="sr-only">Login with Instagram</span>
                                <svg viewBox="0 0 24 24" class="h-5 w-5" fill="currentColor"><path d="M7.75 2h8.5A5.75 5.75 0 0 1 22 7.75v8.5A5.75 5.75 0 0 1 16.25 22h-8.5A5.75 5.75 0 0 1 2 16.25v-8.5A5.75 5.75 0 0 1 7.75 2zm0 1.5A4.25 4.25 0 0 0 3.5 7.75v8.5A4.25 4.25 0 0 0 7.75 20.5h8.5A4.25 4.25 0 0 0 20.5 16.25v-8.5A4.25 4.25 0 0 0 16.25 3.5h-8.5z"/><path d="M12 7a5 5 0 1 1 0 10 5 5 0 0 1 0-10zm0 1.5a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7zm5.5-.75a1.25 1.25 0 1 1 0 2.5 1.25 1.25 0 0 1 0-2.5z"/></svg>
                            </a>
                        </div>

                        <p class="text-center text-sm text-slate-500">Don't have an account? <a href="{{ route('register') }}" class="font-semibold text-[#ff5d5a] hover:text-[#ff3f3a]">Create One</a></p>
                    </div>

                    <div class="relative hidden overflow-hidden bg-[#ffebe9] p-8 lg:flex lg:flex-col lg:items-center lg:justify-center">
                        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,_rgba(255,255,255,0.75),_transparent_34%)]"></div>
                        <div class="relative z-10 flex h-full w-full flex-col items-center justify-center gap-6">
                            <div class="flex h-20 w-20 items-center justify-center rounded-full bg-white/90 text-[#ff5d5a] ring-2 ring-white/90 shadow-[0_18px_60px_rgba(255,91,88,0.16)]">
                                <svg class="h-9 w-9" viewBox="0 0 24 24" fill="currentColor"><path d="M9 11a3 3 0 1 1 6 0 3 3 0 0 1-6 0zm-4 9a7 7 0 0 1 14 0H5z"/></svg>
                            </div>

                            <div class="relative flex h-[420px] w-full max-w-[300px] items-center justify-center rounded-[2rem] bg-white p-6 shadow-[0_30px_70px_rgba(0,0,0,0.12)]">
                                <div class="absolute top-6 right-6 h-16 w-16 rounded-full bg-[#ff5d5a]/15 blur-2xl"></div>
                                <div class="absolute -bottom-8 left-4 h-16 w-16 rounded-full bg-[#ff5d5a]/15 blur-2xl"></div>
                                <div class="relative z-10 flex h-full w-full flex-col justify-between rounded-[1.8rem] border border-slate-200 bg-[#fef7f6] p-5">
                                    <div class="space-y-4">
                                        <div class="h-12 rounded-[1.2rem] bg-[#fff3f2]"></div>
                                        <div class="h-12 rounded-[1.2rem] bg-[#fff3f2]"></div>
                                        <div class="h-12 rounded-[1.2rem] bg-[#fff3f2]"></div>
                                    </div>
                                    <div class="flex items-center gap-4 rounded-[1.4rem] bg-[#fff] p-4 shadow-[0_24px_40px_rgba(0,0,0,0.06)]">
                                        <div class="flex h-12 w-12 items-center justify-center rounded-3xl bg-emerald-500 text-white">✓</div>
                                        <div>
                                            <p class="text-sm font-semibold text-slate-900">Secure login</p>
                                            <p class="text-xs text-slate-500">Your account is protected</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            // Reveal page after DOM is ready (prevents quick flash while Vite injects CSS)
            document.addEventListener('DOMContentLoaded', function () {
                document.documentElement.style.opacity = '1';
                document.body.style.opacity = '1';
            });
        </script>
    </body>
</html>
