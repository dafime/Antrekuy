<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use mysqli;

class AuthController extends Controller
{

    public function home(User $user)
    {
        if (! empty(auth()->user()->id)) {
            $pesanan = DB::select('select max(id) as noantrian from pesanans where SudahDilayani = true');
            $antrian_usaha = DB::select('select antrianaktif from antrian_usahas');
            $semua_pesanan = DB::select('select p.id as id from pesanans p left outer join antrian_usahas a on p.antrian_id = a.id where SudahDilayani = false');
            return view('homePage', compact('pesanan', 'antrian_usaha', 'semua_pesanan'));
        }
        return redirect('/');
    }

    public function signin()
    {
        return view('loginPage');
    }

    public function signup()
    {
        return view('regisPage');
    }

    public function addUser(Request $request)
    {
        $this->validate($request, [
            'name' => 'required | max:25',
            'nama_usaha' => 'required | max:35',
            'email' => 'required | email | unique:users,email',
            'password' => [
                'required',
                'confirmed',
                'min:8',
            ],
        ]);

        $name = $request->name;
        $nama_usaha = $request->nama_usaha;
        $email = $request->email;
        $password = $request->password;


        DB::table('users')->insert([
            'name' => $name,
            'nama_usaha' => $nama_usaha,
            'email' => $email,
            'password' => bcrypt($password)
        ]);

        $credential = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (Auth::attempt($credential)) {
            DB::table('antrian_usahas')->insert([
                'user_id' => Auth::user()->id,
                // 'namaantrian' => 'mantap',
                // 'antrianaktif' => 1,
                // 'pertanyaan1' => 'antrian_aktif',
                // 'pertanyaan2' => 'antrian_aktif',
                // 'pertanyaan3' => 'antrian_aktif',
                // 'lokasiusaha' => 'antrian_aktif',
                // 'qrcode' => 'antrian_aktif',
                // 'time' => 1,
                // 'noantriansekarang' => 2
            ]);
            return redirect('/home');
        }
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required|min:8'
        ]);

        $credential = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (Auth::attempt($credential)) {
            $request->session()->regenerate();

            return redirect('/home');
        } else {
            return redirect()->back()->with('login_failed', 'Wrong Email/Password. Please Check Again');
        }
    }

    public function logout()
    {
        Auth::logout();
        return view('welcome');
    }
}
