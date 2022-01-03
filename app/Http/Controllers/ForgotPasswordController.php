<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResetPasswordRequest;
use App\Mail\ForgotPasswordMail;
use App\Models\User;
use App\Providers\ApiCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    public function forgot(Request $request) {

       $email = User::all()->pluck('email')->toArray();
       if(in_array($request->email,$email))
       {
           $user = User::where('email',$request->email)->first();
           try {
               Mail::to($user->email)->send(new ForgotPasswordMail($user));
           }catch(\Exception $e)
           {
               dd($e);
           }

           return response()->json(['status' => 200]);
       }

//        $credentials = request()->validate(['email' => 'required|email']);
//
//        Password::sendResetLink($credentials);


    }

    public function reset(ResetPasswordRequest $request) {

        dd($request->email);
        $email_password_status = Password::reset($request->validated(),function ($user,$password) {
            $user->password = $password;
            $user->save();
        });

        if ($email_password_status == Password::INVALID_TOKEN) {
            return $this->respondWithMessage("Something is wrong");
        }
        return $this->respondWithMessage("Password has been successfully changed");
    }
    public function verified($id)
    {

    }
}
