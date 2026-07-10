<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'YukKerjain!')</title>
    @vite(['resources/css/app.css'])
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
    @stack('styles')
</head>
<body class="font-sans bg-gray-100 min-h-screen text-gray-800">

{{-- ======================== HEADER ======================== --}}
<header class="fixed top-0 inset-x-0 z-50 bg-white shadow-[0_1px_3px_rgba(0,0,0,0.1),0_1px_2px_rgba(0,0,0,0.06)] flex items-center px-6 h-16 gap-6">

    {{-- Logo --}}
    <div class="w-[220px] shrink-0">
        <span class="text-[22px] font-bold">
            <span class="text-brand">Yuk-</span><span class="text-gray-800">Kerjain</span>
        </span>
    </div>

    {{-- Search --}}
    <div class="flex-1 max-w-2xl relative">
        <input type="text" placeholder="Search your task here..." class="search-input w-full py-2 pr-10 pl-4 text-sm border border-gray-200 rounded-md bg-white outline-none transition placeholder:text-gray-400 focus:border-red-300 focus:shadow-[0_0_0_3px_rgba(240,82,82,0.15)]"/>
        <button class="absolute right-0 top-0 bottom-0 w-10 bg-brand text-white rounded-r-md flex items-center justify-center transition hover:bg-brand-hover">
            <i class="fa fa-search" style="font-size:12px;"></i>
        </button>
    </div>

    {{-- Right icons + date --}}
    <div class="ml-auto flex items-center gap-3">
        {{-- Bell --}}
        <button class="relative shrink-0 w-9 h-9 rounded-md bg-brand text-white flex items-center justify-center transition hover:bg-brand-hover">
            <i class="fa fa-bell" style="font-size:14px;"></i>
            <span class="absolute -top-1 -right-1 w-4 h-4 bg-red-800 rounded-full text-[9px] flex items-center justify-center font-bold">3</span>
        </button>

        {{-- Calendar Button + Dropdown --}}
        <div class="relative" id="calendar-wrapper">
            <button onclick="toggleCalendar()" class="relative shrink-0 w-9 h-9 rounded-md bg-brand text-white flex items-center justify-center transition hover:bg-brand-hover" id="cal-open-btn" title="Buka Kalender">
                <i class="fa fa-calendar-alt" style="font-size:14px;"></i>
                <span id="cal-marked-badge" class="absolute -top-1 -right-1 w-4 h-4 bg-red-800 rounded-full text-[9px] items-center justify-center font-bold" style="display:none;"></span>
            </button>

            {{-- Calendar Dropdown --}}
            <div id="calendar-dropdown" class="hidden absolute right-0 top-12 z-[100] bg-white rounded-2xl shadow-[0_20px_40px_rgba(0,0,0,0.15),0_0_0_1px_rgba(0,0,0,0.05)] w-80 p-4 select-none">
                <div class="flex items-center justify-between mb-3 pb-2.5 border-b border-gray-100">
                    <div class="text-sm font-bold text-gray-800">Kalender</div>
                    <button onclick="clearAllMarked()" class="text-[11px] text-gray-400 bg-transparent border border-gray-200 rounded-md px-2 py-0.5 cursor-pointer transition hover:text-brand hover:border-red-300">Hapus Semua</button>
                </div>
                <div class="flex items-center justify-between mb-3">
                    <button onclick="prevMonth()" class="w-7 h-7 rounded-full bg-transparent border border-gray-200 flex items-center justify-center text-gray-500 cursor-pointer transition hover:bg-red-50 hover:text-brand hover:border-red-300">
                        <i class="fa fa-chevron-left" style="font-size:11px;"></i>
                    </button>
                    <span id="cal-month-label" class="text-sm font-bold text-gray-800"></span>
                    <button onclick="nextMonth()" class="w-7 h-7 rounded-full bg-transparent border border-gray-200 flex items-center justify-center text-gray-500 cursor-pointer transition hover:bg-red-50 hover:text-brand hover:border-red-300">
                        <i class="fa fa-chevron-right" style="font-size:11px;"></i>
                    </button>
                </div>
                <div class="grid grid-cols-7 mb-1.5">
                    <span class="text-center text-[10px] font-bold text-gray-400 py-1 uppercase tracking-wider">Min</span>
                    <span class="text-center text-[10px] font-bold text-gray-400 py-1 uppercase tracking-wider">Sen</span>
                    <span class="text-center text-[10px] font-bold text-gray-400 py-1 uppercase tracking-wider">Sel</span>
                    <span class="text-center text-[10px] font-bold text-gray-400 py-1 uppercase tracking-wider">Rab</span>
                    <span class="text-center text-[10px] font-bold text-gray-400 py-1 uppercase tracking-wider">Kam</span>
                    <span class="text-center text-[10px] font-bold text-gray-400 py-1 uppercase tracking-wider">Jum</span>
                    <span class="text-center text-[10px] font-bold text-gray-400 py-1 uppercase tracking-wider">Sab</span>
                </div>
                <div id="cal-days" class="grid grid-cols-7 gap-x-0.5 gap-y-[3px]"></div>
                <div class="flex items-center gap-4 mt-3 pt-2.5 border-t border-gray-100">
                    <span class="flex items-center gap-1 text-[11px] text-gray-500">
                        <span class="w-2.5 h-2.5 rounded-[3px] bg-brand shrink-0"></span> Hari ini
                    </span>
                    <span class="flex items-center gap-1 text-[11px] text-gray-500">
                        <span class="w-2.5 h-2.5 rounded-[3px] bg-amber-100 border border-amber-300 shrink-0"></span> Ditandai
                    </span>
                </div>
                <div class="flex items-center justify-between mt-2">
                    <button onclick="goToday()" class="text-xs text-brand bg-transparent border-none cursor-pointer font-semibold p-0 transition hover:text-brand-hover">&#8962; Hari Ini</button>
                    <span id="cal-marked-info" class="text-[11px] text-amber-500 font-semibold"></span>
                </div>
            </div>
        </div>

        {{-- Date --}}
        <div class="text-right leading-snug">
            <div class="text-sm font-semibold text-gray-800">{{ now()->translatedFormat('l') }}</div>
            <div class="text-xs font-medium text-sky-400">{{ now()->format('d/m/Y') }}</div>
        </div>
    </div>
