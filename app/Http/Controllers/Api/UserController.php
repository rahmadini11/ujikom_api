<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Laravel\Sanctum\PersonalAccessToken;

class UserController extends Controller
{

    public function index()
{
    $users = User::all(); // Ambil semua pengguna
    return response()->json($users);
}

    // Register a new user
    public function register(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Buat user baru
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        // Generate token untuk user yang baru dibuat
        $token = $user->createToken('YourAppName')->plainTextToken;

        // Response dengan token
        return response()->json([
            'user' => $user,
            'token' => $token
        ], 201);
    }

    // Login user
    public function login(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Cek kredensial
        if (Auth::attempt(['email' => $validatedData['email'], 'password' => $validatedData['password']])) {
            $user = Auth::user();
            $token = $user->createToken('YourAppName')->plainTextToken;

            return response()->json([
                'user' => $user,
                'token' => $token
            ]);
        }

        // Jika login gagal
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }

    // Logout user
    public function logout(Request $request)
    {
        // Menghapus token yang digunakan
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Successfully logged out.'
        ]);
    }
}