<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255|unique:users,name',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role'     => 'in:admin,user'
        ]);


        if ($validator->fails()) {
            return response()->json([
                'status'  => false,
                'message' => 'Validation error',
                'errors'  => $validator->errors()
            ], 422);
        }

        $user = User::create([
            'name'     => $request->username,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role ?? 'USER'
        ]);


        return response()->json([
            'status'  => true,
            'message' => 'User registered successfully',
            'user'    => $user
        ], 201);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string',
            'password' => 'required|string|min:6'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => false,
                'message' => 'Validation error',
                'errors'  => $validator->errors()
            ], 422);
        }

        // Cari user berdasarkan name (username)
        $user = User::where('name', $request->username)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'status'  => false,
                'message' => 'Invalid credentials'
            ], 401);
        }

        // Jika pakai Sanctum (untuk token login)
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status' => true,
            'message' => 'Login successful',
            'user' => $user,
            'token' => $token
        ]);
    }
    public function logout(Request $request)
    {
        // Hapus semua token milik user yang sedang login
        $request->user()->tokens()->delete();

        return response()->json([
            'status' => true,
            'message' => 'Logged out successfully'
        ]);
    }

    public function indexAll()
{
    $users = \App\Models\User::select('id', 'name', 'email', 'role')->get();

    return response()->json([
        'status' => true,
        'users' => $users
    ]);
}

public function updateRole(Request $request, $id)
{
    $request->validate([
        'role' => 'required|in:USER,ADMIN'
    ]);

    $user = \App\Models\User::findOrFail($id);
    $user->role = $request->role;
    $user->save();

    return response()->json([
        'status' => true,
        'message' => 'Role updated successfully'
    ]);
}



}
