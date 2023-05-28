<?php

namespace App\Http\Controllers;

use App\Models\member;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Mime\Email;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }
    public function login(request $request){
        $this->validate($request,[
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $credential = request(['email','password']);

        if(auth()->attempt($credential)){
            $token = auth::guard('api')->attempt($credential);
            return response()->json([
                'success' => true,
                'message' => 'Login Berhasil',
                'token' => $token
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'email atau password salah'
        ]);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

    public function register(request $request)
    {
        $validator = Validator::make($request->all(),[
            'nama_member' => 'required',
            'provinsi' => 'required',
            'kabupaten' => 'required',
            'kecamatan' => 'required',
            'detail_alamat' => 'required',
            'no_hp' => 'required',
            'email' => 'required|email',
            'password' => 'required|same:konfirmasi_password',
            'konfirmasi_password' => 'required|same:password'
        ]);

        if($validator->fails()){
            return response()->json(
                $validator->errors(),422
            );
        }

        $input = $request->all();
        $input['password'] = bcrypt($request->password);
        unset($input['konfirmasi_password']);
        $member = member::create($input);

        return response()->json([
            'data' => $member
        ]);
    }

    public function login_member()
    {
        return view('auth.login_member');
    }

    public function login_member_action(request $request)
    {
        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if($validator->fails()){
            Session::flash('errors',$validator->errors()->toArray());
            return redirect('/login_member');
        }
        
        $credentials = $request->only('email','password');

        $member = member::where('email',$request->email)->first();

        if($member){
            if(Auth::guard('webmember')->attempt($credentials)){
                $request->session()->regenerate();
                return redirect('/');
            }else{
                Session::flash('failed','Password Salah');
                return redirect('/login_member');
            }
            
        }else{
            Session::flash('failed','Email Tidak Ditemukan');
            return redirect('/login_member');
        }
    }

    public function register_member()
    {
        return view('auth.register_member');
    }

    public function register_member_action(request $request)
    {
        $validator = Validator::make($request->all(),[
            'nama_member' => 'required',
            'no_hp' => 'required',
            'email' => 'required',
            'password' => 'required|same:konfirmasi_password',
            'konfirmasi_password' => 'required|same:password'
        ]);

        if($validator->fails()){
            Session::flash('errors',$validator->errors()->toArray());
            return redirect('/register_member');
        }

        $input = $request->all();
        $input['password'] = bcrypt($request->password);
        unset($input['konfirmasi_password']);
        $member = member::create($input);

        Session::flash('success','Akun Berhasil Dibuat!');
        return redirect('/login_member');
    }

    public function logout()
    {
        Session::flush();

        return redirect('/login');
    }

    public function logout_member()
    {
        Auth::guard('webmember')->logout();
        
        Session::flush();

        return redirect('/');
    }
}