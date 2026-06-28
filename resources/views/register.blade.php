<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Sign Up - {{ config('app.name', 'Laravel') }}</title>
        <style>
            /* Prevent flash-of-unstyled-content while CSS loads */
            html, body { opacity: 0; transition: opacity 180ms ease-in; }
            noscript body { opacity: 1 !important; }
        </style>
        <style>
            :root {
                color-scheme: light;
                font-family: 'Poppins', sans-serif;
            }
            * { box-sizing: border-box; }
            body {
                margin: 0;
                min-height: 100vh;
                background: radial-gradient(circle at top left, rgba(255,255,255,0.45), transparent 20%),
                            radial-gradient(circle at bottom right, rgba(255,255,255,0.25), transparent 18%),
                            linear-gradient(135deg, #ff5d56 0%, #ff7c73 48%, #ff9a95 100%);
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 24px;
                color: #1f2937;
            }
            .page {
                width: 100%;
                max-width: 1120px;
                display: grid;
                grid-template-columns: 1fr 1.03fr;
                gap: 32px;
                align-items: stretch;
                min-height: 680px;
            }
            .hero {
                position: relative;
                background: rgba(255,255,255,0.18);
                border: 1px solid rgba(255,255,255,0.22);
                border-radius: 32px;
                padding: 32px;
                overflow: hidden;
                color: #fff;
                display: flex;
                flex-direction: column;
                justify-content: space-between;
            }
            .hero::before {
                content: '';
                position: absolute;
                top: -24px;
                right: -24px;
                width: 220px;
                height: 220px;
                background: rgba(255,255,255,0.25);
                border-radius: 50%;
                filter: blur(36px);
            }
            .hero::after {
                content: '';
                position: absolute;
                bottom: -32px;
                left: -32px;
                width: 160px;
                height: 160px;
                background: rgba(255,255,255,0.16);
                border-radius: 50%;
                filter: blur(24px);
            }
            .hero h2 {
                margin: 0;
                font-size: clamp(2.4rem, 4vw, 3.4rem);
                line-height: 1.05;
                letter-spacing: -0.04em;
            }
            .hero p {
                margin: 24px 0 0;
                max-width: 20rem;
                font-size: 1rem;
                line-height: 1.75;
                color: rgba(255,255,255,0.92);
            }
            .illustration {
                position: relative;
                width: 100%;
                min-height: 420px;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            .illustration::before,
            .illustration::after {
                content: '';
                position: absolute;
                border-radius: 999px;
                background: rgba(255,255,255,0.18);
            }
            .illustration::before {
                width: 140px;
                height: 140px;
                top: 20px;
                left: 24px;
            }
            .illustration::after {
                width: 92px;
                height: 92px;
                bottom: 20px;
                right: 24px;
            }
            .illustration-card {
                position: relative;
                width: 235px;
                height: 335px;
                background: rgba(255,255,255,0.9);
                border-radius: 28px;
                box-shadow: 0 40px 100px rgba(15,23,42,0.12);
                display: flex;
                flex-direction: column;
                justify-content: center;
                padding: 28px;
                gap: 18px;
            }
            .illustration-card span {
                display: block;
                width: 100%;
                height: 18px;
                border-radius: 999px;
                background: #ff9f96;
            }
            .illustration-card span:nth-child(2) { width: 70%; }
            .illustration-card span:nth-child(3) { width: 85%; }
            .illustration-card span:nth-child(4) { width: 60%; }
            .illustration-face {
                width: 80px;
                height: 80px;
                background: #1e3a8a;
                border-radius: 50%;
                margin: 0 auto;
                box-shadow: inset 0 -6px 0 rgba(0,0,0,0.15);
            }
            .card {
                background: #ffffff;
                border-radius: 32px;
                box-shadow: 0 38px 120px rgba(15,23,42,0.15);
                padding: 44px;
                display: flex;
                flex-direction: column;
                gap: 24px;
            }
            .card h1 {
                margin: 0;
                font-size: 2.25rem;
                letter-spacing: -0.05em;
            }
            .card form {
                display: grid;
                gap: 16px;
            }
            .field {
                display: flex;
                align-items: center;
                gap: 12px;
                border: 1px solid #e5e7eb;
                border-radius: 18px;
                padding: 14px 16px;
                background: #f8f8f8;
            }
            .field svg {
                width: 20px;
                height: 20px;
                stroke: #9ca3af;
                flex-shrink: 0;
            }
            .field input {
                border: none;
                background: transparent;
                width: 100%;
                font-size: 0.96rem;
                outline: none;
                color: #111827;
            }
            .field input::placeholder { color: #9ca3af; }
            .double {
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 16px;
            }
            .checkbox-row {
                display: flex;
                align-items: center;
                gap: 12px;
                font-size: 0.95rem;
                color: #4b5563;
            }
            .checkbox-row input {
                width: 18px;
                height: 18px;
                accent-color: #ef4444;
            }
            .button {
                border: none;
                border-radius: 16px;
                padding: 16px 20px;
                background: linear-gradient(90deg, #ff5d56 0%, #ff7d78 100%);
                color: white;
                font-size: 1rem;
                font-weight: 600;
                cursor: pointer;
                transition: transform 0.2s ease, box-shadow 0.2s ease;
            }
            .button:hover { transform: translateY(-1px); box-shadow: 0 18px 40px rgba(249,115,22,0.18); }
            .footer-text {
                text-align: center;
                font-size: 0.95rem;
                color: #6b7280;
            }
            .footer-text a {
                color: #ef4444;
                font-weight: 600;
                text-decoration: none;
            }
            @media (max-width: 1024px) {
                .page { grid-template-columns: 1fr; }
                .hero { min-height: 320px; }
            }
        </style>
    </head>
    <body>
        <section class="page">
            <aside class="hero">
                <div>
                    <h2>Register</h2>
                    <p>Gabung sekarang untuk akses fitur kolaborasi dan manajemen tugas dalam satu dashboard.</p>
                </div>
                <div class="illustration">
                    <div class="illustration-card">
                        <span></span>
                        <span></span>
                        <div class="illustration-face"></div>
                        <span></span>
                        <span></span>
                    </div>
                </div>
            </aside>

            <article class="card">
                <h1>Sign Up</h1>
                <form action="{{ route('register.submit') }}" method="POST">
                    @csrf
                    <label class="field">
                        <svg viewBox="0 0 24 24" fill="none"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/><circle cx="12" cy="7" r="4" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        <input type="text" name="name" placeholder="Enter Full Name" required>
                    </label>

                    <label class="field">
                        <svg viewBox="0 0 24 24" fill="none"><path d="M3 11.5a4.5 4.5 0 0 1 4.5-4.5h9a4.5 4.5 0 0 1 4.5 4.5v7a2.5 2.5 0 0 1-2.5 2.5h-13A2.5 2.5 0 0 1 3 18.5v-7Z" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/><path d="M16 11.5V9.5a4 4 0 0 0-8 0v2" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        <input type="email" name="email" placeholder="Enter Email" required>
                    </label>

                    <label class="field">
                        <svg viewBox="0 0 24 24" fill="none"><path d="M3 11.5a4.5 4.5 0 0 1 4.5-4.5h9a4.5 4.5 0 0 1 4.5 4.5v7a2.5 2.5 0 0 1-2.5 2.5h-13A2.5 2.5 0 0 1 3 18.5v-7Z" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/><path d="M16 11.5V9.5a4 4 0 0 0-8 0v2" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        <input type="password" name="password" placeholder="Enter Password" required>
                    </label>

                    <label class="field">
                        <svg viewBox="0 0 24 24" fill="none"><path d="M3 11.5a4.5 4.5 0 0 1 4.5-4.5h9a4.5 4.5 0 0 1 4.5 4.5v7a2.5 2.5 0 0 1-2.5 2.5h-13A2.5 2.5 0 0 1 3 18.5v-7Z" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/><path d="M16 11.5V9.5a4 4 0 0 0-8 0v2" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
                    </label>

                    <label class="checkbox-row">
                        <input type="checkbox" name="agree_terms" required>
                        I agree to all terms
                    </label>

                    <button type="submit" class="button">Register</button>
                </form>

                <p class="footer-text">Already have an account? <a href="{{ route('login') }}">Sign In</a></p>
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
