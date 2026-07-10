@extends('layouts.main')

@section('title', 'Task Categories - YukKerjain!')

@section('content')

    {{-- Flash Message --}}
    @if(session('success'))
    <div id="flash-msg" class="bg-green-50 border border-green-300 text-green-700 text-sm px-4 py-3 rounded-lg flex items-center justify-between">
      <span><i class="fa fa-check-circle" style="margin-right:0.5rem;"></i>{{ session('success') }}</span>
      <button onclick="document.getElementById('flash-msg').remove()" class="bg-transparent border-none text-green-600 cursor-pointer px-1 transition hover:text-green-700">
        <i class="fa fa-times"></i>
      </button>
    </div>
    @endif

    {{-- ============================================================
         CARD: Task Categories Header (title + Add Category btn)
         ============================================================ --}}
    <div id="view-categories">

      {{-- Top card: title + button --}}
      <div class="bg-white rounded-xl shadow-[0_1px_3px_rgba(0,0,0,0.07),0_1px_2px_rgba(0,0,0,0.04)] px-8 py-6 mb-5">
        <div class="flex items-start justify-between mb-5">
          <div>
            <h2 class="inline-block relative pb-1.5 text-lg font-bold text-gray-800 after:content-[''] after:absolute after:left-0 after:bottom-0 after:w-10 after:h-[3px] after:bg-brand after:rounded-sm">Task Categories</h2>
          </div>
          <a href="#" class="text-sm text-gray-500 font-medium transition hover:text-gray-700">Go Back</a>
        </div>

        <button onclick="showView()" class="inline-flex items-center gap-2 bg-brand hover:bg-brand-hover active:scale-95 text-white text-sm font-semibold px-5 py-2 rounded-lg shadow-sm transition cursor-pointer">
          <i class="fa fa-plus" style="font-size:11px;"></i> Add Category
        </button>
      </div>

      {{-- ---- CARD: Task Status ---- --}}
      <div class="bg-white rounded-xl shadow-[0_1px_3px_rgba(0,0,0,0.07),0_1px_2px_rgba(0,0,0,0.04)] px-8 py-6 mb-5">
        <div class="flex items-center justify-between mb-5">
          <h3 class="inline-block relative pb-1.5 text-sm font-bold text-gray-800 after:content-[''] after:absolute after:left-0 after:bottom-0 after:w-10 after:h-[3px] after:bg-brand after:rounded-sm">Task Status</h3>
          <a href="#" onclick="openAddModal('status'); return false;" class="text-sm text-brand font-medium inline-flex items-center gap-1 transition hover:text-[#c03030]">
            <i class="fa fa-plus" style="font-size:11px;"></i> Add Task Status
          </a>
        </div>

        {{-- Table --}}
        <div class="border border-gray-200 rounded-xl overflow-hidden">
          <table class="w-full text-sm border-collapse">
            <thead>
              <tr class="border-b border-gray-200">
                <th class="w-20 px-6 py-3 text-center text-sm font-semibold text-gray-700">SN</th>
                <th class="px-6 py-3 text-center text-sm font-semibold text-gray-700">Task Status</th>
                <th class="w-52 px-6 py-3 text-center text-sm font-semibold text-gray-700">Action</th>
              </tr>
            </thead>
            <tbody>
              @forelse($statuses as $index => $status)
              <tr class="border-b border-gray-100 last:border-b-0 transition hover:bg-gray-50">
                <td class="px-6 py-4 text-center text-sm text-gray-500">{{ $index + 1 }}</td>
                <td class="px-6 py-4 text-center text-sm text-gray-700">{{ $status->status_name }}</td>
                <td class="px-6 py-4 text-center text-sm text-gray-700">
                  <div class="flex items-center justify-center gap-2">
                    <button
                      onclick="openEditModal('status', {{ $status->id }}, '{{ addslashes($status->status_name) }}')"
                      class="inline-flex items-center gap-1.5 bg-brand hover:bg-brand-hover active:scale-95 text-white text-xs font-semibold px-4 py-1.5 rounded-md shadow-sm transition cursor-pointer">
                      <i class="fa fa-edit"></i> Edit
                    </button>
                    <button
                      onclick="openDeleteModal('status', {{ $status->id }}, '{{ addslashes($status->status_name) }}')"
                      class="inline-flex items-center gap-1.5 bg-brand hover:bg-brand-hover active:scale-95 text-white text-xs font-semibold px-4 py-1.5 rounded-md shadow-sm transition cursor-pointer">
                      <i class="fa fa-trash"></i> Delete
                    </button>
                  </div>
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="3" class="p-8 text-center text-sm text-gray-400 italic">Belum ada data Task Status.</td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>

      {{-- ---- CARD: Task Priority ---- --}}
      <div class="bg-white rounded-xl shadow-[0_1px_3px_rgba(0,0,0,0.07),0_1px_2px_rgba(0,0,0,0.04)] px-8 py-6">
        <div class="flex items-center justify-between mb-5">
          <h3 class="inline-block relative pb-1.5 text-sm font-bold text-gray-800 after:content-[''] after:absolute after:left-0 after:bottom-0 after:w-10 after:h-[3px] after:bg-brand after:rounded-sm">Task Priority</h3>
          <a href="#" onclick="openAddModal('priority'); return false;" class="text-sm text-brand font-medium inline-flex items-center gap-1 transition hover:text-[#c03030]">
            <i class="fa fa-plus" style="font-size:11px;"></i> Add New Priority
          </a>
        </div>

        {{-- Table --}}
        <div class="border border-gray-200 rounded-xl overflow-hidden">
          <table class="w-full text-sm border-collapse">
            <thead>
              <tr class="border-b border-gray-200">
                <th class="w-20 px-6 py-3 text-center text-sm font-semibold text-gray-700">SN</th>
                <th class="px-6 py-3 text-center text-sm font-semibold text-gray-700">Task Priority</th>
                <th class="w-52 px-6 py-3 text-center text-sm font-semibold text-gray-700">Action</th>
              </tr>
            </thead>
            <tbody>
              @forelse($priorities as $index => $priority)
              <tr class="border-b border-gray-100 last:border-b-0 transition hover:bg-gray-50">
                <td class="px-6 py-4 text-center text-sm text-gray-500">{{ $index + 1 }}</td>
                <td class="px-6 py-4 text-center text-sm text-gray-700">{{ $priority->priority_name }}</td>
                <td class="px-6 py-4 text-center text-sm text-gray-700">
                  <div class="flex items-center justify-center gap-2">
                    <button
                      onclick="openEditModal('priority', {{ $priority->id }}, '{{ addslashes($priority->priority_name) }}')"
                      class="inline-flex items-center gap-1.5 bg-brand hover:bg-brand-hover active:scale-95 text-white text-xs font-semibold px-4 py-1.5 rounded-md shadow-sm transition cursor-pointer">
                      <i class="fa fa-edit"></i> Edit
                    </button>
                    <button
                      onclick="openDeleteModal('priority', {{ $priority->id }}, '{{ addslashes($priority->priority_name) }}')"
                      class="inline-flex items-center gap-1.5 bg-brand hover:bg-brand-hover active:scale-95 text-white text-xs font-semibold px-4 py-1.5 rounded-md shadow-sm transition cursor-pointer">
                      <i class="fa fa-trash"></i> Delete
                    </button>
                  </div>
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="3" class="p-8 text-center text-sm text-gray-400 italic">Belum ada data Task Priority.</td>
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
      <div class="bg-white rounded-xl shadow-[0_1px_3px_rgba(0,0,0,0.07),0_1px_2px_rgba(0,0,0,0.04)] px-8 py-6">
        <div class="flex items-start justify-between mb-6">
          <div>
            <h2 class="inline-block relative pb-1.5 text-lg font-bold text-gray-800 after:content-[''] after:absolute after:left-0 after:bottom-0 after:w-10 after:h-[3px] after:bg-brand after:rounded-sm">Create Categories</h2>
          </div>
          <a href="#" onclick="showCategories(); return false;" class="text-sm text-gray-500 font-medium transition hover:text-gray-700">Go Back</a>
        </div>
        <form action="{{ route('task_kategori.storeStatus') }}" method="POST" class="max-w-md">
          @csrf
          <div class="mb-5">
            <label class="block text-xs font-medium text-gray-600 mb-1.5">Category Name</label>
            <input type="text" name="status_name" id="categoryName" required class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm outline-none transition text-gray-800 focus:border-transparent focus:shadow-[0_0_0_3px_rgba(240,82,82,0.25)]"/>
          </div>
          <div class="flex gap-3">
            <button type="submit" class="inline-flex items-center gap-2 bg-brand hover:bg-brand-hover active:scale-95 text-white text-sm font-semibold px-5 py-2 rounded-lg shadow-sm transition cursor-pointer">Create</button>
            <button type="button" onclick="showCategories()" class="inline-flex items-center gap-2 bg-gray-200 hover:bg-gray-300 active:scale-95 text-gray-700 text-sm font-semibold px-5 py-2 rounded-lg transition cursor-pointer">Cancel</button>
          </div>
        </form>
      </div>
    </div>

