<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

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
               return redirect()->route('pegawai');
               break;

            case 'pegawai':
               return redirect()->route('pegawai');
               break;

            case 'pelanggan':
               return redirect()->route('index');
               break;

            default:
            return redirect()->route('index');
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

   public function update_profil(Request $request)
   {
      
      
      $nama = $request['inputNama'];
      $telp = $request['inputTelepon'];
      $alamat = $request['inputAlamat'];      

      $idUser = Auth::user()->id;
      $user = User::find($idUser);
      $user->name = $nama;
      $user->phone = $telp;
      $user->address = $alamat;
      $user->save();      

      return redirect()->route('profil_pelanggan')->with('success', Alert::success('Success Notification', 'Berhasil Ubah Data Profil'));;
   }

   public function data_pegawai()
   {
      $pegawai = Pegawai::where('jabatan',"!=","pelanggan")->get();       
      return view('owner.datapegawai', compact("pegawai"));   
   }

   public function store_data_pegawai(Request $request)
   {
      $user = new User();
      $user->name = $request->get('nama');
      $user->phone = $request->get('notelepon');
      $user->address = $request->get('alamat');
      $user->jabatan = $request->get('jabatan');
      $user->username = $request->get('username');
      $user->password = Hash::make($request->get('password'));
      $user->save();      
      return redirect()->route("data_pegawai")->with('success', Alert::success('Success Notification', 'Berhasil Tambah Pegawai Baru dengan Nama : '.$user->name));;  
   }

   public function destroy_data_pegawai($id)
   {      
      
      try {
         $user = User::find($id);
         $user->delete();
         return redirect()->route("data_pegawai")->with('success', Alert::success('Success Notification', 'Berhasil Delete Pegawai dengan Nama : '.$user->name));;  
         
      } catch (\PDOException $e)
      {
         return redirect()->route('data_menu')->with('error', Alert::danger('Error Notification', 'Data gagal dihapus. Silahkan hubungi admin'));
      }
   
   }

   
}
