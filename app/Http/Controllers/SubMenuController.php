<?php

namespace App\Http\Controllers;

use App\Models\SubMenu;
use App\Models\Menu;
use Illuminate\Http\Request;

class SubMenuController extends Controller
{
    public function index()
    {
        $data['title']      = 'Sub Menu';
        $data['submenu']    = SubMenu::all();
        $data['menu']   = Menu::all();
        return view('admin.submenu.showsubmenu',$data);
    }
    public function store(Request $request)
    {
        SubMenu::create($request->all());
        return redirect('submenu')->with('status','Sub Menu Berhasil Di Tambah');
    }
    public function edit(SubMenu $subMenu)
    {
        return response()->json([
            'submenu' => $subMenu
        ]);
    }
    public function update(Request $request, SubMenu $subMenu)
    {
        SubMenu::where('id',$subMenu->id)
                ->update([
                    'menu_id'   => $request->menu_id,
                    'sub_menu'  => $request->sub_menu,
                    'icon'      => $request->icon,
                    'url'       => $request->url,
                ]);
        return redirect('submenu')->with('status','Sub Menu Berhasil Di Update');
    }
    public function destroy(SubMenu $subMenu)
    {
        SubMenu::destroy($subMenu->id);
        return redirect('submenu')->with('status','Sub Menu Berhasil Di Delete');
    }
}
