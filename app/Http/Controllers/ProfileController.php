<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Validator;

class ProfileController extends Controller
{
    public function change_password(Request $request) {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'old_password' => 'required',
            'password' => 'required',
            'confirm_password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validations fails',
                'errors' => $validator->errors()
            ],422);
        }

        $user = $request->user();

        if (Hash::check($request->old_password,$user->password)) {

            $user->update([
                'password' =>Hash::make($request->password)
            ]);
            return response()->json([
                'message' => 'Password Successfully Updated'
            ],200);

        } else{
            return response()->json([
                'message' => 'Old password does not matched',
                'errors' => $validator->errors()
            ],400);
        }
    }
}
