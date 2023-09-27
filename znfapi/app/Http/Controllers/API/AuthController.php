<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\OtpCode;
use App\Models\User;

class AuthController extends Controller
{

    public function index()
    {
        $user = User::all();
        return response()->json([
            'status' => 200,
            'user' => $user,
        ]);

    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:191',
            'email' => 'required|email|max:191|unique:users,email',
            'notelp' => 'required|max:191',
            'password' => 'required|max:8',
            'otp' => 'required|max:8',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'validation_errors' => $validator->messages(),
            ]);
        }

        $otpCode = OtpCode::where('email', $request->email)->first();

        if ($otpCode && $otpCode->otp === $request->otp) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'notelp' => $request->notelp,

            ]);

            $token = $user->createToken($user->email . '_Token')->plainTextToken;

            return response()->json([
                'status' => 200,
                'username' => $user->name,
                'token' => $token,
                'message' => 'Register Successfully',
                'user_id'=>$user->id,

            ]);
        } else {
            return response()->json(['message' => 'Invalid OTP code']);
        }





    }

    public function registerads(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:191',
            'notelp' => 'required|max:191',
            'password' => 'required|max:8',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'validation_errors' => $validator->messages(),
            ]);
        }else {


            $user = User::create([
                'name' => $request->name,
                'password' => Hash::make($request->password),
                'notelp' => $request->notelp,

            ]);

            $token = $user->createToken($user->email . '_Token')->plainTextToken;

            return response()->json([
                'status' => 200,
                'username' => $user->name,
                'token' => $token,
                'message' => 'Register Successfully',
                'user_id'=>$user->id,

            ]);
        }}








    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'notelp' => 'required|max:191',
            'password' => 'required'

        ]);

        if ($validator->fails()) {
            return response()->json([
                'validation_errors' => $validator->messages(),
            ]);
        } else {
            $user = User::where('notelp', $request->notelp)->first();

            if (!$user || !Hash::check($request->password, $user->password)) {
                return response()->json([
                    'status' => 401,
                    'message' => 'Invalid Credentials',

                ]);

            } else {
                if ($user->role_as == 1) {
                    $role = 'admin';
                    $token = $user->createToken($user->notelp . '_AdminToken', ['server:admin'])->plainTextToken;
                } else {
                    $role = '';
                    $token = $user->createToken($user->notelp . '_Token)', [''])->plainTextToken;
                }
                return response()->json([
                    'status' => 200,
                    'username' => $user->name,
                    'token' => $token,
                    'message' => 'Login Successfully',
                    'role' => $role,
                    'email' => $user->email,
                    'user_id'=>$user->id,

                ]);


            }
        }
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Logged Out Successfully',
        ]);

    }
}
