<?php

namespace App\Http\Controllers;

use App\Models\menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function menu()
    {
        $menus = menu::all();
        return view('admin.menu', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $menus = menu::all();
        return view('admin.tambah.tambah_menu', compact('menus'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeMenu(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:menu,name',
            'url' => 'nullable|unique:menu,url',
            'order' => 'required|unique:menu,order',
        ]);

        menu::create([
            'name' => $request->name,
            'url' => $request->url,
            'order' => $request->order,
        ]);

        return redirect()->route('admin.artikel.menu')->with('success', 'Menu Berhasil di tambahkan');
    }

    public function storeSubMenu(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:menu,name',
            'url' => 'nullable|unique:menu,url,NULL,id',
            'id_parent' => 'required', // Pastikan id_parent valid
        ]);

        // Simpan menu atau submenu
        Menu::create([
            'name' => $request->name,
            'url' => $request->url,
            'id_parent' => $request->id_parent,
        ]);

        return redirect()->route('admin.artikel.menu')->with('success', 'Menu/Submenu berhasil ditambahkan.');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
