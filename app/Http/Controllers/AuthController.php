<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Log; 

class AuthController extends Controller
{
    /**
     * Fungsi untuk registrasi pengguna.
     */

    public function register(Request $request)
    {
        try {
            Log::info('Memulai proses registrasi', ['request' => $request->all()]);

            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8',
                'token' => 'required|string',
            ]);

            Log::info('Validasi input berhasil.');

            $secretToken = env('SECRET_TOKEN');
            $hashedToken = Hash::make($request->token); 
            Log::info('Token rahasia telah di-hash.', ['hashed_token' => $hashedToken]);

            if (!Hash::check($request->token, env('SECRET_TOKEN'))) {
                return redirect()->route('auth')->with([
                    'failed' => 'Token tidak valid.',
                ]);
            }

            Log::info('Token valid.');

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            return redirect()->route('auth')->with([
                'success' => 'Pengguna baru berhasil ditambahkan.',
            ]);
        } catch (\Exception $e) {
            return redirect()->route('auth')->with([
                'failed' => 'Terjadi kesalahan saat registrasi.',
            ]);
        }
    }


    /**
     * Fungsi untuk login pengguna.
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'Kredensial tidak valid!'], 401);
        }

        $user = User::where('email', $request->email)->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        return redirect()->route('cashier')->with([
            'success' => 'Berhasil melakukan login.',
          ]);
    }

    /**
     * Fungsi untuk logout pengguna.
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logout berhasil!']);
    }
}
