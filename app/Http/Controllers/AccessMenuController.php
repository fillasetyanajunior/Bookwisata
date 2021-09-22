<?php

namespace App\Http\Controllers;

use App\Models\AccessMenu;
use App\Models\Menu;
use Illuminate\Http\Request;

class AccessMenuController extends Controller
{
    public function index()
    {
        $data['title']  = 'Access Menu';
        $data['access'] = AccessMenu::simplePaginate(20);
        $data['menu']   = Menu::all();
        return view('admin.accessmenu.showaccessmenu',$data);
    }
    public function store(Request $request)
    {
        AccessMenu::create($request->all());
        return redirect('accessmenu')->with('status','Access Menu Berhasil Di Tambah');
    }
    public function edit(AccessMenu $accessMenu)
    {
        return response()->json([
            'accessmenu'    => $accessMenu
        ]);
    }
    public function update(Request $request, AccessMenu $accessMenu)
    {
        AccessMenu::where('id',$accessMenu->id)
                ->update([
                    'menu_id' => $request->menu_id,
                    'role_id' => $request->role_id,
                ]);
        return redirect('accessmenu')->with('status','Access Menu Berhasil Di Update');
    }
    public function destroy(AccessMenu $accessMenu)
    {
        AccessMenu::destroy($accessMenu->id);
        return redirect('accessmenu')->with('status','Access Menu Berhasil Di Hapus');
    }
}
