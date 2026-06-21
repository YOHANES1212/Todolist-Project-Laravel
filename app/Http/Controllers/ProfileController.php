<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function showProfile(): \Illuminate\Contracts\View\View
    {
        if (Auth::check()) {
            $user = Auth::user();

            return view('profile', [
                'logged_in' => true,
                'profile_pic' => $user->profile_pic ?: 'images/default-avatar.svg',
                'name' => $user->name,
                'email' => $user->email,
                'age' => $user->age,
                'school' => $user->school,
                'social_media' => $user->social_media,
            ]);
        }

        return view('profile', [
            'logged_in' => false,
            'profile_pic' => 'images/default-avatar.svg',
            'name' => 'Guest User',
            'email' => 'guest@example.com',
            'age' => '',
            'school' => '',
            'social_media' => '',
        ]);
    }

    public function showAccountInfo(): \Illuminate\Contracts\View\View
    {
        /** @var User $user */
        $user = Auth::user();

        return view('account_info', [
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => $user->email,
            'age' => $user->age,
            'school' => $user->school,
            'social_media' => $user->social_media,
            'profile_pic' => $user->profile_pic ?: 'images/default-avatar.svg',
            'errors' => [],
            'success' => session('success', ''),
        ]);
    }

    public function updateAccountInfo(Request $request): \Illuminate\Contracts\View\View
    {
        /** @var User $user */
        $user = Auth::user();

        $validator = validator($request->all(), [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'age' => ['nullable', 'integer', 'min:0'],
            'school' => ['nullable', 'string', 'max:255'],
            'social_media' => ['nullable', 'url', 'max:255'],
            'profile_pic' => ['nullable', 'image', 'max:2048'],
            'remove_photo' => ['nullable', 'in:yes,no'],
        ]);

        if ($validator->fails()) {
            return view('account_info', array_merge($this->accountInfoPayload($user), [
                'errors' => $validator->errors()->all(),
                'success' => '',
            ]));
        }

        if ($request->input('remove_photo') === 'yes') {
            $this->removeProfilePhoto($user);
            $user->profile_pic = null;
        }

        if ($request->hasFile('profile_pic')) {
            $this->storeProfilePhoto($request->file('profile_pic'), $user);
        }

        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->name = $request->input('first_name').' '.$request->input('last_name');
        $user->email = $request->input('email');
        $user->age = $request->input('age');
        $user->school = $request->input('school');
        $user->social_media = $request->input('social_media');
        $user->save();

        return view('account_info', array_merge($this->accountInfoPayload($user), [
            'errors' => [],
            'success' => 'Profile updated successfully.',
        ]));
    }

    public function showChangePassword(): \Illuminate\Contracts\View\View
    {
        /** @var User $user */
        $user = Auth::user();

        return view('change_password', [
            'profile_pic' => $user->profile_pic ?: 'images/default-avatar.svg',
            'name' => $user->name,
            'email' => $user->email,
            'errors' => [],
            'success' => '',
        ]);
    }

    public function changePassword(Request $request): \Illuminate\Contracts\View\View
    {
        /** @var User $user */
        $user = Auth::user();

        $validator = validator($request->all(), [
            'current_password' => ['required', 'string'],
            'new_password' => ['required', 'string', 'min:8'],
            'confirm_password' => ['required', 'string', 'same:new_password'],
        ]);

        if ($validator->fails()) {
            return view('change_password', array_merge($this->changePasswordPayload($user), [
                'errors' => $validator->errors()->all(),
                'success' => '',
            ]));
        }

        if (! Hash::check($request->input('current_password'), $user->password)) {
            return view('change_password', array_merge($this->changePasswordPayload($user), [
                'errors' => ['Current password is incorrect.'],
                'success' => '',
            ]));
        }

        $user->password = Hash::make($request->input('new_password'));
        $user->save();

        return view('change_password', array_merge($this->changePasswordPayload($user), [
            'errors' => [],
            'success' => 'Password updated successfully.',
        ]));
    }

    private function accountInfoPayload($user): array
    {
        return [
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => $user->email,
            'age' => $user->age,
            'school' => $user->school,
            'social_media' => $user->social_media,
            'profile_pic' => $user->profile_pic ?: 'images/default-avatar.svg',
        ];
    }

    private function changePasswordPayload($user): array
    {
        return [
            'profile_pic' => $user->profile_pic ?: 'images/default-avatar.svg',
            'name' => $user->name,
            'email' => $user->email,
        ];
    }

    private function storeProfilePhoto($photo, $user): void
    {
        $directory = public_path('profile-pics');

        if (! is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        if ($user->profile_pic && file_exists(public_path($user->profile_pic))) {
            unlink(public_path($user->profile_pic));
        }

        $filename = uniqid('profile_', true).'.'.$photo->extension();
        $photo->move($directory, $filename);
        $user->profile_pic = 'profile-pics/'.$filename;
    }

    private function removeProfilePhoto($user): void
    {
        if ($user->profile_pic && file_exists(public_path($user->profile_pic))) {
            unlink(public_path($user->profile_pic));
        }
    }
}
