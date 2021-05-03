<?php

namespace App\Http\Controllers;


use App\Mail\VerifyMail;
use App\Models\User;
use App\Models\VerifyUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;




class AuthController extends Controller
{
    public function login(Request $request)
    {


        if ($request->isMethod('post')) {
            $this->validate($request, [
                'email' => 'required|email',
                'password' => 'required'
            ]);

            $user = User::where('email', $request->input('email'))->first();

            if (!$user || !Hash::check($request->input('password'), $user->password)) {
                return redirect(route('login'))->withErrors([
                    'login' => 'Email or password is incorrect!'
                ])->withInput();
            }

            if (!$user->verified) {
                auth()->logout();
                return back()->with('warning', 'You need to confirm your account. We have sent you an activation code, please check your email.');
            }

            Auth::login($user);

            return redirect('/dashboard');
        }

        return view('auth/login');
    }



    public function register(Request $request)
    {
        //TODO
        if ($request->isMethod('post')) {
            //validate request
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'required|confirmed'
            ]);


            //create user
            $user = User::create($request->all());

            // login user or send activate email

            $verifyUser = VerifyUser::create([
                'user_id' => $user->id,
                'token' => str_random(40)
            ]);

            Mail::to($user->email)->send(new VerifyMail($user));

            return $user;

            //redirected to dashboard/login
            return view('auth/login');
        }

        //return view register
        return view('auth/register');
    }

    public function verifyUser($token)
    {
        $verifyUser = VerifyUser::where('token', $token)->first();
        if(isset($verifyUser) ){
            $user = $verifyUser->user;
            if(!$user->verified) {
                $verifyUser->user->verified = 1;
                $verifyUser->user->save();
                $status = "Your e-mail is verified. You can now login.";
            }else{
                $status = "Your e-mail is already verified. You can now login.";
            }
        }else{
            return redirect('/login')->with('warning', "Sorry your email cannot be identified.");
        }

        return redirect('/login')->with('status', $status);
    }

    protected function registered(Request $request, $user)
    {
        $this->guard()->logout();
        return redirect('/login')->with('status', 'We sent you an activation code. Check your email and click on the link to verify.');
    }

}