</header>

{{-- ======================== LAYOUT ======================== --}}
<div class="flex pt-16 min-h-screen">

    {{-- ===== SIDEBAR ===== --}}
    <aside class="fixed top-16 left-0 bottom-0 w-[220px] bg-brand-light flex flex-col z-40 overflow-y-auto">

        {{-- Profile --}}
        <div class="flex flex-col items-center px-4 pt-8 pb-5">
            @php
                $authUser = auth()->user();
                $avatarName = $authUser ? ($authUser->name ?? 'User') : 'User';
                $avatarSrc  = ($authUser && $authUser->profile_pic)
                    ? asset($authUser->profile_pic)
                    : 'https://ui-avatars.com/api/?name=' . urlencode($avatarName) . '&background=ffffff&color=f05252&size=72&bold=true';
            @endphp
            <div class="w-[72px] h-[72px] rounded-full overflow-hidden outline outline-[3px] outline-white outline-offset-2 mb-3 shadow-[0_4px_6px_rgba(0,0,0,0.15)]">
                <img
                    src="{{ $avatarSrc }}"
                    alt="Avatar"
                    class="w-full h-full object-cover block"
                    onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($avatarName) }}&background=ffffff&color=f05252&size=72&bold=true'"
                />
            </div>
            <div class="text-white font-semibold text-sm text-center leading-tight">{{ $avatarName }}</div>
            <div class="text-red-200 text-[11px] text-center mt-0.5 opacity-90">{{ $authUser?->email ?? '' }}</div>
        </div>

        {{-- Nav --}}
        <nav class="flex-1 px-3 pb-4">
            <ul>
                <li class="mb-0.5">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm rounded-lg transition {{ request()->routeIs('dashboard') ? 'bg-white text-brand font-semibold shadow-sm' : 'text-white hover:bg-white/20' }}">
                        <i class="fa fa-th-large w-5 text-center text-base shrink-0"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="mb-0.5">
                    <a href="{{ route('vital_task') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm rounded-lg transition {{ request()->routeIs('vital_task') ? 'bg-white text-brand font-semibold shadow-sm' : 'text-white hover:bg-white/20' }}">
                        <i class="fa fa-exclamation-circle w-5 text-center text-base shrink-0"></i>
                        <span>Vital Task</span>
                    </a>
                </li>
                <li class="mb-0.5">
                    <a href="{{ route('my_task') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm rounded-lg transition {{ request()->routeIs('my_task') ? 'bg-white text-brand font-semibold shadow-sm' : 'text-white hover:bg-white/20' }}">
                        <i class="fa fa-check-square w-5 text-center text-base shrink-0"></i>
                        <span>My Task</span>
                    </a>
                </li>
                <li class="mb-0.5">
                    <a href="{{ route('task_kategori.index') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm rounded-lg transition {{ request()->routeIs('task_kategori.index') ? 'bg-white text-brand font-semibold shadow-sm' : 'text-white hover:bg-white/20' }}">
                        <i class="fa fa-list-ul w-5 text-center text-base shrink-0"></i>
                        <span>Task Categories</span>
                    </a>
                </li>
                <li class="mb-0.5">
                    <a href="{{ route('profile') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm rounded-lg transition {{ request()->routeIs('profile') || request()->routeIs('account.info') || request()->routeIs('change.password') ? 'bg-white text-brand font-semibold shadow-sm' : 'text-white hover:bg-white/20' }}">
                        <i class="fa fa-cog w-5 text-center text-base shrink-0"></i>
                        <span>Settings</span>
                    </a>
                </li>
            </ul>
        </nav>

        {{-- Logout --}}
        <div class="px-3 pb-6">
            <a href="#" onclick="showLogoutModal(); return false;" class="flex items-center gap-3 px-4 py-2.5 text-sm text-white rounded-lg transition hover:bg-white/20">
                <i class="fa fa-sign-out-alt w-5 text-center text-base shrink-0"></i>
                <span>Logout</span>
            </a>
        </div>
    </aside>

    {{-- ===== MAIN ===== --}}
    <main class="ml-[220px] flex-1 p-6 flex flex-col gap-5">
        @yield('content')
    </main>
