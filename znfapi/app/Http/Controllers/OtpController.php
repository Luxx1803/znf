<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OtpCode;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\OTPMail;

class OtpController extends Controller
{
    public function otp(Request $request)
    {
        // Generate a new OTP
        $otp = rand(10000, 99999);

        // Send OTP email
        try {
            Mail::to($request->email)->send(new OTPMail($otp));
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error sending OTP email']);
        }

        // Validate the request data
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        // If validation fails, return error response
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        // Check if email already exists in the table
        $existingOtp = OtpCode::where('email', $request->email)->first();

        if ($existingOtp) {
            // If email already exists, update the OTP
            $existingOtp->update([
                'otp' => $otp,
            ]);
        } else {
            // If email doesn't exist, create a new OTP entry
            OtpCode::create([
                'email' => $request->email,
                'otp' => $otp,
            ]);
        }

        return response()->json(['message' => 'OTP code updated or stored successfully']);
    }
}
