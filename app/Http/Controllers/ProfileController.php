<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{


    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = Auth::user();
        return view('pages.common.profile', compact('user'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {

        $auth = Auth::user();

        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'nomor_ktp' => 'nullable',
            'phone' => 'nullable|string|max:15',
            'alamat' => 'nullable|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $auth->id,
            'password' => 'nullable|string|min:8',
            'avatar' => 'nullable|max:2048',
        ]);

        // Upload avatar jika ada file baru
        if ($request->hasFile('avatar')) {
            // Hapus avatar lama jika ada
            if ($auth->avatar && Storage::disk('public')->exists($auth->avatar)) {
                Storage::disk('public')->delete($auth->avatar);
            }

            // Simpan avatar baru
            $auth->avatar = $request->file('avatar')->store('avatar', 'public');
        }

        // Update data pengguna
        $auth->name = $request->name;
        $auth->nomor_ktp = $request->nomor_ktp;
        $auth->phone = $request->phone;
        $auth->alamat = $request->alamat;
        $auth->email = $request->email;

        // Update password jika diisi
        if ($request->password) {
            $auth->password = Hash::make($request->password);
        }

        $auth->save();

        // Tampilkan notifikasi sukses
        Alert::success('Success', 'Profile berhasil diperbarui');

        // Redirect ke halaman edit profil
        return redirect()->route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
