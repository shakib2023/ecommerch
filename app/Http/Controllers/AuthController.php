<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $data = [
            'name'=>$request->post('name'),
            'email'=>$request->post('email'),
            'password'=>Hash::make($request->post('password')),
            'role'=>2,
        ];

        if ($data){
            toast('Successfully register.','success');
            $user = User::create($data);

            if ($user){

                $defaultEmail = 'shakibahmedshakibahmed2@gmail.com';
                $defaultName = 'Ecommerce';

                $link=route('verify-register', ['email' => $user->email]);
                Mail::send('emailVerification', [
                    'company' => 'Company Name',
                    'sendingInformation' => [
                        'link'=>$link
                    ]
                ], function ($message) use ($request,$defaultEmail,$defaultName) {
                    $message->to($request->post('email'))->subject(__('Email verification'))->from(
                        $defaultEmail,
                        $defaultName
                    );
                });
            }


            return redirect()->route('home');
        }
    }

    public function logIn(Request $request)
    {
        $email = $request->post('email');
        $password = $request->post('password');

        if (Auth::attempt(['email'=>$email,'password'=>$password])){
            toast('Successfully login.','success');
            return redirect()->back();
        }else{
            toast('Something went wrong!.','error');
            return redirect()->back();
        }

    }

    public function logOut()
    {
        Auth::logout();

        toast('Successfully logout.','success');
        return redirect()->route('home');

    }

    public function verifyRegister(Request $request)
    {
        $user = User::where('email',$request->input('email'))->first();
        if ($user){
            User::where('email',$request->input('email'))->first()->update([
                'email_verified'=>1
            ]);
        }
        toast('Email verified successfully','success');
        return redirect()->route('home');
    }
}
