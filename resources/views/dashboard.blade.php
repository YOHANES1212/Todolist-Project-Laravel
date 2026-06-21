<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>YukKerjain – Dashboard</title>
  <link rel="preconnect" href="https://fonts.googleapis.com"/>
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
  <link rel="stylesheet" href="{{ asset('css/app.css') }}"/>
  <style>
    /* Dashboard Specific Styles */
    .dashboard-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 1.5rem;
      margin-bottom: 2rem;
    }

    .stat-card {
      background: #ffffff;
      border-radius: 12px;
      padding: 1.5rem;
      box-shadow: 0 1px 3px rgba(0,0,0,0.1);
      transition: all 0.3s ease;
    }

    .stat-card:hover {
      box-shadow: 0 4px 6px rgba(0,0,0,0.1);
      transform: translateY(-2px);
    }

    .stat-number {
      font-size: 2rem;
      font-weight: 700;
      color: #1f2937;
      margin-bottom: 0.5rem;
    }

    .stat-label {
      font-size: 0.875rem;
      color: #6b7280;
      font-weight: 500;
    }

    .progress-circle-wrapper {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 1rem;
    }

    .progress-circle {
      position: relative;
      width: 120px;
      height: 120px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .progress-circle svg {
      position: absolute;
      width: 100%;
      height: 100%;
      transform: rotate(-90deg);
    }

    .progress-circle-bg {
      stroke: #e5e7eb;
      stroke-width: 8;
      fill: none;
    }

    .progress-circle-fill {
      stroke-width: 8;
      fill: none;
      stroke-linecap: round;
      transition: stroke-dashoffset 0.3s ease;
    }

    .progress-circle-text {
      position: relative;
      z-index: 2;
      text-align: center;
    }

    .progress-circle-percent {
      font-size: 1.5rem;
      font-weight: 700;
      color: #1f2937;
    }

    .progress-circle-label {
      font-size: 0.75rem;
      color: #6b7280;
      margin-top: 0.25rem;
    }

    .task-list {
      background: #ffffff;
      border-radius: 12px;
      padding: 1.5rem;
      box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }

    .task-list-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 1.5rem;
    }

    .task-item {
      display: flex;
      align-items: flex-start;
      padding: 1rem;
      border-bottom: 1px solid #f3f4f6;
      transition: background-color 0.2s ease;
    }

    .task-item:last-child {
      border-bottom: none;
    }

    .task-item:hover {
      background-color: #f9fafb;
    }

    .task-checkbox {
      width: 24px;
      height: 24px;
      margin-right: 1rem;
      flex-shrink: 0;
      margin-top: 0.25rem;
      cursor: pointer;
      accent-color: #f05252;
    }

    .task-content {
      flex: 1;
    }

    .task-title {
      font-weight: 600;
      color: #1f2937;
      margin-bottom: 0.25rem;
    }

    .task-description {
      font-size: 0.875rem;
      color: #6b7280;
      margin-bottom: 0.5rem;
    }

    .task-meta {
      display: flex;
      gap: 1rem;
      font-size: 0.75rem;
    }

    .task-status {
      display: inline-block;
      padding: 0.25rem 0.75rem;
      border-radius: 20px;
      font-weight: 500;
      font-size: 0.75rem;
    }

    .task-status.completed {
      background-color: #dcfce7;
      color: #166534;
    }

    .task-status.in-progress {
      background-color: #dbeafe;
      color: #1e40af;
    }

    .task-status.not-started {
      background-color: #fee2e2;
      color: #991b1b;
    }

    .task-priority {
      display: inline-block;
      padding: 0.25rem 0.75rem;
      border-radius: 20px;
      font-weight: 500;
      font-size: 0.75rem;
    }

    .task-priority.high {
      background-color: #fee2e2;
      color: #991b1b;
    }

    .task-priority.medium {
      background-color: #fef08a;
      color: #854d0e;
    }

    .task-priority.low {
      background-color: #dbeafe;
      color: #1e40af;
    }

    .welcome-card {
      background: linear-gradient(135deg, #f05252 0%, #ff7b7b 100%);
      border-radius: 12px;
      padding: 2rem;
      color: white;
      margin-bottom: 2rem;
      box-shadow: 0 4px 6px rgba(240, 82, 82, 0.2);
    }

    .welcome-greeting {
      font-size: 1.5rem;
      font-weight: 700;
      margin-bottom: 0.5rem;
    }

    .welcome-subtitle {
      font-size: 0.9rem;
      opacity: 0.9;
    }

    .add-task-btn {
      background-color: #f05252;
      color: white;
      border: none;
      padding: 0.75rem 1.5rem;
      border-radius: 8px;
      font-weight: 600;
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      transition: background-color 0.3s ease;
    }

    .add-task-btn:hover {
      background-color: #d64545;
    }

    .empty-state {
      text-align: center;
      padding: 2rem;
      color: #6b7280;
    }

    .empty-state-icon {
      font-size: 3rem;
      margin-bottom: 1rem;
      opacity: 0.5;
    }

    @media (max-width: 768px) {
      .dashboard-grid {
        grid-template-columns: 1fr;
      }

      .welcome-card {
        padding: 1.5rem;
      }

      .progress-circle {
        width: 100px;
        height: 100px;
      }
    }
  </style>
</head>
<body>

{{-- ======================== HEADER ======================== --}}
<header class="header">

  {{-- Logo --}}
  <div class="logo">
    <span class="logo-text">
      <span class="logo-red">Yuk</span><span class="logo-dark">Kerjain</span>
    </span>
  </div>

  {{-- Search --}}
  <div class="search-wrapper">
    <input
      type="text"
      placeholder="Search your task here..."
      class="search-input"
      id="task-search"
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
      <span class="badge">{{ count($latestTasks) }}</span>
    </button>

    {{-- Calendar Button --}}
    <div class="cal-wrapper" id="calendar-wrapper">
      <button onclick="toggleCalendar()" class="icon-btn" id="cal-open-btn" title="Buka Kalender">
        <i class="fa fa-calendar-alt" style="font-size:14px;"></i>
      </button>
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
          @php
            $displayName = $user ? $user->name : 'Guest';
            $avatarUrl = "https://ui-avatars.com/api/?name=" . urlencode($displayName) . "&background=f05252&color=ffffff&size=72&bold=true";
          @endphp
          onerror="this.src='{{ $avatarUrl }}';"
        />
      </div>
      <div class="sidebar-name">{{ $user ? $user->name : 'Guest User' }}</div>
      <div class="sidebar-email">{{ $user ? $user->email : 'Not logged in' }}</div>
    </div>

    {{-- Nav --}}
    <nav class="sidebar-nav">
      <ul>
        <li class="nav-item">
          <a href="{{ route('dashboard') }}" class="nav-link active">
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
        <li class="nav-item">
          <a href="{{ route('task_kategori.index') }}" class="nav-link">
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

    {{-- Guest User Info Banner --}}
    @if(!$user)
    <div style="background-color: #fef3c7; border: 1px solid #fcd34d; border-radius: 8px; padding: 1rem; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 1rem;">
      <i class="fa fa-info-circle" style="color: #f59e0b; font-size: 1.2rem;"></i>
      <div>
        <strong style="color: #92400e;">You are viewing demo data</strong>
        <p style="color: #a16207; margin: 0; font-size: 0.875rem;">Statistics below show global task data. <a href="#" style="color: #d97706; text-decoration: underline;">Log in</a> to see your personal tasks.</p>
      </div>
    </div>
    @endif

    {{-- Welcome Card --}}
    <div class="welcome-card">
      <div class="welcome-greeting">
        @if($user)
          Welcome back, {{ $user->name }}! 👋
        @else
          Welcome to Dashboard! 👋
        @endif
      </div>
      <div class="welcome-subtitle">You have {{ $totalTasks }} tasks in total</div>
    </div>

    {{-- Task Statistics --}}
    <div class="dashboard-grid">
      {{-- Total Tasks --}}
      <div class="stat-card">
        <div class="stat-number">{{ $totalTasks }}</div>
        <div class="stat-label">Total Tasks</div>
      </div>

      {{-- Completed Tasks with Progress Circle --}}
      <div class="stat-card">
        <div class="progress-circle-wrapper">
          <div class="progress-circle">
            <svg viewBox="0 0 120 120">
              <circle class="progress-circle-bg" cx="60" cy="60" r="54"></circle>
              <circle 
                class="progress-circle-fill" 
                cx="60" cy="60" r="54"
                style="stroke: #22c55e; stroke-dasharray: {{ $completedPercentage * 3.39 }}, 339; opacity: {{ $completedPercentage > 0 ? 1 : 0.3 }};"
              ></circle>
            </svg>
            <div class="progress-circle-text">
              <div class="progress-circle-percent">{{ $completedPercentage }}%</div>
              <div class="progress-circle-label">Completed</div>
            </div>
          </div>
          <div style="color: #6b7280; font-size: 0.875rem;">{{ $completedTasks }} tasks</div>
        </div>
      </div>

      {{-- In Progress Tasks with Progress Circle --}}
      <div class="stat-card">
        <div class="progress-circle-wrapper">
          <div class="progress-circle">
            <svg viewBox="0 0 120 120">
              <circle class="progress-circle-bg" cx="60" cy="60" r="54"></circle>
              <circle 
                class="progress-circle-fill" 
                cx="60" cy="60" r="54"
                style="stroke: #3b82f6; stroke-dasharray: {{ $inProgressPercentage * 3.39 }}, 339; opacity: {{ $inProgressPercentage > 0 ? 1 : 0.3 }};"
              ></circle>
            </svg>
            <div class="progress-circle-text">
              <div class="progress-circle-percent">{{ $inProgressPercentage }}%</div>
              <div class="progress-circle-label">In Progress</div>
            </div>
          </div>
          <div style="color: #6b7280; font-size: 0.875rem;">{{ $inProgressTasks }} tasks</div>
        </div>
      </div>

      {{-- Not Started Tasks with Progress Circle --}}
      <div class="stat-card">
        <div class="progress-circle-wrapper">
          <div class="progress-circle">
            <svg viewBox="0 0 120 120">
              <circle class="progress-circle-bg" cx="60" cy="60" r="54"></circle>
              <circle 
                class="progress-circle-fill" 
                cx="60" cy="60" r="54"
                style="stroke: #ef4444; stroke-dasharray: {{ $notStartedPercentage * 3.39 }}, 339; opacity: {{ $notStartedPercentage > 0 ? 1 : 0.3 }};"
              ></circle>
            </svg>
            <div class="progress-circle-text">
              <div class="progress-circle-percent">{{ $notStartedPercentage }}%</div>
              <div class="progress-circle-label">Not Started</div>
            </div>
          </div>
          <div style="color: #6b7280; font-size: 0.875rem;">{{ $notStartedTasks }} tasks</div>
        </div>
      </div>
    </div>

    {{-- Latest Tasks --}}
    <div class="task-list">
      <div class="task-list-header">
        <h2 style="font-size: 1.25rem; font-weight: 700; color: #1f2937;">Latest Tasks</h2>
        <button class="add-task-btn" onclick="alert('Fitur Add Task akan ditambahkan')">
          <i class="fa fa-plus"></i>
          <span>Add Task</span>
        </button>
      </div>

      @if($latestTasks->count() > 0)
        @foreach($latestTasks as $task)
          <div class="task-item">
            <input type="checkbox" class="task-checkbox" 
              @if($task->status && strpos($task->status->status_name, 'ompleted') !== false) checked @endif
            />
            <div class="task-content">
              <div class="task-title">{{ $task->title }}</div>
              @if($task->description)
                <div class="task-description">{{ Str::limit($task->description, 100) }}</div>
              @endif
              <div class="task-meta">
                @if($task->status)
                  <span class="task-status {{ strtolower(str_replace(' ', '-', $task->status->status_name)) }}">
                    {{ $task->status->status_name }}
                  </span>
                @endif
                @if($task->priority)
                  <span class="task-priority {{ strtolower($task->priority->priority_name) }}">
                    {{ $task->priority->priority_name }}
                  </span>
                @endif
                <span style="color: #6b7280;">{{ $task->created_at->diffForHumans() }}</span>
              </div>
            </div>
          </div>
        @endforeach
      @else
        <div class="empty-state">
          <div class="empty-state-icon">
            <i class="fa fa-inbox"></i>
          </div>
          <p>No tasks yet. Create your first task to get started!</p>
        </div>
      @endif
    </div>

  </main>

</div>

<script>
  // Toggle calendar
  function toggleCalendar() {
    const dropdown = document.getElementById('calendar-dropdown');
    if (dropdown) {
      dropdown.classList.toggle('hidden');
    }
  }

  // Task search functionality
  document.getElementById('task-search').addEventListener('keyup', function(e) {
    const searchTerm = e.target.value.toLowerCase();
    const taskItems = document.querySelectorAll('.task-item');
    
    taskItems.forEach(item => {
      const taskTitle = item.querySelector('.task-title').textContent.toLowerCase();
      const taskDesc = item.querySelector('.task-description')?.textContent.toLowerCase() || '';
      
      if (taskTitle.includes(searchTerm) || taskDesc.includes(searchTerm)) {
        item.style.display = 'flex';
      } else {
        item.style.display = 'none';
      }
    });
  });

  // Close flash message after 5 seconds
  window.addEventListener('load', function() {
    const flashMsg = document.getElementById('flash-msg');
    if (flashMsg) {
      setTimeout(function() {
        flashMsg.style.transition = 'opacity 0.3s ease';
        flashMsg.style.opacity = '0';
        setTimeout(function() {
          flashMsg.remove();
        }, 300);
      }, 5000);
    }
  });
</script>

</body>
</html>
