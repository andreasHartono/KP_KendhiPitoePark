<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
   /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

   use AuthenticatesUsers;
   /**
    * Where to redirect users after login.
    *
    * @var string
    */
   protected $redirectTo = '/';

   public function redirectTo()
   {

      $role = Auth::user()->jabatan;
      switch ($role) {
         case 'owner':
            return '/pegawai';
            break;

         case 'pegawai':
            return '/pegawai';
            break;

         case 'pelanggan':
            return '/';
            break;

         default:
            return '/';
            break;
      }
   }

   /**
    * Create a new controller instance.
    *
    * @return void
    */
   public function __construct()
   {
      $this->middleware('guest')->except('logout');
   }

   /**
    * Handle an authentication attempt.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
   public function authenticate(Request $request)
   {
      $credentials = $request->validate([
         'username' => ['required'],
         'password' => ['required']
      ]);

      if (Auth::attempt($credentials)) {
         $request->session()->regenerate();
         return redirect()->intended('/');
      }

      return back()->with('loginError', 'Login Gagal Username atau Password Salah');
   }

   public function logout(Request $request)
   {
      Auth::logout();
      request()->session()->invalidate();
      $request->session()->regenerate();
      return redirect('/login');
   }
}
