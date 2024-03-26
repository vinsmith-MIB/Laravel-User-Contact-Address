<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Requests\UserUpdateRequest;

class AuthController extends Controller
{
    public function register()
    {
        return view('register');
    }
 
    public function registerPost(Request $request)
    {
        $user = new User();
 
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->name = $request->name;
 
        $user->save();
 
        return back()->with('success', 'Register successfully');
    }
 
    public function login()
    {
        return view('login');
    }
 
    public function loginPost(Request $request)
    {
        $credetials = [
            'username' => $request->username,
            'password' => $request->password,
        ];
 
        if (Auth::attempt($credetials)) {
            return redirect('/home')->with('success', 'Login Success');
        }
 
        return back()->with('error', 'Error Email or Password');
    }

    public function updateView() {
        $user = Auth::user();
        if($user instanceof \Illuminate\Database\Eloquent\Model)
        $contacts = $user->contacts()->paginate(5);

        return view('updateUser', compact('contacts'));
    }

    public function update(UserUpdateRequest $request)
    {
        $data = $request->validated();
        $user = Auth::user();

        if (isset($data['name'])) {
            $user->name = $data['name'];
        }

        if (isset($data['password'])) {
            $user->password = Hash::make($data['password']);
        }
        
        if ($user instanceof \Illuminate\Database\Eloquent\Model) {
            $user->save();
        } 
        else{
            return redirect('/home')->with('failed', 'Gagal menyimpan pengguna: Model tidak valid');
        }
        

        return redirect('/home')->with('success', 'update Success');
    }
 
    public function logout()
    {
        Auth::logout();
 
        return redirect()->route('register');
    }
}