@endsection

@push('modals')
    {{-- ======================== MODAL: ADD STATUS / PRIORITY ======================== --}}
    <div id="modal-add" class="hidden fixed inset-0 z-50 items-center justify-center bg-black/50">
      <div class="bg-white rounded-xl shadow-2xl w-full max-w-md mx-4">
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
          <h2 id="modal-add-title" class="text-sm font-bold text-gray-800">Add Task Status</h2>
          <button onclick="closeAddModal()" class="text-xs text-gray-400 underline transition hover:text-gray-600 cursor-pointer bg-transparent border-none">Go Back</button>
        </div>
        <div class="p-6">
          <form id="modal-add-form" method="POST">
            @csrf
            <div class="mb-5">
              <label id="modal-add-label" class="block text-xs font-medium text-gray-600 mb-1.5">Name</label>
              <input type="text" id="modal-add-input" name="add_value" required class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm outline-none transition text-gray-800 focus:border-transparent focus:shadow-[0_0_0_3px_rgba(240,82,82,0.25)]"/>
            </div>
            <div class="flex gap-3">
              <button type="submit" class="inline-flex items-center gap-2 bg-brand hover:bg-brand-hover active:scale-95 text-white text-sm font-semibold px-5 py-2 rounded-lg shadow-sm transition cursor-pointer">Save</button>
              <button type="button" onclick="closeAddModal()" class="inline-flex items-center gap-2 bg-gray-200 hover:bg-gray-300 active:scale-95 text-gray-700 text-sm font-semibold px-5 py-2 rounded-lg transition cursor-pointer">Cancel</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    {{-- ======================== MODAL: EDIT ======================== --}}
    <div id="modal-overlay" class="hidden fixed inset-0 z-50 items-center justify-center bg-black/50">
      <div class="bg-white rounded-xl shadow-2xl w-full max-w-md mx-4">
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
          <h2 id="modal-title" class="text-sm font-bold text-gray-800">Edit Task</h2>
          <button onclick="closeModal()" class="text-xs text-gray-400 underline transition hover:text-gray-600 cursor-pointer bg-transparent border-none">Go Back</button>
        </div>
        <div class="p-6">
          <form id="modal-form" method="POST">
            @csrf
            <input type="hidden" name="_method" value="PUT"/>
            <div class="mb-5">
              <label id="modal-label" class="block text-xs font-medium text-gray-600 mb-1.5">Name</label>
              <input type="text" id="modal-input" name="edit_value" required class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm outline-none transition text-gray-800 focus:border-transparent focus:shadow-[0_0_0_3px_rgba(240,82,82,0.25)]"/>
            </div>
            <div class="flex gap-3">
              <button type="submit" class="inline-flex items-center gap-2 bg-brand hover:bg-brand-hover active:scale-95 text-white text-sm font-semibold px-5 py-2 rounded-lg shadow-sm transition cursor-pointer">Update</button>
              <button type="button" onclick="closeModal()" class="inline-flex items-center gap-2 bg-gray-200 hover:bg-gray-300 active:scale-95 text-gray-700 text-sm font-semibold px-5 py-2 rounded-lg transition cursor-pointer">Cancel</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    {{-- ======================== MODAL: DELETE CONFIRM ======================== --}}
    <div id="modal-delete" class="hidden fixed inset-0 z-50 items-center justify-center bg-black/50">
      <div class="bg-white rounded-xl shadow-2xl w-full max-w-sm mx-4">
        <div class="p-6 text-center">
          {{-- Icon --}}
          <div class="w-14 h-14 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <i class="fa fa-trash text-brand text-xl"></i>
          </div>
          <p class="text-base font-bold text-gray-800 mb-1">Hapus Data?</p>
          <p class="text-sm text-gray-500 mb-1">Kamu yakin ingin menghapus:</p>
          <p id="modal-delete-name" class="text-sm font-semibold text-gray-700 mb-5"></p>
          <p class="text-xs text-gray-400 mb-6">Tindakan ini tidak bisa dibatalkan.</p>
          <div class="flex gap-3 justify-center">
            <form id="modal-delete-form" method="POST">
              @csrf
              @method('DELETE')
              <button type="submit" class="inline-flex items-center gap-2 bg-brand hover:bg-brand-hover active:scale-95 text-white text-sm font-semibold px-5 py-2 rounded-lg shadow-sm transition cursor-pointer">Ya, Hapus</button>
            </form>
            <button onclick="closeDeleteModal()" class="inline-flex items-center gap-2 bg-gray-200 hover:bg-gray-300 active:scale-95 text-gray-700 text-sm font-semibold px-5 py-2 rounded-lg transition cursor-pointer">Batal</button>
          </div>
        </div>
      </div>
    </div>
@endpush

@push('scripts')
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
    modal.classList.add('flex');
    setTimeout(() => input.focus(), 50);
  }
  function closeAddModal() {
    const modal = document.getElementById('modal-add');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
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
    overlay.classList.add('flex');
    setTimeout(() => input.focus(), 50);
  }
  function closeModal() {
    const overlay = document.getElementById('modal-overlay');
    overlay.classList.add('hidden');
    overlay.classList.remove('flex');
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
    modal.classList.add('flex');
  }
  function closeDeleteModal() {
    const modal = document.getElementById('modal-delete');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
  }
  document.getElementById('modal-delete').addEventListener('click', function(e) {
    if (e.target === this) closeDeleteModal();
  });
</script>
@endpush
