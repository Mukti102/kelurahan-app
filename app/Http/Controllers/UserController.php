<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::orderBy('role', 'asc')->get();
        return view('pages.admin.masterdata.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.masterdata.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', Rules\Password::defaults()],
            'nomor_ktp' => ['required', 'string', 'max:255', 'unique:' . User::class],
            'alamat' => ['required', 'string', 'max:255'],
            'role' => ['required'],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'phone' => ['required', 'string', 'max:255'],
        ]);

        if ($request->hasFile('avatar')) {
            $avatarpath = $request->file('avatar')->store('avatar', 'public');
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'nomor_ktp' => $request->nomor_ktp,
            'alamat' => $request->alamat,
            'phone' => $request->phone,
            'avatar' => $avatarpath,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        Alert::success('Success', 'Berhasil Menambahkan User');
        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find(decrypt($id));
        return view('pages.admin.masterdata.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail(decrypt($id));
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
            'nomor_ktp' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string', 'max:255'],
            'role' => ['required'],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'phone' => ['required', 'string', 'max:255'],
        ]);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->nomor_ktp = $request->input('nomor_ktp');
        $user->alamat = $request->input('alamat');
        $user->role = $request->input('role');
        $user->phone = $request->input('phone');

        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        if ($request->hasFile('avatar')) {
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }
            $avatarpath = $request->file('avatar')->store('assets/avatar', 'public');
            $user->avatar = $avatarpath;
        }

        $user->save();

        Alert::success('Success', 'Berhasil Mengaupdate User');
        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::destroy($id);
        Alert::success('Success', "Berghasil Menghapus");
        return redirect()->route('user.index');
    }
}
