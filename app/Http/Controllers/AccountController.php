<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
   public function index()
   {
      return view('auth.login', [
         'title' => 'Login'
      ]);
   }
   public function indexRegister()
   {
      return view('auth.register', [
         'title' => 'Register'
      ]);
   }

   public function authenticate(Request $request)
   {
      $credentials = $request->validate([
         'username' => ['required'],
         'password' => ['required']
      ]);

      if (Auth::attempt($credentials)) {
         $request->session()->regenerate();
         
         $role = Auth::user()->jabatan;

         switch ($role) {
            case 'owner':
               return redirect()->intended('/pegawai');
               break;

            case 'pegawai':
               return redirect()->intended('/pegawai');
               break;

            case 'pelanggan':
               return redirect()->intended('/');
               break;

            default:
            return redirect()->intended('/');
               break;
         }
         
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

   /**
    * Get a validator for an incoming registration request.
    *
    * @param  array  $data
    * @return \Illuminate\Contracts\Validation\Validator
    */
   protected function validator(array $data)
   {
      return Validator::make($data, [
         'username' => ['required', 'string', 'max:255'],
         'phone' => ['required', 'string', 'max:255'],
         'name' => ['required', 'string', 'max:255'],
         'password' => ['required', 'string', 'confirmed'],
      ]);
   }

   /**
    * Create a new user instance after a valid registration.
    *
    * @param  array  $data
    * @return \App\Models\User
    */
   public function create(Request $request)
   {
      $validator = $request->validate([
         'username' => ['required', 'string', 'max:255'],
         'phone' => ['required', 'string', 'max:255'],
         'name' => ['required', 'string', 'max:255'],
         'password' => ['required', 'string', 'confirmed'],
      ]);
      $validator['password'] = Hash::make($validator['password']);
      User::create($validator);
      $request->session()->flash('success', 'Pendaftaran Akun Kendhi Pitoe Berhasil');
      return redirect('/');
   }
}
