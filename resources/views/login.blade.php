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

                        @if ($errors->any())
                            <div class="rounded-2xl bg-red-50 px-4 py-3 text-sm text-red-600">
                                {{ $errors->first() }}
                            </div>
                        @endif

                        <form action="{{ route('login') }}" method="POST" class="space-y-5">
                            @csrf
                            <div class="space-y-2">
                                <label for="email" class="sr-only">Email</label>
                                <div class="relative">
                                    <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">
                                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                                            <circle cx="12" cy="7" r="4" />
                                        </svg>
                                    </span>
                                    <input id="email" name="email" type="email" value="{{ old('email') }}" placeholder="Enter Email" required class="w-full rounded-2xl border border-slate-200 bg-[#F8F8F8] py-3 pl-12 pr-4 text-sm text-slate-900 outline-none transition focus:border-[#ff5d5a] focus:ring-2 focus:ring-[#ff5d5a]/15" />
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
                                    <input type="checkbox" name="remember" class="h-4 w-4 rounded border-slate-300 text-[#ff5d5a] focus:ring-[#ff5d5a]" />
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
                            <a href="{{ route('auth.google') }}" class="inline-flex h-12 w-12 items-center justify-center rounded-full border border-slate-200 bg-white text-[#de5246] transition hover:bg-[#f7f7f7]">
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
                        <div class="relative z-10 flex h-full w-full items-center justify-center">
                            <svg viewBox="0 0 400 420" class="w-full max-w-[360px]" role="img" aria-label="Ilustrasi login aman">
                                <ellipse cx="200" cy="392" rx="150" ry="14" fill="#f7c9c3" opacity="0.6" />
                                <circle cx="196" cy="210" r="165" fill="#ffffff" opacity="0.55" />

                                <!-- lavender blob behind the woman -->
                                <path d="M230,140 C280,120 340,150 345,210 C350,270 320,330 270,340 C230,348 210,300 215,250 C218,210 200,160 230,140 Z" fill="#e7c9f2" opacity="0.85" />

                                <!-- phone mockup -->
                                <rect x="55" y="70" width="150" height="280" rx="26" fill="#4f7fe8" />
                                <rect x="70" y="88" width="120" height="220" rx="12" fill="#ffffff" />
                                <rect x="118" y="78" width="24" height="5" rx="2.5" fill="#294a9c" />
                                <circle cx="130" cy="150" r="32" fill="#22c55e" />
                                <path d="M114,150 L125,161 L148,136" stroke="#ffffff" stroke-width="7" stroke-linecap="round" stroke-linejoin="round" fill="none" />
                                <rect x="86" y="238" width="88" height="46" rx="10" fill="#4f7fe8" />
                                <rect x="98" y="252" width="50" height="6" rx="3" fill="#ffffff" opacity="0.85" />
                                <rect x="98" y="264" width="34" height="6" rx="3" fill="#ffffff" opacity="0.6" />
                                <rect x="110" y="322" width="40" height="6" rx="3" fill="#e5eaf5" />

                                <!-- woman -->
                                <path d="M232,260 L226,360 C226,368 232,372 240,372 C248,372 252,368 251,360 L248,262 Z" fill="#33415c" />
                                <path d="M262,262 L268,360 C269,368 263,372 255,372 C247,372 244,368 246,360 L250,262 Z" fill="#2b3750" />
                                <ellipse cx="236" cy="372" rx="14" ry="7" fill="#161b26" />
                                <ellipse cx="262" cy="372" rx="14" ry="7" fill="#161b26" />

                                <path d="M226,168 C214,178 208,206 212,236 C213,244 224,244 225,236 C222,208 228,186 236,172 Z" fill="#8b5cf6" />
                                <circle cx="214" cy="238" r="8" fill="#f4bd94" />

                                <path d="M222,190 C220,165 234,148 256,148 C278,148 292,166 288,192 L284,266 C284,276 274,282 256,282 C238,282 226,276 226,266 Z" fill="#8b5cf6" />

                                <path d="M284,168 C298,172 306,188 302,206 C300,214 290,212 289,204 C291,192 286,180 278,174 Z" fill="#8b5cf6" />
                                <circle cx="300" cy="208" r="9" fill="#f4bd94" />
                                <rect x="292" y="188" width="18" height="30" rx="4" fill="#1f2937" transform="rotate(-8 301 203)" />
                                <rect x="295" y="192" width="12" height="22" rx="2" fill="#60a5fa" transform="rotate(-8 301 203)" />

                                <rect x="248" y="128" width="16" height="18" fill="#f4bd94" />
                                <circle cx="256" cy="112" r="23" fill="#f4bd94" />
                                <path d="M233,108 C231,88 242,76 256,76 C270,76 281,88 279,108 C279,98 271,92 262,92 L250,92 C241,92 233,98 233,108 Z" fill="#2b2138" />
                                <circle cx="277" cy="82" r="9" fill="#2b2138" />
                            </svg>
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
