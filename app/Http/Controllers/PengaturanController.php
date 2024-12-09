<?php

namespace App\Http\Controllers;

use App\Models\pengaturan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengaturanController extends Controller
{
    public function pengaturan()
    {
        return view('admin.pengaturan');
    }

    public function update(Request $request, $id_pengaturan)
    {
        $pengaturan = pengaturan::find($id_pengaturan);

        // Mengetahui tombol mana yang diklik
        $action = $request->input('action');

        switch ($action) {
            case 'update_app_name':
                $request->validate([
                    'app_name' => 'required|string|max:255',
                ]);
                $pengaturan->update(['app_name' => $request->app_name]);
                return redirect()->back()->with('success', 'Nama Website berhasil diperbarui.');

            case 'update_admin_email':
                $request->validate([
                    'admin_email' => 'required|email|max:255',
                ]);
                $pengaturan->update(['admin_email' => $request->admin_email]);
                return redirect()->back()->with('success', 'Kontak Email berhasil diperbarui.');

            case 'update_contact_number':
                $request->validate([
                    'contact_number' => 'required|string|max:15',
                ]);
                $pengaturan->update(['contact_number' => $request->contact_number]);
                return redirect()->back()->with('success', 'Nomor Kontak berhasil diperbarui.');

            case 'update_logo':
                $request->validate([
                    'logo_upload' => 'file|mimes:jpg,jpeg,png|max:2048',
                ]);
                if ($request->hasFile('logo_upload')) {
                    // Hapus logo lama jika ada
                    if ($pengaturan->logo) {
                        Storage::disk('public')->delete($pengaturan->logo);
                    }
                    $file = $request->file('logo_upload');
                    $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                    $path = $file->storeAs('logos', $filename, 'public');
                    $pengaturan->update(['logo' => $path]);
                }
                return redirect()->back()->with('success', 'Logo berhasil diperbarui.');

            case 'update_address':
                $request->validate([
                    'address' => 'required|string|max:255',
                ]);
                $pengaturan->update(['address' => $request->address]);
                return redirect()->back()->with('success', 'Lokasi berhasil diperbarui.');

            case 'update_description':
                $request->validate([
                    'description' => 'required|string',
                ]);
                $pengaturan->update(['description' => $request->description]);
                return redirect()->back()->with('success', 'Deskripsi berhasil diperbarui.');

            default:
                return redirect()->back()->with('error', 'Aksi tidak dikenali.');
        }
    }
}
