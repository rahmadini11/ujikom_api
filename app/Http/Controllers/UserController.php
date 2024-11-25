<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'user')->get();
        return view('admin.users.index', compact('users'));
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required|in:user,admin', // Memastikan role adalah 'user' atau 'admin'
        ]);

        // Hash password untuk keamanan
        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function registerStore(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        // Default role adalah 'user'
        $validatedData['role'] = 'user';

        // Hash password sebelum disimpan
        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);

        return redirect()->route('login')->with('success', 'User registered successfully. Please log in.');
    }

    public function login()
{
    return view('auth.login');
}

public function loginStore(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        // Redirect berdasarkan role
        if (Auth::user()->role === 'admin') {
            return redirect()->route('dashboard.index')->with('success', 'Welcome Admin!');
        }
        return redirect()->route('home')->with('success', 'Login successful.');
    }

    // Jika login gagal, kembali dengan pesan error
    return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
}


    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Logout successful.');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }
    

    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'sometimes|required|max:255',
            'email' => 'sometimes|required|email|unique:users,email,' . $user->id,
            'password' => 'sometimes|required|min:6',
            'role' => 'sometimes|required|in:user,admin',
        ]);

        // Jika password diisi, hash sebelum disimpan
        if (isset($validatedData['password'])) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        }

        $user->update($validatedData);

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}

