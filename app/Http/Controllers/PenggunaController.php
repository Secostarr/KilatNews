<?php

namespace App\Http\Controllers;

use App\Models\pendaftaran;
use App\Models\SosialMedia;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class PenggunaController extends Controller
{
    // Tampilkan daftar pengguna (jika diperlukan)
    public function pengguna()
    {
        $users = User::all();
        return view('admin.pengguna', compact('users'));
    }

    // Halaman Tambah Pengguna
    public function create()
    {
        return view('admin.tambah.tambah_pengguna');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home')->with('success', 'Logout Berhasil');
    }

    // Halaman Edit Profil
    public function edit()
    {
        $id = Auth::user()->id_user; // Gunakan default 'id' jika primary key di model User adalah 'id'
        $pengguna = User::find($id);

        if (!$pengguna) {
            return redirect()->route('home')->with('error', 'Pengguna tidak ditemukan.');
        }

        return view('edit_pengguna', compact('pengguna'));
    }

    // Update Profil
    public function update(Request $request)
    {
        // Ambil ID pengguna yang sedang login
        $id = Auth::user()->id_user; // Ubah    ke 'id' jika default primary key

        // Temukan pengguna berdasarkan ID
        $pengguna = User::findOrFail($id);

        // Cari atau buat data sosial media
        $sosialMedia = SosialMedia::firstOrCreate(['id_user' => $id]);

        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $id . ',id_user',
            'email' => 'required|email|unique:users,email,' . $id . ',id_user',
            'password' => 'nullable|min:8',
            'bio' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',

            // Validasi sosial media
            'username_facebook' => 'nullable|string|max:255',
            'username_instagram' => 'nullable|string|max:255',
            'url_facebook' => 'nullable|url|max:255',
            'url_instagram' => 'nullable|url|max:255',
        ]);

        // Handling Foto Profil
        $foto = $pengguna->foto;
        if ($request->hasFile('foto')) {
            if ($foto) {
                Storage::disk('public')->delete($foto);
            }
            $uniqueFile = uniqid() . '_' . $request->file('foto')->getClientOriginalName();
            $request->file('foto')->storeAs('foto_pengguna', $uniqueFile, 'public');
            $foto = 'foto_pengguna/' . $uniqueFile;
        }

        // Update data pengguna
        $pengguna->update([
            'nama' => $request->nama,
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->filled('password') ? Hash::make($request->password) : $pengguna->password,
            'bio' => $request->bio,
            'foto' => $foto,
        ]);

        // Update data sosial media
        $sosialMedia->update([
            'username_facebook' => $request->username_facebook,
            'username_instagram' => $request->username_instagram,
            'url_facebook' => $request->url_facebook,
            'url_instagram' => $request->url_instagram,
        ]);

        // Redirect berdasarkan role
        $role = Auth::user()->role;

        if ($role === 'admin') {
            return redirect()->route('admin.profile.edit')->with('success', 'Profil berhasil diperbarui.');
        } else {
            return redirect()->route('user.profile.edit')->with('success', 'Profil berhasil diperbarui.');
        }
    }


    public function show($id)
    {
        $user = User::with('socialMedia')->find($id);

        if ($user) {
            return response()->json([
                'user' => $user,
                'social_media' => $user->socialMedia,
            ]);
        }

        return response()->json(['message' => 'User not found'], 404);
    }

    public function register(Request $request)
    {

        $request->validate([
            'nama' => 'required|max:70',
            'username' => 'required|max:50',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8'
        ]);

        User::create([
            'nama' => $request->nama,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('user.login')->with('success', 'Registrasi berhasil silahkan masukkan untuk login');
    }

    // PENDAFTARAN
    public function pendaftaran()
    {
        $user = Auth::user()->id_user;

        $sudahMendaftar = \App\Models\Pendaftaran::where('id_user', $user)->exists();

        if ($sudahMendaftar) {
            return redirect()->back()->with('error', 'Anda sudah terdaftar sebagai contributor.');
        }

        return view('pendaftaran', compact('user'));
    }

    public function store(Request $request)
    {
        $user = Auth::user()->id_user;
        // Validasi input
        $validatedData = $request->validate([
            'keterangan' => 'required|string',
            'no_telfon' => 'required|string|max:25|unique:pendaftaran,no_telfon',
        ]);

        // Tetapkan default status jika tidak ada
        $validatedData['status'] = $request->input('status', 'pending');

        // Simpan ke database
        pendaftaran::create([
            'id_user' => $user,
            'keterangan' => $validatedData['keterangan'],
            'no_telfon' => $validatedData['no_telfon'],
            'status' => 'pending',
        ]);

        // Redirect atau response
        return redirect()->back()->with('success', 'Pendaftaran berhasil!');
    }

    public function delete($id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->back()->with('error', 'User tidak ditemukan.');
        }

        // Hapus data pengguna
        $user->delete();

        return redirect()->back()->with('success', 'User berhasil dihapus.');
    }   
}
