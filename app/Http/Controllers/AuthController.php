<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:100',
                'email' => 'required|string|max:100|unique:users,email',
                'password' => 'required|string|min:8',
                'role_id' => 'required|exists:roles,id',
            ]);

            if (User::where('name', $request->name)
                ->where('email', $request->email)
                ->where('role_id', $request->role_id)
                ->exists()
            ) {
                return response()->json([
                    'message' => 'Gagal membuat akun',
                    'errors' => [
                        'message' => 'Akun yang dibuat sudah ada'
                    ]
                ]);
            }

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role_id' => $request->role_id,
            ]);

            return response()->json([
                'message' => 'Berhasil membuat akun',
                'user' => [
                    'name' => $user->name,
                    'email' => $user->name,
                    'role_id' => $user->role,
                ]
            ]);
        } catch (\Illuminate\Validation\ValidationException $v) {
            return response()->json([
                'message' => 'Gagal membuat akun',
                'errors' => $v->errors()
            ]);
        }
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Email atau Password salah'
            ],401);
        }

        $token = $user->createToken('CreateToken')->plainTextToken;

        return response()->json([
            'message' => 'Login berhasil',
            'token' => $token,
            'role_id' => $user->role_id
        ], 200);
    }
}
