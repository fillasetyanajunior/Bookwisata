<?php

namespace App\Http\Controllers;

use App\Models\AccessMenu;
use App\Models\Menu;
use Illuminate\Http\Request;

class AccessMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title']  = 'Access Menu';
        $data['access'] = AccessMenu::all();
        return view('admin.accessmenu.showaccessmenu',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title']  = 'Create Access Menu';
        $data['menu']   = Menu::all();
        return view('admin.accessmenu.createaccessmenu', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        AccessMenu::create($request->all());
        return redirect('accessmenu')->with('status','Access Menu Berhasil Di Tambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AccessMenu  $accessMenu
     * @return \Illuminate\Http\Response
     */
    public function show(AccessMenu $accessMenu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AccessMenu  $accessMenu
     * @return \Illuminate\Http\Response
     */
    public function edit(AccessMenu $accessMenu)
    {
        $data['title']  = 'Update Access Menu';
        $data['menu']   = Menu::all();
        return view('admin.accessmenu.updateaccessmenu', $data,compact('accessMenu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AccessMenu  $accessMenu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AccessMenu $accessMenu)
    {
        AccessMenu::where('id',$accessMenu->id)
                ->update([
                    'menu_id' => $request->menu_id,
                    'role_id' => $request->role_id,
                ]);
        return redirect('accessmenu')->with('status','Access Menu Berhasil Di Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AccessMenu  $accessMenu
     * @return \Illuminate\Http\Response
     */
    public function destroy(AccessMenu $accessMenu)
    {
        AccessMenu::destroy($accessMenu->id);
        return redirect('accessmenu')->with('status','Access Menu Berhasil Di Hapus');
    }
}