</div>

{{-- ======================== LOGOUT MODAL ======================== --}}
<div id="logoutModal" class="hidden fixed inset-0 z-[999] items-center justify-center bg-black/50 opacity-0 transition-opacity duration-300" style="display:none;">
    <div class="bg-white rounded-2xl p-8 text-center max-w-[380px] w-[90%] shadow-[0_20px_60px_rgba(0,0,0,0.2)] scale-90 transition-transform duration-300" id="logoutModalBox">
        <div class="text-4xl mb-3">👋</div>
        <h2 class="text-lg font-bold text-gray-800 mb-2">Are You Sure?</h2>
        <p class="text-sm text-gray-500 mb-6">You will be logged out of the current account.</p>
        <div class="flex gap-3 justify-center">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="inline-flex items-center gap-2 bg-brand hover:bg-brand-hover active:scale-95 text-white text-sm font-semibold px-5 py-2 rounded-lg shadow-sm transition cursor-pointer">Yes, Logout</button>
            </form>
            <button onclick="hideLogoutModal()" class="inline-flex items-center gap-2 bg-gray-200 hover:bg-gray-300 active:scale-95 text-gray-700 text-sm font-semibold px-5 py-2 rounded-lg transition cursor-pointer">Cancel</button>
        </div>
    </div>
</div>

