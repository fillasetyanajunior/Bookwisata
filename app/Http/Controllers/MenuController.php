<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $data['title']  = 'Menu';
        $data['menues'] = Menu::all();
        return view('admin.menu.showmenu',$data);
    }
    public function store(Request $request)
    {
        Menu::create($request->all());
        return redirect('menu')->with('status','Menu berhasil Di Tambah');
    }
    public function edit(Menu $menu)
    {
       return response()->json([
           'menu' => $menu
       ]);
    }
    public function update(Request $request, Menu $menu)
    {
        Menu::where('id',$menu->id)
            ->update([
                'menu'  => $request->menu,
                'icon'  => $request->icon,
            ]);
        return redirect('menu')->with('status','Menu Berhasil Di Update');
    }
    public function destroy(Menu $menu)
    {
        Menu::destroy($menu->id);
        return redirect('menu')->with('status', 'Menu Berhasil Di Delete');
    }
}
