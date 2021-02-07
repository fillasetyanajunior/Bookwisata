<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CobaController extends Controller
{
    public function index()
    {
        $data = Http::get('https://dev.farizdotid.com/api/daerahindonesia/provinsi')->json();
        $response = $data['provinsi'];
        return view('admin.promosi.coba',compact('response'));
    }
    public function coba(Request $request)
    {

        $files = [];
        foreach ($request->file('gambar') as $file) {
            $name = time() . rand(1, 100) . '.' . $file->extension();
            $file->storeAs('images', $name);
            $files[] = $name;
        }
        dd($files);
    }
}
