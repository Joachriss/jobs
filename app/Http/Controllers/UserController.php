<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeekerRegistrationRequest;
use App\Http\Requests\EmployerRegistrationRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// use App\Models\User;
// use Illuminate\Http\Request;

class UserController extends Controller
{
    const JOB_SEEKER = 'seeker';
    const JOB_EMPLOYER = 'employer';
    public function createSeeker(){
        return view( 'user.seeker-register');
    }

    public function  storeSeeker(SeekerRegistrationRequest $request){
        // request()->validate([
        //     'name'=>['required','string','max:255'],
        //     'email' => ['required', 'string','email','unique:users','max:255'],
        //     'password'=> ['required']
        // ]);

        $user = User::create([
            "name"=>request('name'),
            "email"=>request('email'),
            "password"=>bcrypt(request('password')),
            "user_type"=>self::JOB_SEEKER,
        ]);

        Auth::login($user);

        $user->sendEmailVerificationNotification();

        return response()->json("success");
        // return redirect()->route('verification.notice')->with('success','Your account was created succesiful.');
    }

    public function login(){
        return view('user.login');
    }

    public function postLogin(Request $request){
        $request->validate
            ([
            'email'=>['required'] ,
            'password'=>['required'] ,
        ]);

        $credentials = $request->only('email','password');

        if(Auth::attempt($credentials)){
            return redirect()->intended('dashboard');
        }
        return back()->with('error','Invalid user email or password');
    }

    public function logout(){
        auth()->logout();

        return redirect()->route('login');
    }


    // employer side
    public function createEmployer(){
        return view('user.employer-register');
    }
    public function storeEmployer(EmployerRegistrationRequest $request){
        $user =  user::create([
            'name'=>request('name'),
            'email'=>request('email'),
            'password'=>bcrypt(request('password')),
            'user_type'=>self::JOB_EMPLOYER,
            'user_trial'=>now()->addWeek()
        ]);

        Auth::login($user); 
        
        $user->sendEmailVerificationNotification();
        return response()->json('success');
        // return redirect()->route('verification.notice')->with('success','Your company account  was created succesiful');
    }
}
