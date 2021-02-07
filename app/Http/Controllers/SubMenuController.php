<?php

namespace App\Http\Controllers;

use App\Models\SubMenu;
use App\Models\Menu;
use Illuminate\Http\Request;

class SubMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title']      = 'Sub Menu';
        $data['submenu']    = SubMenu::all();
        return view('admin.submenu.showsubmenu',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title']  = 'Create Sub Menu';
        $data['menu']   = Menu::all();
        return view('admin.submenu.createsubmenu', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        SubMenu::create($request->all());
        return redirect('submenu')->with('status','Sub Menu Berhasil Di Tambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubMenu  $subMenu
     * @return \Illuminate\Http\Response
     */
    public function show(SubMenu $subMenu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubMenu  $subMenu
     * @return \Illuminate\Http\Response
     */
    public function edit(SubMenu $subMenu)
    {
        $data['title']  = 'Update Sub Menu';
        $data['menu']   = Menu::all();
        return view('admin.submenu.updatesubmenu', $data,compact('subMenu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubMenu  $subMenu
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubMenu  $subMenu
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubMenu $subMenu)
    {
        SubMenu::destroy($subMenu->id);
        return redirect('submenu')->with('status','Sub Menu Berhasil Di Delete');
    }
}
