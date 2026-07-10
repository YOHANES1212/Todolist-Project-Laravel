@extends('layouts.main')

@section('title', 'Profile - YukKerjain!')

@section('content')
    <div class="bg-white rounded-[10px] p-[30px] shadow-[0_2px_10px_rgba(0,0,0,0.05)] flex flex-col items-center text-center">
        <div class="flex justify-between items-center flex-wrap gap-[15px] mb-7 w-full">
            <div>
                <h2 class="text-[28px] text-[#222] m-0">Account Information</h2>
            </div>
        </div>
        <!-- User Info Card -->
        <div class="p-10 rounded-[15px] mb-10 flex flex-col items-center w-full max-w-[500px]" style="background: linear-gradient(135deg, #f5f5f5 0%, #fafafa 100%);">
            <img src="{{ asset($profile_pic) }}" alt="profile" class="w-[120px] h-[120px] rounded-full mb-[25px] object-cover border-4 border-[#ff6b6b] shadow-[0_4px_15px_rgba(255,107,107,0.2)]">
            <div>
                <h3 class="text-2xl text-[#333] mb-5 font-bold">{{ $name }}</h3>
                <div class="text-left">
                    <p class="text-sm text-[#666] my-2.5 leading-[1.6]"><strong class="text-[#333] font-semibold">Email:</strong> {{ $email ?: 'Not set' }}</p>
                    <p class="text-sm text-[#666] my-2.5 leading-[1.6]"><strong class="text-[#333] font-semibold">Age:</strong> {{ $age ?: 'Not set' }}</p>
                    <p class="text-sm text-[#666] my-2.5 leading-[1.6]"><strong class="text-[#333] font-semibold">School/University:</strong> {{ $school ?: 'Not set' }}</p>
                    <p class="text-sm text-[#666] my-2.5 leading-[1.6]"><strong class="text-[#333] font-semibold">Social Media:</strong>
                        @if ($social_media)
                            <a href="{{ $social_media }}" target="_blank">{{ $social_media }}</a>
                        @else
                            Not set
                        @endif
                    </p>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex gap-[15px] flex-wrap justify-center w-full">
            @if ($logged_in)
                <a href="{{ route('account.info') }}" class="inline-flex items-center gap-2.5 px-[25px] py-3 rounded-[5px] no-underline text-sm font-semibold transition cursor-pointer border-none bg-[#ff6b6b] text-white hover:shadow-[0_4px_12px_rgba(255,107,107,0.3)] hover:-translate-y-0.5">
                    <i class="fas fa-edit"></i> Edit Profile
                </a>
                <a href="{{ route('change.password') }}" class="inline-flex items-center gap-2.5 px-[25px] py-3 rounded-[5px] no-underline text-sm font-semibold transition cursor-pointer border-none bg-[#ff6b6b] text-white hover:shadow-[0_4px_12px_rgba(255,107,107,0.3)] hover:-translate-y-0.5">
                    <i class="fas fa-key"></i> Change Password
                </a>
                <button onclick="showLogoutModal()" class="inline-flex items-center gap-2.5 px-[25px] py-3 rounded-[5px] no-underline text-sm font-semibold transition cursor-pointer border-none bg-[#ff6b6b] text-white hover:shadow-[0_4px_12px_rgba(255,107,107,0.3)] hover:-translate-y-0.5">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            @else
                <a href="{{ route('login') }}" class="inline-flex items-center gap-2.5 px-[25px] py-3 rounded-[5px] no-underline text-sm font-semibold transition cursor-pointer border-none bg-[#ff6b6b] text-white hover:shadow-[0_4px_12px_rgba(255,107,107,0.3)] hover:-translate-y-0.5">
                    <i class="fas fa-sign-in-alt"></i> Login
                </a>
                <a href="{{ route('register') }}" class="inline-flex items-center gap-2.5 px-[25px] py-3 rounded-[5px] no-underline text-sm font-semibold transition cursor-pointer border-none bg-[#ff6b6b] text-white hover:shadow-[0_4px_12px_rgba(255,107,107,0.3)] hover:-translate-y-0.5">
                    <i class="fas fa-user-plus"></i> Register
                </a>
            @endif
        </div>
    </div>
@endsection
