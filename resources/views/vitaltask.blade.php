@extends('layouts.main')

@section('title', 'Vital Tasks - YukKerjain!')

@section('content')
    <div class="flex justify-between items-center border-b-2 border-[#ff6b6b] pb-[15px] mb-[30px]">
        <h1 id="page-title" class="text-[#333] text-2xl">Vital Tasks</h1>
        <div style="display:flex; gap:10px;">
            <button class="bg-[#ff6b6b] text-white border-none w-[45px] h-[45px] rounded-full text-xl cursor-pointer transition shadow-[0_4px_10px_rgba(255,107,107,0.3)] hover:scale-110 hover:rotate-90 hover:bg-[#ff5252]" id="btn-calendar" title="Lihat kalender tugas"><i class="fas fa-calendar-alt"></i></button>
            <button class="bg-[#ff6b6b] text-white border-none w-[45px] h-[45px] rounded-full text-xl cursor-pointer transition shadow-[0_4px_10px_rgba(255,107,107,0.3)] hover:scale-110 hover:rotate-90 hover:bg-[#ff5252]" id="btn-open-task-modal"><i class="fas fa-plus"></i></button>
        </div>
    </div>

    <div class="flex gap-[30px]" style="height: calc(100% - 80px);">
        <div class="group flex-1 bg-white rounded-2xl flex flex-col items-center shadow-[0_4px_20px_rgba(0,0,0,0.03)] transition p-10 text-center hover:-translate-y-2 hover:shadow-[0_10px_25px_rgba(0,0,0,0.08)]" id="left-panel" style="justify-content: flex-start; overflow-y: auto;">
            <i class="fas fa-tasks text-6xl text-[#eaeaea] mb-5 transition group-hover:text-[#dcdcdc]"></i>
            <div class="text-lg font-semibold text-[#a0a0a0] mb-2.5">Tidak ada tugas baru!</div>
            <div class="text-sm text-[#c0c0c0]">Pilih tugas untuk melihat detail</div>
        </div>

        <div class="group flex-[1.2] bg-white rounded-2xl flex flex-col items-center justify-center shadow-[0_4px_20px_rgba(0,0,0,0.03)] transition p-10 text-center hover:-translate-y-2 hover:shadow-[0_10px_25px_rgba(0,0,0,0.08)]" id="right-panel">
            <i class="fas fa-mouse-pointer text-6xl text-[#eaeaea] mb-5 transition group-hover:text-[#dcdcdc]" style="transform: rotate(-15deg);"></i>
            <div class="text-sm text-[#c0c0c0]" style="margin-top: 15px;">Pilih tugas untuk melihat detail</div>
        </div>
    </div>
@endsection

