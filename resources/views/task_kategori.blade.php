<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>To-Do – Task Categories</title>
  <link rel="preconnect" href="https://fonts.googleapis.com"/>
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
  <link rel="stylesheet" href="{{ asset('css/app.css') }}"/>
</head>
<body>

{{-- ======================== HEADER ======================== --}}
<header class="header">

  {{-- Logo --}}
  <div class="logo">
    <span class="logo-text">
      <span class="logo-red">Yuk-</span><span class="logo-dark">Kerjain</span>
    </span>
  </div>

  {{-- Search --}}
  <div class="search-wrapper">
    <input
      type="text"
      placeholder="Search your task here..."
      class="search-input"
    />
    <button class="search-btn">
      <i class="fa fa-search" style="font-size:12px;"></i>
    </button>
  </div>

  {{-- Right icons + date --}}
  <div class="header-right">
    {{-- Bell --}}
    <button class="icon-btn">
      <i class="fa fa-bell" style="font-size:14px;"></i>
      <span class="badge">3</span>
    </button>

    {{-- Calendar Button + Dropdown --}}
    <div class="cal-wrapper" id="calendar-wrapper">
      <button onclick="toggleCalendar()" class="icon-btn" id="cal-open-btn" title="Buka Kalender">
        <i class="fa fa-calendar-alt" style="font-size:14px;"></i>
        <span id="cal-marked-badge" class="badge" style="display:none;"></span>
      </button>

      {{-- Calendar Dropdown --}}
      <div id="calendar-dropdown" class="cal-dropdown">

        {{-- Header --}}
        <div class="cal-header-row">
          <div class="cal-title">Kalender</div>
          <button onclick="clearAllMarked()" class="cal-clear-btn" title="Hapus semua tanda">Hapus Semua</button>
        </div>

        {{-- Month Navigation --}}
        <div class="cal-nav">
          <button onclick="prevMonth()" class="cal-nav-btn" title="Bulan sebelumnya">
            <i class="fa fa-chevron-left" style="font-size:11px;"></i>
          </button>
          <span id="cal-month-label" class="cal-month-label"></span>
          <button onclick="nextMonth()" class="cal-nav-btn" title="Bulan berikutnya">
            <i class="fa fa-chevron-right" style="font-size:11px;"></i>
          </button>
        </div>

        {{-- Day Headers --}}
        <div class="cal-day-headers">
          <span class="cal-day-header">Min</span>
          <span class="cal-day-header">Sen</span>
          <span class="cal-day-header">Sel</span>
          <span class="cal-day-header">Rab</span>
          <span class="cal-day-header">Kam</span>
          <span class="cal-day-header">Jum</span>
          <span class="cal-day-header">Sab</span>
        </div>

        {{-- Days Grid --}}
        <div id="cal-days" class="cal-days"></div>

        {{-- Legend & Footer --}}
        <div class="cal-legend">
          <span class="cal-legend-item">
            <span class="cal-legend-dot today-dot"></span> Hari ini
          </span>
          <span class="cal-legend-item">
            <span class="cal-legend-dot marked-dot"></span> Ditandai
          </span>
        </div>

        <div class="cal-footer">
          <button onclick="goToday()" class="cal-today-link">&#8962; Hari Ini</button>
          <span id="cal-marked-info" class="cal-marked-info"></span>
        </div>
      </div>
    </div>

    {{-- Date --}}
    <div class="date-display">
      <div class="date-day">{{ now()->translatedFormat('l') }}</div>
      <div class="date-num">{{ now()->format('d/m/Y') }}</div>
    </div>
  </div>
</header>

