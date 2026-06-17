document.addEventListener('DOMContentLoaded', function() {
    
    // --- ELEMEN ---
    const btnAdd = document.querySelector('.btn-add');
    const modalOverlay = document.getElementById('modal-overlay');
    const btnClose = document.getElementById('modal-close');
    const btnSimpan = document.getElementById('btn-simpan');
    const leftPanel = document.getElementById('left-panel');
    const rightPanel = document.getElementById('right-panel');

    const btnCalendar = document.getElementById('btn-calendar');
    const calendarModal = document.getElementById('calendar-modal');
    const calendarClose = document.getElementById('calendar-close');
    const calendarDays = document.getElementById('calendar-days');
    const calendarMonthYear = document.getElementById('calendar-month-year');
    
    const searchInput = document.querySelector('.search-bar input');

    let navDate = new Date(); 
    let tasks = [];

    // --- LOGIC DATABASE SEMENTARA (SESSION STORAGE) ---
    // Menginisialisasi data dummy jika Session Storage masih kosong
    function initTemporaryDB() {
        if (!sessionStorage.getItem('mock_tasks')) {
            const dummyTasks = [
                {
                    id: 1,
                    title: "Slicing Tampilan Laravel",
                    description: "Memindahkan template HTML CSS native ke dalam sistem Blade Laravel.",
                    priority: "Normal",
                    status: "In Progress",
                    deadline: new Date().toISOString().split('T')[0], // Hari ini
                    image: "https://picsum.photos/seed/1/600/300"
                },
                {
                    id: 2,
                    title: "Beli Token Listrik Rumah",
                    description: "Jangan sampai mati lampu, beli yang 100 ribu aja di m-banking.",
                    priority: "Extreme",
                    status: "Not Started",
                    deadline: new Date().toISOString().split('T')[0], // Hari ini
                    image: "https://picsum.photos/seed/2/600/300"
                }
            ];
            sessionStorage.setItem('mock_tasks', JSON.stringify(dummyTasks));
        }
    }

    // --- FUNGSI AMBIL DATA (SIMULASI BE) ---
    function loadTasksFromDB() {
        initTemporaryDB();
        
        // Ambil data string dari session storage lalu ubah jadi Array Object
        const localData = JSON.parse(sessionStorage.getItem('mock_tasks'));
        
        // Deteksi halaman berdasarkan teks judul di H1
        const pageTitle = document.querySelector('.content-header h1').innerText;

        // Jalankan filter client-side mirip logical backend php kemarin
        if (pageTitle.includes('Vital')) {
            tasks = localData.filter(task => task.priority === 'Extreme');
        } else {
            tasks = localData;
        }

        // Urutkan dari ID terbesar ke terkecil (ORDER BY id DESC)
        tasks.sort((a, b) => b.id - a.id);

        renderTaskList(); 
        renderCalendar(); 
    }

    loadTasksFromDB();

    // --- FUNGSI BUKA TUTUP MODAL ---
    if(btnAdd) btnAdd.addEventListener('click', () => modalOverlay.style.display = 'flex');
    if(btnClose) btnClose.addEventListener('click', () => modalOverlay.style.display = 'none');

    if(btnCalendar) {
        btnCalendar.addEventListener('click', () => {
            calendarModal.style.display = 'flex';
            navDate = new Date(); 
            document.getElementById('calendar-task-preview').style.display = 'none'; 
            renderCalendar(); 
        });
    }
    if(calendarClose) calendarClose.addEventListener('click', () => calendarModal.style.display = 'none');

    // --- NAVIGASI BULAN KALENDER ---
    document.getElementById('prev-month').addEventListener('click', () => {
        navDate.setMonth(navDate.getMonth() - 1);
        renderCalendar();
    });

    document.getElementById('next-month').addEventListener('click', () => {
        navDate.setMonth(navDate.getMonth() + 1);
        renderCalendar();
    });

    // --- FUNGSI SIMPAN TUGAS BARU (SIMULASI) ---
    btnSimpan.addEventListener('click', function() {
        const title = document.getElementById('task-title').value;
        const desc = document.getElementById('task-desc').value;
        const priority = document.getElementById('task-priority').value;
        const status = document.getElementById('task-status').value;
        const deadline = document.getElementById('task-deadline').value;

        if(title === '') {
            alert('Judul Tugas wajib diisi!');
            return;
        }

        const uniqueId = Date.now();
        const randomImageUrl = `https://picsum.photos/seed/${uniqueId}/600/300`;

        // Buat struktur object tugas baru
        const newTask = {
            id: uniqueId,
            title: title,
            description: desc,
            priority: priority,
            status: status,
            deadline: deadline,
            image: randomImageUrl
        };

        // Ambil data lama, push data baru, lalu save kembali ke Session Storage
        const currentData = JSON.parse(sessionStorage.getItem('mock_tasks'));
        currentData.push(newTask);
        sessionStorage.setItem('mock_tasks', JSON.stringify(currentData));

        // Refresh Tampilan UI
        loadTasksFromDB();
        if(searchInput) searchInput.value = '';
        modalOverlay.style.display = 'none';
        document.getElementById('task-form').reset();
    });

    function getStatusColor(status) {
        if (status === 'Not Started') return '#ff5252'; 
        if (status === 'In Progress') return '#3498db'; 
        if (status === 'Completed') return '#2ecc71';   
        return '#333'; 
    }

    // --- FUNGSI PENCARIAN ---
    if(searchInput) {
        searchInput.addEventListener('input', function() {
            const keyword = this.value.toLowerCase();
            const filteredTasks = tasks.filter(task => 
                task.title.toLowerCase().includes(keyword) || 
                (task.description && task.description.toLowerCase().includes(keyword))
            );
            renderTaskList(filteredTasks);
        });
    }

    // --- FUNGSI RENDER LIST TUGAS ---
    function renderTaskList(tasksToRender = tasks) {
        leftPanel.innerHTML = ''; 
        
        if (tasksToRender.length === 0) {
            leftPanel.innerHTML = '<div style="width:100%;text-align:center;color:#aaa;margin-top:50px;">Tugas tidak ditemukan</div>';
            return;
        }
        
        tasksToRender.forEach(task => {
            let dotColor = 'dot-normal'; 
            let textPriorityColor = '#ffca28'; 

            if (task.priority === 'Extreme') {
                dotColor = 'dot-extreme';
                textPriorityColor = '#ff5252';
            } else if (task.priority === 'Low') {
                dotColor = 'dot-low';
                textPriorityColor = '#81c784';
            } else {
                dotColor = 'dot-normal';
                textPriorityColor = '#ffca28';
            }

            const statusColor = getStatusColor(task.status);

            const taskCard = document.createElement('div');
            taskCard.className = 'task-item';
            taskCard.innerHTML = `
                <div class="priority-dot ${dotColor}"></div>
                <div class="task-info">
                    <h4>${task.title}</h4>
                    <p>Priority: <span style="color: ${textPriorityColor}; font-weight: bold;">${task.priority}</span> &nbsp;|&nbsp; Status: <span style="color: ${statusColor}; font-weight: bold;">${task.status}</span></p>
                </div>
                <img src="${task.image}" class="task-thumbnail" alt="Thumb">
            `;

            taskCard.addEventListener('click', () => showDetail(task));
            leftPanel.appendChild(taskCard);
        });
    } 

    // --- FUNGSI DETAIL DENGAN TOMBOL EDIT & HAPUS ---
    function showDetail(task) {
        const statusColor = getStatusColor(task.status);
        const textPriorityColor = task.priority === 'Extreme' ? 'red' : (task.priority === 'Low' ? '#81c784' : '#ffca28'); 

        rightPanel.innerHTML = `
            <div class="detail-content" id="detail-box">
                <img src="${task.image}" class="detail-banner" alt="Banner">
                <h2>${task.title}</h2>
                <p><strong>Priority:</strong> <span style="color: ${textPriorityColor}; font-weight: bold;">${task.priority}</span></p>
                <p><strong>Status:</strong> <span id="view-status" style="color: ${statusColor}; font-weight: bold;">${task.status}</span></p>
                <p><strong>Deadline:</strong> ${task.deadline || '-'}</p>
                <hr style="margin: 15px 0; border: 0; border-top: 1px solid #eee;">
                <p><strong>Description:</strong><br><span id="view-desc">${task.description || 'Tidak ada deskripsi.'}</span></p>
                
                <div class="task-actions" style="margin-top: 20px; display: flex; gap: 10px; justify-content: flex-end;">
                    <button class="btn-action btn-edit" id="btn-edit-action" style="padding: 8px 15px; border-radius: 8px; border: none; cursor: pointer; background: #eaeaea;">
                        <i class="fas fa-pencil-alt"></i> Edit
                    </button>
                    <button class="btn-action btn-delete" id="btn-delete-action" style="padding: 8px 15px; border-radius: 8px; border: none; cursor: pointer; background: #ff5252; color: white;">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </div>
            </div>
        `;

        // Pasang Event Listener via JS (menghindari error inline onclick pada Laravel)
        document.getElementById('btn-edit-action').addEventListener('click', () => enableEditMode(task));
        document.getElementById('btn-delete-action').addEventListener('click', () => deleteTask(task.id));
    }

    // --- FUNGSI HAPUS TUGAS (SIMULASI) ---
    function deleteTask(id) {
        if(confirm('Hapus tugas ini secara permanen?')) {
            const currentData = JSON.parse(sessionStorage.getItem('mock_tasks'));
            
            // Filter semua data kecuali data ID yang dihapus
            const updatedData = currentData.filter(task => task.id !== id);
            sessionStorage.setItem('mock_tasks', JSON.stringify(updatedData));

            loadTasksFromDB();
            rightPanel.innerHTML = '<div style="text-align:center;margin-top:100px;color:#ccc;">Pilih tugas untuk melihat detail</div>';
        }
    }

    // --- FUNGSI EDIT TUGAS ---
    function enableEditMode(task) {
        const viewDesc = document.getElementById('view-desc');
        const viewStatus = document.getElementById('view-status');
        const actions = document.querySelector('.task-actions');

        viewDesc.innerHTML = `<textarea id="edit-desc" style="width:100%; padding:10px; border-radius:8px; border:1px solid #ddd; margin-top:5px; font-family:inherit;">${task.description}</textarea>`;
        viewStatus.innerHTML = `
            <select id="edit-status" style="padding:5px; border-radius:5px; border:1px solid #ddd; font-family:inherit;">
                <option value="Not Started" ${task.status === 'Not Started' ? 'selected' : ''}>Not Started</option>
                <option value="In Progress" ${task.status === 'In Progress' ? 'selected' : ''}>In Progress</option>
                <option value="Completed" ${task.status === 'Completed' ? 'selected' : ''}>Completed</option>
            </select>`;
        
        actions.innerHTML = `
            <button id="btn-save-update" style="padding: 8px 15px; border-radius: 8px; border: none; background: #2ecc71; color: white; cursor: pointer;">Simpan</button>
            <button id="btn-cancel-update" style="padding: 8px 15px; border-radius: 8px; border: none; background: #ccc; cursor: pointer;">Batal</button>`;

        document.getElementById('btn-save-update').addEventListener('click', () => saveUpdate(task.id));
        document.getElementById('btn-cancel-update').addEventListener('click', () => loadTasksFromDB());
    }

    // --- FUNGSI SIMPAN UPDATE (SIMULASI) ---
    function saveUpdate(id) {
        const newDesc = document.getElementById('edit-desc').value;
        const newStatus = document.getElementById('edit-status').value;

        const currentData = JSON.parse(sessionStorage.getItem('mock_tasks'));
        
        // Cari objek tugas berdasarkan ID dan ubah nilainya
        const taskIndex = currentData.findIndex(task => task.id === id);
        if(taskIndex !== -1) {
            currentData[taskIndex].description = newDesc;
            currentData[taskIndex].status = newStatus;
        }

        sessionStorage.setItem('mock_tasks', JSON.stringify(currentData));

        loadTasksFromDB();
        alert('Tugas diperbarui!');
        
        // Refresh panel detail kanan dengan data yang baru terupdate
        showDetail(currentData[taskIndex]);
    }

    // --- FUNGSI KALENDER ---
    function renderCalendar() {
        calendarDays.innerHTML = ''; 
        const currentMonth = navDate.getMonth(); 
        const currentYear = navDate.getFullYear(); 
        const actualToday = new Date();

        const monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        calendarMonthYear.innerText = `${monthNames[currentMonth]} ${currentYear}`;

        const firstDayOfMonth = new Date(currentYear, currentMonth, 1).getDay(); 
        const daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate(); 

        for (let i = 0; i < firstDayOfMonth; i++) {
            const emptyDiv = document.createElement('div');
            emptyDiv.className = 'calendar-day empty';
            calendarDays.appendChild(emptyDiv);
        }

        for (let i = 1; i <= daysInMonth; i++) {
            const dayDiv = document.createElement('div');
            dayDiv.className = 'calendar-day';
            dayDiv.innerText = i;

            if (i === actualToday.getDate() && currentMonth === actualToday.getMonth() && currentYear === actualToday.getFullYear()) {
                dayDiv.classList.add('today');
            }

            const checkDateStr = `${currentYear}-${String(currentMonth + 1).padStart(2, '0')}-${String(i).padStart(2, '0')}`;
            const tasksOnThisDay = tasks.filter(t => t.deadline === checkDateStr);
            
            if (tasksOnThisDay.length > 0) {
                const indicator = document.createElement('div');
                indicator.className = 'task-indicator';
                
                if(tasksOnThisDay.some(t => t.priority === 'Extreme')) {
                    indicator.classList.add('extreme'); 
                } else if (tasksOnThisDay.every(t => t.priority === 'Low')) {
                    indicator.style.backgroundColor = '#81c784'; 
                }

                dayDiv.appendChild(indicator);
            }

            dayDiv.addEventListener('click', () => {
                document.querySelectorAll('.calendar-day').forEach(d => d.classList.remove('selected'));
                dayDiv.classList.add('selected'); 
                showTasksForDate(checkDateStr, tasksOnThisDay);
            });

            calendarDays.appendChild(dayDiv);
        }
    }

    // --- FUNGSI PREVIEW KALENDER ---
    function showTasksForDate(dateStr, tasksOnThisDay) {
        const previewContainer = document.getElementById('calendar-task-preview');
        const previewList = document.getElementById('preview-task-list');
        const previewTitle = document.getElementById('preview-date-title');

        previewContainer.style.display = 'block';
        previewTitle.innerText = `Tugas tanggal ${dateStr}:`;
        previewList.innerHTML = '';

        if (tasksOnThisDay.length > 0) {
            tasksOnThisDay.forEach(t => {
                let borderColor = '#ffca28'; 
                if (t.priority === 'Extreme') {
                    borderColor = '#ff5252'; 
                } else if (t.priority === 'Low') {
                    borderColor = '#81c784'; 
                }

                previewList.innerHTML += `
                    <div class="preview-item" style="padding:10px; border-radius:8px; background:#f9f9f9; margin-bottom:5px; border-left:4px solid ${borderColor}">
                        <div style="font-weight:bold;">${t.title}</div>
                        <div style="font-size:11px; color:#666;">${t.status} | Priority: <span style="color: ${borderColor}; font-weight: bold;">${t.priority}</span></div>
                    </div>`;
            });
        } else {
            previewList.innerHTML = '<div style="font-size:12px; color:#999; padding: 10px 0;">Tidak ada tugas di tanggal ini. 🎉</div>';
        }
    }
});