@extends('layouts.main')

@section('title', 'Dashboard - YukKerjain!')

@section('content')
    <div class="flex-1 overflow-y-auto py-[30px] px-[35px]">
        <!-- WELCOME SECTION -->
        <div class="flex justify-between items-center mb-[25px]">
            <div>
                <h2 class="text-[30px] font-semibold text-[#333]">Welcome back, {{ $user->first_name ?? $user->name }} <span class="text-[34px]">👋</span></h2>
                <p class="text-sm text-[#666] mt-1">Anda punya {{ $totalTasks }} tugas total</p>
            </div>
            <div class="flex items-center gap-[15px]">
                <div class="flex">
                    <div class="w-[38px] h-[38px] rounded-full text-white flex items-center justify-center text-[13px] font-semibold border-[3px] border-white -ml-3 first:ml-0" style="background: #667eea;">JD</div>
                    <div class="w-[38px] h-[38px] rounded-full text-white flex items-center justify-center text-[13px] font-semibold border-[3px] border-white -ml-3" style="background: #f093fb;">JS</div>
                    <div class="w-[38px] h-[38px] rounded-full text-white flex items-center justify-center text-[13px] font-semibold border-[3px] border-white -ml-3" style="background: #4facfe;">BW</div>
                    <div class="w-[38px] h-[38px] rounded-full text-white flex items-center justify-center text-[13px] font-semibold border-[3px] border-white -ml-3" style="background: #43e97b;">AB</div>
                    <div class="w-[38px] h-[38px] rounded-full text-white flex items-center justify-center text-[13px] font-semibold border-[3px] border-white -ml-3" style="background: #fa709a;">MD</div>
                </div>
                <button class="px-[18px] py-[9px] bg-white text-[#ff5252] border-[1.5px] border-[#ff5252] rounded-lg text-sm font-medium cursor-pointer transition hover:bg-[#ff5252] hover:text-white" onclick="showInviteModal()"><i class="fas fa-user-plus"></i> Invite</button>
            </div>
        </div>

        @if (session('success'))
            <div class="bg-green-50 border border-green-300 text-green-700 text-sm px-4 py-3 rounded-lg mb-[25px]">{{ session('success') }}</div>
        @endif

        <!-- MAIN GRID -->
        <div class="grid gap-[25px]" style="grid-template-columns: 1fr 400px;">
            <!-- LEFT: TO-DO SECTION -->
            <div class="bg-white p-[25px] rounded-2xl shadow-[0_1px_3px_rgba(0,0,0,0.06)]">
                <div class="flex justify-between items-center mb-3">
                    <div class="flex items-center gap-2 text-[17px] font-semibold text-[#333]">
                        <i class="far fa-circle text-[#ff7a7a]"></i>
                        <span>To-Do</span>
                    </div>
                    <button class="bg-transparent border-none text-[#ff7a7a] text-sm font-medium cursor-pointer transition hover:text-[#ff5252]" onclick="showAddTaskModal()">+ Add task</button>
                </div>

                @forelse ($latestTasks as $task)
                    @php
                        $statusName = $task->status->status_name ?? '';
                        $isCompleted = stripos($statusName, 'ompleted') !== false;
                        $isInProgress = stripos($statusName, 'rogress') !== false;
                        $statusColor = $isCompleted ? 'bg-emerald-100 text-emerald-700' : ($isInProgress ? 'bg-blue-100 text-blue-600' : 'bg-gray-100 text-gray-600');
                    @endphp
                    <div class="flex items-start gap-[15px] p-[18px] border border-[#e8eaed] rounded-xl mb-3 relative transition hover:shadow-[0_2px_8px_rgba(0,0,0,0.08)]">
                        <div class="w-[42px] h-[42px] rounded-[10px] flex items-center justify-center text-white text-lg shrink-0 bg-[#ff5252]">
                            <i class="fas fa-check"></i>
                        </div>
                        <div class="flex-1">
                            <h4 class="text-[15px] font-semibold text-[#333] mb-1.5">{{ $task->title }}</h4>
                            @if ($task->description)
                                <p class="text-[13px] text-[#666] leading-relaxed mb-2.5">{{ Str::limit($task->description, 100) }}</p>
                            @endif
                            <div class="flex flex-wrap gap-3 text-[11px]">
                                @if ($task->priority)
                                    <span class="px-2 py-0.5 rounded bg-gray-100 text-gray-600">Priority: {{ $task->priority->priority_name }}</span>
                                @endif
                                @if ($task->status)
                                    <span class="px-2 py-0.5 rounded {{ $statusColor }}">Status: {{ $statusName }}</span>
                                @endif
                                <span class="px-2 py-0.5 rounded text-[#999]">{{ $task->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-12 text-[#999]">
                        <i class="fa fa-inbox text-4xl mb-3 block"></i>
                        Belum ada tugas. Buat tugas pertama Anda!
                    </div>
                @endforelse
            </div>

            <!-- RIGHT: STATUS & COMPLETED -->
            <div class="flex flex-col gap-5">
                <!-- TASK STATUS -->
                <div class="bg-white p-[22px] rounded-2xl shadow-[0_1px_3px_rgba(0,0,0,0.06)]">
                    <div class="flex items-center gap-2 text-base font-semibold text-[#333] mb-5">
                        <i class="fas fa-chart-pie text-[#ff7a7a]"></i>
                        <span>Task Status</span>
                    </div>
                    <div class="grid grid-cols-3 gap-[15px]">
                        <div class="text-center">
                            <svg class="-rotate-90" width="100" height="100">
                                <circle class="fill-none stroke-gray-200" stroke-width="8" cx="50" cy="50" r="40"></circle>
                                <circle class="fill-none [stroke-linecap:round] transition-[stroke-dashoffset] duration-1000 stroke-emerald-500" stroke-width="8" cx="50" cy="50" r="40"
                                    stroke-dasharray="251.2" stroke-dashoffset="{{ 251.2 - (251.2 * $completedPercentage / 100) }}"></circle>
                                <text x="50" y="55" class="text-lg font-bold fill-[#333] rotate-90" style="transform-origin:center;">{{ $completedPercentage }}%</text>
                            </svg>
                            <p class="mt-2 text-xs text-emerald-500">● Completed ({{ $completedTasks }})</p>
                        </div>
                        <div class="text-center">
                            <svg class="-rotate-90" width="100" height="100">
                                <circle class="fill-none stroke-gray-200" stroke-width="8" cx="50" cy="50" r="40"></circle>
                                <circle class="fill-none [stroke-linecap:round] transition-[stroke-dashoffset] duration-1000 stroke-blue-500" stroke-width="8" cx="50" cy="50" r="40"
                                    stroke-dasharray="251.2" stroke-dashoffset="{{ 251.2 - (251.2 * $inProgressPercentage / 100) }}"></circle>
                                <text x="50" y="55" class="text-lg font-bold fill-[#333] rotate-90" style="transform-origin:center;">{{ $inProgressPercentage }}%</text>
                            </svg>
                            <p class="mt-2 text-xs text-blue-500">● In Progress ({{ $inProgressTasks }})</p>
                        </div>
                        <div class="text-center">
                            <svg class="-rotate-90" width="100" height="100">
                                <circle class="fill-none stroke-gray-200" stroke-width="8" cx="50" cy="50" r="40"></circle>
                                <circle class="fill-none [stroke-linecap:round] transition-[stroke-dashoffset] duration-1000 stroke-[#ff5252]" stroke-width="8" cx="50" cy="50" r="40"
                                    stroke-dasharray="251.2" stroke-dashoffset="{{ 251.2 - (251.2 * $notStartedPercentage / 100) }}"></circle>
                                <text x="50" y="55" class="text-lg font-bold fill-[#333] rotate-90" style="transform-origin:center;">{{ $notStartedPercentage }}%</text>
                            </svg>
                            <p class="mt-2 text-xs text-[#ff5252]">● Not Started ({{ $notStartedTasks }})</p>
                        </div>
                    </div>
                </div>

                <!-- COMPLETED TASK -->
                <div class="bg-white p-[22px] rounded-2xl shadow-[0_1px_3px_rgba(0,0,0,0.06)]">
                    <div class="flex items-center gap-2 text-base font-semibold text-[#333] mb-5">
                        <i class="fas fa-check-circle text-[#ff7a7a]"></i>
                        <span>Completed Task</span>
                    </div>

                    @forelse ($recentCompletedTasks as $task)
                        <div class="flex items-start gap-3 p-[15px] border border-[#e8eaed] rounded-[10px] mb-2.5 relative">
                            <i class="fas fa-check-circle text-emerald-500 text-xl shrink-0"></i>
                            <div class="flex-1">
                                <h5 class="text-sm font-semibold text-[#333] mb-1">{{ $task->title }}</h5>
                                @if ($task->description)
                                    <p class="text-xs text-[#666] mb-1.5">{{ Str::limit($task->description, 70) }}</p>
                                @endif
                                <p class="text-[11px] text-[#666]">Status: <span class="text-emerald-500 font-semibold">{{ $task->status->status_name }}</span></p>
                                <p class="text-[11px] text-[#999]">{{ $task->updated_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-[#999] text-center py-6">Belum ada tugas yang selesai.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection

@push('modals')
    <!-- ADD TASK MODAL -->
    <div id="addTaskModal" class="hidden fixed inset-0 bg-black/50 z-[1000] items-center justify-center">
        <div class="absolute inset-0" onclick="hideAddTaskModal()"></div>
        <div class="relative bg-white p-0 rounded-2xl max-w-[600px] w-[90%] max-h-[90vh] overflow-y-auto">
            <div class="flex justify-between items-center px-[30px] py-[25px] border-b border-gray-200">
                <h3 class="text-[22px] text-[#333] m-0">Add New Task</h3>
                <button class="bg-transparent border-none text-3xl text-[#999] cursor-pointer leading-none p-0 w-8 h-8 flex items-center justify-center transition hover:text-[#666]" onclick="hideAddTaskModal()">×</button>
            </div>

            <form method="POST" action="{{ route('tasks.store') }}" class="p-[30px]">
                @csrf
                <div class="mb-5">
                    <label class="block text-sm font-semibold text-[#333] mb-2">Task Title <span class="text-[#ff5252]">*</span></label>
                    <input type="text" name="title" placeholder="Enter task title" class="w-full px-4 py-3 border border-gray-300 rounded-[10px] text-sm transition outline-none focus:border-[#ff5252] focus:shadow-[0_0_0_3px_rgba(255,82,82,0.1)]" required>
                </div>

                <div class="mb-5">
                    <label class="block text-sm font-semibold text-[#333] mb-2">Description</label>
                    <textarea name="description" placeholder="Enter task description" class="w-full px-4 py-3 border border-gray-300 rounded-[10px] text-sm transition outline-none resize-y min-h-[80px] focus:border-[#ff5252] focus:shadow-[0_0_0_3px_rgba(255,82,82,0.1)]" rows="3"></textarea>
                </div>

                <div class="grid grid-cols-2 gap-[15px]">
                    <div class="mb-5">
                        <label class="block text-sm font-semibold text-[#333] mb-2">Priority</label>
                        <select name="task_priority_id" class="w-full px-4 py-3 border border-gray-300 rounded-[10px] text-sm transition outline-none bg-white cursor-pointer focus:border-[#ff5252] focus:shadow-[0_0_0_3px_rgba(255,82,82,0.1)]">
                            <option value="">Select Priority</option>
                            @foreach ($priorities as $priority)
                                <option value="{{ $priority->id }}">{{ $priority->priority_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-5">
                        <label class="block text-sm font-semibold text-[#333] mb-2">Status</label>
                        <select name="task_status_id" class="w-full px-4 py-3 border border-gray-300 rounded-[10px] text-sm transition outline-none bg-white cursor-pointer focus:border-[#ff5252] focus:shadow-[0_0_0_3px_rgba(255,82,82,0.1)]">
                            <option value="">Select Status</option>
                            @foreach ($statuses as $status)
                                <option value="{{ $status->id }}">{{ $status->status_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="flex gap-3 justify-end mt-[30px] pt-5 border-t border-gray-200">
                    <button type="submit" class="px-[30px] py-3 border-none rounded-[10px] text-[15px] font-semibold cursor-pointer transition bg-[#ff5252] text-white hover:bg-[#ff3838] hover:-translate-y-px hover:shadow-[0_4px_12px_rgba(255,82,82,0.3)]">Create Task</button>
                    <button type="button" class="px-[30px] py-3 border-none rounded-[10px] text-[15px] font-semibold cursor-pointer transition bg-gray-100 text-[#666] hover:bg-gray-200" onclick="hideAddTaskModal()">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <!-- INVITE MEMBER MODAL -->
    <div id="inviteModal" class="hidden fixed inset-0 bg-black/50 z-[1000] items-center justify-center">
        <div class="absolute inset-0" onclick="hideInviteModal()"></div>
        <div class="relative bg-white rounded-2xl max-w-[700px] w-[90%] max-h-[85vh] overflow-hidden flex flex-col">
            <div class="flex justify-between items-center px-[30px] py-[25px] border-b-2 border-[#ff5252]">
                <h3 class="text-xl text-[#333] m-0 font-semibold">Send an invite to a new member</h3>
                <button class="bg-transparent border-none text-[#666] text-sm font-semibold cursor-pointer underline px-2.5 py-1 transition hover:text-[#ff5252]" onclick="hideInviteModal()">Go Back</button>
            </div>

            <div class="p-[30px] overflow-y-auto flex-1">
                <div class="mb-[30px]">
                    <label class="block text-[15px] font-semibold text-[#333] mb-2.5">Email</label>
                    <div class="flex gap-2.5">
                        <input type="email" placeholder="newrajgurung99@gmail.com" class="flex-1 px-4 py-3 border border-gray-300 rounded-[10px] text-sm outline-none focus:border-[#ff5252]">
                        <button class="px-7 py-3 bg-[#ff5252] text-white border-none rounded-[10px] text-sm font-semibold cursor-pointer whitespace-nowrap transition hover:bg-[#ff3838]">Send Invite</button>
                    </div>
                </div>

                <div class="mb-[30px]">
                    <h4 class="text-base font-semibold text-[#333] mb-[15px]">Members</h4>

                    <div class="flex items-center gap-[15px] p-[15px] border border-gray-200 rounded-xl mb-3 transition hover:bg-gray-50 hover:border-gray-300">
                        <img src="https://ui-avatars.com/api/?name=Upashna+Gurung&background=667eea&color=fff" alt="Member" class="w-12 h-12 rounded-full object-cover shrink-0">
                        <div class="flex-1">
                            <div class="text-[15px] font-semibold text-[#333] mb-0.5">Upashna Gurung</div>
                            <div class="text-[13px] text-[#666]">upashnag931@gmail.com</div>
                        </div>
                        <select class="pl-3 pr-8 py-2 border border-gray-300 rounded-lg text-[13px] font-medium cursor-pointer bg-white text-[#333]">
                            <option value="edit" selected>Can edit</option>
                            <option value="view">Can view</option>
                            <option value="owner">Owner</option>
                        </select>
                    </div>
                </div>

                <div class="pt-5 border-t border-gray-200">
                    <label class="block text-[15px] font-semibold text-[#333] mb-2.5">Project Link</label>
                    <div class="flex gap-2.5">
                        <input type="text" id="projectLinkInput" value="https://chandnimarestaurant/home.com/4s4060y29" class="flex-1 px-4 py-3 border border-gray-300 rounded-[10px] text-[13px] bg-gray-50 text-[#666]" readonly>
                        <button id="copyLinkBtn" class="px-7 py-3 bg-[#ff5252] text-white border-none rounded-[10px] text-sm font-semibold cursor-pointer whitespace-nowrap transition hover:bg-[#ff3838]">Copy Link</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endpush

@push('scripts')
<script>
    function showAddTaskModal() {
        document.getElementById('addTaskModal').style.display = 'flex';
    }
    function hideAddTaskModal() {
        document.getElementById('addTaskModal').style.display = 'none';
    }
    function showInviteModal() {
        document.getElementById('inviteModal').style.display = 'flex';
    }
    function hideInviteModal() {
        document.getElementById('inviteModal').style.display = 'none';
    }

    document.addEventListener('DOMContentLoaded', function() {
        const copyBtn = document.getElementById('copyLinkBtn');
        if (copyBtn) {
            copyBtn.addEventListener('click', function() {
                const input = document.getElementById('projectLinkInput');
                input.select();
                document.execCommand('copy');
                this.textContent = 'Copied!';
                setTimeout(() => {
                    this.textContent = 'Copy Link';
                }, 2000);
            });
        }
    });
</script>
@endpush
