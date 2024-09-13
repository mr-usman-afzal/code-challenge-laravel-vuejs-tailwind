<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use App\utilities\ResponseHelper;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * @param LoginRequest $request
     *
     * @return mixed
     */
    public function login(LoginRequest $request)
    {
        try {
            $user = User::where('email', $request->email)->first();

            if (!$user || !Hash::check($request->password, $user->password)) {
                return response()->json([
                    'status' => false,
                    'errors' => ['email' => [__('auth.failed')]]
                ], 422);
//                return ResponseHelper::failure("Invalid Credentials", 422);
            }
            return ResponseHelper::success('User logged in  successfully', ['token' => $user->createToken('test')->plainTextToken]);
        } catch (\Exception $e) {
            return ResponseHelper::failure($e->getMessage(), null);
        }
    }
}
