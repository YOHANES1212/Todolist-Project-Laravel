@extends('layouts.main')

@section('title', 'Change Password - YukKerjain!')

@section('content')
    <div class="bg-white rounded-[10px] p-[30px] shadow-[0_2px_10px_rgba(0,0,0,0.05)]">
        <div class="flex justify-between items-center flex-wrap gap-[15px] mb-7">
            <div>
                <h2 class="text-[28px] text-[#222] m-0">Change Password</h2>
            </div>
        </div>

        <div class="bg-white p-[30px] rounded-[10px] shadow-[0_4px_6px_rgba(0,0,0,0.1)] mt-5">
            <div class="flex items-center mb-[30px] pb-5 border-b border-[#eee]">
                <img src="{{ asset($profile_pic) }}" alt="profile" class="w-[60px] h-[60px] rounded-full mr-5 object-cover">
                <div>
                    <h3 class="mb-1.5 text-[#333]">{{ $name }}</h3>
                    <p class="text-[#666] text-sm">{{ $email }}</p>
                </div>
            </div>

            @if (!empty($errors))
                <div class="bg-[#f8d7da] text-[#721c24] p-2.5 rounded-[5px] mb-5">
                    <ul class="m-0 pl-5">
                        @foreach ($errors as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if ($success)
                <div class="bg-[#d4edda] text-[#155724] p-2.5 rounded-[5px] mb-5">
                    {{ $success }}
                </div>
            @endif

            <form method="POST" action="{{ route('change.password.post') }}" class="max-w-[500px] mx-auto">
                @csrf
                <div class="mb-5">
                    <label class="block mb-1.5 font-semibold text-[#333]">Current Password</label>
                    <div class="relative flex items-center">
                        <input type="password" id="current_password" name="current_password" required class="w-full py-3 pr-10 pl-3 border border-[#ddd] rounded-[5px] text-base transition outline-none focus:border-[#ff6b6b] focus:shadow-[0_0_5px_rgba(255,107,107,0.3)]">
                        <button type="button" class="toggle-password absolute right-2.5 bg-transparent border-none text-[#666] cursor-pointer text-lg p-1.5 transition hover:text-[#ff6b6b]" onclick="togglePassword('current_password')">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <div class="mb-5">
                    <label class="block mb-1.5 font-semibold text-[#333]">New Password</label>
                    <div class="relative flex items-center">
                        <input type="password" id="new_password" name="new_password" required minlength="8" class="w-full py-3 pr-10 pl-3 border border-[#ddd] rounded-[5px] text-base transition outline-none focus:border-[#ff6b6b] focus:shadow-[0_0_5px_rgba(255,107,107,0.3)]">
                        <button type="button" class="toggle-password absolute right-2.5 bg-transparent border-none text-[#666] cursor-pointer text-lg p-1.5 transition hover:text-[#ff6b6b]" onclick="togglePassword('new_password')">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <div class="mb-5">
                    <label class="block mb-1.5 font-semibold text-[#333]">Confirm Password</label>
                    <div class="relative flex items-center">
                        <input type="password" id="confirm_password" name="confirm_password" required class="w-full py-3 pr-10 pl-3 border border-[#ddd] rounded-[5px] text-base transition outline-none focus:border-[#ff6b6b] focus:shadow-[0_0_5px_rgba(255,107,107,0.3)]">
                        <button type="button" class="toggle-password absolute right-2.5 bg-transparent border-none text-[#666] cursor-pointer text-lg p-1.5 transition hover:text-[#ff6b6b]" onclick="togglePassword('confirm_password')">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <div class="flex gap-2.5 justify-center mt-[30px]">
                    <button type="submit" class="bg-[#ff6b6b] text-white px-[30px] py-3 border-none rounded-[5px] text-base cursor-pointer transition hover:bg-[#ff5252]">Update Password</button>
                    <a href="{{ route('profile') }}" class="bg-[#6c757d] text-white px-[30px] py-3 border-none rounded-[5px] text-base no-underline inline-block text-center transition hover:bg-[#5a6268]">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/common.js') }}"></script>
@endpush
