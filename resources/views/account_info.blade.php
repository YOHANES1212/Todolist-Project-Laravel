@extends('layouts.main')

@section('title', 'Account Information - YukKerjain!')

@section('content')
    <div class="bg-white rounded-[10px] p-[30px] shadow-[0_2px_10px_rgba(0,0,0,0.05)]">
        <div class="flex justify-between items-center flex-wrap gap-[15px] mb-7">
            <div>
                <h2 class="text-[28px] text-[#222] m-0">Account Information</h2>
            </div>
        </div>

        @if (!empty($errors))
            <div style="color:#B91C1C; margin-bottom:16px; font-size:14px;">
                {!! implode('<br>', $errors) !!}
            </div>
        @endif
        @if ($success)
            <div style="color:#10B981; margin-bottom:16px; font-size:14px;">
                {{ $success }}
            </div>
        @endif

        <div class="bg-white rounded-[24px] p-[34px] shadow-[0_26px_60px_rgba(0,0,0,0.08)] max-w-[920px] mx-auto">
            <div class="flex items-center gap-5 mb-[30px]">
                <div class="group relative w-[100px] h-[100px] rounded-[22px] overflow-hidden shrink-0">
                    <img id="profileAvatar" src="{{ asset($profile_pic) }}" alt="profile" class="w-full h-full object-cover rounded-[22px] transition group-hover:scale-[1.04]">
                </div>
                <div class="relative flex flex-col items-center gap-3">
                    <button type="button" id="editPhotoBtn" class="inline-flex items-center gap-2.5 px-[18px] py-2.5 rounded-full border border-[rgba(255,107,107,0.25)] bg-[#ff6b6b] text-white font-semibold cursor-pointer transition hover:-translate-y-px hover:shadow-[0_10px_25px_rgba(255,107,107,0.18)] hover:bg-[#ff5252]" onclick="togglePhotoModal()">
                        <i class="fas fa-pen text-sm"></i> Edit
                    </button>
                </div>
                <div>
                    <h3 class="text-2xl mb-1.5 text-[#222]">{{ $first_name }} {{ $last_name }}</h3>
                    <p class="m-0 text-[#6b6b6b]">{{ $email }}</p>
                </div>
            </div>

            <form id="photoForm" class="max-w-[600px]" method="post" action="{{ route('account.info.update') }}" enctype="multipart/form-data">
                @csrf
                <input id="profile_pic_input" type="file" name="profile_pic" accept="image/*" style="display:none;">
                <input id="remove_photo" type="hidden" name="remove_photo" value="no">
                <div class="flex gap-5 flex-wrap">
                    <div class="flex-1 min-w-[220px] mb-[25px]">
                        <label for="first-name" class="block text-sm font-semibold text-[#444] mb-2.5">First Name</label>
                        <input id="first-name" type="text" name="first_name" value="{{ $first_name }}" required class="w-full px-4 py-3.5 border border-[#ddd] rounded-[14px] text-sm transition bg-[#f9f9f9] outline-none focus:border-[#ff7a00] focus:bg-white focus:shadow-[0_0_0_4px_rgba(255,122,0,0.1)] placeholder:text-[#999]">
                    </div>
                    <div class="flex-1 min-w-[220px] mb-[25px]">
                        <label for="last-name" class="block text-sm font-semibold text-[#444] mb-2.5">Last Name</label>
                        <input id="last-name" type="text" name="last_name" value="{{ $last_name }}" required class="w-full px-4 py-3.5 border border-[#ddd] rounded-[14px] text-sm transition bg-[#f9f9f9] outline-none focus:border-[#ff7a00] focus:bg-white focus:shadow-[0_0_0_4px_rgba(255,122,0,0.1)] placeholder:text-[#999]">
                    </div>
                </div>
                <div class="flex gap-5 flex-wrap">
                    <div class="w-full mb-[25px]">
                        <label for="email" class="block text-sm font-semibold text-[#444] mb-2.5">Email Address</label>
                        <input id="email" type="email" name="email" value="{{ $email }}" required class="w-full px-4 py-3.5 border border-[#ddd] rounded-[14px] text-sm transition bg-[#f9f9f9] outline-none focus:border-[#ff7a00] focus:bg-white focus:shadow-[0_0_0_4px_rgba(255,122,0,0.1)] placeholder:text-[#999]">
                    </div>
                </div>
                <div class="flex gap-5 flex-wrap">
                    <div class="flex-1 min-w-[220px] mb-[25px]">
                        <label for="age" class="block text-sm font-semibold text-[#444] mb-2.5">Age</label>
                        <input id="age" type="number" name="age" min="0" value="{{ $age }}" class="w-full px-4 py-3.5 border border-[#ddd] rounded-[14px] text-sm transition bg-[#f9f9f9] outline-none focus:border-[#ff7a00] focus:bg-white focus:shadow-[0_0_0_4px_rgba(255,122,0,0.1)] placeholder:text-[#999]">
                    </div>
                    <div class="flex-1 min-w-[220px] mb-[25px]">
                        <label for="school" class="block text-sm font-semibold text-[#444] mb-2.5">School/University</label>
                        <input id="school" type="text" name="school" value="{{ $school }}" class="w-full px-4 py-3.5 border border-[#ddd] rounded-[14px] text-sm transition bg-[#f9f9f9] outline-none focus:border-[#ff7a00] focus:bg-white focus:shadow-[0_0_0_4px_rgba(255,122,0,0.1)] placeholder:text-[#999]">
                    </div>
                </div>
                <div class="flex gap-5 flex-wrap">
                    <div class="w-full mb-[25px]">
                        <label for="social_media" class="block text-sm font-semibold text-[#444] mb-2.5">Social Media Link</label>
                        <input id="social_media" type="url" name="social_media" value="{{ $social_media }}" placeholder="https://..." class="w-full px-4 py-3.5 border border-[#ddd] rounded-[14px] text-sm transition bg-[#f9f9f9] outline-none focus:border-[#ff7a00] focus:bg-white focus:shadow-[0_0_0_4px_rgba(255,122,0,0.1)] placeholder:text-[#999]">
                    </div>
                </div>
                <div class="flex gap-[15px] mt-[30px]">
                    <button type="submit" class="bg-[#ff6b6b] text-white border-none px-[30px] py-3 rounded-[5px] cursor-pointer text-sm font-semibold transition hover:bg-[#ff5252] hover:shadow-[0_4px_12px_rgba(255,107,107,0.3)] hover:-translate-y-0.5 active:translate-y-0">Save Changes</button>
                    <a href="{{ route('profile') }}" class="bg-white text-[#333] border border-[#ddd] px-[30px] py-3 rounded-[14px] cursor-pointer text-sm font-semibold transition hover:bg-[#f7f7f7] inline-block text-center">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('modals')
    <div id="photoModal" class="hidden fixed inset-0 z-[1000] items-center justify-center">
        <div class="fixed inset-0 bg-black/50 z-[999] animate-fade-in" onclick="closePhotoModal()"></div>
        <div class="relative bg-white rounded-[20px] w-[90%] max-w-[480px] shadow-[0_20px_60px_rgba(0,0,0,0.2),0_0_1px_rgba(0,0,0,0.1)] overflow-hidden z-[1001] animate-slide-up">
            <div class="px-6 pt-6 pb-5 flex items-center justify-between border-b border-[#f0f0f0] bg-white">
                <h3 class="text-lg font-bold text-gray-800 m-0 tracking-[-0.3px]">Change Profile Photo</h3>
                <button type="button" class="bg-gray-100 border-none w-9 h-9 rounded-full cursor-pointer flex items-center justify-center text-gray-500 text-base transition hover:bg-gray-200 hover:text-gray-700 hover:rotate-90 active:scale-95" onclick="closePhotoModal()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="flex flex-col px-4 pt-3 pb-4 gap-2.5">
                <button type="button" class="group/opt flex items-center gap-4 px-[18px] py-4 bg-gray-50 border border-gray-200 rounded-xl cursor-pointer transition text-left w-full text-sm outline-none hover:bg-blue-50 hover:border-blue-500 hover:translate-x-1 active:scale-[0.98] focus:outline focus:outline-2 focus:outline-blue-500" onclick="openUpload('camera')">
                    <div class="flex items-center justify-center w-11 h-11 rounded-[10px] text-xl shrink-0 transition shadow-[0_2px_8px_rgba(0,0,0,0.08)] bg-gradient-to-br from-blue-100 to-blue-200 text-blue-800 group-hover/opt:scale-[1.15] group-hover/opt:shadow-[0_4px_12px_rgba(0,0,0,0.15)]">
                        <i class="fas fa-camera"></i>
                    </div>
                    <div class="flex flex-col gap-0.5 flex-1">
                        <p class="text-sm font-bold text-gray-800 m-0 leading-[1.3] tracking-[-0.2px]">Take Photo</p>
                    </div>
                </button>
                <button type="button" class="group/opt flex items-center gap-4 px-[18px] py-4 bg-gray-50 border border-gray-200 rounded-xl cursor-pointer transition text-left w-full text-sm outline-none hover:bg-purple-50 hover:border-violet-500 hover:translate-x-1 active:scale-[0.98] focus:outline focus:outline-2 focus:outline-blue-500" onclick="openUpload('library')">
                    <div class="flex items-center justify-center w-11 h-11 rounded-[10px] text-xl shrink-0 transition shadow-[0_2px_8px_rgba(0,0,0,0.08)] bg-gradient-to-br from-fuchsia-100 to-fuchsia-200 text-violet-700 group-hover/opt:scale-[1.15] group-hover/opt:shadow-[0_4px_12px_rgba(0,0,0,0.15)]">
                        <i class="fas fa-images"></i>
                    </div>
                    <div class="flex flex-col gap-0.5 flex-1">
                        <p class="text-sm font-bold text-gray-800 m-0 leading-[1.3] tracking-[-0.2px]">Choose from Library</p>
                    </div>
                </button>
                <button type="button" class="group/opt flex items-center gap-4 px-[18px] py-4 bg-gray-50 border border-gray-200 rounded-xl cursor-pointer transition text-left w-full text-sm outline-none hover:bg-red-50 hover:border-red-500 hover:translate-x-1 active:scale-[0.98] focus:outline focus:outline-2 focus:outline-blue-500" onclick="removePhoto()">
                    <div class="flex items-center justify-center w-11 h-11 rounded-[10px] text-xl shrink-0 transition shadow-[0_2px_8px_rgba(0,0,0,0.08)] bg-gradient-to-br from-red-100 to-red-200 text-red-700 group-hover/opt:scale-[1.15] group-hover/opt:shadow-[0_4px_12px_rgba(0,0,0,0.15)]">
                        <i class="fas fa-trash-alt"></i>
                    </div>
                    <div class="flex flex-col gap-0.5 flex-1">
                        <p class="text-sm font-bold text-gray-800 m-0 leading-[1.3] tracking-[-0.2px]">Delete Photo</p>
                    </div>
                </button>
            </div>
        </div>
    </div>

    <div id="removePhotoModal" class="group hidden fixed inset-0 z-[1000] items-center justify-center opacity-0 transition-opacity duration-300" style="display:none;">
        <div class="fixed inset-0 bg-black/50" onclick="hideRemovePhotoModal()"></div>
        <div class="relative bg-white p-5 rounded-[10px] shadow-[0_4px_6px_rgba(0,0,0,0.1)] text-center max-w-[400px] w-[90%] scale-[0.8] transition-transform duration-300 group-[.show]:scale-100">
            <h1 class="mb-2.5 text-[#333]">Are You Sure?</h1>
            <p class="mb-5 text-[#666]">You will delete your profile photo and it will be replaced with the default photo.</p>
            <div class="flex gap-2.5 justify-center">
                <button type="button" onclick="confirmRemovePhoto()" class="px-5 py-2.5 border-none rounded-[5px] cursor-pointer text-base transition bg-red-600 text-white hover:bg-red-700">Yes</button>
                <button type="button" onclick="hideRemovePhotoModal()" class="px-5 py-2.5 border-none rounded-[5px] cursor-pointer text-base transition bg-gray-500 text-white hover:bg-gray-600">No</button>
            </div>
        </div>
    </div>
