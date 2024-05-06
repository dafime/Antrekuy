<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{

    public function userHome(User $user)
    {
        if(auth()->user()->id > 0){
            return view('homePage');
        }
        else {
            return redirect('/');
        }
    }

    public function signin()
    {
        return view('loginPage');
    }

    public function signup()
    {
        return view('regisPage');
    }

    public function addUser(Request $request){
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

        $name =$request->name;
        $nama_usaha=$request->nama_usaha;
        $email=$request->email;
        $password=$request->password;


        DB::table('users')->insert([
            'name'=> $name,
            'nama_usaha' => $nama_usaha,
            'email'=>$email,
            'password'=>bcrypt($password)
        ]);

        $credential = [
            'email'=>$request->email,
            'password'=>$request->password
        ];

        if(Auth::attempt($credential)){
            return redirect('/home')->with('login_failed', 'Wrong Email/Password. Please Check Again');
        }
    }

    public function login(Request $request){
        $this->validate($request, [
            'email'=>'required',
            'password'=>'required|min:8'
        ]);

        $credential = [
            'email'=>$request->email,
            'password'=>$request->password
        ];

        if(Auth::attempt($credential)){
            $request -> session()->regenerate();

            return redirect('/home')->with('login_failed', 'Wrong Email/Password. Please Check Again');
        }

        else{
            return redirect()->back()->with('login_failed', 'Wrong Email/Password. Please Check Again');
        }
    }

    public function logout(){
        Auth::logout();
        return view('logOut');
    }

}