<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Import library socialite supaya bisa digunakan
use Laravel\Socialite\Facades\Socialite;

//Import Model kita
use App\Models\User;

use Auth;

class UserController extends Controller
{
    public function login()
    {
        return view('auth.user.login');
    }

    //Function untuk koneksi ke redirect Socialite Google Account
    public function loginGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    //Function untuk callback dari redirect Socialite Google Account
    public function handleProviderCallback()
    {
        // Adding social authentication to a stateless API that does not utilize cookie based sessions
        $callback = Socialite::driver('google')->stateless()->user();
        // Kita lanjutkan parsing data dari $callback
        $data = [
            'name' => $callback->getName(),
            'email' => $callback->getEmail(),
            'avatar' => $callback->getAvatar(),
            'email_verified_at' => date('Y-m-d H:i:s', time()),
            'is_admin' => false,
        ];

        // Simpan data kita sebagai user
        $user = User::firstOrCreate(['email' => $data['email']],$data);
        //Login menggunakan data user yang sudah disimpan
        Auth::login($user, true);
        return redirect(route('welcome'));
    }
}
