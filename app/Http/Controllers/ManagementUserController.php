<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ManagementUserController extends Controller
{
    public function index()
    {
        $data['user']   = User::orderBy('name')->paginate(10);
        $data['title']  = 'Menagement User';
        return view('admin.managementuser.showmanagementuser',$data);
    }
    public function EditOfUser(User $user)
    {
        $data['title']  = 'Update User';
        return view('admin.managementuser.updatemanagementuser', $data,compact('user'));
    }
    public function Update(Request $request,User $user)
    {
        User::where('id',$user->id)
            ->update([
                'role'  => $request->role,
                'is_active'  => $request->is_active,
            ]);

        return redirect()->route('managementuser')->with('status','Update User Berhasil');
    }
}
