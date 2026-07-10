<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Sign Up - {{ config('app.name', 'Laravel') }}</title>
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
    <body class="m-0 min-h-screen flex items-center justify-center p-6 text-gray-800 font-sans bg-[radial-gradient(circle_at_top_left,rgba(255,255,255,0.45),transparent_20%),radial-gradient(circle_at_bottom_right,rgba(255,255,255,0.25),transparent_18%),linear-gradient(135deg,#ff5d56_0%,#ff7c73_48%,#ff9a95_100%)]">
        <section class="w-full max-w-[1120px] grid grid-cols-1 lg:grid-cols-[1fr_1.03fr] gap-8 items-stretch min-h-[680px]">
            <aside class="relative bg-white/[0.18] border border-white/[0.22] rounded-[32px] p-8 overflow-hidden text-white flex flex-col justify-between min-h-[320px] lg:min-h-0 before:content-[''] before:absolute before:-top-6 before:-right-6 before:w-[220px] before:h-[220px] before:bg-white/25 before:rounded-full before:blur-[36px] after:content-[''] after:absolute after:-bottom-8 after:-left-8 after:w-40 after:h-40 after:bg-white/15 after:rounded-full after:blur-[24px]">
                <div class="relative">
                    <h2 class="m-0 text-[clamp(2.4rem,4vw,3.4rem)] leading-[1.05] tracking-[-0.04em]">Register</h2>
                    <p class="mt-6 max-w-[20rem] text-base leading-[1.75] text-white/92">Gabung sekarang untuk akses fitur kolaborasi dan manajemen tugas dalam satu dashboard.</p>
                </div>
                <div class="relative w-full min-h-[420px] flex items-center justify-center before:content-[''] before:absolute before:rounded-full before:bg-white/[0.18] before:w-[140px] before:h-[140px] before:top-5 before:left-6 after:content-[''] after:absolute after:rounded-full after:bg-white/[0.18] after:w-[92px] after:h-[92px] after:bottom-5 after:right-6">
                    <div class="relative w-[235px] h-[335px] bg-white/90 rounded-[28px] shadow-[0_40px_100px_rgba(15,23,42,0.12)] flex flex-col justify-center p-7 gap-[18px]">
                        <span class="block w-full h-[18px] rounded-full bg-[#ff9f96]"></span>
                        <span class="block w-[70%] h-[18px] rounded-full bg-[#ff9f96]"></span>
                        <div class="w-20 h-20 bg-[#1e3a8a] rounded-full mx-auto shadow-[inset_0_-6px_0_rgba(0,0,0,0.15)]"></div>
                        <span class="block w-[85%] h-[18px] rounded-full bg-[#ff9f96]"></span>
                        <span class="block w-[60%] h-[18px] rounded-full bg-[#ff9f96]"></span>
                    </div>
                </div>
            </aside>

            <article class="bg-white rounded-[32px] shadow-[0_38px_120px_rgba(15,23,42,0.15)] p-11 flex flex-col gap-6">
                <h1 class="m-0 text-[2.25rem] tracking-[-0.05em]">Sign Up</h1>
                @if ($errors->any())
                    <div style="background:#fee2e2; color:#b91c1c; padding:12px 16px; border-radius:14px; font-size:0.9rem;">
                        <ul style="margin:0; padding-left:18px;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('register') }}" method="POST" class="grid gap-4">
                    @csrf
                    <div class="grid grid-cols-2 gap-4">
                        <label class="flex items-center gap-3 border border-gray-200 rounded-[18px] px-4 py-3.5 bg-[#f8f8f8]">
                            <svg viewBox="0 0 24 24" fill="none" class="w-5 h-5 stroke-gray-400 shrink-0"><path d="M15.5 7.5l-7 7" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/><path d="M8.5 7.5h6v6" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            <input type="text" name="first_name" value="{{ old('first_name') }}" placeholder="Enter First Name" required class="border-none bg-transparent w-full text-[0.96rem] outline-none text-gray-900 placeholder:text-gray-400">
                        </label>
                        <label class="flex items-center gap-3 border border-gray-200 rounded-[18px] px-4 py-3.5 bg-[#f8f8f8]">
                            <svg viewBox="0 0 24 24" fill="none" class="w-5 h-5 stroke-gray-400 shrink-0"><path d="M15.5 7.5l-7 7" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/><path d="M8.5 7.5h6v6" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            <input type="text" name="last_name" value="{{ old('last_name') }}" placeholder="Enter Last Name" required class="border-none bg-transparent w-full text-[0.96rem] outline-none text-gray-900 placeholder:text-gray-400">
                        </label>
                    </div>

                    <label class="flex items-center gap-3 border border-gray-200 rounded-[18px] px-4 py-3.5 bg-[#f8f8f8]">
                        <svg viewBox="0 0 24 24" fill="none" class="w-5 h-5 stroke-gray-400 shrink-0"><path d="M3 11.5a4.5 4.5 0 0 1 4.5-4.5h9a4.5 4.5 0 0 1 4.5 4.5v7a2.5 2.5 0 0 1-2.5 2.5h-13A2.5 2.5 0 0 1 3 18.5v-7Z" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/><path d="M16 11.5V9.5a4 4 0 0 0-8 0v2" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="Enter Email" required class="border-none bg-transparent w-full text-[0.96rem] outline-none text-gray-900 placeholder:text-gray-400">
                    </label>

                    <label class="flex items-center gap-3 border border-gray-200 rounded-[18px] px-4 py-3.5 bg-[#f8f8f8]">
                        <svg viewBox="0 0 24 24" fill="none" class="w-5 h-5 stroke-gray-400 shrink-0"><path d="M3 11.5a4.5 4.5 0 0 1 4.5-4.5h9a4.5 4.5 0 0 1 4.5 4.5v7a2.5 2.5 0 0 1-2.5 2.5h-13A2.5 2.5 0 0 1 3 18.5v-7Z" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/><path d="M16 11.5V9.5a4 4 0 0 0-8 0v2" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        <input type="password" name="password" placeholder="Enter Password" required class="border-none bg-transparent w-full text-[0.96rem] outline-none text-gray-900 placeholder:text-gray-400">
                    </label>

                    <label class="flex items-center gap-3 border border-gray-200 rounded-[18px] px-4 py-3.5 bg-[#f8f8f8]">
                        <svg viewBox="0 0 24 24" fill="none" class="w-5 h-5 stroke-gray-400 shrink-0"><path d="M3 11.5a4.5 4.5 0 0 1 4.5-4.5h9a4.5 4.5 0 0 1 4.5 4.5v7a2.5 2.5 0 0 1-2.5 2.5h-13A2.5 2.5 0 0 1 3 18.5v-7Z" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/><path d="M16 11.5V9.5a4 4 0 0 0-8 0v2" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        <input type="password" name="password_confirmation" placeholder="Confirm Password" required class="border-none bg-transparent w-full text-[0.96rem] outline-none text-gray-900 placeholder:text-gray-400">
                    </label>

                    <label class="flex items-center gap-3 text-[0.95rem] text-gray-600">
                        <input type="checkbox" name="agree_terms" required class="w-[18px] h-[18px] accent-red-500">
                        I agree to all terms
                    </label>

                    <button type="submit" class="border-none rounded-2xl px-5 py-4 bg-gradient-to-r from-[#ff5d56] to-[#ff7d78] text-white text-base font-semibold cursor-pointer transition hover:-translate-y-px hover:shadow-[0_18px_40px_rgba(249,115,22,0.18)]">Register</button>
                </form>

                <div class="relative text-center my-1 before:content-[''] before:absolute before:top-1/2 before:inset-x-0 before:h-px before:bg-gray-200">
                    <span class="relative bg-white px-3 text-[0.85rem] text-gray-400">Atau daftar dengan</span>
                </div>

                <a href="{{ route('auth.google') }}" class="flex items-center justify-center gap-2.5 border border-gray-200 rounded-2xl px-5 py-[13px] bg-white text-gray-700 text-[0.95rem] font-semibold no-underline transition hover:bg-gray-50">
                    <svg viewBox="0 0 24 24" width="18" height="18"><path fill="#4285F4" d="M21.35 11.1H12v2.8h5.35c-.24 1.3-.96 2.4-2.05 3.12v2.6h3.33c1.95-1.8 3.07-4.45 3.07-7.52 0-.53-.04-1.05-.12-1.55z"/><path fill="#34A853" d="M12 22c2.7 0 4.96-.9 6.61-2.46l-3.33-2.6c-.92.62-2.1.98-3.28.98-2.52 0-4.66-1.7-5.43-3.96H2.98v2.49C4.6 19.9 8.04 22 12 22z"/><path fill="#FBBC05" d="M6.57 13.96c-.2-.62-.32-1.28-.32-1.96s.12-1.34.32-1.96V7.55H2.98A9.993 9.993 0 0 0 2 12c0 1.6.38 3.1 1.05 4.45l3.52-2.49z"/><path fill="#EA4335" d="M12 5.4c1.47 0 2.8.5 3.84 1.48l2.88-2.88C16.94 2.38 14.7 1.4 12 1.4 8.04 1.4 4.6 3.5 2.98 7.55l3.52 2.49C7.34 7.1 9.48 5.4 12 5.4z"/></svg>
                    Daftar dengan Google
                </a>

                <p class="text-center text-[0.95rem] text-gray-500">Already have an account? <a href="{{ route('login') }}" class="text-red-500 font-semibold no-underline">Sign In</a></p>
            </article>
        </section>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                document.documentElement.style.opacity = '1';
                document.body.style.opacity = '1';
            });
        </script>
    </body>
</html>