{{-- ======================== LAYOUT ======================== --}}
<div class="layout">

  {{-- ===== SIDEBAR ===== --}}
  <aside class="sidebar">

    {{-- Profile --}}
    <div class="sidebar-profile">
      <div class="avatar-ring">
        <img
          src="{{ asset('134175962389627504.jpg') }}"
          alt="Avatar"
          onerror="this.src='https://ui-avatars.com/api/?name=Yohanes&background=ffffff&color=f05252&size=72&bold=true'"
        />
      </div>
      <div class="sidebar-name">Yohanes</div>
      <div class="sidebar-email">Yohanes@gmail.com</div>
    </div>

    {{-- Nav --}}
    <nav class="sidebar-nav">
      <ul>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="fa fa-th-large nav-icon"></i>
            <span>Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="fa fa-exclamation-circle nav-icon"></i>
            <span>Vital Task</span>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="fa fa-check-square nav-icon"></i>
            <span>My Task</span>
          </a>
        </li>
        {{-- ACTIVE --}}
        <li class="nav-item">
          <a href="{{ route('task_kategori.index') }}" class="nav-link active">
            <i class="fa fa-list-ul nav-icon"></i>
            <span>Task Categories</span>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="fa fa-cog nav-icon"></i>
            <span>Settings</span>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="fa fa-question-circle nav-icon"></i>
            <span>Help</span>
          </a>
        </li>
      </ul>
    </nav>

    {{-- Logout --}}
    <div class="sidebar-logout">
      <a href="#" class="nav-link">
        <i class="fa fa-sign-out-alt nav-icon"></i>
        <span>Logout</span>
      </a>
    </div>
  </aside>

  {{-- ===== MAIN ===== --}}
  <main class="main-content">

    {{-- Flash Message --}}
    @if(session('success'))
    <div id="flash-msg" class="flash-msg">
      <span><i class="fa fa-check-circle" style="margin-right:0.5rem;"></i>{{ session('success') }}</span>
      <button onclick="document.getElementById('flash-msg').remove()" class="flash-close">
        <i class="fa fa-times"></i>
      </button>
    </div>
    @endif

    {{-- ============================================================
         CARD: Task Categories Header (title + Add Category btn)
         ============================================================ --}}
    <div id="view-categories">

      {{-- Top card: title + button --}}
      <div class="card" style="margin-bottom: 1.25rem;">
        <div class="card-top">
          <div>
            <h2 class="section-title-lg title-underline">Task Categories</h2>
          </div>
          <a href="#" class="link-back">Go Back</a>
        </div>

        <button onclick="showView()" class="btn-primary">
          <i class="fa fa-plus" style="font-size:11px;"></i> Add Category
        </button>
      </div>

      {{-- ---- CARD: Task Status ---- --}}
      <div class="card" style="margin-bottom: 1.25rem;">
        <div class="card-row">
          <h3 class="section-title-sm title-underline">Task Status</h3>
          <a href="#" onclick="openAddModal('status'); return false;" class="link-add">
            <i class="fa fa-plus" style="font-size:11px;"></i> Add Task Status
          </a>
        </div>

        {{-- Table --}}
        <div class="table-wrapper">
          <table class="data-table">
            <thead>
              <tr>
                <th class="col-sn">SN</th>
                <th>Task Status</th>
                <th class="col-action">Action</th>
              </tr>
            </thead>
            <tbody>
              @forelse($statuses as $index => $status)
              <tr>
                <td class="td-sn">{{ $index + 1 }}</td>
                <td>{{ $status->status_name }}</td>
                <td>
                  <div class="action-cell">
                    <button
                      onclick="openEditModal('status', {{ $status->id }}, '{{ addslashes($status->status_name) }}')"
                      class="btn-primary-sm">
                      <i class="fa fa-edit"></i> Edit
                    </button>
                    <button
                      onclick="openDeleteModal('status', {{ $status->id }}, '{{ addslashes($status->status_name) }}')"
                      class="btn-primary-sm">
                      <i class="fa fa-trash"></i> Delete
                    </button>
                  </div>
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="3" class="td-empty">Belum ada data Task Status.</td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>

      {{-- ---- CARD: Task Priority ---- --}}
      <div class="card">
        <div class="card-row">
          <h3 class="section-title-sm title-underline">Task Priority</h3>
          <a href="#" onclick="openAddModal('priority'); return false;" class="link-add">
            <i class="fa fa-plus" style="font-size:11px;"></i> Add New Priority
          </a>
        </div>

        {{-- Table --}}
        <div class="table-wrapper">
          <table class="data-table">
            <thead>
              <tr>
                <th class="col-sn">SN</th>
                <th>Task Priority</th>
                <th class="col-action">Action</th>
              </tr>
            </thead>
            <tbody>
              @forelse($priorities as $index => $priority)
              <tr>
                <td class="td-sn">{{ $index + 1 }}</td>
                <td>{{ $priority->priority_name }}</td>
                <td>
                  <div class="action-cell">
                    <button
                      onclick="openEditModal('priority', {{ $priority->id }}, '{{ addslashes($priority->priority_name) }}')"
                      class="btn-primary-sm">
                      <i class="fa fa-edit"></i> Edit
                    </button>
                    <button
                      onclick="openDeleteModal('priority', {{ $priority->id }}, '{{ addslashes($priority->priority_name) }}')"
                      class="btn-primary-sm">
                      <i class="fa fa-trash"></i> Delete
                    </button>
                  </div>
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="3" class="td-empty">Belum ada data Task Priority.</td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>

    </div>{{-- end #view-categories --}}

    {{-- ============================================================
         VIEW: Create Categories
         ============================================================ --}}
    <div id="view-create" class="hidden">
      <div class="card">
        <div class="card-top" style="margin-bottom: 1.5rem;">
          <div>
            <h2 class="section-title-lg title-underline">Create Categories</h2>
          </div>
          <a href="#" onclick="showCategories(); return false;" class="link-back">Go Back</a>
        </div>
        <form action="{{ route('task_kategori.storeStatus') }}" method="POST" class="form-narrow">
          @csrf
          <div class="form-group">
            <label class="form-label">Category Name</label>
            <input type="text" name="status_name" id="categoryName" required class="form-input"/>
          </div>
          <div class="form-actions">
            <button type="submit" class="btn-primary">Create</button>
            <button type="button" onclick="showCategories()" class="btn-secondary">Cancel</button>
          </div>
        </form>
      </div>
    </div>

  </main>
</div>

{{-- ======================== MODAL: ADD STATUS / PRIORITY ======================== --}}
<div id="modal-add" class="modal hidden">
  <div class="modal-box">
    <div class="modal-header">
      <h2 id="modal-add-title" class="modal-title">Add Task Status</h2>
      <button onclick="closeAddModal()" class="modal-close">Go Back</button>
    </div>
    <div class="modal-body">
      <form id="modal-add-form" method="POST">
        @csrf
        <div class="form-group">
          <label id="modal-add-label" class="form-label">Name</label>
          <input type="text" id="modal-add-input" name="add_value" required class="form-input"/>
        </div>
        <div class="form-actions">
          <button type="submit" class="btn-primary">Save</button>
          <button type="button" onclick="closeAddModal()" class="btn-secondary">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>

{{-- ======================== MODAL: EDIT ======================== --}}
<div id="modal-overlay" class="modal hidden">
  <div class="modal-box">
    <div class="modal-header">
      <h2 id="modal-title" class="modal-title">Edit Task</h2>
      <button onclick="closeModal()" class="modal-close">Go Back</button>
    </div>
    <div class="modal-body">
      <form id="modal-form" method="POST">
        @csrf
        <input type="hidden" name="_method" value="PUT"/>
        <div class="form-group">
          <label id="modal-label" class="form-label">Name</label>
          <input type="text" id="modal-input" name="edit_value" required class="form-input"/>
        </div>
        <div class="form-actions">
          <button type="submit" class="btn-primary">Update</button>
          <button type="button" onclick="closeModal()" class="btn-secondary">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>

{{-- ======================== MODAL: DELETE CONFIRM ======================== --}}
<div id="modal-delete" class="modal hidden">
  <div class="modal-box modal-box-sm">
    <div class="modal-body-center">
      {{-- Icon --}}
      <div class="delete-icon-wrap">
        <i class="fa fa-trash"></i>
      </div>
      <p class="modal-delete-title">Hapus Data?</p>
      <p class="modal-delete-sub">Kamu yakin ingin menghapus:</p>
      <p id="modal-delete-name" class="modal-delete-name"></p>
      <p class="modal-delete-warn">Tindakan ini tidak bisa dibatalkan.</p>
      <div class="modal-delete-actions">
        <form id="modal-delete-form" method="POST">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn-primary">Ya, Hapus</button>
        </form>
        <button onclick="closeDeleteModal()" class="btn-secondary">Batal</button>
      </div>
    </div>
  </div>
</div>

<script>
  // ---- View toggling ----
  function showView() {
    document.getElementById('view-categories').classList.add('hidden');
    document.getElementById('view-create').classList.remove('hidden');
  }
  function showCategories() {
    document.getElementById('view-create').classList.add('hidden');
    document.getElementById('view-categories').classList.remove('hidden');
  }

  // ---- Modal ADD ----
  function openAddModal(type) {
    const modal  = document.getElementById('modal-add');
    const title  = document.getElementById('modal-add-title');
    const label  = document.getElementById('modal-add-label');
    const form   = document.getElementById('modal-add-form');
    const input  = document.getElementById('modal-add-input');

    if (type === 'status') {
      title.textContent = 'Add Task Status';
      label.textContent = 'Task Status Name';
      form.action       = '{{ route("task_kategori.storeStatus") }}';
      input.name        = 'status_name';
    } else {
      title.textContent = 'Add New Priority';
      label.textContent = 'Task Priority Name';
      form.action       = '{{ route("task_kategori.storePriority") }}';
      input.name        = 'priority_name';
    }
    input.value = '';
    modal.classList.remove('hidden');
    setTimeout(() => input.focus(), 50);
  }
  function closeAddModal() {
    document.getElementById('modal-add').classList.add('hidden');
  }
  document.getElementById('modal-add').addEventListener('click', function(e) {
    if (e.target === this) closeAddModal();
  });

  // ---- Modal EDIT ----
  function openEditModal(type, id, currentValue) {
    const overlay = document.getElementById('modal-overlay');
    const form    = document.getElementById('modal-form');
    const title   = document.getElementById('modal-title');
    const label   = document.getElementById('modal-label');
    const input   = document.getElementById('modal-input');

    if (type === 'status') {
      title.textContent = 'Edit Task Status';
      label.textContent = 'Task Status Name';
      form.action       = '/task-kategori/status/' + id;
    } else {
      title.textContent = 'Edit Task Priority';
      label.textContent = 'Task Priority Name';
      form.action       = '/task-kategori/priority/' + id;
    }
    input.value = currentValue;
    overlay.classList.remove('hidden');
    setTimeout(() => input.focus(), 50);
  }
  function closeModal() {
    document.getElementById('modal-overlay').classList.add('hidden');
  }
  document.getElementById('modal-overlay').addEventListener('click', function(e) {
    if (e.target === this) closeModal();
  });

  // ---- Modal DELETE ----
  function openDeleteModal(type, id, name) {
    const modal     = document.getElementById('modal-delete');
    const form      = document.getElementById('modal-delete-form');
    const nameEl    = document.getElementById('modal-delete-name');

    nameEl.textContent = '"' + name + '"';
    if (type === 'status') {
      form.action = '/task-kategori/status/' + id;
    } else {
      form.action = '/task-kategori/priority/' + id;
    }
    modal.classList.remove('hidden');
  }
  function closeDeleteModal() {
    document.getElementById('modal-delete').classList.add('hidden');
  }
  document.getElementById('modal-delete').addEventListener('click', function(e) {
    if (e.target === this) closeDeleteModal();
  });

  // ======== CALENDAR ========
  const MONTHS_ID = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
  const today     = new Date();
  let calYear     = today.getFullYear();
  let calMonth    = today.getMonth();

  // Load marked dates from localStorage
  let markedDates = JSON.parse(localStorage.getItem('cal_marked') || '[]');

  function dateKey(y, m, d) {
    return `${y}-${String(m+1).padStart(2,'0')}-${String(d).padStart(2,'0')}`;
  }

  function isMarked(y, m, d) {
    return markedDates.includes(dateKey(y, m, d));
  }

  function toggleMark(y, m, d) {
    const key = dateKey(y, m, d);
    const idx = markedDates.indexOf(key);
    if (idx === -1) {
      markedDates.push(key);
    } else {
      markedDates.splice(idx, 1);
    }
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

  function renderCalendar() {
    const label   = document.getElementById('cal-month-label');
    const grid    = document.getElementById('cal-days');

    label.textContent = MONTHS_ID[calMonth] + ' ' + calYear;
    grid.innerHTML    = '';

    const firstDay    = new Date(calYear, calMonth, 1).getDay();
    const daysInMonth = new Date(calYear, calMonth + 1, 0).getDate();

    // Empty cells before first day
    for (let i = 0; i < firstDay; i++) {
      grid.innerHTML += '<span></span>';
    }

    // Day cells
    for (let d = 1; d <= daysInMonth; d++) {
      const isToday  = d === today.getDate() && calMonth === today.getMonth() && calYear === today.getFullYear();
      const isMark   = isMarked(calYear, calMonth, d);
      const dayName  = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'][new Date(calYear, calMonth, d).getDay()];
      const tooltip  = `${dayName}, ${d} ${MONTHS_ID[calMonth]} ${calYear}${isMark ? ' ✓ Ditandai' : '\nKlik untuk menandai'}`;

      let cls = 'cal-day';
      if (isToday)  cls += ' today';
      if (isMark)   cls += ' marked';

      grid.innerHTML += `<span class="${cls}" title="${tooltip}" onclick="toggleMark(${calYear}, ${calMonth}, ${d})">${d}${isMark ? '<i class="fa fa-circle cal-dot"></i>' : ''}</span>`;
    }
  }

  function toggleCalendar() {
    const dropdown = document.getElementById('calendar-dropdown');
    dropdown.classList.toggle('open');
    if (dropdown.classList.contains('open')) {
      calYear  = today.getFullYear();
      calMonth = today.getMonth();
      renderCalendar();
      updateBadge();
    }
  }

  function prevMonth() {
    calMonth--;
    if (calMonth < 0) { calMonth = 11; calYear--; }
    renderCalendar();
  }

  function nextMonth() {
    calMonth++;
    if (calMonth > 11) { calMonth = 0; calYear++; }
    renderCalendar();
  }

  function goToday() {
    calYear  = today.getFullYear();
    calMonth = today.getMonth();
    renderCalendar();
  }

  // Init badge on load
  updateBadge();

  document.addEventListener('click', function(e) {
    const wrapper  = document.getElementById('calendar-wrapper');
    const dropdown = document.getElementById('calendar-dropdown');
    if (!wrapper.contains(e.target)) {
      dropdown.classList.remove('open');
    }
  });
</script>
</body>
</html>
