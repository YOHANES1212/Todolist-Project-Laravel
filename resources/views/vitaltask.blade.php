@extends('layouts.main')

@section('title', 'Vital Tasks - YukKerjain!')

@php
    $priorityColorMap = ['Low' => '#81c784', 'Medium' => '#ffca28', 'High' => '#ff9800', 'Critical' => '#ff5252'];
    $statusColorMap = ['Todo' => '#ff5252', 'In Progress' => '#3498db', 'Done' => '#2ecc71', 'Cancelled' => '#9e9e9e'];
    $statusIcon = function ($name) {
        $name = $name ?? '';
        if (stripos($name, 'rogress') !== false) return 'fa-spinner';
        if (stripos($name, 'ompleted') !== false || stripos($name, 'done') !== false) return 'fa-check';
        if (stripos($name, 'cancel') !== false) return 'fa-ban';
        if (stripos($name, 'not') !== false || stripos($name, 'todo') !== false) return 'fa-hourglass-start';
        return 'fa-clipboard-list';
    };
@endphp

@section('content')
    <div class="flex justify-between items-center border-b-2 border-[#ff6b6b] pb-[15px] mb-[30px]">
        <h1 id="page-title" class="text-[#333] text-2xl">Vital Tasks</h1>
        <div style="display:flex; gap:10px;">
            <button class="bg-[#ff6b6b] text-white border-none w-[45px] h-[45px] rounded-full text-xl cursor-pointer transition shadow-[0_4px_10px_rgba(255,107,107,0.3)] hover:scale-110 hover:rotate-90 hover:bg-[#ff5252]" id="btn-calendar" title="Lihat kalender tugas"><i class="fas fa-calendar-alt"></i></button>
            <button class="bg-[#ff6b6b] text-white border-none w-[45px] h-[45px] rounded-full text-xl cursor-pointer transition shadow-[0_4px_10px_rgba(255,107,107,0.3)] hover:scale-110 hover:rotate-90 hover:bg-[#ff5252]" id="btn-open-task-modal" title="Tambah tugas baru"><i class="fas fa-plus"></i></button>
        </div>
    </div>

    @if (session('success'))
        <div id="flash-msg" class="bg-green-50 border border-green-300 text-green-700 text-sm px-4 py-3 rounded-lg mb-[20px] flex items-center justify-between">
            <span><i class="fa fa-check-circle" style="margin-right:0.5rem;"></i>{{ session('success') }}</span>
            <button type="button" onclick="document.getElementById('flash-msg').remove()" class="bg-transparent border-none text-green-600 cursor-pointer px-1 transition hover:text-green-700"><i class="fa fa-times"></i></button>
        </div>
    @endif

    <div class="flex gap-[30px]" style="height: calc(100% - 80px);">
        <div class="flex-1 bg-white rounded-2xl shadow-[0_4px_20px_rgba(0,0,0,0.03)] p-10" id="left-panel" style="overflow-y: auto;">
            @forelse ($tasks as $task)
                @php
                    $priorityName = $task->priority->priority_name ?? '';
                    $statusName = $task->status->status_name ?? '';
                    $dotColor = $priorityColorMap[$priorityName] ?? '#ffca28';
                    $statusColor = $statusColorMap[$statusName] ?? '#333';
                @endphp
                <div class="task-card w-full bg-white border border-[#eaeaea] rounded-xl px-5 py-[15px] mb-[15px] flex items-center cursor-pointer transition text-left hover:border-[#ff6b6b] hover:shadow-[0_5px_15px_rgba(255,107,107,0.2)] hover:-translate-y-0.5"
                    data-id="{{ $task->id }}"
                    data-title="{{ $task->title }}"
                    data-desc="{{ $task->description }}"
                    data-status-id="{{ $task->task_status_id }}"
                    data-status-name="{{ $statusName }}"
                    data-priority-id="{{ $task->task_priority_id }}"
                    data-priority-name="{{ $priorityName }}"
                    data-deadline="{{ optional($task->deadline)->format('Y-m-d') }}">
                    <div class="w-[48px] h-[48px] rounded-[12px] flex items-center justify-center text-white text-lg mr-[15px] shrink-0 shadow-sm" style="background-color:{{ $dotColor }}">
                        <i class="fas {{ $statusIcon($statusName) }}"></i>
                    </div>
                    <div class="flex-1">
                        <h4 class="text-base text-[#333] mb-1.5">{{ $task->title }}</h4>
                        <p class="text-xs text-[#a0a0a0]">Priority: <span style="color: {{ $dotColor }}; font-weight: bold;">{{ $priorityName ?: '-' }}</span> &nbsp;|&nbsp; Status: <span style="color: {{ $statusColor }}; font-weight: bold;">{{ $statusName ?: '-' }}</span></p>
                    </div>
                </div>
            @empty
                <div class="w-full h-full flex flex-col items-center justify-center text-center">
                    <i class="fas fa-exclamation-circle text-6xl text-[#eaeaea] mb-5"></i>
                    <div class="text-lg font-semibold text-[#a0a0a0] mb-2.5">Belum ada tugas vital!</div>
                    <div class="text-sm text-[#c0c0c0]">Tugas dengan prioritas High/Critical akan muncul di sini</div>
                </div>
            @endforelse
            <div id="no-results" class="w-full text-center text-[#aaa] mt-[50px]" style="display:none;">Tugas tidak ditemukan</div>
        </div>

        <div class="group flex-[1.2] bg-white rounded-2xl flex flex-col items-center justify-center shadow-[0_4px_20px_rgba(0,0,0,0.03)] transition p-10 text-center hover:-translate-y-2 hover:shadow-[0_10px_25px_rgba(0,0,0,0.08)]" id="right-panel">
            <div id="detail-empty">
                <i class="fas fa-mouse-pointer text-6xl text-[#eaeaea] mb-5 transition group-hover:text-[#dcdcdc]" style="transform: rotate(-15deg);"></i>
                <div class="text-sm text-[#c0c0c0]" style="margin-top: 15px;">Pilih tugas untuk melihat detail</div>
            </div>

            <div id="detail-view" class="hidden w-full text-left">
                <div id="dv-banner" class="w-full h-[130px] rounded-xl mb-5 flex items-center justify-center shadow-[0_4px_10px_rgba(0,0,0,0.08)]">
                    <i id="dv-banner-icon" class="fas text-white" style="font-size:44px;"></i>
                </div>
                <h2 id="dv-title" class="mb-5 text-[#333]"></h2>
                <p class="mb-2.5 text-sm leading-relaxed"><strong class="text-[#333]">Priority:</strong> <span id="dv-priority" style="font-weight: bold;"></span></p>
                <p class="mb-2.5 text-sm leading-relaxed"><strong class="text-[#333]">Status:</strong> <span id="dv-status" style="font-weight: bold;"></span></p>
                <p class="mb-2.5 text-sm leading-relaxed"><strong class="text-[#333]">Deadline:</strong> <span id="dv-deadline"></span></p>
                <hr style="margin: 15px 0; border: 0; border-top: 1px solid #eee;">
                <p class="mb-2.5 text-sm leading-relaxed"><strong class="text-[#333]">Description:</strong><br><span id="dv-desc"></span></p>
                <div class="flex gap-2.5 justify-end" style="margin-top: 20px;">
                    <button type="button" id="btn-edit-action" class="px-[15px] py-2 rounded-lg border-none cursor-pointer text-sm flex items-center gap-1.5 transition bg-[#eaeaea] text-[#333] hover:bg-[#ddd]"><i class="fas fa-pencil-alt"></i> Edit</button>
                    <button type="button" id="btn-delete-action" class="px-[15px] py-2 rounded-lg border-none cursor-pointer text-sm flex items-center gap-1.5 transition bg-[#ff5252] text-white hover:bg-[#ff1744]"><i class="fas fa-trash"></i> Hapus</button>
                </div>
            </div>

            <form id="edit-form" method="POST" action="" class="hidden w-full text-left">
                @csrf
                @method('PUT')
                <input type="hidden" name="title" id="ev-title-input">
                <h2 id="ev-title" class="mb-5 text-[#333]"></h2>
                <div class="mb-[15px] flex flex-col">
                    <label class="text-sm font-semibold mb-1.5 text-[#333]">Prioritas</label>
                    <select name="task_priority_id" id="ev-priority" class="p-2.5 border border-[#ddd] rounded-lg text-sm outline-none focus:border-[#ff6b6b]">
                        @foreach ($priorities as $priority)
                            <option value="{{ $priority->id }}">{{ $priority->priority_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-[15px] flex flex-col">
                    <label class="text-sm font-semibold mb-1.5 text-[#333]">Status</label>
                    <select name="task_status_id" id="ev-status" class="p-2.5 border border-[#ddd] rounded-lg text-sm outline-none focus:border-[#ff6b6b]">
                        @foreach ($statuses as $status)
                            <option value="{{ $status->id }}">{{ $status->status_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-[15px] flex flex-col">
                    <label class="text-sm font-semibold mb-1.5 text-[#333]">Deadline</label>
                    <input type="date" name="deadline" id="ev-deadline" class="p-2.5 border border-[#ddd] rounded-lg text-sm outline-none focus:border-[#ff6b6b]">
                </div>
                <div class="mb-[15px] flex flex-col">
                    <label class="text-sm font-semibold mb-1.5 text-[#333]">Deskripsi</label>
                    <textarea name="description" id="ev-desc" rows="3" class="p-2.5 border border-[#ddd] rounded-lg text-sm outline-none focus:border-[#ff6b6b]"></textarea>
                </div>
                <div class="flex gap-2.5 justify-end" style="margin-top: 20px;">
                    <button type="submit" style="padding: 8px 15px; border-radius: 8px; border: none; background: #2ecc71; color: white; cursor: pointer;">Simpan</button>
                    <button type="button" id="btn-cancel-edit" style="padding: 8px 15px; border-radius: 8px; border: none; background: #ccc; cursor: pointer;">Batal</button>
                </div>
            </form>
        </div>
    </div>

    <form id="delete-form" method="POST" action="" style="display:none;">
        @csrf
        @method('DELETE')
    </form>
@endsection

@push('modals')
    <div id="modal-overlay" class="hidden fixed inset-0 bg-black/50 items-center justify-center z-[1000]">
        <div class="bg-white p-[30px] rounded-[20px] w-[90%] max-w-[500px] shadow-[0_10px_30px_rgba(0,0,0,0.2)]">
            <div class="flex justify-between items-center mb-5">
                <h2 class="text-[#333]">Tambah Tugas Baru</h2>
                <button type="button" id="modal-close" class="bg-[#f0f0f0] border-none rounded-md w-[30px] h-[30px] text-lg cursor-pointer transition hover:bg-[#e0e0e0]">&times;</button>
            </div>

            <form id="task-form" method="POST" action="{{ route('tasks.store') }}">
                @csrf
                <div class="mb-[15px] flex flex-col">
                    <label class="text-sm font-semibold mb-1.5 text-[#333]">Judul Tugas *</label>
                    <input type="text" name="title" id="task-title" placeholder="Masukkan judul tugas..." required class="p-2.5 border border-[#ddd] rounded-lg text-sm outline-none focus:border-[#ff6b6b]">
                </div>

                <div class="mb-[15px] flex flex-col">
                    <label class="text-sm font-semibold mb-1.5 text-[#333]">Deskripsi</label>
                    <textarea name="description" id="task-desc" placeholder="Deskripsi tugas..." rows="3" class="p-2.5 border border-[#ddd] rounded-lg text-sm outline-none focus:border-[#ff6b6b]"></textarea>
                </div>

                <div class="flex gap-[15px]">
                    <div class="mb-[15px] flex flex-col flex-1">
                        <label class="text-sm font-semibold mb-1.5 text-[#333]">Prioritas</label>
                        <select name="task_priority_id" id="task-priority" class="p-2.5 border border-[#ddd] rounded-lg text-sm outline-none focus:border-[#ff6b6b]">
                            <option value="">Pilih Prioritas</option>
                            @foreach ($priorities as $priority)
                                <option value="{{ $priority->id }}">{{ $priority->priority_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-[15px] flex flex-col flex-1">
                        <label class="text-sm font-semibold mb-1.5 text-[#333]">Status</label>
                        <select name="task_status_id" id="task-status" class="p-2.5 border border-[#ddd] rounded-lg text-sm outline-none focus:border-[#ff6b6b]">
                            <option value="">Pilih Status</option>
                            @foreach ($statuses as $status)
                                <option value="{{ $status->id }}">{{ $status->status_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mb-[15px] flex flex-col">
                    <label class="text-sm font-semibold mb-1.5 text-[#333]">Deadline</label>
                    <input type="date" name="deadline" id="task-deadline" class="p-2.5 border border-[#ddd] rounded-lg text-sm outline-none focus:border-[#ff6b6b]">
                </div>

                <button type="submit" class="bg-[#ff6b6b] text-white border-none p-3 w-full rounded-lg text-base font-bold cursor-pointer mt-2.5 transition hover:bg-[#ff5252]" id="btn-simpan">Simpan Tugas</button>
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
    <script src="{{ asset('js/task-panel.js') }}"></script>
@endpush
