document.addEventListener('DOMContentLoaded', function () {

    // --- ELEMEN ---
    const btnAdd = document.getElementById('btn-open-task-modal');
    const modalOverlay = document.getElementById('modal-overlay');
    const btnClose = document.getElementById('modal-close');
    const leftPanel = document.getElementById('left-panel');
    const noResults = document.getElementById('no-results');

    const detailEmpty = document.getElementById('detail-empty');
    const detailView = document.getElementById('detail-view');
    const editForm = document.getElementById('edit-form');
    const deleteForm = document.getElementById('delete-form');

    const btnCalendar = document.getElementById('btn-calendar');
    const calendarModal = document.getElementById('calendar-modal');
    const calendarClose = document.getElementById('calendar-close');
    const calendarDays = document.getElementById('calendar-days');
    const calendarMonthYear = document.getElementById('calendar-month-year');

    const searchInput = document.querySelector('.search-input');

    let navDate = new Date();

    const PRIORITY_COLORS = { Low: '#81c784', Medium: '#ffca28', High: '#ff9800', Critical: '#ff5252' };
    const STATUS_COLORS = { Todo: '#ff5252', 'In Progress': '#3498db', Done: '#2ecc71', Cancelled: '#9e9e9e' };
    function priorityColor(name) { return PRIORITY_COLORS[name] || '#ffca28'; }
    function statusColor(name) { return STATUS_COLORS[name] || '#333'; }

    function statusIcon(name) {
        name = (name || '').toLowerCase();
        if (name.includes('rogress')) return 'fa-spinner';
        if (name.includes('ompleted') || name.includes('done')) return 'fa-check';
        if (name.includes('cancel')) return 'fa-ban';
        if (name.includes('not') || name.includes('todo')) return 'fa-hourglass-start';
        return 'fa-clipboard-list';
    }

    function shadeColor(hex, percent) {
        const num = parseInt(hex.replace('#', ''), 16);
        let r = Math.max(Math.min(255, (num >> 16) + percent), 0);
        let g = Math.max(Math.min(255, ((num >> 8) & 0x00FF) + percent), 0);
        let b = Math.max(Math.min(255, (num & 0x0000FF) + percent), 0);
        return '#' + (0x1000000 + r * 0x10000 + g * 0x100 + b).toString(16).slice(1);
    }

    // --- FUNGSI BUKA TUTUP MODAL TAMBAH TUGAS ---
    if (btnAdd) btnAdd.addEventListener('click', () => modalOverlay.style.display = 'flex');
    if (btnClose) btnClose.addEventListener('click', () => modalOverlay.style.display = 'none');

    if (btnCalendar) {
        btnCalendar.addEventListener('click', () => {
            calendarModal.style.display = 'flex';
            navDate = new Date();
            document.getElementById('calendar-task-preview').style.display = 'none';
            renderCalendar();
        });
    }
    if (calendarClose) calendarClose.addEventListener('click', () => calendarModal.style.display = 'none');

    document.getElementById('prev-month').addEventListener('click', () => {
        navDate.setMonth(navDate.getMonth() - 1);
        renderCalendar();
    });

    document.getElementById('next-month').addEventListener('click', () => {
        navDate.setMonth(navDate.getMonth() + 1);
        renderCalendar();
    });

    // --- FUNGSI PENCARIAN (filter card yang sudah dirender server) ---
    if (searchInput) {
        searchInput.addEventListener('input', function () {
            const keyword = this.value.toLowerCase();
            let visibleCount = 0;

            document.querySelectorAll('.task-card').forEach(card => {
                const title = (card.dataset.title || '').toLowerCase();
                const desc = (card.dataset.desc || '').toLowerCase();
                const match = title.includes(keyword) || desc.includes(keyword);
                card.classList.toggle('hidden', !match);
                if (match) visibleCount++;
            });

            if (noResults) noResults.style.display = visibleCount === 0 ? 'block' : 'none';
        });
    }

    // --- PANEL DETAIL: klik task card ---
    function showDetail(card) {
        detailEmpty.classList.add('hidden');
        editForm.classList.add('hidden');
        detailView.classList.remove('hidden');

        const d = card.dataset;

        const pColor = priorityColor(d.priorityName);
        const banner = document.getElementById('dv-banner');
        banner.style.background = `linear-gradient(135deg, ${pColor} 0%, ${shadeColor(pColor, -35)} 100%)`;
        document.getElementById('dv-banner-icon').className = 'fas ' + statusIcon(d.statusName) + ' text-white';

        document.getElementById('dv-title').textContent = d.title;
        const dvPriority = document.getElementById('dv-priority');
        dvPriority.textContent = d.priorityName || '-';
        dvPriority.style.color = priorityColor(d.priorityName);

        const dvStatus = document.getElementById('dv-status');
        dvStatus.textContent = d.statusName || '-';
        dvStatus.style.color = statusColor(d.statusName);

        document.getElementById('dv-deadline').textContent = d.deadline || '-';
        document.getElementById('dv-desc').textContent = d.desc || 'Tidak ada deskripsi.';

        document.getElementById('btn-edit-action').onclick = () => enableEditMode(card);
        document.getElementById('btn-delete-action').onclick = () => deleteTask(d.id, d.title);
    }

    document.querySelectorAll('.task-card').forEach(card => {
        card.addEventListener('click', () => showDetail(card));
    });

    // --- HAPUS TUGAS ---
    function deleteTask(id, title) {
        if (confirm('Hapus tugas "' + title + '" secara permanen?')) {
            deleteForm.action = '/tasks/' + id;
            deleteForm.submit();
        }
    }

    // --- EDIT TUGAS ---
    function enableEditMode(card) {
        const d = card.dataset;

        detailView.classList.add('hidden');
        editForm.classList.remove('hidden');

        editForm.action = '/tasks/' + d.id;
        document.getElementById('ev-title').textContent = d.title;
        document.getElementById('ev-title-input').value = d.title;
        document.getElementById('ev-priority').value = d.priorityId || '';
        document.getElementById('ev-status').value = d.statusId || '';
        document.getElementById('ev-deadline').value = d.deadline || '';
        document.getElementById('ev-desc').value = d.desc || '';

        document.getElementById('btn-cancel-edit').onclick = () => {
            editForm.classList.add('hidden');
            showDetail(card);
        };
    }

    // --- FUNGSI KALENDER ---
    const CALENDAR_DAY_BASE = 'aspect-square flex flex-col items-center justify-center rounded-lg text-sm font-medium transition relative';

    function renderCalendar() {
        calendarDays.innerHTML = '';
        const currentMonth = navDate.getMonth();
        const currentYear = navDate.getFullYear();
        const actualToday = new Date();

        const monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        calendarMonthYear.innerText = `${monthNames[currentMonth]} ${currentYear}`;

        const firstDayOfMonth = new Date(currentYear, currentMonth, 1).getDay();
        const daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();

        const allCards = document.querySelectorAll('.task-card');

        for (let i = 0; i < firstDayOfMonth; i++) {
            const emptyDiv = document.createElement('div');
            emptyDiv.className = CALENDAR_DAY_BASE + ' cursor-default';
            calendarDays.appendChild(emptyDiv);
        }

        for (let i = 1; i <= daysInMonth; i++) {
            const dayDiv = document.createElement('div');
            const isToday = i === actualToday.getDate() && currentMonth === actualToday.getMonth() && currentYear === actualToday.getFullYear();
            dayDiv.className = CALENDAR_DAY_BASE + ' cursor-pointer ' + (isToday ? 'bg-[#ff6b6b] text-white hover:bg-[#ff5252]' : 'text-[#333] hover:bg-[#f0f0f0]');
            dayDiv.innerText = i;

            const checkDateStr = `${currentYear}-${String(currentMonth + 1).padStart(2, '0')}-${String(i).padStart(2, '0')}`;
            const tasksOnThisDay = Array.from(allCards).filter(c => c.dataset.deadline === checkDateStr);

            if (tasksOnThisDay.length > 0) {
                const indicator = document.createElement('div');
                let dotColor = '#ffca28';
                if (tasksOnThisDay.some(c => c.dataset.priorityName === 'Critical')) {
                    dotColor = '#ff5252';
                } else if (tasksOnThisDay.every(c => c.dataset.priorityName === 'Low')) {
                    dotColor = '#81c784';
                }
                indicator.className = 'w-[5px] h-[5px] rounded-full absolute bottom-[5px]';
                indicator.style.backgroundColor = isToday ? '#ffffff' : dotColor;
                dayDiv.appendChild(indicator);
            }

            dayDiv.addEventListener('click', () => {
                document.querySelectorAll('#calendar-days > div').forEach(dd => dd.classList.remove('border-2', 'border-[#ff6b6b]'));
                dayDiv.classList.add('border-2', 'border-[#ff6b6b]');
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
            tasksOnThisDay.forEach(c => {
                const d = c.dataset;
                const borderColor = priorityColor(d.priorityName);

                const item = document.createElement('div');
                item.className = 'text-[13px] text-left';
                item.style.cssText = `padding:10px; border-radius:8px; background:#f9f9f9; margin-bottom:5px; border-left:4px solid ${borderColor}`;

                const titleEl = document.createElement('div');
                titleEl.style.fontWeight = 'bold';
                titleEl.textContent = d.title;

                const metaEl = document.createElement('div');
                metaEl.style.cssText = 'font-size:11px; color:#666;';
                metaEl.textContent = (d.statusName || '-') + ' | Priority: ';

                const priorityEl = document.createElement('span');
                priorityEl.style.cssText = `color: ${borderColor}; font-weight: bold;`;
                priorityEl.textContent = d.priorityName || '-';
                metaEl.appendChild(priorityEl);

                item.appendChild(titleEl);
                item.appendChild(metaEl);
                previewList.appendChild(item);
            });
        } else {
            const empty = document.createElement('div');
            empty.style.cssText = 'font-size:12px; color:#999; padding: 10px 0;';
            empty.textContent = 'Tidak ada tugas di tanggal ini. 🎉';
            previewList.appendChild(empty);
        }
    }
});
