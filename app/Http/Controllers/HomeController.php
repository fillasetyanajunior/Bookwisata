<?php

namespace App\Http\Controllers;

use App\Models\Informasi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['title']          = 'Dashboard';
        $data['informasi']      = Informasi::orderBy('updated_at','desc')->where('pilihinformasi', 2)->paginate(5);
        return view('home.dashboard',$data);
    }

    public function Myprofile()
    {
        $data['title']  = 'My Profile';
        $data['user']   = User::where('id',request()->user()->id)->get();
        return view('home.myprofile',$data);
    }

    public function UpdateMyProfile(Request $request,User $user)
    {
        if ($request->hasfile('avatar')) {
            
            $request->validate([
                'avatar' => 'image|mimes:jpg,jpeg,png'
            ]);
            Storage::delete('profile/' . $user->avatar);

            $file = $request->file('avatar');
            $name = time() . rand(1, 100) . '.' . $file->extension();
            $file->storeAs('profile', $name);

            User::where('id', $user->id)
                ->update([
                    'name'      => $request->name,
                    'email'     => $request->email,
                    'nomer'     => $request->nomer,
                    'avatar'    => $name,   
                ]);
        } else {
            User::where('id', $user->id)
                ->update([
                    'name'      => $request->name,
                    'email'     => $request->email,
                    'nomer'     => $request->nomer,
                ]);
        }
        return redirect('myprofile')->with('status', 'My Profile Telah Di Update');
    }
}