@endpush

@push('scripts')
<script>
    const photoModal = document.getElementById('photoModal');
    const fileInput = document.getElementById('profile_pic_input');
    const removePhotoInput = document.getElementById('remove_photo');
    const photoForm = document.getElementById('photoForm');

    function togglePhotoModal() {
        photoModal.classList.toggle('hidden');
        photoModal.classList.toggle('flex');
    }

    function closePhotoModal() {
        photoModal.classList.add('hidden');
        photoModal.classList.remove('flex');
    }

    function openUpload(mode) {
        if (mode === 'camera') {
            fileInput.setAttribute('capture', 'environment');
        } else {
            fileInput.removeAttribute('capture');
        }
        removePhotoInput.value = 'no';
        fileInput.click();
        closePhotoModal();
    }

    function removePhoto() {
        showRemovePhotoModal();
    }

    function showRemovePhotoModal() {
        const modal = document.getElementById('removePhotoModal');
        modal.classList.remove('hidden');
        modal.style.display = 'flex';
        setTimeout(() => modal.classList.add('show', 'opacity-100'), 10);
    }

    function hideRemovePhotoModal() {
        const modal = document.getElementById('removePhotoModal');
        modal.classList.remove('show', 'opacity-100');
        setTimeout(() => {
            modal.classList.add('hidden');
            modal.style.display = 'none';
        }, 300);
    }

    function confirmRemovePhoto() {
        removePhotoInput.value = 'yes';
        photoForm.submit();
    }

    fileInput.addEventListener('change', function () {
        if (fileInput.files.length > 0) {
            removePhotoInput.value = 'no';
            photoForm.submit();
        }
    });

    document.addEventListener('click', function (event) {
        if (photoModal && !photoModal.contains(event.target) && !event.target.closest('#editPhotoBtn')) {
            closePhotoModal();
        }
    });
</script>
@endpush
