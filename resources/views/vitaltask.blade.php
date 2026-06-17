<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YukKerjain! - Vital Task</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/dody.css') }}">
</head>
<body>

    <nav class="navbar">
        <div class="logo">
            <span class="red-text">Yuk</span><span class="black-text">Kerjain!</span>
        </div>
        
        <div class="search-bar">
            <input type="text" placeholder="Search your task here...">
            <button><i class="fas fa-search"></i></button>
        </div>

        <div class="nav-right">
            <button class="icon-btn"><i class="fas fa-bell"></i></button>
            <button class="icon-btn" id="btn-calendar"><i class="far fa-calendar-alt"></i></button>
            
            <div class="date-time">
                {{ now()->locale('id')->isoFormat('dddd') }}<br>
                <span>{{ now()->format('d/m/Y') }}</span>
            </div>
        </div>
    </nav>

    <div class="main-wrapper">
        
        <aside class="sidebar">
            <div class="profile-section">
                <div class="profile-img">DP</div>
                <div class="profile-name">Dodyrizard Prasetyo</div>
                <div class="profile-email">dodynihbos@gmail.com</div>
            </div>

            <ul class="menu-list">
                <li><a href="#"><i class="fas fa-th-large"></i> Dashboard</a></li>
                <li class="active"><a href="/vital-task"><i class="fas fa-bolt"></i> Vital Task</a></li>
                <li><a href="/"><i class="far fa-calendar-check"></i> My Task</a></li>
                <li><a href="#"><i class="fas fa-list-ul"></i> Task Categories</a></li>
                <li><a href="#"><i class="fas fa-cog"></i> Settings</a></li>
                <li><a href="#"><i class="far fa-question-circle"></i> Help</a></li>
            </ul>

            <ul class="menu-list logout">
                <li><a href="#"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </aside>

        <main class="content">
            <div class="content-header">
                <h1>Vital Tasks</h1>
                <button class="btn-add"><i class="fas fa-plus"></i></button>
            </div>

            <div class="tasks-container">
                <div class="task-card" id="left-panel" style="justify-content: flex-start; overflow-y: auto;">
                    <i class="fas fa-tasks empty-icon"></i>
                    <div class="empty-text-main">Tidak ada tugas baru!</div>
                    <div class="empty-text-sub">Pilih tugas untuk melihat detail</div>
                </div>

                <div class="task-card" id="right-panel">
                    <i class="fas fa-mouse-pointer empty-icon" style="transform: rotate(-15deg);"></i>
                    <div class="empty-text-sub" style="margin-top: 15px;">Pilih tugas untuk melihat detail</div>
                </div>
            </div>
        </main>

    </div>

    <div id="modal-overlay" class="modal-overlay">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Tambah Tugas Baru</h2>
                <button id="modal-close" class="modal-close">&times;</button>
            </div>
            
            <form id="task-form">
                <div class="form-group">
                    <label>Judul Tugas *</label>
                    <input type="text" id="task-title" placeholder="Masukkan judul tugas..." required>
                </div>
                
                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea id="task-desc" placeholder="Deskripsi tugas..." rows="3"></textarea>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label>Prioritas</label>
                        <select id="task-priority">
                            <option value="Normal">Normal</option>
                            <option value="Extreme" selected>Extreme</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select id="task-status">
                            <option value="Not Started">Not Started</option>
                            <option value="In Progress">In Progress</option>
                            <option value="Completed">Completed</option>
                        </select>
                    </div>
                </div>
                
                <div class="form-group">
                    <label>Deadline</label>
                    <input type="date" id="task-deadline">
                </div>
                
                <button type="button" class="btn-submit" id="btn-simpan">Simpan Tugas</button>
            </form>
        </div>
    </div>

    <div id="calendar-modal" class="modal-overlay">
        <div class="modal-content" style="max-width: 400px; padding: 20px;">
            <div class="modal-header" style="margin-bottom: 15px; display: flex; justify-content: space-between; align-items: center;">
                <div style="display: flex; align-items: center; gap: 15px;">
                    <button id="prev-month" class="icon-btn" style="width: 30px; height: 30px; font-size: 12px;"><i class="fas fa-chevron-left"></i></button>
                    <h2 id="calendar-month-year" style="font-size: 16px; margin: 0; min-width: 120px; text-align: center;">Bulan Tahun</h2>
                    <button id="next-month" class="icon-btn" style="width: 30px; height: 30px; font-size: 12px;"><i class="fas fa-chevron-right"></i></button>
                </div>
                <button id="calendar-close" class="modal-close">&times;</button>
            </div>
            
            <div class="calendar-container">
                <div class="calendar-header">
                    <div>Min</div><div>Sen</div><div>Sel</div><div>Rab</div><div>Kam</div><div>Jum</div><div>Sab</div>
                </div>
                <div class="calendar-days" id="calendar-days"></div>
            </div>

            <div id="calendar-task-preview" style="margin-top: 15px; padding-top: 15px; border-top: 1px solid #eee; display: none;">
                <h3 style="font-size: 14px; margin-bottom: 10px; color: var(--text-dark);" id="preview-date-title">Tugas di tanggal ini:</h3>
                <div id="preview-task-list" style="max-height: 120px; overflow-y: auto; display: flex; flex-direction: column; gap: 8px;"></div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>