@push('modals')
    <div id="modal-overlay" class="hidden fixed inset-0 bg-black/50 items-center justify-center z-[1000]">
        <div class="bg-white p-[30px] rounded-[20px] w-[90%] max-w-[500px] shadow-[0_10px_30px_rgba(0,0,0,0.2)]">
            <div class="flex justify-between items-center mb-5">
                <h2 class="text-[#333]">Tambah Tugas Baru</h2>
                <button id="modal-close" class="bg-[#f0f0f0] border-none rounded-md w-[30px] h-[30px] text-lg cursor-pointer transition hover:bg-[#e0e0e0]">&times;</button>
            </div>

            <form id="task-form">
                <div class="mb-[15px] flex flex-col">
                    <label class="text-sm font-semibold mb-1.5 text-[#333]">Judul Tugas *</label>
                    <input type="text" id="task-title" placeholder="Masukkan judul tugas..." required class="p-2.5 border border-[#ddd] rounded-lg text-sm outline-none focus:border-[#ff6b6b]">
                </div>

                <div class="mb-[15px] flex flex-col">
                    <label class="text-sm font-semibold mb-1.5 text-[#333]">Deskripsi</label>
                    <textarea id="task-desc" placeholder="Deskripsi tugas..." rows="3" class="p-2.5 border border-[#ddd] rounded-lg text-sm outline-none focus:border-[#ff6b6b]"></textarea>
                </div>

                <div class="flex gap-[15px]">
                    <div class="mb-[15px] flex flex-col flex-1">
                        <label class="text-sm font-semibold mb-1.5 text-[#333]">Prioritas</label>
                        <select id="task-priority" class="p-2.5 border border-[#ddd] rounded-lg text-sm outline-none focus:border-[#ff6b6b]">
                            <option value="Normal">Normal</option>
                            <option value="Extreme" selected>Extreme</option>
                        </select>
                    </div>
                    <div class="mb-[15px] flex flex-col flex-1">
                        <label class="text-sm font-semibold mb-1.5 text-[#333]">Status</label>
                        <select id="task-status" class="p-2.5 border border-[#ddd] rounded-lg text-sm outline-none focus:border-[#ff6b6b]">
                            <option value="Not Started">Not Started</option>
                            <option value="In Progress">In Progress</option>
                            <option value="Completed">Completed</option>
                        </select>
                    </div>
                </div>

                <div class="mb-[15px] flex flex-col">
                    <label class="text-sm font-semibold mb-1.5 text-[#333]">Deadline</label>
                    <input type="date" id="task-deadline" class="p-2.5 border border-[#ddd] rounded-lg text-sm outline-none focus:border-[#ff6b6b]">
                </div>

                <button type="button" class="bg-[#ff6b6b] text-white border-none p-3 w-full rounded-lg text-base font-bold cursor-pointer mt-2.5 transition hover:bg-[#ff5252]" id="btn-simpan">Simpan Tugas</button>
            </form>
        </div>
    </div>

    <div id="calendar-modal" class="hidden fixed inset-0 bg-black/50 items-center justify-center z-[1000]">
        <div class="bg-white rounded-[20px] shadow-[0_10px_30px_rgba(0,0,0,0.2)]" style="max-width: 400px; padding: 20px; width: 90%;">
            <div class="flex justify-between items-center" style="margin-bottom: 15px;">
                <div style="display: flex; align-items: center; gap: 15px;">
                    <button id="prev-month" class="w-9 h-9 rounded-md bg-brand text-white flex items-center justify-center transition hover:bg-brand-hover" style="width: 30px; height: 30px; font-size: 12px;"><i class="fas fa-chevron-left"></i></button>
                    <h2 id="calendar-month-year" class="text-[#333]" style="font-size: 16px; margin: 0; min-width: 120px; text-align: center;">Bulan Tahun</h2>
                    <button id="next-month" class="w-9 h-9 rounded-md bg-brand text-white flex items-center justify-center transition hover:bg-brand-hover" style="width: 30px; height: 30px; font-size: 12px;"><i class="fas fa-chevron-right"></i></button>
                </div>
                <button id="calendar-close" class="bg-[#f0f0f0] border-none rounded-md w-[30px] h-[30px] text-lg cursor-pointer transition hover:bg-[#e0e0e0]">&times;</button>
            </div>

            <div class="w-full">
                <div class="grid grid-cols-7 text-center font-semibold mb-2.5 text-[#a0a0a0] text-sm">
                    <div>Min</div><div>Sen</div><div>Sel</div><div>Rab</div><div>Kam</div><div>Jum</div><div>Sab</div>
                </div>
                <div class="grid grid-cols-7 gap-[5px]" id="calendar-days"></div>
            </div>

            <div id="calendar-task-preview" style="margin-top: 15px; padding-top: 15px; border-top: 1px solid #eee; display: none;">
                <h3 class="text-[#333]" style="font-size: 14px; margin-bottom: 10px;" id="preview-date-title">Tugas di tanggal ini:</h3>
                <div id="preview-task-list" style="max-height: 120px; overflow-y: auto; display: flex; flex-direction: column; gap: 8px;"></div>
            </div>
        </div>
    </div>
@endpush

@push('scripts')
    <script src="{{ asset('js/script.js') }}"></script>
@endpush
