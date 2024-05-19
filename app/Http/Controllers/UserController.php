<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PharIo\Manifest\Url;

use function PHPUnit\Framework\isNull;

class UserController extends Controller
{
    public function profile($id){
        $user = User::find($id);
        return view('editProfile', compact('user'));
    }

    public function updateProfile(Request $request, $id){
        if(is_null($request->name)){
            return redirect()->back();
        }
        $user = User::find($id);
        $user->name = $request->name;
        $user->nama_usaha = $request->nama_usaha;
        $user->email = $request->email;

        $user->date_joined = Carbon::now()->setTimezone('Asia/Jakarta');
        $user->save();
        return redirect()->back()->with('message',"Berhasil disimpan");
    }
}