<script>
    // ======== LOGOUT MODAL ========
    function showLogoutModal() {
        const modal = document.getElementById('logoutModal');
        const box = document.getElementById('logoutModalBox');
        modal.classList.remove('hidden');
        modal.style.display = 'flex';
        requestAnimationFrame(() => {
            modal.classList.remove('opacity-0');
            box.classList.remove('scale-90');
        });
    }
    function hideLogoutModal() {
        const modal = document.getElementById('logoutModal');
        const box = document.getElementById('logoutModalBox');
        modal.classList.add('opacity-0');
        box.classList.add('scale-90');
        setTimeout(() => {
            modal.classList.add('hidden');
            modal.style.display = 'none';
        }, 300);
    }
    function closeLogoutModal() {
        hideLogoutModal();
    }
    document.getElementById('logoutModal').addEventListener('click', function(e) {
        if (e.target === this) hideLogoutModal();
    });

    // ======== CALENDAR ========
    const MONTHS_ID = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
    const today     = new Date();
    let calYear     = today.getFullYear();
    let calMonth    = today.getMonth();
    let markedDates = JSON.parse(localStorage.getItem('cal_marked') || '[]');

    function dateKey(y, m, d) {
        return `${y}-${String(m+1).padStart(2,'0')}-${String(d).padStart(2,'0')}`;
    }
    function isMarked(y, m, d) { return markedDates.includes(dateKey(y, m, d)); }

    function toggleMark(y, m, d) {
        const key = dateKey(y, m, d);
        const idx = markedDates.indexOf(key);
        if (idx === -1) markedDates.push(key);
        else markedDates.splice(idx, 1);
        localStorage.setItem('cal_marked', JSON.stringify(markedDates));
        renderCalendar();
        updateBadge();
    }

    function clearAllMarked() {
        markedDates = [];
        localStorage.removeItem('cal_marked');
        renderCalendar();
        updateBadge();
    }

    function updateBadge() {
        const badge = document.getElementById('cal-marked-badge');
        const info  = document.getElementById('cal-marked-info');
        if (markedDates.length > 0) {
            badge.style.display = 'flex';
            badge.textContent   = markedDates.length;
            info.textContent    = markedDates.length + ' tanggal ditandai';
        } else {
            badge.style.display = 'none';
            info.textContent    = '';
        }
    }

    const CAL_DAY_BASE = 'text-center text-[13px] py-1.5 px-1 rounded-lg cursor-pointer transition font-medium relative leading-none flex flex-col items-center gap-0.5';

    function renderCalendar() {
        const label   = document.getElementById('cal-month-label');
        const grid    = document.getElementById('cal-days');
        label.textContent = MONTHS_ID[calMonth] + ' ' + calYear;
        grid.innerHTML    = '';
        const firstDay    = new Date(calYear, calMonth, 1).getDay();
        const daysInMonth = new Date(calYear, calMonth + 1, 0).getDate();
        for (let i = 0; i < firstDay; i++) grid.innerHTML += '<span></span>';
        for (let d = 1; d <= daysInMonth; d++) {
            const isToday = d === today.getDate() && calMonth === today.getMonth() && calYear === today.getFullYear();
            const isMark  = isMarked(calYear, calMonth, d);
            let cls;
            let dotCls = 'text-amber-500';
            if (isToday && isMark) {
                cls = CAL_DAY_BASE + ' text-white border-0 font-bold hover:scale-110 [background:linear-gradient(135deg,#f05252_60%,#f59e0b_100%)]';
                dotCls = 'text-amber-100';
            } else if (isToday) {
                cls = CAL_DAY_BASE + ' bg-brand text-white font-bold shadow-[0_2px_6px_rgba(240,82,82,0.4)] hover:bg-brand-hover';
                dotCls = 'text-amber-100';
            } else if (isMark) {
                cls = CAL_DAY_BASE + ' bg-amber-100 text-amber-800 font-semibold border border-amber-300 hover:bg-amber-200 hover:scale-110';
            } else {
                cls = CAL_DAY_BASE + ' text-gray-700 hover:bg-red-50 hover:text-brand hover:scale-110';
            }
            grid.innerHTML += `<span class="${cls}" onclick="toggleMark(${calYear}, ${calMonth}, ${d})">${d}${isMark ? `<i class="fa fa-circle ${dotCls}" style="font-size:5px;"></i>` : ''}</span>`;
        }
    }

    function toggleCalendar() {
        const dd = document.getElementById('calendar-dropdown');
        dd.classList.toggle('hidden');
        if (!dd.classList.contains('hidden')) {
            calYear = today.getFullYear();
            calMonth = today.getMonth();
            renderCalendar();
            updateBadge();
        }
    }

    function prevMonth() { calMonth--; if (calMonth < 0) { calMonth = 11; calYear--; } renderCalendar(); }
    function nextMonth() { calMonth++; if (calMonth > 11) { calMonth = 0; calYear++; } renderCalendar(); }
    function goToday()   { calYear = today.getFullYear(); calMonth = today.getMonth(); renderCalendar(); }

    updateBadge();

    document.addEventListener('click', function(e) {
        const wrapper  = document.getElementById('calendar-wrapper');
        const dropdown = document.getElementById('calendar-dropdown');
        if (wrapper && !wrapper.contains(e.target)) dropdown.classList.add('hidden');
    });
</script>

@stack('modals')
@stack('scripts')
</body>
</html>
