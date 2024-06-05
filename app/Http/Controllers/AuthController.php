<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function create(){
        return view('register.create');
    }

    public function store(){
        $formInput=request()->validate([
            'name'=>['required','min:6','max:255'],
            'username'=>['required','min:6','max:255'],
            'email'=>['required','email'],
            'password'=>['required','min:6']
        ]);

        $user=User::create($formInput);
        auth()->login($user);
        return redirect('/')->with('success','Welcome,'.request()->name);
    }

    public function logout(){
        auth()->logout();
        return redirect('/')->with('success','Good Bye');
    }

    
    public function login_create(){
        return view('auth.login');
    }
    public  function login_store(){
        $form_data=request()->validate([
            'email'=>['required',Rule::exists('users','email')],
            'password'=>['required']
        ],[
            'email.required'=>'You must fill in your email address'
        ]);

        if(auth()->attempt($form_data)){
            if(auth()->user()->isAdmin){
                return redirect('admin/blogs');
            }else{
                return redirect('/')->with('success','Welcome Back');
            }
            
        }else{
            return redirect()->back()->withErrors([
                'email'=>'Invalid Login Credentials'
            ]);
        }
    }

    

    
}
